.. _customers--customer-groups--edit--price-lists:

Price List Configuration per Customer Group
-------------------------------------------

.. begin

To change the price list settings for the customer group:

1. Navigate to **Customers > Customer Group** in the main menu.

2. Click the |IcMore| **More Options** menu to the right of the necessary customer group and then click the |IcEdit| **Edit** icon to start editing the group details.

3. In the **Price Lists** section, do the following to configure price lists that are used for price calculation when the customer users who belong to this customer group access the particular website (for example, *Default*):

   .. tip:: Switch between the websites using tabs.

   .. image:: /user_guide/img/customers/customer_groups/customer_group_price_lists.png
      :class: with-border

   a) Select one of the following values for the **Fallback** option:

      * *Website* --- OroCommerce uses :ref:`Website Price Lists from the selected website configuration <sys--website--edit--price-lists>` to calculate the prices shown in the front store.

      * *Current customer group only* --- For price calculation, OroCommerce uses the configurations (per website) in the current customer group.

   .. include:: /configuration_guide/pricing/common_price_list_configuration_options.rst
      :start-after: price_list_actions_begin
      :end-before: price_list_actions_end

4. Click **Save**.

.. finish

.. include:: /user_guide/include_images.rst
   :start-after: begin
