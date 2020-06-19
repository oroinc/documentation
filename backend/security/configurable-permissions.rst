.. _backend-security-bundle-configurable-permissions:

Configurable Permissions
========================

Users can manage the visibility of role permissions on View and Edit Role pages.

Model
-----

 **ConfigurablePermission** is  model that contains all data of the Configurable Permission. It has 3 public methods to check if a permission or a capability is configurable for this ConfigurablePermission:

- isEntityPermissionConfigurable($entityClass, $permission) - checks that permission $permission is configurable for entity class $entityClass;

- isWorkflowPermissionConfigurable($identity, $permission) - checks that permission $permission is configurable for workflow part with identity $identity;

- isCapabilityConfigurable($capability) - checks that capability is configurable.

Configuration
-------------

All Configurable Permissions are described in configuration file ``configurable_permissions.yml`` corresponded bundle.

It has 4 main options:

- default (bool, by default = false) - all permissions for the Configurable Name configurable by default;
- entities (array|bool) - the list of entity classes with permissions. If a value is boolean, it will be applied to all permissions for this entity class;
- capabilities (array) - the list of capabilities;
- workflows (array|bool) - the list of workflow permissions identities with permissions. If a value is boolean, it will be applied to all permissions for this identity.

An example of a simple configurable permission configuration.

.. code-block:: bash
   :linenos:

    oro_configurable_permissions:
        some_name:                                                      # configurable permission name, will be used by filter
            default: true                                               # is all permissions for this `some_name` configurable by default
            entities:
                Oro\Bundle\CalendarBundle\Entity\Calendar:              # entity class
                    CREATE: false                                       # hide permission `CREATE` for entity Calendar
                    EDIT: true                                          # show permission `EDIT` for entity Calendar
            capabilities:
                oro_acme_some_capability: false                         # hide capability `oro_acme_some_capability` for `some_name`
            workflows:
                workflow1:
                    PERFORM_TRANSIT: false                              # hide permission `PERFORM_TRANSIT` for workflow `workflow1`


Configuration Merging
---------------------

All configurations merge in the boot bundles order. The application collects configurations of all configurable permissions with the same name and merges them into one configuration.

Merging uses simple rules:

* if the node value is scalar, the value will be replaced
* if the node value is array, this array will be complemented by the values from the second configuration

After this step, the application knows about all permissions and has only one configuration for each permission.
