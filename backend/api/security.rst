.. _web-api--security:

Configure Stateless Security Firewalls
======================================

The Symfony framework allows for the creation of stateless firewalls. In this case, the security token is not serialized for a session.

However, when API calls are utilized in AJAX requests from the UI, the user's token data from the current session must be used instead of the firewall credentials. For this purpose, the firewall should have the |context1| parameter with the context name that the system can use to authenticate the user.

For example:

.. code-block:: yaml

    security:
        firewalls:
            some_stateless_firewall_with_AJAX_requests:
                stateless: true
                context:   main
                # ...


.. include:: /include/include-links-dev.rst
   :start-after: begin
