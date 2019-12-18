.. _web-api--firewall-listeners:

Configure Feature Depended Firewall Listeners
=============================================

API can be enabled or disabled via system configuration. When the API is disabled, the API related security firewalls
should not use some authorization listeners, for example WSSE and OAuth authorization should be disabled.

To be able to configure listeners for disabled API feature, the following configuration can be used:

.. code:: yaml

    oro_api:
        api_firewalls:
            api_wsse_secured: # firewall name
                feature_name: web_api
                feature_firewall_listeners: # list of listeners that should be disabled when the feature specified in feature_name option is disabled
                    - Oro\Bundle\WsseAuthenticationBundle\Security\Http\Firewall\WsseAuthenticationListener
            wsse_secured:
                feature_name: web_api
                feature_firewall_listeners:
                    - Oro\Bundle\WsseAuthenticationBundle\Security\Http\Firewall\WsseAuthenticationListener
            api_options:
                feature_name: web_api


.. include:: /include/include-links-dev.rst
   :start-after: begin
