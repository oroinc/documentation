.. _security:
.. _bundle-docs-platform-security-bundle:

OroSecurityBundle
=================

OroSecurityBundle extends Symfony security capabilities to enable a role-based ACL security system in the Oro applications.

The bundle enables developers to set up access restrictions for entities and non-entity related actions using the DOC-block annotations and the YAML configuration files. It also provides UI for application administrators to configure the entity-specific permissions for particular user roles based on the entity ownership.

Related Documentation
---------------------

* :ref:`Introduction to Security in Oro Applications <bundle-docs-platform-security-bundle-intro>`

  * :ref:`Access Control Lists <bundle-docs-platform-security-bundle-access-control-list>`
  * :ref:`Permissions for Entities <bundle-docs-platform-security-bundle-configure-entities>`
  * :ref:`Protecting Resources <bundle-docs-platform-security-bundle-protect-resources>`

* OroSecurityBundle Features

  * `Actions (Capabilities) and Entities ACL Extensions <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/SecurityBundle/Resources/doc/implementation.md>`__
  * `Permissions for User Roles (UI) <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/SecurityBundle/Resources/doc/ui.md>`__
  * `ACL Manager <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/SecurityBundle/Resources/doc/acl-manager.md>`__
  * `Access Levels <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/SecurityBundle/Resources/doc/access-levels.md>`__
  * `Field ACL <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/SecurityBundle/Resources/doc/field-acl.md>`__
  * `Custom Listeners <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/SecurityBundle/Resources/doc/custom-listeners.md>`__
  * `Access Rules <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/SecurityBundle/Resources/doc/access-rules.md>`__

* Custom and Configurable Permissions

  * `How to Configure and Apply Custom Permissions to an Entity <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/SecurityBundle/Resources/doc/permissions.md>`__
  * `How to Work with Configurable Permissions <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/SecurityBundle/Resources/doc/configurable-permissions.md>`__

.. tip:: Take a look an how ACL works in the application in the :ref:`Access Levels and Ownership <bundle-docs-platform-security-bundle-example>` topic which illustrates the hierarchy of two sample organizations and access setup within them.

.. toctree::
   :hidden:

   intro
   example


