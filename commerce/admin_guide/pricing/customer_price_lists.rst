.. _customers--customers--edit--price-lists:

Configure Price List per Customer
---------------------------------

.. begin

To change the price list settings for the customer:

1. Navigate to **Customers > Customer** in the main menu.

2. Click the |IcMore| **More Options** menu to the right of the necessary customer and then click the |IcEdit| **Edit** icon to start editing customer details.

3. In the **Price Lists** section, do the following to configure price lists that are used for price calculation when the customer users access the particular website (for example, *Default*):

   .. tip:: Switch between the websites using tabs.

   .. image:: /user_guide/img/customers/customers/customer_price_lists.png
      :class: with-border

   a) Select one of the following values for the **Fallback** option:

      * *Customer Group* --- OroCommerce uses :ref:`Price Lists from the customer group configuration <customers--customer-groups--edit--price-lists>` to calculate the prices shown in the storefront.

      * *Current customer only* --- For price calculation, OroCommerce uses the configurations (per website) in the current customer group.

   .. include:: /admin_guide/pricing/common_price_list_configuration_options.rst
      :start-after: price_list_actions_begin
      :end-before: price_list_actions_end

4. Click **Save**.

.. finish


**Related Articles**

* :ref:`Pricing Configuration <pricing-configuration>`

* :ref:`Price List Configuration per Website <sys--website--edit--price-lists>`

* :ref:`Price List Configuration per Customer Group <customers--customer-groups--edit--price-lists>`


.. include:: /img/buttons/include_images.rst
   :start-after: begin
