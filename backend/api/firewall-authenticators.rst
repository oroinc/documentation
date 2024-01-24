.. _web-api--firewall-authenticators:

Configure Feature Depended Firewall Authenticators
==================================================

API can be enabled or disabled via the system configuration. When the API is disabled, the API-related security firewalls
should not use some authorization authenticators, for example, WSSE and OAuth authorization should be disabled.

To be able to configure authenticators for a disabled API feature, use the following configuration:

.. code-block:: yaml

    oro_api:
        api_firewalls:
            api_wsse_secured: # firewall name
                feature_name: web_api
                feature_firewall_authenticators: # list of authenticators that should be disabled when the feature specified in feature_name option is disabled
                    - Oro\Bundle\WsseAuthenticationBundle\Security\Core\Authentication\WsseAuthenticator
            wsse_secured:
                feature_name: web_api
                feature_firewall_authenticators:
                    - Oro\Bundle\WsseAuthenticationBundle\Security\Core\Authentication\WsseAuthenticator
            api_options:
                feature_name: web_api


.. include:: /include/include-links-dev.rst
   :start-after: begin
