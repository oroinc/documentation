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

3. In the **General** section, define the following fields:

   * **Owner** --- Select the owner of the product brand. This limits the list of users who can manage it.
   * **Name** --- Provide the brand name. The field is mandatory.
   * **Slug** --- Enter a URL slug that is used when building a human-readable URL on the front store. If the field is left blank, the slug will be generated automatically.
   * **Status** --- Select product brand status (*Enabled*/*Disabled*). The field is mandatory.
   * **Description** --- Enter a product brand description.
   * **Short Description** --- Enter a short but meaningful description of the product brand to make identification of the brand easier.
   
4. In the **SEO** section, provide the following information:

   * **Meta Title** --- Enter the meta title for the product brand. The meta title is what is seen by search engine users and used by the search engine to help it index the page
   * **Meta Description** --- Enter meta description for the product brand. The meta description summarizes page content. Search engines show meta description in search results when the searched phrase is contained in the description.
   * **Meta Keywords** --- Enter meta keywords for the product. Meta keyword is a specific type of a meta tag that appears in the HTML code of a web page and helps tell search engines what the topic of the page is.
   
5. Click **Save**.

Create a Brand when Creating or Editing the Product
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. include:: /user_guide/products/products/actions_details/manage_brand.rst
   :start-after: start_products_actions_manage_brand
   :end-before: stop_products_actions_manage_brand

.. finish_product_brand

.. include:: /user_guide/include_images.rst
   :start-after: begin
