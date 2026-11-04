:title: OroStorefrontEmbeddedBundle for Embedded Fragments

.. meta::
   :description: OroStorefrontEmbeddedBundle renders OroCommerce storefront account pages as embedded fragments that an
                 external application shows in its own pages: the fragment request and response, the embedded
                 endpoints, and the JavaScript runtime

.. _bundle-docs-commerce-storefront-embedded-bundle:

OroStorefrontEmbeddedBundle
===========================

.. important:: OroStorefrontEmbeddedBundle is available in the Enterprise edition only.

OroStorefrontEmbeddedBundle is a bundle that renders OroCommerce storefront pages as embedded fragments. An embedded
fragment is a part of a storefront page that an external application requests as JSON and inserts into its own page,
without an iframe. The bundle is part of the ``oro/headless-storefront`` package. It includes fragments for the
storefront account pages, such as orders, quotes, and shopping lists. The
``Resources/config/oro/storefront_embedded.yml`` file of the bundle defines these fragments and their names.

The bundle does not depend on headless applications. It works with any storefront session. Typically, a headless
application of :ref:`OroHeadlessStorefrontBundle <bundle-docs-commerce-headless-storefront-bundle>` opens this session
through Session Transfer. In this case, the
:ref:`website restriction <bundle-docs-commerce-headless-storefront-bundle--website-restriction>` of the application
also applies to the fragment requests.

.. _bundle-docs-commerce-storefront-embedded-bundle--how-it-works:

How It Works
------------

The external application has a server that forwards requests to OroCommerce. This documentation calls this server the
proxy. A typical integration works in the following way:

#. The proxy opens a storefront session through
   :ref:`Session Transfer <bundle-docs-platform-oauth2-server-bundle--session-transfer>` with the
   ``oro_storefront_embedded_session`` route as the target route. The proxy keeps the session cookie.
#. The proxy sends a fragment request with the session cookie and the ``X-Oro-Embedded`` header.
#. The external page shows the fragment markup and starts the JavaScript runtime. For the steps, see
   :ref:`JavaScript Runtime <bundle-docs-commerce-storefront-embedded-bundle--javascript-runtime>`.
#. The runtime sends its AJAX requests to OroCommerce paths with the ``proxyPrefix`` prefix. The proxy forwards these
   requests to OroCommerce with the session cookie and the ``X-Oro-Embedded`` header.

The bundle uses the following request terms:

* Embedded request --- A request with the ``X-Oro-Embedded`` header, with any value. For its effect, see
  :ref:`Embedded Requests <bundle-docs-commerce-storefront-embedded-bundle--embedded-requests>`.
* Fragment request --- A main request to the ``/embedded/fragment/{fragment}`` path. For details, see
  :ref:`Fragment Request <bundle-docs-commerce-storefront-embedded-bundle--fragment-request>`. A fragment request does
  not need the ``X-Oro-Embedded`` header. As a result, a request can be an embedded request, a fragment request, or
  both.
* Reload request --- A fragment request with a non-empty ``X-Oro-Hash-Navigation`` header. The JavaScript runtime
  sends this header when it reloads a fragment or submits a POST form.

To check a fragment without an external application, open ``/embedded/fragment/<fragment>`` in a browser that has a
storefront session. Replace ``<fragment>`` with the fragment name. The response is the JSON of the fragment.

.. _bundle-docs-commerce-storefront-embedded-bundle--fragment-request:

Fragment Request
----------------

In the ``/embedded/fragment/{fragment}`` path, ``{fragment}`` is the fragment name. The path has no route. The
``oro_storefront_embedded.event_listener.embedded_fragment_request`` listener handles the fragment request on the
``kernel.request`` event with priority 33, before the router:

#. It checks the request method and removes the query parameters whose names start with ``_``. The other query
   parameters become the route parameters of the target page.
#. The ``oro_storefront_embedded.request.embedded_fragment_url_resolver`` service dispatches the
   ``EmbeddedFragmentResolveEvent`` event and creates the URL of the target page with the ``layout_block_ids``
   parameter.
#. The listener rewrites the request in place to this URL and marks it as a fragment request. The method, headers,
   body, cookies, and uploaded files do not change.

The target controller then runs with the usual access checks of the storefront page. Because of the
``layout_block_ids`` parameter, the layout returns a JSON object with the HTML markup of each rendered block under its
block ID. A block that does not exist on the page has no key.

