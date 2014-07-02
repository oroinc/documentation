Import/Export contacts in OroCRM
====================================

**OroImportExportBundle** intended for import / export entities in the Oro Platform. **OroImportExportBundle** uses **OroBatchBundle** 
to organize execution of import/export operations. Any import / export operation is a **Job**. Job is abstract by itself, 
it doesn't know specific details of what is going on during it's execution. Job is process that included **Steps**. 
Job can be configured with execution context and executed by client.

Each step aggregates three crucial components:

* **Reader**
* **Processor**
* **Writer**

Each of them doesn't know of each other. Step uses the reader to read data from source. After reader give data to the processor 
that to change data and give it to writer. Writer save data to other source.

Looks how to work import / export in the **OroCRMContactBundle**. Contact bundle uses **OroImportExportBundle**. You can see 
extended classes from **OroImportExportBundle** in the OroCRM/Bundle/ContactBundle/ImportExport and configuration 
in the ContactBundle\Resources\config\importexport.yml. Import / export has thre operation: import entity to CSV file, 
validate import data and export entity to CSV file, you can look it in the batch jobs 
configuration file  Oro/Bundle/ImportExportBundle/Resources/config/batch_jobs.yml.This configuration is used by **OroBatchBundle**.

Import
------

Import is basic operation for any entities. Import operation consists one step, please look configuration batch job for import:

.. code-block:: yaml

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

Import algorithm:

* Process job:
    * Process step 1:
        * loop
            * read item from source
            * if source is empty exit from loop
            * process item
            * save to array of entities
        * end loop
        * save array of prepared entities to DB

**OroBatchBunlde** has ``Oro\Bundle\BatchBundle\Step\ItemStep`` class that execute step in the job. It is method doExecute() 
that uses ``Oro\Bundle\BatchBundle\Step\StepExecutor`` class and method execute(). Important! Method processes(read and process) by 
one item in the loop. If source is empty loop breaks and write all items, after step is done.

So when you import data (for example for contacts) Reader ``Oro\Bundle\ImportExportBundle\Reader\CsvFileReader`` class gets one row 
from CSV file and return dimensional array $data of fields to Processor ``Oro\Bundle\ImportExportBundle\Processor\ImportProcessor``. 
Reader uses for it method read(). Import processor uses method process() to convert item and serialize result. 
Data Converter ``Oro\Bundle\ImportExportBundle\Converter\ConfigurableTableDataConverter`` class uses method convertToImportFormat($item) 
to convert dimensional array to complex array. After it processor receive one object with all related objects 
and collections of objects from Serializer ``Oro\Bundle\ImportExportBundle\Serializer\Serializer`` class. 
Than processor change object with Strategy ``Oro\Bundle\ImportExportBundle\Strategy\Import\ConfigurableAddOrReplaceStrategy`` class. 
Than processor return object to Writer ``Oro\Bundle\ImportExportBundle\Writer\EntityWriter`` class. Writer stores array of objects 
using method write(array $items).

For example, Import contacts can be done in three user steps (each of them is job).

At the first step user fill out the form with source file that he want to import and submit it. See controller action
OroImportExportBundle:ImportExport:importForm (route "oro_importexport_import_form"), this action require parameter
"entity" which is a class name of entity that will be imported.

At the second step import validation is triggered. See controller action OroImportExportBundle:ImportExport:importValidate
(route "oro_importexport_import_validate"). As a result a user will see all actions that will be performed by import and
errors that were occurred. Records with errors can't be imported but errors not blocks valid records.

At the last step import is processed. See controller action OroImportExportBundle:ImportExport:importProcess
(route "oro_importexport_import_process").

Export
------

Export process are same Import but in other order, but it don't use Strategy. Looks classes that we used for it:

