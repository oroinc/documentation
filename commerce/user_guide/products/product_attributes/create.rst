.. _products--product-attributes--create:

.. begin

.. TODO add definition to every option

Create a Product Attribute
^^^^^^^^^^^^^^^^^^^^^^^^^^

To create a new Product Attribute:

1. Navigate to **Products > Product Attributes** using the main menu.

.. image:: /user_guide/img/products/product_attributes/ProductAttributes.png
   :class: with-border

2. Click **Create attribute**. The following page opens:

.. image:: /user_guide/img/products/product_attributes/ProductAttributesCreate.png
   :class: with-border

3. Fill in the field name using only alphabetic symbols, underscore and numbers. It should be between 2 and 22 characters long.

4. Select an attribute type (bigint, select, string, etc) and click **Continue**. 

   The page with more product attribute details opens.

5. Fill in remaining general information:

   .. image:: /user_guide/img/products/product_attributes/ProductAttributesCreate2_1.png
      :width: 450px
      :class: with-border

   * Attribute label

   * Attribute description

6. Provide additional information for product attributes depending on their type:

   * For **Select** and **Multi-Select**:

      - Click **+ Add** next to the *Options*.

      - Type in the option label. Tick the box next to the default option.

        .. image:: /user_guide/img/products/product_attributes/ProductAttributesCreate2_1_Select2.png
           :class: with-border

      - Repeat for more options.

        .. image:: /user_guide/img/products/product_attributes/ProductAttributesCreate2_1_Select3.png
           :class: with-border
      - Click **Do not set as default** link to clear the *Default* flag.

   * For **Image**:

     Enter maximum allowed file size and provide the thumbnail dimensions.

     .. image:: /user_guide/img/products/product_attributes/ProductAttributesCreate2_1_Image.png
        :class: with-border

   * For **File**:

     Enter maximum allowed file size.

     .. image:: /user_guide/img/products/product_attributes/ProductAttributesCreate2_1_File.png
        :class: with-border
        
6. Fill in **Import & Export** details:

   .. image:: /user_guide/img/products/product_attributes/ProductAttributesCreate2_1_Import.png
      :class: with-border

   * Column Name
   * Column Position
   * Use As Identity Field (options: **No**, Only when not empty, Always)
   * Exclude Column (options: **No**, Yes)

7. In the Other section, specify the configuration options for the product attribute view, search and use in other areas in OroCommerce:

   .. image:: /user_guide/img/products/product_attributes/ProductAttributesCreate2_1_Other1.png
      :class: with-border

   * Available In Email Templates (options: **Yes**, No)
   * Contact Information
   * Add To Grid Settings (**Yes and display**, )
   * Show Grid Filter (**No**)
   * Show On Form (**Yes**,)
   * Show On View (**Yes**,)
   * Priority
   * Searchable (**No**,) - includes the attribute into the search options on the backend.
   * Auditable (**No**, )
   * Applicable Organizations (All)
   * Searchable (**No**, Yes) - includes the attribute into the search options on the OroCommerce web store.
   * Filterable (**No**, Yes)
   * Sortable (**No**, Yes)
   * Enabled (**No**, Yes)

8. Once all options and information are provided, click **Save**.

9. If the created attribute is of a *table column* storage type, click **Update Schema** to reindex the data for search and filter. 
   The product attribute storage type is set to *table column* for the attribute with Select of Multi-Select data type, and also for attribute of any type with *Filterable* or *Sortable* option enabled.
   If this step is omitted, the newly created attribute will not appear in the select attribute options in other areas of OroCommerce (e.g. product families configuration).

.. finish