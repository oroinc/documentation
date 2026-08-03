.. _dev-integrations-import-export-entities:

Import and Export Entities
==========================

To make OroPlatform export your custom entities as CSV files and load data from CSV files back into
them, create a few services and add some configuration.

Add all the configuration described below to the ``importexport.yml`` file in the
``Resources/config`` directory of your application bundle. Make sure your bundle has a container
extension class that loads the configuration file:

.. code-block:: php
    :caption: src/Acme/Bundle/DemoBundle/DependencyInjection/AcmeDemoExtension.php

    namespace Acme\Bundle\DemoBundle\DependencyInjection;

    use Symfony\Component\Config\FileLocator;
    use Symfony\Component\DependencyInjection\ContainerBuilder;
    use Symfony\Component\DependencyInjection\Extension\Extension;
    use Symfony\Component\DependencyInjection\Loader;

    class AcmeDemoExtension extends Extension
    {
        /**
         * {@inheritDoc}
         */
        public function load(array $configs, ContainerBuilder $container): void
        {
            $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
            $loader->load('importexport.yml');
        }
    }

Set Up the Import and Export Processor
--------------------------------------

Processors handle import and export: they transform imported data into entities, and vice versa. The
quickest way to set up import and export processors is to reuse the
``Oro\Bundle\ImportExportBundle\Processor\ImportProcessor`` and
``Oro\Bundle\ImportExportBundle\Processor\ExportProcessor`` classes that ship with the
OroImportExportBundle. Create services based on the abstract services from the OroImportExportBundle,
and tell each one which entity class it handles:

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

Provide Sample Data
-------------------

To help your users understand the format for the data they import, provide them with an example file
generated from template fixtures:

.. code-block:: php
    :caption: src/Acme/Bundle/DemoBundle/ImportExport/TemplateFixture;

    namespace Acme\Bundle\DemoBundle\ImportExport\TemplateFixture;

    use Acme\Bundle\DemoBundle\Entity\Task;
    use Oro\Bundle\ImportExportBundle\TemplateFixture\AbstractTemplateRepository;
    use Oro\Bundle\ImportExportBundle\TemplateFixture\TemplateFixtureInterface;

    class TaskFixture extends AbstractTemplateRepository implements TemplateFixtureInterface
    {
        /**
         * {@inheritDoc}
         */
        protected function createEntity($key): Task
        {
            return new Task($key);
        }

        /**
         * {@inheritDoc}
         */
        public function getEntityClass(): string
        {
            return Task::class;
        }

        /**
         * {@inheritDoc}
         */
        public function getData()
        {
            return $this->getEntityData('example-task');
        }

        /**
         * {@inheritDoc}
         */
        public function fillEntityData($key, $entity)
        {
            $entity->setId(1);
            $entity->setSubject('Call customer');
            $entity->setDescription('Please call the customer to talk about their future plans.');
            $entity->setDueDate(new \DateTime('+3 days'));
        }
    }

Then, register your fixtures class as a service:

.. code-block:: yaml
    :caption: src/Acme/Bundle/DemoBundle/Resources/config/importexport.yml

    services:
        # ...
        acme_demo.importexport.template_fixture.task:
            class: Acme\Bundle\DemoBundle\ImportExport\TemplateFixture\TaskFixture
            tags:
                - { name: oro_importexport.template_fixture }

Add Import and Export Actions to UI
-----------------------------------

Finally, add control elements to the UI so your users can export existing data and add new entities
by uploading a CSV file. To do so, include the ``buttons.html.twig`` template from the
OroImportExportBundle and pass it the names of the needed services (see the configuration above):

.. code-block:: html+jinja
    :caption: src/Acme/Bundle/DemoBundle/Resources/views/Task/index.html.twig

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


Import and Export Entity Data
-----------------------------

The |OroImportExportBundle| imports entities into OroPlatform and exports
them out of it. The bundle uses the |OroBatchBundle| to run import/export
operations. Every import/export operation is a job.

A job itself is abstract: it knows no specific details of what happens during
its execution. A job consists of steps, which the client executes and which
you can configure to run in an execution context.

Each step aggregates three crucial components which are not aware of each other:

* Reader
* Processor
* Writer

A step uses the reader to read data from the source. It then passes the data
to the processor, which can modify it before forwarding it to the writer.
Finally, the writer saves the data to its final destination.

.. seealso::

    You can take a look at the code in the OroCRM |ContactBundle| for a real-world
    example. It extends base classes from the ImportExportBundle (see
    classes in the |ImportExport namespace|) to implement contact specific
    behavior. The configuration is located in the |Resources/config/importexport.yml|
    file.

Import and Export Configuration
-------------------------------

Import is a basic operation for any entity. The import operation is one step.
See the following example configuration:

