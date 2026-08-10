.. _frontend--how-to-add-third-party-scripts-to-storefront:

How to Add Third-Party Scripts
==============================

Use this article to learn about the supported methods for adding marketing, analytics, advertising, and support scripts to the OroCommerce storefront and choose the appropriate method for your use case.

These tools, such as chat widgets, tracking pixels, and A/B testing platforms, are usually integrated into the storefront by adding a JavaScript snippet to every page or to specific pages.

.. important:: Third-party scripts typically set **non-essential cookies**. In many jurisdictions, these cookies require prior, informed, opt-in visitor consent. Before adding a script, review the :ref:`Cookie Consent concept guide <concept-guide-cookie-consent>` and ensure that the script loads only after the customer user provides the required consent. See the `Load a Script Only After Cookie Consent`_ section below.

.. note:: The examples use the following placeholders:

   * ``{BundleName}`` --- the path to your bundle in the ``src`` folder (for example, ``Custom/Bundle/ThemeBundle``).
   * ``{bundle_name}`` --- the name of the folder under ``public/bundles/`` where the assets of your bundle are published. The name is based on the bundle class name without the ``Bundle`` suffix and is written in lowercase. For example, use ``customtheme`` for ``CustomThemeBundle``.
   * ``{theme_name}`` --- the identifier of your storefront theme.

Add an External Script
----------------------

To add a script to **every storefront page**, place the layout update directly in the theme folder. The example below adds an asynchronous external script to the ``<head>``:

.. code-block:: yaml
   :caption: src/{BundleName}/Resources/views/layouts/{theme_name}/analytics_scripts.yml

    layout:
        actions:
            - '@add':
                id: custom_analytics_script
                parentId: head
                blockType: script
                options:
                    src: 'https://analytics.example.com/tracker.js'
                    async: true

For scripts that are not required for the initial page render, set ``parentId`` to ``body``. This appends the block after the main content and before the closing ``</body>`` tag, allowing the page to become visible without waiting for the script to load:

.. code-block:: yaml
   :caption: src/{BundleName}/Resources/views/layouts/{theme_name}/support_widget.yml

    layout:
        actions:
            - '@add':
                id: custom_support_widget_script
                parentId: body
                blockType: script
                options:
                    src: 'https://widget.example.com/support.js'
                    defer: true

Add a Script as a Twig Block
----------------------------

For inline snippets, keep the JavaScript code in a Twig template instead of the YAML file. Add the ``container`` block and render the snippet in the corresponding Twig block. This approach keeps the YAML file concise, provides JavaScript code highlighting in the editor, enables you to pass backend values to the snippet, and matches the patterns used by the built-in Google Tag Manager integration to embed its own scripts. The following example configures a chat widget with the current storefront locale and appends its loader to the end of ``<body>``:

.. code-block:: yaml
   :caption: src/{BundleName}/Resources/views/layouts/{theme_name}/chat_widget.yml

    layout:
        actions:
            - '@setBlockTheme':
                themes: 'chat_widget.html.twig'
            - '@add':
                id: custom_chat_widget_script
                parentId: body
                blockType: container

.. code-block:: twig
   :caption: src/{BundleName}/Resources/views/layouts/{theme_name}/chat_widget.html.twig

    {% block _custom_chat_widget_script_widget %}
        <script>
            window.exampleChatSettings = {
                workspace: 'custom-storefront',
                locale: '{{ app.request.locale }}'
            };

            var chatLoader = document.createElement('script');
            chatLoader.src = 'https://widget.example-chat.com/loader.js';
            chatLoader.async = true;
            document.head.appendChild(chatLoader);
        </script>
    {% endblock %}

The Twig block name is built from the block ``id``. For example, if the block ID is ``custom_chat_widget_script``, the template must define the ``_custom_chat_widget_script_widget`` block. A ``themes`` value without a path is resolved relative to the folder that contains the layout update file. For more information about block themes and block naming conventions, see :ref:`Templates <templates-twig>`.


.. note:: If the snippet only loads an external file and does not require configuration, do not use a Twig block. Use the ``script`` block type with the ``src`` and ``async`` options, as described in the `Add an External Script`_ section. The ``script`` block type also supports inline code through its ``content`` option. Use this option when the snippet is short or comes from a layout data provider.

Add a Script to Specific Pages Only
-----------------------------------

To load a script only on specific pages, place the layout update in a folder named after the corresponding route. A route is the internal name under which a page is registered in the application.

For example, product view pages use the ``oro_product_frontend_product_view`` route. A layout update placed in a folder with the same name loads the script only on product view pages:

.. code-block:: yaml
   :caption: src/{BundleName}/Resources/views/layouts/{theme_name}/oro_product_frontend_product_view/product_scripts.yml

    layout:
        actions:
            - '@add':
                id: custom_product_review_widget
                parentId: body
                blockType: script
                options:
                    src: 'https://reviews.example.com/widget.js'
                    defer: true

.. note:: Layout options support :ref:`expressions <dev-doc-frontend-layouts-layout>`. For example, you can build the ``src`` URL from the current theme or pass backend data into the inline ``content`` via layout data providers.

.. _how-to-add-third-party-scripts-script-block:

The Script Layout Block Type
----------------------------

The examples above use the ``script`` layout block type, added to a page with a regular :ref:`layout update <dev-doc-frontend-layouts-layout>` in your theme. The block supports the following options:

.. csv-table::
   :header: "Option", "Default", "Description"
   :widths: 20, 20, 60

   "``src``","``null``","URL of an external script. When set, the ``content`` option is ignored."
   "``content``","``''``","Inline JavaScript code, rendered inside the ``<script>`` tag."
   "``async``","``false``","Adds the ``async`` attribute."
   "``defer``","``false``","Adds the ``defer`` attribute."
   "``type``","``text/javascript``","Value of the ``type`` attribute."
   "``crossorigin``","``null``","Value of the ``crossorigin`` attribute."

The base page layout provides two insertion points:

* ``head`` --- the ``<head>`` element. Use it for scripts that must load before the page renders.
* ``body`` --- the ``<body>`` element. The blocks appended to it render before the closing ``</body>`` tag, after the main content.

.. _how-to-add-third-party-scripts-consent-gating:

Load a Script Only After Cookie Consent
---------------------------------------

When a script sets non-essential cookies, it must not load until the visitor provides consent. The example below assumes that the cookie consent banner has been extended to store the accepted cookie categories, as described in :ref:`How to Customize the Cookie Consent Banner <frontend--how-to-customize-cookie-consent-banner>`.

.. note:: The ``acceptedCookieCategories`` local storage key and the ``cookie-consent:accepted`` event are **not** part of the OroCommerce platform. They are conventions defined by the banner customization example in the article referenced above. Both articles use the same names so that the two code samples work together. If you choose different names, change them in both places.

.. important:: The stored categories are available per browser only. The banner customization example referenced above therefore switches the banner visibility to the same per-browser model. The banner is shown when no consent choice is available, so the stored categories and the banner stay consistent on every device.

Instead of embedding the third-party script directly, create an app module. An app module is a JavaScript module that runs on every page when the storefront application starts. The module checks the stored consent and loads the script only when its category has been accepted.

The following example uses ``scriptjs``, the asynchronous script loader included with the platform, to inject the script. It loads each URL once and runs asynchronously, so you do not need to manage a ``<script>`` element manually:

.. code-block:: javascript
   :caption: src/{BundleName}/Resources/public/js/app/modules/consent-gated-scripts-module.js

    import mediator from 'oroui/js/mediator';
    import scriptjs from 'scriptjs';

    const CATEGORIES_STORAGE_KEY = 'acceptedCookieCategories';

    const LOAD_SCRIPTS = {
        analytics: 'https://analytics.example.com/tracker.js',
        marketing: 'https://ads.example.com/pixel.js'
    };

    const loadedCategories = [];

    function loadScriptsForCategory(category) {
        if (loadedCategories.includes(category) || !LOAD_SCRIPTS[category]) {
            return;
        }

        scriptjs(LOAD_SCRIPTS[category]);

        loadedCategories.push(category);
    }

    function getAcceptedCategories() {
        try {
            return JSON.parse(localStorage.getItem(CATEGORIES_STORAGE_KEY)) || [];
        } catch (error) {
            return [];
        }
    }

    // Consent given on a previous page
    getAcceptedCategories().forEach(loadScriptsForCategory);

    // Consent given on the current page
    mediator.on('cookie-consent:accepted', categories => categories.forEach(loadScriptsForCategory));

Register the module in your theme's ``jsmodules.yml`` so it runs on every page:

.. code-block:: yaml
   :caption: src/{BundleName}/Resources/views/layouts/{theme_name}/config/jsmodules.yml

    app-modules:
        - '{bundle_name}/js/app/modules/consent-gated-scripts-module'

.. note:: If your tags are managed through the Google Tag Manager integration, do not load the scripts manually. Use Google Consent Mode instead. See :ref:`Cookie Consent concept guide <concept-guide-cookie-consent>` for the approach.

**Related Articles**

* :ref:`Cookie Consent in OroCommerce: Guidance for Merchants <concept-guide-cookie-consent>`
* :ref:`How to Customize the Cookie Consent Banner <frontend--how-to-customize-cookie-consent-banner>`
* :ref:`Layouts <dev-doc-frontend-layouts-layout>`
* :ref:`Google Tag Manager Integration <gtm-ga-4-integration>`
* :ref:`Subresource Integrity <frontend-subresource-integrity>`
