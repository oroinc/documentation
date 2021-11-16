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

See :ref:`TextEditorView <bundle-docs-platform-form-bundle-edit-text-editor-view>` for details.

**Kind**: static property of `defaultEditors`.


defaultEditors.phone:  ``function``
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Please see :ref:`TextEditorView <bundle-docs-platform-form-bundle-edit-text-editor-view>` for details.

**Kind**: static property of `defaultEditors`.

defaultEditors.datetime: `function`
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Please see :ref:`DatetimeEditorView <bundle-docs-platform-form-bundle-edit-date-time-editor-view>` for details.

**Kind**: static property of `defaultEditors`.

defaultEditors.date: ``function``
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Please see :ref:`DateEditorView <bundle-docs-platform-form-bundle-edit-date-editor-view>` for details.

**Kind**: static property of `defaultEditors`.

defaultEditors.currency : ``function``
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Please see :ref:`NumberEditorView <bundle-docs-platform-form-bundle-number-editor-view>` for details.

**Kind**: static property of `defaultEditors`.

defaultEditors.number: ``function``
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Please see :ref:`NumberEditorView <bundle-docs-platform-form-bundle-number-editor-view>` for details.

**Kind**: static property of `defaultEditors`.

defaultEditors.integer: ``function``
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Please see :ref:`NumberEditorView <bundle-docs-platform-form-bundle-number-editor-view>` for details.

**Kind**: static property of `defaultEditors`.

defaultEditors.decimal: ``function``
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Please see :ref:`NumberEditorView <bundle-docs-platform-form-bundle-number-editor-view>` for details.

**Kind**: static property of `defaultEditors`.

defaultEditors.percent: ``function``
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Please see :ref:`PercentEditorView <bundle-docs-platform-form-bundle-percent-editor-view>` for details.

**Kind**: static property of `defaultEditors`.

defaultEditors.select: ``function``
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Please see :ref:`SelectEditorView <bundle-docs-platform-form-bundle-edit-select-editor-view>` for details.

**Kind**: static property of `defaultEditors`.