.. code-block:: yaml
    :caption:  Oro/Bundle/ImportExportBundle/Resources/config/batch_jobs.yml

    connector:
        name: oro_importexport
        jobs:
            entity_import_from_csv:
                title: "Entity Import from CSV"
                type: import
                steps:
                    import:
                        title:     import
                        class:     Oro\Bundle\BatchBundle\Step\ItemStep
                        services:
                            reader:    oro_importexport.reader.csv
                            processor: oro_importexport.processor.import_delegate
                            writer:    oro_importexport.writer.entity
                        parameters:
                            # Number of items used by writer service in one iteration, the default value is null
                            batch_size: 1000
                            # Indicates whether the import step statistics will be displayed in the import final result
                            # should be included in the summarized job context, the default value is false
                            add_to_job_summary: true

The import algorithm being performed is (in pseudocode):

.. code-block:: text

    Process job:
      - Process step 1:
        - loop
          - read item from source
          - if source is empty exit from loop
          - process item
          - save processed item to array of entities
        - end loop
        - save array of prepared entities to DB

The OroBatchBundle provides the ``Oro\Bundle\BatchBundle\Step\ItemStep``
class that executes each step of a job. Its ``doExecute()`` method creates
a ``Oro\Bundle\BatchBundle\Step\StepExecutor`` instance, passes it a
``Oro\Bundle\ImportExportBundle\Reader\ReaderInterface``,
a ``Oro\Bundle\ImportExportBundle\Processor\ProcessorInterface``,
and a writer, then runs it through the ``StepExecutor``
``execute()`` method. Once the step is done, all imported items are written
to the destination.

.. seealso::

    You can control the number of rows read from the source in one iteration
    with parameter ``oro_importexport.import.size_of_batch`` (default value is 1000).

Import Process in Detail
------------------------

For example, here is what happens in detail when you import
contact data from a CSV file:

#. The ``Oro\Bundle\ImportExportBundle\Reader\CsvFileReader`` reads
   one row from the CSV file in its ``read()``
   method and transforms it to an array representing the columns of that row.

#. The data being read is then passed to the
   ``process()``
   method of the ``Oro\Bundle\ImportExportBundle\Processor\ImportProcessor``
   class which converts the item to a complex array using the
   ``convertToImportFormat()``
   method of the ``Oro\Bundle\ImportExportBundle\Converter\ConfigurableTableDataConverter``
   data converter class.

#. The processor deserializes the item from the converted array using the
   ``Oro\Bundle\ImportExportBundle\Serializer\Serializer`` class.

#. Optionally, the deserialized object can then be modified by the
   ``Oro\Bundle\ImportExportBundle\Strategy\Import\ConfigurableAddOrReplaceStrategy``
   class.

#. Finally, the processed entity is returned by the processor and then passed
   to the ``Oro\Bundle\ImportExportBundle\Writer\EntityWriter`` class.
   This writer stores the data when its
   ``write()``
   method is executed.

.. sidebar:: The Import Process in the User Interface

    The user interface separates the import process for the ContactBundle
    in three steps:

    * In the first step, the user selects the source file that he wants to
      import in a form and submits it (see the ``importForm()``
      controller action which is configured by the ``oro_importexport_import_form``
      route). This action requires an "entity" parameter which is the class
      name of the entity that will be imported.

    * In the second step, import validation is triggered (see the ``importValidate()``
      controller action configured by the ``oro_importexport_import_validate``
      route). As a result, the user will be presented with all actions that will
      be performed by the import as well as any errors that have occurred in the
      previous step. Records with errors can't be imported; however, errors do
      not block valid records.

    * In the final step, the import is processed (see the ``importProcess``
      controller action which is configured by the ``oro_importexport_import_process``
      route).

Export Process in Detail
------------------------

The export process is essentially the import process in reverse, except that it
doesn't use a strategy:

#. First, the ``Oro\Bundle\ImportExportBundle\Reader\EntityReader``
   class reads an object.

#. Then, the ``Oro\Bundle\ImportExportBundle\Processor\ExportProcessor``
   class serializes and converts the object into an associative array with
   property names as keys and the property values as values of the array.

#. The ``Oro\Bundle\ImportExportBundle\Serializer\Serializer`` class
   normalizes each field and converts objects to complex arrays.

#. A ``Oro\Bundle\ImportExportBundle\Converter\ConfigurableTableDataConverter``
   converts the associative array into a dimensional array.

#. Finally, all array entries are written to a CSV file by the
   ``Oro\Bundle\ImportExportBundle\Writer\CsvFileWriter`` class.

The export algorithm being performed is (in pseudocode):

.. code-block:: text

    Process job:
      - Process step 1:
        - loop
          - read entity from DB
          - if source is empty exit from loop
          - process entity
          - save plain array to array of items for save
        - end loop
        - save array of prepared items to DB


.. seealso::

    You can control the number of rows written to a CSV file in one iteration
    with parameter ``oro_importexport.export.size_of_batch`` (default value is 5000).

