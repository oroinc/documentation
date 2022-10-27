.. _bundle-docs-platform-ui-bundle-persistent-storage:

PersistentStorage
=================

persistentStorage
-----------------

Provides clint-side storage. Uses localStorage if supported, otherwise uses cookies. Realizes |Storage Interface|.

**Kind**: Exported member

persistentStorage.length : `number`
-----------------------------------

Returns an integer representing the number of data items stored in the Storage object.

**Kind**: static property of persistentStorage
**Read only**: true

persistentStorage.getItem(sKey) ⇒ `string`
------------------------------------------

When passed a key name, will return that key's value.

**Kind**: static method of persistentStorage

.. csv-table::
   :header: "Param","Type"
   :widths: 20, 20

   "sKey","`string`"

persistentStorage.key(nKeyId)
-----------------------------

When passed a number n, this method will return the name of the nth key in the storage.

**Kind**: static method of persistentStorage

.. csv-table::
   :header: "Param","Type"
   :widths: 20, 20

   "nKeyId","`number`"


persistentStorage.setItem(sKey, sValue)
---------------------------------------

When passed a key name and value, will add that key to the storage, or update that key's value if it
already exists.

**Kind**: static method of persistentStorage

.. csv-table::
   :header: "Param","Type"
   :widths: 20, 20

   "sKey","`string`"
   "sValue","`string`"

persistentStorage.removeItem(sKey)
----------------------------------

When passed a key name, will remove that key from the storage.

**Kind**: static method of persistentStorage

.. csv-table::
   :header: "Param","Type"
   :widths: 20, 20

   "sKey ","`string`"

persistentStorage.hasOwnProperty()
----------------------------------

**Kind**: static method of persistentStorage

persistentStorage.clear()
-------------------------

When invoked, will empty all keys out of the storage.

**Kind**: static method of persistentStorage

.. include:: /include/include-links-dev.rst
   :start-after: begin