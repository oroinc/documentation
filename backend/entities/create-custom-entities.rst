.. _backend-entities-create-custom-entities:

Create Custom Entities
======================

A custom entity is an entity that has no PHP class in any bundle. The definition of such an entity is created automatically in the Symfony cache. To create a custom entity, you can use |ExtendExtension|, as illustrated below:

.. oro_integrity_check:: cf01eeec1f513e6298abd5fc81a76943d23c89a3

   .. literalinclude:: /code_examples/commerce/demo/Migrations/Schema/v1_6/AddCustomEntity.php
       :caption: src/Acme/Bundle/DemoBundle/Migrations/Schema/v1_6/AddCustomEntity.php
       :language: php

Adding fields and relationships to custom entities is the same as for extended entities.
For details, see :ref:`Add Entity Fields <book-entities-extended-entities-add-fields>`
and :ref:`Add Entity Relationships <book-entities-extended-entities-add-relationships>`.


.. include:: /include/include-links-dev.rst
   :start-after: begin
