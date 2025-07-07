.. _bundle-docs-platform-pdf-generator-bundle-pdf-template-renderer:

:oro_show_local_toc: false


PDF Template Renderer
=====================

``PDF template renderer`` is responsible for rendering a ``PDF template``. It uses the |TWIG templating engine| and declares its own Twig environment to declare Twig filters and functions specific for PDF generation.

``PDF template`` is a model that contains the Twig template (path or template wrapper) and context, i.e. variables to be passed to the template during rendering. It is implemented by ``\Oro\Bundle\PdfGeneratorBundle\PdfTemplate\PdfTemplate`` class. ``PDF template`` should be created by the ``PDF template factory``.

``PDF template factory`` is a service that creates a ``PDF template`` instance. It is implemented by ``\Oro\Bundle\PdfGeneratorBundle\PdfTemplate\Factory\PdfTemplateFactoryComposite`` class that is actually a composite of the following factories:

* ``\Oro\Bundle\PdfGeneratorBundle\PdfTemplate\Factory\DefaultPdfTemplateFactory`` - generic factory that creates a ``PDF template`` from a Twig template path and context.
* ``\Oro\Bundle\PdfGeneratorBundle\PdfTemplate\Factory\LayoutThemeAwarePdfTemplateFactory`` - creates a ``PDF template`` from a Twig template path and context, but also takes into account the current layout theme. It resolves the ``{{ themeName }}`` placeholder in the path into the current layout theme name. Goes through the hierarchy of current theme to find the existing Twig template. Falls back to "default" theme if the template is not found in the hierarchy of current theme.


PDF Template Assets
-------------------

The bundle introduces a way to collect assets used in the ``PDF template``. This is done by the ``PDF assets collector``  used by the ``PDF assets collector extension``.

``PDF assets collector extension`` is a Twig extension ``\Oro\Bundle\PdfGeneratorBundle\PdfTemplateRenderer\Twig\PdfTemplateAssetsCollectorExtension`` that defines the following Twig functions:

* ``asset()`` - overrides the default ``asset()`` function to collect the assets as ``PDF template assets`` in the ``PDF assets collector``.
* ``filtered_image_url`` - overrides the default ``filtered_image_url`` function to collect the filtered images as ``PDF template assets`` in the ``PDF assets collector``.
* ``resized_image_url`` - overrides the default ``resized_image_url`` function to collect the resized images as ``PDF template assets`` in the ``PDF assets collector``.

``PDF template asset`` is a model that represents an asset used in the ``PDF template``. It can be a CSS file, an image, or any other asset that is used in the HTML content of the PDF document. The generic implementation is ``\Oro\Bundle\PdfGeneratorBundle\PdfTemplateAsset\PdfTemplateAsset``.

.. note:: The ``PDF template asset`` can have inner assets, i.e. included CSS files or fonts.

``PDF assets collector`` is a service that collects and processes the assets. It is implemented by ``\Oro\Bundle\PdfGeneratorBundle\PdfTemplateRenderer\AssetsCollector\PdfTemplateAssetsCollector`` that has the following methods:

* ``getAssets(): array`` - returns the collection of assets where key is an asset name and value is an instance ``\Oro\Bundle\PdfGeneratorBundle\PdfTemplateAsset\PdfTemplateAssetInterface``.
* ``addStaticAsset(string $asset): string`` - adds a static asset to the collection and returns the asset name to use in HTML.
* ``addRawAsset(string $data, string $name): string`` - adds a raw asset to the collection and returns the asset name to use in HTML.
* ``reset(): void`` - resets the collector state.

Under the hood, the ``PDF template collector`` uses the ``PDF template asset factory`` to process and create a ``PDF template asset``. The factory is implemented by ``\Oro\Bundle\PdfGeneratorBundle\PdfTemplateAsset\PdfTemplateAssetFactory`` that is actually a composite of the following asset factories:

* ``\Oro\Bundle\PdfGeneratorBundle\PdfTemplateAsset\PdfTemplateAssetCssFactory`` - creates a ``PDF template asset`` from a CSS file or content. Parses CSS for imported styles, external images and fonts, and adds them as inner assets.
* ``\Oro\Bundle\PdfGeneratorBundle\PdfTemplateAsset\PdfTemplateAssetBasicFactory`` - creates a ``PDF template asset`` from any file or content.

.. hint:: You can create your own implementation of the ``PDF template asset factory`` by creating a class that implements the ``\Oro\Bundle\PdfGeneratorBundle\PdfTemplateAsset\PdfTemplateAssetFactoryInterface`` interface and registering it as a service with the ``oro_pdf_generator.pdf_template_asset.factory`` tag.


.. include:: /include/include-links-dev.rst
    :start-after: begin
