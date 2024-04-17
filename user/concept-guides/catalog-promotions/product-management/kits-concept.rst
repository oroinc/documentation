.. _concept-guides--product-management-kits:

Product Kits Concept Guide
==========================

In the rapidly changing world of e-commerce, it has become increasingly important for businesses to cater to their customers' diverse needs and preferences. One way to achieve this is by offering customizable product bundles or kits. These kits allow merchants to create bundled offerings that include multiple items, providing customers with convenience, value, and flexibility. By creating tailored kits, businesses can enhance customer satisfaction and drive higher sales. This approach enables customers to purchase products that match their unique requirements while taking advantage of bundled pricing and convenience.

.. image:: /user/img/concept-guides/products/kit-example.png
   :alt: Illustration of a Laptop product kit in the storefront and its kits items such as RAM and Storage

Product Kits vs Other Product Types
-----------------------------------

In OroCommerce, understanding the distinctions between simple :ref:`products, configurable products, and product kits <concept-guides--product-management-types>` is crucial for effective product management and sales strategies.

Simple products represent standalone items with fixed attributes and prices, ideal for straightforward purchasing scenarios.

Configurable products offer variations within a single product listing, allowing customers to select different options such as size or color before making a purchase.

Unlike simple or configurable products, :ref:`product kits <products--products--create-product-kit>` are not a singular entity but rather a collection of separate products bundled together. Each item within a product kit maintains its individual identity and pricing, offering customers a curated selection of products bundled for convenience. What sets product kits apart is that they allow the same kit to be added to a shopping list multiple times if it is added with different configurations. This distinction ensures that customers have the flexibility to customize their purchases while enjoying the convenience and value of a bundled offering.

.. image:: /user/img/concept-guides/products/product-types.png
   :alt: Illustration of simple, configurable products and kits

Types of Product Kits
---------------------

There are two distinct types of Product Kits available for you to choose from - those with a base kit price and those without.

**A product kit with a base price** is a bundle that functions as the primary product, with its own fixed price, in addition to containing other products with their own prices. In this case, the price of the product kit is the price of the kit itself plus the products it contains. This type of bundle is particularly useful when you want to offer a package deal that includes a specific product as the core offering, with additional items added on as optional extras. An example of a product kit with a base price could be a laptop in its basic configuration that can be purchased on its own; its product kit items could be internal configurations or accessories for the laptop, offering to upgrade the basic configuration.

.. image:: /user/img/concept-guides/products/kit-base-price.png
   :alt: Product kit items in the back-office illustrating a product kit with a price

The product kit mentioned above includes a laptop in its basic configuration with a base price of $299.99. If a buyer wants to purchase more than one laptop, there will be a price reduction to $199.99 per product for 10+ laptops or $199.99 per product for 50+ laptops. Customers in the storefront can also choose to upgrade the basic configuration by opting for better RAM, storage capacity, graphics, and add a 12 months warranty, if required. The price of each upgrade will be added to the price of the product kit itself.

.. hint:: Every product in the kit and the kit itself can have tier pricing, depending on the number of items are to be purchased. For more information on pricing and quantity tiers, see :ref:`Price Management Concept Guide <user-guide--pricing>`.

**A product kit without a base price** is a collection of items that are sold together as a bundle. In this case, the price of the bundle is the total price of all the individual items that are included in the package. This type of bundle is ideal when you want to offer a set of products that customers can purchase together as a complete package, rather than as separate items (e.g., a collection of wireless accessories for a laptop).

.. image:: /user/img/concept-guides/products/kits-items-bo.png
   :alt: Illustration of a product kit with a collection of items where the kit itself has no price

Both types of product kits can include items that are mandatory or optional. In the example above, a product kit comprising a set of wireless accessories consists of three mandatory items and three optional items that a buyer may choose to include in their kit.

You can control the :ref:`visibility of products <products--product-visibility>` in the kits if you do not wish to allow the buyers in the storefront to purchase items from the kit individually. To hide products in the storefront, navigate to **Products > Products** in the back-office main menu, select a product to customize its visibility, click **More actions** and then **Manage Visibility** on the top right.

.. image:: /user/img/concept-guides/products/hide-product-kit-item.png
   :alt: Changing the visibility of a product from the product kit to 'hidden'

At the checkout, buyers are able to see the items included in the kit, reflecting its price and the price of its products.

.. image:: /user/img/concept-guides/products/kit-with-vs-without-price.png

Inventory in Kits
-----------------

:ref:`Inventory management <concept-guide--inventory>` works the same way for product kits as it does for other types of products. When :ref:`decrement inventory <configuration--guide--commerce--configuration--inventory--product-options>` is enabled, inventory adjustments are made for the entire product kit as a single entity rather than for each of its individual components. This ensures that the availability of the bundled offering accurately reflects the actual stock available. In the storefront, buyers are always notified if the quantity of the kit itself or any of its individual items is low, or if a product is upcoming or out-of-stock.

Promotions in Kits
------------------

:ref:`Promotions <concept-guides--promotion-management>` can significantly enhance the appeal of product kits to customers in OroCommerce. Unlike individual items, promotions, and :ref:`coupons <user-guide--marketing--promotions--coupons>` are applied to the entire kit rather than to each item separately, offering customers value and savings across the bundled offering. Additionally, merchants have the flexibility to create :ref:`expressions for coupons <user-guide--marketing--promotions--conditions>` to trigger promotions based on specific products included in the kit (of other conditions). Regardless of which products trigger the promotion, the resulting discount applies uniformly to the entire kit. This approach ensures consistency in applying discounts while simplifying the management of promotions for bundled product offerings in OroCommerce.

Taxes in Kits
-------------

In OroCommerce, :ref:`tax calculation <bundle-docs-commerce-tax-bundle-kits>` for product kits is handled by considering the tax settings associated with each individual product contained within the kit. Since each product in the kit may have its own tax code, taxes are computed separately for every item included in the kit.

In the example below, all items in the kit, except for *8DO33 Receipt Printer* are taxable at 10%. Tax is calculated by taking 10% off the price of each product kit item including the base price of the kit itself ($375.99).

.. code-block:: none

   ($240+$280+$96+$375.99) x 10% = $99.20

.. image:: /user/img/concept-guides/products/tax-kit-exmpt.png
   :alt: Tax applied only to taxable item

When calculating taxes after promotions for a product kit,discounts subtotal is distributed proportionally between the product kit subtotal, taking into account the :ref:`Calculate Taxes After Promotions option <user-guide--taxes--tax-configuration>`.

* When the option is enabled, the taxes are calculated on the :ref:`reduced price <user-guide--marketing--promotions>` after the discounts are applied.

.. image:: /user/img/concept-guides/products/taxes-after-promotion.png
   :alt: Tax is calculated after the discount is applied

* If this option is disabled, the taxes are calculated based on the full price before the discounts are applied.

.. image:: /user/img/concept-guides/products/taxes-before-promotion.png
   :alt:  Tax is calculated before the discount is applied

By accounting for the specific tax attributes of each product, OroCommerce ensures precise tax calculations for every component of the kit, ensuring compliance with tax regulations and providing transparent pricing for customers.

**Related Topics**

* :ref:`Create a Product Kit  <products--products--create-product-kit>`
* :ref:`Order a Product Kit in the Storefront <storefront-guide--orders-kits>`
* :ref:`Tax Calculation in Kits <bundle-docs-commerce-tax-bundle-kits>`