:oro_documentation_types: OroCommerce

.. _concept-guides--product-management:

Product Management
==================

Configuring your online web store for success means making it easy for users to browse your site and find the product they search for. With the optimized product pages, you can showcase your goods and services in the most appropriate way increasing your conversion and sales.

Usually, good graphics and visuals are the top factors that affect user's purchase decision. An appealing visual representation of a product in the storefront requires no less complex work in the backend. OroCommerce enables you to develop a product page that can be properly arranged and optimized based on your requirements and business needs. A product page can display any information ranging from variations of one product, featured products, related and up-sell products in the way you desire and to the customers you prefer.

The configuration of a product may differ depending on your business strategy, sales, volumes, location, and visibility restrictions. But the logic for creating a product is unique. Below, we will dive further into it.

Product Components
------------------

Product management in OroCommerce comprises several elements that provide an organized structure to your product pages. These are:

* product units
* product attributes
* attribute groups
* product family
* brands

To illustrate the dependencies of these elements, and why they are essential for the product creation and configuration, let's take a look at the following product information:

.. image:: /user/img/concept-guides/products/product_concepts.png
   :alt: Main elements that constitute a product

* :ref:`Product units <user-guide--products--product-units-in-use>` --- determine the quantity of a product. They are the units of measurement, such as *item, hour, kilogram, piece*, or *set*. A product can have one or multiple product units which enables customers to select the required one in the storefront.

* :ref:`Product attributes <products--product-attributes>` --- are specific characteristics of a product, such as *type, color, size, style, inventory status, brand*, etc. You can create as many attributes as you want to specify more details of a product. Keep in mind that some attributes are system attributes that are built in the OroCommerce platform (e.g., *name, description, sku, price*). Such attributes cannot be modified or deleted. You can also make the attributes filterable and enable customers to find the product by setting the necessary parameters in the storefront.

    .. image:: /user/img/concept-guides/products/filters.png
       :alt: Product filters in the storefront

* All product attributes are grouped into dedicated **attribute groups** that organize your product page. Attribute groups are the tabs or titled sections that combine similar parameters. Following this, the SEO section, for example, would include *meta title, description*, and *meta keywords*. You can create any attribute group that would fit your products with any attributes that would describe those products the best. All attribute groups are arranged into a product family.

* A :ref:`product family <products--product-families>` --- combines all attributes related to a specific product. If you have different product types (e.g., TVs and digital cameras), it is better to create an individual product family per each type. This way, your customers will see only the relevant attributes associated with your products. For example, such attributes as *resolution* and *number of hdmi inputs* can be included into the TVs product family, while *megapixels* and *sensor size* would be the attributes of the digital cameras product family. If you put all your attributes into one product family, your customers will see irrelevant filters in the storefront that can affect their purchasing decision. As for the system attributes, they are included into all product families by default, as they contain the core information of a product, such as a name, sku, descriptions, and meta tags.

* :ref:`Product brands <user-guide--product-brands>` --- are system attributes assigned to each product by default. You can create a list of brands in the back-office, and then, associate your products with a specific brand for easier search in the storefront.


All the product components are used when creating simple and configurable products. If you are not sure where to start when creating a product, follow the sequential steps below for the reference:

    .. image:: /user/img/concept-guides/products/product_creation_steps.png
       :alt: Product filters in the storefront



Simple vs Configurable Products
-------------------------------

In OroCommerce, products can be of two types, simple and configurable. The product type selected at the fist step of product creation in the back-office determines the way product information is used and managed in OroCommerce.

**Simple products** are physical items that exist in a basic, single variation. Their qualifiers, such as color or size, cannot be modified meaning customers cannot select the same product with slightly different characteristics. Simple products have a unique SKU and serve as ‘building blocks’ for configurable products. You can manage the inventory information and the price for a simple product.

.. image:: /user/img/concept-guides/products/SimpleProductScreenFrontStore.png
   :alt: An example of a simple product displayed in the storefront

Unlike a simple product, **a configurable product** is an item available in multiple variations. Customers configure the product in terms of its color, size or any other applicable parameters according to buying needs. Buyers in the storefront choose from the options provided to ‘configure’ a product according to their needs.

However, in the back-office, configurable products are more sophisticated. A configurable product is known as a single parent product uniting multiple product variants. These product variants are assigned unique SKUs for easy inventory tracking, have their own inventory and price settings, and are generally treated as separate products in product information management (PIM) UIs. As the configurable product and all of its variants share the same set of attributes, they share the product family.

.. image:: /user/img/concept-guides/products/SampleConfigSimpleGrid.png
   :alt: Both configurable and simple products are illustrated in the products grid