Serializer and Normalizer
-------------------------

One important concept is how Oro normalizes and denormalizes relations
between entities and other complex data.

The ``Serializer`` class extends the standard serializer of the |Symfony Serializer component|
and has its own normalizers and denormalizers. The serializer must support each
entity that you want to export or import. This means you add normalizers and
denormalizers that convert your entity to its array/scalar representation
(normalization during serialization) and back, converting arrays to the entity
object representation (denormalization during deserialization).

.. sidebar:: ``ConfigurableEntityNormalizer``

    The system can convert a complex array to an object using the
    ``Oro\Bundle\ImportExportBundle\Serializer\Normalizer\ConfigurableEntityNormalizer::denormalize``
    method:

    .. code-block:: php

        if ($data[$fieldName] !== null
            && ($this->fieldHelper->isRelation($field) || $this->fieldHelper->isDateTimeField($field))
        ) {
            if ($this->fieldHelper->isMultipleRelation($field)) {
                $entityClass = sprintf('ArrayCollection<%s>', $field['related_entity_name']);
            } elseif ($this->fieldHelper->isSingleRelation($field)) {
                $entityClass = $field['related_entity_name'];
            } else {
                $entityClass = 'DateTime';
            }
            $context = array_merge($context, ['fieldName' => $fieldName]);
            $value = $this->serializer->denormalize($value, $entityClass, $format, $context);
        }

    If a value is not a scalar value, the system recursively denormalizes its value.
    The data converter checks for circular dependencies to avoid endless recursions
    here.

.. sidebar:: Normalizers in OroPlatform

    OroPlatform provides two normalizers for |DateTime| objects
    and collections:

    * The ``Oro\Bundle\ImportExportBundle\Serializer\Normalizer\DateTimeNormalizer``;
    * The ``Oro\Bundle\ImportExportBundle\Serializer\Normalizer\CollectionNormalizer``.

The platform converts entities to complex arrays using the
``normalize()``
method from the ``ConfigurableEntityNormalizer`` class. This method uses the
field helper to process the fields:

* If the configuration excludes the field, it will be skipped during
  normalization.

* If the field is an object, another entity or a collection, the ``normalize()``
  method for this type of object will be called.

* If the field is a scalar value, the field will be added with this value
  to the array of normalized values.

You can configure your fields in the UI under *System* / *Entities* / *Entity Management*.
Alternatively, you can describe the field configuration in your entity directly
using ``Oro\Bundle\EntityConfigBundle\Metadata\Attribute\ConfigField``:

.. code-block:: php

    #[ConfigField(
        defaultValues: [
            'importexport' => [
                'order' => 200,
                'full' => true
            ]
        ]
    )]

You can use the following options:

+--------------+-------------------------------------------------------------------+
| Option       | Description                                                       |
+==============+===================================================================+
| ``identity`` | If ``true``, the field is part of the key used to identify an     |
|              | instance of the entity. It is required to configure the object    |
|              | identity to support imports.                                      |
+--------------+-------------------------------------------------------------------+
| ``order``    | The position of the property in the export.                       |
+--------------+-------------------------------------------------------------------+
| ``excluded`` | The skip is field during export if ``excluded`` is ``true``.      |
+--------------+-------------------------------------------------------------------+
| ``full``     | If ``false``, the ``normalize()`` method returns only ``identity``|
|              | fields of associated entities during exports. If ``true``, all    |
|              | fields of the related entity are exported. Fields with Excluded   |
|              | option are skipped.This option cannot be configured in the user   |
|              | interface, but can only be set using annotations.                 |
+--------------+-------------------------------------------------------------------+

.. note:: You can check the :ref:`#[ConfigField] <annotation-config-field-importexport>` section for more information.

Import One-To-Many Relations
----------------------------

If you want to import one-to-many relations from a CSV file, you should use
the following field name rules for the header columns: "``RelationFieldName``
``NumberOfInstance`` ``FieldName``" where these strings have the following
meaning:

* RelationFieldName (``string``): entity relation name;

* NumberOfInstance (``integer``): for example ``1``;

* FieldName (``string``): The name of the referenced field name.

For example:

.. code-block:: text

    "Addresses 1 First name"

``FieldName`` may be a field label or a column name from a configuration field.
You can find it in the UI under System/Entities/Entity Management. Import
all identity fields for the related entity.

Import Many-To-One Relations
----------------------------

If you want to import many-to-one relations, you should use the following
rule: "``RelationFieldName`` ``IdentityFieldName``" where these placeholders
have the following meaning:

* RelationFieldName (``string``): entity relation name;

* IdentityFieldName (``string``): identity field of the related entity. If
  the related entity has two or more identity fields, you should import all
  identity fields of the related entity.

For example:

.. code-block:: text

    "Owner Username"

Extension of Import/Export Contacts
-----------------------------------

