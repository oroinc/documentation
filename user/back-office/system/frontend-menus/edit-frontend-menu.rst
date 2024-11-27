.. _user-guide--system--menu--menu-frontend:

Change a Storefront Menu
========================

To update the storefront menu contents, navigate to **System > Storefront Menus** in the main menu and click the menu name or the |IcView| View icon in the corresponding row of the storefront menu list.

.. image:: /user/img/concept-guides/menus/frontend_menu_list.png
   :alt: A list of all available storefront menu items

On the page that opens, the menu item tree is displayed in the left panel. The center is reserved for the menu item configuration.

Toggle the Storefront Menu Tree View
------------------------------------

A storefront menu can be multi-level, and the child menu items are nested under parent menu items (e.g., **About**, **Customer Service**, **Privacy Policy**, and others are nested under **Information**).

.. image:: /user/img/system/frontend_menu/frontend_menu_2.png
   :alt: Configuration settings of the About menu under the commerce_footer_links storefront menu

1. To minimize or maximize the left menu panel, click the arrow on the top right of the panel.

2. To expand / collapse a parent menu item, click an arrow in front of it.

.. image:: /user/img/system/frontend_menu/frontend_menu_edit.png
   :alt: Numbers that define the actions you can do to storefront menu items described above

.. _doc-config-menus-actions-draganddrop-frontend:

4. To change the position of an item / divider in a menu, drag and drop it in the left panel. You can change the order of menu items at the same level as well as move an item / divider to the higher or lower level. When you drag-and-drop items, pay attention to the arrow that shows where the item will be placed:

   - If an arrow points to the place between items, that is where the moved item will be placed.

     .. image:: /user/img/system/frontend_menu/d&dsame.png
        :alt: Dragging the Catalog menu under Shopping Rules

   - If an arrow appears in front of a menu item, then the moved item will become a child of the item to which the arrow points.

5. To update the target type of the root menu item of any storefront menu, click on the menu item, and select one of the three options from the dropdown:

   - **Category** --- Select a master catalog category from the list.
   - **Content Node** --- Select the :ref:`web catalog <user-guide--web-catalog>` from which you want to choose the content node and the :ref:`content node <user-guide--marketing--web-catalog--content-variant>` itself.
   - **None** --- No target type is required.

   Further fields to fill in will depend on the option you chose. For more information, see the section below.

   .. image:: /user/img/system/frontend_menu/root-menu-item-target-type.png
      :alt: Target type option for the root menu item

.. _user-guide--system--menu--menu-frontend--add-item:

Add a Menu Item
---------------

1. In the left panel, click a menu item that will be a parent for the menu item you create.

2. Click **Create Menu Item** on the top right and then **Create Menu Item** from the dropdown list.

   The created menu item is displayed as the last one on the list of children of the same parent item. You can move it to the position that you need, as described in the :ref:`Toggle the Menu Tree View <doc-config-menus-actions-draganddrop>` action description.

3. In the right part of the page, specify the following information:

* **Title** --- A name for the menu item. This is how this menu item is going to be represented in the menu. Click the |IcTranslations| **Translations** icon to provide spelling for different languages. Click the |IcTranslationsC| **Default Language** icon to return to the single-language view.

* **Target Type** --- Select the target of the new storefront menu item. The fields below vary depending on the target type you choose. Please be aware that the root menu item only has 3 target types (none, content node, category), while options for the target type for its child items are listed below:

  .. csv-table::

     "**None**","Select this option is no target type is required."
     "**URI**","URI is a web address of the page or resource that this menu item opens. You can specify an absolute URI or one relative to the application URI (as specified in Application Settings in the System Configuration)."
     "**System Page**","Select one of the standard pre-designed pages of the OroCommerce storefront."
     "**Category**","Select a master catalog category from the list."
     "**Content Node**","Select the :ref:`web catalog <user-guide--web-catalog>` from which you want to choose the content node and the :ref:`content node <user-guide--marketing--web-catalog--content-variant>` itself. For more information on how to use the content node type to update the main menu on the website, see :ref:`Changing Storefront's Product Menu <concept-guide-web-catalog-change-storefront-menu>`."

  .. image:: /user/img/system/frontend_menu/target_type.png
     :scale: 65%
     :align: center
     :alt: Select the target type for a storefront menu item

  .. hint:: If this menu item serves as a non-clickable parent that does not link itself to any resource (like **Customers** in the default main menu), type *\#*.

