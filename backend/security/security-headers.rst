.. _backend-security-bundle-security-headers:

HTTP Security Response Headers
==============================

HTTP security headers are essential components of web security that help protect websites and their users from various online threats and vulnerabilities. These headers are sent by web servers along with HTTP responses to instruct browsers on how to handle certain aspects of the web page.

NelmioSecurityBundle
--------------------

The |NelmioSecurityBundle| provides additional security features for your Symfony application.
This bundle allows to define the following security headers:

* Content-Security-Policy (CSP) - Defines a set of rules that control which resources (e.g., scripts, stylesheets, images) a web page is allowed to load.

* Strict-Transport-Security (HSTS) - Enforces the use of secure, encrypted connections (HTTPS) by instructing the browser to interact with the website only over secure connections.

* X-Frame-Options - Controls whether a browser should be allowed to render a page in a frame or iframe. This helps prevent clickjacking attacks.

* X-Content-Type-Options - Prevents browsers from interpreting files as a different MIME type than declared by the server. This helps mitigate attacks that rely on tricking the browser into misinterpreting content.

* X-XSS-Protection - Enables or disables the browser's built-in XSS protection mechanism.

* Referrer-Policy - Specifies how much information about the referring URL should be included in the HTTP Referer header when navigating from one page to another.

OroSecurityBundle
-----------------

In addition to a wide range of security headers supported by the NelmioSecurityBundle, OroSecurityBundle provides ability to set the |Permissions-Policy| header.

.. code-block:: yaml
   :caption: config/config.yml

    oro_security:
        permissions_policy:
            enable: true
            directives:
                accelerometer: deny
                autoplay: allow_self
                fullscreen: allow_all
                geolocation:
                    - allow_self
                    - 'http://trusted-domain.ltd'


.. include:: /include/include-links-dev.rst
   :start-after: begin
