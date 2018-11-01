Create a Website
^^^^^^^^^^^^^^^^

To create a new website in OroCommerce:

1. Navigate to **System > Websites** using the main menu.

   .. image:: /admin_guide/img/websites/Websites.png
      :class: with-border

2. Click **Create Website**. The following page opens:

   .. image:: /admin_guide/img/websites/create_website.png
      :class: with-border

3. Enter the website name.

4. In the *Price Lists* section, configure the following options:

     * **Fallback** - specify whether the website prices should reuse the global price list defined in the system configuration whenever the product price is not available in the price list specified for the website.

     * **Price Lists** - select the price list to use for this website. You may add multiple price lists using **+ Add Price List** option and specify the priority and merge policy that controls the way price is looked up.

         .. image:: /admin_guide/img/websites/create_website_multi_pricelists.png
            :class: with-border

       Priority defines in which order OroCommerce walks through the price lists to find a product price. Whenever the price is not found in the higher priority price list, OroCommerce switches to the next one.

       To configure flexible price options, set **Merge** flags for the price lists you would like to combine to cover the most product units. The unit price from the lower priority price list is used when it is missing in the higher priority price list. This mechanism applies only to the price lists where the *merge* is enabled.

       .. note:: Price list configuration on the customer or customer group level may override the website configuration.

5. Click **Save**.

**Next steps**

* After creating the website in OroCommerce, ensure that the customer users will navigate to the website in your planned scenarios. Perform the necessary configuration on the web server or cookie preparation in order to make the website identifiable. For more details on the necessary configuration outside OroCommerce, please refer to the *src/Oro/Bundle/MultiWebsiteBundle/Resources/doc/website_matchers.md* document in the OroCommerce Enterprise GitHub repository.
* Make the necessary :ref:`adjustments <system-websites--prepare-to-host-a-website-in-the-domain-sub-folder>` if you plan to host several websites on the same domain, in the sub-folders (e.g. http://store.com/uk and http://store.com/us).


