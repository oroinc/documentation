.. _web-api--post-processors:

Post Processors
===============

A post-processor is a data transformer that converts a field value to a format suitable for the API.
Post-processors are used only in the :ref:`get <get-action>`, :ref:`get_list <get-list-action>` and
:ref:`get_subresource <get-subresource-action>` actions.

The following table shows all post processors provided out-of-the-box:

.. csv-table::
   :header: "Name","Description","Options"
   :widths: 10, 35, 55

   "twig","Applies a TWIG template.","**template** *string* - The name of the TWIG template."

All post processors are registered in |PostProcessorRegistry|. You can use it when you need to get a specific post processor in your code.

.. _web-api--post-processors-create:

Creating a New Post Processor
-----------------------------

To create a new post processor, you need to do the following:

1. Create a class that implements |PostProcessorInterface|.

.. code-block:: php

    namespace Acme\Bundle\DemoBundle\Api\PostProcessor;

    use Oro\Bundle\ApiBundle\PostProcessor\PostProcessorInterface;

    class SomePostProcessor implements PostProcessorInterface
    {
        #[\Override]
        public function process(mixed $value, array $options): mixed
        {
        }
    }

2. Register the post-processor in the dependency injection container using the ``oro.api.post_processor`` tag
   with the ``alias`` attribute that contains a unique name of the post-processor:

.. code-block:: yaml

    acme.api.post_processor.some:
        class: Acme\Bundle\DemoBundle\Api\PostProcessor\SomePostProcessor
        tags:
            - { name: oro.api.post_processor, alias: some }

3. Create a :ref:`config extension <web-api--configuration-extensions-create>` if you need to validate
   the post-processor options.

.. code-block:: php

    namespace Acme\Bundle\DemoBundle\Api\PostProcessor;

    use Oro\Bundle\ApiBundle\Util\ConfigUtil;
    use Symfony\Component\Config\Definition\Builder\NodeBuilder;

    class SomePostProcessorConfigExtension extends AbstractConfigExtension
    {
        #[\Override]
        public function getConfigureCallbacks(): array
        {
            return [
                'entities.entity.field'                 => function (NodeBuilder $node) {
                    $this->addValidationOfPostProcessorOptions($node);
                },
                'actions.action.field'                  => function (NodeBuilder $node) {
                    $this->addValidationOfPostProcessorOptions($node);
                },
                'subresources.subresource.action.field' => function (NodeBuilder $node) {
                    $this->addValidationOfPostProcessorOptions($node);
                }
            ];
        }

        /**
         * @param NodeBuilder $node
         */
        private function addValidationOfPostProcessorOptions(NodeBuilder $node): void
        {
            $node->end()->validate()
                ->ifTrue(function ($v) {})
                ->thenInvalid();
        }
    }

4. Register the config extension as a service in the dependency injection container.

.. code-block:: yaml

    acme.api.config_extension.post_processor.some:
        class: Acme\Bundle\DemoBundle\Api\PostProcessor\SomePostProcessorConfigExtension

5. Register the config extension in `Resources/config/oro/app.yml` in your bundle
   or `config/config.yml` of your application.

.. code-block:: yaml

    oro_api:
        config_extensions:
            - acme.api.config_extension.post_processor.some


.. include:: /include/include-links-dev.rst
   :start-after: begin
