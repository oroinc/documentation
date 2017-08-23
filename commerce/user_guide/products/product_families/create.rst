.. _product--product-families--create:

.. begin_include

Create a New Product Family
^^^^^^^^^^^^^^^^^^^^^^^^^^^

See a short demo on `how to create a product family <https://www.orocommerce.com/media-library/create-product-attributes-families>`_ (from 6:43), or keep reading the step-by-step guidance below.

Default Product Family may not be enough to cover all your needs. To create a new product family:

1. Navigate to **Products > Product Families** using the main menu.
2. Click **Create Product Family**.

   .. image:: /user_guide/img/products/product_families/ProductAttributeFamiliesCreate.png
      :class: with-border

3. Provide the product family details:

   - **Code** -- Enter the code that would be assigned to the product family you are creating.
   - **Label** -- Enter the label that would be assigned to the product family.
   - **Enabled** -- Select this check box to be able to bind a product to the product family.
   - **Image** -- Add an image to the product family, if necessary.
   
4. In the **Attributes** section, link the attributes to the product family and organize them into groups as described in the sections below.

   .. important:: Ensure that every system attribute is linked to the proper attribute group in the product family. By default, they are linked to the default_group, but you may modify the link as necessary.

6. Once you are happy with the product attribute organization, click **Save**.

.. finish_include

.. _product--product-families--product-attribute-in-families:

.. begin_second_include

Use Product Attributes in Product Families
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Add a New Product Attribute Group
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

1. Navigate to **Products > Product Families** using the main menu.
2. Click **+ Add** to create a new group.

3. Enter the label and add the product attributes:

   - Start typing the product attribute name. Filtered list will appear as you type.
   - Select the attribute from the list or press ``Enter`` once there is only one option.
   
4. Once you are done with the product attribute organization, click **Save**.
   
   .. image:: /user_guide/img/products/product_families/ProductAttributeAddGroup.png
      :class: with-border

Add a Product Attribute to the Attribute Group
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

1. Navigate to **Products > Product Families** using the main menu.
2. Start typing the product attribute name. Filtered list will appear as you type. Select the attribute from the list or press ``Enter`` once there is only one option.
3. Once you are done with the product attribute organization, click **Save**.

   .. image:: /user_guide/img/products/product_families/ProductAttributeAddToGroup.png
      :class: with-border

Move a Product Attribute to Another Attribute Group
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

1. Navigate to **Products > Product Families** using the main menu.
2. When an attribute you are adding to the group is already a member of another attribute group in this product family, the *move from \<attribute group\>* will be shown next to the attribute name in the hint list that appears as you type.
   
   .. image:: /user_guide/img/products/product_families/ProductAttributeFamiliesMove.png
      :class: with-border
   
   Adding such attribute to another group will remove it from its current group.
3. Once you are done with the product attribute organization, click **Save**.

Delete a Product Attribute from the Attribute Group
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

1. Navigate to **Products > Product Families** using the main menu.
2. Click the **x** next to the attribute name to remove it from the attribute group. Though it is impossible to delete system attributes, you can move them to the default attribute group. This will remove an attribute from its current group.
3. Once you are done with the product attribute organization, click **Save**.

   .. image:: /user_guide/img/products/product_families/ProductAttributeRemoveFromGroup.png
      :class: with-border

Delete a Product Attribute Group
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To remove existing aproduct attribute group:

1. Navigate to **Products > Product Families** using the main menu.
2. Click **x** on the top right of the group area. 
   
   .. image:: /user_guide/img/products/product_families/ProductAttributeRemoveGroup.png
      :class: with-border


   If the group contains any system attributes, the confirmation dialog appears. 
   
   .. image:: /user_guide/img/products/product_families/ProducAttributeRemoveGroupWarning.png
      :class: with-border

   Once confirmed, the group is deleted and the system attributes are automatically moved to default group.

4. Once you are done with the product attribute organization, click **Save**.
  

.. finish_second_include