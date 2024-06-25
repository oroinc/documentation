.. _concept-guides--product-management:

Product Management Concept Guide
================================

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
   :align: center

* :ref:`Product units <user-guide--products--product-units-in-use>` --- determine the quantity of a product. They are the units of measurement, such as *item, hour, kilogram, piece*, or *set*. A product can have one or multiple product units which enables customers to select the required one in the storefront.

* :ref:`Product attributes <products--product-attributes>` --- are specific characteristics of a product, such as *type, color, size, style, inventory status, brand*, etc. You can create as many attributes as you want to specify more details of a product. Keep in mind that some attributes are system attributes that are built in the OroCommerce platform (e.g., *name, description, sku, price*). Such attributes cannot be modified or deleted. You can also make the attributes filterable and enable customers to find the product by setting the necessary parameters in the storefront.

.. image:: /user/img/concept-guides/products/filters.png
   :alt: Product filters in the storefront
   :align: center

* All product attributes are grouped into dedicated **attribute groups** that organize your product page. Attribute groups are the tabs or titled sections that combine similar parameters. Following this, the SEO section, for example, would include *meta title, description*, and *meta keywords*. You can create any attribute group that would fit your products with any attributes that would describe those products the best. All attribute groups are arranged into a product family.

* A :ref:`product family <products--product-families>` --- combines all attributes related to a specific product. If you have different product types (e.g., TVs and digital cameras), it is better to create an individual product family per each type. This way, your customers will see only the relevant attributes associated with your products. For example, such attributes as *resolution* and *number of hdmi inputs* can be included into the TVs product family, while *megapixels* and *sensor size* would be the attributes of the digital cameras product family. If you put all your attributes into one product family, your customers will see irrelevant filters in the storefront that can affect their purchasing decision. As for the system attributes, they are included into all product families by default, as they contain the core information of a product, such as a name, sku, descriptions, and meta tags.

* :ref:`Product brands <user-guide--product-brands>` --- are system attributes assigned to each product by default. You can create a list of brands in the back-office, and then, associate your products with a specific brand for easier search in the storefront.

All the product components are used when creating simple and configurable products. If you are not sure where to start when creating a product, follow the sequential steps below for the reference:

.. image:: /user/img/concept-guides/products/product_creation_steps.png
   :alt: Product filters in the storefront
   :align: center

.. _concept-guides--product-management-types:

Simple vs Configurable Products vs Kits
---------------------------------------

In OroCommerce, products can be of three types, simple, configurable and kits. The product type selected at the first step of product creation in the back-office determines the way product information is used and managed in OroCommerce.

**Simple products** are physical items that exist in a basic, single variation. Their qualifiers, such as color or size, cannot be modified meaning customers cannot select the same product with slightly different characteristics. Simple products have a unique SKU and serve as ‘building blocks’ for configurable products. You can manage the inventory information and the price for a simple product.

.. image:: /user/img/concept-guides/products/simple-product.png
   :alt: An example of a simple product displayed in the storefront
   :align: center

Unlike a simple product, **a configurable product** is an item available in multiple variations. Customers configure the product in terms of its color, size or any other applicable parameters according to buying needs. Buyers in the storefront choose from the options provided to ‘configure’ a product according to their needs.

However, in the back-office, configurable products are more sophisticated. A configurable product is known as a single parent product uniting multiple product variants. These product variants are assigned unique SKUs for easy inventory tracking, have their own inventory and price settings, and are generally treated as separate products in product information management (PIM) UIs. As the configurable product and all of its variants share the same set of attributes, they share the product family.

.. image:: /user/img/concept-guides/products/SampleConfigSimpleGrid.png
   :alt: Both configurable and simple products are illustrated in the products grid
   :align: center

For example, a USB flash drive may be available in various colors and capacity (e.g., Red USB drive 64 GB, Red USB drive 256 GB, White USB drive 128 GB, Black USB drive 64 GB). In this case, the generic USB flash drive is a configurable product, Red USB drive 64 GB, Red USB drive 256 GB, White USB drive 128 GB, and Black USB drive 64 GB are product variants (created as simple products), and *color* and *capacity* are configurable attributes in the generic USB flash drive.

