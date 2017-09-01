.. _sys--conf--commerce--guest:

Guest Access Management 
=======================

In order to prevent non-registered customers from accesing OroCommerce front store, the administrator can disable website access by non-authenticated visitors. This can be done globally, per website, or per organization.

When guest access is disabled:

* New users can register, if self-registration is enabled in **Commerce > Customer > Customer Users > Registration Allowed**.
* Guest users can register if self-registration is allowed, even if the website access is closed.
* Guest users cannot acces any website pages, except for the login/forgot/reset password page.
* Guest users are redirected to the login page when they try to access the homepage.

.. note:: Disabled customer users cannot access any website pages, except for login/forgot/reset password.

.. image:: /user_guide/img/system/configuration/guest_access/SignIn.png


Enabling Global Guest Access 
----------------------------

.. include:: /user_guide/system/commerce_configuration/guest_access_global.rst
   :start-after: begin
   :end-before: finish
   

Enabling Guest Access per Website 
---------------------------------

.. include:: /user_guide/system/commerce_configuration/guest_access_website.rst
   :start-after: begin
   :end-before: finish

Enabling Guest Access per Organization 
--------------------------------------

.. include:: /user_guide/system/commerce_configuration/guest_access_organization.rst
   :start-after: begin
   :end-before: finish

.. include:: /user_guide/include_images.rst
   :start-after: begin
