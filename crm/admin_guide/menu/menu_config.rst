Customizing a Menu
^^^^^^^^^^^^^^^^^^

.. begin_1

Generic Principles
~~~~~~~~~~~~~~~~~~

A menu may be multi-level like, for example, a default OroCRM and OroCommerce Management Console main menu. The child menu items are nested under parent menu items (e.g. **Accounts**, etc are nested under the **Customers**).

.. image:: /admin_guide/img/menus/edit/menus_general.png

Menu items on the same level of hierarchy may be visually separated by a divider that looks like a horizontal line.

.. image:: /admin_guide/img/menus/user_menu.png

Dividers help you logically organize menu items.

.. note:: Some menus do not support displaying dividers (on a particular level in the tree, or in general). For example, if you add a divider to the top level of OroCRM and OroCommerce Management Console main menu (**application_menu**), the divider is not displayed.

   .. image:: /admin_guide/img/menus/ApplicationMenu.png

Edit a Menu
~~~~~~~~~~~

To view and edit menu contents, click on the menu name or on the |IcView| **View** icon in the corresponding row of the menu list.

.. image:: /admin_guide/img/menus/menus.png

On the page that opens, the menu item tree is shown in the left panel. Center is reserved for the menu item configuration.

.. image:: /admin_guide/img/menus/edit/menus_general.png


Toggle the Menu Tree View
~~~~~~~~~~~~~~~~~~~~~~~~~

Hide / Show the Menu Tree
"""""""""""""""""""""""""

To minimize or maximize the left menu panel, click a double arrow on the top right of the panel.

.. image:: /admin_guide/img/menus/edit/menus_application_showpanel.png

Expand / Collapse a Menu Tree
"""""""""""""""""""""""""""""

To expand / collapse a parent menu item, click an arrow in front of it.

.. image:: /admin_guide/img/menus/edit/menus_application_expand.png

To expand / collapse all menu items, click the ellipses drop-down menu on the top right of the left panel and click **Expand All** or **Collapse All**.

.. image:: /admin_guide/img/menus/edit/menus_application_expall.png

Rearrange Menu Items / Dividers
"""""""""""""""""""""""""""""""

You can change the position of an item / divider in a menu by dragging and dropping it in the left panel. You can change the order of menu items at the same level as well as move an item / divider to the higher or lower level.

When you drag-and-drop items, pay attention to the arrow that shows where the item will be placed:

- If an arrow points to the place between items, that is where the moved item will be placed.

  .. image:: /admin_guide/img/menus/edit/menus_actions_d&dsame.png
     :width: 40%

- If and arrow appears in front of a menu item, then the moved item will become a child of the item that the arrow points to.

  .. image:: /admin_guide/img/menus/edit/menus_actions_d&dunder.png
     :width: 40%

.. finish_1

.. _doc--system--menu--config--add-menu-item:

.. begin_2

Add a Menu Item
~~~~~~~~~~~~~~~

1. In the left panel, click a menu item which will be parent for the menu item that you create.

2. Click **Create** drop-down on the top right and click **Create Menu Item** on the list.

   .. image:: /admin_guide/img/menus/edit/menus_createmenuitem.png
      :width: 50%

   The created menu item will appear as the last one on the list of children of the same parent item. You can move it to the position that you need, as described in the :ref:`Rearrange Menu Items / Dividers <doc-config-menus-actions-draganddrop>` action description.

3. In the right part of the page, specify the following information:

   - **Title**—A name for the menu item. This is how this menu item will be represented in the menu.

     Click the |IcTranslations| **Translations** icon to provide spelling for different languages. Click the |IcTranslationsC| **Default Language** icon to return to the single-language view.

     .. image:: /admin_guide/img/menus/edit/menus_actions_create_translations.png

   - **URI**—An web address of the page or resource that this menu item opens.

     You can specify an absolute URI or one relative to the application URI (as specified in Application Settings in System Configuration).

     If this menu item serves as a non-clickable parent that does not link itself to any resource (like **Customers** in the default main menu), type *\#*.

   - **Icon**—From the list, select the icon that will denote the menu item.

     .. note:: Sometimes menus (or menu levels) may not be supposed to display icons. For example, icons added to the first level of the main menu (**application_menu**) are displayed only when this menu is set to appear on the left.

   - **Description**—Type a short but meaningful description of the menu item.

     Click the |IcTranslations| **Translations** icon to provide spelling for different languages. Click the |IcTranslationsC| **Default Language** icon to return to the single-language view.

   .. image:: /admin_guide/img/menus/edit/menus_actions_create_general.png

4. Click **Save** to save your changes. If you wish to start creating another menu item right away, click **Save and New** on the top right.

.. important::
    You need to reload the page to see changes.

.. Edit a Frontend Menu~~~~~~~~~~~~~~~~~~~~
   include:: menu_frontend.rst
   :start-after: start
   :end-before: finish

Add a Divider
~~~~~~~~~~~~~

1. In the left panel, click a menu item which will be parent for the menu divider that you create.

2. Click **Create** drop-down on the top right and select **Create Divider**.

.. image:: /admin_guide/img/menus/edit/menus_createdivider.png

The created divider will appear as the last one on the list of children of the same parent item. You can move it to the position that you need, as described in the :ref:`Rearrange Menu Items / Dividers <doc-config-menus-actions-draganddrop>` action description.

.. important::
    You need to reload the page to see changes.

.. note:: Some menus (or some menu levels) cannot display dividers. For example, if you add a divider to the first level of the main menu (**application_menu**), this divider will not be displayed.


View / Edit a Menu Item
~~~~~~~~~~~~~~~~~~~~~~~

1. In the left panel, click a menu item that you want to view / edit.

2. In the right part of the page, review / edit the menu item settings. See step 3 of the :ref:`Add a Menu Item <doc-config-menus-actions-addmenuitem>` action description for information about menu item fields.

.. important::
    You cannot edit URI for default menu items.


Toggle Item Visibility
~~~~~~~~~~~~~~~~~~~~~~

Hide a Menu Item
""""""""""""""""

