.. _bundle-docs-platform-ui-bundle-baseclass:

BaseClass
=========

`BaseClass` implements the |Backbone events API|, Chaplin's |declarative event bindings|, and the |Chaplin.EventBroker API|.

Constructor Options
-------------------

.. csv-table::
   :header: "Param","Type","Description"
   :widths: 20, 20, 20

   "options","`Object`","Options container"
   "options.listen","`Object`","Object defining event listeners for this instance"

Properties
----------

- **baseClass.disposed**: `boolean`

  Indicates whether the class instance has been disposed. This flag helps prevent operations on disposed instances.

* **Kind**: instance property of BaseClass


.. include:: /include/include-links-dev.rst
   :start-after: begin