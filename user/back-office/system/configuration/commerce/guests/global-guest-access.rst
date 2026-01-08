.. _sys--conf--commerce--guest-access--global:
.. _sys--conf--commerce--guest--enable--access:

Configure Global Website Access Settings
========================================

.. begin

.. hint:: This section is part of the :ref:`Guest Functions <sys--conf--commerce--guest>` topic that provides a general understanding of the guest access concept in OroCommerce.

To prevent non-registered customers from accessing the OroCommerce storefront, you can disable website access by non-authenticated visitors. This can be done globally, :ref:`per organization <sys--conf--commerce--guest-access--org>` and :ref:`per website <sys--conf--commerce--guest-access--website>`:

When guest access is disabled:

* New users can register if self-registration is enabled in **Commerce > Customer > Customer Users > Registration Allowed**.
* Guest users can register if self-registration is allowed, even if the website access is closed.
* Guest users cannot access any website pages, except for the login/forgot/reset password page and any system or landing pages explicitly allowed by the administrator.
* Guest users are redirected to the login page when they try to access the homepage.

.. image:: /user/img/concept-guides/guests/sign_in.png
   :alt: The storefront login page displayed for guest users

To manage guest access globally:

1. Navigate to **System > Configuration > Commerce > Guests > Website Access**.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

.. image:: /user/img/system/config_commerce/guests/GuestAccessSysConfig.png
   :alt: Guest access system configuration

2. Clear the **Use Default** check box to manage website access settings.
3. To enable guest access to the storefront, select the **Enable Guest Access** checkbox.
4. To disable guest access globally, clear the **Enable Guest Access** checkbox.

   When the option is disabled, the following additional configuration options become available:

   * **Allow Guest Access to System Pages** --- Select the system pages that should remain available to guest users when guest access is disabled.

   * **Allow Guest Access to Landing Pages** --- Select the landing (CMS) pages that should remain available to guest users when guest access is disabled.

   Pages selected in these options remain accessible to guest users even when guest access is disabled, while all other storefront pages remain restricted.

5. Click **Save Settings**.
   

   

.. finish

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin