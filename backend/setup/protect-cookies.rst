:title: Cookies protection, secure, httponly

.. _protect_cookies:

Protect Cookies
===============

If the application is configured to be used via SSL connection, you may want to protect the application cookies, too.

Cookies are protected with **Secure** and **HttpOnly** flags.

You can manually set this parameters for each cookie via the configuration or reconfigure your web sever
to add the **secure** flag by the server.

Reconfigure Apache Web Server
-----------------------------

To configure Apache web server:

- Enable mod_headers.so in the Apache HTTP server configuration file;
- In the configuration of your virtual domain, add:

  .. code-block:: bash

      Header edit Set-Cookie ^(.*)$ $1;Secure

- Restart the web server.

Reconfigure Nginx Web Server with nginx_cookie_flag Module
----------------------------------------------------------

To configure Nginx web server, use the |nginx_cookie_flag_module|.

To use this module, the Nginx server has to be built with the following extension:

.. code-block:: bash

    --add-module=/path/to/nginx_cookie_flag_module

Once Nginx is built with the above module, you can add the following line either to the location or the server
directive in the respective configuration file:

.. code-block:: bash

    set_cookie_flag secure;

Reconfigure Nginx Web Server with proxy_cookie_path
---------------------------------------------------

Another option for Nginx is to use the ``proxy_cookie_path`` parameter in ``ssl.conf`` or ``default.conf``:

.. code-block:: bash

    proxy_cookie_path / "/; Secure";

.. include:: /include/include-links-dev.rst
   :start-after: begin
