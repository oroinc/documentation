:oro_documentation_types: OroCommerce

.. _sys--websites--commerce--products--new-arrivals:
.. _sys--commerce--product--new-arrivals-block-website:

Configure Settings for Product Promotions per Website
=====================================================

In the Promotions section of Commerce configuration settings, you can enable **New** product icons and configure the new arrivals block for the storefront per website. You can also enable them :ref:`globally <configuration--guide--commerce--configuration--promotions>` and :ref:`per organization <sys--users--organization--commerce--products--new-arrivals>`.

Prerequisites
-------------

Before enabling the new product icons and new arrivals segment, make sure you have performed the following actions:

1. Mark the selected products as new arrivals in the **General** section of the **Products > Products** main menu by setting **Is New Arrival** to *Yes*.

2. Create a new arrivals segment under **Reports & Segments > Manage Segments** as described in the :ref:`Create Segment <user-guide--business-intelligence--create-segments>` topic.

Configure New Arrivals per Website
----------------------------------

1. Navigate to **System > Website** in the main menu.
2. For the necessary website, hover over the |IcMore| **More Options** menu to the right of the necessary website and click the |IcConfig| **Configuration** icon to start editing the configuration.
3. Select **Commerce > Product > Promotions** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/websites/web_configuration/NewArrivalsBlockWeb.png

4. In the **New Product Icons**, clear the **Use Organization** checkbox and select *Yes* in the **Show on Product View** list to enable new product icons. To disable the icons, select *No*.

5. In the **New Arrivals** section provide the following information:

   * **Product Segment** -- Select the segment that will include the items to be featured in the **New Arrivals** block.

    .. note:: If *Choose Segment* is selected, the **New Arrivals** block disappears from the homepage.

   * **Maximum Items** -- Set the maximum number of items that the block should contain. By default, the number is set to 4 items.
   * **Minimum Items** -- Set the minimum number of items that the block should contain. By default, the number is set to 3 items.

   .. note:: The block will be hidden if the number of items in the segment used for the block is less than the set value. For instance, if the set minimum number is 3 and the number of items in the segment is 2, you will not be able to see the block unless you add more items to the segment, or change the minimum value.

   * **Use Slider On Mobile** -- When the slider is enabled, the block occupies less screen space, while showing larger product images.

.. note:: When enabled, **Use Organization** allows for system settings to be used. Clear this checkbox to enable manual change of settings.

6. Click **Save**.

.. include:: /include/include-images.rst
   :start-after: begin