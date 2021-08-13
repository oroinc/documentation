.. _draft-bundle--resolve-draft-conflicts:

How to Resolve Draft Conflicts
==============================

To solve the problem of the table fields' uniqueness for the drafts, you can use the ``draft_uuid`` field to guarantee the uniqueness.

The ``draft_uuid`` field is required and is unique for the draft entity, so it can be used together with other fields.

To ensure the uniqueness of the fields in the database table, change the structure of the database table and use the combined unique keys with the ``draft_uuid`` field.

.. note::
    In case it is impossible to change the structure of the table, you can use the extension as described in the :ref:`How to use draft extensions <draft-bundle--use-draft-extension>` topic.