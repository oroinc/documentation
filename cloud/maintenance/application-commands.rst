.. _orocloud-application-commands:

Application Commands
====================

Application Commands
--------------------

Run Console
^^^^^^^^^^^

Run application commands via `orocloud-cli app:console`, for example:

.. code-block:: none

    orocloud-cli app:console oro:user:list
    orocloud-cli app:console oro:search:reindex

To pass a command that contains arguments or options, wrap the command in quotes.

.. code-block:: none

    orocloud-cli app:console "oro:user:list --all"
    orocloud-cli app:console 'oro:search:reindex --scheduled Oro\Bundle\UserBundle\Entity\User'

Spaces and backslashes must be escaped with  ``\``.

.. code-block:: none

    orocloud-cli app:console "oro:user:list --roles=Sale\ Manager"
    orocloud-cli app:console "oro:user:list --roles='Sale Manager'"
    orocloud-cli app:console "oro:user:list --roles=\"Sale Manager\""
    orocloud-cli app:console 'oro:user:list --roles=Sale\ Manager'
    orocloud-cli app:console 'oro:user:list --roles="Sale Manager"'
    orocloud-cli app:console 'oro:search:reindex Oro\Bundle\UserBundle\Entity\User'
    orocloud-cli app:console "oro:search:reindex Oro\\Bundle\\UserBundle\\Entity\\User"
    orocloud-cli app:console "oro:search:reindex Oro\Bundle\UserBundle\Entity\User"

Schema Update
^^^^^^^^^^^^^

.. note:: Be aware that only those consumers that ran before the `orocloud-cli app:schema:update` will run afterward.

Sometimes, you may be required to perform schema update operations. To do this, use the `orocloud-cli app:schema:update` command:

.. code-block:: none

    app:schema:update

Application Cache
^^^^^^^^^^^^^^^^^

.. note:: Be aware that only those consumers that ran before the upgrade will run afterward.

Sometimes, you may be required to clear the application cache (for example, after applying a patch or changing a configuration).
This can be done with the `orocloud-cli app:cache:clear` command that rebuilds the application cache. The command is performed without maintenance mode.

.. code-block:: none

    orocloud-cli app:cache:clear

Cached Translated Values
^^^^^^^^^^^^^^^^^^^^^^^^

:ref:`To add translations to the source code <dev-translation--add-to-source-code>`, run:

.. code-block:: none

    orocloud-cli app:translation:update

API Cache
^^^^^^^^^

:ref:`Warmup API and API doc caches <oroapidoccacheclear-command>`

.. code-block:: none

    orocloud-cli app:cache:api

Consumer
^^^^^^^^

:ref:`To run a consumer for a given queue for two minutes <dev-cookbook-system-mq-consumer>`, run:

.. code-block:: none

    orocloud-cli app:consumer oro.default

Search Reindex
^^^^^^^^^^^^^^

:ref:`To trigger reindexation <search_index_overview>`, run:

.. code-block:: none

    orocloud-cli app:search:reindex

