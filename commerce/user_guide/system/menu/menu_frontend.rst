:orphan:

.. _user-guide--system--menu--menu-frontend:

.. insert into: Customize Default Frontend Menus (www.orocommerce.com/documentation/current/user-guide/system/menu)

Edit a Frontend Menu
^^^^^^^^^^^^^^^^^^^^

.. start

To update the frontend menu contents, follow the :ref:`Customize Default Frontend Menus <doc--system--menu--config-levels--frontend-menus>` guide and click on the menu name or on the |IcView| View icon in the corresponding row of the frontend menu list.

.. image:: /user_guide/img/system/menus/frontend_menu_1.png
   :class: with-border

On the page that opens, the menu item tree is shown in the left panel. Center is reserved for the menu item configuration, which you can update as shown in the aforementioned :ref:`Add a Menu Item <doc--system--menu--config--add-menu-item>` section.

.. image:: /user_guide/img/system/menus/frontend_menu_2.png
   :class: with-border

Moreover, you can customize additional visibility restrictions in the following fields in order to selectively display or hide some menu items from the customer.

**User Agent**

**User Agent** is unique to every customer. It is a catalogue of technical data about the device and software that the customer is using. You can enable or disable the customer from viewing some menu items by proceeding with the following steps:

.. image:: /user_guide/img/system/menus/frontend_menu_3.png
   :class: with-border

1) Click **Add**.
2) Fill in the open field with a user agent substring or a string, if required.

.. note::
   A user agent string is a combination of user agent application versions, operating systems, crawlers, and other scripts which are specific for each user (e.g. Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36).

   A user agent substring is a part of the aforementioned string (e.g. Mozilla, Windows, Safari, etc).

.. image:: /user_guide/img/system/menus/frontend_menu_4.png
   :class: with-border

3) Select the corresponding operation from the list.

   The operation *contains* determines whether the specified substring is included in the user agent string (e.g. in case you mention Mozilla, all the versions of Mozilla in the user agent string will meet the requirements of this function).

   The operation *does not contain* determines whether the specified substring is not included in the user agent string.

   The operation *matches* checks whether the specified value fully matches the user agent string (e.g. you need to provide a version of Mozilla to meet the requirements of this function).

   The operation *does not match* checks whether the specified value does not match the user agent string.

   .. image:: /user_guide/img/system/menus/frontend_menu_5.png
      :class: with-border

4) Click **+And** below the operation field withing the same block to add another condition. This **And** stands for **AND**, meaning that the operation will be implemented only if all the specified conditions equally comply.

5) Click separate **+Add** which stands for **OR** and activates the operation once either first or second condition complies.

   .. image:: /user_guide/img/system/menus/frontend_menu_6.png
      :class: with-border

**Exclude On Screens**

**Exclude On Screens** enables to hide the menu items on the specified screens.

1) Click on any screen to select the one which will be hidden from the customer.
2) Press Ctrl to select/deselect multiple screens in no particular order.
3) Click **Save**.

.. image:: /user_guide/img/system/menus/frontend_menu_7.png
   :class: with-border

The menu item which you have selected to be hidden is excluded from the frontstore.

.. image:: /user_guide/img/system/menus/frontend_menu_8.png
   :class: with-border

**Condition**

**Condition** enables to restrict visibility of some menu items using the following functions:

* the function *is_logged_in()* stands for the *registered users*. If entered, only the users who have logged into the Oro frontstore are enabled to view the corresponding menu item.

  .. image:: /user_guide/img/system/menus/frontend_menu_9.png
     :class: with-border

|

  .. image:: /user_guide/img/system/menus/frontend_menu_10.png
     :class: with-border

* the function *!is_logged_in()* stands for the *non-registered users*. If entered, only the unregistered users are enabled to view the corresponding menu item.
* the function *config_value('some_identifier')* limits visibility of the corresponding menu item upon specifying the certain value. To enable this function, proceed with the following steps:

  a) Enter the function in the **Condition** field.
  b) Specify the exact value instead of *some_identifier*, on the basis of which the function will be customized (e.g. *oro_tax.tax_enable*, meaning that the menu item will become visible upon enabling *Taxation* through the System configuration in the management console).
  c) Enable the *Taxation* following the :ref:`Configure Tax Calculation <user-guide--taxes--tax-configuration--calculation>`.
  d) Click **Save**.

     .. image:: /user_guide/img/system/menus/frontend_menu_11.png
        :class: with-border

|

     .. image:: /user_guide/img/system/menus/frontend_menu_12.png
        :class: with-border

.. finish

.. include:: /user_guide/include_images.rst
   :start-after: begin










