.. _user-guide--landing-pages--marketing--content-blocks:

.. begin 

Content Blocks
--------------

Content Blocks are the foundation of your site and they can help create a custom layout. In Oro applications, you can modify the existing content blocks, or create your own.

.. note:: Creating a new content block requires developers' assistance. As a sample, use Home Page Slider content block, the `code <https://github.com/orocommerce/orocommerce/blob/master/src/Oro/Bundle/CMSBundle/Migrations/Data/ORM/LoadHomePageSlider.php>`_ and `configuration <https://github.com/orocommerce/orocommerce/blob/master/src/Oro/Bundle/CMSBundle/Resources/views/layouts/default/oro_frontend_root/home_page_slider.yml>`_ in yaml file that help embedd it into the website homepage.

To edit a defined content block:

1. Navigate to **Marketing > Content Blocks** in the main menu.
2. Click |IcMore| at the end of the content block you wish to edit, and click |IcEdit| to open the selected block for editing. 
   
   .. image:: /user_guide/img/marketing/landing_pages/ContentBlocks.png
      :class: with-border

   The following page opens: 

   .. image:: /user_guide/img/marketing/landing_pages/ContentBlocksPage.png
      :class: with-border

3. In the *General* tab, you can amend the following fields:
   
   * **Owner**: The owner of the content block.
   * **Alias**:  The unique identifier that can be used in the layout to render a block.
   * **Titles**: Localized block title.

   .. note:: To enable/disable the content block, select/clear the **Enabled** checkbox.
 
 
4. In the *Restrictions* section, you can specify or edit visibility restrictions for the content block.
   
   By default, the content block is displayed for any localization, on any website, and for any customer.
   To make OroCommerce apply a content block to the front store only for the particular combination of these facts, create a restriction by selecting all or some of the following: target localization, website, and customer or customer group.

   .. note:: Only one field must be chosen for customers at a time, either a customer group and a customer.
 
   .. image:: /user_guide/img/marketing/landing_pages/ContentBlocksRestrictions.png
      :class: with-border

6. In the *Content Variants* section, you can add (click **Add Content**) or remove (click |IcDeactivate|) various content variants for the content block. Once you add more than one content variant, you will have to apply restrictions to any non-default variants. These restrictions help you set up the conditions where content should override the default option.

   .. warning:: Never leave the restrictions for non-default variant empty. This may cause unexpected priority collision between the default and non-default variant.

   .. note:: Only one field must be chosen for customers at a time, either a customer group and a customer.

   .. image:: /user_guide/img/marketing/landing_pages/ContentVariantsRestrictions.png
      :class: with-border 

For instance, you can set the content block to have a specific text displayed for *Non-authenticated Visitors*. For that:

1. Set visibility restrictions to *Non-authenticated Visitors* in **Restrictions > Customer Groups**.
2. Add a new content variant by clicking **Add Content** in the **Content Variant** section.
3. Enter text.
   
.. image:: /user_guide/img/marketing/landing_pages/ContentBlocksSample.png
   :class: with-border

.. finish 

.. include:: /user_guide/include_images.rst
   :start-after: begin
