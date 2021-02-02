:oro_documentation_types: OroCommerce

.. _user-guide--product-brands:

Manage Product Brands in the Back-Office
========================================

.. hint:: This section is a part of the :ref:`Product Management <concept-guides--product-management>` topic that provides the general understanding of the product concept in OroCommerce.

For enhanced eCommerce experience, Oro Application provides the ability to create and manage brands for your web store. This means that each product can be associated with a specific brand, created in the back-office.

In this section you will learn how to:

Create a Brand 
--------------

There are two ways to create a brand, from scratch and when creating/editing a product.

Create a New Brand from Scratch
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. Navigate to **Products > Product Brands** in the main menu.
2. Click **Create Brand**.
3. In the **General** section, define the following fields:

   * **Owner** --- Select the owner of the product brand. This limits the list of users who can manage it.
   * **Name** --- Provide the brand name. The field is mandatory.
   * **Slug** --- Enter a URL slug that is used when building a human-readable URL in the storefront. If the field is left blank, the slug will be generated automatically.
   * **Status** --- Select product brand status (*Enabled*/*Disabled*). The field is mandatory.

4. In the **Short Description** section, provide a short but meaningful default description of the product brand to make identification of the brand easier. Move from tab to tab to localize the description by setting the required fallback option. From the dropdown, you can select whether to fall back to the default value, parent localization, or a custom value. When selecting the custom value, provide the localized version of the short description in the text field.

    .. image:: /user/img/products/products/localize_short_descriptions_brands.png
       :alt: Localization fallback option for the short description of the master catalog

5. In the **Long Description** section, enter a long default description of the product brand. Move from tab to tab to localize the description by setting the required fallback option. From the dropdown, you can select whether to fall back to the default value, parent localization, or a custom value. When selecting the custom value, provide the localized version of the long description in the WYSIWYG field. For more details on WYSIWYG management, see the :ref:`WYSIWYG Editor <getting-started-wysiwyg-editor-field>` topic.

   
6. In the **SEO** section, provide the following information:

   * **Meta Title** --- Enter the meta title for the product brand. The meta title is what is seen by search engine users and used by the search engine to help it index the page
   * **Meta Description** --- Enter the meta description for the product brand. The meta description summarizes page content. Search engines show the meta description in search results when the searched phrase is contained in the description.
   * **Meta Keywords** --- Enter meta keywords for the product. Meta keyword is a specific type of a meta tag that appears in the HTML code of a web page and helps tell search engines what the topic of the page is.
   
7. Click **Save**.

Create a Brand when Creating or Editing the Product
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. Navigate to **Products > Products** in the main menu.
2. Select the product you wish to assign this brand to, click the |IcMore| **More Options** menu on the far right of the product row, and click |IcEdit| **Edit**.
3. On the product edit page, click **+** next to the **Brand** field to create a new brand.
4. Click **Save**.

.. _doc--products--actions--manage-brand:

Manage Product Brands
---------------------

Assign Brand to a Product
^^^^^^^^^^^^^^^^^^^^^^^^^

Once you have created a brand, you can assign it to a product the following way:

1. Navigate to **Products > Products** in the main menu.
2. Select the product you wish to assign this brand to, click the |IcMore| **More Options** menu on the far right of the product row, and click |IcEdit| **Edit**.
3. On the product edit page, next to the **Brand** field, select the brand from the list, or click |IcBars| to view the list of all available brands.

   To create a new brand, click **+**.

   .. image:: /user/img/products/products/SelectBrand.png
      :alt: Select the brand from the list next to the Brand field

4. Click **Save**.

The brand has been assigned to the product and should now be available in the storefront.

.. image:: /user/img/products/products/BrandFrontStore.png
   :alt: The brand is assigned to the product and appears in the storefront

Make a Brand Filterable
^^^^^^^^^^^^^^^^^^^^^^^

Once a brand has been created and assigned to a product, you may set it filterable for the customers to narrow down their search and navigate through your web store in a more efficient and simple way.

1. Navigate to **Products > Product Attributes** in the main menu.
2. Click the **brand** attribute or |IcEdit| at the end of the row to edit the attribute. Keep in mind that editing of the system attributes is only possible in the :ref:`global organization <user-guide-getting-started-change-organization>`.
3. In the **Frontend options** section, set the **Filterable** option to **Yes**.

   .. image:: /user/img/products/products/brand_filters_2.png
      :alt: Set the Filterable option to yes

4. Click **Save and Close**.

The brand filter is now available in the storefront.

 .. image:: /user/img/products/products/brand_filters_1.png
    :alt: Display the filter by brands in the storefront if the Filterable option is set to yes



.. include:: /include/include-images.rst
   :start-after: begin
