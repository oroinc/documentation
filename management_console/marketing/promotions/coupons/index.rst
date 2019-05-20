.. _user-guide--marketing--promotions--coupons:

Coupons
=======

As a promotional tool, coupons can be generated and distributed to customers to be redeemed for a discount when purchasing goods online. In your Oro application, coupons are always linked to promotions, although they can be created separately and linked to a promotion when the need arises.

The following topics will explore how to create, generate, and manage coupons in your Oro application:

.. contents:: :local:

.. note:: You can check out `how to create coupons and link them to promotions <https://oroinc.com/b2b-ecommerce/media-library/how-to-create-coupons-and-link-them-to-promotions>`__ in our media library.

.. _user-guide--marketing--promotions--coupons--begin:

Before You Begin
----------------

As coupons are linked to promotions, make sure that :ref:`promotions <user-guide--marketing--promotions>` are enabled in your system. For more information on configuration of promotions, see the relevant :ref:`Configure Promotions <sys-config--commerce--sales--promotions>` topic, or refer to your administrator.

Enabling promotions allows you to perform the following actions with coupons:

1. See **Coupons** under **Marketing > Promotions > Coupons** in the main menu of the management console.
2. View and add coupons to :ref:`orders <user-guide--sales--orders>` in the management console.
3. Apply coupons in :ref:`shopping lists <frontstore-guide--shopping-lists>` and :ref:`checkout <frontstore-guide--orders>` in the storefront.

Coupons can be created manually or generated. Usually, you *create* coupons manually when you need a small number of them (e.g., 2), or *generate* coupons when you need many (e.g., 1000).


.. _user-guide--marketing--promotions--coupons--create:

Create Coupons
--------------

To create a new coupon:

1. Navigate to **Marketing > Promotions > Coupons** in the main menu.
2. Click **Coupons Actions > Create Coupon** on the top right.

   .. image:: /img/marketing/coupons/FindCoupon.png
      :alt: The steps you need to perform to get to the coupon creation page

3. In the  **General** section, complete the following fields:

   * **Owner** --- Select the business unit responsible for the coupon.
   * **Coupon Code** --- Enter the coupon code. Code value should be numeric, alphabetic or both, and have no spaces. This field is mandatory.
   * **Promotion** --- Select the promotion that the coupon should relate to, or click |IcBars| to load the list of promotions to choose from. Please note that only promotions with the **Triggered by** option set to *Coupons and Conditions* will be displayed on the list of available promotions. If there are no promotions to link the coupon to, they can be created and added to the coupon later.
   * **Enabled** --- Enable the check box to activate the coupon. To deactivate it, clear the check box.
   * **Uses Per Coupon** --- Enter the number of times that the coupon may be used.
   * **Uses Per Person** --- Enter the number of times a specific customer can use the coupon.
   * **Valid From/Until** --- Provide the expiration date and time for the coupon.

4. Click **Save**.

.. _user-guide--marketing--promotions--coupons--generate:

Generate Coupons
----------------

To generate new coupons:

1. Navigate to  **Marketing > Promotions > Coupons** in the main menu.
2. Click **Coupons Actions > Generate Multiple Coupons** on the top right.

   The following form appears:

   .. image:: /img/marketing/coupons/GenerateCoupons.png
      :alt: The steps you need to perform to get to the multiple coupons generation page

3. In the form, complete the following fields:

   * **Promotion** --- Select the promotion that the coupon should relate to, or click |IcBars| to load the list of promotions to choose from. Please note that only promotions with the *Triggered by* :ref:`option <user-guide--marketing--promotions--create>` set to *Coupons and Conditions* will be displayed on the list of available promotions.
   * **Enabled** --- Enable the check box to activate the coupons.
   * **Uses Per Coupon** --- Enter the number of times that the coupon may be used.
   * **Uses Per Person** --- Enter the number of times a specific customer can use the coupon.
   * **Valid From/Until** --- Provide the expiration date and time for the coupon.
   * **Owner** --- Select the business unit responsible for the coupon.
   * **Coupon Quantity** --- Specify the quantity of coupons to be automatically generated.
   * **Code Length** --- Enter the number that represents the desired length of the coupon code.
   * **Code Type** --- Select the coupon code type from the list (numeric, alphanumeric or alphabetic).
   * **Code Prefix** --- Enter the prefix for the coupon code. If provided, each code will start from this prefix.
   * **Code Suffix** --- Enter the suffix for the coupon code. If provided, each code will finish with this suffix.
   * **Add Dashes Every...Symbols** --- Provide the number to indicate where a dash should be placed in the coupon code (e.g., after every 2 symbols: xx-xx-xx).
   * **Code Preview** --- Preview the sample of the code to be generated for the coupon.

   .. note:: Please note that coupon codes must not be longer than 255 symbols, including prefix, suffix, and dashes.