The fragment request returns the following error codes:

* ``400 Bad Request`` --- The route parameters are not valid for the target route.
* ``404 Not Found`` --- The fragment is not configured, or its route does not exist, for example, because the bundle
  that owns the route is not installed.
* ``405 Method Not Allowed`` --- The method is not GET, HEAD, POST, or PUT.

By default, a fragment renders the block whose ID is the fragment name. The bundle also adds the
``layout_js_modules_config`` block, except for a reload request. For a GET request, it also adds the ``title``
block.

.. _bundle-docs-commerce-storefront-embedded-bundle--fragment-response:

Fragment Response
-----------------

If the response to a fragment request is successful (2xx) and its body is a JSON array or object, the bundle
dispatches the ``EmbeddedFragmentResponseEvent`` event and writes the changed content back to the body. Otherwise, the
response does not change. The body keeps the ``JsonResponse`` encoding options. As a result, the markup is safe to put
inline in a script.

The response has the following keys:

* ``<block ID>`` --- The markup of each rendered block.
* ``title`` --- GET only. The plain text of the ``title`` block, or an empty string.
* ``flashMessages`` --- GET only. The flash messages of the session grouped by type, or ``[]``. The request removes
  them from the session. For other methods, they stay in the session until the next GET request.
* ``subtreeUrl`` --- All methods. The path of the target page. The runtime uses it as the URL of layout subtree
  updates.
* ``runtimeUrl`` and ``runtimeIntegrity`` --- GET only, not on a reload. The URL of the
  ``/build/<theme>/embedded_app.js`` file and its subresource integrity hash. ``<theme>`` is the name of the current
  theme. The hash is an empty string when the ``asset_subresource_integrity_enabled`` feature is disabled. See
  :ref:`Subresource Integrity <frontend-subresource-integrity>`.
* ``styles`` and ``printStyles`` --- GET only, not on a reload. The URLs of the critical and main CSS files, and of the
  print CSS file. A file that the current theme does not define comes from its parent theme.

The order of the keys is not part of the contract.

Layout Context
--------------

The ``is_embedded_fragment`` layout context option is ``true`` for a fragment request and ``false`` otherwise.

.. _bundle-docs-commerce-storefront-embedded-bundle--embedded-requests:

Embedded Requests
-----------------

The bundle decorates the following services. For an embedded request, they return URLs with the scheme and host of
OroCommerce instead of an absolute path:

* ``oro_attachment.provider.file_url`` with ``decoration_priority: -300`` --- Resized and filtered attachment images.
* ``oro_attachment.imagine.provider.url`` with ``decoration_priority: -200`` --- Filtered static images.
* ``oro_ui.tools.url_helper`` --- The result of ``getAbsolutePath()``.

As a result, the external page loads these images directly from OroCommerce, not through the proxy.

The bundle adds ``X-Oro-Embedded`` to the ``Vary`` header of each main storefront response. For an embedded request,
it also adds ``X-Oro-Hash-Navigation``.

.. _bundle-docs-commerce-storefront-embedded-bundle--endpoints:

Endpoints
---------

The bundle provides the following storefront endpoints:

* ``GET|HEAD|POST|PUT /embedded/fragment/{fragment}`` --- The fragment request.
* ``GET /embedded/session`` (``oro_storefront_embedded_session``) --- Returns ``204 No Content`` with
  ``Cache-Control: no-store, private``. Use it as the target route of a session transfer that opens a storefront
  session for the embedded pages. See :ref:`Session Transfer
  <bundle-docs-platform-oauth2-server-bundle--session-transfer>`.
* ``POST /embedded/preferences`` (``oro_storefront_embedded_preferences``) --- Stores the localization and the currency
  of the storefront user for the current website.
* ``GET /embedded/theme-assets`` (``oro_storefront_embedded_theme_assets``) --- Lists the built files of the current
  theme.

Call the ``/embedded/preferences`` endpoint when the customer user changes the localization or the currency in the
external application. The endpoint has the following requirements:

* A valid cross-site request forgery (CSRF) token in the ``X-CSRF-Header`` header. For the source of the token, see
  :ref:`CSRF Protection <backend-security-bundle-csrf>`.