If you do not want one of the default menu items to be visible on the interface, you can hide it.

.. important::
    - If a menu that you hide has child items, they will be hidden too.

    - You cannot hide non-default menu items.

To hide a menu item, perform the following steps:

1. In the left panel, click a menu item that you want to hide.

2. Click **Hide** on the top right.

.. important::
    You need to reload the page to see changes.

Show a Menu Item
""""""""""""""""

To show a previously hidden menu item, perform the following steps:

1. In the left panel, click a menu item that you want to show.

2. Click **Show** on the top right.

.. note::
    If a menu item that you want to show has a parent, it will become visible too.

.. important::
    You need to reload the page to see changes.

Find a Menu Item
~~~~~~~~~~~~~~~~

To quickly find a menu item, enter its name into the search field and click the |IcSearch| **Search** icon, or press :guilabel:`Enter`.

.. image:: /admin_guide/img/menus/edit/menus_application_search.png

Delete a Menu Item / Divider
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. important::
    - You cannot delete default menu items.

    - When you delete a menu item that has child items, they will not be deleted but moved to the parent of the menu item that you delete.

1. In the left panel, click a menu item / divider that you want to delete.

2. Click **Delete** on the top right.

3. In the **Delete Confirmation** dialog box, click :guilabel:`Yes, Delete`.

.. important::
     You need to reload the page to see changes.

Reset a Menu
~~~~~~~~~~~~

To reset any customization changes and roll back to the menu that is provided out of the box in Oro application:

1. In the left panel, click a menu name.

2. Click **Reset** on the top right.

3. In the **Reset Confirmation** dialog box, click :guilabel:`Yes, Reset`.

.. important::
    You need to reload the page to see changes.


.. finish_2

.. include:: /img/buttons/include_images.rst
   :start-after: begin