Add a New Provider to Support Different Formats
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To write your own provider for import operations, create a class
that extends the ``Oro\Bundle\ImportExportBundle\Reader\AbstractReader``
class. To support custom export formats, create a class
that implements the |ItemWriterInterface| from the |OroBatchBundle|.
Declare the new classes as services:

.. code-block:: yaml

    services:
        oro_importexport.reader.csv:
            class: Acme\Bundle\DemoBundle\ImportExport\Reader\ExcelFileReader

        oro_importexport.writer.csv:
            class: Oro\Bundle\ImportExportBundle\Writer\CsvFileWriter

Change Import Strategy
^^^^^^^^^^^^^^^^^^^^^^

OroPlatform provides a basic "add or substitute" import strategy. The
basic process is implemented in the ``ConfigurableAddOrReplaceStrategy`` class.
To create your own import strategy you can extend this class and override
the following methods:

* ``process()``
* ``processEntity()``
* ``updateRelations()``
* ``findExistingEntity()``

.. seealso::

    You can see an example of an adapted strategy in the |ContactAddOrReplaceStrategy|
    from the OroCRM ContactBundle.

.. sidebar:: Example: Adding a custom Strategy

    You can see an example of how to add a custom strategy in the ContactBundle
    of OroCRM. The bundle ships with a custom ``ContactAddOrUpdateOrDeleteStrategy``.
    The strategy class implements the following interfaces:

    * ``Oro\Bundle\ImportExportBundle\Strategy\StrategyInterface``
    * ``Oro\Bundle\ImportExportBundle\Context\ContextInterface``
    * ``Oro\Bundle\ImportExportBundle\Processor\EntityNameAwareInterface``

    It is also responsible for validating input data in its ``validateAndUpdateContext()``
    method when contacts are imported. The created class then is declared
    as a service in the ``Resources/config/importexport.yml`` file:

    .. code-block:: yaml
        :caption: src/Oro/Bundle/ContactBundle/Resources/config/importexport.yml

        services:
            orocrm_contact.importexport.strategy.contact.add_or_replace:
                class: Oro\Bundle\ContactBundle\ImportExport\Strategy\ContactAddOrUpadteOrDeleteStrategy
                parent: oro_importexport.strategy.configurable_add_or_replace
                calls:
                    - [SetRegistry, ["@doctrine"]]

Add Normalizers
---------------

The serializer is involved in both import and export operations. It extends Symfony's standard `Serializer` and uses the extended `DenormalizerInterface` and `NormalizerInterface` interfaces (with context support for `supportsNormalization` and `supportsDenormalization`). It converts entities to a plain array representation (serialization) and back, converting the plain array representation to entity objects (deserialization).

To convert objects, the serializer uses normalizers for the entities being imported or exported.

The normalizers must implement these interfaces:

* ``Oro\Bundle\ImportExportBundle\Serializer\Normalizer\NormalizerInterface`` --- used in export.
* ``Oro\Bundle\ImportExportBundle\Serializer\Normalizer\DenormalizerInterface`` --- used in import.

Generally, implement both interfaces if you need both import and export for the entity.

**Example of a Simple Normalizer**

.. code-block:: php

   namespace Oro\Bundle\ContactBundle\ImportExport\Serializer\Normalizer;

   use Oro\Bundle\ImportExportBundle\Serializer\Normalizer\ConfigurableEntityNormalizer;

   use Oro\Bundle\ContactBundle\Entity\Group;

   class GroupNormalizer extends ConfigurableEntityNormalizer
   {
       public function normalize($object, $format = null, array $context = [])
       {
           $result = parent::normalize($object, $format, $context);

           // call some service to modify $result
       }

       public function denormalize($data, $class, $format = null, array $context = [])
       {
           // call some service to modify $data

           return parent::denormalize($data, $class, $format, $context);
       }

       public function supportsNormalization($data, $format = null, array $context = [])
       {
           return $data instanceof Group;
       }

       public function supportsDenormalization($data, $type, $format = null, array $context = [])
       {
           return is_array($data) && $type == 'Oro\Bundle\ContactBundle\Entity\Group';
       }
   }


The serializer of OroImportExportBundle should be aware of its normalizer. To make it possible, use the appropriate tag in the DI configuration:

**Example of Normalizer Service Configuration**

.. code-block:: yaml

   services:
       orocrm_contact.importexport.normalizer.group:
           class: Oro\Bundle\ContactBundle\ImportExport\Serializer\Normalizer\GroupNormalizer
           parent: oro_importexport.serializer.configurable_entity_normalizer
           tags:
               - { name: oro_importexport.normalizer }



Add Data Converter
------------------

The data converter converts the header of the import/export file. Suppose an entity has some properties to expose in the export file. You can use the default ``Oro\Bundle\ImportExportBundle\Converter\DefaultDataConverter``. However, if you need custom labels instead of the property names in the export/import files, extend ``Oro\Bundle\ImportExportBundle\Converter\AbstractTableDataConverter``.

**Example Of a Custom Data Converter**

.. code-block:: php

    namespace Oro\Bundle\ContactBundle\ImportExport\Converter;

    use Oro\Bundle\ImportExportBundle\Converter\AbstractTableDataConverter;
    use Oro\Bundle\ContactBundle\ImportExport\Provider\ContactHeaderProvider;

    class GroupDataConverter extends AbstractTableDataConverter
    {
        /**
         * {@inheritDoc}
         */
        protected function getHeaderConversionRules()
        {
            return ['ID' => 'id', 'Label' => 'label'];
        }

        /**
         * {@inheritDoc}
         */
        protected function getBackendHeader()
        {
            return ['id', 'label'];
        }
    }


**Service**

.. code-block:: yaml

    services:
        oro_contact.importexport.data_converter.group:
            parent: oro_importexport.data_converter.configurable


Export Processor
----------------

Once the normalizers are registered and the data converter is available, you can configure the export settings using the DI configuration.

.. code-block:: yaml

    services:
        oro_contact.importexport.processor.export_group:
            parent: oro_importexport.processor.export_abstract
            calls:
                 - [setDataConverter, ['@orocrm_contact.importexport.data_converter.group']]
            tags:
                - { name: oro_importexport.processor, type: export, entity: 'Oro\Bundle\ContactBundle\Entity\Group', alias: orocrm_contact_group }


OroImportExportBundle has a controller for requesting a CSV file export. See the controller action defined in the OroImportExportBundle:ImportExport:instantExport method, route **oro_importexport_export_instant**.

Send a request to the **/export/instant/orocrm_contact_group** URL, and you receive a response with the URL of the exported file results and some additional information:

.. code-block:: json

    {
        "success":true,
        "url":"/export/download/orocrm_contact_group_2013_10_03_13_44_53_524d4aa53ffb9.csv",
        "readsCount":3,
        "errorsCount":0
    }


Import Strategy
---------------

The strategy is a class responsible for the import logic, such as adding new records or updating existing ones.

**Example of the Import Strategy**

