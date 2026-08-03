:title: Security Capabilities in Oro Application

.. meta::
   :description: Guidance on security settings and access levels configuration for the backend developers

.. _backend-security-bundle-intro:

Security
========

OroSecurityBundle extends Symfony security capabilities to enable a role-based ACL security system in the Oro applications.

Developers can set up access restrictions for entities and non-entity-related actions using DOC-block annotations and YAML configuration files.

Application administrators get a UI to configure entity-specific permissions for particular user roles based on entity ownership.

Read more in the following topics:

* :ref:`Introduction to Security in Oro Applications <backend-security-bundle-introduction>`

  * :ref:`Access Control Lists <backend-security-bundle-access-control-list>`
  * :ref:`Permissions for Entities <backend-security-bundle-configure-entities>`
  * :ref:`Protecting Resources <backend-security-bundle-protect-resources>`

* :ref:`Access Levels and Ownership Illustration <backend-security-bundle-example>`

* OroSecurityBundle Features

  * :ref:`ACL Manager <backend-security-bundle-acl-manager>`
  * :ref:`Field ACL <backend-security-bundle-field-acl>`
  * :ref:`Custom Listeners <backend-security-bundle-listeners>`
  * :ref:`Access Rules <backend-security-bundle-access-rules>`

* Custom and Configurable Permissions

  * :ref:`How to Configure and Apply Custom Permissions to an Entity <backend-security-bundle-permissions>`
  * :ref:`How to Work with Configurable Permissions <backend-security-bundle-configurable-permissions>`

* :ref:`Global View Entities <backend-security-bundle-global-view-entities>`

* :ref:`Security Response Headers <backend-security-bundle-security-headers>`

.. toctree::
   :titlesonly:
   :hidden:

   acl
   acl-manager
   permissions
   field-acl
   configurable-permissions
   csrf-protection
   access-rules
   custom-listeners
   example
   global-view-entities
   security-headers