.. _bundle-docs-platform-ui-bundle-persistent-storage:

PersistentStorage
=================

The `persistentStorage` module provides client-side storage capabilities.
It uses `localStorage` if supported by the browser, otherwise, it falls back to cookies.
This module implements the |Storage Interface|, providing a unified API for accessing stored data.

persistentStorage
-----------------

**Kind**: Exported member

Properties and Methods
----------------------

persistentStorage.length : `number`
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Returns the number of data items currently stored in the storage object.

**Kind**: static property of persistentStorage
**Read only**: true

persistentStorage.getItem(sKey) ⇒ `string`
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Retrieves the value associated with the given key.

**Kind**: static method of persistentStorage

.. csv-table::
   :header: "Param","Type"
   :widths: 20, 20

   "sKey","`string`"

persistentStorage.key(nKeyId)
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Returns the name of the nth key in the storage.

**Kind**: static method of persistentStorage

.. csv-table::
   :header: "Param","Type"
   :widths: 20, 20

   "nKeyId","`number`"

persistentStorage.setItem(sKey, sValue)
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Adds a new key/value pair to the storage, or updates the value if the key already exists.

**Kind**: static method of persistentStorage

.. csv-table::
   :header: "Param","Type"
   :widths: 20, 20

   "sKey","`string`"
   "sValue","`string`"

persistentStorage.removeItem(sKey)
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Removes the key/value pair associated with the given key.

**Kind**: static method of persistentStorage

.. csv-table::
   :header: "Param","Type"
   :widths: 20, 20

   "sKey","`string`"

persistentStorage.hasOwnProperty()
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Checks whether the storage object has a specific property.

**Kind**: static method of persistentStorage

persistentStorage.clear()
~~~~~~~~~~~~~~~~~~~~~~~~~

Removes all keys and values from the storage.

**Kind**: static method of persistentStorage

.. include:: /include/include-links-dev.rst
   :start-after: begin