.. code-block:: php

    namespace Oro\Bundle\ContactBundle\ImportExport\Strategy;

    use Oro\Bundle\ImportExportBundle\Strategy\Import\ConfigurableAddOrReplaceStrategy;

    class ContactAddOrReplaceStrategy extends ConfigurableAddOrReplaceStrategy
    {
        /**
         * {@inheritdoc}
         */
        public function process($entity)
        {
            $entity = parent::process($entity);

            if ($entity) {
                $this
                    ->updateAddresses($entity);
            }

            return $entity;
        }

        // other methods


Also, you can use [rows postponing](rows-postponing.md) in the strategy .

**Service**

.. code-block:: yaml

    services:
        oro_contact.importexport.strategy.contact.add_or_replace:
            class: Oro\Bundle\ContactBundle\ImportExport\Strategy\ContactAddOrReplaceStrategy
            parent: oro_importexport.strategy.configurable_add_or_replace


Import Processor
----------------

Once the normalizers are registered, the data converter is available, and the strategy is implemented, you can configure the import using the following DI configuration.

.. code-block:: yaml

    services:
        # Import processor
        oro_contact.importexport.processor.import_group:
            parent: oro_importexport.processor.import_abstract
            calls:
                 - [setDataConverter, ['@orocrm_contact.importexport.data_converter.group']]
                 - [setStrategy, ['@orocrm_contact.importexport.strategy.group.add_or_replace']]
            tags:
                - { name: oro_importexport.processor, type: import, entity: 'Oro\Bundle\ContactBundle\Entity\Group', alias: orocrm_contact.add_or_replace_group }
                - { name: oro_importexport.processor, type: import_validation, entity: 'Oro\Bundle\ContactBundle\Entity\Contact', alias: orocrm_contact.add_or_replace_group }


Keep in mind that the import requires a processor for import validation, as in the example above.

The import runs in three steps.

At the first step, a user fills out the form (defined in the OroImportExportBundle:ImportExport:importForm, route "oro_importexport_import_form"), providing the source file to import, and submits it. This action requires the "entity" parameter, which is the class name of the imported entity.

At the second step, the import validation action (defined in the OroImportExportBundle:ImportExport:importValidate method, route "oro_importexport_import_validate") is triggered. The user then sees all the actions the import will perform and all the errors that occurred. Records with errors cannot be imported, but the errors do not block processing of the valid records.

At the last step, the import action (defined in the OroImportExportBundle:ImportExport:importProcess method, route "oro_importexport_import_process") runs.

Fixture Services
----------------

The fixture implementation is based on the default import/export process.

**Create class:**

.. code-block:: php

    namespace Oro\Bundle\ContactBundle\ImportExport\TemplateFixture;

    use Oro\Bundle\ImportExportBundle\TemplateFixture\TemplateFixtureInterface;

    use Oro\Bundle\ContactBundle\Entity\Contact;

    class ContactFixture implements TemplateFixtureInterface
    {
        /**
         * @var TemplateFixtureInterface
         */
        protected $userFixture;

        public function __construct(TemplateFixtureInterface $userFixture)
        {
            $this->userFixture = $userFixture;
        }

        /**
         * {@inheritdoc}
         */
        public function getData()
        {
            $contact = new Contact();
            $contact
                ->setFirstName('Jerry')
                ->setLastName('Coleman');

            return new \ArrayIterator([$contact]);
        }

        public function getEntityClass()
        {
            return Contact::class;
        }

        public function getEntity($key)
        {
            return new Contact();
        }

        public function fillEntityData($key, $entity)
        {}
    }



**Define a service:**

.. code-block:: yaml

    services:
        oro_contact.importexport.template_fixture.contact:
            class: Oro\Bundle\ContactBundle\ImportExport\TemplateFixture\ContactFixture
            tags:
                - { name: oro_importexport.template_fixture }


**Define fixture converter:**

.. code-block:: yaml

    oro_contact.importexport.template_fixture.data_converter.contact:
        parent: oro_importexport.data_converter.template_fixture.configurable


**Define export processor:**

.. code-block:: yaml

    oro_contact.importexport.processor.export_template:
        parent: oro_importexport.processor.export_abstract
        calls:
            - [setDataConverter, ['@orocrm_contact.importexport.template_fixture.data_converter.contact']]
        tags:
            - { name: oro_importexport.processor, type: export_template, entity: 'Oro\Bundle\ContactBundle\Entity\Contact', alias: orocrm_contact }


Import and Export UI setup
--------------------------

To display the import (and download template) and export buttons on your page, include the button-generation template from OroImportExportBundle. Multiple options configure how these buttons display and how the pop-ups appear in certain cases (export and download template).

**Options for the import/export buttons configuration:**

General:

- refreshPageOnSuccess: set to true in order to refresh the page after the successful import.
- afterRefreshPageMessage: the message that is displayed if the previous option is set.
- datagridName: the ID of the grid that is used to refresh the data after the import operation is completed (alternative to the previous refresh option).
- options: options to pass to the import/export route.
- entity_class: a full class name of the entity.

Export:

- exportJob: the ID of the export job you have defined.
- exportProcessor: the alias ID of the export processor or an array with the alias IDs of the processors if they are more than one.
- exportLabel: the label that should be used for the export options pop-up (in case of multiple export processors).

Export template:

- exportTemplateJob: the ID of the export template job you have defined.
- exportTemplateProcessor: the alias ID of the export template processor or an array with the alias IDs of the processors if they are more than one.
- exportTemplateLabel: the label that should be used for the export template options pop-up (in case of multiple export processors).

Import:

- importProcessor: the alias ID of the import processor.
- importLabel: the label used for the import pop-up.
- importJob: the ID of the import job you have defined.
- importValidateJob: the ID of the import validation job you have defined.


**Display import/export buttons:**

.. code-block:: twig

    {% include '@OroImportExport/ImportExport/buttons.html.twig' with {
        entity_class: entity_class,
        exportJob: 'your_custom_entity_class_export_to_csv',
        exportProcessor: exportProcessor,
        importProcessor: 'oro.importexport.processor.import',
        exportTemplateProcessor: exportTemplateProcessor,
        exportTemplateLabel: 'oro.importexport.processor.export.template_popup.title'|trans,
        exportLabel: 'oro.importexport.processor.export.popup.title'|trans,
        datagridName: gridName
    } %}


**Displaying import/export buttons for multiple entities:**

To display import/export buttons for several entities, create a configuration
provider for each entity with the options described at the beginning of the section:

.. code-block:: php

    namespace Oro\Bundle\ProductBundle\ImportExport\Configuration;

    use Oro\Bundle\ImportExportBundle\Configuration\ImportExportConfiguration;
    use Oro\Bundle\ImportExportBundle\Configuration\ImportExportConfigurationInterface;
    use Oro\Bundle\ImportExportBundle\Configuration\ImportExportConfigurationProviderInterface;
    use Oro\Bundle\ProductBundle\Entity\Product;
    use Symfony\Contracts\Translation\TranslatorInterface;

    class ProductImportExportConfigurationProvider implements ImportExportConfigurationProviderInterface
    {
        /**
         * @var TranslatorInterface
         */
        private $translator;

        public function __construct(TranslatorInterface $translator)
        {
            $this->translator = $translator;
        }

        /**
         * {@inheritDoc}
         *
         * @throws \InvalidArgumentException
         */
        public function get(): ImportExportConfigurationInterface
        {
            return new ImportExportConfiguration([
                ImportExportConfiguration::FIELD_ENTITY_CLASS => Product::class,
                ImportExportConfiguration::FIELD_EXPORT_PROCESSOR_ALIAS => 'oro_product_product',
                ImportExportConfiguration::FIELD_EXPORT_TEMPLATE_PROCESSOR_ALIAS => 'oro_product_product_export_template',
                ImportExportConfiguration::FIELD_IMPORT_PROCESSOR_ALIAS => 'oro_product_product.add_or_replace',
                ImportExportConfiguration::FIELD_DATA_GRID_NAME => 'products-grid',
                ImportExportConfiguration::FIELD_IMPORT_BUTTON_LABEL =>
                    $this->translator->trans('oro.product.import.button.label'),
                ImportExportConfiguration::FIELD_IMPORT_VALIDATION_BUTTON_LABEL =>
                    $this->translator->trans('oro.product.import_validation.button.label'),
                ImportExportConfiguration::FIELD_EXPORT_TEMPLATE_BUTTON_LABEL =>
                    $this->translator->trans('oro.product.export_template.button.label'),
                ImportExportConfiguration::FIELD_EXPORT_BUTTON_LABEL =>
                    $this->translator->trans('oro.product.export.button.label'),
                ImportExportConfiguration::FIELD_IMPORT_POPUP_TITLE =>
                    $this->translator->trans('oro.product.import.popup.title'),
            ]);
        }
    }


Provider's service should have a tag with the name ``oro_importexport.configuration`` and some alias.
The alias is used to group import/export buttons with different configurations on one page:

.. code-block:: yaml

    oro_product.importexport.configuration_provider.product:
        class: Oro\Bundle\ProductBundle\ImportExport\Configuration\ProductImportExportConfigurationProvider
        arguments:
            - '@translator'
        tags:
            - { name: oro_importexport.configuration, alias: oro_product_index }


To show all import/export buttons on a page that are defined by configuration providers with an alias,
include the following template:

.. code-block:: twig

    {% include '@OroImportExport/ImportExport/buttons_from_configuration.html.twig' with {
        'alias': 'oro_product_index'
    } %}


**Import pop-up:**

With the default import configuration (as in the examples above), the user sees an import button on the configured page. Clicking this button opens a pop-up where the user provides a file for uploading (and validation) and selects the import strategy. As described in the import strategy section, the import process requires
a strategy, but it can also have multiple strategies defined.

Each strategy is used by an import processor, so the strategy must be passed to the import processor defined for the current entity class. When generating the import pop-up, the framework searches for the import processors defined for the given entity class and displays them in the strategy selection.

**Exceptional use cases:**

In the basic use case, you define one import/export processor for an entity, which is used when the user selects the import/export operation in the application.

In some cases, the export operation needs to extract data in multiple ways or from multiple entities, and you
want to offer the user different export options. Then you must define multiple export processors, each handling one of the export types you want to offer.

If an entity has multiple export processors and the user starts an export, the platform displays a pop-up where they select an option corresponding to one of the defined export processors. The platform then uses the export processor for the selected option. You must also define translation keys for
the processor IDs; these keys label the selected option in the pop-up.

The same applies to exporting the templates used for import. You can have multiple export template processors, displayed as options in a pop-up when the user wants to download a data template.

*Export processors definition:*

.. code-block:: yaml

    oro.importexport.processor.export.some_type:
        parent: oro_importexport.processor.export_abstract
        calls:
            - [setDataConverter, ['@oro.importexport.data_converter']]
        tags:
            - { name: oro_importexport.processor, type: export, entity: 'Acme\Bundle\DemoBundle\Entity\EntityName', alias: oro_some_type }

    oro.importexport.processor.export.another_type:
        parent: oro_importexport.processor.export_abstract
        calls:
            - [setDataConverter, ['@oro.importexport.data_converter']]
        tags:
            - { name: oro_importexport.processor, type: export, entity: 'Acme\Bundle\DemoBundle\Entity\EntityName', alias: oro_another_type }


*Translation keys for selections in an export pop-up:*

.. code-block:: yaml

   #messages.en.yml
   oro.importexport.export.oro_some_type: Some export type
   oro.importexport.export.oro_another_type: Some other export type


In this case, specify the processors that can be used as selected options in the pop-up. In the import/export buttons configuration, specify the processors as an array, as in the example below (**exportProcessors** and/or **exportTemplateProcessors**):

.. code-block:: twig

    {% include '@OroImportExport/ImportExport/buttons.html.twig' with {
        ...
        exportProcessor: exportProcessors,
        exportTemplateProcessor: exportTemplateProcessors,
        ...
    } %}


**Change an import/export pop-up dialog:**


*Import a pop-up customization:*

To implement custom behavior of the import pop-up, you can extend the default **ImportType** from OroImportExportBundle and implement a custom form appearance.

.. code-block:: php

    namespace Acme\Bundle\DemoBundle\Form\Extension;

    use Oro\Bundle\ImportExportBundle\Form\Type\ImportType;
    use Symfony\Component\Form\AbstractTypeExtension;
    use Symfony\Component\Form\FormBuilderInterface;

    class CustomImportTypeExtension extends AbstractTypeExtension
    {
        /**
         * {@inheritDoc}
         */
        public static function getExtendedTypes(): iterable
        {
            return [ImportType::NAME];
        }

        /**
         * {@inheritDoc}
         */
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            // Please add your custom implementation to generate the form
        }
    }


