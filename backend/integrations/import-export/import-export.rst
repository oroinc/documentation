.. _dev-integrations-import-export-entities:

Import and Export Entities
==========================

You have to create some services and add some configuration to make OroPlatform capable to export
your custom entities as CSV files and load data from CSV files for your entities.

All the configuration described below is added to the ``importexport.yml`` file in the
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

Set Up the Import and Export Processor
--------------------------------------

Import and export are handled by processors which transform imported data into actual
entities, and vice versa. The easiest way to quickly set up import and export processors for your
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

Provide Sample Data
-------------------

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

Add Import and Export Actions to UI
-----------------------------------

Finally, you need to add control elements to the UI to let your users export existing data and add
new entities by uploading a CSV file. You can include the ``buttons.html.twig`` template from the
OroImportExportBundle while passing it the names of the needed services (see the configuration above) to
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
            datagridName: gridName
        } %}

        {# ... #}
    {% endblock %}


Import and Export Entity Data
-----------------------------

The |OroImportExportBundle| is intended to import entities into or export
them out of OroPlatform. The bundle uses the |OroBatchBundle| to organize
the execution of import/export operations. Any import/export operation is
a job.

A job itself is abstract. It doesn't know any specific details of what is
happening during its execution. A job consists of steps which can be configured
to run in an execution context and are executed by the client.

Each step aggregates three crucial components which are not aware of each other:

* Reader
* Processor
* Writer

A step uses the reader to read data from the source. Once the reader has
run, the data is passed to the processor. The processor can modify the data before
it is forwarded to the writer. Finally, the writer saves data to its final
destination.

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
    :linenos:

    # Oro/Bundle/ImportExportBundle/Resources/config/batch_jobs.yml
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
                        parameters: ~

The import algorithm being performed is (in pseudocode):

.. code-block:: text
    :linenos:

    Process job:
      - Process step 1:
        - loop
          - read item from source
          - if source is empty exit from loop
          - process item
          - save processed item to array of entities
        - end loop
        - save array of prepared entities to DB

The OroBatchBundle provides the :class:`Oro\\Bundle\\BatchBundle\\Step\\ItemStep`
class that executes each step of a job. In its
:method:`Oro\\Bundle\\BatchBundle\\Step\\ItemStep::doExecute` method, it creates
a :class:`Oro\\Bundle\\BatchBundle\\Step\\StepExecutor` instance, passes a
:class:`reader <Oro\\Bundle\\ImportExportBundle\\Reader\\ReaderInterface>`,
a :class:`processor <Oro\\Bundle\\ImportExportBundle\\Processor\\ProcessorInterface>`
and a writer to it and executes it in the ``StepExecutor`` through the
:method:`Oro\\Bundle\\BatchBundle\\Step\\StepExecutor::execute` method. After
this step is done, all imported items are written to the destination.

Import Process in Detail
------------------------

For example, here is what happens in detail when you import
contact data from a CSV file:

#. The :class:`Oro\\Bundle\\ImportExportBundle\\Reader\\CsvFileReader` reads
   one row from the CSV file in its :method:`Oro\\Bundle\\ImportExportBundle\\Reader\\CsvFileReader::read`
   method and transforms it to an array representing the columns of that row.

#. The data being read is then passed to the
   :method:`Oro\\Bundle\\ImportExportBundle\\Processor\\ImportProcessor::process`
   method of the :class:`Oro\\Bundle\\ImportExportBundle\\Processor\\ImportProcessor`
   class which converts the item to a complex array using the
   :method:`Oro\\Bundle\\ImportExportBundle\\Converter\\ConfigurableTableDataConverter::convertToImportFormat`
   method of the :class:`Oro\\Bundle\\ImportExportBundle\\Converter\\ConfigurableTableDataConverter`
   data converter class.

#. The processor deserializes the item from the converted array using the
   :class:`Oro\\Bundle\\ImportExportBundle\\Serializer\\Serializer` class.

#. Optionally, the deserialized object can then be modified by the
   :class:`Oro\\Bundle\\ImportExportBundle\\Strategy\\Import\\ConfigurableAddOrReplaceStrategy`
   class.

#. Finally, the processed entity is returned by the processor and then passed
   to the :class:`Oro\\Bundle\\ImportExportBundle\\Writer\\EntityWriter` class.
   This writer stores the data when its
   :method:`Oro\\Bundle\\ImportExportBundle\\Writer\\EntityWriter::write`
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

#. First, the :class:`Oro\\Bundle\\ImportExportBundle\\Reader\\EntityReader`
   class reads an object.

#. Then, the :class:`Oro\\Bundle\\ImportExportBundle\\Processor\\ExportProcessor`
   class serializes and converts the object into an associative array with
   property names as keys and the property values as values of the array.

#. The :class:`Oro\\Bundle\\ImportExportBundle\\Serializer\\Serializer` class
   normalizes each field and converts objects to complex arrays.

#. A :class:`data converter <Oro\\Bundle\\ImportExportBundle\\Converter\\ConfigurableTableDataConverter>`
   converts the associative array into a dimensional array.

#. Finally, all array entries are written to a CSV file by the
   :class:`Oro\\Bundle\\ImportExportBundle\\Writer\\CsvFileWriter` class.

The export algorithm being performed is (in pseudocode):

.. code-block:: text
    :linenos:

    Process job:
      - Process step 1:
        - loop
          - read entity from DB
          - if source is empty exit from loop
          - process entity
          - save plain array to array of items for save
        - end loop
        - save array of prepared items to DB

Serializer and Normalizer
-------------------------

One very important concept to know is how we normalize/denormalize relations
between entities and other complex data.

The ``Serializer`` class extends the standard serializer of the |Symfony Serializer component|
and has its own normalizers and denormalizers. Each entity that you want to
export/import should be supported by the serializer. This means that you should
add normalizers and denormalizers that will take care of converting your entity
to the array/scalar representation (normalization during serialization) and
vice versa, converting arrays to the entity object representation (denormalization
during deserialization).

.. sidebar:: ``ConfigurableEntityNormalizer``

    The system can convert a complex array to an object using the
    :method:`Oro\\Bundle\\ImportExportBundle\\Serializer\\Normalizer\\ConfigurableEntityNormalizer::denormalize`
    method:

    .. code-block:: php
        :linenos:

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

    OroPlatform provides two normalizers for :phpclass:`DateTime` objects
    and collections:

    * The :class:`Oro\\Bundle\\ImportExportBundle\\Serializer\\Normalizer\\DateTimeNormalizer`;
    * The :class:`Oro\\Bundle\\ImportExportBundle\\Serializer\\Normalizer\\CollectionNormalizer`.

The platform converts entities to complex arrays for which it uses the
:method:`Oro\\Bundle\\ImportExportBundle\\Serializer\\Normalizer\\ConfigurableEntityNormalizer::normalize`
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
using :class:`annotations <Oro\\Bundle\\EntityConfigBundle\\Metadata\\Annotation\\ConfigField>`:

.. code-block:: php
    :linenos:

     /**
      * @ConfigField(
      *      defaultValues={
      *          "importexport"={
      *              "order"=200,
      *              "full"=true
      *          }
      *      }
      */

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

Import One-to-Many Relations
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
    :linenos:

    "Addresses 1 First name"

``FieldName`` may be a field label or a column name from a configuration field.
You can look it into UI System/Entities/Entity Management. You should import
all identity fields for the related entity.

Import Many-to-One Relations
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
    :linenos:

    "Owner Username"

Extension of Import/Export Contacts
-----------------------------------

Add a New Provider to Support Different Formats
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To write your own provider for import operations, you should create a class
that extends the :class:`Oro\\Bundle\\ImportExportBundle\\Reader\\AbstractReader`
class. To support custom export formats, you just need to create a new class
that implements the |ItemWriterInterface| from the |Akeneo BatchBundle|.
The new classes must be declared as services:

.. code-block:: yaml
    :linenos:

    services:
        oro_importexport.reader.csv:
            class: Acme\DemoBundle\ImportExport\Reader\ExcelFileReader

        oro_importexport.writer.csv:
            class: Oro\Bundle\ImportExportBundle\Writer\CsvFileWriter

Change Import Strategy
^^^^^^^^^^^^^^^^^^^^^^

OroPlatform provides a basic "add or substitute" import strategy. The
basic process is implemented in the ``ConfigurableAddOrReplaceStrategy`` class.
To create your own import strategy you can extend this class and override
the following methods:

* :method:`Oro\\Bundle\\ImportExportBundle\\Strategy\\Import\\ConfigurableAddOrReplaceStrategy::process`
* :method:`Oro\\Bundle\\ImportExportBundle\\Strategy\\Import\\ConfigurableAddOrReplaceStrategy::processEntity`
* :method:`Oro\\Bundle\\ImportExportBundle\\Strategy\\Import\\ConfigurableAddOrReplaceStrategy::updateRelations`
* :method:`Oro\\Bundle\\ImportExportBundle\\Strategy\\Import\\ConfigurableAddOrReplaceStrategy::findExistingEntity`

.. seealso::

    You can see an example of an adapted strategy in the |ContactAddOrReplaceStrategy|
    from the OroCRM ContactBundle.

.. sidebar:: Example: Adding a custom Strategy

    You can see an example of how to add a custom strategy in the ContactBundle
    of OroCRM. The bundle ships with a custom ``ContactAddOrUpdateOrDeleteStrategy``.
    The strategy class implements the following interfaces:

    * :class:`Oro\\Bundle\\ImportExportBundle\\Strategy\\StrategyInterface`
    * :class:`Oro\\Bundle\\ImportExportBundle\\Context\\ContextInterface`
    * :class:`Oro\\Bundle\\ImportExportBundle\\Processor\\EntityNameAwareInterface`

    It is also responsible for validating input data in its ``validateAndUpdateContext()``
    method when contacts are imported. The created class then is declared
    as a service in the ``Resources/config/importexport.yml`` file:

    .. code-block:: yaml
        :linenos:

        # src/Oro/Bundle/ContactBundle/Resources/config/importexport.yml
        services:

            orocrm_contact.importexport.strategy.contact.add_or_replace:
                class: Oro\Bundle\ContactBundle\ImportExport\Strategy\ContactAddOrUpadteOrDeleteStrategy
                parent: oro_importexport.strategy.configurable_add_or_replace
                calls:
                    - [SetRegistry, ["@doctrine"]]

Add Normalizers
---------------

The serializer is involved both in the import and export operations. It is extended from the standard Symfony's `Serializer` and uses the extended `DenormalizerInterface` and `NormalizerInterface` interfaces (with a context support for `supportsNormalization` and `supportsDenormalization`). The serializer's responsibility is to convert the entities to a plain array representation (serialization) and vice versa converting the plain array representation to entity objects (deserialization).

The serializer uses normalizers for the entities that will be imported/exported to perform converting of objects.

The following requirements should be met for the normalizers to implement interfaces:
* **Oro\Bundle\ImportExportBundle\Serializer\Normalizer\NormalizerInterface** - used in export.
* **Oro\Bundle\ImportExportBundle\Serializer\Normalizer\DenormalizerInterface** - used in import.

Generally, you should implement both interfaces if you need to add both import and export for the entity.

**Example of a Simple Normalizer**

.. code-block:: php
   :linenos:

   namespace Oro\Bundle\ContactBundle\ImportExport\Serializer\Normalizer;

   use Oro\Bundle\ImportExportBundle\Serializer\Normalizer\ConfigurableEntityNormalizer;

   use Oro\Bundle\ContactBundle\Entity\Group;

   class GroupNormalizer extends ConfigurableEntityNormalizer
   {
       public function normalize($object, $format = null, array $context = array())
       {
           $result = parent::normalize($object, $format, $context);

           // call some service to modify $result
       }

       public function denormalize($data, $class, $format = null, array $context = array())
       {
           // call some service to modify $data

           return parent::denormalize($data, $class, $format, $context);
       }

       public function supportsNormalization($data, $format = null, array $context = array())
       {
           return $data instanceof Group;
       }

       public function supportsDenormalization($data, $type, $format = null, array $context = array())
       {
           return is_array($data) && $type == 'Oro\Bundle\ContactBundle\Entity\Group';
       }
   }


The serializer of OroImportExportBundle should be aware of its normalizer. To make it possible, use the appropriate tag in the DI configuration:

**Example of Normalizer Service Configuration**

.. code-block:: yaml
   :linenos:

   services:
       orocrm_contact.importexport.normalizer.group:
           class: Oro\Bundle\ContactBundle\ImportExport\Serializer\Normalizer\GroupNormalizer
           parent: oro_importexport.serializer.configurable_entity_normalizer
           tags:
               - { name: oro_importexport.normalizer }



Add Data Converter
------------------

The data converter is responsible for converting the header of the import/export file. Assuming that an entity has some properties to be exposed in the export file. You can use the default `Oro\Bundle\ImportExportBundle\Converter\DefaultDataConverter` Data Converter  however, if there is a necessity to have custom labels instead of the properties names in the export/import files, you can extend `Oro\Bundle\ImportExportBundle\Converter\AbstractTableDataConverter`.

**Example Of a Custom Data Converter**

.. code-block:: php
   :linenos:

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
            return array('ID' => 'id', 'Label' => 'label');
        }

        /**
         * {@inheritDoc}
         */
        protected function getBackendHeader()
        {
            return array('id', 'label');
        }
    }


