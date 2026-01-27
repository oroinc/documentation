.. _bundle-docs-platform-address-bundle-commands:

CLI Commands (AddressBundle)
============================

oro:countries:regions:actualize
-------------------------------

The ``oro:countries:regions:actualize`` command actualizes countries and regions data from an external provider.

.. code-block:: none

    php bin/console oro:countries:regions:actualize <filepath> <option>

The ``filepath`` argument is required and specifies the application path where updated data files should be saved (e.g., ``var/data``).

You must select exactly one of the following options:

The ``--update-full-data`` option downloads the external file and uses it to fully update countries and regions data, replacing old codes and names:

.. code-block:: none

    php bin/console oro:countries:regions:actualize var/data --update-full-data

The ``--add-new-data`` option adds only new countries and regions that are absent in the local file:

.. code-block:: none

    php bin/console oro:countries:regions:actualize var/data --add-new-data

The ``--remove-old-data`` option removes countries and regions that exist only in the local file but are absent in the external file:

.. code-block:: none

    php bin/console oro:countries:regions:actualize var/data --remove-old-data

The command creates two files:

* ``countries.yml`` - contains country and region codes (ISO 3166-1 and ISO 3166-2)
* ``entities.en.yml`` - contains translations for country and region names

oro:countries:regions:update-db
-------------------------------

The ``oro:countries:regions:update-db`` command updates countries and regions data in the database based on the actualized YAML files (``countries.yml`` and ``entities.en.yml``).

This command is typically used after running ``oro:countries:regions:actualize`` to apply the changes to the database.

.. code-block:: none

    php bin/console oro:countries:regions:update-db [options]

Data Sources
^^^^^^^^^^^^

By default, the command reads data from the following files:

* **Translation file**: ``@OroAddressBundle/Resources/translations/entities.en.yml`` - contains country and region name translations
* **Countries file**: ``@OroAddressBundle/Migrations/Data/ORM/data/countries.yml`` - contains country and region codes (ISO2, ISO3, combined codes)

You can specify custom file paths using options:

.. code-block:: none

    php bin/console oro:countries:regions:update-db --translation-file=/path/to/entities.en.yml --countries-file=/path/to/countries.yml

Options
^^^^^^^

The ``--force`` option executes the actual database updates. Without this option, the command runs in dry-run mode and only displays the SQL queries that would be executed:

.. code-block:: none

    php bin/console oro:countries:regions:update-db --force

The ``--translation-file`` option specifies a custom path to the translation file:

.. code-block:: none

    php bin/console oro:countries:regions:update-db --translation-file=var/data/entities.en.yml --force

The ``--countries-file`` option specifies a custom path to the countries/regions data file:

.. code-block:: none

    php bin/console oro:countries:regions:update-db --countries-file=var/data/countries.yml --force

Database Tables Affected
^^^^^^^^^^^^^^^^^^^^^^^^

The command modifies the following database tables:

* ``oro_dictionary_country`` - stores country data (ISO2 code, ISO3 code, name)
* ``oro_dictionary_region`` - stores region data (combined code, country code, code, name)
* ``oro_translation_key`` - stores translation keys for new countries/regions
* ``oro_translation`` - stores translation values

Operations Performed
^^^^^^^^^^^^^^^^^^^^

The command performs the following operations:

**Adding New Data**

1. Compares countries from the YAML file with existing database records
2. Inserts new countries into ``oro_dictionary_country`` table
3. Inserts new regions into ``oro_dictionary_region`` table
4. Creates translation keys in ``oro_translation_key`` table for new entries
5. Adds translations to ``oro_translation`` table

**Deleting Old Data (Soft Delete)**

The command uses **soft delete** mechanism - records are not physically removed from the database. Instead, the ``deleted`` flag is set to ``true``:

1. Countries that exist in the database but are absent in the YAML file are marked as deleted (``deleted = true``)
2. Regions that exist in the database but are absent in the YAML file are marked as deleted (``deleted = true``)

.. warning::

    Soft-deleted countries and regions remain in the database but are excluded from queries that filter by ``deleted = false``.

**Updating Existing Translations**

1. Compares country names in the database with names in the translation file
2. Updates ``oro_dictionary_country.name`` if the name has changed
3. Updates corresponding ``oro_translation`` record for the country
4. Performs the same operations for regions in ``oro_dictionary_region`` table

Transaction Handling
^^^^^^^^^^^^^^^^^^^^

All database operations are wrapped in a transaction:

* **With** ``--force`` option: the transaction is committed, and changes are persisted
* **Without** ``--force`` option: the transaction is rolled back, no changes are saved (dry-run mode)

Example Workflow
^^^^^^^^^^^^^^^^

A typical workflow for updating countries and regions data:

1. First, actualize the YAML files from the external source:

   .. code-block:: none

       php bin/console oro:countries:regions:actualize var/data --update-full-data

2. Review the generated files in ``var/data/``:

   * ``countries.yml``
   * ``entities.en.yml``

3. Preview the SQL queries that will be executed (dry-run):

   .. code-block:: none

       php bin/console oro:countries:regions:update-db --countries-file=var/data/countries.yml --translation-file=var/data/entities.en.yml

4. Apply the changes to the database:

   .. code-block:: none

       php bin/console oro:countries:regions:update-db --countries-file=var/data/countries.yml --translation-file=var/data/entities.en.yml --force
