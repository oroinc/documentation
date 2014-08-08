Import/Export Entity Data
=========================

OroImportExportBundle is intended to import/export entities into or out of
the Oro Platform. OroImportExportBundle uses OroBatchBundle to organize the
execution of import/export operations. Any import/export operation is a job.
A job itself is abstract. It doesn't know any specific details of what is
going on during its execution. A job consists of steps. They can be configured
to run in an execution context and are executed by the client.

Each step aggregates three crucial components:

* Reader
* Processor
* Writer

These components don't know each other. A step uses the reader to read data
from the source. After the reader has run, the data is passed to the processor
which can modify the data before it is forwarded to the writer. Finally, the
writer saves data to its final destination.

.. seealso::

    You can have a look at the code in the OroCRM `ContactBundle`_ for a real
    world example. It extends base classes from the ImportExportBundle (see
    the classes in the `ImportExport namespace`_) to implement contact specific
    behavior. The configuration is located in the `Resources/config/importexport.yml`_
    file.

Import/Export Configuration
---------------------------

Import is a basic operation for any entity. The import operation is one step.
See the following example configuration:

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

The OroBatchBundle provides the ``Oro\Bundle\BatchBundle\Step\ItemStep`` class
that executes each step of a job. In its ``execute()`` method it creates an
``Oro\Bundle\BatchBundle\Step\StepExecutor`` instance, passes reader, processor
and writer to it and runs it ``execute()`` method. After the step is done,
all imported items are written to the destination.

The Import Process in Detail
----------------------------

For example, here is what is going on in detail when you are going to import
contact data from a CSV file:

#. The ``Oro\Bundle\ImportExportBundle\Reader\CsvFileReader`` reader reads
   one row from the CSV file in its ``read()`` method and transforms it to
   an array representing the columns of that row.

#. The data being read is then passed to the ``process()`` method of the
   ``Oro\Bundle\ImportExportBundle\Processor\ImportProcessor`` class which
   converts the item to a complex array using the ``convertToImportFormat``
   method of the ``Oro\Bundle\ImportExportBundle\Converter\ConfigurableTableDataConverter``
   data converter class.

#. The processor deserializes the item from the converted array using the
   ``Oro\Bundle\ImportExportBundle\Serializer\Serializer`` class.

#. Optionally, the deserialized object can then be modified by the
   ``Oro\Bundle\ImportExportBundle\Strategy\Import\ConfigurableAddOrReplaceStrategy``
   class.

#. At last, the processed entity is returned by the processor and then passed
   to the ``Oro\Bundle\ImportExportBundle\Writer\EntityWriter`` class. This
   writer stores the data when its ``write()`` method is executed.

.. sidebar:: The Import Process in the User Interface

    The user interface separates the import process for the ContactBundle
    in three steps:

    * At the first step, the user selects the source file that he want to
      import in a form and submits it (have a look at the ``importForm()``
      controller action, it is configured by the ``oro_importexport_import_form``
      route). This action requires an "entity" parameter which is the class
      name of the entity that will be imported.

    * At the second step, import validation is triggered (see the ``importValidate()``
      controller action, configured by the ``oro_importexport_import_validate``
      route). As a result, the user will be presented all actions that will
      be performed by the import and errors that have been occurred in the
      previous step. Records with errors can't be imported, but errors do
      not block valid records.

    * At the last step, the import is processed (see the ``importProcess``
      controller action, it is configured by the ``oro_importexport_import_process``
      route).

The Export Process in Detail
----------------------------

The export process is basically the reversed import process except that it
doesn't use a strategy:

#. First, the ``Oro\Bundle\ImportExportBundle\Reader\EntityReader`` class reads
   an object;

#. Then, the ``Oro\Bundle\ImportExportBundle\Processor\ExportProcessor`` class
   serializes and converts the object into an associative array with property
   names as keys and the property values as values of the array;

#. Serializer:  ``Oro\Bundle\ImportExportBundle\Serializer\Serializer`` class
   normalizes each field and converts object to complex array;

#. A data converter (``Oro\Bundle\ImportExportBundle\Converter\ConfigurableTableDataConverter``)
   converts the associative array into a dimensional array.

#. Finally, all array entries are written to a CSV file by the
   ``Oro\Bundle\ImportExportBundle\Writer\CsvFileWriter`` class;

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

Serializer & Normalizer
-----------------------

Very important part how we normalize/denormalize relations between entities
and other complex data.

The ``Oro\Bundle\ImportExportBundle\Serializer\Serializer`` class extends
the standard serializer of the `Symfony Serializer component`_ and has its
own normalizers and denormalizers. Each entity that you want to export/import
should be supported by the serializer. That means that you should add normalizers
and denormalizers that will take care of converting your entity to the array/scalar
representation (normalization during serialization) and vice versa converting
arrays to the entity object representation (denormalization during deserialization).

.. sidebar:: The ``ConfigurableEntityNormalizer``

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

    If a value is not a scalar value, the recursively denormalizes its value.
    The data converter checks for circular dependencies to avoid endless recursions
    here.

.. sidebar:: Normalizer in the Oro Platform

    The Oro Platform provides two normalizers for ``DateTime`` objects and
    collections:

    * The `DateTimeNormalizer`_;
    * The `CollectionNormalizer`_.

The ``ConfigurableEntityNormalizer``
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

The platform converts entities to complex arrays for which it uses ``normalize()``
from the ``Oro\Bundle\ImportExportBundle\Serializer\Normalizer\ConfigurableEntityNormalizer``
class. This method uses the field helper to process the fields:

* If the field is excluded by the configuration, then it is skipped during
  the normalization;

