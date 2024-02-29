.. _backend-security-bundle-csrf:

CSRF Protection
===============

|Cross-Site Request Forgery (CSRF)| is an attack that forces an end user to execute unwanted actions on a web application in which they are currently authenticated.

AJAX Request CSRF Protection
----------------------------

To protect controllers against CSRF, use AJAX `#[CsrfProtection]` attribute. You can use it for the whole controller or individual actions.

|Double Submit Cookie| technique used for AJAX request protection, each AJAX request must have an `X-CSRF-Header` header with a valid token value, this header is added by default to all AJAX requests. The current token value is stored in the cookie `_csrf` for HTTP connections and `https-_csrf` for HTTPS.

**Controller level protection**

.. oro_integrity_check:: 5c766aef3c1bee7c0af9d7d51caff5b81e92a611

    .. literalinclude:: /code_examples/commerce/demo/Controller/FavoriteController.php
        :caption: src/Acme/Bundle/DemoBundle/Controller/FavoriteController.php
        :language: php
        :lines: 1-20, 32, 20-22, 92


**Action level protection**

.. oro_integrity_check:: 75847767deb6dc6ced382601690d09797e8b0843

    .. literalinclude:: /code_examples/commerce/demo/Controller/FavoriteController.php
        :caption: src/Acme/Bundle/DemoBundle/Controller/FavoriteController.php
        :language: php
        :lines: 1-4, 31-43

.. include:: /include/include-links-dev.rst
   :start-after: begin
