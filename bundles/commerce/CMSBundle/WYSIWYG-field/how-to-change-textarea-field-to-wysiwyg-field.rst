.. _how-to-change-textarea-field-to-wysiwyg-field:

How to Change Textarea Field to WYSIWYG Field
=============================================

To turn an existing text field of some entity into a WYSIWYG field:

1. Create a migration that changes the type of the existing column to ``wysiwyg`` and adds 2 new columns to store additional data associated with the WYSIWYG fields using the following types: ``wysiwyg_style`` and ``wysiwyg_properties``.

.. oro_integrity_check:: d66c8f513ce098832effb98dc582dab699a224f0

    .. literalinclude:: /code_examples/commerce/entity_field/wysiwyg/Migrations/Schema/v1_1/UpdateContentField.php
        :language: php
        :linenos:
