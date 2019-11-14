.. index::
    single: Security; Enable HTTPS
    single: HTTPS
    single: HTTPS; Enable HTTPS

Enabling HTTPS
==============

There are two ways to enable HTTPS:

Configure Routes
----------------

If you want to secure some routes and make sure that they are always accessed via the HTTPS protocol,
you can add the ``schemes`` parameter to the ``config/routing.yml`` file.

.. code-block:: yaml
    :linenos:

    # config/routing.yml
    acme_secure:
        resource: .
        type:     oro_auto
        schemes:  [https]


Configure Security Config
-------------------------

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

* |How to force routes to always use HTTPS or HTTP|
* |How to force HTTPS or HTTP for Different URLs|


.. include:: /include/include-links-dev.rst
   :start-after: begin