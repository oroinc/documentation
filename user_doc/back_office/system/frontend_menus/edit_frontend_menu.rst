.. _user-guide--system--menu--menu-frontend:

Edit a Frontend Menu
====================

A frontend menu may be multi-level like, and the child menu items are nested under parent menu items (e.g., **About**, **Customer Service**, **Privacy Policy**, and others are nested under **Information**).

.. image:: /user_doc/img/system/frontend_menu/frontend_menu_2.png

Menu items on the same level of hierarchy may be visually separated by a divider that looks like a horizontal line and helps you logically organize menu items. However, some menus do not support displaying dividers (on a particular level in the tree, or in general).

.. image:: /user_doc/img/system/menus/user_menu.png

To update the frontend menu contents, navigate to **System > Frontend Menus** in the main menu and click the menu name or the |IcView| View icon in the corresponding row of the frontend menu list.

.. image:: /user_doc/img/system/frontend_menu/frontend_menu_1.png

On the page that opens, the menu item tree is shown in the left panel. Center is reserved for the menu item configuration.

Toggle the Frontend Menu Tree View
----------------------------------

1. To minimize or maximize the left menu panel, click a double arrow on the top right of the panel.

2. To expand / collapse all menu items, click the ellipses drop-down menu on the top right of the left panel and click **Expand All** or **Collapse All**.

3. To expand / collapse a parent menu item, click an arrow in front of it.

.. image:: /user_doc/img/system/frontend_menu/frontend_menu_edit.png

.. _doc-config-menus-actions-draganddrop-frontend:

4. To change the position of an item / divider in a menu, drag and drop it in the left panel. You can change the order of menu items at the same level as well as move an item / divider to the higher or lower level. When you drag-and-drop items, pay attention to the arrow that shows where the item will be placed:

- If an arrow points to the place between items, that is where the moved item will be placed.

  .. image:: /user_doc/img/system/frontend_menu/d&dsame.png

- If and arrow appears in front of a menu item, then the moved item will become a child of the item that the arrow points to.

  .. image:: /user_doc/img/system/frontend_menu/d&dunder.png

Add a Menu Item
---------------

1. In the left panel, click a menu item which will be parent for the menu item that you create.

2. Click **Create Menu Item** on the top right and then **Create Menu Item** from the dropdown list.

   The created menu item will appear as the last one on the list of children of the same parent item. You can move it to the position that you need, as described in the :ref:`Toggle the Menu Tree View <doc-config-menus-actions-draganddrop>` action description.

3. In the right part of the page, specify the following information:

* **Title** --- A name for the menu item. This is how this menu item will be represented in the menu. Click the |IcTranslations| **Translations** icon to provide spelling for different languages. Click the |IcTranslationsC| **Default Language** icon to return to the single-language view.

* **URI** --- A web address of the page or resource that this menu item opens. You can specify an absolute URI or one relative to the application URI (as specified in Application Settings in System Configuration).

  If this menu item serves as a non-clickable parent that does not link itself to any resource (like **Customers** in the default main menu), type *\#*.

* **Icon** --- From the list, select the icon that will denote the menu item. Sometimes menus (or menu levels) may not be supposed to display icons. For example, icons added to the first level of the main menu are displayed only when this menu is set to appear on the left.

* **Description** --- Type a short but meaningful description of the menu item. Click the |IcTranslations| **Translations** icon to provide spelling for different languages. Click the |IcTranslationsC| **Default Language** icon to return to the single-language view.

* **User Agent** --- A unique agent to every customer. It reveals a catalog of technical data about the device and software that the customer is using. You can control whether to show or hide some menu items from the customer by proceeding with the following steps:

  1) Click **+Add** next to the **User Agent** field.

  2) Fill in the text field with a user agent substring or a string, if required.

     .. note:: A user agent string is a combination of user agent application versions, operating systems, crawlers, and other scripts which are specific for each user (e.g., Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36).

        A user agent substring is a part of the aforementioned string (e.g., Mozilla, Windows, Safari, etc).

        .. image:: /user_doc/img/system/frontend_menu/user_agent.png

  3) Select the corresponding operation from the list.

     * The *contains* operation determines whether the specified substring is included in the user agent string (e.g., in case you mention Mozilla, all the versions of Mozilla in the user agent string will meet the requirements of this function).

     * The *does not contain* operation determines whether the specified substring is not included in the user agent string.

     * The *matches* operation checks whether the specified value fully matches the user agent string (e.g. you need to provide a version of Mozilla to meet the requirements of this function).

     * The *does not match* operation checks when the specified value does not match the user agent string.

   .. image:: /user_doc/img/system/frontend_menu/frontend_menu_5.png
      :width: 70%

  4) To create more advanced condition, you can combine constrains into the expression using logical AND and OR operators:

     * Click **+ And** below the operation field within the same block to add another constrain block into the expression via AND.

       *AND* operation means that only those user agents that comply with all the specified conditions in a group will be selected.

     .. image:: /user_doc/img/system/frontend_menu/frontend_menu_6.png

     * Click **+ Add** at the bottom of the expression block to add another constrain block into the expression via OR.

       *OR* operation activates the expression once any of the constraint blocks in a group evaluates to true.

     .. image:: /user_doc/img/system/frontend_menu/frontend_menu_7.png

