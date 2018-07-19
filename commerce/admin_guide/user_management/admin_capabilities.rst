.. _admin-capabilities:

Entity and System Capabilities
==============================

.. note:: The Entity and System Capabilities topic is part of the section on :ref:`Understanding Roles and Permissions <user-guide-user-management-permissions-roles>`, and provides the list of capabilities that you can enable or disable when creating or modifying roles in |oro_application|.

Access to different capabilities in the management console depends on the capabilities enabled for a specific user role. In the application, these capabilities are grouped under categories, such as accounts management, orders or system capabilities. An example of a capability is enabling a selected user to manage menus or passwords.

You can enable or disable entity-specific and system-specific capabilities in the **Entity** section when creating or updating a role in your application, as illustrated below:

.. warning:: Keep in mind that capabilities available in your instance depend on the Oro application installed (for example, OroCRM has fewer capabilities than OroCommerce).

.. image:: /admin_guide/img/access_roles_management/all_capabilities.png

Read on to learn more about the capabilities available for users in the management console.

.. contents:: :local:
   :depth: 2

.. _admin-capabilities-acc:
.. _admin-capabilities-data-audit:
.. _admin-capabilities-system-info:

Account Management
------------------

In the Account Management section, the following capabilities are available:

* **Access System Information** --- Enables a user to view the system information page under **System > System Information** in the main menu. This page contains the list of Oro packages and third-party packages that are installed, and is usually only used by system administrators and integrators.

   .. image:: /admin_guide/img/access_roles_management/system_information_enabled.png

* **Enter The Billing Address Manually** --- Enables a user to provide the billing address manually. 
* **Enter The Shipping Address Manually** --- Enables a user to provide the shipping address manually.
* Override Customer Payment Term

.. comment: Enables to change the existing payment term for the customer and its customer users.

* **Receive Notification Messages For The System Mailboxes That Were Configured Incorrectly** -- Enable this option to receive an email notification if synchronization of the system mailbox is unsuccessful as the result of incorrect credentials. 
* **Use Any Billing Address From The Customer User's Address Book** --- Enables a user to select any billing address available in the customer user's address book from the list. 
* **Use Any Billing Address From The Customer's Address Book** --- Enables a user to select any billing address available in the customer's address book from the list. 
* **Use Any Shipping Address From The Customer Address Book** --- Enables a user to select any shipping address available in the customer's address book from the list. 
* **Use Any Shipping Address From The Customer User's Address Book** --- Enables a user to select any shipping address available in the customer user's address book from the list. 
* **Use The Default Billing Address From The Customer User's Address Book** --- Enables a user to select the default billing address from the customer user's address book.
* **Use The Default Shipping Address From The Customer User's Address Book** --- Enables a user to select the default shipping address from the customer user's address book.
* Work With Payments

   .. comment: Apparently, Work with Payments is responsible for enabling users to capture payments from the management console. When the capability is disabled for certain roles, users with these roles cannot withdraw any payments for orders. This needs to be checked, however.

Catalog
-------

In the Catalog section, the following capabilities are available:

* **[Product Attribute] Create Attribute** --- Enables a user to create product attributes in the application.

   .. image:: /admin_guide/img/access_roles_management/create_attribute_enabled.png

* **[Product Attribute] Edit Attribute** --- Enables a user to edit product attributes in the application.
* **[Product Attribute] Remove Attribute** --- Enables a user to remove product attributes from the application.
* **[Product Attribute] View Attributes** --- Enables a user to view product attributes in the application.
* **[Related Products] Edit Related Products** --- Enables a user to view, add and edit related products. 

  .. comment: Per discussion with PO, should be renamed to Manage Related Products

  .. image:: /admin_guide/img/access_roles_management/related_products_enabled.png

* **[Up-Sell Products] Edit Up-Sell Products** --- Enables a user to view, add and edit up-sell products.

  .. comment: Per discussion with PO, should be renamed to Manage Ups-sell Products
   

  .. image:: /admin_guide/img/access_roles_management/upsell_products_enabled.png

  .. note:: When both **Edit Related Products** and **Edit Up-sell Products** are disabled for a role, the **Related Items** section disappears from the product page.

Quotes
------

In the Quotes section, the following capabilities are available:

* **Add Free-Form Items** --- Enables a user to provide product details (SKU, product name) using free-form entry when creating a quote in the management console.

  .. image:: /admin_guide/img/access_roles_management/free_form_entry.png

* **Enter The Shipping Address Manually** --- Enables a user to provide the shipping address for quotes manually when creating or editing a quote in the management console.

  .. image:: /admin_guide/img/access_roles_management/shipping_address_quote.png