A configurable attribute is one of the product attributes that are used to distinguish product variants of the same configurable product. There should be at least one configurable attribute specified for the configurable product in order to enable the customer to perform product variant selection.

To purchase multiple product variants in one order, use a :ref:`matrix order form <frontstore-guide--orders-matrix>` in the storefront. It provides improved visibility into product offerings and enables you to create complex bulk orders quickly.

.. image:: /user/img/concept-guides/products/matrix_popup.png
   :alt: Matrix form in the storefront illustrating variations of a usb drive
   :align: center

A **product kit** is an assortment of products, each with their individual SKUs. Each product in this assortment bundle can be mandatory or optional for the buyers to buy in order to proceed though the checkout. An example of a product kit would be a lamp with a selection of optional accessories or services for it, such as spare bulbs of different wattage or warranty.

.. image:: /user/img/concept-guides/products/kit-front.png
   :alt: Product kits in the storefront

.. note:: Check out the :ref:`Product Kits Concept Guide <concept-guides--product-management-kits>` for more information on product kits.

Products in a Multi-Org Application
-----------------------------------

Products, product attributes, and product families are managed per organization. Whenever you create a new organization, a default product family is created automatically.

.. note:: Products from other organizations are not visible in the storefront. If you want multiple websites to share the same product collection, make sure that these websites are in the same organization.

.. note:: The multi-org and multi-website functionality is only available in the Enterprise edition.

If you have a multi-org application, you can create products with the same SKU and URL slug in different organizations. You can also manage the product attributes of each organization independently of other organizations in the system. It means that any product attribute modifications fulfilled within one organization do not affect the product attributes available in others.

Some product attributes are global, which means that they were created in the global organization and can only be managed by its admins. You can use global attributes in other organizations but not edit them or create a new product attribute with the same name as a global attribute.

.. _highlight-products-on-the-storefront:

Products in the Storefront
--------------------------

There is a number of ways to display your products effectively in OroCommerce.

When the required number of products has been created or imported, you can further improve on their visual representation in the storefront to simplify purchase choices for your buyers, help engage your target audience, and convince them to make the purchase. Usually, these options are :ref:`configured per level <configuration--guide--config-levels>`.

The products that appear on the home page of the OroCommerce storefront are customized through the configuration settings of:

* A :ref:`master catalog <user-guide--master-catalog>` or a :ref:`web catalog <user-guide--web-catalog>` that organize all existing products in your store by categories.
* A :ref:`featured products segment <concept-guides--product-management--featured-products>` that displays the selected products on the crowded paths of you website.
* A :ref:`new arrivals segment <concept-guides--product-management--new-arrivals-products>` that showcases a few new products of your store that you want to promote.
* A :ref:`new product icon <sys--commerce--product--new-arrivals>` that highlights the products as new.
* A :ref:`product image watermark <configuration--guide--commerce--configuration--product-images>` that can be added on top of the images for the selected products.

.. image:: /user/img/concept-guides/products/highlight_products_home_page.png
   :alt: Visual representation of products on the home page
   :align: center

You can configure the :ref:`All Products page <sys--conf--commerce--catalog--special-pages>` to display all available products from the master catalog grouped by categories.

You can also enable the :ref:`image preview on product listing page <sys--commerce--product--product-images--image-preview--global>` to see the product image gallery when clicking on the |ZoomIc| icon on a product image in the storefront.

.. image:: /user/img/concept-guides/products/all_product_page_storefront.png
   :alt: Visual representation of products on the product listing page
   :align: center


.. _user-guide--products--recommendations:

Product Recommendations
-----------------------

OroCommerce understands the importance of providing personalized and relevant product suggestions to customers, which is why it offers sellers the ability to enhance the shopping experience and increase sales through the use of product recommendations. There are:

 * similar products
 * related products
 * up-sell products
 * featured products

By leveraging these product recommendation features, OroCommerce empowers sellers to curate a personalized shopping experience that engages customers and drives conversions. Through targeted suggestions and strategic promotions, sellers can increase customer satisfaction, boost sales, and foster long-term loyalty.

Similar Products
^^^^^^^^^^^^^^^^

.. note:: Similar Products are available for the OroCommerce Enterprise edition if Elasticsearch is used as the search engine.

The Similar Products feature is designed to assist sellers in showcasing products on the product view page that are similar or complementary to the one currently being viewed by a customer. Based on the information stored in the search index, OroCommerce intelligently identifies and displays similar products, encouraging customers to explore additional options that align with their interests.

You can enable and configure the Similar Products feature in the system configuration :ref:`globally <sys--commerce--catalog--relate-products>`, per :ref:`organization <sys--users--organization--commerce--catalog--related-products>`, and per :ref:`website <sys--websites--commerce--catalog--related-products>`. For example, you can enable buyers to add a similar product to the shopping list directly from the product view page where the recommendation appears or toggle the minimum and maximum number of products displayed on the page.

.. image:: /user/img/concept-guides/products/similar-products.png
   :alt: Illustration of similar product recommendations in the back-office and storefront

Related Products
^^^^^^^^^^^^^^^^

The Related Products feature allows sellers to showcase a curated selection of products closely associated with the item a customer is currently viewing. OroCommerce identifies and presents related products that align with the customer's interests and preferences, guiding them towards products they may have otherwise overlooked.

By strategically selecting and displaying related products, sellers can encourage customers to explore additional offerings, discover new items, and make informed purchase decisions.

You can enable and configure the Related Products feature in the system configuration :ref:`globally <sys--commerce--catalog--relate-products>`, per :ref:`organization <sys--users--organization--commerce--catalog--related-products>`, and per :ref:`website <sys--websites--commerce--catalog--related-products>`. For example, you can ensure that related products are automatically linked to each other, enhancing the effectiveness of product recommendations. So if a customer is viewing the standing lamp, they will see the lightning bulb as a suggested related product. Similarly, if a customer is viewing the lightning bulb, they will also see the standing lamp as a related item.

You can also control whether customers can add a related item to the shopping list directly from the view page of the product they are browsing.

.. image:: /user/img/concept-guides/products/related-products-config.png
   :alt: Global related items configuration

Up-Sell Products
^^^^^^^^^^^^^^^^

This feature allows sellers to leverage customers' buying intent by suggesting higher-priced or upgraded alternatives to the product they are currently viewing on the product view page. By strategically showcasing products that offer additional features, improved quality, or enhanced functionality, sellers can encourage customers to consider upgrading their purchase, ultimately increasing the average order value and maximizing revenue.

The Up-sell feature enables sellers to tap into the customer's desire for a better product or an elevated shopping experience. By presenting a more premium option, sellers can cater to varying customer needs and preferences while simultaneously boosting their sales performance.

You can enable and configure the up-sell product feature options :ref:`globally <sys--commerce--catalog--relate-products>`, per :ref:`organization <sys--users--organization--commerce--catalog--related-products>`, and per :ref:`website <sys--websites--commerce--catalog--related-products>`.

.. image:: /user/img/concept-guides/products/up-sell-config.png
   :alt: Illustration of the related and up-sell products segments in the storefront

.. _concept-guides--product-management--featured-products:

Featured Products
^^^^^^^^^^^^^^^^^

.. important:: As of OroCommerce v6.0, the configuration logic for the featured products block has been updated. Users of v5.1 and earlier should configure the block following the :ref:`principles for those versions <sys--commerce--product--featured-products>`. While users of the **Refreshing Teal** theme can use the new configuration principles described in the section.

The featured products feature provides sellers with an opportunity to highlight specific products in their website's storefront. This feature allows for strategic placement of products that are popular, on sale, or aligned with current marketing campaigns, effectively capturing the attention of customers as soon as they land on the website.

