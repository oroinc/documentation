:oro_documentation_types: OroCommerce

.. _config-guide--landing-commerce--products--configurable-products:
.. _config-guide--landing-commerce--products--configurable-products--global:

Configure Global Settings for Configurable Products
===================================================

In the system configuration, you can control the way a matrix form and variations of a configurable product are displayed in the storefront. Configurable product information can be set on three levels: globally, :ref:`per organization <config-guide--landing-commerce--products--configurable-products--organization>`, and :ref:`per website <config-guide--landing-commerce--products--configurable-products--website>`. Website settings override organization, organization settings override the system ones.

To set configurable products globally:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Product > Configurable Products** in the menu to the left.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

.. image:: /user/img/system/config_commerce/product/configurable_product_globally.png
   :alt: Global configurable product settings

Configurable Products
---------------------

In the **Configurable Products** section, you can customize the way a matrix form for a configurable product is displayed on a product page, product listing, and on the shopping list page.

A matrix form is applied to a configurable product with up to two attributes.

To configure a matrix form view for a particular case:

1. Clear the **Use Default** check box next to the corresponding view page and select the necessary option from the list.

2. The options available are:

    * **No Matrix Form** --- The option disables the matrix form visibility for a configurable product and displays an alternative table with a possibility to select one simple product within a configurable one at a time.

    * **Inline Matrix Form** --- With this option enabled, the matrix form is displayed next to the product image on the product details page.

    * **Popup Matrix Form** --- The option triggers a popup matrix form upon clicking the **Update Shopping List** button. Once the popup displays, a customer can select multiple simple products at a time.

    * **Group Single Products** --- The option is available only for the shopping list view. It extracts the single products which were sent to the shopping list from the configurable product matrix.


3. For **Product Views**, the options will look the following:

    .. image:: /user/img/system/config_commerce/product/matrix_view_on_product_page.png
       :alt: Different matrix form view options displayed on the product page in the storefront

4. For **Product Listings**:

    .. image:: /user/img/system/config_commerce/product/matrix_view_on_product_listing.png
       :alt: Different matrix form view options displayed on the product listing page in the storefront

5. For **Shopping Lists**:

    .. image:: /user/img/system/config_commerce/product/matrix_form_view_in_shipping_lists.png
       :alt: Different matrix form view options displayed in the storefront shopping list

6. **Allow To Add Empty Products** --- If enabled, a customer can add a configurable product with an empty matrix form to a shopping list to manage it later. To disable this possibility, clear the **Use Default** check box next to the option and then the check box of the option itself.


Variations
----------

In the **Variations** section, you can control whether to display or hide all the single products within the configurable one.

In the cases where you have plenty of products, you may need to clear the product listing and search results pages from all the variations of the configurable product removing the duplicated information.

To configure the required settings for simple products variations:

1. Clear the **Use Default** check box next to the **Display Simple Variations** field.

2. Select the necessary option from the list:

   **Everywhere** --- With this option selected, all the simple products are displayed together with the configurable one on a product page, product listing, and a shopping list page.

     .. image:: /user/img/system/config_commerce/product/display_simple_variations.png
        :alt: A storefront product listing page displaying both configurable product and its variations

   **Hide Completely** --- The option hides all the simple products that belong to the configurable one on the product listing and search results pages enabling a customer to select only the configurable one.

      .. image:: /user/img/system/config_commerce/product/hide_simple_variations.png
        :alt: A storefront product listing page displaying only the configurable product without variations

.. hint:: The **Hide from the catalog and search** feature is available since OroCommerce v4.1.4. To check which application version you are running, see the :ref:`system Information <system-information>`.

   **Hide from the catalog and search** --- The option hides all the simple products that belong to the configurable one on the product listing and search results pages. However, a customer can still order a required product variant through a quick order form or an RFQ even if such product is not displayed individually in the product catalog.

3. Click **Save Settings**.


.. include:: /include/include-images.rst
   :start-after: begin


