:oro_show_local_toc: false

.. _bundle-docs-commerce-sales-frontend-bundle-endpoints:

Endpoints
=========

|SalesFrontendBundle| provides multiple endpoints to manage the user-session lifecycle.

Every request to these endpoints must include the special header `X-Oro-Csrf-Protection` set to `1`, otherwise the OroCommerce would respond with `400 Bad Request`:

.. code-block:: json

    {
        "user_identifier": "admin",
        "expires_at": "2024-09-17T13:28:32+00:00",
        "is_revoked": false
    }

The aforementioned requirement is enforced by the ``\Oro\Bundle\SalesFrontendBundle\EventListener\Kernel\CheckCsrfHeaderRequestListener``.

Check OAuth2 Access Token
-------------------------

Takes the ``OROSFATOKEN`` cookie and returns the OAuth2 access token metadata in response.

Endpoint details:

* Route name: ``oro_sales_frontend_check_token``
* URL: ``%oro_sales_frontend.routing_prefix%/oauth2/check-token``
* Method: ``GET``
* Headers:
  * X-Oro-Csrf-Protection: 1
* Payload: N/A

.. note:: Routing prefix is `/admin/sales-frontend` by default and can be changed via the bundle configuration, see more in :ref:`Routing Prefix <bundle-docs-commerce-sales-frontend-bundle-routing-prefix>` configuration.

Response example:

.. code-block:: json

    {
        "user_identifier": "admin",
        "expires_at": "2024-09-17T13:28:32+00:00",
        "is_revoked": false
    }

.. note:: The element ``expires_at`` contains a date and time formatted as per ``ISO 8601``.

Refresh OAuth2 Access Token
---------------------------

Takes an OAuth2 refresh token from PHP session to update an OAuth2 access token and the related ``OROSFATOKEN`` cookie.

Endpoint details:

* Route name: ``oro_sales_frontend_refresh_token``
* URL: ``%oro_sales_frontend.routing_prefix%/oauth2/refresh-token``
* Method: ``POST``
* Headers:
  * X-Oro-Csrf-Protection: 1
* Payload: N/A

.. note:: Routing prefix is `/admin/sales-frontend` by default and can be changed via the bundle configuration, see more in :ref:`Routing Prefix <bundle-docs-commerce-sales-frontend-bundle-routing-prefix>` configuration.

Response example:

.. code-block:: json

    {
        "user_identifier": "admin",
        "expires_at": "2024-09-17T14:28:32+00:00",
        "is_revoked": false
    }

.. note:: The element ``expires_at`` contains a date and time formatted as per ``ISO 8601``.

Logout
------

Securely logs out a user by doing the following:

* Revokes an OAuth2 access and refresh tokens.
* Clears the ``OROSFATOKEN`` cookie.
* Logs out a user from ``sales_frontend_app`` firewall.

Endpoint details:

* Route name: ``oro_sales_frontend_security_logout``
* URL: ``%oro_sales_frontend.routing_prefix%/user/logout``
* Method: ``GET``
* Headers:
  * X-Oro-Csrf-Protection: 1
* Payload: N/A

.. note:: Routing prefix is `/admin/sales-frontend` by default and can be changed via the bundle configuration, see more in :ref:`Routing Prefix <bundle-docs-commerce-sales-frontend-bundle-routing-prefix>` configuration.

Response example:

.. code-block:: json

    {
        "success": "true"
    }

.. include:: /include/include-links-dev.rst
   :start-after: begin
