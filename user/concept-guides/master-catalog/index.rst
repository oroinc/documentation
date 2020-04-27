:oro_documentation_types: OroCommerce

.. _concept-guide-master-catalog:

Master Catalog Management
=========================

Setting up a :ref:`master catalog <user-guide--master-catalog>` may be one of the first steps of your OroCommerce journey. One OroCommerce :ref:`organization <user-management-organizations>` always has only **one master catalog** that structures all existing products in your store by categories to help you organize what you are selling. By configuring a particular set of product options, visibility, and SEO settings for each master catalog category, you enforce a unified selling strategy.

It is a good idea to create product :ref:`categories <user-guide--master-catalog--category_creation>` before populating the master catalog with products. You can then either add the products manually or import them in bulk by uploading a .csv list of all products. You can adjust your .csv file to the OroCommerce’s template and import it to the master catalog. Once you import the products, they are displayed on the product list page (grid) in the back-office and inside their respective master catalog categories. It is important to remember that one product can reside only in one category of the master catalog.

.. image:: /user/img/products/master_catalog/catalog_product_options.png
   :alt: The default product options details page

Master Catalog in a Multi-Org Application
-----------------------------------------

.. note:: The multi-org functionality is only available in the Enterprise edition.

Each :ref:`organization <user-management-organizations>` is an independent organism with a separate inventory, products, and the organization configuration options that may or may not fall back to the :ref:`system configuration <mc-system-configuration>`. That is why the master catalog is never replicated in other organizations. Whenever you create a new organization in the same OroCommerce application, a blank category **All Products** is automatically added to the master catalog as a placeholder for your product structure, so you could create and configure a new master catalog specific to this organization.

Consider each available organization in your OroCommerce application as an umbrella that covers one master catalog, multiple web catalogs, and enables you to share products across all websites that belong to this organization.

.. image:: /user/img/products/master_catalog/mc_multi-org.png
   :align: center
   :scale: 60%
   :alt: Illustration of a multi-org application

Master VS Web Catalog
---------------------

Although they may sound similar, a master and a :ref:`web catalog <user-guide--web-catalog>` are not quite the same. While the master catalog is responsible for the organization of a product collection inside the company, a web catalog is used to display products to customers on the website. Unlike the master catalog, one organization can have multiple web catalogs.

The master and the web catalog share some terminology, namely a product, a category, and a product collection.

- A product and a product collection. The master and web catalogs share the same product collection but unlike the former, a web catalog can have the same product in multiple categories.
- A category. You can add any master catalog product category to a :ref:`content node of a web catalog <user-guide--web-catalog-edit-content-tree>`, adding various localization, website or customer restrictions to it.

The master catalog organizes, categorizes, and stores the details of all your products (even those that you may not want to sell immediately), and a web catalog helps present these products in a personalized way that fits your target audience, website, or sales strategy. Think of a master catalog as a storage room, and a :ref:`web catalog <user-guide--web-catalog>` as your shop window (of which you can have more than one). You keep all your products in the storage room but display only some of them in a specific way and order in the shop windows.

Please be aware that the master catalog product structure impacts the way products are displayed in the OroCommerce storefront only if there is no :ref:`web catalog <user-guide--web-catalog>` or if no web catalog is connected to your website. This behavior is the same, regardless of the organization.

.. important:: For more information on how to create master catalog categories and import product collection, refer to the :ref:`Master Catalog Back-Office Guide <user-guide--master-catalog>`. For information on building web catalogs, refer to the :ref:`Web Catalogs Back-Office Guide <user-guide--web-catalog>`

**Related Topics**

* :ref:`Master Catalog <user-guide--master-catalog>`
* :ref:`Manage Product Visibility <products--product-visibility>`
* :ref:`Web Catalogs <user-guide--web-catalog>`
* :ref:`Build a Custom Web Catalog From Scratch <user-guide--marketing--web-catalog--sample>`
* :ref:`Use Web Catalog Nodes as Root Nodes <user-guide--web-catalog-navigation-tool>`

**Further Practice**

* `Fundamental OroCommerce Online Course <https://oroinc.com/b2b-ecommerce/course/fundamental-orocommerce>`__


