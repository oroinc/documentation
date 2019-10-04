:oro_documentation_types: commerce

.. _doc--products--actions--create:

Create Simple and Configurable Products
=======================================

Product Type: Simple vs Configurable
------------------------------------

.. include:: /user/back-office/products/products/create/simple-vs-config.rst
   :start-after: configurable_product_begin
   :end-before: configurable_product_end

.. _products--products--create-simple-product:

Create a Simple Product
-----------------------

.. include:: /user/back-office/products/products/create/create-simple.rst
   :start-after: start_product_create_simple
   :end-before: stop_product_create_simple

.. _products--products--create-config-product:

Create a Configurable Product
-----------------------------

.. include:: /user/back-office/products/products/create/create-complex.rst
   :start-after: start_product_create_configurable
   :end-before: stop_product_create_configurable

Create a Sample Configurable Product
------------------------------------

The sample flow below shows all the steps required for the creation of a configurable product.

*Product: Red and green hats, sizes S and M.*

**Step 1. Create Attributes.**

1. Navigate to **Products > Product Attributes** in the main menu.
2. Click **Create Attribute** on the top right.

   We will create two attributes, one after another: 'hatcolor' and 'hatsize'.
3. Select the type of an attribute.

   Currently, *Select* and *Boolean* types are available for configurable attributes. We will use *Select* for both attributes.

4. Fill in the required information and add the necessary options for the attributes by clicking **+Add**.

   For 'hatcolor', attribute options will be 'Red' and 'Green'.

   .. image:: /user/img/products/products/SampleHatColor.png
      :alt: Create the HatColor product attribute with the red and green options

   For 'hatsize', attribute options will be 'S' and 'M'.

   .. image:: /user/img/products/products/SampleHatSize.png
      :alt: Create the HatSize product attribute with the s and m options

5. Click **Save** to save the attributes.

.. image:: /user/img/products/products/SampleHatColorSizeGrid.png
   :alt: Newly created attributes are displayed in the list of all product attributes

**Step 2. Create a Product Family.**

1. Navigate to **Products > Product Families** in the main menu.
2. Click **Create Product Family** in the top right corner.
3. Fill in the required information and add attributes 'HatColor' and 'HatSize' to the attribute group by clicking **+Add**.

   Each attribute must have a separate group in our case.

   .. image:: /user/img/products/products/SampleProductFamily.png
      :alt: Add new product attributes to separate groups when creating a product family

4. Click **Save** to save the product family.


**Step 3. Create Configurable Product Variants.**

We now need to create one configurable product variant (simple product) per each variant that we would like to have available in the configurable product. Since we have two attributes, 'HatSize' and 'HatColor', and each attribute has two options ('S'/'M' for the first and 'Red'/'Green' for the second), we need to create four simple products.

1. Navigate to **Products > Products** in the main menu.
2. Click **Create Product** in the top right corner.
3. Set the product type to *Simple*, select the 'HATS' product family.
4. Fill in the required information and add the attributes required for this particular product.

   .. image:: /user/img/products/products/SampleSimpleProduct1.png
      :alt: Illustrate a simple product creation based on the provided parameters

5. Click **Save**.

Perform step 3 for all four simple products.

.. note:: Make sure that all your simple products are *enabled*.

.. image:: /user/img/products/products/SampleSimpleProductsGrid.png
   :alt: Display all created simple products in the products' grid

**Step 4. Create a Configurable Product.**

1. Navigate to **Products > Products** in the main menu.
2. Click **Create Product**.
3. Set the product type to *Configurable*.
4. Select the category.

   .. note:: Choosing category is mandatory at this stage, as it determines whether the product is available on the website.

5. Choose the 'Hats' product family.

   .. image:: /user/img/products/products/SampleCreateConfigProduct.png
      :alt: Illustrate a configurable product creation based on the provided parameters

6. Add 'HatSize' and 'HatColor' attributes to the product.
7. Fill in the required information and add the created product variants for this configurable product.

   .. note:: You might want to save the product at this point to make sure that product variants are available in the **Product Variants** section of the product you are creating.

   .. image:: /user/img/products/products/SampleProductVariantsForConfigProduct.png
      :alt: Display the product variants available for the configurable product in the Product Variants section

8. Click **Save**.

   .. image:: /user/img/products/products/SampleConfigSimpleGrid1.png
      :alt: Display all created simple and configurable products in the products' grid

The product should now be available on the website in the category we have previously assigned it to.


.. include:: /include/include-images.rst
   :start-after: begin
