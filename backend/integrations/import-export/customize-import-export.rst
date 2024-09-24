Extend Entities to Support Bulk Import and Export
=================================================

Import/export capabilities in Oro applications are available for most critical features where the daily operations generate high data load. Bulk import is recommended when manual one-by-one entry is not efficient.

Out of the box, import and export is enabled for the following types of data:

+------------------+--------------------+----------------+
| OroCommerce      | OroCRM             | OroPlatform    |
+==================+====================+================+
| Products         | Leads              | Emails         |
+------------------+--------------------+----------------+
| Product Prices   | Opportunities      | Integrations   |
+------------------+--------------------+----------------+
| Price Attributes | Accounts           | Localizations  |
+------------------+--------------------+----------------+
| Categories       | Contacts           | Languages      |
+------------------+--------------------+----------------+
| Inventory levels | Business Customers | Users          |
+------------------+--------------------+----------------+
|                  |                    | Organizations  |
+------------------+--------------------+----------------+
|                  |                    | User Groups    |
+------------------+--------------------+----------------+
|                  |                    | User Roles     |
+------------------+--------------------+----------------+
|                  |                    | Business Units |
+------------------+--------------------+----------------+

When your business calls for a non-standard solution, you may customize Oro application and enable import/export for the entity that is not listed above. This works for your custom entities or for the standard one that is heavily used in your business.

Enable Import/Export for a Custom Entity
----------------------------------------

To make OroPlatform capable to export your custom entities as CSV files and to be able to load data from CSV files for your entities, create the following methods, services and configurations:

* `Implement Configuration Loading Method`_
* `Configure Import and Export Services (Processors)`_
* `Prepare Import Data Template`_
* `Enable Import and Export in the UI`_

Implement Configuration Loading Method
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To enable Oro application read configuration settings from the configuration files, add a container
extension class in the entity bundle and implement the *load* method, like in the example below:

.. code-block:: php
    :caption: src/Acme/Bundle/DemoBundle/DependencyInjection/AcmeDemoExtension.php

    namespace Acme\Bundle\DemoBundle\DependencyInjection;

    use Symfony\Component\Config\FileLocator;
    use Symfony\Component\DependencyInjection\ContainerBuilder;
    use Symfony\Component\DependencyInjection\Extension\Extension;
    use Symfony\Component\DependencyInjection\Loader;

    class AcmeDemoExtension extends Extension
    {
        #[\Override]
        public function load(array $configs, ContainerBuilder $container): void
        {
            $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
            $loader->load('importexport.yml');
        }
    }

In this example, the *importexport.yml* file is located in the *Resources/config* directory of the bundle.

.. note:: It is recommended to keep the default location and default filename for the import/export configuration file.

Configure Import and Export Services (Processors)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

In OroPlatform, import and export processor are implemented in the ``Oro\Bundle\ImportExportBundle\Processor\ImportProcessor`` and
``Oro\Bundle\ImportExportBundle\Processor\ExportProcessor`` classes that ship with the
OroImportExportBundle.

In the *importexport.yml* configuration file located in the *Resources/config* directory, define the secrvices that are based on the on abstract OroImportExportBundle services, like in the following example:

.. note:: In the tags section, specify the entity to enable import/export for.

.. code-block:: yaml
    :caption: src/Acme/Bundle/DemoBundle/Resources/config/importexport.yml

    services:
        acme_demo.importexport.data_converter:
            parent: oro_importexport.data_converter.configurable

        acme_demo.importexport.processor.export:
            parent: oro_importexport.processor.export_abstract
            calls:
                - [setDataConverter, ['@acme_demo.importexport.data_converter']]
            tags:
                - name: oro_importexport.processor
                  type: export
                  entity: Acme\Bundle\DemoBundle\Entity\Task
                  alias: acme_task
        acme_demo.importexport.processor.import:
            parent: oro_importexport.processor.import_abstract
            calls:
                - [setDataConverter, ['@acme_demo.importexport.data_converter']]
            tags:
                - name: oro_importexport.processor
                  type: import
                  entity: Acme\Bundle\DemoBundle\Entity\Task
                  alias: acme_task

Prepare Import Data Template
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Import capability in Oro applications is documented with a Data Template - a sample import file that illustrates expected structure of the data, like the headers, data types, and acceptable values that are valid for the entity attributes.

User can download data template in a csv format from the list next to the Import option. Oro application creates a file automatically based on the related template fixtures.

To implement these fixtures for your custom entity, create a class that implements TemplateFixtureInterface and extends AbstractTemplateRepository and implement the following methods:

* *getEntityClass()*
* *getData()*
* *fillEntityData($key, $entity)*
* *createEntity($key)*

In the *fillEntityData* method, populate the values for the attributes that shall be included into the template.

Please refer to the following example:

.. code-block:: php
    :caption: src/Acme/Bundle/DemoBundle/ImportExport/TemplateFixture;

    namespace Acme\Bundle\DemoBundle\ImportExport\TemplateFixture;

    use Acme\Bundle\DemoBundle\Entity\Task;
    use Oro\Bundle\ImportExportBundle\TemplateFixture\AbstractTemplateRepository;
    use Oro\Bundle\ImportExportBundle\TemplateFixture\TemplateFixtureInterface;

    class TaskFixture extends AbstractTemplateRepository implements TemplateFixtureInterface
    {
        #[\Override]
        protected function createEntity($key): Task
        {
            return new Task($key);
        }

        #[\Override]
        public function getEntityClass(): string
        {
            return Task::class;
        }

        #[\Override]
        public function getData()
        {
            return $this->getEntityData('example-task');
        }

        #[\Override]
        public function fillEntityData($key, $entity)
        {
            $entity->setId(1);
            $entity->setSubject('Call customer');
            $entity->setDescription('Please call the customer to talk about their future plans.');
            $entity->setDueDate(new \DateTime('+3 days'));
        }
    }

Next, in the *importexport.yml* file located in the *src/Acme/Bundle/DemoBundle/Resources/config/ folder*, register the newly created fixtures class as a service. Please refer to the following example:

.. code-block:: yaml
    :caption: src/Acme/Bundle/DemoBundle/Resources/config/importexport.yml

    services:
        # ...
        acme_demo.importexport.template_fixture.task:
            class: Acme\Bundle\DemoBundle\ImportExport\TemplateFixture\TaskFixture
            tags:
                - { name: oro_importexport.template_fixture }

Enable Import and Export in the UI
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To enable export and import for Oro application users, reuse the ``buttons.html.twig`` template from the
OroImportExportBundle. Include it into the twig template in the navigation block (*block navButtons*). Provide the valid entity_class, export and import processor aliases from the configuration file that is described in the `Configure import and export services (processors)`_ section.

.. code-block:: html+jinja
   :caption: src/Acme/Bundle/DemoBundle/Resources/views/Task/index.html.twig #}

    {% extends '@OroUI/actions/index.html.twig' %}

    {% set gridName = 'acme-tasks-grid' %}
    {% set pageTitle = 'Task' %}

    {% block navButtons %}
        {% include '@OroImportExport/ImportExport/buttons.html.twig' with {
            entity_class: 'Acme\\Bundle\\DemoBundle\\Entity\\Task',
            exportProcessor: 'acme_task',
            exportTitle: 'Export',
            importProcessor: 'acme_task',
            importTitle: 'Import',
            datagridName: gridName
        } %}

        {# ... #}
    {% endblock %}
