.. index::
    single: Security; Enable HTTPS
    single: HTTPS
    single: HTTPS; Enable HTTPS

How to enable https
===================

*Used application: OroPlatform 1.0.0*

There are two ways to enable https:

Configuring routes
------------------

You have to add schema parameter to routing.yml file.

.. code-block:: yaml

    # app/config/routing.yml
    oro_default:
        pattern:  /
        defaults:
            _controller: OroDashboardBundle:Dashboard:index
        schemes:  [https]

    oro_auto_routing:
        resource: .
        type:     oro_auto
        schemes:  [https]


Configuring security config
---------------------------

You have to add requires_channel option

.. code-block:: yaml

    # app/config/security.yml
    # ...

    access_control:
        # ...
        - { path: ^/, role: IS_AUTHENTICATED_ANONYMOUSLY, requires_channel: https }
        # ...


References
----------

* `How to force routes to always use HTTPS or HTTP`_
* `How to force HTTPS or HTTP for Different URLs`_

.. _How to force routes to always use HTTPS or HTTP: http://symfony.com/doc/current/cookbook/routing/scheme.html
.. _How to force HTTPS or HTTP for Different URLs: http://symfony.com/doc/current/cookbook/security/force_https.html
