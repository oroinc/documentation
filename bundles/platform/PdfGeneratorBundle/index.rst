.. _bundle-docs-platform-pdf-generator-bundle:

OroPdfGeneratorBundle
=====================

OroPdfGeneratorBundle provides the functionality to generate ``PDF documents`` using various ``PDF engines``. The current and only supported engine is |Gotenberg|, which provides a developer-friendly API for seamless PDF conversion via powerful tools like Chromium.

The bundle introduces the entity``\Oro\Bundle\PdfGeneratorBundle\Entity\PdfDocument`` that represents a PDF document, which includes PDF document name, PDF document type, PDF file, etc. It also contains metadata about how the PDF document was generated, i.e., the source entity and payload.


Requirements
------------

OroPdfGeneratorBundle requires the Gotenberg service to be running. You can run it locally using Docker:

.. code-block:: bash

    docker run --rm -it -p 3000:3000 gotenberg/gotenberg:8

.. hint:: For more information about Gotenberg installation and usage , see |Gotenberg website installation|.

The Gotenberg API URL must be specified in the bundle configuration. By default, it is set to `http://127.0.0.1:3000`. You can change it either by setting the environment variable ``ORO_PDF_GENERATOR_GOTENBERG_API_URL`` (the preferred way):

.. code-block:: bash

    export ORO_PDF_GENERATOR_GOTENBERG_API_URL=http://your-gotenberg-url:3000

Or you can set it explicitly in the configuration:

.. code-block:: yaml
   :caption: config/config.yml

    oro_pdf_generator:
        engines:
            gotenberg:
                api_url: 'http://your-gotenberg-url:3000'


.. hint:: You can find more details about the bundle configuration in the :ref:`Configuration <bundle-docs-platform-pdf-generator-bundle-configuration>` section of the documentation.

Before the installation, during the requirements check, the bundle will verify that the Gotenberg service is accessible at the configured URL. If it is not accessible, you will see a warning message in the Optional Recommendations section of the System Requirements check output.

.. hint:: You can check if the Gotenberg service is accessible even after the installation by running the following command:

    .. code-block:: bash

        php bin/console oro:check-requirements -vv


Architecture Overview
---------------------

The bundle is built around 2 main concepts:

* ``PDF file`` - a model that represents the actual PDF file created by a ``PDF builder``. You can use it to generate a PDF file if you do not need to store it in the database, i.e., to generate a PDF file on the fly without creating a ``PDF document`` entity.
* ``PDF document`` - an entity that represents the PDF document created by ``PDF document operator``. It contains the  ``PDF file`` and metadata about how it was generated. You can use it to generate a ``PDF document`` that can be stored in the database, e.g., for later retrieval or download. It can be generated in instant or deferred mode depending on the use case.

For more details about the architecture, see :ref:`Architecture Details <bundle-docs-platform-pdf-generator-bundle-architecture>` .


Gotenberg PDF Engine
--------------------

Gotenberg engine is currently the only supported PDF engine in OroPdfGeneratorBundle. It uses the Gotenberg service to convert HTML to PDF using Chromium.

Gotenberg engine is implemented by the ``\Oro\Bundle\PdfGeneratorBundle\Gotenberg\GotenbergPdfEngine`` class. In order to introduce the Gotenberg API URL as a PDF option, the bundle declares the ``PDF options configurator`` - ``\Oro\Bundle\PdfGeneratorBundle\Gotenberg\GotenbergPdfOptionsPresetConfigurator``.

The engine is configured to use |HTML file into PDF API route of the Gotenberg service|, which means that the bundle sends the HTML content and assets via ``multipart/form-data`` HTTP request to the Gotenberg API. HTML content is rendered from Twig templates. The related assets, i.e., CSS files and images, are automatically collected during the rendering process by ``PDF template renderer``.

.. hint:: For more details about rendering ``PDF templates``, see :ref:`PDF Template Renderer <bundle-docs-platform-pdf-generator-bundle-pdf-template-renderer>` .

.. note:: Take into account the restrictions for header and footer rendering, as assets are not loaded. For more information, see |Gotenberg Documentation: Headers and Footers|.


Related Documentation
---------------------

.. toctree::
    :maxdepth: 1

    Architecture Details <architecture>
    Configuration <configuration>
    Create PDF Document <create-pdf-document>
    Create PDF Document Type <create-pdf-document-type>
    Create PDF File <create-pdf-file>
    Create PDF Options Preset <create-pdf-options-preset>
    Download PDF Document <download-pdf-document>
    PDF Template Renderer <pdf-template-renderer>


.. include:: /include/include-links-dev.rst
    :start-after: begin
