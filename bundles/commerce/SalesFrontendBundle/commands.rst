:oro_show_local_toc: false

.. _bundle-docs-commerce-sales-frontend-bundle-commands:

CLI Commands (SalesFrontendBundle)
==================================

oro:sales-frontend:access-token:create
--------------------------------------

Creates an OAuth2 access token for the specified user (if not specified, the default one is "admin") for the Sales Frontend application for development or testing purposes.

.. code-block:: shell

   php bin/console oro:sales-frontend:access-token:create

Commands in Use (Examples)
--------------------------

The following example runs the creation of an OAuth2 access token and returns the result in JSON format:

.. code-block:: shell

   php bin/console oro:sales-frontend:access-token:create --format=json

The output would be as follows:

.. code-block:: json

    {
        "user_identifier": "admin",
        "organization_id": 1,
        "token_type": "Bearer",
        "expires_in": 86400,
        "access_token": "access token hash",
        "refresh_token": "refresh token hash"
    }

The following example runs creating of an OAuth2 access token for user ``sale``:

.. code-block:: shell

   php bin/console oro:sales-frontend:access-token:create --current-user=sale

The output would be as follows:

.. code-block:: text

    OAuth2 Access Token
    -------------------
    * user_identifier: sale
    * organization_id: 1
    * token_type: Bearer
    * expires_in: 86400
    * access_token: access token hash
    * refresh_token: refresh token hash

Please note that if a user has access to more than one organization, you need to specify the organization for which you want to generate an access token for the specified user:

.. code-block:: shell

   php bin/console oro:sales-frontend:access-token:create --current-user=admin --current-organization=1

.. include:: /include/include-links-dev.rst
   :start-after: begin
