.. _search_index_db_from_md--console-commands:

Console Commands
================

OroSearchBundle provides several console commands to interact with the
search index.

oro:search:index
----------------

This command updates search index for specified entities. The command requires
two arguments - class name (short notation or FQCN) and a list of
identifiers (at least one is required). If the specified entity exists, then the
corresponding search index data will be updated. If it does not, index data
will be removed. This command is used for queued indexation.

Single entity indexation:

.. code-block:: bash

   php bin/console oro:search:index OroUserBundle:User 1
    Started index update for entities.

Multiple entities indexation:

.. code-block:: bash

    php bin/console oro:search:index "Oro\Bundle\ContactBundle\Entity\Contact" 1 2 3 4 5 6 7 8 9 10
    Started index update for entities.

oro:search:reindex
------------------

This command performs full reindexation of all entities. It has one
optional argument that allows to reindex only entities of the specified
type.

Reindexation itself might take a lot of time for a big amount of data, so
it is recommended to run it by schedule (e.g, once a day).

Reindexation of all entities:

.. code-block:: none

    php bin/console oro:search:reindex
    Started reindex task for all mapped entities

Reindexation of one entity:

.. code-block:: bash

    php bin/console oro:search:reindex OroUserBundle:User
    Started reindex task for "OroUserBundle:User" entity

Normally, reindexation is performed immediately after the reindex
command is issued. However, it can also be scheduled to be performed in
the background by the Message Queue consumers.

Advantages of this mode: \* asynchronous \* can be multithreaded \*
scalable

You will need a configured Message Queue and at least one running
consumer worker to use this mode.

Please use the following parameter to enable it:

.. code-block:: bash

    php bin/console oro:search:reindex --scheduled

You can limit the reindexation to a specific entity with the ``--class`` option. Both the FQCN (Oro\Bundle\UserBundle\Entity\User) and short (OroUserBundle:User)
  class names are accepted:

.. code-block:: none

    php bin/console oro:search:reindex --class=<entity>