* An existing session. Otherwise, the endpoint returns ``400 Bad Request``.
* Form data, not JSON, with at least one of the fields, for example, ``localization=1&currency=USD``. The
  ``localization`` field is the ID of an enabled localization. The ``currency`` field is an available currency code.

The endpoint saves only the submitted fields and returns ``204 No Content``, or ``400 Bad Request`` for an invalid
value. It stores the values in the customer user settings for a logged-in customer user, or in the session for a
guest.

The ``/embedded/theme-assets`` endpoint returns ``{"files": [...]}``. The list contains the files under
``/build/<theme>/`` and the files under ``/build/_static/`` that the theme CSS files refer to. It does not contain
``*.map``, ``*.scss``, and ``*.scss.js`` files. The list does not change until the asset version changes. Use the list
to copy the theme files to the external application, for example, at build time.

When storefront guest access is disabled, the bundle opens only ``/embedded/theme-assets`` to guests. Guest access to
a fragment request is checked against the path of its target page.

.. _bundle-docs-commerce-storefront-embedded-bundle--javascript-runtime:

JavaScript Runtime
------------------

The ``embedded_app`` entry point of the ``default`` theme builds ``/build/<theme>/embedded_app.js``, the
``runtimeUrl`` of the fragment response. The runtime adds the ``window.OroEmbeddedFragmentRuntime`` object and ignores
a second load.

To show a fragment, the external page does the following:

#. Adds the ``styles`` stylesheets, and the ``printStyles`` stylesheets for the ``print`` media type.
#. Inserts the markup of the ``layout_js_modules_config`` block and of the fragment block into a container element.
#. Sets the following attributes of the container:

   * ``data-oro-embedded-fragment-block`` --- The fragment name.
   * ``data-oro-embedded-fragment-params`` --- The query string of the route parameters, if any.
   * ``data-oro-embedded-fragment-subtree-url`` --- The ``subtreeUrl`` value of the fragment response.

#. Loads the ``runtimeUrl`` script. If ``runtimeIntegrity`` is not empty, uses it as the ``integrity`` attribute of the
   script.
#. Calls ``window.OroEmbeddedFragmentRuntime.init()`` for the container, with the ``flashMessages`` value of the
   fragment response in the options.
#. Calls ``dispose()`` of the result before it removes the container.

``window.OroEmbeddedFragmentRuntime.init(containerEl, options)`` starts the OroCommerce page components in an element
that contains the fragment markup. It returns a promise of ``{components, dispose}``. The options are:

* ``proxyPrefix`` --- A prefix for the OroCommerce paths of AJAX requests.
* ``oroBaseUrl`` --- The base URL of OroCommerce.
* ``isAnotherPage(url)`` --- Returns ``true`` if the URL opens another page of the external application.
* ``updateQueryParams(query)`` --- Receives the query string when a component changes the current URL.
* ``navigate(url)`` --- Returns ``true`` if the external application handles the navigation.
* ``signal`` --- An ``AbortSignal`` that stops the initialization.
* ``flashMessages`` --- The ``flashMessages`` of the fragment response to show after rendering.

The runtime works with OroCommerce paths. It converts the absolute URLs of ``oroBaseUrl`` to paths. Inside a fragment,
a link or GET form to the path and query string of the current external page reloads the fragment. A POST form is sent
with AJAX to the fragment endpoint. Other OroCommerce links go to ``navigate``. If ``navigate`` does not handle a link,
the browser opens the same path in the external application. For this reason, the external application must serve the
OroCommerce paths of the embedded pages, or handle them in ``navigate``.
Links that start with ``/attachment/``, ``/pdf-document/``, or ``/customer/order/pdf-document/`` open as files with
the ``proxyPrefix``, unless ``navigate`` handles them.

Related Documentation
---------------------

* :ref:`Create an Embedded Fragment <bundle-docs-commerce-storefront-embedded-bundle--embedded-fragment>`
* :ref:`Customize Embedded Fragments <bundle-docs-commerce-storefront-embedded-bundle--extend>`
* :ref:`OroHeadlessStorefrontBundle <bundle-docs-commerce-headless-storefront-bundle>`
* :ref:`Session Transfer <bundle-docs-platform-oauth2-server-bundle--session-transfer>`

.. toctree::
   :hidden:

   embedded-fragment
   extend

.. include:: /include/include-links-dev.rst
   :start-after: begin
