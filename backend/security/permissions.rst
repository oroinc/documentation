.. _backend-security-bundle-permissions:

Custom Permissions
==================

Users can define custom Permissions and apply them to any manageable Entity.

Entities
--------

A custom permission model consists of 2 related entities.

* **Permission** - the main entity that contains information about a specific permission. It contains the most important information, like Permission name, label, groups, the list of PermissionEntities for what Permission can be applied and the list of PermissionEntities that cannot use this Permission.

* **PermissionEntity** - stores the entity class names to use with the Permission entity.

Configuration
-------------

All custom Permissions are described in the ``permissions.yml`` configuration file inside a corresponding bundle. Currently it is not
possible to add a Permission globally - for all groups (applications); all required groups should be listed manually. So for
every application the required permissions should be added\updated by creating a corresponding ``permissions.yml`` file.

An example of a simple permission configuration.

.. code-block:: bash
   :linenos:

    oro_permissions:
        PERMISSION1:                                                    # permission name (should start with a letter, digit or underscore and only contain
                                                                        # letters, digits, numbers, underscores ("_"), hyphens ("-") and colons (":")
            label: Label for Permission 1                               # permission label
            description: Permission 1 description                       # (optional) permission description
            apply_to_all: false                                         # (by default = true) is permission apply to all entities by default
            apply_to_entities:                                          # (optional) the list of entities to apply permission
                - 'AcmeDemoBundle:MyEntity1'                            # entity class
                - 'Acme\Bundle\DemoBundle\Entity\MyEntity2'
            apply_to_interfaces:                                        # (optional) the list of interfaces to apply permission to the entities that implement these interfaces
                - 'Acme\Bundle\DemoBundle\Entity\MyEntity2Interface'    # entity interface
            group_names:                                                # (by default = ['default]) the list of Groups
                - default                                               # group name
                - frontend

        PERMISSION2:
            label: Label for Permission 2
            description: Permission 2 description
            exclude_entities:                                           # (optional) the list of entities to not apply permission
                - 'AcmeDemoBundle:MyEntity3'
                - 'Acme\Bundle\DemoBundle\Entity\MyEntity4'

This configuration describes 2 Permissions:

1) Permission PERMISSION1 will be applied only to entities `MyEntity1` and `MyEntity2`. Allowed groups for that permission are `default` and `frontend`.
2) Permission PERMISSION2 will be applied to all manageable entities, except for `MyEntity2` and `MyEntity3`. The allowed group for this permission is `default`.

Configuration Merging
---------------------

All configurations merge in the boot bundles order. The application collects the configurations of all permissions with the same name and merges them into one configuration.

Merging uses simple rules:

* if a node value is scalar, the value is replaced
* if a node value is array, this array is complemented by values from the second configuration

After this step, the application is aware of all permissions and has only one configuration for each permission.

Configuration Load
^^^^^^^^^^^^^^^^^^

To load permissions configuration to the DB, execute the following command:

.. code-block:: bash
   :linenos:

   security:permission:configuration:load [--permissions [PERMISSIONS]]

Optional option `--permissions` allows to load only listed Permissions.