**Service**

.. code-block:: yaml
   :linenos:

    services:
        oro_contact.importexport.data_converter.group:
            parent: oro_importexport.data_converter.configurable


Export Processor
----------------

Once the normalizers are registered and the data converter is available, you can configure the export settings using the DI configuration.

.. code-block:: yaml
   :linenos:

    services:
        oro_contact.importexport.processor.export_group:
            parent: oro_importexport.processor.export_abstract
            calls:
                 - [setDataConverter, ['@orocrm_contact.importexport.data_converter.group']]
            tags:
                - { name: oro_importexport.processor, type: export, entity: 'Oro\Bundle\ContactBundle\Entity\Group', alias: orocrm_contact_group }


There is a controller in OroImportExportBundle that is used to request a CSV file export. See the controller action, defined in the OroImportExportBundle:ImportExport:instantExport method, route **oro_importexport_export_instant**.

Now, if you send a request to the **/export/instant/orocrm_contact_group** URL  you will receive a response with the URL of the exported file results and some additional information:

.. code-block:: json
   :linenos:

    {
        "success":true,
        "url":"/export/download/orocrm_contact_group_2013_10_03_13_44_53_524d4aa53ffb9.csv",
        "readsCount":3,
        "errorsCount":0
    }


Import Strategy
---------------

