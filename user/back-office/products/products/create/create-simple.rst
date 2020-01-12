:oro_documentation_types: OroCommerce

:orphan:

Create a Simple Product
-----------------------

.. start_product_create_simple

See a short demo on |how to create a simple product|, or keep reading the step-by-step guidance below.

.. raw:: html

   <iframe width="560" height="315" src="https://www.youtube.com/embed/I0dHJ87IpzE" frameborder="0" allowfullscreen></iframe>

To add a new :term:`simple product <Simple Product>` and make it available in the master catalog (for internal product management) and for purchase in the storefront:

1. Navigate to **Products > Products** in the main menu.
2. Click **Create Product**.
3. Select the **Simple** product type.
4. Select the :ref:`product family <products--product-families>` to define the product options and details that will be filled in the following steps.

5. Place the product under the necessary category in the master catalog by clicking on the category. Use the search to limit the list of categories.

6. Click **Continue**.

|
   The product details page appears.

7. In the **General** section:

   a) Enter the product SKU and name.

   b) Enter a URL slug that is used to build a human-readable URL for the product page on the storefront.

   #) Select the product status: *Enabled* or *Disabled*. When disabled, the product is not included in the catalog and is considered to be a draft.

   #) Specify whether the product should be featured or not by selecting *Yes* or *No* respectively.

   #) Specify whether the product is a new arrival. When set to *Yes*, the product is highlighted in the storefront.

      .. image:: /user/img/products/products/create_product.png
         :alt: A simple product creation page

   #) For **Brand**, select a :ref:`brand <user-guide--product-brands>` from the list. Use |IcBars| to view the list of all available brands. To create a new brand, click **+**.

   #) Configure units of quantity:

      * In the **Unit Of Quantity** list, select the main :ref:`product unit <user-guide--products--product-units-in-use>` that is shown by default when you view the product details in the storefront. Available options: *each*, *item*, *kilogram*, *piece*, *set*.

      * In the **Precision** field, set the acceptable precision (number of digits after the decimal point) for the quantity that a user may order or add into the shopping list. Items and sets are usually whole numbers, and units like kilograms may get precision of 2 to allow buying a custom volume (e.g., 0.5 kg).

      * Click **+ Add** to add more than one unit of quantity.

        .. image:: /user/img/products/products/ProductsCreate_Units.png
           :alt: The detailed setting of the additional units field

        For every additional unit, provide precision and conversion rate compared to the main unit of quantity.

        Select the **Sell** check box to enable selling the product in these units. Unless **Sell** is selected, the unit is considered to be a draft.

        You can delete the unnecessary unit of quantity by clicking the |IcClose| **Delete** icon next to it.

   #) In the **Tax Code** list, select the :ref:`product tax code <taxes--product-tax-code>` that defines the percentage of tax that may be included into the purchase order during the checkout.

      The tax calculation process depends on the tax jurisdiction that you decided to use in OroCommerce and other tax calculation options.

8. In the **Short Description** section, provide a short but meaningful default description that best positions the product for your target audience and will appear in the catalog listing. Move from tab to tab to localize the description by setting the required fallback option. From the dropdown, you can select whether to fallback to the default value, parent localization, or a custom value. When selecting the custom value, provide the localized version of the short description in the WYSIWYG field.

    .. image:: /user/img/products/products/localize_short_descriptions_product.png
       :alt: Localization fallback option for the short description of the simple product

9. In the **Description** section, provide a long default description of the product that will appear on the product view page. Move from tab to tab to localize the description by setting the required fallback option. From the dropdown, you can select whether to fallback to the default value, parent localization, or a custom value. When selecting the custom value, provide the localized version of the long description in the WYSIWYG field.

10. In the **Image** section, add a new image to the product by clicking **+Add Image** and then **Choose Image**. You can either upload a new image or select the required one from the list of available :ref:`digital assets <digital-assets>` records.

   Then, select whether to show the image as *main* (the image is used in the product details view), *listing* (the image is shown in the catalog listing), or *additional* (additional product pictures). All three categories can be selected at the same time. To remove the image, click the |IcClose| **Delete** icon next to it.

