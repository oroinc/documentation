.. _web-api--commands:

CLI Commands
============

.. _oroapidoccacheclear-command:

oro:api:cache:clear
-------------------

This command clears the data API cache.

Usually you need to run this command when you add a new entity to ``Resources/config/oro/api.yml`` or you add a new processor that changes a list of available via the data API.

.. code:: bash

    php bin/console oro:api:cache:clear

oro:api:doc:cache:clear
-----------------------

This command clears or warms up API documentation cache.

If this command is launched without parameters, it warm ups all API documentation caches:

.. code:: bash

    php bin/console oro:api:doc:cache:clear

To clear the cache without then warming it up, use the ``--no-warmup`` option:

.. code:: bash

    php bin/console oro:api:doc:cache:clear --no-warmup

To work only with the specified |API documentation views| use ``--view`` option:

.. code:: bash

    php bin/console oro:api:doc:cache:clear --view=rest_json_api

oro:api:dump
------------

This command shows all resources accessible via the data API.

Run this command without parameters to display all available resources:

.. code:: bash

    php bin/console oro:api:dump

To display resources for a particular request type, specify the ``--request-type`` option:

.. code:: bash

    php bin/console oro:api:dump --request-type=rest --request-type=json_api

To show all available sub-resources, use the ``--sub-resources`` option:

.. code:: bash

    php bin/console oro:api:dump --sub-resources

If you are interested in information about a particular entity, specify an entity class or entity alias as an argument:

.. code:: bash

    php bin/console oro:api:dump "Oro\Bundle\UserBundle\Entity\User" --sub-resources

or

.. code:: bash

    php bin/console oro:api:dump users --sub-resources

To get all entities that are not accessible via the data API, see the ``--not-accessible`` option:

.. code:: bash

    php bin/console oro:api:dump --not-accessible

oro:api:debug
-------------

This command shows details about the registered data API actions and processors.

To display all actions, run this command without parameters:

.. code:: bash

    php bin/console oro:api:debug

To display processors registered for a particular action, run this command with the action name as an argument:

.. code:: bash

    php bin/console oro:api:debug get_list

Use the ``request-type`` option to display the processors related to a particular request type:

.. code:: bash

    php bin/console oro:api:debug get_list --request-type=rest --request-type=json_api

oro:api:config:dump
-------------------

This command shows configuration for a particular entity.

Execute this command with an entity class or entity alias specified as an argument:

.. code:: bash

    php bin/console oro:api:config:dump "Oro\Bundle\UserBundle\Entity\User"

or

.. code:: bash

    php bin/console oro:api:config:dump users

To display the configuration used for a particular action, use the ``--action option`` (please note that the default value for this option is ``get``):

.. code:: bash

    php bin/console oro:api:config:dump users --action=update

To display the configuration for a particular request type, use the ``--request-type`` option:

.. code:: bash

    php bin/console oro:api:config:dump users --request-type=rest --request-type=json_api

To display a configuration of an entity referenced by another entity, use the ``--section`` option:

.. code:: bash

    php bin/console oro:api:config:dump addresses --section=relations

By default no extra configuration data are added into output, but they can be added with the ``--extra`` option. The value for ``extra`` option can be: actions, definition, filters, sorters, descriptions or the full name of a class implements |the ConfigExtraInterface|, e.g.

.. code:: bash

    php bin/console oro:api:config:dump users --extra=filters --extra=sorters

To display the human-readable representation of an entity and its fields:

.. code:: bash

    php bin/console oro:api:config:dump users --extra=descriptions

If a new extra section was added, pass the FQCN of a ConfigExtra:

.. code:: bash

    php bin/console oro:api:config:dump users --extra="Acme\Bundle\AcmeBundle\Config\AcmeConfigExtra"

You can pass multiple options:

.. code:: bash

    php bin/console oro:api:config:dump users --extra=sorters --extra=descriptions --extra=filters --extra="Acme\Bundle\AcmeBundle\Config\AcmeConfigExtra"

oro:api:metadata:dump
---------------------

This command shows metadata for a particular entity.

To display the metadata, run this command with an entity class or entity alias specified as an argument:

.. code:: bash

    php bin/console oro:api:metadata:dump "Oro\Bundle\UserBundle\Entity\User"

or

.. code:: bash

    php bin/console oro:api:metadata:dump users

To display the entity metadata used for a particular action, use the ``--action`` option (please note that the default value for this option is ``get``):

.. code:: bash

    php bin/console oro:api:metadata:dump users --action=update

To display the entity metadata used for a particular request type, use the ``--request-type`` option:

.. code:: bash

    php bin/console oro:api:metadata:dump users --request-type=rest --request-type=json_api

oro:api:config:dump-reference
-----------------------------

This command shows the structure of ``Resources/config/oro/api.yml``.

.. code:: bash

    php bin/console oro:api:config:dump-reference

.. include:: /include/include-links.rst
   :start-after: begin