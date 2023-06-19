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

For example:

.. oro_integrity_check:: b20e4f00175c963b7b63e4b7f84352db8a16dbdd

   .. literalinclude:: /code_examples/commerce/demo/DependencyInjection/Compiler/AcmeExtendValidationPass.php
       :caption: src/Acme/Bundle/DemoBundle/DependencyInjection/Compiler/AcmeExtendValidationPass.php
       :language: php
       :lines: 3-29

Make sure to insert CompilerPass to the bundle root file.

.. oro_integrity_check:: d258d55a419883f39277fdf5132a4a701fd66f17

   .. literalinclude:: /code_examples/commerce/demo/AcmeDemoBundle.php
       :caption: src/Acme/Bundle/DemoBundle/AcmeDemoBundle.php
       :language: php
       :lines: 4-5, 7, 9-20, 22, 28-29

Keep in mind that all constraints defined here are applied to all extended fields with a corresponding type.


.. include:: /include/include-links-dev.rst
   :start-after: begin
