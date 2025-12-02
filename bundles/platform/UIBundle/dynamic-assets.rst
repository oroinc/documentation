.. _bundle-docs-platform-ui-bundle-dynamic-assets:

Dynamic Assets
==============

Dynamic assets allow you to update assets during the application lifecycle, for example when an administrator configures your website.
In such cases, the asset cache must be properly invalidated. Symfony does not provide this feature out-of-the-box, but the |Asset Component| can be extended to support it.

The following example demonstrates how to add dynamic versioning for any asset package.

For instance, assume that the `acme` asset package should use dynamic versioning.

1. **Register the package** using `Resources/config/oro/app.yml` in your bundle or `config/config.yml`:

   .. code-block:: none

      framework:
          assets:
              packages:
                  acme:
                      version_strategy: 'Oro\Bundle\AssetBundle\VersionStrategy\BuildVersionStrategy'

2. **Set |DynamicAssetVersionStrategy|** for this package:

   .. code-block:: php

       namespace Acme\Bundle\DemoBundle;

       use Symfony\Component\DependencyInjection\ContainerBuilder;
       use Symfony\Component\HttpKernel\Bundle\Bundle;

       use Oro\Bundle\UIBundle\DependencyInjection\Compiler\DynamicAssetVersionPass;

       class DemoBundle extends Bundle
       {
           /**
            * {@inheritdoc}
            */
           public function build(ContainerBuilder $container): void
           {
               parent::build($container);

               $container->addCompilerPass(new DynamicAssetVersionPass('acme'));
           }
       }

   After this, the configuration is complete.

3. **Update the package version** whenever assets change:

   .. code-block:: php

        namespace Acme\Bundle\DemoBundle\Controller;

        use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

        class SomeController extends AbstractController
        {
            public function updateAction()
            {
             // ...

                /** @var Oro\Bundle\UIBundle\Asset\DynamicAssetVersionManager $assetVersionManager */
                $assetVersionManager = $this->container->get('oro_ui.dynamic_asset_version_manager');
                $assetVersionManager->updateAssetVersion('acme');

                // ...
            }

            public static function getSubscribedServices(): array
            {
                return array_merge(
                    parent::getSubscribedServices(),
                    ['oro_ui.dynamic_asset_version_manager' => DynamicAssetVersionManager::class]
                );
            }
        }

Once configured, your assets are used like any other asset, for example via the `asset()` Twig function:

.. code-block:: twig

   {{ asset('test.js', 'acme') }}
   {# the result may be something like this: test.js?version=123-2 #}
   {# where #}
   {# '123' is the static asset version #}
   {# '2' is the dynamic asset version; this number increases each time you call $assetVersionManager->updateAssetVersion('acme') #}

**Important:** The package name must be passed to the `asset()` function.
This tells Symfony that the asset belongs to your package and that the dynamic versioning strategy should be applied.

.. include:: /include/include-links-dev.rst
   :start-after: begin
