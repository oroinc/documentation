Extending Entities to Support Bulk Import and Export
====================================================

Import/export capabilities in Oro applications are available for most critical features where the daily operations generate high data load. Bulk import is recommented when manual one-by-one entry is not efficient.

Out of the box, import and export is enabled for the following types of data:

+------------------+--------------------+----------------+
| OroCommerce      | OroCRM             | OroPlatform    |
+==================+====================+================+
| Products         | Leads              | Emails         |
+------------------+--------------------+----------------+
| Price lists      | Opportunities      | Integrations   |
+------------------+--------------------+----------------+
| Inventory levels | Accounts           | Localizations  |
+------------------+--------------------+----------------+
|                  | Contacts           | Languages      |
+------------------+--------------------+----------------+
|                  | Business Customers | Users          |
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

How to enable import/export for a custom entity
-----------------------------------------------

To make Oro Platform capable to export your custom entities as CSV files and to be able to load data from CSV files for your entities, create the following methods, services and configurations:

* `Implement Configuration Loading Method`_
* `Configure Import and Export Services (Processors)`_
* `Prepare Import Data Template`_
* `Enable Import and Export in the UI`_

Implement Configuration Loading Method
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To enable Oro application read configuration settings from the configuration files, add a container
extension class in the entity bundle and implement the *load* method, like in the example below:

.. code-block:: php
    :linenos:

    // src/AppBundle/DependencyInjection/AppExtension.php
    namespace AppBundle\DependencyInjection;

    use Symfony\Component\Config\FileLocator;
    use Symfony\Component\DependencyInjection\ContainerBuilder;
    use Symfony\Component\DependencyInjection\Extension\Extension;
    use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

    class AppExtension extends Extension
    {
        public function load(array $configs, ContainerBuilder $container)
        {
            $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/Resources/config'));
            $loader->load('importexport.yml');
        }
    }

In this example, the *importexport.yml* file is located in the *Resources/config* directory of the bundle. 

.. note:: It is recommended to keep the default location and default filename for the import/export configuration file.

Configure Import and Export Services (Processors)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

In Oro Platform, import and export processor are implemented in the :class:`Oro\\Bundle\\ImportExportBundle\\Processor\\ImportProcessor` and
:class:`Oro\\Bundle\\ImportExportBundle\\Processor\\ExportProcessor` classes that ship with the
OroImportExportBundle. 

In the *importexport.yml* configuration file located in the *Resources/config* directory, define the secrvices that are based on the on abstract OroImportExportBundle services, like in the following example:

.. note:: In the tags section, specify the entity to enable import/export for.

.. code-block:: yaml
    :caption: src/AppBundle/Resources/config/importexport.yml
    :linenos:

    services:
        app.importexport.data_converter:
            parent: oro_importexport.data_converter.configurable

        app.importexport.processor.export:
            parent: oro_importexport.processor.export_abstract
            calls:
                - [setDataConverter, ['@app.importexport.data_converter']]
            tags:
                - name: oro_importexport.processor
                  type: export
                  entity: AppBundle\Entity\Task
                  alias: app_task
        app.importexport.processor.import:
            parent: oro_importexport.processor.import_abstract
            calls:
                - [setDataConverter, ['@app.importexport.data_converter']]
            tags:
                - name: oro_importexport.processor
                  type: import
                  entity: AppBundle\Entity\Task
                  alias: app_task

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
    :linenos:

    // src/AppBundle/ImportExport/TemplateFixture;
    namespace AppBundle\ImportExport\TemplateFixture;

    use AppBundle\Entity\Task;
    use Oro\Bundle\ImportExportBundle\TemplateFixture\AbstractTemplateRepository;
    use Oro\Bundle\ImportExportBundle\TemplateFixture\TemplateFixtureInterface;

    class TaskFixture extends AbstractTemplateRepository implements TemplateFixtureInterface
    {
        public function getEntityClass()
        {
            return 'AppBundle\Entity\Task';
        }

        public function getData()
        {
            return $this->getEntityData('example-task');
        }

        public function fillEntityData($key, $entity)
        {
            $entity->setId(1);
            $entity->setSubject('Call customer');
            $entity->setDescription('Please call the customer to talk about their future plans.');
            $entity->setDueDate(new \DateTime('+3 days'));
        }

        protected function createEntity($key)
        {
            return new Task();
        }
    }

Next, in the *importexport.yml* file located in the *src/AppBundle/Resources/config/ folder*, register the newly created fixtures class as a service. Please refer to the following example:

.. code-block:: yaml
    :caption: src/AppBundle/Resources/config/importexport.yml
    :linenos:

    services:
        # ...

        app.importexport.template_fixture.task:
            class: AppBundle\ImportExport\TemplateFixture\TaskFixture
            tags:
                - { name: oro_importexport.template_fixture }

Enable Import and Export in the UI
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To enable export and import for Oro application users, reuse the ``buttons.html.twig`` template from the
OroImportExportBundle. Include it into the twig template in the navigation block (*block navButtons*). Provide the valid entity_class, export and import processor aliases from the configuration file that is described in the `Configure import and export services (processors)`_ section.

.. code-block:: html+jinja
    :linenos:

    {# src/AppBundle/Resources/views/Task/index.html.twig #}
    {% extends 'OroUIBundle:actions:index.html.twig' %}

    {% set gridName = 'app-tasks-grid' %}
    {% set pageTitle = 'Task' %}

    {% block navButtons %}
        {% include 'OroImportExportBundle:ImportExport:buttons.html.twig' with {
            entity_class: 'AppBundle\\Entity\\Task',
            exportProcessor: 'app_task',
            exportTitle: 'Export',
            importProcessor: 'app_task',
            importTitle: 'Import',
            datagridName: gridName
        } %}

        {# ... #}
    {% endblock %}