11. In the **Design** section, select the :ref:`page template <user-guide--page-templates>` from the drop-down.

   .. image:: /user/img/products/products/SimpleProductDesign.png
      :alt: The list of available page templates in the dropdown of the Page Template field

12. In the **SEO** section, provide the following information:

   * **Meta Keywords** --- Enter the meta keywords for the product. A meta keyword is a specific type of a meta tag that appears in the HTML code of a web page and helps tell search engines what the topic of the page is.
   * **Meta Title** --- Enter the meta title for the product. A meta title is what is seen by search engine users and helps a search engine to index the page.
   * **Meta Description** --- Enter the meta description for the product. A meta description summarizes a page content. Search engines show a meta description in search results if they see the searched phrase in the description.

13. In the **Inventory** section, provide the following information:

   .. start_inventory

   .. csv-table::
      :header: "Field","Description"
      :widths: 30, 60

      "**Inventory Status**","This setting enables you to define and modify status information for the stock of the product."
      "**Managed Inventory**","This setting defines the method for :ref:`inventory <user-guide--inventory>` management. With *Use category defaults*, the product's **Manage Inventory** inherits the setting selected for the product's parent category. With *Use system config*, the product uses the system configuration setting. Selecting *Yes* enables interactive updates based on the product inventory information from the **Inventory > Warehouses** section. Selecting *No* disables connection to the inventory, and uses the static **Inventory Status** value."
      "**Highlight Low Inventory**","This option defines if low inventory for products is displayed in the storefront."
      "**Inventory Threshold**","A minimum quantity of the product that is treated as In stock. When a product quantity drops below this value, the product inventory status becomes Out Of Stock."
      "**Low Inventory Threshold**","The minimum stock level defined for the product. Reaching the defined level will trigger a warning message to the buyer in the storefront."
      "**Backorders**","A flag that indicates whether OroCommerce accepts backorders. When set to *Yes*, buyers and salespeople can order products in the quantities that are not currently available in the warehouses. The remaining portion of the order will be sustained until the product gets back in stock."
      "**Decrement Inventory**","A flag that indicates whether OroCommerce decrements inventory upon order. When both **Decrement Inventory** and **Backorders** are enabled, a product quantity may become negative."
      "**Minimum Quantity to Order**","A minimum quantity that a buyer or salesperson can claim in the RFQ, customer order, quote, or a shopping list."
      "**Maximum Quantity to Order**","A maximum quantity that a buyer or salesperson can claim in the RFQ, customer order, :ref:`quote <user-guide--sales--quotes>`, or a shopping list."
      "**Is Upcoming**","This option informs a customer that the product of the selected category is not in stock currently, but will be available later. When set to *Yes*, additional **Availability Date** is displayed. To remove the upcoming products label, set the option to *No* or customize the required behavior in the :ref:`system configuration <upcoming-products-config>`."
      "**Availability Date**","The date which indicates the exact date and time since when the selected product will be available in stock."

   .. finish_inventory

   .. image:: /user/img/products/products/simple_product_inventory.png
      :alt: The detailed settings of the inventory section

14. In the **Product Price** section, add fixed product prices. Note that fixed prices override the automatically generated :ref:`price lists <user-guide--pricing>`.

    Click **+Add**, select a price list, specify quantity, units, price value, and currency.

    .. image:: /user/img/products/products/SimpleProductPrices.png
       :alt: The product prices setting

15. In the **Shipping Options** section, click **+Add Options** and provide unit, weight and weight measuring unit, dimensions (width, height, depth), and dimensions measuring unit and freight class.

16. Review translation rules for a product name, URL slug, description, and short description.

    To enter translation manually, click |IcTranslations|, clear the **Use <parent translation>** check box next to the required language, and provide your version of the translation.

    .. image:: /user/img/products/products/ProductsCreateTranslation.png
       :alt: Provide the relevant translation

17. Click **Save**.

.. stop_product_create_simple

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin