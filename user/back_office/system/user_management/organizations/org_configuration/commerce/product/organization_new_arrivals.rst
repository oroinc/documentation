.. _sys--users--organization--commerce--products--new-arrivals:
.. _sys--commerce--product--new-arrivals-block-organization:

Product Promotions per Organization
-----------------------------------

.. begin

In the Promotions section of Commerce configuration settings, you can enable new product icons and configure the new arrivals block for the storefront per organization.

1. Navigate to **System > User Management > Organizations** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu to the right of the necessary organization and click the |IcConfig| **Configuration** icon to start editing the configuration.
3. Select **Commerce > Product > Promotions** in the menu to the left.

   .. note::
       For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/user_management/org_configuration/products/NewArrivalsBlockOrg.png
      :alt: New arrivals configuration per organization

4. In the **New Product Icons**, clear the **Use Default** check box and select *Yes* in the **Show on Product View** list.
5. In the **New Arrivals** section provide the following information:

   * **Product Segment** -- Select the segment that will include the items to be featured in the **New Arrivals** block.

     .. note:: If *Choose Segment* is selected, the **New Arrivals** block disappears from the homepage.

   * **Maximum Items** -- Set the maximum number of items that the block should contain. By default, the number is set to 4 items.
   * **Minimum Items** -- Set the minimum number of items that the block should contain. By default, the number is set to 3 items.

     .. note:: The block will be hidden if the number of items in the segment used for the block is less than the set value. For instance, if the set minimum number is 3 and the number of items in the segment is 2, you will not be able to see the block unless you add more items to the segment, or change the minimum value.

   * **Use Slider On Mobile** -- When the slider is enabled, the block occupies less screen space, while showing larger product images.

.. note:: When enabled, **Use System** allows for system settings to be used. Clear this check box to enable manual change of settings.

6. Click **Save Settings**.

.. note:: To disable the 'New Product' icons, select *No* in the **Show on Product View** list, and click **Save Settings**.

.. finish

.. include:: /include/include_images.rst
   :start-after: begin