* **Reader** – ``Oro\Bundle\ImportExportBundle\Reader\EntityReader`` class reads one object
* **Processor** – ``Oro\Bundle\ImportExportBundle\Processor\ExportProcessor`` class serializes and converts object to dimensional array
* **Writer** – ``Oro\Bundle\ImportExportBundle\Writer\CsvFileWriter`` class adds all dimensional arrays to CSV file
* **Serializer** -  ``Oro\Bundle\ImportExportBundle\Serializer\Serializer`` class normalizes each field and converts object to complex array
* **Data Converter** - ``Oro\Bundle\ImportExportBundle\Converter\ConfigurableTableDataConverter`` class converts complex array to dimensional array

Import algorithm:

* Process job:
    * Process step 1:
        * loop
            * read entity from DB
            * if source is empty exit from loop
            * process entity
            * ave plain array to array of items for save
        * end loop
        * save array of prepared items to DB

Serializer & Normalizer
-----------------------

Very important part how we normalize/denormalize relations between entities and other complex data.

``Oro\Bundle\ImportExportBundle\Serializer\Serializer`` class that extends from standard Symfony's serializer 
and used instead of it to do serialization/deserialization. Has it's own normalizers/denormalizers. Each entity 
that you want to export/import should be supported by import/export Serializer. It means that you should add normalizers/denormalizers 
that will take care of converting your entity to array/scalar representation (normalization during serialization) and vice verse 
converting array to entity object representation (denormalization during deserialization).

That system can convert complex array to object system should use class 
``Oro\Bundle\ImportExportBundle\Serializer\Normalizer\ConfigurableEntityNormalizer`` and method denormalize:

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

You can see if value is don't scalar(may be collection, datetime or entity) than method call
recursion denormalize method for this value. We don't have recursion circle if entities has relation circle it is checked in Data Converter.

Also platform has normalizers: Oro\Bundle\ImportExportBundle\Serializer\Normalizer\DateTimeNormalizer, 
Oro\Bundle\ImportExportBundle\Serializer\Normalizer\CollectionNormalizer. Other types are scalar and don't need normalizers.

That platform convert entity to complex array, platform uses method normolize from 
class Oro\Bundle\ImportExportBundle\Serializer\Normalizer\ConfigurableEntityNormalizer. Method use Fields Helper to take 
fields and them configure. Method check field configure. If field is excluded then skip field. 
If field is object of another entity or collection then method call normalize method for this type of object. 
If field is scalar method add field value to array. Method return complex array of entity values.

You can setup import/export configure for field into UI System/Entities/Entity Management. 
Or you can setup by default in entity annotations:

