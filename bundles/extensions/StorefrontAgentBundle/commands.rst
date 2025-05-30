:oro_show_local_toc: false

.. _bundle-docs-extensions-storefront-agent-bundle-commands:

CLI Commands (StorefrontAgentBundle)
====================================

oro:ai-agent:access-token:create
--------------------------------

Creates an OAuth2 access token for the specified customer user for the Smart Agent microservice for development or testing purposes.

.. code-block:: shell

   php bin/console oro:ai-agent:access-token:create

Commands in Use (Examples)
--------------------------

The following example runs the creation of an OAuth2 access token for customer user `Amanda` and returns the result in JSON format:

.. code-block:: shell

   php bin/console oro:ai-agent:access-token:create --current-customer-user=1 --format=json

The output would be as follows:

.. code-block:: json

    {
        "customer_user_identifier": "1",
        "access_token": "access token hash",
        "client_name": "Oro Agent Client"
    }

The following example runs the creation of an OAuth2 access token for customer user `Amanda` and returns the result in text format:

.. code-block:: shell

   php bin/console oro:ai-agent:access-token:create --current-customer-user=1

The output would be as follows:

.. code-block:: text

    OAuth2 Access Token
    -------------------
    * customer_user_identifier: 1
    * access_token: access token hash
    * client_name: Oro Agent Client

.. include:: /include/include-links-dev.rst
   :start-after: begin
