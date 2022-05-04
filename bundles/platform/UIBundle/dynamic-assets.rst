.. _bundle-docs-platform-ui-bundle-dynamic-assets:

Dynamic Assets
==============

You can change assets during an application life cycle, for instance when an administrator is configuring your website. In this case, the assets cache should be busted properly. Symfony does not manage this case out-of-the-box but the |Asset Component| can be easily enhanced to support this feature.

The following samples of code show how to add dynamic versioning for any asset package.

For example, let us assume that `acme` asset package should use the dynamic versioning.

1. First, register the package. Use `Resources/config/oro/app.yml` in your bundle or `config/config.yml`:

   .. code-block:: none

      framework:
          assets:
              packages:
                  acme:
                      version_strategy: 'Oro\Bundle\AssetBundle\VersionStrategy\BuildVersionStrategy'

2. Set |DynamicAssetVersionStrategy| for this package.

   .. code-block:: php

       namespace Acme\Bundle\SomeBundle;

       use Symfony\Component\DependencyInjection\ContainerBuilder;
       use Symfony\Component\HttpKernel\Bundle\Bundle;

       use Oro\Bundle\UIBundle\DependencyInjection\Compiler\DynamicAssetVersionPass;

       class AcmeSomeBundle extends Bundle
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

   The configuration is finished.

3. Update the package version when your assets are changed:

   .. code-block:: php

        namespace Acme\Bundle\SomeBundle\Controller;

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

The usage of your assets is the same as other assets, for example by the well-known `asset()` Twig function:

.. code-block:: twig


   {{ asset('test.js', 'acme') }}
   {# the result may be something like this: test.js?version=123-2 #}
   {# where #}
   {# '123' is the static asset version #}
   {# '2' is the dynamic asset version; this number is increased each time you call $assetVersionManager->updateAssetVersion('acme') #}


Keep in mind that the package name should be passed to the `asset()` function. This tells Symfony that the asset belongs to your package and that dynamic versioning strategy should be applied.

.. include:: /include/include-links-dev.rst
   :start-after: begin
