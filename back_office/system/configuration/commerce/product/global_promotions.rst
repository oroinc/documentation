.. _configuration--guide--commerce--configuration--promotions:

Product Promotions
==================

On the Product Promotions configuration page, you can control the following settings:

* :ref:`New Products Icon <sys--commerce--product--new-arrivals>`
* :ref:`New Arrivals Block <sys--commerce--product--new-arrivals-block-global>`

.. _sys--commerce--product--new-arrivals:

Enable New Product Icons
------------------------

.. hint:: You can enable new product icons globally, :ref:`per organization <sys--users--organization--commerce--products--new-arrivals>` and :ref:`per website <sys--websites--commerce--products--new-arrivals>`.

To enable New Product icons globally:

1. In the main menu, navigate to **System > Configuration**.
2. Select **Commerce > Product > Promotions** in the menu to the left.

   .. note::
      For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /img/system/config_commerce/product/NewArrivalsBlockSystemConfig.png

3. In the **New Product Icons** section, clear the **Use Default** check box and select **Yes** in the **Show on Product View** field.

4. Click **Save**.

.. note:: To disable 'New Product' icons, select **No** in the **Show on Product View** field, and click **Save**.

.. _sys--commerce--product--new-arrivals-block-global:

Set Up New Arrivals
-------------------

.. hint:: You can enable new arrivals globally, :ref:`per organization <sys--commerce--product--new-arrivals-block-organization>` and :ref:`per website <sys--commerce--product--new-arrivals-block-website>`.

To set up the New Arrivals block globally:

1. In the main menu, navigate to **System > Configuration**.
2. Select **Commerce > Product > Promotions** in the menu to the left.

   .. note::
      For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.


   .. image:: /img/system/config_commerce/product/NewArrivalsBlockSystemConfig.png

3. In the **New Arrivals** section provide the following information:

   * **Product Segment** -- Select the segment that will include the items to be featured in the **New Arrivals** block.

    .. note:: If *Choose Segment* is selected, the **New Arrivals** block disappears from the homepage.

   * **Maximum Items** -- Set the maximum number of items that the block should contain. By default, the number is set to 4 items.
   * **Minimum Items** -- Set the minimum number of items that the block should contain. By default, the number is set to 3 items.

   .. note:: The block will be hidden if the number of items in the segment used for the block is less than the set value. For instance, if the set minimum number is 3 and the number of items in the segment is 2, you will not be able to see the block unless you add more items to the segment, or change the minimum value.

   * **Use Slider On Mobile** check box -- When the slider is enabled, the block occupies less screen space, while showing larger product images.

.. note:: Clear the **Use Default** check box to change settings manually.