* Override Customer Payment Term
* **Override Quote Prices** --- Enables a user to override prices in quotes. When disabled, the price fields on quote edit pages are inactive.

  .. image:: /admin_guide/img/access_roles_management/override_quote_price_disabled.png

* **Review And Approve Quotes** --- Enables a user to manage quotes (e.g. sent to customer) without approval. When disabled, the user has to submit quotes for review first. This capability affects quotes when `Backoffice Quotes Flow with Approvals <https://oroinc.com/orocommerce/doc/current/admin-guide/workflows/backoffice-quote-flow-with-approvals>`_ is enabled in the application. 

  .. image:: /admin_guide/img/access_roles_management/approve_quotes_disabled.png
  
* **Use Any Shipping Address From The Customer Address Book** --- Enables a user to select any shipping address available in the customer's address book from the list. 

* **Use Any Shipping Address From The Customer User's Address Book** --- Enables a user to select any shipping address available in the customer user's address book from the list. 
* **Use The Default Shipping Address From The Customer User's Address Book** --- Enables a user to select the default shipping address from the customer user's address book from the list.

.. _admin-capabilities-campaign-emails:

Marketing
---------

In the Marketing section, the following capabilities are available:

* **Send Campaign Emails** --- Enables a user to launch a campaign manually. When the capability is enabled, the user can :ref:`send emails <user-guide-email-campaigns-send>` specified by the campaign which is not scheduled to send emails at a specific time (campaigns that have *Manual* selected for **Schedule**). This capability does not affect the user's ability to define and edit campaign settings and create templates.

  .. image:: /admin_guide/img/access_roles_management/email_campaign_emabled.png

Sales Data
----------

In the Sales Data section, the following capabilities are available:

* **Manage Abandoned Cart Campaigns** --- Enables a user to generate automatic emails to customers who have not completed their purchases in Magento-based stores, and send these customers emails as automated campaigns through MailChimp. Sending abandoned cart campaigns is possible when  the integration with Magento is established, the `abandoned cart extension <https://oroinc.com/orocrm/doc/current/user-guide-marketing-tools/magento/sending-abandoned-cart-campaigns#user-guide-acc>`_ is set up, and the integration with MailChimp is configured.


.. _admin-capabilities-jobs:
.. _admin-capabilities-system-config:
.. _admin-capabilities-export-grid:
.. _admin-capabilities-outlook:
.. _admin-capabilities-tags:
.. _admin-capabilities-passwords:
.. _admin-capabilities-mailchimp:
.. _admin-capabilities-share-grid:
.. _admin-capabilities-org-calendar-events:
.. _admin-capabilities-sys-calendar-events:

System Capabilities
-------------------

In the System Capabilities section, the following capabilities are available:

Application
^^^^^^^^^^^

* **Access Job Queue** --- Enables a user to review jobs that have been started in the system, as well as view their current status and their performance log (by default, this information can be found by navigating to **System > Jobs** in the main menu). 

  .. TODO: check 2 capabilities with this name (BAP-10652)

* **Access Personal Configuration** --- Enables a user to access their :ref:`profile configuration settings <doc-my-user-configuration>` where they can localize the application, change the display settings, and otherwise modify how the application will appear to them. Changes made by a user on the personal configuration page do not affect other users.

  .. image:: /admin_guide/img/access_roles_management/user_level_config.png

* **Access System Configuration** --- Enables a user to access system configuration settings under **System > Configuration** in the main menu.

  .. image:: /admin_guide/img/access_roles_management/sys_config.png

* **Assign/Unassign Tags** --- Enables a user to assign/unassign :ref:`tags <admin-guide-tag-management>` to records. 
* **Connect to MailChimp** --- Enables a user to map the contents of a marketing list in |oro_application| to use a segment of the subscribers list in :ref:`MailChimp <user-guide-mailchimp-campaign>`. When the capability is enabled, the **Connect to MailChimp** button appears on the page of the selected marketing list. Make sure that the integration between |oro_application| and :ref:`MailChimp is configured <user-guide-mc-integration>` for the capability to work.

* **Export Grid View** --- Enables a user to :ref:`export the grid views <doc-grids-actions-export>` that they have configured. 

