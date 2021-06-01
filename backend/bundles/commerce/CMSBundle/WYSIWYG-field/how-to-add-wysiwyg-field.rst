.. _how-to-add-wysiwyg-field:

How to Add WYSIWYG Field
========================

To add a WYSIWYG field to an entity, you should add 3 columns in a migration with the following types: ``wysiwyg``, ``wysiwyg_style``, and ``wysiwyg_properties``.

.. oro_integrity_check:: 8afa284035159852ecf237ba7bba42c25cd5bc55

    .. literalinclude:: /code_examples/commerce/entity_field/wysiwyg/Migrations/Schema/v1_1/AddTeaserField.php
        :language: php
        :linenos:
