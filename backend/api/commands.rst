:oro_show_local_toc: false

.. _web-api--commands:

CLI Commands
============

.. _oroapidoccacheclear-command:

oro:api:cache:clear
-------------------

This command clears the API cache.

Usually, you need to run this command when you add a new entity to `Resources/config/oro/api.yml` or a new processor that changes a list of available via the API.

.. code-block:: none

    php bin/console oro:api:cache:clear

The ``--no-warmup`` option can be used to skip warming up the cache after cleaning:

.. code-block:: none

    php bin/console oro:api:cache:clear --no-warmup

.. _oroapidoccacheclear:

oro:api:doc:cache:clear
-----------------------

This clears or warms up the API documentation cache.

If this command is launched without parameters, it warm ups all API documentation caches:

.. code-block:: none

    php bin/console oro:api:doc:cache:clear

To clear the cache without then warming it up, use the ``--no-warmup`` option:

.. code-block:: none

    php bin/console oro:api:doc:cache:clear --no-warmup

To work only with the specified |API documentation views| use the ``--view`` option:

.. code-block:: none

    php bin/console oro:api:doc:cache:clear --view=rest_json_api

.. _oroapidump-command:

oro:api:dump
------------

This command shows all resources accessible via the API.

Run this command without parameters to see all available resources:

.. code-block:: none

    php bin/console oro:api:dump

To display resources for a particular request type, specify the ``--request-type`` option:

.. code-block:: none

    php bin/console oro:api:dump --request-type=rest --request-type=json_api

To show all available sub-resources, use the ``--sub-resources`` option:

.. code-block:: none

    php bin/console oro:api:dump --sub-resources

If you are interested in information about a particular entity, specify an entity class or entity alias as an argument:

.. code-block:: none

    php bin/console oro:api:dump "Oro\Bundle\UserBundle\Entity\User" --sub-resources

or

.. code-block:: none

    php bin/console oro:api:dump users --sub-resources

To get all entities that are not accessible via the API, use the ``--not-accessible`` option:

.. code-block:: none

    php bin/console oro:api:dump --not-accessible

To get all entities that support a specific API action, use the ``--action`` option:

.. code-block:: none

    php bin/console oro:api:dump --action=update_list

To get all entities that support :ref:`the upsert operation <web-services-api--upsert-operation>`, use the ``--upsert`` option:

.. code-block:: none

    php bin/console oro:api:dump --upsert

.. _oroapidebug:

oro:api:debug
-------------

This command shows details about registered API actions and processors.

To display all actions, run this command without parameters:

.. code-block:: none

    php bin/console oro:api:debug

To see the processors registered for a given action, specify the action name as an argument:

.. code-block:: none

    php bin/console oro:api:debug <action>

or

.. code-block:: none

    php bin/console oro:api:debug --no-docs <action>

The list of the processors can be limited to some group specified as the second argument:

.. code-block:: none

    php bin/console oro:api:debug <action> <group>

or

.. code-block:: none

    php bin/console oro:api:debug --no-docs <action> <group>

You can use the ``--attribute`` option to show the processors that will be executed only when the context has a given attribute with the specified value.
Separate the attribute name and value by a colon, e.g., ``--attribute=collection:true`` for a scalar value, or ``--attribute=extra:[definition,filters]`` for an array value:

.. code-block:: none

    php bin/console oro:api:debug --attribute=collection:true <action>

or

.. code-block:: none

    php bin/console oro:api:debug --attribute=extra:[definition,filters] <action>

