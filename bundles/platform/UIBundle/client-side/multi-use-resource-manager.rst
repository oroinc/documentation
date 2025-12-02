:oro_show_local_toc: false

.. _bundle-docs-platform-ui-bundle-multi-use-resource-manager:

MultiUseResourceManager ⇐ BaseClass
====================================

The `MultiUseResourceManager` provides a mechanism to create and manage resources that can be shared among multiple holders.
It ensures that the resource is created when at least one holder exists and disposed only when all holders release it.

Use Case
--------

.. code-block:: javascript

    var backdropManager = new MultiUseResourceManager({
        listen: {
            'constructResource': function() {
                $(document.body).addClass('backdrop');
            },
            'disposeResource': function() {
                $(document.body).removeClass('backdrop');
            }
        }
    });

    // 1. Using IDs
    var holderId = backdropManager.hold();
    // then somewhere
    backdropManager.release(holderId);

    // 2. Using a holder object
    backdropManager.hold(this);
    // then somewhere, note that the same object reference must be provided
    backdropManager.release(this);

    // 3. Using a holder identifier
    backdropManager.hold(this.cid);
    // then somewhere, note that the same identifier must be provided
    backdropManager.release(this.cid);

**Extends:** :ref:`BaseClass <bundle-docs-platform-ui-bundle-baseclass>`

Properties
----------

multiUseResourceManager.counter : `number`
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Holders counter tracking the number of current resource holders.

**Kind**: instance property of MultiUseResourceManager
**Access:** protected

multiUseResourceManager.isCreated : `boolean`
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Indicates whether the resource has been created.

**Kind**: instance property of MultiUseResourceManager

multiUseResourceManager.holders : `Array`
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Array containing the identifiers of current resource holders.

**Kind**: instance property of MultiUseResourceManager

Constructor
-----------

multiUseResourceManager.constructor()
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

**Kind**: instance method of MultiUseResourceManager

Methods
-------

multiUseResourceManager.hold(holder) ⇒ `*`
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Registers a holder and creates the resource if needed.

**Kind**: instance method of MultiUseResourceManager
**Returns**: `*` - the holder identifier

.. csv-table::
   :header: "Param","Type","Description"
   :widths: 20, 20, 20

   "holder","`*`","Identifier of the holder (object, ID, or reference)"

multiUseResourceManager.release(id)
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Releases a holder and disposes the resource if no holders remain.

**Kind**: instance method of MultiUseResourceManager

.. csv-table::
   :header: "Param","Type","Description"
   :widths: 20, 20, 20

   "id","`*`","Identifier of the holder to release"

multiUseResourceManager.isReleased(id) ⇒ `boolean`
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Returns `true` if the specified holder has already released the resource.

**Kind**: instance method of MultiUseResourceManager

.. csv-table::
   :header: "Param","Type","Description"
   :widths: 20, 20, 20

   "id","`*`","Identifier of the holder"

multiUseResourceManager.checkState()
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Checks the current state of the resource, creating or disposing it if necessary.

**Kind**: instance method of MultiUseResourceManager
**Access:** protected

multiUseResourceManager.dispose()
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Forces disposal of the resource and clears all holders.

**Kind**: instance method of MultiUseResourceManager

