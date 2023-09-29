.. _backend-security-bundle-configurable-permissions:

Configurable Permissions
========================

Users can manage the visibility of role permissions on the View and Edit Role pages.

Model
-----

 **ConfigurablePermission** is a model that contains all data of the Configurable Permission. It has three public methods to check if permission or a capability is configurable for this ConfigurablePermission:

- isEntityPermissionConfigurable($entityClass, $permission) - checks that permission $permission is configurable for entity class $entityClass;

- isWorkflowPermissionConfigurable($identity, $permission) - checks that permission $permission is configurable for workflow part with identity $identity;

- isCapabilityConfigurable($capability) - checks that capability is configurable.

Configuration
-------------

All Configurable Permissions are described in the configuration file ``configurable_permissions.yml`` of the corresponding bundle.

It has four main options:

- default (bool, by default = false) - all permissions for the Configurable Name configurable by default;
- entities (array|bool) - the list of entity classes with permissions. If a value is boolean, it will be applied to all permissions for this entity class;
- capabilities (array) - the list of capabilities;
- workflows (array|bool) - the list of workflow permissions identities with permissions. If a value is boolean, it will be applied to all permissions for this identity.

An example of a simple configurable permission configuration:

.. oro_integrity_check:: a9d9b0788a1bc9a4882ee60617231aea3fc9d7be

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/configurable_permissions.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/configurable_permissions.yml
        :language: yaml
        :lines: 1-13

Configuration Merging
---------------------

All configurations merge in the boot bundles order. The application collects configurations of all configurable permissions with the same name and merges them into one configuration.

Merging uses simple rules:

* if the node value is scalar, the value will be replaced
* if the node value is an array, this array will be complemented by the values from the second configuration

After this step, the application knows about all permissions and has only one configuration for each permission.
