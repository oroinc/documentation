.. _guest-access-org:
.. _sys--conf--commerce--guest-access--org:

Configure Guest Website Access Settings per Organization
========================================================

.. hint:: This section is part of the :ref:`Guest Functions <sys--conf--commerce--guest>` topic that provides a general understanding of the guest access concept in OroCommerce.

.. note:: Guest access can be enabled :ref:`globally <sys--conf--commerce--guest-access--global>`, per organization, and :ref:`per website <sys--conf--commerce--guest-access--website>`.

.. image:: /user/img/system/user_management/org_configuration/guests/GuestAccessOrg.png
   :alt: Guest access configuration per organization

To manage guest access per organization:

1. Navigate to **System > User Management > Organizations**.
2. For the necessary organization, hover over the |IcMore| **More Options** menu to the right of the necessary organization, and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Guests > Website Access** in the menu on the left.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

4. Clear the **Use System** checkbox to change the system-wide settings.

5. In the Website Access section, toggle the **Enable Guest Access** checkbox to enable or disable guest users from browsing the website.

   When **Enable Guest Access** is disabled, the storefront becomes inaccessible to guest users except for the login/forgot/reset password page and any system or landing pages explicitly allowed by the administrator.

   In this case, the following additional options become available (available starting from OroCommerce version 6.1.7):

   * **Allow Guest Access to System Pages** — Select the system pages that should remain available to guest users.

   * **Allow Guest Access to Landing Pages** — Select the landing (CMS) pages that should remain available to guest users.

6. In the **Anonymous Customer Group Access** section, select a customer user group to represent **Non-authenticated Visitors (guests)** in the storefront. This group is used to define product and catalog visibility rules, as well as other features that depend on customer group settings.

7. Click **Save Settings**.
 
.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin