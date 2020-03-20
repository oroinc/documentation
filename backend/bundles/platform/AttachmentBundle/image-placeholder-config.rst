.. _bundle-docs-platform-image-placeholder-config:

Image Placeholder Configuration
===============================

Intro
-----

To define your own entity image placeholder or redefine the existing one, use one of the following three options.

All examples are illustrated for the Product entity, but you can do the same for any other entity. 

There are three services that enable you to set a placeholder for the image that is already defined in the system for the Product entity.


Default Image Placeholder Provider
----------------------------------

Take a look at the |image_placeholder.yml| file on Github.

Perform the following steps to override DefaultImagePlaceholderProvider that is located at the very bottom of this chain:

1. Create an appropriate service definition.

    .. oro_integrity_check:: f29b6549abd6238cbff678a9bf3319d94cf4cdca

        .. literalinclude:: ../../../../code_examples/platform/image_placeholder/demo/Resources/config/services.yml
            :language: yaml
            :lines: 1-2, 15-20
            :linenos:

2. Add your newly created service to the ``oro_product.provider.product_image_placeholder`` chain service.  You can do it via DI CompilerPass.

    .. oro_integrity_check:: 58c6173a55e803851934184406a16d303bacfcb7

        .. literalinclude:: ../../../../code_examples/platform/image_placeholder/demo/DependencyInjection/Compiler/ImagePlaceholderProviderPass.php
            :language: php
            :lines: 3-17, 19-20, 23-27
            :linenos:

Pay attention to the way the chain works. It gets the first suitable value from providers, so we have put our own provider to the very top of the chain via ``ContainerBuilder::setMethodCalls`` and ``array_merge``. You can locate your own provider where required.

Make sure to insert CompilerPass to the bundle root file.

    .. oro_integrity_check:: 863fcd4b086f644f4ddf9fcb9b4a13cd13db2427

        .. literalinclude:: ../../../../code_examples/platform/image_placeholder/demo/ACMEDemoBundle.php
            :language: php
            :lines: 3-18
            :linenos:

Theme Image Placeholder Provider
--------------------------------

The second way to define an image placeholder is to set it on the theme layer. 

To do this, perform the following:

1. Define one more service and name it as ``acme_demo.provider.demo_image_placeholder.theme``. The argument which this service receives is the placeholder name of our placeholder image. You can name this argument the same as the entity name, ``product`` in our case, to avoid any confusion.

    .. oro_integrity_check:: 2ac24197d6a62119c91073a68605bbf727aa746c

        .. literalinclude:: ../../../../code_examples/platform/image_placeholder/demo/Resources/config/services.yml
            :language: yaml
            :lines: 1-2, 9-14
            :linenos:

2. Add the ``acme_demo.provider.demo_image_placeholder.theme`` service definition to CompilerPass.

    .. oro_integrity_check:: 7aaabbe519eb3d88a5e7d1c249b9de1ea95d0294

        .. literalinclude:: ../../../../code_examples/platform/image_placeholder/demo/DependencyInjection/Compiler/ImagePlaceholderProviderPass.php
            :language: php
            :lines: 3, 17-18, 20, 22, 24-25
            :linenos:

3. Create ``theme.yml``

    .. oro_integrity_check:: 053baa3560ef2e4eafe0fbc326aff9abb25eb015

        .. literalinclude:: ../../../../code_examples/platform/image_placeholder/demo/Resources/views/layouts/default/theme.yml
            :language: yaml
            :linenos:

.. note:: Pay attention that the ``product`` key in the YAML file is the value that we have passed to ``acme_demo.provider.demo_image_placeholder.theme`` as the first argument.


Config Image Placeholder Provider
---------------------------------

The third way to define an image placeholder is through the system configuration parameters.

To do this, perform the following:

1. Define one more service with the ``acme_demo.provider.demo_image_placeholder.config`` name. The argument which this service receives is the system configuration key.

2. Define this configuration key in the system. More details on how to do it are described in the |System Configuration| article.

    .. oro_integrity_check:: e0f0d27a96b3445f8e63ccc7d993161cbda17f25

        .. literalinclude:: ../../../../code_examples/platform/image_placeholder/demo/Resources/config/services.yml
            :language: yaml
            :lines: 1-2, 3-8
            :linenos:

3. Add the ``acme_demo.provider.demo_image_placeholder.config`` service definition to CompilerPass.

    .. oro_integrity_check:: ac8ab7028833306161b99ed116551edba5e9fc3c

        .. literalinclude:: ../../../../code_examples/platform/image_placeholder/demo/DependencyInjection/Compiler/ImagePlaceholderProviderPass.php
            :language: php
            :lines: 3, 17-18, 20, 21, 24-25
            :linenos:


TwigExtension and template examples
-----------------------------------

To use the providers we have created previously, we need to create TwigExtension that fetches the Product image in the appropriate dimension or, if the main image is unavailable, provides the placeholder instead. 

    .. oro_integrity_check:: 94efb3d5885a5b0f0acaaf5ca055c3af53c085ee

        .. literalinclude:: ../../../../code_examples/platform/image_placeholder/demo/Twig/ProductImageExtension.php
            :language: php
            :lines: 3-92
            :linenos:

You can use Twig functions declared in the extension for your templates.

    .. oro_integrity_check:: 720664e4d33059416d77280adad786d6148abce1

        .. literalinclude:: ../../../../code_examples/platform/image_placeholder/demo/Resources/views/layouts/default/imports/oro_product_list_item/oro_product_list_item.html.twig
            :language: html+twig
            :linenos:
            
            
 .. include:: /include/include-links-dev.rst
   :start-after: begin
