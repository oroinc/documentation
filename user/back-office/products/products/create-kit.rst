:oro_documentation_types: OroCommerce

.. _products--products--create-product-kit:

Create a Product Kit
--------------------

.. hint:: This section is part of the :ref:`Product Management <concept-guides--product-management>` topic that provides a general understanding of the product concept in OroCommerce.

A product kit is a grouping of products that you can sell together as a bundle.

To create a new product kit:

1. Navigate to **Products > Products** in the main menu.
2. Click **Create Product**.
3. Select the **Kit** product type from the dropdown.

   .. image:: /user/img/products/products/kits/product-type-kit.png
      :alt: Selection of the kit product type

4. Select the :ref:`product family <products--product-families>` to define the product options and details that will be filled in the following steps.
5. Place the product under the necessary category in the master catalog by clicking on the category. Use the search to limit the list of categories.
6. Click **Continue**.
7. Fill in the product details, as described in the topic on :ref:`creating a simple product <products--products--create-simple-product>`.
8. In the **Kit Items** section, you can add as many kit items and products to the kits as necessary. For each kit item you add, you can provide the following details:

   .. image:: /user/img/products/products/kits/kit-items.png
      :alt: Fields in the kit items section

   * **Label** -- Provide name for the kit item. It will be displayed in the back-office kit section, as well as :ref:`in the storefront when configuring the kit <storefront-guide--orders-kits>` and adding it to the shopping list.
   * **Sort Order** -- Set the sort order to set the order in which kits are displayed in the storefront compared to other available kits. The lower is the number, the higher is the priority.
   * **Optional** -- Indicates whether this kit item is required for purchase, or can be skipped by the customer.
   * **Minimum Quantity** -- The minimum number of products a customer can purchase as part of the kit.
   * **Maximum Quantity** -- The maximum number of products a customer can purchase as part of this kit.
   * **Unit of Quantity** -- Select the :ref:`product unit <user-guide--products--product-units-in-use>` for the product kit items. Available options: *each*, *item*, *kilogram*, *piece*, *set*.

   .. hint:: You can expand or collapse each Kit Item section to display or hide the details of the product(s) that come as part of the kits.

             .. image:: /user/img/products/products/kits/collapse-expand.gif
                :alt: Collapsing and expanding the product kit section

             |

             You can also drag and drop products in the kit section to a different position:

             |

             .. image:: /user/img/products/products/kits/drag-drop.gif
                :alt: Dragging and dropping products in the kit

9. When you are ready to save the product, click **Save and Close**.

.. hint:: You can choose to sell an item exclusively as part of the kit, and not separately. To hide it from buyers in the storefront, change the product's :ref:`visibility settings <products--product-visibility>` to **Hidden**. Customers will still be able to :ref:`purchase it <storefront-guide--orders-kits>` but only as part of the selected kit.

          .. image:: /user/img/products/products/kits/item-only-for-kits.png
             :alt: Standalone product hidden and can only by purchased in a product kit

**Related Topics**

* :ref:`Product Kits Concept Guide <concept-guides--product-management-kits>`
* :ref:`Tax Calculation in Kits <bundle-docs-commerce-tax-bundle-kits>`