* **Manage Menus** --- Enables a user to access :ref:`menus configuration at different levels <doc-config-menus>`.

  .. important:: The ability to configure menus is controlled by the two capabilities: **Manage Menus** and **Access System Configuration**.

     - To enable a user to personalize menus for themselves and configure menus for each organization individually, include the **Manage Menus** capability into the user role.
     - To enable a user to configure menus for the whole enterprise (all organizations that exist in the Oro application) at once, in addition to the **Manage Menus** capability, include also the **Access System Configuration** capability into the user role.

  .. warning::  For Enterprise Edition only:

     - If your enterprise includes several organizations, changes made at **System > Menus** affect all organizations.
     - To apply changes only to a specific organization, make changes at the organization level.

* **Manage Passwords** --- Enables a user to change passwords of other users. See the :ref:`User Management <user-management-users>` section for more information.

  .. hint:: This capability does not influence a user's ability to edit their own password from the **My User** page.

  .. image:: ../img/roles/manage_passwords.png

* **Share Data View** --- Enables a user to :ref:`share and unshare the grid views <doc-grids-actions-grid-views-share>` that they have configured.

  .. image:: ../img/roles/grid_share.png

  .. image:: ../img/roles/grid_unshare.png

* **Update User Profile** --- Enables a user to update their own profile regardless of which permission for the **Edit** action on the **User** entity the user's role includes. That is, when the **Update User Profile** capability is included in the user's role, even if the role has *None* selected for the **Edit** action on the **User** entity, the user will be able to update their profile.

* **View SQL Query of a Report/Segment** --- Enables a user to review the SQL request that is sent to the system for a report/segment. When the capability is enabled, the **Show SQL Query** link appears below the report.This capability is usually only granted to system administrators, so they can check if a report has been developed correctly. 

  .. image:: ../img/configuration/sql_show.png

  .. hint:: This capability must be also enabled in the report settings. For this, in the main menu, navigate to **System Configuration > Display Settings > Report settings**, and select the **Display SQL in Reports And Segments** check box.

Calendar
^^^^^^^^

* **Assign Calendar Events** --- Enables a user to assign :ref:`calendar events <doc-activities-events>` to the calendars of other users.
* **Manage Organization Calendars (and their events)** --- Enables a user to manage :ref:`organization-wide calendars <user-guide-calendars>` in the application (create, view, edit and delete). Organization calendars are system calendars with *Organization* selected for **Scope**.

  .. hint:: When this capability is disabled, users can still view organization-wide calendars, add them to their own calendar views, and copy related events to their own calendars.

* **Manage System Calendars (and their events)** --- Enables a user to manage :ref:`system-wide calendars <user-guide-calendars>` in the application (create, view, edit and delete). System calendars have *System* selected for **Scope**.

  .. important:: When both **Manage Organization Calendars** and **Manage System Calendars** capabilities are disabled, the **System Calendar** menu disappears from under **System** in the main menu. When at least one capability is enabled, the **System Calendars** menu appears under **System**.

     .. image:: /admin_guide/img/access_roles_management/system_calendars_enabled.png

.. _admin-capabilities-config-entities:
.. _admin-capabilities-merge:
.. _admin-capabilities-search:
.. _admin-capabilities-export-entities:    
.. _admin-capabilities-import-entities:

Entity
^^^^^^

* **Access Entity Management** --- Enables a user to access entity management section under **System > Entities > Entity Management** in the main menu. Many entities in |oro_application| can be configured from the interface, as described in the :ref:`Entity Management topic <doc-entities>` and :ref:`Entity Fields <doc-entity-fields>` topics.
* **Merge Entities** --- Enables users to :ref:`merge <doc-grids-actions-records-merge>` several records of the same entity. 
* **Search** --- Enables users to :ref:`search <user-guide-getting-started-search>` for specific records within the application. The setting does not influence the user's ability to :ref:`search by tag <user-guide-getting-started-search-tag>`.
* **Export Entity Records** --- Enables users to export entity records, as described in the :ref:`Import and Export Data <user-guide-export>` topic. When the capability is enabled, the **Export** button appears on the top right of the page with the table of selected records.

  .. image:: ../img/roles/export_data.png

* **Import Entity Records** --- Enables users to import records from a file to |oro_application|, as described in the :ref:`Import and Export Data <user-guide-import>` topic. When the capability is enabled, the **Import File** button appears on the top right of the page with the table of selected records.

  .. image:: ../img/roles/import_data.png

**Related Articles**

* :ref:`Introduction to Role Management <user-guide-user-management-permissions-roles>`
* :ref:`Field Level Permissions <user-guide-user-management-permissions-roles--field-level-acl>`
* :ref:`Blueprints of User Access Configuration <doc-user-management-users-access-examples>`
* :ref:`End-to-end Access Configuration in Context <user-guide-user-management-permissions-roles--examples>`

.. |oro_application| replace:: OroCommerce