For example, a USB flash drive may be available in various colors and capacity (e.g., Red USB drive 64 GB, Red USB drive 256 GB, Green USB drive 128 GB, Black USB drive 64 GB). In this case, the generic USB flash drive is a configurable product, Red USB drive 64 GB, Red USB drive 256 GB, Green USB drive 128 GB, and Black USB drive 64 GB are product variants (created as simple products), and *color* and *capacity* are configurable attributes in the generic USB flash drive.

A configurable attribute is one of the product attributes that are used to distinguish product variants of the same configurable product. There should be at least one configurable attribute specified for the configurable product in order to enable the customer to perform product variant selection.

To purchase multiple product variants in one order, use a :ref:`matrix order form <frontstore-guide--orders-matrix>` in the storefront. It provides improved visibility into product offerings and enables you to create complex bulk orders quickly.

.. image:: /user/img/concept-guides/products/matrix_popup.png
   :alt: Matrix form in the storefront illustrating variations of a usb drive


Products in a Multi-Org Application
-----------------------------------

Products, product attributes, and product families are managed per organization. Whenever you create a new organization, a default product family is created automatically.

.. note:: Products from other organizations are not visible in the storefront. If you want multiple websites to share the same product collection, make sure that these websites are in the same organization.

If you have a multi-org application, you can create products with the same SKU and URL slug in different organizations. You can also manage the product attributes of each organization independently of other organizations in the system. It means that any product attribute modifications fulfilled within one organization do not affect the product attributes available in others.

Some product attributes are global, which means that they were created in the global organization and can only be managed by its admins. You can use global attributes in other organizations but not edit them or create a new product attribute with the same name as a global attribute.


.. _highlight-products-on-the-storefront:

Products in the Storefront
--------------------------

There is a number of ways to display your products effectively in OroCommerce.

When the required number of products has been created or imported, you can further improve on their visual representation in the storefront to simplify purchase choices for your buyers, help engage your target audience, and convince them to make the purchase. Usually, these options are :ref:`configured per level <configuration--guide--config-levels>`.

The products that appear on the home page of the OroCommerce storefront are customized through the configuration settings of:

    * A :ref:`Master catalog <user-guide--master-catalog>` or a :ref:`web catalog <user-guide--web-catalog>` --- which organize all existing products in your store by categories.
    * A :ref:`featured products segment <products--featured-products>` --- that displays the selected products on the crowded paths of you website.
    * A :ref:`new arrivals segment <sys--commerce--product--new-arrivals-block-global>` --- that showcases a few new products of your store that you want to promote.
    * A :ref:`new product icon <sys--commerce--product--new-arrivals>` --- that highlights the products as new.
    * A :ref:`product image watermark <configuration--guide--commerce--configuration--product-images>` --- that can be added on top of the images for the selected products.

    .. image:: /user/img/concept-guides/products/highlight_products_home_page.png
       :alt: Visual representation of products on the home page

On the product details page, you can configure the following options:

    * A :ref:`product image gallery <sys--commerce--product--product-images--gallery-slider-global>` --- that controls the way the product options are displayed on the product page. You can select whether to use popup or inline view for the image gallery.
    * A :ref:`related products block <sys--commerce--catalog--relate-products--main>` --- that binds similar products related to those currently browsed by the customer or those that complement each other, like the laptop and its accessories, a mouse, notebook bag or screen cleaning cloths.
    * An :ref:`up-sell products block <sys--commerce--catalog--upsell-products>` --- that binds products that should be promoted with the product selected by the customer, like more expensive alternatives of the model, upgrade options, additional parts. Taking the example of the laptop, that would be a laptop with a larger screen, better processor, or higher hard drive capacity than the customer planned to buy.

    .. image:: /user/img/concept-guides/products/highlight_products_details_page.png
       :alt: Visual representation of products on the product details page

You can configure the :ref:`All Products page <sys--conf--commerce--catalog--special-pages>` to display all available products from the master catalog grouped by categories. Here, you can also customize the :ref:`image preview on product listing page <sys--commerce--product--product-images--image-preview--global>` to see the product image gallery instead of the product page when clicking on the image in the product listing.

.. image:: /user/img/concept-guides/products/all_product_page_storefront.png
   :alt: Visual representation of products on the product details page


As you can see, with OroCommerce you can create an appealing and functional product pages that are the key to sales in online stores of all kinds.

**Related Topics**

* :ref:`Products User Guide <doc--products>`
* :ref:`Product-Related Settings in System Configuration <configuration--products>`.

