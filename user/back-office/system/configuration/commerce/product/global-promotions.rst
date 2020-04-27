:oro_documentation_types: OroCommerce

.. _configuration--guide--commerce--configuration--promotions:
.. _user-guide--new-products:
.. _sys--commerce--product--new-arrivals:
.. _sys--commerce--product--new-arrivals-block-global:


Product Promotions
==================

On the Product Promotions configuration page, you can enable **New** product icons and set up a **New Arrivals** block globally, :ref:`per organization <sys--users--organization--commerce--products--new-arrivals>` and :ref:`per website <sys--websites--commerce--products--new-arrivals>`.

.. image:: /user/img/system/config_commerce/product/new_arrivals_diff.png
   :alt: A new arrivals flag vs a new arrivals segment


Prerequisites
-------------

Before enabling the new product icons and new arrivals segment, make sure you have performed the following actions:

1. Mark the selected products as new arrivals in the **General** section of the **Products > Products** main menu by setting **Is New Arrival** to *Yes*.

2. Create a new arrivals segment under **Reports & Segments > Manage Segments** as described in the :ref:`Create Segment <user-guide--business-intelligence--create-segments>` topic.


Configure New Arrivals Globally
-------------------------------

1. In the main menu, navigate to **System > Configuration**.
2. Select **Commerce > Product > Promotions** in the menu to the left.

   .. note::
      For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/config_commerce/product/NewArrivalsBlockSystemConfig.png
      :alt: Global new arrivals configuration

3. In the **New Product Icons**, clear the **Use Default** check box and select *Yes* in the **Show on Product View** list to enable new product icons. To disable the icons, select *No*.

    A new product icon will look differently for various layout options:

    * **For tiles**:

    .. image:: /user/img/system/config_commerce/product/NewArrivalsFrontstoreTiles.png
       :class: with-border
       :alt: New product icon look for tiles

    * **For details**:

    .. image:: /user/img/system/config_commerce/product/NewArrivalsFrontstoreDetails.png
       :class: with-border
       :alt: New product icon look for details

    * **For compact details**:

    .. image:: /user/img/system/config_commerce/product/NewArrivalsFrontstoreCompactDetails.png
       :class: with-border
       :alt: New product icon look for compact details


3. In the **New Arrivals** section provide the following information:

   * **Product Segment** -- Select the segment that will include the items to be featured in the **New Arrivals** block.

    .. note:: If *Choose Segment* is selected, the **New Arrivals** block disappears from the homepage.

   * **Maximum Items** -- Set the maximum number of items that the block should contain. By default, the number is set to 4 items.
   * **Minimum Items** -- Set the minimum number of items that the block should contain. By default, the number is set to 3 items.

   .. note:: The block will be hidden if the number of items in the segment used for the block is less than the set value. For instance, if the set minimum number is 3 and the number of items in the segment is 2, you will not be able to see the block unless you add more items to the segment, or change the minimum value.

   * **Use Slider On Mobile** check box -- When the slider is enabled, the block occupies less screen space, while showing larger product images.

.. note:: Clear the **Use Default** check box to change settings manually.