.. note:: Keep in mind that **featured products segment** is different from the :ref:`featured_menu <menu-management-concept-guide>`. While the featured products segment is intended to store only the products and categories that are marked as featured, the featured menu is designed to offer any other information that you want to emphasize.

   .. image:: /user/img/concept-guides/menus/featured_menu_vs_segment.png
      :alt: A sample of the featured_menu and a featured product segment in the storefront


To add the featured products block to any storefront page, you need to:

1. Mark the selected products as featured in the **General** section of the **Products > Products** main menu by setting **Is Featured** to *Yes*.

.. image:: /user/img/concept-guides/products/is-featured.png
   :alt: Toggling the Is Featured setting to Yes.

2. Create a featured products segment to include all products that you have marked as featured under **Reports & Segments > Manage Segments** as described in the :ref:`Create Segment <user-guide--business-intelligence--create-segments>` topic.

.. image:: /user/img/concept-guides/products/featured-segment.png
   :alt: Creating a segment with a list of all products marked as featured

3. Create a :ref:`product segment content widget <content-widgets-product-segment>` to include the featured products segment that you have configured in Step 2.

.. image:: /user/img/concept-guides/products/featured-products-content-widget.png
   :alt: Creating a product segment content widget with the featured products selected for segment

4. Once you save the content widget, you can now place it to the required location in the :ref:`WYSIWYG <getting-started-wysiwyg-editor-field>` field of your landing page or content block.

.. image:: /user/img/concept-guides/products/featured-products-content-widget-wysiwyg.png
   :alt:  Adding a block content widget to a WYSIWYG field


.. _concept-guides--product-management--new-arrivals-products:

New Arrivals Products
^^^^^^^^^^^^^^^^^^^^^

.. important:: As of OroCommerce v6.0, the configuration logic for the new arrivals products block has been updated. Users of v5.1 and earlier should configure the block following the :ref:`principles for those versions <configuration--guide--commerce--configuration--promotions>`. While users of the **Refreshing Teal** theme can use the new configuration principles described in the section.

The new arrivals products feature provides sellers with an opportunity to highlight new products in their website's storefront, effectively capturing the attention of customers as soon as they land on the website.

To add the new arrivals products block to any storefront page, you need to:

1. Mark the selected products as new arrivals in the **General** section of the **Products > Products** main menu by setting **Is New Arrival** to *Yes*.

.. image:: /user/img/concept-guides/products/new-arrivals.png
   :alt: Toggling the New Arrival setting to Yes.

2. Create a new arrivals products segment to include all products that you have marked as new arrival under **Reports & Segments > Manage Segments** as described in the :ref:`Create Segment <user-guide--business-intelligence--create-segments>` topic.

3. Create a :ref:`product segment content widget <content-widgets-product-segment>` to include the new arrival products segment that you have configured in Step 2.

.. image:: /user/img/concept-guides/products/new-arrivals-products-content-widget.png
   :alt: Creating a product segment content widget with the new arrival products selected for segment

4. Once you save the content widget, you can now place it to the required location in the :ref:`WYSIWYG <getting-started-wysiwyg-editor-field>` field of your landing page or content block.

.. image:: /user/img/concept-guides/products/new-arrivals-products-content-widget-wysiwyg.png
   :alt:  Adding a block content widget to a WYSIWYG field


As you can see, with OroCommerce you can create an appealing and functional product pages that are the key to sales in online stores of all kinds.

**Related Articles**

* :ref:`Product Kits <concept-guides--product-management-kits>`
* :ref:`Products User Guide <doc--products>`
* :ref:`Product-Related Settings in System Configuration <configuration--products>`

.. include:: /include/include-links-seo.rst
   :start-after: begin

.. include:: /include/include-images.rst
   :start-after: begin

.. toctree::
   :hidden:
   :maxdepth: 1

   Product Kits <kits-concept>


.. admonition:: Business Tip

   |What is B2B eCommerce| and how it can benefit your business? You'll find answers to this and other commerce-related questions in our guide.