.. code-block:: php

     # OroCRM/Bundle/ContactBundle/Entity/Contact.php
     
     ...
     
     * @ConfigField(
     *      defaultValues={
     *          "importexport"={
     *              "order"=200,
     *              "short"=true
     *          }
     *      }
     
     ...

You can setup values:

* identity - if true field is part of key that to identifier instance of entity, required for import
* order - number of field place in export
* excluded - if true skip this field in export
* short - if true normalize method returns only identity fields of relation entity(ies), you can setup short option only 
into entity annotations

If you want import relation One To Many from CSV file you should use field name rules for header column: 
RelationFieldName NumberOfInstance FieldName, where RelationFieldName is string - entity relation name, 
NumberOfInstance is integer, for example "1", FieldName is string. Example: "Addresses 1 First name", where Addresses - entity relation name, 
1 - number of instance, First name - field label. FieldName may be as Field Label or Column Name from config field. 
You can look it into UI System/Entities/Entity Management. You should import all identity fields for related entity.

If you wnat import relation Many To One you should use rule: RelationFieldName IdentityFieldName, where IdentityFieldName - identity field. 
If related entity has two or more identity fields you should import all identity fields for related entity. Example: "Owner Username", where 
Owner - entity relation name, Username - identity field of User entity.

Extension of import/export contacts
-----------------------------------

Changing the example import template file
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To change the import template file, you can do it in the class ``OroCRM\Bundle\ContactBundle\ImportExport\TemplateFixture\ContactFixture``. 

Extension import / export operations
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To change the format of the exported CSV file you need to make class ``OroCRM\Bundle\ContactBundle\ImportExport\Reader\CsvFileReader`` 
extends from  ``Oro\Bundle\ImportExportBundle\Reader\CsvFileReader``. 

You can override the settings:

.. code-block:: php

    protected $delimiter = ','; 
    protected $enclosure = '"'; 
    protected $escape = '\ \'; 
    protected $firstLineIsHeader = true; 

For example, you can change delimiter with ',' on ';': «protected $ delimiter = ';';». Similarly, you can extend class CsvFileWriter.

Adding a new provider that to read/write data from/to files in other formats
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To write your own provider for import operation, you should create the class that inherits 
from ``Oro\Bundle\ImportExportBundle\Reader\AbstractReader``. For example ``OroCRM\Bundle\ContactBundle\ImportExport\Reader\ExcelFileReader``. 
In the case of export, you just need to create a new class that uses the interface ``Akeneo\Bundle\BatchBundle\Item\ItemWriterInterface``.
New classes must declare the file as services OroCRM/Bundle/ContactBundle/Resources/config/importexport.yml:

.. code-block:: yaml

    parameters:
        oro_importexport.reader.csv.class: OroCRM \ Bundle \ ContactBundle \ ImportExport \ Reader \ ExcelFileReader
        oro_importexport.writer.csv.class: OroCRM \ Bundle \ ContactBundle \ ImportExport \ Writer \ ExcelFileWriter

    services:
        oro_importexport.reader.csv:
            class:% oro_importexport.reader.csv.class%

        oro_importexport.writer.csv:
            class:% oro_importexport.writer.csv.class%

Changing strategy
^^^^^^^^^^^^^^^^^^

**OroCRMContactBundle** has one strategy "addition or substitution" to import data, is responsible for the class 
``OroCRM\Bundle\ContactBundle\ImportExport\Strategy\ContactAddOrReplaceStrategy`` that inherits from 
``Oro\Bundle\ImportExportBundle\Strategy\Import\ConfigurableAddOrReplaceStrategy``. You can override the process of updating 
or adding and finding records that need to be replaced in the methods:

* public function process ($ entity)
* protected function processEntity ($ entity, $ isFullData = false, $ isPersistNew = false)
* protected function updateRelations ($ entity, array $ fields)
* protected function findExistingEntity ($ entity, array $ fields).

You can extend the existing process ContactAddOrReplaceStrategy, for example:

.. code-block:: php

    public function process($entity)
    {
        $Entity = parent::process($entity);

        if ($entity) {
            $this
                ->UpdateAddresses($entity);
        }

        return $entity;
    }

Adding strategy
^^^^^^^^^^^^^^^

You can add a new strategy you should create a new class, for example 
``OroCRM\Bundle\ContactBundle\ImportExport\Strategy\ContactAddOrUpdateOrDeleteStrategy``, which uses interfaces: 
``Oro\Bundle\ImportExportBundle\Strategy\StrategyInterface``, ``Oro\Bundle\ImportExportBundle\Context\ContextInterface`` 
and ``Oro\Bundle\ImportExportBundle\Processor\EntityNameAwareInterface``.

Strategy class is also responsible for data validation in the method ``validateAndUpdateContext($entity)`` when you import contacts. 
Created class must declare as a service in the file ``OroCRM/Bundle/ContactBundle/Resources/config/importexport.yml``:

.. code-block:: yaml

    parameters:
        orocrm_contact.importexport.strategy.contact.class: OroCRM \ Bundle \ ContactBundle \ ImportExport \ Strategy \ ContactAddOrUpadteOrDeleteStrategy

    services:

        orocrm_contact.importexport.strategy.contact.add_or_replace:
            class:% orocrm_contact.importexport.strategy.contact.class%
            parent: oro_importexport.strategy.configurable_add_or_replace
            calls:
                - [SetRegistry, [@ doctrine]]

For more information about OroImportExportBundle you can view 
`documentation <https://github.com/orocrm/platform/blob/master/src/Oro/Bundle/ImportExportBundle/Resources/doc/index.md>`_.

