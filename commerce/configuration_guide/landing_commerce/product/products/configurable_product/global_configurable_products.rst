.. _config-guide--landing-commerce--products--configurable-products--global:

Customize Configurable Products Globally
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. begin

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Product > Configurable Products** in the menu to the left.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

The following page opens:

.. image:: /configuration_guide/img/configurable_products/configurable_product_globally.png

Here, you can customize a matrix form view for a configurable product as well as set visibility restrictions for all the simple products that compose the configurable one.

A matrix form is applied to a configurable product with up to two attributes. It can be displayed as follows:

* On a product page:

.. image:: /configuration_guide/img/configurable_products/matrix_product_view.png

* On the product listing:

.. image:: /configuration_guide/img/configurable_products/matrix_product_listing.png

* On a shopping list page:

.. image:: /configuration_guide/img/configurable_products/matrix_shopping_list.png

To configure a matrix form view for a particular case:

1. Clear the **Use Default** check box next to the corresponding view page.

2. Select the necessary option from the following list:

   * **No Matrix Form** --- The option disables the matrix form visibility for a configurable product and displays an alternative table with a possibility to select one simple product within a configurable one at a time.

     .. image:: /configuration_guide/img/configurable_products/no_matrix_form.png

   * **Inline Matrix Form** --- With this option enabled, the matrix form is displayed next to the product image on the product details page.

     .. image:: /configuration_guide/img/configurable_products/matrix_product_view.png

   * **Popup Matrix Form** --- The option triggers a popup matrix form upon clicking the **Update Shopping List** button. Once the popup displays, a customer can select multiple simple products at a time.

     .. image:: /configuration_guide/img/configurable_products/matrix_popup.png

   * **Group Single Products** --- The option is available only for the shopping list view. It extracts the single products which were sent to the shopping list from the configurable product matrix.

     .. image:: /configuration_guide/img/configurable_products/group_single_products.png

3. By default, a customer can add a configurable product with an empty matrix form to a shopping list to manage it later. To disable this possibility, clear the **Use Default** check box next to the **Allow To Add Empty Products** option and then the check box of the option itself.

Also, you can control whether to display or hide all the single products within the configurable one.

In the cases where you have plenty of products, you may need to clear the product listing and search results pages from all the variations of the configurable product removing the duplicated information.

1. In the **Variations** section, clear the **Use Default** check box next to the **Display Simple Variations** field.

2. Select the necessary option from the list:

   **Everywhere** --- With this option selected, all the simple products are displayed together with the configurable one on a product page, product listing, and a shopping list page.

     .. image:: /configuration_guide/img/configurable_products/group_single_products.png

   **Hide Completely** --- The option hides all the simple product that belong to the configurable one and displays only the latter.

      .. image:: /configuration_guide/img/configurable_products/hide_completely_simple_products.png


3. Click **Save Settings**.


.. finish

.. include:: /user_guide/include_images.rst
   :start-after: begin