4. Click **Generate**.

   The coupons list should now have the coupon codes you have just generated.


.. _user-guide--marketing--promotions--coupons--view:

Manage a Coupons List
---------------------

Navigate to **Marketing > Promotions > Coupons** in the main menu.

The page contains the list of all available coupons in your Oro application. From here, you can perform the following actions:

.. image:: /img/marketing/coupons/ActionsCoupons.png
   :alt: The page of all coupons available in the system

1. Create a new coupon: Click **Coupons Actions > Create Promotion** on the top right.
2. Generate coupons: Click **Coupons Actions > Generate Multiple Coupons** on the top right.
3. Export coupons: Click  **Export** on the top right.
4. Import coupons: Click  **Import** on the top right.
5. View coupon details: Click on the item from the list to open its details page.
6. Hover over the |IcMore| **More Options** menu to the right of the necessary coupon and select either to |IcView| **View**, |IcEdit| **Edit**, or |IcDelete| **Delete** the existing coupons from the system.
7. Mass edit or mass delete coupons: Select the check boxes on the left of the corresponding rows. Click |IcMore| on the far right of the table header. Click |IcEdit| **Edit** to edit, or |IcDelete| **Delete** to delete the selected coupons.

   .. image:: /img/marketing/coupons/MassActionsCoupons.png
      :alt: The illustration of a mass action

7. Filter a coupons grid to find the required records quicker: Click |IcFilter| above the table on the far right to display the filters. To apply a filter, click on its button in the bar, and specify your query in the control that appears.

   .. note:: Filter controls might look different depending on the type of data you are going to filter, e.g., textual, numeric, a date or an option set.

8. Organize a coupons list to define which columns to show in the grid: Click |IcSettings| above the table on the far right.

   * To choose the columns to be displayed in the table, select the check box next to the required column under **Show**. Clear the check box to make the column disappear from the table.
   * To change the order of the columns, click |IcReorder| next to the name of the column you wish to move, hold the mouse button and drag the column to the required position.
   * To refresh the coupon list, click |IcRedo|.
   * To reset the coupon list, click |IcRefresh| to clear list customization and return to default settings. Reset applies to all filters, records per page and sorting changes that you have made.

.. _user-guide--marketing--promotions--coupons--edit:
.. _user-guide--marketing--promotions--coupons--edit--view:
.. _user-guide--marketing--promotions--coupons--edit--on-order-page:
.. _user-guide--marketing--promotions--coupons--edit--manage-when-editing-an-order:

Manage Coupons in Orders
------------------------

.. include:: /management_console/marketing/promotions/coupons/manage_coupons_in_orders.rst
   :start-after: begin_edit_in_order_body
   :end-before: finish_edit_in_order_body

Create a Sample Coupon
----------------------

.. include:: /management_console/marketing/promotions/coupons/sample_coupon.rst
   :start-after: begin
   :end-before: finish

Export Coupons
--------------

.. include:: /management_console/marketing/promotions/coupons/export_coupons.rst
   :start-after: begin
   :end-before: finish

Import Coupons
--------------

.. include:: /management_console/marketing/promotions/coupons/import_coupons.rst
   :start-after: start
   :end-before: finish

.. include:: /img/buttons/include_images.rst
   :start-after: begin

.. toctree::
   :hidden:

   manage_coupons_in_orders
   sample_coupon
   export_coupons
   import_coupons