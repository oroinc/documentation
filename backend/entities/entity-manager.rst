.. _dev-entities-entity-manager:

Entity Manager
==============

Class |OroEntityManager| is used to extend some native Doctrine Entity Manager functionality. In case any other modifications are required, your class should extend `OroEntityManager` instead of the Doctrine Entity Manager.

**Additional ORM Lifecycle Events**

In addition to standard |Doctrine ORM Lifecycle Events|, the `OroEntityManager` triggers new events:

- *preClose* - The preClose event occurs when the EntityManager#close() operation is invoked, before EntityManager#clear() is invoked.

.. include:: /include/include-links-dev.rst
   :start-after: begin
