Import/Export Entity Data
=========================

The `OroImportExportBundle`_ is intended to import entities into or export
them out of OroPlatform. The bundle uses the `OroBatchBundle`_ to organize
the execution of import/export operations. Any import/export operation is
a job.

A job itself is abstract. It doesn't know any specific details of what is
happening during its execution. A job consists of steps which can be configured
to run in an execution context and are executed by the client.

Each step aggregates three crucial components which are not aware of each other:

* Reader
* Processor
* Writer

A step uses the reader to read data from the source. After the reader has
run, the data is passed to the processor which can modify the data before
it is forwarded to the writer. Finally, the writer saves data to its final
destination.

.. seealso::

    You can take a look at the code in the OroCRM `ContactBundle`_ for a real
    world example. It extends base classes from the ImportExportBundle (see
    the classes in the `ImportExport namespace`_) to implement contact specific
    behavior. The configuration is located in the `Resources/config/importexport.yml`_
    file.

Import/Export Configuration
---------------------------

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

The Import Process in Detail
----------------------------

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

The Export Process in Detail
----------------------------

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

One very important concept to know is how we normalize/denormalize relations
between entities and other complex data.

The ``Serializer`` class extends the standard serializer of the `Symfony Serializer component`_
and has its own normalizers and denormalizers. Each entity that you want to
export/import should be supported by the serializer. This means that you should
add normalizers and denormalizers that will take care of converting your entity
to the array/scalar representation (normalization during serialization) and
vice versa, converting arrays to the entity object representation (denormalization
during deserialization).

.. sidebar:: The ``ConfigurableEntityNormalizer``

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

The ``ConfigurableEntityNormalizer``
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

The platform converts entities to complex arrays for which it uses the
:method:`Oro\\Bundle\\ImportExportBundle\\Serializer\\Normalizer\\ConfigurableEntityNormalizer::normalize`
method from the ``ConfigurableEntityNormalizer`` class. This method uses the
field helper to process the fields:

* If the field is excluded by the configuration, it will be skipped during
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
      *              "short"=true
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
| ``short``    | If ``true``, the ``normalize()`` method returns only ``identity`` |
|              | fields of associated entities during exports. This option cannot  |
|              | be configured in the user interface, but can only be set using    |
|              | annotations.                                                      |
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

Adding a new Provider to Support different Formats
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To write your own provider for import operations, you should create a class
that extends the :class:`Oro\\Bundle\\ImportExportBundle\\Reader\\AbstractReader`
class. To support custom export formats, you just need to create a new class
that implements the `ItemWriterInterface`_ from the `Akeneo BatchBundle`_.
The new classes must be declared as services:

.. code-block:: yaml
    :linenos:

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

OroPlatform provides a basic "add or substitute" import strategy. The
basic process is implemented in the ``ConfigurableAddOrReplaceStrategy`` class.
To create your own import strategy you can extend this class and override
the following methods:

* :method:`Oro\\Bundle\\ImportExportBundle\\Strategy\\Import\\ConfigurableAddOrReplaceStrategy::process`
* :method:`Oro\\Bundle\\ImportExportBundle\\Strategy\\Import\\ConfigurableAddOrReplaceStrategy::processEntity`
* :method:`Oro\\Bundle\\ImportExportBundle\\Strategy\\Import\\ConfigurableAddOrReplaceStrategy::updateRelations`
* :method:`Oro\\Bundle\\ImportExportBundle\\Strategy\\Import\\ConfigurableAddOrReplaceStrategy::findExistingEntity`

.. seealso::

    You can see an example of an adapted strategy in the `ContactAddOrReplaceStrategy`_
    from the OroCRM ContactBundle.

.. sidebar:: Example: Adding a custom Strategy

    You can see an example of how to add a custom strategy in the ContactBundle
    of the OroCRM. The bundle ships with a custom ``ContactAddOrUpdateOrDeleteStrategy``.
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
        parameters:
            orocrm_contact.importexport.strategy.contact.class: Oro\Bundle\ContactBundle\ImportExport\Strategy\ContactAddOrUpadteOrDeleteStrategy

        services:

            orocrm_contact.importexport.strategy.contact.add_or_replace:
                class: "%orocrm_contact.importexport.strategy.contact.class%"
                parent: oro_importexport.strategy.configurable_add_or_replace
                calls:
                    - [SetRegistry, ["@doctrine"]]

Learn more
----------

Read the `ImportExportBundle documentation`_ for more information.

.. _`OroImportExportBundle`: https://github.com/orocrm/platform/tree/master/src/Oro/Bundle/ImportExportBundle
.. _`OroBatchBundle`: https://github.com/orocrm/platform/tree/master/src/Oro/Bundle/BatchBundle
.. _`ContactBundle`: https://github.com/orocrm/crm/tree/master/src/OroCRM/Bundle/ContactBundle
.. _`ImportExport namespace`: https://github.com/orocrm/crm/tree/master/src/OroCRM/Bundle/ContactBundle/ImportExport
.. _`Resources/config/importexport.yml`: https://github.com/orocrm/crm/blob/master/src/OroCRM/Bundle/ContactBundle/Resources/config/importexport.yml
.. _`Symfony Serializer component`: http://symfony.com/doc/current/components/serializer.html
.. _`ItemWriterInterface`: https://github.com/akeneo/BatchBundle/blob/master/Item/ItemWriterInterface.php
.. _`Akeneo BatchBundle`: https://github.com/akeneo/BatchBundle
.. _`ContactAddOrReplaceStrategy`: https://github.com/orocrm/crm/blob/master/src/OroCRM/Bundle/ContactBundle/ImportExport/Strategy/ContactAddOrReplaceStrategy.php
.. _`ImportExportBundle documentation`: https://github.com/orocrm/platform/blob/master/src/Oro/Bundle/ImportExportBundle/Resources/doc/index.md
