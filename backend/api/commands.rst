.. _web-api--commands:

CLI Commands
============

.. _oroapidoccacheclear-command:

oro:api:cache:clear
-------------------

This command command clears the API cache.

Usually you need to run this command when you add a new entity to ``Resources/config/oro/api.yml`` or you add a new processor that changes a list of available via the API.

.. code-block:: bash

    php bin/console oro:api:cache:clear

.. _oroapidoccacheclear:

oro:api:doc:cache:clear
-----------------------

This clears or warms up API documentation cache.

If this command is launched without parameters, it warm ups all API documentation caches:

.. code-block:: bash

    php bin/console oro:api:doc:cache:clear

To clear the cache without then warming it up, use the ``--no-warmup`` option:

.. code-block:: bash

    php bin/console oro:api:doc:cache:clear --no-warmup

To work only with the specified |API documentation views| use ``--view`` option:

.. code-block:: bash

    php bin/console oro:api:doc:cache:clear --view=rest_json_api

oro:api:dump
------------

This command shows all resources accessible via the API.

Run this command without parameters to see all available resources:

.. code-block:: bash

    php bin/console oro:api:dump

To display resources for a particular request type, specify the ``--request-type`` option:

.. code-block:: bash

    php bin/console oro:api:dump --request-type=rest --request-type=json_api

To show all available sub-resources, use the ``--sub-resources`` option:

.. code-block:: bash

    php bin/console oro:api:dump --sub-resources

If you are interested in information about a particular entity, specify an entity class or entity alias as an argument:

.. code-block:: bash

    php bin/console oro:api:dump "Oro\Bundle\UserBundle\Entity\User" --sub-resources

or

.. code-block:: bash

    php bin/console oro:api:dump users --sub-resources

To get all entities that are not accessible via the API, see the ``--not-accessible`` option:

.. code-block:: bash

    php bin/console oro:api:dump --not-accessible

.. _oroapidebug:

oro:api:debug
-------------

This command shows details about registered API actions and processors.

To display all actions, run this command without parameters:

.. code-block:: bash

    php bin/console oro:api:debug

To display processors registered for a particular action, run this command with the action name as an argument:

.. code-block:: bash

    php bin/console oro:api:debug get_list

Use the ``request-type`` option to display the processors related to a particular request type:

.. code-block:: bash

    php bin/console oro:api:debug get_list --request-type=rest --request-type=json_api

oro:api:config:dump
-------------------

This command shows configuration for a particular entity.

Execute this command with an entity class or entity alias specified as an argument:

.. code-block:: bash

    php bin/console oro:api:config:dump "Oro\Bundle\UserBundle\Entity\User"

or

.. code-block:: bash

    php bin/console oro:api:config:dump users

To display the configuration used for a particular action, use the ``--action option`` (please note that the default value for this option is ``get``):

.. code-block:: bash

    php bin/console oro:api:config:dump users --action=update

To display the configuration for a particular request type you can use the ``request-type`` option:

.. code-block:: bash

    php bin/console oro:api:config:dump users --request-type=rest --request-type=json_api

By default no extra configuration data are added into output, but they can be added with the ``--extra`` option. The value for ``extra`` option can be: actions, definition, filters, sorters, descriptions or the full name of a class implements |ConfigExtraInterface|, e.g.

.. code-block:: bash

    php bin/console oro:api:config:dump users --extra=filters --extra=sorters

To display the human-readable representation of an entity and its fields:

.. code-block:: bash

    php bin/console oro:api:config:dump users --extra=descriptions

If a new extra section was added, pass the FQCN of a ConfigExtra:

.. code-block:: bash

    php bin/console oro:api:config:dump users --extra="Acme\Bundle\AcmeBundle\Config\AcmeConfigExtra"

You can pass multiple options:

.. code-block:: bash

    php bin/console oro:api:config:dump users --extra=sorters --extra=descriptions --extra=filters --extra="Acme\Bundle\AcmeBundle\Config\AcmeConfigExtra"

oro:api:metadata:dump
---------------------

This command shows metadata for a particular entity.

To display the metadata, run this command with an entity class or entity alias specified as an argument:

.. code-block:: bash

    php bin/console oro:api:metadata:dump "Oro\Bundle\UserBundle\Entity\User"

or

.. code-block:: bash

    php bin/console oro:api:metadata:dump users

To display the entity metadata used for a particular action, use the ``--action`` option (please note that the default value for this option is ``get``):

.. code-block:: bash

    php bin/console oro:api:metadata:dump users --action=update

To display the entity metadata used for a particular request type, use the ``--request-type`` option:

.. code-block:: bash

    php bin/console oro:api:metadata:dump users --request-type=rest --request-type=json_api

oro:api:config:dump-reference
-----------------------------

This command shows the structure of ``Resources/config/oro/api.yml``.

.. code-block:: bash

    php bin/console oro:api:config:dump-reference

.. _web-api--commands--oro-cron-api-async_operations-cleanup:

oro:cron:api:async_operations:cleanup
-------------------------------------

This command deletes all obsolete asynchronous operations used by Batch API.

.. code-block:: bash

    php bin/console oro:cron:api:async_operations:cleanup

To show the number of obsolete asynchronous operations without the deletion of them, use the ``--dry-run`` option:

.. code-block:: bash

    php bin/console oro:cron:api:async_operations:cleanup --dry-run


.. include:: /include/include-links-dev.rst
   :start-after: begin