* **Max Traverse Level** --- The depth of the content node or category tree (if either Category or Content Node is selected as Target Type). The default maximum level is 5.

* **Description** --- Type a short but meaningful description of the menu item. Click the |IcTranslations| **Translations** icon to provide spelling for different languages. Click the |IcTranslationsC| **Default Language** icon to return to the single-language view.

* **Icon** --- From the list, select the icon that denotes the menu item. Sometimes menus (or menu levels) may not be supposed to display icons. For example, icons added to the first level of the main menu are displayed only when this menu is set to appear on the left.

* **Image** --- an image used to illustrate a new storefront menu. Click **Choose File** to select the image from your directory and upload it.

* **Menu Template** --- Choose a menu template for the menu item. By default, you have the following options:

  .. csv-table::

     "**Flat menu, up to 2 levels deep**"," .. image:: /user/img/system/frontend_menu/menu-template-2.png "
     "**Tree, up to 3 levels deep**"," .. image:: /user/img/system/frontend_menu/menu-template-3.png "
     "**Mega Menu, up to 4 levels deep**"," .. image:: /user/img/system/frontend_menu/menu-template-4.png "

* **User Agent** --- A unique agent to every customer. It reveals a catalog of technical data about the device and software that the customer is using. You can control whether to show or hide some menu items from the customer by proceeding with the following steps:

  1) Click **+Add** next to the **User Agent** field.

  2) Fill in the text field with a user agent substring or a string, if required.

     .. note:: A user agent string is a combination of user agent application versions, operating systems, crawlers, and other scripts that are specific for each user (e.g., Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36).

        A user agent substring is part of the string mentioned above (e.g., Mozilla, Windows, Safari, etc.).

        .. image:: /user/img/system/frontend_menu/user_agent.png
           :alt: The settings under User Agent

  3) Select the corresponding operation from the list.

     * The *contains* operation determines whether the specified substring is included in the user agent string (e.g., if you mention Mozilla, all the versions of Mozilla in the user agent string will meet the requirements of this function).

     * The *does not contain* operation determines whether the specified substring is not included in the user agent string.

     * The *matches* operation checks whether the specified value fully matches the user agent string (e.g., you need to provide a version of Mozilla to meet the requirements of this function).

     * The *does not match* operation checks when the specified value does not match the user agent string.

   .. image:: /user/img/system/frontend_menu/frontend_menu_5.png
      :alt: A list of available operations under User Agent

  4) To create a more advanced condition, you can combine constraints into the expression using logical AND and OR operators:

     * Click **+ And** below the operation field within the same block to add another constraint block into the expression via AND.

       *AND* operation means that only those user agents that comply with all the specified conditions in a group will be selected.

     .. image:: /user/img/system/frontend_menu/frontend_menu_6.png
        :alt: The steps you need to take to add another condition with AND operator to User Agent

     * Click **+ Add** at the bottom of the expression block to add another constraint block into the expression via OR.

       *OR* operation activates the expression once any of the constraint blocks in a group evaluates to true.

     .. image:: /user/img/system/frontend_menu/frontend_menu_7.png
        :alt: The steps you need to take to add another condition with OR operator to User Agent

* **Exclude On Screens** --- Enables you to hide the menu items on the specified screen sizes by clicking any screen size and selecting the one for which the menu will be hidden from the customer. Hold **Ctrl** and click the value to select/deselect multiple screens.

    As an illustration, let us hide the **About** menu item from the desktops with a 13-inch screen by enabling **Exclude On Screens** and selecting the corresponding screen size.

    .. image:: /user/img/system/frontend_menu/frontend_menu_9.png
       :alt: Footer menu in the storefront illustrating the Exclude On Screens option both enabled and disabled

* **Condition** --- Enables you to restrict the visibility of a menu item using the following functions:

  * The *is_logged_in()* function stands for the *registered users*. If entered, only the users who have logged into the Oro storefront are enabled to view the corresponding menu item.

  * The *!is_logged_in()* function stands for the *non-registered users*. If entered, only the unregistered users are enabled to view the corresponding menu item.

  * The *config_value('some_identifier')* function limits visibility of the corresponding menu item upon specifying certain value instead of *'some_identifier'*.

