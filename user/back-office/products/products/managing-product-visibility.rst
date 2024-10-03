:oro_documentation_types: OroCommerce

.. _products--product-visibility:
.. _products--product-visibility--system-configuration:


Manage Product Visibility
=========================

.. begin

Product visibility in OroCommerce determines whether **customers can see** a product on your website. This is important for customizing your storefront to different websites, customers, or customer groups. However, visibility per master catalog category is controlled by the :ref:`category visibility settings <master-catalog-visibility>`.

.. note:: To manage product visibility, you need to have permission to view a customer, customer groups, and websites.

By default product visibility falls back to the assigned master catalog category visibility settings unless otherwise specified.

.. image:: /user/img/products/products/product_visibility/default-product-visibility.png
   :alt: Default category visibility settings set per product

The following schema illustrates all possible fallbacks where the solid lines define the fallbacks set by default.

.. image:: /user/img/products/products/product_visibility/product_visibility_fallbacks.png
   :alt: A schema that illustrates all possible fallbacks


.. important::

            You can define system-wide product visibility for existing customers. This setting applies only whenever a product visibility configuration is set to **Config**. These settings apply :ref:`globally <user-guide--customers--configuration--visibility>` and can be toggled under **System > Configuration > Commerce > Customer > Visibility**.

            .. image:: /user/img/products/products/product_visibility/system-wide-product-visibility.png
               :alt: Illustrate the product visibility configuration set to config


Product Visibility Configuration
--------------------------------

You can define whether each product should be visible on a particular website. For businesses operating in multiple regions or countries, this is especially useful. If your business has multiple websites, each can have different visibility settings for different customer groups or locations. For instance, if a product requires government approval to be sold in certain countries, you can hide it on those countries' websites until the necessary approvals are obtained.

To manage visibility settings for a particular product, navigate to **Products > Products** in the main menu, select a product to customize its visibility, click **More actions** and then **Manage Visibility** on the top right.

.. image:: /user/img/products/products/product_visibility/ProductManageVisibility.png
   :alt: Navigating to the visibility settings from the product's details page

You can switch between websites on the product visibility page and apply the necessary changes.

.. image:: /user/img/products/products/product_visibility/product-visibility-website.png
   :alt: View the product visibility settings applied individually per website

For new websites, the following default settings apply:

* *Visibility to All* defines the general visibility settings for the selected product on the chosen website.
* *Product Visibility to Customer Groups* defines visibility settings for the selected product for specific customer groups.
* *Product Visibility to Customers* defines visibility settings for the selected product for individual customers.


Visibility to All
-----------------

This setting controls the default visibility for the selected product on the chosen website and applies to all customers and customer groups unless otherwise configured. The available options include:

* *Category* -- Inherits configuration from the :ref:`master catalog category <master-catalog-visibility>` which the selected product is assigned to. It means that the current product visibility settings equal the value defined in the **Category Visibility to All** field of the related master catalog category. It is the default option for any new product.
* *Config* -- Inherits settings from the :ref:`global system configuration <user-guide--customers--configuration--visibility>`.
* *Hidden* -- The product is hidden from the storefront for all customers.
* *Visible* -- The product is visible to all customers in the storefront.

.. image:: /user/img/products/products/product_visibility/product-visibility-to-all.png
   :alt: View the product visibility settings applied to all customers


Product Visibility to Customer Groups
-------------------------------------

You can control if the product on the chosen website is shown to the customers who are members of a particular customer group (wholesalers, retailers, VIP customers, or guests, etc). You can configure specific settings for these groups based on their relationship with your business. Use one of the following options:

* *Current Product* -- Inherits the default product visibility configuration, meaning it matches the settings defined under the `Visibility to All`_ section for this product. It is the default option for any new customer group.
* *Category* -- Inherits configuration from the master catalog category to which the selected product is assigned. It means that the current product visibility settings equal the value defined in the **Category Visibility to Customer Groups** field of the related master catalog category.
* *Hidden* -- The product is hidden from the storefront for the selected customer group.
* *Visible* -- The product is visible to the selected customer group in the storefront.

.. image:: /user/img/products/products/product_visibility/product-visibility-to-customer-groups.png
   :alt: View the inherit rules for product Visibility to Customer Groups settings

Product Visibility to Customers
-------------------------------

Similarly, you can control if the product on the chosen website is shown to individual customers or businesses(Customer A, Customer B, etc). For instance, if a product is only available to selected customers, you can hide it from others. Use one of the following options:

* *Customer Group* -- Inherits the product visibility configuration from the customer group to which the selected customer is assigned, meaning it matches the settings defined under the `Product Visibility to Customer Groups`_ section for this product. It is the default option for any new customer.
* *Current Product* -- Inherits the default product visibility configuration, meaning it matches the settings defined under the `Visibility to All`_ section for this product.
* *Category* -- Inherits configuration from the master catalog category to which the selected product is assigned. It means that the current product visibility settings equal the value defined in the **Category Visibility to Customers** field of the related master catalog category.
* *Hidden* -- The product is hidden from the storefront for the selected customer.
* *Visible* -- The product is visible to the selected customer in the storefront.

.. image:: /user/img/products/products/product_visibility/product-visibility-to-customers.png
   :alt: View the inherit rules for product Visibility to Customers settings


Product Visibility Priorities
-----------------------------

* **System-wide Product Visibility**: This is the global product visibility setting that applies across the entire system whenever a product visibility configuration is set to **Config**.
* **Product Visibility**: Overrides master catalog category visibility. If a product is set to be visible, it remains visible even if its category is hidden.
* **Customer Group Visibility**: Overrides the default product visibility within the same website. If a product is visible to a customer group, it applies to all customers in that group.
* **Customer Visibility**: Overrides visibility for a customer group within the same website. If a product is set to be visible per individual customers, it remains visible to these customers even if visibility for a customer group to which the customer is assigned is set to be hidden.


**Related Topics**

* :ref:`Configure Global Visibility Settings <user-guide--customers--configuration--visibility>`
* :ref:`Manage Category Visibility <master-catalog-visibility>`