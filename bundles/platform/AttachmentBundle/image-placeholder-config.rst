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

    .. oro_integrity_check:: f0c09880fa1116a4825ca0a82736b57c0e99f690

        .. literalinclude:: ../../../code_examples/commerce/demo/Resources/config/services.yml
            :language: yaml
            :lines: 1-2, 15-20


2. Add your newly created service to the ``oro_product.provider.product_image_placeholder`` chain service.  You can do it via DI CompilerPass.

    .. oro_integrity_check:: 547f385068c8de1c9568e45143e1b1bd0ad36f8a

        .. literalinclude:: ../../../code_examples/commerce/demo/DependencyInjection/Compiler/ImagePlaceholderProviderPass.php
            :language: php
            :lines: 3-21, 25-32


Pay attention to the way the chain works. It gets the first suitable value from providers, so we have put our own provider to the very top of the chain via ``ContainerBuilder::setMethodCalls`` and ``array_merge``. You can locate your own provider where required.

Make sure to insert CompilerPass to the bundle root file.

    .. oro_integrity_check:: 28b2baa911e5c55eb4a4128b328a12f8bd6d6df4

        .. literalinclude:: ../../../code_examples/commerce/demo/AcmeDemoBundle.php
            :language: php

Theme Image Placeholder Provider
--------------------------------

The second way to define an image placeholder is to set it on the theme layer.

To do this, perform the following:

1. Define one more service and name it as ``acme_demo.provider.demo_image_placeholder.theme``. The argument which this service receives is the placeholder name of our placeholder image. You can name this argument the same as the entity name, ``product`` in our case, to avoid any confusion.

    .. oro_integrity_check:: 2ac24197d6a62119c91073a68605bbf727aa746c

        .. literalinclude:: ../../../code_examples/commerce/demo/Resources/config/services.yml
            :language: yaml
            :lines: 1-2, 9-14


2. Add the ``acme_demo.provider.demo_image_placeholder.theme`` service definition to CompilerPass.

    .. oro_integrity_check:: 9f9fe8f7f810bdd533bbe645eb04a6476ef5648b

        .. literalinclude:: ../../../code_examples/commerce/demo/DependencyInjection/Compiler/ImagePlaceholderProviderPass.php
            :language: php
            :lines: 3, 19-22, 24, 24-27, 23


3. Create ``theme.yml``

    .. oro_integrity_check:: bb2a8417ea2afac9c33a17382665b4015f52d70a

        .. literalinclude:: ../../../code_examples/commerce/demo/Resources/views/layouts/default/theme.yml
            :language: yaml


.. note:: Pay attention that the ``product`` key in the YAML file is the value that we have passed to ``acme_demo.provider.demo_image_placeholder.theme`` as the first argument.


Config Image Placeholder Provider
---------------------------------

The third way to define an image placeholder is through the system configuration parameters.

To do this, perform the following:

1. Define one more service with the ``acme_demo.provider.demo_image_placeholder.config`` name. The argument which this service receives is the system configuration key.

2. Define this configuration key in the system. More details on how to do it are described in the |System Configuration| article.

    .. oro_integrity_check:: e0f0d27a96b3445f8e63ccc7d993161cbda17f25

        .. literalinclude:: ../../../code_examples/commerce/demo/Resources/config/services.yml
            :language: yaml
            :lines: 1-2, 3-8


3. Add the ``acme_demo.provider.demo_image_placeholder.config`` service definition to CompilerPass.

    .. oro_integrity_check:: e53ec650176abf423591bd95c80b3c82f3e48eec

        .. literalinclude:: ../../../code_examples/commerce/demo/DependencyInjection/Compiler/ImagePlaceholderProviderPass.php
            :language: php
            :lines: 3, 19-23, 26-27, 23



TwigExtension and template examples
-----------------------------------

To use the providers we have created previously, we need to create TwigExtension that fetches the Product image in the appropriate dimension or, if the main image is unavailable, provides the placeholder instead.

    .. oro_integrity_check:: 0c40aee96f8e2755556472a20113e90c7352fd79

        .. literalinclude:: ../../../code_examples/commerce/demo/Twig/ProductImageExtension.php
            :language: php
            :lines: 3-70

    .. oro_integrity_check:: 3c0bc2660a66ce70452225a42fb0240172114cd1

        .. literalinclude:: ../../../code_examples/commerce/demo/Resources/config/services.yml
            :language: yaml
            :lines: 1-2, 22-27

You can use Twig functions declared in the extension for your templates.

    .. oro_integrity_check:: efbb826d9642a8ba17afa98a7722d319788941b7

        .. literalinclude:: ../../../code_examples/commerce/demo/Resources/views/layouts/default/imports/oro_product_list_item/oro_product_list_item.html.twig
            :language: html+twig



 .. include:: /include/include-links-dev.rst
   :start-after: begin
