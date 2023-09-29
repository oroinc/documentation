.. _doc-integration-fixed-shipping-cost:

Configure Fixed Product Shipping Cost Integration in the Back-Office
====================================================================

.. hint:: This section is part of the :ref:`Shipping Configuration <admin-guide--shipping>` topic that provides a general understanding of the shipping concept in OroCommerce.

In OroCommerce, you can set a fixed shipping cost to a product or a group of products and configure the required rules and surcharges for them. To enable this shipping method, first, create a Fixed Product Cost shipping integration to expose it as a shipping method for the storefront.

.. note::
   See a short demo on |how to set up a shipping integration in OroCommerce| or keep reading the step-by-step guidance below.

    .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/ileKXVTG6B8" frameborder="0" allowfullscreen></iframe>

To enable fixed product shipping cost integration:

1. Navigate to the **Manage Integrations** page by clicking **System > Integrations > Manage Integrations** in the main menu.

2. Click **Create Integration** and select Flat Rate Shipping as integration type:

   .. image:: /user/img/system/integrations/fixed-product-cost/fixed-product-cost-integration.png
      :class: with-border

3. Type in the integration name and label (e.g., Fixed Product Shipping). Add label translations, if necessary.

#. Set status to **Active** to enable the integration.

#. Click **Save**.

Next, set up a shipping rule via the :ref:`Shipping Rules Configuration <sys--shipping-rules>` page to enable and configure this shipping method.

.. hint:: Fixed Product Shipping Cost Method and its configuration through :ref:`a shipping rule <shipping-rule-fixed-product-shipping-cost>` can work in conjunction with the values defined in the :ref:`Shipping Cost price attribute <products--shipping-options-price-attribute>`. For example, if the shipping cost for a product is set to $2.70 and the surcharge configured for the Fixed Shipping Cost shipping method is $3, then the shipping charge at checkout will equate to $5.70.

            .. image:: /user/img/products/price_attributes/shipping-cost-price-attribute-with-integration.png
               :scale: 42%
               :alt: Illustration of how shipping cost set for the price attribute works on combination with the surcharge defined in the fixed product shipping cost integration


**Related Topics**

* :ref:`Shipping Configuration Concept Guide <admin-guide--shipping>`
* :ref:`System Shipping Configuration <configuration--guide--commerce--configuration--shipping>`
* :ref:`Shipping Rules Configuration <sys--shipping-rules>`
* :ref:`Shipping Cost Price Attribute <products--shipping-options-price-attribute>`

.. include:: /include/include-links-user.rst
   :start-after: begin