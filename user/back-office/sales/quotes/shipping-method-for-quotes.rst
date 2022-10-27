:oro_documentation_types: OroCommerce

.. _shipping-configuration-per-quote:

Assign a Shipping Method to a Quote
-----------------------------------

When editing the quote, a salesperson may limit the shipping methods and shipping addresses visible to a customer.

To limit the shipping address and methods per quote:

1. Navigate to **Sales > Quotes** in the main menu.

2. Hover over the |IcMore| **More Options** menu to the right of the necessary quote and click |IcEdit| to start editing its details.

3. In the **Shipping Address** section, enter the shipping address, organization name, and name of the person to which the future order should be shipped.

   .. image:: /user/img/sales/quotes/shipping_address_quote.png
      :alt: The shipping address form to be filled

   .. note:: Keep in mind that the shipping address you enter when editing a quote will be the only option available for the customer at the checkout.

4. In the **Shipping Information** section, configure the shipping options available for the customer:

   .. image:: /user/img/sales/quotes/shipping_methods.png
      :alt: Shipping options under the Shipping Information section of the Backoffice Quote Flow with Approvals

   a) In the **Shipping Methods** list, select the checkboxes next to the shipping methods you would like the customer to use for this order delivery.

      .. note:: When none of the methods are selected, the customer can use any listed methods.

      .. note:: Once you change the existing settings, the previous configuration will be saved for your information in the *Previously Selected Shipping Method* log above the list of the shipping methods.

   b) Select the preferred shipping method from the **Default Shipping Method** list if necessary. The customer can change the option to any other available shipping method.

   c) Optionally, enter the **Overridden Shipping Cost Amount, USD** - a custom shipping cost that will be used instead of the one that is dynamically generated based on the selected shipping method.

   d) To enforce using only the default Shipping method, enable the **Shipping Method Locked** flag.

   e) Select the **Allow Unlisted Shipping Methods** checkbox to allow using the shipping method already selected as a default one, even if it is disabled in this quote configuration.

.. include:: /include/include-images.rst
   :start-after: begin