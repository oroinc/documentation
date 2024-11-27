.. _sys--users--organization--commerce--products--new-arrivals:
.. _sys--commerce--product--new-arrivals-block-organization:

Configure Settings for Product Promotions per Organization
==========================================================

The Promotions configuration settings can be enabled :ref:`globally <configuration--guide--commerce--configuration--promotions>`, per organization, and :ref:`website <sys--websites--commerce--products--new-arrivals>`.


Enable New Product Icons per Organization
-----------------------------------------

On the Product Promotions configuration page, you can enable **New** product icon to be displayed on the product details page.

1. Navigate to **System > User Management > Organizations** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu to the right of the necessary organization and click the |IcConfig| **Configuration** icon to start editing the configuration.
3. Select **Commerce > Product > Promotions** in the menu to the left.
4. To customize the option configuration, clear the **Use System** checkbox to override the system-wide configuration.
5. In the **New Product Icons** section, select *Yes* or *No* in the **Show on Product View** list to enable or disable new product icon on the product details page.

.. image:: /user/img/system/config_commerce/product/new-product-icon.png
   :alt: A new icon is displayed on the product details page


Configure New Arrivals per Organization (Version 5.1 and Below)
---------------------------------------------------------------

.. important:: The configuration applies to OroCommerce version 5.1 and below and is retained in the current version only for legacy backward compatibility. For v6.0 and above, please configure this option via the product segment content widget under Marketing > Content Widgets following the :ref:`new configuration logic <concept-guides--product-management--new-arrivals-products>`.

Prerequisites
^^^^^^^^^^^^^

Before enabling the new product icons and new arrivals segment, make sure you have performed the following actions:

1. Mark the selected products as new arrivals in the **General** section of the **Products > Products** main menu by setting **Is New Arrival** to *Yes*.

2. Create a new arrivals segment under **Reports & Segments > Manage Segments** as described in the :ref:`Create Segment <user-guide--business-intelligence--create-segments>` topic.


Configuration
^^^^^^^^^^^^^

To set up the new arrivals icons and segment per organization:

1. Navigate to **System > User Management > Organizations** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu to the right of the necessary organization and click the |IcConfig| **Configuration** icon to start editing the configuration.
3. Select **Commerce > Product > Promotions** in the menu to the left.

   .. note::
       For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/user_management/org_configuration/products/NewArrivalsBlockOrg.png
      :alt: New arrivals configuration per organization

4. In the **New Arrivals** section provide the following information:

   * **Product Segment** -- Select the segment that will include the items to be featured in the **New Arrivals** block.

     .. note:: If *Choose Segment* is selected, the **New Arrivals** block disappears from the homepage.

   * **Maximum Items** -- Set the maximum number of items that the block should contain. By default, the number is set to 4 items.
   * **Minimum Items** -- Set the minimum number of items that the block should contain. By default, the number is set to 3 items.

     .. note:: The block will be hidden if the number of items in the segment used for the block is less than the set value. For instance, if the set minimum number is 3 and the number of items in the segment is 2, you will not be able to see the block unless you add more items to the segment, or change the minimum value.

   * **Use Slider On Mobile** -- When the slider is enabled, the block occupies less screen space, while showing larger product images.

5. Click **Save Settings**.


.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin