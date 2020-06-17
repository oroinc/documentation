.. _admin-guide--shipping:
.. _user-guide--shipping:

:oro_documentation_types: OroCommerce

Shipping Configuration Concept Guide
====================================

To facilitate global B2B sales, you can configure various shipping methods for particular locations, integrate local shipping providers, or the best shipping plans whenever possible.

The shipping options available to buyers when they are placing orders through the OroCommerce storefront depend on the shipping address collected at the checkout. Once the address is provided, OroCommerce evaluates shipping methods against existing shipping rules and exposes only those options that were configured for a particular location and/or based on other order details. When a buyer selects a shipping method, the shipping cost is displayed in the order next to the subtotal.

To enable the buyer to have one or several shipping options in the storefront, you need to :ref:`create shipping integrations <user-guide--shipping--configuration--common-details>` and :ref:`link them to shipping rules <doc--shipping-rules--shipping-methods--detailed>` in the OroCommerce back-office.

.. note::
    See a short demo on |how to set up a shipping integration in OroCommerce| or keep reading the step-by-step guidance below.

    .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/ileKXVTG6B8" frameborder="0" allowfullscreen></iframe>

Shipping Integration
--------------------

**Shipping integrations** allow sellers to enable out-of-the-box and third-party shipping methods to offer shipping services when orders are placed through OroCommerce. For example you can integrate  UPS shipping functionality into your OroCommerce store which would add a number of UPS shipping services, such as UPS 2nd Day Air, UPS Standard, and others. Configuring integration with shipping provides, you can also add shipping services to customer quotes and manage them in the OroCommerce back-office.

OroCommerce works with the following shipping methods out-of-the-box:

* :ref:`Flat Rate <doc--integrations--flat-rate>`

  A flat rate shipping method allows sellers to specify one specific price to ship the order. For example, you can set up a shipping method and a rule which sets a flat rate fee of 3.99 to ship an order to a customer anywhere in the US, and another flat rate shipping method and rule which enable shipping the package overnight to anywhere in the world for $29.99. These prices are automatically added to orders during the checkout.

* :ref:`UPS <doc--integrations--ups>`

  To set up a UPS integration, you need to register with UPS.com and open a UPS account with the necessary shipping services level.

* :ref:`FedEx <doc--integrations--fedex>`

  To set up a FedEx integration, create a FedEx business account and obtain a dedicated shipping account number and a meter number via the official FedEx website.

  .. note:: When using UPS or FedEx, cost evaluation is possible only for the products with available :ref:`shipping information (weight and weight unit) <user-guide--shipping--product-shipping-info>`.

* :ref:`DPD <doc--integrations--dpd>`

  DPD is an international parcel delivery service. To set up a DPD integration, contact DPD support to receive credentials for the account activation.

.. note:: You must have at least one shipping method available for your customers to allow them to proceed through the checkout. Without a shipping method, the buyer receives an error message asking them to contact the seller to complete the order.

.. hint:: Check out |OroCommerce's Extension Marketplace| to download other shipping services that you can pair with your OroCommerce applications.

Shipping Rules
--------------

**Shipping rules** help to evaluate the customer’s address against the available shipping options and only display the shipping options that are available for their location. Sellers can configure one or several shipping rules for users or add :ref:`conditions <doc--shipping-rules--actions--create>` to target attributes of both buyers and products. For instance, you can add :ref:`an expression <payment-shipping-expression-lang>` offering a free shipping of a certain product. Shipping rules examine a customer’s address against the pre-defined rules and the sort order to display only those shipping options that are relevant to a specific customer.

When OroCommerce reaches the shipping rule with enabled :ref:`Stop Further Rule Processing <doc--shipping-rules--overview--stop-further-processing>` flag, the remaining rules are not taken into account, and their shipping methods are not displayed as the shipping options at the checkout. This is helpful when you need to enforce the recommended shipping method for any location or applicable conditions. For example, use a local shipping vendor for all addresses they handle; or use the specific shipping vendor that has a VIP SLA with a particular customer. It is recommended to place this type of rules to the top (e.g., setting their **sort order** to 1).

When the shipping option is enabled by multiple shipping rules, only the first occurrence is displayed to the customer user—the one from the shipping rule with the lower sort order value, which means closer to the top of the list. The shipping methods from the same service provider can be enabled in different shipping rules.

Configuration Sequence
----------------------

1. :ref:`Set up the General Shipping Configuration <user-guide--shipping--configuration>`

Before proceeding to set up a shipping integration, you need to set the shipping configuration in the system. The setting controls shipping options on the global level and applies to all websites. You can set the default shipping origin address, enable or disable the shipping units of length, weight, and the freight class, and label the taxes that apply to the shipping cost in the system configuration.

2. :ref:`Set up a Shipping Integration <sys--integrations--manage-integrations--ups--flat-rate>`

To allow customers to select a preferred shipping method during the checkout, you first need to set up an integration with a shipping provider. With OroCommerce, you can enable the built-in Flat Rate shipping, and shipping methods using third-party vendors, such as UPS, FedEx, or DPD.

3. :ref:`Create a Shipping Rule <sys--shipping-rules>`

Once the integration is set up, and a shipping method is added, you need to add a shipping rule to bind customers to specific shipping prices based on the shipping location and the products they purchase. When the shipping option becomes visible to the buyer in the storefront, they can proceed through the checkout.

4. :ref:`Add a Shipping Tracking Number to the Order <user-guide--shipping-order>`

To help customers track the delivery status of their orders, you can add a shipping tracking method and a number to their orders through the back-office.

5. :ref:`Assign a Shipping Method to a Quote <shipping-configuration-per-quote>`

To calculate the shipping cost for an order, enter the order shipping address to the quote flow and select one of the available shipping methods on behalf of the user.

.. image:: /user/img/concept-guides/shipping/shipping-diagram.png
   :align: center
   :alt: Shipping configuration steps in a diagram

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin

