.. _user-guide--product-brands:

Use Product Brands
------------------

.. begin_product_brand

For enhanced eCommerce experience, Oro Application provides the ability to create and manage brands for your webstore. This means that each product can be associated with a specific brand, created in the management console.

In this section you will learn how to:

.. contents:: :local:

Create a Brand 
~~~~~~~~~~~~~~

There are two ways to create a brand, from scratch and when creating/editing a product.

Create a New Brand from Scratch
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. Navigate to **Products > Product Brands** in the main menu.
2. Click **Create Brand**.

The following page opens:

.. image:: /user_guide/img/products/products/CreateNewBrand.png
   :class: with-border

In the **General** section, define the following fields:

1. **Owner**: Select the owner of the product brand. This limits the list of users who can manage it.
2. Name: Provide the brand name. The field is mandatory.
3. **Slug**: Enter a URL slug that is used when building a human-readable URL on the front store. If left blank, the slug will be automatically generated.
4. **Status**: Select product brand status (Enabled/Disabled). The field is mandatory.
5. **Description**: Enter product brand description 
6. **Short Description**: Enter short product brand description to make identification of the brand easier.
   
In the **SEO** section, provide the following information:

1. **Meta Title**: Enter the metatitle for the product brand. The meta title is what is seen by search engine users and used by the search engine to help it index the page
2. **Meta Description**: Enter meta description for the product brand. The meta description summarizes page content. Search engines show meta description in search results when the searched phrase is contained in the description.
3. **Meta Keywords**: Enter meta keywords for the product. Meta keyword is a specific type of a meta tag that appears in the HTML code of a web page and helps tell search engines what the topic of the page is.
   
When you have completed creating the brand, click **Save**.

Create a Brand when Creating or Editing the Product
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. Navigate to **Products > Products**.
2. Select the product you wish to assign this brand to, and click |IcEdit| in the |IcMore| more actions menu on the far right of the product field.
3. Click **+** next to Brand field in the product edit form to create a new brand.
4. Click **Save** in the top right corner.

Assign Brand to a Product 
~~~~~~~~~~~~~~~~~~~~~~~~~

Once you have created a brand, you can assign it to a product the following way:

1. Navigate to **Products > Products**.
2. Select the product you wish to assign this brand to, and click |IcEdit| in the |IcMore| more actions menu on the far right of the product field.

.. image:: /user_guide/img/products/products/ProductsMoreActions.png
   :class: with-border

3. In the Brand field of the product edit form, select the brand from the dropdown, or view the list of all available brands by clicking |IcBars|. 
   To create a new brand, click **+**.

.. image:: /user_guide/img/products/products/SelectBrand.png
   :class: with-border

4. Click **Save** when you are done.

The brand has been assigned to the product and should now be available in the front store.

.. image:: /user_guide/img/products/products/BrandFrontStore.png

.. finish_product_brand

.. include:: /user_guide/include_images.rst
   :start-after: begin