* If the field is an object, another entity or a collection, the ``normalize()``
  method for this type of object is called;

* If the field is a scalar value, the field is added with this value to the
  array of normalized values.

You can configure your fields in the UI under *System*/*Entities*/*Entity Management*.
Alternatively, you can describe the field configuration in your entity directly
using annotations::

     /**
      * @ConfigField(
      *      defaultValues={
      *          "importexport"={
      *              "order"=200,
      *              "short"=true
      *          }
      *      }
      */

You can use the following options:

+--------------+-------------------------------------------------------------------+
| Option       | Description                                                       |
+==============+===================================================================+
| ``identity`` | If ``true``, the field is part of the key used to identify        |
|              | an instance of the entity. It is required to configure the        |
|              | object identity to support imports.                               |
+--------------+-------------------------------------------------------------------+
| ``order``    | The position of the property in the export.                       |
+--------------+-------------------------------------------------------------------+
| ``excluded`` | The skip is field during export if ``excluded`` is ``true``.      |
+--------------+-------------------------------------------------------------------+
| ``short``    | If ``true``, the ``normalize()`` method returns only ``identity`` |
|              | fields of associated entities during exports. This option         |
|              | cannot be configured in the user interface, but can only be set   |
|              | using annotations.                                                |
+--------------+-------------------------------------------------------------------+

Importing one-to-many Relations
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

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
You can look it into UI System/Entities/Entity Management. You should import
all identity fields for the related entity.

Importing many-to-one Relations
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

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

Adding a new Provider to Support different Forms
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To write your own provider for import operations you should create a class
that extends the ``Oro\Bundle\ImportExportBundle\Reader\AbstractReader`` class.
To support custom export formats, you just need to create a new class that
implements the ``Akeneo\Bundle\BatchBundle\Item\ItemWriterInterface``. The
new classes must declared as services:

.. code-block:: yaml

    parameters:
        oro_importexport.reader.csv.class: Acme\DemoBundle\ImportExport\Reader\ExcelFileReader
        oro_importexport.writer.csv.class: Acme\DemoBundle\ImportExport\Writer\ExcelFileWriter

    services:
        oro_importexport.reader.csv:
            class: "%oro_importexport.reader.csv.class%"

        oro_importexport.writer.csv:
            class: "%oro_importexport.writer.csv.class%"

Changing the Strategy
~~~~~~~~~~~~~~~~~~~~~

The Oro Platform provides a basic "add or substitute" import strategy. The
basic process is implemented in the ``Oro\Bundle\ImportExportBundle\Strategy\Import\ConfigurableAddOrReplaceStrategy``
class. To create your own import strategy, you can extend this class and override
the following methods:

* ``public function process($entity)``
* ``protected function processEntity($entity, $isFullData = false, $isPersistNew = false)``
* ``protected function updateRelations($entity, array $fields)``
* ``protected function findExistingEntity($entity, array $fields)``

.. seealso::

    You can see an example of an adapted strategy in the `ContactAddOrReplaceStrategy`_
    from the OroCRM ContactBundle.

Adding a Strategy
~~~~~~~~~~~~~~~~~

You can add a new strategy you should create a new class, for example
``OroCRM\Bundle\ContactBundle\ImportExport\Strategy\ContactAddOrUpdateOrDeleteStrategy``, which uses interfaces:
``Oro\Bundle\ImportExportBundle\Strategy\StrategyInterface``, ``Oro\Bundle\ImportExportBundle\Context\ContextInterface``
and ``Oro\Bundle\ImportExportBundle\Processor\EntityNameAwareInterface``.

Strategy class is also responsible for data validation in the method ``validateAndUpdateContext($entity)`` when you import contacts.
Created class must declare as a service in the file ``OroCRM/Bundle/ContactBundle/Resources/config/importexport.yml``:

.. code-block:: yaml

    parameters:
        orocrm_contact.importexport.strategy.contact.class: OroCRM\Bundle\ContactBundle\ImportExport\Strategy\ContactAddOrUpadteOrDeleteStrategy

    services:

        orocrm_contact.importexport.strategy.contact.add_or_replace:
            class: "%orocrm_contact.importexport.strategy.contact.class%"
            parent: oro_importexport.strategy.configurable_add_or_replace
            calls:
                - [SetRegistry, ["@doctrine"]]


For more information about OroImportExportBundle you can view
`documentation <https://github.com/orocrm/platform/blob/master/src/Oro/Bundle/ImportExportBundle/Resources/doc/index.md>`_.

.. _`ContactBundle`: https://github.com/orocrm/crm/tree/master/src/OroCRM/Bundle/ContactBundle
.. _`ImportExport namespace`: https://github.com/orocrm/crm/tree/master/src/OroCRM/Bundle/ContactBundle/ImportExport
.. _`Resources/config/importexport.yml`: https://github.com/orocrm/crm/blob/master/src/OroCRM/Bundle/ContactBundle/Resources/config/importexport.yml
.. _`Symfony Serializer component`: http://symfony.com/doc/current/components/serializer.html
.. _`DateTimeNormalizer`: https://github.com/orocrm/platform/blob/master/src/Oro/Bundle/ImportExportBundle/Serializer/Normalizer/DateTimeNormalizer.php
.. _`CollectionNormalizer`: https://github.com/orocrm/platform/blob/master/src/Oro/Bundle/ImportExportBundle/Serializer/Normalizer/CollectionNormalizer.php
.. _`ContactAddOrReplaceStrategy`: https://github.com/orocrm/crm/blob/master/src/OroCRM/Bundle/ContactBundle/ImportExport/Strategy/ContactAddOrReplaceStrategy.php
