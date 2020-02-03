:oro_documentation_types: OroCommerce

.. _sys--conf--commerce--guest-access--global:
.. _sys--conf--commerce--guest--enable--access:

Website Access
==============

.. begin

To prevent non-registered customers from accessing the OroCommerce storefront, you can disable website access by non-authenticated visitors. This can be done globally, :ref:`per organization <sys--conf--commerce--guest-access--org>` and :ref:`per website <sys--conf--commerce--guest-access--website>`:

When guest access is disabled:

* New users can register if self-registration is enabled in **Commerce > Customer > Customer Users > Registration Allowed**.
* Guest users can register if self-registration is allowed, even if the website access is closed.
* Guest users cannot access any website pages, except for the login/forgot/reset password page.
* Guest users are redirected to the login page when they try to access the homepage.

.. image:: /user/img/concept-guides/guests/sign_in.png


To enable guest access globally:

1. Navigate to **System > Configuration > Commerce > Guests > Website Access**.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

2. Select the **Enable Guest Access** checkbox.
3. Click **Save Settings**.
   
.. note:: To disable guest access globally, clear the **Enable Guest Access** checkbox.
   
.. image:: /user/img/system/config_commerce/guests/GuestAccessSysConfig.png
   :alt: Guest access system configuration

.. finish

.. include:: /include/include-images.rst
   :start-after: begin