The strategy is a class that is responsible for the import logic processing, such as adding new records or updating the existing ones.

**Example of the Import Strategy**

.. code-block:: php
   :linenos:

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
   :linenos:

    services:
        oro_contact.importexport.strategy.contact.add_or_replace:
            class: Oro\Bundle\ContactBundle\ImportExport\Strategy\ContactAddOrReplaceStrategy
            parent: oro_importexport.strategy.configurable_add_or_replace


Import Processor
----------------

Once the normalizers are registered, the data converter is available, and the strategy is implemented, you can configure the import using the following DI configuration.

.. code-block:: yaml
   :linenos:

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


Note, that the import requires a processor for import validation as in the example above.

The import can be done in three steps.

At the first step, a user fills out the form (defined in the OroImportExportBundle:ImportExport:importForm, route "oro_importexport_import_form") in a source file that they want to import and submits it. This action requires the "entity" parameter which is a class name of the imported entity.

At the second step, the import validation action (defined in the OroImportExportBundle:ImportExport:importValidate method, route "oro_importexport_import_validate") is triggered. As a result, all the actions performed by import and all the errors occurred are visible to the user. The records with errors cannot be imported, though the errors do not block further processing of the valid records.

At the last step, the import action (defined in the OroImportExportBundle:ImportExport:importProcess method, route "oro_importexport_import_process") is processed.

Fixture Services
----------------

The fixture implementation is based on the default import/export process.

**Create class:**

.. code-block:: php
   :linenos:

    namespace Oro\Bundle\ContactBundle\ImportExport\TemplateFixture;

    use Oro\Bundle\ImportExportBundle\TemplateFixture\TemplateFixtureInterface;

    use Oro\Bundle\ContactBundle\Entity\Contact;

    class ContactFixture implements TemplateFixtureInterface
    {
        /**
         * @var TemplateFixtureInterface
         */
        protected $userFixture;

        /**
         * @param TemplateFixtureInterface $userFixture
         */
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

            return new \ArrayIterator(array($contact));
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
   :linenos:

    services:
        oro_contact.importexport.template_fixture.contact:
            class: Oro\Bundle\ContactBundle\ImportExport\TemplateFixture\ContactFixture
            tags:
                - { name: oro_importexport.template_fixture }


**Define fixture converter:**

.. code-block:: yaml
   :linenos:

    oro_contact.importexport.template_fixture.data_converter.contact:
        parent: oro_importexport.data_converter.template_fixture.configurable


**Define export processor:**

.. code-block:: yaml
   :linenos:

    oro_contact.importexport.processor.export_template:
        parent: oro_importexport.processor.export_abstract
        calls:
            - [setDataConverter, ['@orocrm_contact.importexport.template_fixture.data_converter.contact']]
        tags:
            - { name: oro_importexport.processor, type: export_template, entity: 'Oro\Bundle\ContactBundle\Entity\Contact', alias: orocrm_contact }


Import and Export UI setup
--------------------------

In order to have the import (and download template) and export buttons displayed on your page, you have to include the buttons generation template from OroImportExportBundle. There are multiple options that can be used to configure the display of these buttons and the pop-ups that can be set to appear in certain cases (export and download template).

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
   :linenos:

    {% include 'OroImportExportBundle:ImportExport:buttons.html.twig' with {
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

In order to display import/export buttons for several entities, you need to create configuration
providers for each entity with options, described in the beginning of the section:

.. code-block:: php
   :linenos:

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

        /**
         * @param TranslatorInterface $translator
         */
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


Provider's service should have a tag with the name `oro_importexport.configuration` and some alias.
The alias is used to group import/export buttons with different configurations on one page:

.. code-block:: yaml
   :linenos:

    oro_product.importexport.configuration_provider.product:
        class: Oro\Bundle\ProductBundle\ImportExport\Configuration\ProductImportExportConfigurationProvider
        arguments:
            - '@translator'
        tags:
            - { name: oro_importexport.configuration, alias: oro_product_index }


To show all import/export buttons on a page, which are defined by configuration providers with an alias,
include following template:

.. code-block:: twig
   :linenos:

    {% include 'OroImportExportBundle:ImportExport:buttons_from_configuration.html.twig' with {
        'alias': 'oro_product_index'
    } %}


**Import pop-up:**

By using the default import configuration (like in the examples above), a user has an import button displayed on the configured page. By clicking this button, a pop-up is displayed and the user needs to input a file for uploading (and validation) as well as selecting the import strategy. As described in the import strategy section, the import process requires
a strategy, but it can also have multiple strategies defined.

Each strategy is used by an import processor, so the strategy has to be passed to the import processor defined for the current entity class. While generating the import pop-up, the framework is searching for the defined import processors for the given entity class and displays them in the selection of strategies.

**Exceptional use cases:**

The basic use case of import/export implies defining an import/export processor for an entity which is used when the user selects the import/export operation from the application.

There are also cases when the export operation needs to extract the data in multiple ways or from multiple entities and you
want to provide different export options to the user. In this situation, you must define multiple export processors which can handle the types of exports that you want to offer to the user.

If multiple export processors are defined for an entity and the user wants to perform an export, the platform displays a pop-up with a possibility to select a required option corresponding to the defined export processors. Depending on the option selected, the corresponding export processor is used. You also have to define translation keys for
the IDs of the processors. These translation keys are used in the selected option in the pop-up.

The same thing is applicable for the export of the templates used for the import. You can have multiple export template processors which are displayed as options in a pop-up when the user wants to download a data template.

*Export processors definition:*

.. code-block:: yaml
   :linenos:

    oro.importexport.processor.export.some_type:
        parent: oro_importexport.processor.export_abstract
        calls:
            - [setDataConverter, ['@oro.importexport.data_converter']]
        tags:
            - { name: oro_importexport.processor, type: export, entity: 'Acme\DemoBundle\Entity\EntityName', alias: oro_some_type }

    oro.importexport.processor.export.another_type:
        parent: oro_importexport.processor.export_abstract
        calls:
            - [setDataConverter, ['@oro.importexport.data_converter']]
        tags:
            - { name: oro_importexport.processor, type: export, entity: 'Acme\DemoBundle\Entity\EntityName', alias: oro_another_type }


*Translation keys for selections in an export pop-up:*

.. code-block:: yaml
   :linenos:

   #messages.en.yml
   oro.importexport.export.oro_some_type: Some export type
   oro.importexport.export.oro_another_type: Some other export type


In this case, you have to specify the processors that can be used as selected options in the pop-up. On the import/export buttons configuration, specify the processors as array, like in the example bellow (**exportProcessors** and/or **exportTemplateProcessors**):

.. code-block:: twig
   :linenos:

    {% include 'OroImportExportBundle:ImportExport:buttons.html.twig' with {
        ...
        exportProcessor: exportProcessors,
        exportTemplateProcessor: exportTemplateProcessors,
        ...
    } %}


**Change an import/export pop-up dialog:**


*Import a pop-up customization:*

To implement custom behaviour of the import pop-up, you can extend the default **ImportType** from OroImportExportBundle and implement a custom form appearance.

.. code-block:: php
   :linenos:

    use Symfony\Component\Form\AbstractTypeExtension;
    use Symfony\Component\Form\FormBuilderInterface;

    use Oro\Bundle\ImportExportBundle\Form\Type\ImportType;

    class CustomImportTypeExtension extends AbstractTypeExtension
    {
        /**
         * {@inheritdoc}
         */
        public static function getExtendedTypes(): iterable
        {
            return [ImportType::NAME];
        }

        /**
         * {@inheritdoc}
         */
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            //TODO: add custom implementation for generating the form
        }
    }


*Export a pop-up customization:*

To display the export/export template options in a different way (other than the default
options selection), you can extend the base types (**ExportType** and **ExportTemplateType**) from the ImportExport bundle. These types are used when displaying the form with options in the pop-up.

Example of displaying the form with choice (radio buttons):

.. code-block:: php
   :linenos:

    use Symfony\Component\Form\AbstractTypeExtension;
    use Symfony\Component\Form\FormBuilderInterface;

    use Oro\Bundle\ImportExportBundle\Form\Type\ExportType;

    class CustomExportTypeExtension extends AbstractTypeExtension
    {
        /**
         * {@inheritdoc}
         */
        public static function getExtendedTypes(): iterable
        {
            return [ExportType::NAME];
        }

        /**
         * {@inheritdoc}
         */
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            //TODO: add custom implementation for generating the form
        }
    }


Storage Configuration
---------------------

OroImportExportBundle uses |KnpGaufretteBundle| to provide a filesystem abstraction layer.

By default, it is configured to store files in the `var/import_export` directory of your project. You can change it in the `Resources/config/oro/app.yml` file. A user can reconfigure these settings. More information about the KnpGaufretteBundle configuration can be found in |KnpGaufretteBundle documentation|.



.. include:: /include/include-links-dev.rst
   :start-after: begin
