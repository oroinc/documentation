.. _bundle-docs-platform-email-bundle-templates-rendering-sandbox:

Email Templates Rendering Sandbox
=================================

For security reasons, the |Sandbox mode| is enabled for Email Templates for the Twig Templating Engine.

Available Variables in Email Templates
--------------------------------------

Only a limited set of variables is allowed in email templates:

* a set of system variables
* a set of entity variables (entity object of the entityName class with all its fields if the entity is set to template).

The list of these variables is provided on the Email Template edit page of the admin UI (on the System > Emails > Templates menu item).

Also, additional Twig functions, filters, and tags are registered and allowed to be used in Email Templates. You can find the complete list of these functions, filters, and tags by searching classes inherited from |AbstractTwigSandboxConfigurationPass|. You can also check out the topic on :ref:`Email <user-guide-email-template>`.

Extend Available Data in Email Templates
----------------------------------------

To extend the available data (variables) in email templates, you can create your own variable provider and processor. The variable provider must implement |EntityVariablesProviderInterface| and be registered in the DI container with the `oro_email.emailtemplate.variable_provider` tag. The variable processor must implement |VariableProcessorInterface| and be registered in the DI container with the `oro_email.emailtemplate.variable_processor` tag.

An example:

1. Create a variable provider:

    .. code-block:: php

        class MyVariablesProvider implements EntityVariablesProviderInterface
        {
            public function getVariableDefinitions(string $entityClass = null): array
            {
                return [
                    MyEntity::class => [
                        'someVariable' => [
                            'type'  => RelationType::TO_ONE,
                            'label' => $this->translator->trans('acme.my_entity.some_variable')
                        ]
                    ]
                ];
            }

            public function getVariableGetters(): array
            {
                return [];
            }

            public function getVariableProcessors(string $entityClass): array
            {
                if (MyEntity::class === $entityClass) {
                    return [
                        'someVariable'  => [
                            'processor' => 'my_processor'
                        ]
                    ];
                }

                return [];
            }
        }


2. Create a variable processor:

    .. code-block:: php

        class MyVariableProcessor implements VariableProcessorInterface
        {
            public function process(string $variable, array $processorArguments, TemplateData $data): void
            {
                $someObject = new SomeObject();
                $someObject->setName('test')

                $data->setComputedVariable($variable, $someObject);
            }
        }


3. Register variable provider and processor in the DI container:

    .. code-block:: yaml

        services:
            acme_demo.emailtemplate.my_variable_provider:
                class: Acme\Bundle\DemoBundle\Provider\MyVariablesProvider
                public: false
                tags:
                    - { name: oro_email.emailtemplate.variable_provider, scope: entity }

            acme_demo.emailtemplate.my_variable_processor:
                class: Acme\Bundle\DemoBundle\Provider\MyVariableProcessor
                public: false
                tags:
                    - { name: oro_email.emailtemplate.variable_processor, alias: my_processor }


Another way to extend the available data is to create a Twig function and register it in the Email templates.

Twig environment.

An example:

1. Create a Twig extension:

    .. code-block:: php

        namespace Acme\Bundle\DemoBundle\Twig;

        use Acme\Bundle\DemoBundle\Entity\Some;
        use Twig\Extension\AbstractExtension;
        use Twig\TwigFunction;

        class MyExtension extends AbstractExtension
        {
            #[\Override]
            public function getFunctions(): array
            {
                return [new TwigFunction('some_function', [$this, 'getSomeVariableValue'])];
            }

            /**
             * @param Some $entity
             * @return array
             */
            public function getSomeVariableValue(Some $entity): array
            {
                $result = [];
                foreach ($entity->getProducts() as $product) {
                    $result[] = [
                        'productName' => $product->getName()
                    ];
                }

                return $result;
            }
        }


2. Register the Twig extension in the DI container:

    .. code-block:: yaml

        services:
            acme.twig.my_extension:
                class: Acme\Bundle\DemoBundle\Twig\MyExtension
                public: false
                tags:
                    - { name: twig.extension }


3. Create a DI compiler pass to register the created extension and function in the Email Twig Environment:

    .. code-block:: php

        namespace Acme\Bundle\DemoBundle\DependencyInjection\Compiler;

        use Oro\Bundle\EmailBundle\DependencyInjection\Compiler\AbstractTwigSandboxConfigurationPass;

        class TwigSandboxConfigurationPass extends AbstractTwigSandboxConfigurationPass
        {
            #[\Override]
            protected function getFunctions(): array
            {
                return [
                    'some_function'
                ];
            }

            #[\Override]
            protected function getFilters(): array
            {
                return [];
            }

            #[\Override]
            protected function getTags(): array
            {
                return [];
            }

            #[\Override]
            protected function getExtensions(): array
            {
                return [
                    'acme.twig.my_extension'
                ];
            }
        }


4. Register the created compiler pass:

    .. code-block:: php

        namespace Acme\Bundle\DemoBundle;

        use Acme\Bundle\DemoBundle\DependencyInjection\Compiler\TwigSandboxConfigurationPass;
        use Symfony\Component\DependencyInjection\ContainerBuilder;
        use Symfony\Component\HttpKernel\Bundle\Bundle;

        class AcmeDemoBundle extends Bundle
        {
            #[\Override]
            public function build(ContainerBuilder $container): void
            {
                parent::build($container);

                $container->addCompilerPass(new TwigSandboxConfigurationPass());
            }
        }


Once you complete these steps, the "some_function" Twig function becomes available in Email templates.

.. include:: /include/include-links-dev.rst
    :start-after: begin
