.. _bundle-docs-commerce-checkout-bundle:

OroCheckoutBundle
=================

OroCheckoutBundle enables checkout workflows in the OroCommerce storefront to collect all the necessary information from the customer when they are creating an order. For back-office administrators, this bundle provides the ability to switch between the single page and multi-step page checkout workflows using the system workflow management UI.

The Dependency Injection Tags
-----------------------------

.. csv-table::
   :header: "Type name","Usage"

   "[oro.checkout.line_item.converter]","The converter provides service to convert a source object to a collection of |CheckoutLineItems| and implements |CheckoutLineItemConverterInterface|."

Checkout Subtotal
-----------------

The data from the Subtotal column (sum of all checkout items) is stored in the database. It is required for efficient assembly of the open orders (checkouts) datagrid. The data gets updated after the following actions:

* Once a product price list is changed, it triggers the subtotal recalculation for all checkouts with such product included.

The list of events:

    * ``Oro\Bundle\PricingBundle\Event\CombinedPriceList\CombinedPriceListsUpdateEvent`` (``oro_pricing.combined_price_list.update``)
    * ``Oro\Bundle\PricingBundle\Event\CustomerGroupCPLUpdateEvent`` (``oro_pricing.customer_group.combined_price_list.update``)
    * ``Oro\Bundle\PricingBundle\Event\CustomerCPLUpdateEvent`` (``oro_pricing.customer.combined_price_list.update``)
    * ``Oro\Bundle\PricingBundle\Event\WebsiteCPLUpdateEvent`` (``oro_pricing.website.combined_price_list.update``)
    * ``Oro\Bundle\PricingBundle\Event\ConfigCPLUpdateEvent`` (``oro_pricing.config.combined_price_list.update``)

* Subtotals are also recalculated within the HTTP-request at each step of the checkout process.

* In the open orders datagrid, subtotals are recalculated once the datagrid information request is received, but only if the related product price list was changed, and subtotal was not updated in the message queue.

Order Confirmation Email Template
---------------------------------

This template includes all order information details such as shipping and billing addresses, payment details, order date, all available data for each line item, etc.

To access this information, a user can use variables, TWIG functions, and filters when editing the order confirmation email template.

Use the following variables for the ``Order confirmation email template``:

* entity - an order instance.

Use twig for the ``Order confirmation email template``:

* `Functions`_
* `Filters`_

.. note:: Please, refer to the :ref:`Email Templates <user-guide-view-emails-template-variables>` article for the full list of available functions, filters, and tags.

Functions
^^^^^^^^^

- ``oro_order_shipping_method_label`` --- provides a label of a shipping method based on information about shipping method and shipping method type
- ``get_payment_methods`` --- provides information about payment methods based on the instance of Order
- ``get_payment_term`` --- provides payment term based on the instance of Order
- ``get_payment_status_label`` --- provides a formatted label of a payment status based on the value that could be retrieved by function ``get_payment_status``
- ``get_payment_status`` --- provides an internal value of the payment status based on the instance of Order
- ``order_line_items`` --- provides Order Line Items data based on the instance of Order
- ``line_items_discounts`` --- provides Line Items discounts information based on the instance of Order

Filters
^^^^^^^

- ``oro_format_name`` --- returns a text representation of the given object
- ``oro_format_date`` --- returns a text representation of the date according to locale settings
- ``oro_format_address`` --- formats address according to locale settings
- ``oro_format_short_product_unit_value`` --- formats product unit value based on the given product unit. For more examples, see |Product Unit Formatting|
- ``oro_format_price`` --- formats currency number according to locale settings
- ``oro_format_currency`` --- formats currency number according to localized format

.. note:: There is ``Oro\Bundle\CheckoutBundle\Migrations\Data\ORM\UpdateOrderConfirmationEmailTemplate`` migration which modifies old template to the new one but only if there was no any user customization in it.


.. include:: /include/include-links-dev.rst
   :start-after: begin

