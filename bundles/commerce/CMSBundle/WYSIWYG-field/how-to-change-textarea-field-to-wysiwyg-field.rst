.. _how-to-change-textarea-field-to-wysiwyg-field:

How to Change Textarea Field to WYSIWYG Field
=============================================

To turn an existing text field of some entity into a WYSIWYG field:

1. Create a migration that changes the type of the existing column to ``wysiwyg`` and adds 2 new columns to store additional data associated with the WYSIWYG fields using the following types: ``wysiwyg_style`` and ``wysiwyg_properties``.

.. oro_integrity_check:: e871d7ab46205c70a59ee8a02ac3a19d897ae9e9

    .. literalinclude:: /code_examples/commerce/entity_field/wysiwyg/Migrations/Schema/v1_1/UpdateContentField.php
        :language: php
        :linenos:
