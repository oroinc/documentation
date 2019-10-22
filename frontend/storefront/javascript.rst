JavaScript (RequireJS)
======================

Javascript in OroCommerce has a modular architecture based on RequireJS, Chaplin, and Backbone.

.. seealso::
    :ref:`JavaScript Frontend Architecture <dev-doc-frontend-javascript>` covers the client-side architecture of
    OroPlatform-based applications including OroCommerce.

This section provides configuration reference for the |RequireJS| library to enable a modular structure of JavaScript components in Oro
applications.

RequireJS Definition
--------------------

RequireJS configuration file should be placed in the
`Resources/views/layouts/{theme_name}/config` folder and named `requirejs.yml`, for
example `DemoBundle/Resources/views/layouts/base/config/requirejs.yml`.

Storefront themes build Javascript dependencies with |RequireJSBundle|, and you can use the
configuration reference described in |Require.js config generation| article with the **additional RequireJS configuration**:

+---------------+------------------------------+-----------------------+
| Option        | Description                  | Required              |
+===============+==============================+=======================+
|  `build_path` | Relative path from theme     | no                    |
|               | scripts folder               |                       |
|               | (`public/js/layouts/{theme_n |                       |
|               | ame}/`)                      |                       |
+---------------+------------------------------+-----------------------+

**Example:**

.. code-block:: yaml
    :linenos:

    # src/Acme/Bundle/DemoBundle/Resources/views/layouts/base/config/requirejs.yml
    config:
       build_path: 'scripts.min.js'
       shim:
           'jquery-ui':
               deps:
                   - 'jquery'
       map:
           '*':
               'jquery': 'oroui/js/jquery-extend'
           'oroui/js/jquery-extend':
               'jquery': 'jquery'
       paths:
           'jquery': 'bundles/oroui/lib/jquery-1.10.2.js'
           'jquery-ui': 'bundles/oroui/lib/jquery-ui.min.js'
           'oroui/js/jquery-extend': 'bundles/oroui/js/jquery-extend.js'

When you execute the following command in the console:

.. code-block:: shell

   php bin/console oro:requirejs:build

The result should be `public/js/layouts/base/scripts.min.js`.

RequireJS Config Provider
^^^^^^^^^^^^^^^^^^^^^^^^^

|RequireJSBundle| has its own config provider
`oro_requirejs.provider.requirejs_config` and **is used in the theme
by default** (`public/js/oro.min.js` minimized scripts by default). If
you want to use your own minimized scripts in the theme, define the
`requires` block type with
`provider_alias: { '@value': 'oro_layout_requirejs_config_provider' }`.

**Example:**

.. code-block:: yaml
    :linenos:

    # src/Acme/Bundle/DemoBundle/Resources/views/layouts/base/layout.yml
    ...
    requirejs_scripts:
       blockType: requires
       options:
          provider_alias: oro_layout_requirejs_config_provider
    ...

`oro_layout_requirejs_config_provider` is alias of
`oro_layout.provider.requirejs_config`.

.. include:: /include/include-links.rst
   :start-after: begin