*Export a pop-up customization:*

To display the export/export template options in a different way (other than the default
options selection), you can extend the base types (**ExportType** and **ExportTemplateType**) from the ImportExport bundle. These types are used when displaying the form with options in the pop-up.

Example of displaying the form with choice (radio buttons):

.. code-block:: php

    namespace Acme\Bundle\DemoBundle\Form\Extension;

    use Oro\Bundle\ImportExportBundle\Form\Type\ExportType;
    use Symfony\Component\Form\AbstractTypeExtension;
    use Symfony\Component\Form\FormBuilderInterface;

    class CustomExportTypeExtension extends AbstractTypeExtension
    {
        /**
         * {@inheritDoc}
         */
        public static function getExtendedTypes(): iterable
        {
            return [ExportType::NAME];
        }

        /**
         * {@inheritDoc}
         */
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            // Please add your custom implementation to generate the form
        }
    }


Import CSV Files via CLI
------------------------

OroPlatform provides the CLI command ``oro:import:file`` that imports records from the specified CSV file.

.. code-block:: none

    $ php bin/console oro:import:file --help
    Usage:
        oro:import:file [options] [--] <file>
        oro:import:file --email=<email> --jobName=<job> --processor=<processor> <file>
        oro:import:file --validation --email=<email> --jobName=<job> --processor=<processor> <file>

    Arguments:
        file                   CSV file name

    Options:
        --jobName=JOBNAME      Import job name
        --processor=PROCESSOR  Import processor name
        --validation           Only validate data instead of import
        --email=EMAIL          Email to send the import log to

