.. _how-to-change-textarea-field-to-wysiwyg-field:

How to Change TextArea Field to WYSIWYG Field
=============================================

To turn an existing text field of some entity into a WYSIWYG field you should create a migration that will change the type of the existing column to ``wysiwyg`` and will add 2 new columns to store additional data associated with WYSIWYG fields using the following types: ``wysiwyg_style`` and ``wysiwyg_properties``.

.. oro_integrity_check:: a0bcd2b01e4aedfd05caf4f2f45c6462d5cca67f

    .. literalinclude:: /code_examples/commerce/entity_field/wysiwyg/Migrations/Schema/v1_1/UpdateContentField.php
        :language: php
        :linenos:
