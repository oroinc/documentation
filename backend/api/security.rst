.. _web-api--security:

Configure Stateless Security Firewalls
======================================

Symfony allows to create stateless firewalls. In this case the security Token will not be serialized to session.

But there are cases when API calls should be used in AJAX requests from the UI.

In this case we does not send firewalls credentials (e.g., WSSE headers) but should use current user token data from the current session.

To be able to do this, the firewall should have |context1| parameter with the context name the system should use to authenticate the user.

For example:

.. code:: yaml

    security:
        firewalls:
            some_stateless_firewall_with_AJAX_requests:
                stateless: true
                context:   main
                # ...


.. include:: /include/include-links.rst
   :start-after: begin