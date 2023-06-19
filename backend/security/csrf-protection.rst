.. _backend-security-bundle-csrf:

CSRF Protection
===============

|Cross-Site Request Forgery (CSRF)| is an attack that forces an end user to execute unwanted actions on a web application in which they are currently authenticated.

AJAX Request CSRF Protection
----------------------------

To protect controllers against CSRF, use AJAX `@CsrfProtection` annotation. You can use it for the whole controller or individual actions.

|Double Submit Cookie| technique used for AJAX request protection, each AJAX request must have an `X-CSRF-Header` header with a valid token value, this header is added by default to all AJAX requests. The current token value is stored in the cookie `_csrf` for HTTP connections and `https-_csrf` for HTTPS.

**Controller level protection**

.. oro_integrity_check:: 5685f88aa057c3bed3fc6714ffefd6f8aefb21e9

    .. literalinclude:: /code_examples/commerce/demo/Controller/FavoriteController.php
        :caption: src/Acme/Bundle/DemoBundle/Controller/FavoriteController.php
        :language: php
        :lines: 1-19, 42, 20-22, 101


**Action level protection**

.. oro_integrity_check:: a4bb9d3c221ea066e1c7ab7be4085160b98b2672

    .. literalinclude:: /code_examples/commerce/demo/Controller/FavoriteController.php
        :caption: src/Acme/Bundle/DemoBundle/Controller/FavoriteController.php
        :language: php
        :lines: 1-4, 33-47, 101

.. include:: /include/include-links-dev.rst
   :start-after: begin
