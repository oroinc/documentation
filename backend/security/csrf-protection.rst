.. _backend-security-bundle-csrf:

CSRF Protection
===============

|Cross-Site Request Forgery (CSRF)| is an attack that forces an end user to execute unwanted actions on a web application in which they are currently authenticated.

AJAX Request CSRF Protection
----------------------------

To protect controllers against CSRF, use AJAX `@CsrfProtection` annotation. You can use it for the whole controller or individual actions.

|Double Submit Cookie| technique used for AJAX request protection, each AJAX request must have an `X-CSRF-Header` header with a valid token value, this header is added by default to all AJAX requests. The current token value is stored in the cookie `_csrf` for HTTP connections and `https-_csrf` for HTTPS.

**Controller level protection**

.. oro_integrity_check:: 12b465fd56ae839eb189f0e8e8637f4ceb85f791

    .. literalinclude:: /code_examples/commerce/demo/Controller/FavoriteController.php
        :caption: src/Acme/Bundle/DemoBundle/Controller/FavoriteController.php
        :language: php
        :lines: 1-19, 42, 20-22, 101


**Action level protection**

.. oro_integrity_check:: 52e5fe94669f237bd4f8c81309bcdc8a0989b940

    .. literalinclude:: /code_examples/commerce/demo/Controller/FavoriteController.php
        :caption: src/Acme/Bundle/DemoBundle/Controller/FavoriteController.php
        :language: php
        :lines: 1-4, 33-47, 101

.. include:: /include/include-links-dev.rst
   :start-after: begin
