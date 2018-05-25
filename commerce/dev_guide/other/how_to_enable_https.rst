.. index::
    single: Security; Enable HTTPS
    single: HTTPS
    single: HTTPS; Enable HTTPS

How to enable https
===================

*Used application: OroPlatform 1.7*

There are two ways to enable HTTPS:

Configuring routes
------------------

If you want to secure some routes and make sure that they are always accessed via the HTTPS protocol,
you can add the ``schemes`` parameter to the ``config/routing.yml`` file.

.. code-block:: yaml
    :linenos:

    # config/routing.yml
    acme_secure:
        resource: .
        type:     oro_auto
        schemes:  [https]


Configuring security config
---------------------------

As an alternative, you have to add the ``requires_channel`` option to the ``config/security.yml`` file:

.. code-block:: yaml
    :linenos:

    # config/security.yml
    # ...

    access_control:
        # ...
        - { path: ^/acme, roles: ROLE_ADMIN, requires_channel: https}
        # ...


This method is better suited for cases when you need to secure certain URLs
or sections of your website (URLs starting with some prefix, etc.)

References
----------

* `How to force routes to always use HTTPS or HTTP`_
* `How to force HTTPS or HTTP for Different URLs`_

.. _How to force routes to always use HTTPS or HTTP: http://symfony.com/doc/current/cookbook/routing/scheme.html
.. _How to force HTTPS or HTTP for Different URLs: http://symfony.com/doc/current/cookbook/security/force_https.html