Use the ``--processors` and ``--processors-without-description`` options to display all processors and all processors without descriptions, respectively:

.. code-block:: none

    php bin/console oro:api:debug --processors

or

.. code-block:: none

    php bin/console oro:api:debug --processors-without-description

The ``--request-type`` option can limit the scope to the specified request type(s). Omitting this option is equivalent to ``--request-type=rest --request-type=json_api``. The available types are ``rest``, ``json_api``, ``batch``, or use ``any`` to include all request types:

.. code-block:: none

    php bin/console oro:api:debug --request-type=rest other options and arguments

.. code-block:: none

    php bin/console oro:api:debug --request-type=json_api other options and arguments

.. code-block:: none

    php bin/console oro:api:debug --request-type=batch other options and arguments

.. code-block:: none

    php bin/console oro:api:debug --request-type=any other options and arguments

.. _oroapiconfigdump-command:

oro:api:config:dump
-------------------

This command shows the configuration for a particular entity.

Execute this command with an entity class or entity alias specified as an argument:

.. code-block:: none

    php bin/console oro:api:config:dump "Oro\Bundle\UserBundle\Entity\User"

or

.. code-block:: none

    php bin/console oro:api:config:dump users

To display the configuration used for a particular action, use the ``--action option`` (please note that the default value for this option is ``get``):

.. code-block:: none

    php bin/console oro:api:config:dump users --action=update

To display the configuration for a particular request type, use the ``request-type`` option:

.. code-block:: none

    php bin/console oro:api:config:dump users --request-type=rest --request-type=json_api

No extra configuration data are added to the output by default, but you can add them with the ``--extra`` option. The value for the ``extra`` option can be: actions, definition, filters, sorters, descriptions, or the full name of a class implements |ConfigExtraInterface|, e.g.

.. code-block:: none

    php bin/console oro:api:config:dump users --extra=filters --extra=sorters

To display the human-readable representation of an entity and its fields, use:

.. code-block:: none

    php bin/console oro:api:config:dump users --extra=descriptions

If you added a new extra section, pass the FQCN of a ConfigExtra:

.. code-block:: none

    php bin/console oro:api:config:dump users --extra="Acme\Bundle\DemoBundle\Config\AcmeConfigExtra"

You can pass multiple options:

.. code-block:: none

    php bin/console oro:api:config:dump users --extra=sorters --extra=descriptions --extra=filters --extra="Acme\Bundle\DemoBundle\Config\MyConfigExtra"

.. _oroapimetadatadump-command:

oro:api:metadata:dump
---------------------

This command shows metadata for a particular entity.

To display the metadata, run this command with an entity class or entity alias specified as an argument:

.. code-block:: none

    php bin/console oro:api:metadata:dump "Oro\Bundle\UserBundle\Entity\User"

or

.. code-block:: none

    php bin/console oro:api:metadata:dump users

To display the entity metadata used for a particular action, use the ``--action`` option (please note that the default value for this option is ``get_list``):

.. code-block:: none

    php bin/console oro:api:metadata:dump users --action=update

You can also use the ``--parentAction`` and the ``--action`` options together to display the entity metadata used for an action executed as part of another action. For example, to display the entity metadata used for the ``get`` action executed as part of the ``create`` action, use the following command:

.. code-block:: none

    php bin/console oro:api:metadata:dump users --action=get --parentAction=create

To display the entity metadata used for a particular request type, use the ``--request-type`` option:

.. code-block:: none

    php bin/console oro:api:metadata:dump users --request-type=rest --request-type=json_api

To include the HATEOAS links to the metadata, use the ``--hateoas`` option:

.. code-block:: none

    php bin/console oro:api:metadata:dump --hateoas <entity>

.. _oroapiconfigdumpreference-command:

oro:api:config:dump-reference
-----------------------------

This command shows the structure of `Resources/config/oro/api.yml`.

.. code-block:: none

    php bin/console oro:api:config:dump-reference

You can use the ``--max-nesting-level`` option to limit the depth of nesting target entities:

.. code-block:: none

    php bin/console oro:api:config:dump-reference --max-nesting-level=<number>

.. _web-api--commands--oro-cron-api-async_operations-cleanup:

.. _orocronapiasyncoperationscleanup-command:

oro:cron:api:async_operations:cleanup
-------------------------------------

This command deletes all obsolete asynchronous operations used by Batch API.

.. code-block:: none

    php bin/console oro:cron:api:async_operations:cleanup

To show the number of obsolete asynchronous operations without the deletion of them, use the ``--dry-run`` option:

.. code-block:: none

    php bin/console oro:cron:api:async_operations:cleanup --dry-run

.. include:: /include/include-links-dev.rst
    :start-after: begin
