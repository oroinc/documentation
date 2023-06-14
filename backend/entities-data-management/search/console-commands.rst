.. _search_index_db_from_md--console-commands:

Console Commands
================

OroSearchBundle provides several console commands to interact with the search index.

oro:search:index
----------------

This command updates the search index for specified entities. The command requires two arguments - a class name (short notation or FQCN) and a list of identifiers (at least one is required). The corresponding search index data will be updated if the specified entity exists. If it does not, index data will be removed. This command is used for queued indexation.

Single entity indexation:

.. code-block:: bash

   php bin/console oro:search:index AcmeDemoBundle:Question 1
   Started index update for entities.

Multiple entities indexation:

.. code-block:: bash

    php bin/console oro:search:index "Acme\Bundle\DemoBundle\Entity\Question" 1 2 3 4 5 6 7 8 9 10
    Started index update for entities.

oro:search:reindex
------------------

This command performs full reindexation of all entities. It has one optional argument that allows reindexing only the entities of the specified type.

Reindexation can take a lot of time for a significant amount of data, so running it by schedule (e.g., once a day) is recommended.

Reindexation of all entities:

.. code-block:: none

    php bin/console oro:search:reindex
    Started reindex task for all mapped entities

Reindexation of one entity:

.. code-block:: bash

    php bin/console oro:search:reindex AcmeDemoBundle:Question
    Started reindex task for "AcmeDemoBundle:Question" entity

Typically, reindexation is performed immediately after the reindex command is issued. However, it can also be scheduled to be performed in the background by the Message Queue consumers.

Advantages of this mode: \* asynchronous \* can be multithreaded \* scalable

You will need a configured Message Queue and at least one running consumer worker to use this mode.

Please use the following parameter to enable it:

.. code-block:: bash

    php bin/console oro:search:reindex --scheduled

You can limit the reindexation to a specific entity with the ``--class`` option. Both the FQCN (Acme\\Bundle\\DemoBundle\\Entity\\Question) and short (AcmeDemoBundle:Question) class names are accepted:

.. code-block:: none

    php bin/console oro:search:reindex --class=<entity>
