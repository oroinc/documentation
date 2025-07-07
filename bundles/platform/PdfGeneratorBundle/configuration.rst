:oro_show_local_toc: false

.. _bundle-docs-platform-pdf-generator-bundle-configuration:

Configuration
=============

The default configuration of OroPdfGeneratorBundle is illustrated below:

.. code-block:: yaml

    oro_pdf_generator:

        # Name of the default PDF engine.
        default_engine:       gotenberg
        engines:
            gotenberg:

                # Gotenberg API URL.
                api_url:              '%env(default:oro_pdf_generator.gotenberg_api_url_default:ORO_PDF_GENERATOR_GOTENBERG_API_URL)%'

                    # Examples:
                    # - 'https://demo.gotenberg.dev'
                    # - 'http://127.0.0.1:3000'

``oro_pdf_generator.engines.gotenberg.api_url`` can be set by the environment variable ``ORO_PDF_GENERATOR_GOTENBERG_API_URL``. If the environment variable is not set, the default value from the service container parameter ``oro_pdf_generator.gotenberg_api_url_default`` is applied, which is set to ``http://127.0.0.1:3000`` by default.

You can also get bundle configuration by running the following command:

   .. code-block:: bash

        php bin/console config:dump-reference OroPdfGeneratorBundle
