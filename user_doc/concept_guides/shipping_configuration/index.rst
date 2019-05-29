.. _admin-guide--shipping:
.. _user-guide--shipping:

Shipping Configuration
======================

.. contents:: :local:
   :depth: 2

To facilitate global B2B sales, the OroCommerce administrator enables valid shipping methods for particular locations and integrates local shipping providers or the best shipping plans whenever it is possible.

When submitting an order, a customer may have several shipping options to choose from. They depend on the shipping address that is collected at the checkout. Once the address is provided, OroCommerce evaluates shipping methods against the special shipping rules and exposes only the options recommended for the particular location and/or based on other order details. After the customer user has selected the shipping method, the shipping cost is shown in the order next to the subtotal.

.. note::
    See a short demo on `how to create a shipping integration in OroCommerce <https://www.oroinc.com/orocommerce/media-library/create-shipping-integrations>`_, or keep reading the step-by-step guidance below.

    .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/ileKXVTG6B8" frameborder="0" allowfullscreen></iframe>

Before You Start
----------------

1. :ref:`Set up the General Shipping Configuration <user-guide--shipping--configuration>`

Before proceeding to create a shipping integration, you need to set the shipping configuration in the system. The setting controls shipping options on the global level and applies to all websites. You can set the default shipping origin address, enable or disable the shipping units of length, weight, and the freight class, and label the taxes that apply to the shipping cost in the system configuration.

2. :ref:`Create a Shipping Integration <sys--integrations--manage-integrations--ups--flat-rate>`

To allow customers to select a preferred shipping method during the checkout, you first need to create an integration with a shipping provider. With OroCommerce, you can enable shipping methods using third-party vendors, such as UPS, FedEx, DPD, and Flat Rate shipping.

3. :ref:`Create a Shipping Rule <sys--shipping-rules>`

Once the integration is created and a shipping method is added, you need to add a shipping rule to bind customers to specific shipping prices based on the shipping location and the products they purchase. When the shipping option becomes visible to the buyer in the storefront, they can proceed through the checkout.

4. :ref:`Add a Shipping Tracking Number to the Order <user-guide--shipping-order>`

To help customers track the delivery status of their orders, you can add a shipping tracking method and a number to their orders through the back-office.

5. :ref:`Assign a Shipping Method to a Quote <shipping-configuration-per-quote>`

To calculate the shipping cost for an order, enter the order shipping address to the quote flow and select one of the available shipping methods on behalf of the user.

Shipping Methods and Providers
------------------------------

Shipping methods are assigned to an order providing the possibility for a customer to select a shipping service when placing an order and successfully proceed through the checkout.

The list of shipping methods that OroCommerce supports is listed below. Click on the links below to open the overview page of each supported shipping service.

* :ref:`Flat Rate <doc--integrations--flat-rate>`
* :ref:`UPS <doc--integrations--ups>`
* :ref:`FedEx <doc--integrations--fedex>`
* DPD

  .. note:: When using UPS or FedEx, cost evaluation is possible only for the products with available :ref:`shipping information (weight and weight unit) <user-guide--shipping--product-shipping-info>`.


.. include:: /user_doc/img/buttons/include_images.rst
   :start-after: begin