* **Exclude On Screens** --- Enables you to hide the menu items on the specified screens sizes by clicking any screen size and selecting the one for which the menu will be hidden from the customer. Hold **Ctrl** and click the value to select/deselect multiple screens.

    As an illustration, let us hide the **About** menu item from the desktops with 13 in. screen by enabling **Exclude On Screens** and selecting the corresponding screen size.

    .. image:: /user_doc/img/system/frontend_menu/frontend_menu_9.png

* **Condition** --- Enables you to restrict visibility of a menu item using the following functions:

  * The *is_logged_in()* function stands for the *registered users*. If entered, only the users who have logged into the Oro storefront are enabled to view the corresponding menu item.

  * The *!is_logged_in()* function stands for the *non-registered users*. If entered, only the unregistered users are enabled to view the corresponding menu item.

  * The *config_value('some_identifier')* function limits visibility of the corresponding menu item upon specifying the certain value instead of *'some_identifier'*.

  As an example, let us make the **About** section in the storefront visible to customers with configured taxes. For this, we need to:

  a) Customize the *config_value('some_identifier')* function with the required value instead of *some_identifier*. In our case, it is the *oro_tax.tax_enable* value.

  b) Click **Save** on the top right of the About menu page to save the changes.

  b) Enable **Tax Calculation** in the system configuration. More information on tax configuration can be found in the relevant :ref:`Configure Tax Calculation <user-guide--taxes--tax-configuration>` topic.

  c) Click **Save** on the top right of the Tax Calculation configuration page.

  The steps are illustrated below:

     .. image:: /user_doc/img/system/frontend_menu/frontend_menu_11.png

     .. image:: /user_doc/img/system/frontend_menu/frontend_menu_12.png


4. Click **Save** to save your changes. If you wish to start creating another menu item right away, click **Save and New** on the top right.

.. important::
    You need to reload the page to see the changes.

Add a Divider
-------------

1. In the left panel, click a menu item which will be parent for the menu divider that you create.

2. Click **Create** drop-down on the top right and select **Create Divider**.

.. image:: /user_doc/img/system/frontend_menu/menus_createdivider.png

The created divider will appear as the last one on the list of children of the same parent item. You can move it to the position that you need, as described in the :ref:`Toggle the Menu Tree View <doc-config-menus-actions-draganddrop-frontend>` action description. Reload the page to see changes.

.. note:: Some menus (or some menu levels) cannot display dividers. For example, if you add a divider to the first level of the main menu (**application_menu**), this divider will not be displayed.

Toggle Item Visibility
----------------------

1. **Hide a Menu Item** --- To hide the default menu items from the interface, click the necessary menu item in the left panel. Click **Hide** on the top right. Reload the page to see changes.

   .. important::
      - If a menu that you hide has child items, they will be hidden too.

      - You cannot hide non-default menu items.

2. **Show a Menu Item** --- To show a previously hidden menu item, click the necessary menu item in the left panel. Click **Show** on the top right. Reload the page to see changes.

   .. note::
      If a menu item that you want to show has a parent, it will become visible too.

3. **Find a Menu Item** ---  To quickly find a menu item, enter its name into the search field and click the |IcSearch| **Search** icon, or press **Enter**.

   .. image:: /user_doc/img/system/menus/menus_application_search.png

4. **Delete a Menu Item / Divider** --- To delete a menu item or a divider, click the necessary item in the left panel. Click **Delete** on the top right. In the **Delete Confirmation** dialog box, click **Yes, Delete**. Reload the page to see changes.

   .. important::
      - You cannot delete default menu items.

      - When you delete a menu item that has child items, they will not be deleted but moved to the parent of the menu item that you delete.

5. **Reset a Menu** --- To reset any customization changes and roll back to the menu that is provided out-of-the-box in the Oro application, click a menu name in the left panel. Click **Reset** on the top right. In the **Reset Confirmation** dialog box, click **Yes, Reset**. Reload the page to see changes.

.. finish

.. include:: /user_doc/img/buttons/include_images.rst
   :start-after: begin










