Price List Management for a Customer Group
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To configure the price list priority and controlled merge for the customer group:

#. Navigate to **Customers > Customer Groups** in the main menu.

#. Find the necessary Customer Group in the list, hover over the |IcMore| *more actions* menu in the line and click the |IcEdit| to start editing the customer group details.

#. In the **Price Lists** section, you can build an aggregated price list for every website you have configured in OroCommerce. Use tabs to switch between the websites, e.g. Default, US, Australia, etc. in the example below.

   .. image:: /user_guide/img/customers/customer_groups/CustomerGroupsPrices.png
      :class: with-border

   To form an aggregated price list:

     #) Set up the fallback option to provide the price source if the price is not available in the directly configured price lists.

     #) Select the price list to enable it for the customer group.

        .. note:: You can add more than one price list:

                  * Click **+ Add Price List**.
                  * Select the additional price list from the list.
                  * Set the numeric priority. OroCommerce searches for the product price in the higher priority price lists first.
                  * Enable price lists merge, if necessary. When the merge is enabled, the unit prices may be merged from the lower priority price lists, when they are missing in the higher priority ones.

#. Click **Save** once you are happy with the price list set up.

.. stop

.. include:: /user_guide/include_images.rst
   :start-after: begin
