How to Import and Export Entities
=================================

You have to create some services and add some configuration to make Oro Platform capable to export
your custom entities as CSV files and to be able to load data from CSV files for your entities.

All the configuration described below will be added to the ``importexport.yml`` file in the
``Resources/config`` directory of your application bundle. Make sure that you have a container
extension class in your bundle that loads the configuration file:

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

Setting Up the Import and Export Processor
------------------------------------------

Import and export is handled by so called processors which transform the imported data into actual
entities and vice versa. The easiest way to quickly set up import and export processors for your
entities is to reuse the :class:`Oro\\Bundle\\ImportExportBundle\\Processor\\ImportProcessor` and
:class:`Oro\\Bundle\\ImportExportBundle\\Processor\\ExportProcessor` classes that ship with the
OroImportExportBundle. All you need to do is creating services that are based on abstract services
from the OroImportExportBundle and let them know which entity class they have to handle:

.. code-block:: yaml
    :linenos:

    # src/AppBundle/Resources/config/importexport.yml
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

Providing Example Data
----------------------

To make it easier for your users to understand the format in which they need to enter the data to
be imported, you can provide them with an example file that will be created based on some template
fixtures:

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

Then, register your fixtures class as a service:

.. code-block:: yaml
    :linenos:

    # src/AppBundle/Resources/config/importexport.yml
    services:
        # ...

        app.importexport.template_fixture.task:
            class: AppBundle\ImportExport\TemplateFixture\TaskFixture
            tags:
                - { name: oro_importexport.template_fixture }

Adding Import and Export Actions to the UI
------------------------------------------

Finally, you need to add control elements to the UI to let your users export existing data and add
new entities by uploading a CSV file. You can include the ``buttons.html.twig`` template from the
OroImportExportBundle while passing it the needed services names (see the configuration above) to
do so:

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
            dataGridName: gridName
        } %}

        {# ... #}
    {% endblock %}
