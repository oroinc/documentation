:title: Cookie configuration, secure, SameSite

.. _dev-guide-setup-cookies-configuration:

Configure Cookies
=================

OroPlatform uses the following cookies:

- **BAPID** - cookie that holds information about a logged in user;
- **BAPRM** - cookie that holds a remembered user (remember me functionality);
- **_csrf** - cookie that holds a CSRF token.

The storefront functionality adds the following cookies:

- **OROSFID**  - cookie that holds information about a logged in customer user;
- **OROSFRM** - cookie that holds a remembered customer user (remember me functionality);
- **customer_visitor** - cookie that holds customer visitor data.

All of these cookies are configured in different places.

Back-Office Session Cookie
--------------------------

The back-office session cookie holds information about a logged in user in the platform application.

This cookie's default name is **BAPID**.

This cookie can be configured in the `session` section of the framework configuration
in the `Resources/config/oro/app.yml` file in any bundle or in the `config/config.yml` file:

.. code-block:: yaml

    framework:
        ...
        session:
            ...
            name:             BAPID   # the cookie name
            cookie_httponly:  true    # if true, the HttpOnly flag will be included in the HTTP response header
            cookie_secure:    'auto'  # determines whether cookies should only be sent over secure connections
            cookie_samesite:  null    # prevents the browser from sending a cookie along with cross-site requests

More info about available configuration options is available in the |Session configuration| documentation.

Back-Office Remember Me Cookie
------------------------------

The back-office remember me cookie holds information about a remembered user in the platform application.

This cookie's default name is **BAPRM**.

This cookie can be configured in the `main` security firewall configuration in the `organization-remember-me` section
in the `Resources/config/oro/app.yml` file in any bundle or in the `config/config.yml` file:

.. code-block:: yaml

    security:
        ...
        firewalls:
            ...
            main:
                ...
                organization-remember-me:
                    ...
                    name:      BAPRM   # the cookie name
                    httponly:  true    # if true, the HttpOnly flag will be included in the HTTP response header
                    secure:    'auto'  # determines whether cookies should only be sent over secure connections
                    samesite:  null    # prevents the browser from sending cookie along with cross-site requests

More info about available configuration options is available in the |Session configuration| documentation.

CSRF Cookie
-----------

CSRF cookie holds the token that should be checked during requests.

The name of cookie is **_csrf**. If your application uses SSL, the name of cookie is **https-_csrf**.

This cookie can be configured in the `csrf_cookie` section of the Security bundle configuration
in the `Resources/config/oro/app.yml` file in any bundle or in the `config/config.yml` file:

.. code-block:: yaml

    oro_security:
        ...
        csrf_cookie:
            cookie_httponly:  false   # if true, the HttpOnly flag will be included in the HTTP response header
            cookie_secure:    'auto'  # determines whether cookies should only be sent over secure connections
            cookie_samesite:  null    # prevents the browser from sending cookie along with cross-site requests

By default, this cookie has `cookie_httponly` parameter with false value.

Possible values of the `cookie_samesite` parameter are: 'strict', 'lax' and null.

Storefront Session Cookie
------------------------------

As the storefront uses a customer user as an authentication object, it works with a separate cookie to store the session data.

This cookie's default name is **OROSFID**.

This cookie can be configured in the `session` section of the Frontend bundle configuration
in the `Resources/config/oro/app.yml` file in any bundle or in the `config/config.yml` file:

.. code-block:: yaml

    oro_frontend:
        ...
        session:
            ...
            name:             OROSFID  # the cookie name
            cookie_httponly:  true     # if true, the HttpOnly flag will be included in the HTTP response header
            cookie_secure:    'auto'   # determines whether cookies should only be sent over secure connections
            cookie_samesite:  null     # prevents the browser from sending cookie along with cross-site requests

If a parameter is absent or null, the value of the parameter is taken from the back-office session cookie.

Storefront Remember Me Cookie
----------------------------------

The storefront has its own remember me cookie that holds the information about a remembered customer user.

This cookie's default name is **OROSFRM**.

This cookie can be configured in the `frontend` security firewall configuration, in the `organization-remember-me` section
in the `Resources/config/oro/app.yml` file in any bundle or in the `config/config.yml` file:

.. code-block:: yaml

    security:
        ...
        firewalls:
            ...
            frontend:
                ...
                organization-remember-me:
                    ...
                    name:      OROSFRM # the cookie name
                    httponly:  true    # if true, the HttpOnly flag will be included in the HTTP response header
                    secure:    'auto'  # determines whether cookies should only be sent over secure connections
                    samesite:  null    # prevents the browser from sending cookie along with cross-site requests

More info about available configuration options is available in the |Remember Me configuration| documentation.

Customer Visitor Cookie
-----------------------

Customer visitor cookie is used in the storefront to store the data of a non-logged in user.

This cookie's name is **customer_visitor**.

This cookie can be configured at the Customer bundle configuration
in the `Resources/config/oro/app.yml` file in any bundle or in the `config/config.yml` file:

.. code-block:: yaml

    oro_customer:
        ...
        cookie_httponly:  true     # if true, the HttpOnly flag will be included in the HTTP response header
        cookie_secure:    'auto'   # determines whether cookies should only be sent over secure connections
        cookie_samesite:  null     # prevents the browser from sending cookie along with cross-site requests

.. include:: /include/include-links-dev.rst
   :start-after: begin
