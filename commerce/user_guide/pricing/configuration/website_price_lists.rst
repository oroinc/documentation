:orphan:

.. _sys--website--edit--price-lists:

Price List Configuration per Website
------------------------------------

.. begin

To change the default price list settings for the website:

1. Navigate to **System > Websites** in the main menu.

2. Click the |IcMore| **More Options** menu to the right of the necessary website and click the |IcEdit| **Edit** icon to start editing the website details.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

3. In the **Price Lists** section:

   .. image:: /user_guide/img/system/websites/website_price_lists.png
      :class: with-border

   a) Select one of the following values for the **Fallback** option for the users who are visiting this website:

      * *Config* --- OroCommerce uses :ref:`Default Price Lists from the system configuration <sys--config--commerce--catalog--pricing>` to calculate the prices shown in the front store.

      * *Current website only* --- For price calculation, OroCommerce uses the configuration from the website settings.

   .. include:: /user_guide/pricing/configuration/common_price_list_configuration_options.rst
      :start-after: price_list_actions_begin
      :end-before: price_list_actions_end

4. Click **Save**.

.. finish

.. include:: /user_guide/include_images.rst
   :start-after: begin
