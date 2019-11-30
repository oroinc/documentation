:oro_show_local_toc: false

JavaScript
==========

Javascript in OroCommerce has a modular architecture based on Chaplin and Backbone.

.. seealso::
    :ref:`JavaScript Frontend Architecture <dev-doc-frontend-javascript>` covers the client-side architecture of
    OroPlatform-based applications including OroCommerce.

This section provides configuration reference for the Webpack library to enable a modular structure of JS components in Oro
applications.

JS Modules Definition
---------------------

JS modules configuration file should be placed in the
`Resources/views/layouts/{theme_name}/config` folder and named `jsmodules.yml`, for
example `DemoBundle/Resources/views/layouts/base/config/jsmodules.yml`.

Entry point for Webpack build is `oroui/js/app`.
But you can change it providing the same alias to the necessary entry point.


**Example:**

.. code-block:: yaml
    :linenos:

    # src/Acme/Bundle/DemoBundle/Resources/views/layouts/base/config/jsmodules.yml
    shim:
        jquery:
            expose:
                - $
                - jQuery
        jquery.form:
            imports:
                - jQuery=jquery
    map:
        '*':
            'jquery': 'oroui/js/jquery-extend'
        'oroui/js/jquery-extend':
            'jquery': 'jquery'
    aliases:
        'jquery$': 'oroui/lib/jquery-1.10.2'
        'jquery-ui$': 'oroui/lib/jquery-ui.min'
        'oroui/js/app$': 'acmedemo/js/app'
