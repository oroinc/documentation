:title: Cookies protection, secure, httponly

.. _dev-guide-setup-protect-cookies:

Protect Cookies
===============

If the application is configured to be used via an SSL connection, you should protect the application cookies, too.

Cookies are protected with **Secure** and **HttpOnly** flags.

By default, all cookies used in ORO applications have the **secure** flag set to ``auto``. This means cookies will have the ``secure`` flag for HTTPS requests and no such flag for HTTP requests.

Except for the CSRF cookie, all cookies have the **httponly** flag set to *true*. This means that the cookie will not be accessible by scripting languages, such as JavaScript.

More information about this configuration is available in the |Cookie secure configuration| section of Symfony documentation.

If your application uses a proxy that redirects from https requests to http, the application will detect that the request was made with the http request. As a result, the ``auto`` value for the secure parameter will remove the **secure** flag.

In this case, you can manually set this parameter for each cookie via the configuration or reconfigure your web sever to add the **secure** flag by the server.

Reconfigure Apache Web Server
-----------------------------

To configure the Apache web server:

- Enable mod_headers.so in the Apache HTTP server configuration file;
- In the configuration of your virtual domain, add:

  .. code-block:: none

      Header edit Set-Cookie ^(.*)$ $1;Secure

- Restart the web server.

Reconfigure Nginx Web Server with nginx_cookie_flag Module
----------------------------------------------------------

To configure Nginx web server, use the |nginx_cookie_flag_module|.

To use this module, the Nginx server has to be built with the following extension:

.. code-block:: none

    --add-module=/path/to/nginx_cookie_flag_module

Once Nginx is built with the above module, you can add the following line either to the location or the server directive in the respective configuration file:

.. code-block:: none

    set_cookie_flag secure;

Reconfigure Nginx Web Server with proxy_cookie_path
---------------------------------------------------

Another option for Nginx is to use the ``proxy_cookie_path`` parameter in ``ssl.conf`` or ``default.conf``:

.. code-block:: none

    proxy_cookie_path / "/; Secure";

.. include:: /include/include-links-dev.rst
   :start-after: begin