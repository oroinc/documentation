:oro_show_local_toc: false

.. _bundle-docs-commerce-sales-frontend-bundle:

SalesFrontendBundle
===================

|SalesFrontendBundle| provides an integration with the headless Sales Frontend application, specifically it:

1. Enables the :ref:`Back-Office Web API <web-api>` during the OroCommerce application installation/upgrade via ``\Oro\Bundle\SalesFrontendBundle\Migrations\Data\ORM\EnableBackofficeApi`` data migration.
2. Generates the private and public RSA keys required by the :ref:`OAuth2 server <bundle-docs-platform-oauth2-server-bundle>`. The keys are generated automatically (if they do not exist yet) via composer script `@oauth-server-generate-keys` defined in the ``scripts`` section of the ``composer.json`` of this package. To generate the keys manually, see |Generating public and private keys| for details.
3. Creates :ref:`OAuth2 applications <oauth-applications>` with grant type ``Authorization Code`` required for communication between the Sales Frontend application and OroCommerce application via the :ref:`Back-Office Web API <web-api>` using the OAuth2 authentication method. OAuth2 applications are created automatically for each organization by data migration ``\Oro\Bundle\SalesFrontendBundle\Migrations\Data\ORM\LoadSalesFrontendOAuth2Clients``. The creation of a new organization is handled by the ``\Oro\Bundle\SalesFrontendBundle\EventListener\Doctrine\SalesFrontendOAuth2ClientListener`` doctrine listener.
4. Provides the login and login-related pages to be embedded into the Sales Frontend application.
5. Provides the endpoints to manage a user-session lifecycle in the Sales Frontend application.
6. Configures |CORS| and |CSP| for the :ref:`Back-Office Web API <web-api>`, the Sales Frontend login, login-related pages and endpoints.

Related Documentation
---------------------

.. toctree::
   :maxdepth: 1

   Commands <commands>
   Configuration <configuration>
   CORS <cors>
   CSP <csp>
   Endpoints <endpoints>
   Login Flow <login-flow>
   Login Page <login-page>
   Routing Prefix <routing-prefix>
   Web Server Config <web-server-config>

.. include:: /include/include-links-dev.rst
   :start-after: begin