.. note:: The conditions use |Symfony Expression Language|, so you can use ``&&, II, and, or`` and many other operators to combine several conditions.

  As an example, let us make the **About** section in the storefront visible to customers with configured taxes. For this, we need to:

  a) Customize the *config_value('some_identifier')* function with the required value instead of *some_identifier*. In our case, it is the *oro_tax.tax_enable* value.

  b) Click **Save** on the top right of the About menu page to save the changes.

  c) Enable **Tax Calculation** in the system configuration. More information on tax configuration can be found in the relevant :ref:`Configure Tax Calculation <user-guide--taxes--tax-configuration>` topic.

  d) Click **Save** on the top right of the Tax Calculation configuration page.

  The steps are illustrated below:

  .. image:: /user/img/system/frontend_menu/frontend_menu_11.png
     :alt: The steps you need to take to enable the About section to customers with configured taxes in the storefront

* **Target Window** --- determines the way to open the linked document or URI. Select *Same Window* option to open it in the current browser window. Select *New Window* to open it in a new browser tab.

4. Click **Save** to save your changes. If you wish to start creating another menu item right away, click **Save and New** on the top right.

.. important::
    You need to reload the page to see the changes in the storefront.

Edit a Menu Item
----------------

To edit an existing menu item, make sure you click on the required child menu item and update the field displayed for it on the right.

.. image:: /user/img/system/frontend_menu/edit-item1.png

If you are editing a menu item with target type Content Node that you created previously, then you will be able to update all the existing fields for this menu item. If this menu item was created in the system previously and not by you, fields *Target Type, Web Catalog, Content Node* will be disabled, as illustrated below:

.. image:: /user/img/system/frontend_menu/content-node-disabled-fields.png
   :alt: Menu item of target type content node with some disabled fields for editing

Add a Divider
-------------

Menu items on the same level of hierarchy can be visually separated by a divider that looks like a horizontal line and helps you logically organize menu items.

To add a divider:

1. In the left panel, click a menu item which will be the parent for the menu divider that you create.

2. Click **Create** drop-down on the top right, and select **Create Divider**.

.. image:: /user/img/system/frontend_menu/menus_createdivider.png
   :alt: Highlight the Create Divider button under Create Menu Item

The created divider will appear as the last one on the list of children of the same parent item. You can move it to the position that you need, as described in the :ref:`Toggle the Menu Tree View <doc-config-menus-actions-draganddrop-frontend>` action description. Reload the page to see changes.

.. note:: Some menus (or some menu levels) cannot display dividers. For example, if you add a divider to the first level of the main menu (**application_menu**), this divider will not be displayed.

          .. image:: /user/img/system/menus/user_menu.png
             :alt: User menu without divider

Toggle Item Visibility
----------------------

1. **Hide a Menu Item** --- To hide the default menu items from the interface, click the necessary menu item in the left panel. Click **Hide** on the top right. Reload the page to see changes.

   .. important::
      - If a menu that you hide has child items, they will be hidden too.

      - You cannot hide non-default menu items.

2. **Show a Menu Item** --- To show a previously hidden menu item, click the necessary menu item in the left panel. Click **Show** on the top right. Reload the page to see changes.

   .. note::
      If a menu item that you want to show has a parent, it will become visible too.

3. **Find a Menu Item** ---  To quickly find a menu item, enter its name into the search field and click the |Search-SVG| **Search** icon or press **Enter**.

   .. image:: /user/img/system/menus/menus_application_search.png
      :alt: Using the search tab to locate all references about sales

4. **Delete a Menu Item / Divider** --- To delete a menu item or a divider, click the necessary item in the left panel. Click **Delete** on the top right. In the **Delete Confirmation** dialog box, click **Yes, Delete**. Reload the page to see changes.

   .. important::
      - You cannot delete default menu items.

      - When you delete a menu item that has child items, they will not be deleted but moved to the parent of the menu item that you delete.

5. **Reset a Menu** --- To reset any customization changes and roll back to the menu that is provided out-of-the-box in the Oro application, click a menu name in the left panel. Click **Reset** on the top right. In the **Reset Confirmation** dialog box, click **Yes, Reset**. Reload the page to see changes.

.. include:: /include/include-links-user.rst
   :start-after: begin

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin










