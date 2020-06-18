:oro_show_local_toc: false

.. _security:
.. _bundle-docs-platform-security-bundle:

OroSecurityBundle
=================

OroSecurityBundle extends Symfony security capabilities to enable a role-based ACL security system in the Oro applications.

The bundle enables developers to set up access restrictions for entities and non-entity related actions using the DOC-block annotations and the YAML configuration files. It also provides UI for application administrators to configure the entity-specific permissions for particular user roles based on the entity ownership.

Related Documentation
---------------------

* :ref:`Introduction to Security in Oro Applications <backend-security-bundle-intro>`

  * :ref:`Access Control Lists <backend-security-bundle-access-control-list>`
  * :ref:`Permissions for Entities <backend-security-bundle-configure-entities>`
  * :ref:`Protecting Resources <backend-security-bundle-protect-resources>`

* OroSecurityBundle Features

  * :ref:`ACL Manager <backend-security-bundle-acl-manager>`
  * :ref:`Field ACL <backend-security-bundle-field-acl>`
  * :ref:`Custom Listeners <backend-security-bundle-listeners>`
  * :ref:`Access Rules <backend-security-bundle-access-rules>`

* Custom and Configurable Permissions

  * :ref:`How to Configure and Apply Custom Permissions to an Entity <backend-security-bundle-permissions>`
  * :ref:`How to Work with Configurable Permissions <backend-security-bundle-configurable-permissions>`

.. tip::
        Take a look an how ACL works in the application in the :ref:`Access Levels and Ownership <backend-security-bundle-example>` topic which illustrates the hierarchy of two sample organizations and access setup within them.


.. include:: /include/include-links-dev.rst
   :start-after: begin