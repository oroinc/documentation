.. _dev-sanitize:

Data Sanitization
=================

Data sanitization keeps sensitive data from being exposed when a database is distributed to environments other than the live one, such as a developer's environment.

The sanitization mechanism lets developers define sanitization rules or raw SQL queries for entities and their fields, then dump those definitions as ready-to-use SQL queries. Run these queries against database copies before distributing them to potentially insecure environments.

.. note:: The supported SQL syntax is for PostgreSQL only. The PostgreSQL server will validate the generated SQL queries for syntax errors. No semantic analysis is performed, so the column and table names specified in raw SQL queries are their authors' responsibility.

How to Get a Dump of DB Sanitizing SQL Queries
----------------------------------------------

To get a list of sanitizing SQL queries, run the following command:

.. code-block:: bash

   php bin/console oro:sanitize:dump-sql

This outputs the SQL queries to the console.

To dump directly to a file, pass the file path as a command argument:

.. code-block:: bash

   php bin/console oro:sanitize:dump-sql /tmp/sanitize.sql

The generated dump will look as follows both in the file and in the console:

.. oro_integrity_check:: b81a01f2fca88924d9e0caf24b1c913e6426c914

    .. literalinclude:: /code_examples/commerce/demo/Sanitize/samples/sample_dump.sql
        :language: none
        :lines: 1-

This example truncates the **acme_blog_post** table, reduces the number of records in **acme_demo_question** and **acme_demo_sms**, and hides date information that should not be exposed. It contains only a few queries, which follow the sanitizing configuration described in the `Sanitizing Rules Defined in Files`_ and `Sanitizing Rules Defined in the Entity Configuration`_ topics below.

The full generated list of SQL queries also includes queries built from configurations defined in the core bundles of the Oro application.

.. note:: If the resulting SQL queries contain syntax errors, the customer is notified. Such queries are not written to the file, even if a file is specified; instead, they are output to the console and marked as invalid.

.. note:: If there are any errors in the rule configuration caused by incorrect field or entity names, or if a rule is assigned to a field that it cannot process, then the console output will identify the issues and prevent any queries from being executed.

Sanitizing Rule Sources
-----------------------

You can specify sanitizing rules from two sources.

The first option stores the rule configuration in **sanitize.yml** files, placed in **Resources/config/oro** by convention. The :ref:`bundleless <dev-backend-architecture-bundle-less-structure>` approach is also supported here. When several files configure the same entity or field, the last file read takes precedence.

The second option stores the rule configuration within the entity and its field configuration, in a dedicated scope. This approach is harder to maintain, but it ensures the sanitized configuration is `fixed`. It also takes priority over configuration read from a file.

The file-based approach is easier to maintain and is preferable in most cases. It is also the only option when the database table is not bound to an entity.

Sanitizing Rules Defined in Files
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. oro_integrity_check:: edc83fd105d8d4e1fd974e5f1aca5419064369b9

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/sanitize.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/sanitize.yml
        :language: yaml
        :lines: 1-

The **raw_sqls** node under the **oro_sanitize** node lists sanitizing SQL queries that are not bound to any entity or field.

Items keyed by entity class or table name go under the **entity** node. Each item can have its own **raw_sqls** items, rule definition, and **fields** section. An item can also be a single string value that defines the sanitizing rule, which is equivalent to setting a **rule** value. At least one of **raw_sqls**, **rule**, or **fields** must be set.

The **fields** items are keyed by field or column name. A field element is almost identical to an entity element: it has **raw_sqls** items and a rule definition, and it can also be a single string value that defines the sanitizing rule (equivalent to setting a **rule** value). At least one of **raw_sqls** or **rule** must be set.

The **rule** values are checked against the list of registered rule processors, for both entities and fields.

.. note:: If a file sets the **rule** or **raw_sqls** configuration for an entity or field that another file has already configured, the new configuration overwrites the old one.

Sanitizing Rules Defined in the Entity Configuration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This can be done through schema migration or by defining rules in the entity's configuration annotation.

Example of adding sanitizing rules to the entity configuration via migration:

.. oro_integrity_check:: 8ab46e4bbd6be1d1958a985f31873eda0c7c7d5e

    .. literalinclude:: /code_examples/commerce/demo/Migrations/Schema/v1_12/AddFieldsWithSanitizingRulesMigration.php
        :caption: src/Acme/Bundle/DemoBundle/Migrations/Schema/v1_12/AddFieldsWithSanitizingRulesMigration.php
        :language: php
        :lines: 1-

This example covers creating new ordinary and serialized fields with a sanitizing configuration, and assigning a sanitizing configuration to an existing field. When a rule requires additional setup, add the **rule_options** as well. Note that when updating an existing field, each configuration value you update requires a separate **UpdateEntityConfigFieldValueQuery** instance.

Example of adding sanitizing rules to a newly created entity using a config annotation:

.. oro_integrity_check:: 4c0ef4267dff284c6c4d0c0902580cfbb592a135

    .. literalinclude:: /code_examples/commerce/demo/Entity/Sms.php
        :caption: src/Acme/Bundle/DemoBundle/Entity/Sms.php
        :language: php
        :lines: 3, 5, 57, 12-13, 57, 17-20, 47, 51-52, 57, 56, 57, 71-73, 57, 115

.. note:: Rules are not applied to relations, but only to scalar fields or serialized ones.

Predefined Sanitizing Rules
---------------------------

Predefined rule processors for entities:

* **truncate** --- builds a table truncation query. The rule has no options.
* **truncate_cascade** --- builds a table truncation query with a cascade option. The rule has no options.

Predefined rule processors for fields:

* **date** --- builds a query to replace the field value with the current date. The rule can only be applied to the date field. The rule has no options.
* **md5** --- builds a query to replace a field value with its own MD5 hash, salted with a random value. The rule can only be applied to the string (text, varchar) field. The rule has the **length** option. If none is specified, then the read length of the field is used.
* **email** --- builds a query to replace the email's server name with either an MD5 hashed server name or a custom server name if specified in the application's configuration. Additionally, if the primary key value of the DB record is numeric, the query salts the mailbox name with the key. The rule can only be applied to the string (text, varchar) field. The rule has no options.
* **set_null** --- builds a query to replace a field value with a null. There are no field-type restrictions. The rule has no option.
* **digits_mask** --- builds a query to replace the field value with a **phone** number mask. The mask should look like the following: **1 (800) XXX-XXXX**. The **X** symbol in the mask will be replaced with one of the digits from the random value based on the 10000000 number. The length of the value will correspond to the number of **X** symbols in the mask. The rule can only be applied to the string (text, varchar) field. The rule has a **mask** option, as shown in the example above.
* **generic_phone** --- is a special case of a **digits_mask** rule with a predefined mask specified in the application configuration. The rule has no options.

The Oro application settings example for the **email** and **generic_phone** rules:

.. oro_integrity_check:: 05bc6b90ada0a4d2c325cc9f5a4e2164d5d9e322

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/app.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/app.yml
        :language: php
        :lines: 100-104

Guessing Field Sanitizing Rules
-------------------------------

If a field has no sanitizing rule specified directly, the rule processor's guessing mechanism tries to find one.

The sanitize functionality comes with the following pre-defined field rule processor guessers:

* Email field guesser. It relies on the field's type, which must be a string and its name. The name should be either the word **email** itself or part highlighted with camel case or under case. For example, **email**, **emailSecond**, **email_Third**, **new_email**, or **anotherEmail**. The guessed rule processor is **email**.
* Full name parts guesser. These parts are the middle name and last name. It relies on the **middleName** and **lastName** field names and specific interfaces implemented by the processed entity. The guessed rule processor is **md5**.
* Crypted string field guesser. It relies on the **crypted_string** field type, which is commonly used to extend integration data tables. The guessed rule process is **md5**.

Custom Sanitizing Rule Processor
--------------------------------

When sanitizing involves repeating actions, you can implement a custom sanitizing rule processor instead of writing raw SQL queries.

Custom Entity Sanitizing Rule Processor
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

An example of the entity rule sanitizing processor is keeping the last added rows.

To define a custom rule processor, add a service that implements **Oro\\Bundle\\SanitizeBundle\\RuleProcessor\\Entity\\ProcessorInterface** and has the **oro_sanitize.entity_rule.processor** tag:

.. oro_integrity_check:: 9bd757751e3dbfdbc2826831e5b4711ae3f3eb2a

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/services.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/services.yml
        :language: yaml
        :lines: 2, 112-117

The sanitizing rule implementation:

.. oro_integrity_check:: 205878f925796d5230890f65eeb65aa689c7ebae

    .. literalinclude:: /code_examples/commerce/demo/Sanitize/RuleProcessor/Entity/KeepLastRowsProcessor.php
        :caption: src/Acme/Bundle/DemoBundle/Sanitize/RuleProcessor/Entity/KeepLastRowsProcessor.php
        :language: php
        :lines: 1-

An entity sanitizing rule processor must implement the following routines:

* **getProcessorName** (static method) --- supplies the name of the processor.
* **getSqls** --- returns valid SQL queries for an entity.

Custom Field Sanitizing Rule Processor
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

An example of a field rule sanitizing processor is a simple string reverse action.

To define a custom rule processor, add a service that implements **Oro\\Bundle\\SanitizeBundle\\RuleProcessor\\Field\\ProcessorInterface** and has the **oro_sanitize.field_rule.processor** tag:

.. oro_integrity_check:: 3b51f3c288ada659c7cb73480fd6919dd5eb6127

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/services.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/services.yml
        :language: yaml
        :lines: 2, 119-123

To simplify defining a sanitizing rule processor service, use the parent abstract definition **oro_sanitize.field_rule.generic_processor**, which provides a common setup for dependency injection.

The sanitizing rule implementation:

.. oro_integrity_check:: 45736ebbcbd56a724384fda5d7590291f5eb2de5

    .. literalinclude:: /code_examples/commerce/demo/Sanitize/RuleProcessor/Field/ReverseProcessor.php
        :caption: src/Acme/Bundle/DemoBundle/Sanitize/RuleProcessor/Field/ReverseProcessor.php
        :language: php
        :lines: 1-

A field sanitizing rule processor must implement the following routines:

* **getProcessorName** (static method) --- supplies the name of the processor.
* **getIncompatibilityMessages** --- returns information about incompatibilities.
* **prepareSerialisedFieldUpdate** --- prepares a valid SQL update part for the serialized field.
* **getSqls** --- returns valid SQL queries for scalar fields.

In the example above, the **SerializeFieldCheckerTrait** trait method wraps the **prepareSerialisedFieldUpdate** method. The trait method adds validation to check whether the processed field is serialized. This extra validation is not required; it only guards against misuse of a field rule processor.

You can also reconfigure existing field rule processors using a dedicated wrapping component. Define such processors as follows:

.. oro_integrity_check:: a4e722ef1b06e4775b47e43b0f213c2b37563434

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/services.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/services.yml
        :language: yaml
        :lines: 2, 125-132

This example defines the toll-free phone-like random number generator.

Be sure to name the wrapping processor in the **processor_name** tag property instead of calling the discouraged **getProcessorName** method.