Storage Configuration
---------------------

OroImportExportBundle uses |Gaufrette| to provide a filesystem abstraction layer.

The Gaufrette filesystem name is ``importexport``.
By default, it is a private storage that stores files in the ``var/data/importexport`` local directory
of your project.

A separate filesystem handles additional files (for example, images) referenced by the files being imported.
Its Gaufrette filesystem name is ``import_files``.
By default, it is a private storage that retrieves files from the ``var/data/import_files`` local directory
of your project.

Both filesystems can be changed with the configuration of the :ref:`File Storage <backend-file-storage>`.

.. include:: /include/include-links-dev.rst
    :start-after: begin


Troubleshooting Problems
------------------------

.. note:: Be careful when adding new relations to the entity and using them for importing. In case no valid data the possible situation of losing the related collections which located deeper than 1st level. This is due to the fact that the ``Oro\Bundle\ImportExportBundle\Field\RelatedEntityStateHelper`` class handles only the first level of collections in the ``rememberAlteredCollectionsItems`` method. For example, how it was fixed for ``Oro\Bundle\ProductBundle\Entity\ProductKitItem::$products`` in ``Oro\Bundle\ProductBundle\ImportExport\Strategy\ProductStrategy::invalidateEntity`` and ``Oro\Bundle\ProductBundle\ImportExport\Strategy\ProductStrategy::importEntityFields``.

.. code-block:: php

    namespace Oro\Bundle\ProductBundle\ImportExport\Strategy;

    use Oro\Bundle\BatchBundle\Item\Support\ClosableInterface;
    use Oro\Bundle\LocaleBundle\ImportExport\Strategy\LocalizedFallbackValueAwareStrategy;
    use Oro\Bundle\ProductBundle\Entity\ProductKitItem;

    class ProductStrategy extends LocalizedFallbackValueAwareStrategy implements ClosableInterface
    {
        protected function importEntityFields($entity, $existingEntity, $isFullData, $entityIsRelation, $itemData)
        {
            // Ensures that ProductKitItem which does not belong to Product will not be changed.
            if ($existingEntity instanceof ProductKitItem &&
                $this->processingEntity->getId() !== $existingEntity->getProductKit()->getId()
            ) {
                return $existingEntity;
            }

            return parent::importEntityFields($entity, $existingEntity, $isFullData, $entityIsRelation, $itemData);
        }

        protected function invalidateEntity($entity)
        {
            if ($entity->isKit()) {
                $kitItemsCollection = $entity->getKitItems();
                // Ensures that ProductKitItem related entities are detached when a product is invalidated and detached.
                if ($kitItemsCollection instanceof PersistentCollection) {
                    foreach ($kitItemsCollection->getSnapshot() as $kitItem) {
                        $this->relatedEntityStateHelper->rememberAlteredCollectionsItems($kitItem);
                    }
                }
            }

            parent::invalidateEntity($entity);
        }
    }
