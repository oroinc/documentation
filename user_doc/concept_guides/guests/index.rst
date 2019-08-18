.. _sys--conf--commerce--guest:

Guest Access
============

In you Oro application, you can enable or disable guest website access, in addition to managing its different aspects, such as guest shopping lists, guest checkout, guest RFQ and guest quick order form.


.. _sys--conf--commerce--guest--enable--access:

Configure Guest Website Access
------------------------------

In order to prevent non-registered customers from accessing OroCommerce storefront, the administrator can disable website access by non-authenticated visitors. This can be done globally, per website, or per organization.

When guest access is disabled:

* New users can register, if self-registration is enabled in **Commerce > Customer > Customer Users > Registration Allowed**.
* Guest users can register if self-registration is allowed, even if the website access is closed.
* Guest users cannot access any website pages, except for the login/forgot/reset password page.
* Guest users are redirected to the login page when they try to access the homepage.

.. image:: /user_doc/img/storefront/sign_in/SignIn.png

Learn how to enable guest access on different levels in the topics below:

* :ref:`Enable Guest Website Access Globally <sys--conf--commerce--guest-access--global>`
* :ref:`Enable Guest Website Access per Organization <guest-access-org>`
* :ref:`Enable Guest Website Access per Website <sys--conf--commerce--guest-access--website>`

Configure Guest Checkout
------------------------

Guest checkout allows unregistered customers proceed through the steps of the checkout similarly to registered customers, with the exception of needing to enter their data manually as there is no pre-filled information available in the checkout forms. They are also limited to 1 shopping list.

When proceeding through the checkout, unauthenticated customers can choose whether the wish to register, login or continue as guests.

.. important:: As creating a shopping list is the key component of the :ref:`checkout process <frontstore-guide--orders-checkout>`, guest checkout can only operate properly when :ref:`shopping lists are enabled <user-guide--system-configuration--commerce-sales-shopping-list-global>` in the system.  g

The following is the list of actions that unregistered customers can and cannot perform when guest checkout is enabled in your Oro application:

.. csv-table::
   :header: "GUEST CUSTOMERS CAN", "GUEST CUSTOMERS CANNOT"
   :widths: 20, 20

   "1. Proceed to the checkout.","1. View their placed orders."
   "2. Create one shopping list and add items to it.","2. Save their details for future use on the website."
   "3. Use the quick order form.","3. View created quotes."
   "4. Submit a request for quote.","4. Communicate with the manager through the website."

.. note:: For complete guest checkout experience, it is recommended to enable guest shopping lists, guest quick order form and guest requests for quotes.

Guest checkout can be configured on three levels -- globally, per organization and website.

.. note:: Please note that website settings override organization, organization settings override system settings.

Learn how to configure guest checkout on different levels in the topics below:

* :ref:`Configure Guest Checkout Globally <user-guide--system-configuration--commerce-sales-checkout>`
* :ref:`Configure Guest Checkout per Organization <user-guide--system-configuration--commerce-sales-organization>`
* :ref:`Configure Guest Checkout per Website <user-guide--system-configuration--commerce-sales-checkout-website>`

Configure Guest Shopping Lists
------------------------------

You control whether to let unregistered customers purchase goods in the store by enabling or disabling :ref:`shopping lists <frontstore-guide--shopping-lists>`. This can be configured on three levels -- globally, per organization and website.

By default, guest shopping lists are disabled. In addition, only 1 shopping list is available for guest customers.

.. note:: Please note that website settings override organization, organization settings override system settings.

Learn how to configure guest shopping lists on different levels in the topics below:

* :ref:`Configure Guest Shopping Lists Globally <user-guide--system-configuration--commerce-sales-shopping-list-global>`
* :ref:`Configure Guest Shopping Lists per Organization <user-guide--system-configuration--commerce-sales-shopping-list-per-organization>`
* :ref:`Configure Guest Shopping Lists per Website <user-guide--system-configuration--commerce-sales-shopping-list-per-website>`

.. _user-guide--system-configuration--commerce-sales--quick-order-form:

Configure Guest Quick Order Form
--------------------------------

Unregistered customers can use a guest :ref:`quick order form <frontstore-guide--orders-quick-order>` for fast purchases in the Oro storefront. By default, the guest quick order form is disabled, but you can enable it on three levels -- globally, per organization and per website.

.. note:: Please note that website settings override organization, organization settings override system settings.

Learn how to configure guest quick order form on different levels in the topics below:

* :ref:`Configure Guest Quick Order Form Globally <user-guide--system-configuration--commerce-sales--quick-order-form--global>`
* :ref:`Configure Guest Quick Order Form per Organization <user-guide--system-configuration--commerce-sales--quick-order-form--organization>`
* :ref:`Configure Guest Quick Order Form per Website <user-guide--system-configuration--commerce-sales--quick-order-form--website>`

.. _user-guide--system-configuration--commerce-sales--rfq:

Configure Guest Request for Quote Submission
--------------------------------------------

In order to let unregistered customers request quotes on the items they are interested in, you can enable Guest RFQ Forms in your Oro application. This will also allow sales reps collect information on potential sales in the back-office. This can be configured on three levels -- globally, per organization and website.

.. hint:: Make sure you enable :ref:`Guest Shopping Lists <user-guide--system-configuration--commerce-sales-shopping-list>` in the back-office to let guest customers create RFQs from the shopping lists in their storefront.

.. note:: Please note that website settings override organization, organization settings override system settings.

Lean how to configure guest RFQs on different levels in the topics below:

* :ref:`Configure Guest Request for Quote Submission Globally <configuration--guide--commerce--configuration--sales-rfq>`
* :ref:`Configure Guest Request for Quote Submission per Organization <user-guide--system-configuration--commerce-sales--rfq--organization>`
* :ref:`Configure Guest Request for Quote Submission per Website <user-guide--system-configuration--commerce-sales--rfq--website>`

Enable Guest Quotes
-------------------

To issue quotes to guest customers via direct links, enable guest quotes in the system configuration, check out the topic below:

* :ref:`Configure Guest Quote Globally <sys--conf--commerce--guest--enable--guest_quotes>`

.. include:: /include/include_images.rst
   :start-after: begin




