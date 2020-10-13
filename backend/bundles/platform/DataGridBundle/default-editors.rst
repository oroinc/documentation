.. _bundle-docs-platform-datagrid-default-editors:


Default Editors
===============

A technical reference to how JS renders different field types when using :ref:`inline editing views <customize-datagrid-extensions-inline-editing>`.

defaultEditors : ``Object``
---------------------------

Maps frontend types to editor views:


* defaultEditors: `Object`

  * .string: `function`
  * .phone: `function`
  * .datetime: `function`
  * .date: `function`
  * .currency: `function`
  * .number: `function`
  * .integer: `function`
  * .decimal: `function`
  * .percent: `function`
  * .select: `function`

defaultEditors.string: ``function``
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

See |text-editor-view| for details.

**Kind**: static property of `defaultEditors`.


defaultEditors.phone:  ``function``
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Please see |text-editor-view| for details.

**Kind**: static property of `defaultEditors`.

defaultEditors.datetime: `function`
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Please see |datetime-editor-view| for details.

**Kind**: static property of `defaultEditors`.

defaultEditors.date: ``function``
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Please see |date-editor-view| for details.

**Kind**: static property of `defaultEditors`.

defaultEditors.currency : ``function``
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Please see number-editor-view for details.

**Kind**: static property of `defaultEditors`.

defaultEditors.number: ``function``
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Please see |number-editor-view| for details.

**Kind**: static property of `defaultEditors`.

defaultEditors.integer: ``function``
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Please see |number-editor-view| for details.

**Kind**: static property of `defaultEditors`.

defaultEditors.decimal: ``function``
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Please see |number-editor-view| for details.

**Kind**: static property of `defaultEditors`.

defaultEditors.percent: ``function``
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Please see |percent-editor-view| for details.

**Kind**: static property of `defaultEditors`.

defaultEditors.select: ``function``
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Please see |select-editor-view| for details.

**Kind**: static property of `defaultEditors`.

.. include:: /include/include-links-dev.rst
   :start-after: begin
