.. _book-entities-extended-entities-custom-form-type-for-fields:

Define Custom Form Type for Fields
----------------------------------

Extended fields are rendered as HTML controls, and control type (text, textarea, number, checkbox, etc.) is defined by
classes that implement |Symfony FormTypeGuesserInterface|.

In case of extended fields, OroPlatform has three guessers (in decreasing priority): |FormConfigGuesser|, |ExtendFieldTypeGuesser| and |DoctrineTypeGuesser|.

Each provides guesses, and the best guess is selected based on the guesser's confidence (low, medium, high, very high).

There are a few ways to define a custom form type and form options for a particular extended field:

#. Through the compiler pass to add or override the guesser's mappings:

    .. code-block:: php
      :caption: src/Acme/Bundle/DemoBundle/DependencyInjection/Compiler/AcmeExtendGuesserPass.php

        namespace Acme\Bundle\DemoBundle\DependencyInjection\Compiler;

        use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
        use Symfony\Component\DependencyInjection\ContainerBuilder;
        use Symfony\Component\Form\Extension\Core\Type\TimeType;

        class AcmeExtendGuesserPass implements CompilerPassInterface
        {

            public function process(ContainerBuilder $container): void
            {
                $guesser = $container->findDefinition('oro_entity_extend.provider.extend_field_form_type');
                $guesser->addMethodCall(
                    'addExtendTypeMapping',
                    ['time', TimeType::class, ['model_timezone' => "UTC", 'view_timezone' => "UTC"]]
                );
            }
        }

#. With a custom form extend field options provider that can be used for providing form options that need a complex logic and cannot be declared in compiler pass:

    .. code-block:: php
      :caption: src/Acme/Bundle/DemoBundle/Provider/ExtendFieldCustomFormOptionsProvider.php

        class ExtendFieldCustomFormOptionsProvider implements ExtendFieldFormOptionsProviderInterface
        {
            public function getOptions(string $className, string $fieldName): array
            {
                $options = [];
                if ($className == '...' && $fieldName == '...') {
                    $options['custom_option'] = 'custom_value';
                }

                return $options;
            }
        }

    Register it in the dependency injection container:

    .. code-block:: yaml

      services:
          acme.provider.extend_field_form_options:
            class: Acme\Bundle\DemoBundle\Provider\ExtendFieldCustomFormOptionsProvider
            tags:
              - { name: acme_entity_extend.form_options_provider }

#. With a custom guesser that will have higher priority or will provide a guess with the highest confidence value:

    .. code-block:: php
      :caption: src/Acme/Bundle/DemoBundle/Form/Guesser/CustomTypeGuesser/CustomTypeGuesser.php

        class CustomTypeGuesser implements FormTypeGuesserInterface
        {

            public function guessType($className, $property)
            {
                // some conditions here
                if ($className == '...' && $property == '') {
                    $guessedType = '';
                    $options = [...];
                    return new TypeGuess($guessedType, $options, TypeGuess::HIGH_CONFIDENCE);
                }

                // not guessed
                return new ValueGuess(false, ValueGuess::LOW_CONFIDENCE);
            }

            public function guessRequired($class, $property)
            {
                return new ValueGuess(false, ValueGuess::LOW_CONFIDENCE);
            }

            public function guessMaxLength($class, $property)
            {
                return new ValueGuess(null, ValueGuess::LOW_CONFIDENCE);
            }

            public function guessPattern($class, $property)
            {
                return new ValueGuess(null, ValueGuess::LOW_CONFIDENCE);
            }
        }

    Register it in the dependency injection container:

    .. code-block:: yaml

        acme.form.guesser.extend_field:
            class: Acme\Bundle\DemoBundle\Form\Guesser\CustomTypeGuesser
            tags:
                - { name: form.type_guesser, priority: N }

    Here is an idea of what N should be, the existing guessers have the following priorities:

    .. csv-table::
       :header: "Guesser","Priority"
       :widths: 80, 20

       "|FormConfigGuesser|","20"
       "|ExtendFieldTypeGuesser|","15"
       "|DoctrineTypeGuesser|","10"

    Select it according to what you need to achieve.

#. Using annotation to a field or a related entity (if an extended field is an association)

    .. code-block:: php

        /*
         * @Config(
         *      defaultValues={
                    ...
         *          "form"={
         *              "form_type"="Oro\Bundle\UserBundle\Form\Type\UserSelectType",
         *              "form_option"="{option1: ..., ...}"
         *          }
         *      }
         * )
         */


.. include:: /include/include-links-dev.rst
   :start-after: begin
