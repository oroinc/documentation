.. _frontend-subresource-integrity:

Subresource Integrity (SRI)
===========================

Subresource Integrity (SRI) is a security feature that allows browsers to verify that resources they fetch (like scripts or stylesheets) are delivered without unexpected manipulation.
It works by allowing you to provide a cryptographic hash of the resource, which the browser checks against the fetched resource.
For more details, see: `Subresource Integrity <https://developer.mozilla.org/en-US/docs/Web/Security/Subresource_Integrity>`_.

Using SRI
---------

You can use the Subresource Integrity feature by specifying a cryptographic hash of a resource (file)
you're telling the browser to fetch, in the value of the ``integrity`` attribute of a `<script>` element or a `<link>` element with `rel="stylesheet"`, `rel="preload"`.

.. hint:: This feature is enabled by default, to disable it, you can set the configuration option "oro_asset.subresource_integrity_enabled" to false.

Use the Twig ``oro_integrity`` function to add an ``integrity`` attribute with the appropriate hash for the asset, along with the `` crossorigin="anonymous"`` attribute.

.. code-block:: twig

    <script src="{{ '/build/default/app.js' }}" {{ oro_integrity('/build/default/app.js') }}></script>

    <script src="{{ asset(src) }}" {{ oro_integrity(asset(src)) }}></script> // the same with asset function

.. note:: Make sure the resource you are adding integrity to is `/build/default/app.js` represented in ``/build/<theme_name>/integrity.json``

Expected output:

.. code-block:: html

    <script src="/build/default/app.js?v=e61610e4" integrity="sha384-DAILU17u6emSxfVg8atEESVcx0aMd5gHIbhmP9vx2BlXfdWSaQeRrRdVoXhnOwAQ" crossorigin="anonymous"></script>

.. note:: If the browser checks the resource hash and it is invalid, the resource will be blocked and an appropriate error will be displayed in console.

*Example of an error when the integrity check fails:*

.. warning:: Failed to find a valid digest in the 'integrity' attribute for resource '/build/default/app.js?v=e61610e4' with computed SHA-384 integrity 'kIgiSxsSDNGNivgnro16TVNvrB3ct7PxuBrXu9sbQhsMqdUIei8bBcaXti/1uYi'. The resource has been blocked.
