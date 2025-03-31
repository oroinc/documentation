.. _backend-security-bundle-role-access-control:

Access Control
==============

Symfony has a built-in security capability to easily filter URL patterns by user roles, defining an `access_control` list in the security configuration context. See |Role Based Access Control In Symfony| for details.

The order of this list really matters, as Symfony will return the first entry for which the current request URL, method, ip, etc., matches.

As this list can be extended by bundles, it's important to be aware of the final order the list is going to have.

Because of this, in Oro, you cannot put the access_control rules in the ``security`` configuration extension, but you must put them in the ``oro_security`` context (in the same format).

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

If you want to override a rule and move to the top of the rule list which is going to be checked, you can use the ``priority`` flag.

By default, if there is no value set for a rule, it will default to 0, so if you want to move a rule up in order, put a value higher than that.

In the example above, the final list will look like the following.

.. code-block:: yaml

    - { path: ^/contact$, roles: src_folder_ROLE }
    - { path: ^/contact$, roles: security_yml_ROLE }
    - { path: ^/contact$, roles: acl_bundle_ROLE }
    - { path: ^/contact$, roles: activity_contact_bundle_ROLE }

The request coming for URL ``^/contact`` will be checked for role ``src_folder_ROLE`` because it was moved up for its priority of 20.

4. Specify the access control rule applies to frontstore

If you want to specify whether the access_control rule applies to frontstore, you need to add "frontend: true" to the parameters, otherwise "%web backend prefix%" will be added to the path.

.. code-block:: yaml

    # src/Resources/config/app.yml
    oro_security:
        access_control:
            - { path: ^/contact$, roles: src_folder_ROLE, options: { frontend: true } }

.. include:: /include/include-links-dev.rst
    :start-after: begin
