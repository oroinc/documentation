:oro_show_local_toc: false

.. warning:: The documentation you are viewing is accurate for OroCommerce version 5.1 and below. An updated guide for version 6.0 will be available soon.

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
``Resources/views/layouts/{theme_name}/config`` folder and named `jsmodules.yml`, for
example ``DemoBundle/Resources/views/layouts/base/config/jsmodules.yml``.

Detailed information about JS modules configuration is available in the :ref:`JS Modules <reference-format-jsmodules>` topic.
