.. _book-entities-extended-entities-validation-for-fields:

Validation for Extended Fields
------------------------------

By default, all extended fields are not validated. In general, extended fields are rendered as usual forms, the same way as not extended, but there is a way to define validation constraints for all extended fields by their type.

This is done through the configuration of ``oro_entity_extend.validation_loader``:

.. code-block:: yaml

    oro_entity_extend.validation_loader:
        class: Oro\Bundle\EntityExtendBundle\Validator\ExtendFieldValidationLoader
        arguments:
            - '@oro_entity_config.provider.extend'
            - '@oro_entity_config.provider.form'
        calls:
            -
                - addConstraints
                -
                    - integer
                    -
                        - Regex:
                            pattern: '^(-?[1-9]\d*|0)$'
                            message: 'This value should contain only numbers.'

            - [addConstraints, ['percent', [{ Type: {type: 'numeric'} }]]]

There are two ways to pass the constraints:

* use a compiler pass to add the 'addConstraints' call with the necessary constraint configuration
* directly call the service

Keep in mind that all constraints defined here are applied to all extended fields with a corresponding type.


.. include:: /include/include-links-dev.rst
   :start-after: begin
