.. _backend-security-bundle-role-access-control:

Access Control
==============

Symfony can filter URL patterns by user roles through an `access_control` list defined in the security configuration context. See |Role Based Access Control In Symfony| for details.

The order of this list matters, because Symfony returns the first entry for which the current request URL, method, ip, etc., matches.

Because bundles can extend this list, be aware of its final order.

For this reason, in Oro you must put the access_control rules in the ``oro_security`` context (in the same format), not in the ``security`` configuration extension.

Example:

.. code-block:: yaml

    # config/config.yaml
    oro_security:
        access_control:
            - { path: ^/contact$, roles: ANY_ROLE }

By default, the final rule list is sorted in the following order:

1. Application level configuration (config.yml, security.yml, etc.)

.. code-block:: yaml

    # config/config.yaml
    oro_security:
        access_control:
            - { path: ^/contact$, roles: security_yml_ROLE }

2. The list merged from vendor bundles in the bundle loading order

.. code-block:: yaml

    # AclBundle/Resources/config/app.yml (5th. loaded bundle in kernel)
    oro_security:
        access_control:
            - { path: ^/contact$, roles: acl_bundle_ROLE }

    # OroActivityContactBundle/Resources/config/app.yml (61st. loaded bundle in kernel)
    oro_security:
        access_control:
            - { path: ^/contact$, roles: activity_contact_bundle_ROLE }

3. The list merged from the src folder

.. code-block:: yaml

    # src/Resources/config/app.yml
    oro_security:
        access_control:
            - { path: ^/contact$, roles: src_folder_ROLE, priority: 20 }

To override a rule and move it to the top of the rule list that is checked, use the ``priority`` flag.

A rule with no value set defaults to 0, so give a rule a higher value to move it up in the order.

In the example above, the final list will look like the following.

.. code-block:: yaml

    - { path: ^/contact$, roles: src_folder_ROLE }
    - { path: ^/contact$, roles: security_yml_ROLE }
    - { path: ^/contact$, roles: acl_bundle_ROLE }
    - { path: ^/contact$, roles: activity_contact_bundle_ROLE }

A request for URL ``^/contact`` is checked for role ``src_folder_ROLE`` because its priority of 20 moved it up.

4. Specify the access control rule applies to frontstore

To specify whether the access_control rule applies to frontstore, add "frontend: true" to the parameters. Otherwise, "%web backend prefix%" is added to the path.

.. code-block:: yaml

    # src/Resources/config/app.yml
    oro_security:
        access_control:
            - { path: ^/contact$, roles: src_folder_ROLE, options: { frontend: true } }

.. include:: /include/include-links-dev.rst
    :start-after: begin
