:oro_show_local_toc: false

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

  * |Actions (Capabilities) and Entities ACL Extensions|
  * |Permissions for User Roles (UI)|
  * |ACL Manager|
  * |Access Levels|
  * |Field ACL|
  * |Custom Listeners|
  * |Access Rules|

* Custom and Configurable Permissions

  * |How to Configure and Apply Custom Permissions to an Entity|
  * |How to Work with Configurable Permissions|

.. tip:: Take a look an how ACL works in the application in the :ref:`Access Levels and Ownership <bundle-docs-platform-security-bundle-example>` topic which illustrates the hierarchy of two sample organizations and access setup within them.

**Related Topics**

* :ref:`Introduction to Security in Oro Applications <bundle-docs-platform-security-bundle-intro>`
  * :ref:`Access Control Lists <bundle-docs-platform-security-bundle-access-control-list>`
  * :ref:`Permissions for Entities <bundle-docs-platform-security-bundle-configure-entities>`
  * :ref:`Protecting Resources <bundle-docs-platform-security-bundle-protect-resources>`

* :ref:`Access Levels and Ownership Illustration <bundle-docs-platform-security-bundle-example>`


.. include:: /include/include-links-dev.rst
   :start-after: begin