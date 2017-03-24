.. _doc-config-menus:

Menus Configuration
===================

.. contents:: :local:
    :depth: 3

Description
-----------

This guide describes how to configure menus for the whole organization (or enterprise).

If you want to personalise menus for yourself only, open your profile, and select :guilabel:`Edit Menus` from the :guilabel:`More Actions` dropdown.

.. warning::
   For Enterprise Edition only:

   If your enterprise includes several organizations, changes made at **System>Menus** will affect all the organizations.

   To made changes only for a specific organization, navigate **System>User Management>Organization**, click the required organization, and on its view page, click :guilabel:`Edit Menu`.


.. important::
   The ability to configure menus is controlled by the two capabilities: **Manage Menus** and **Access system configuration**.

   - To enable a user to personalise menus for themselves and configure menus for each organization individually, include the **Manage Menus** capability into the user role.

   - To enable a user to configure menus the whole enterprise (all organizations that exist in the Oro application) at once, in addition to the **Manage Menus** capability, include also the **Access system configuration** capability into the user role.

.. _doc-config-menus-menuspage:

Menus Page
^^^^^^^^^^

This page contains a list of menus that you can configure.

|

.. image:: ../img/app_look_feel/menus.png

|

- **application_menu**—This is the main menu of the application (also called ``navigation bar`` in the application settings). Via it you can navigate through Oro application. It is always displayed on every page. Subject to configuration, it may be displayed horizontally or vertically. In the latter case, the menu items are displayed as icons. For more information, see :ref:`Main Menu <user-guide-navigation-menu>`.

  |

  .. image:: ../../user_guide/img/navigation/menu/nav_bar_top.png

  |

- **shortcuts**—You can find this menu in the top panel of the application, next to the organization name. Via it you can quickly perform common actions from anywhere. It is always displayed on every page. For more information, see :ref:`Shortcuts <user-guide-getting-started-shortcuts>`.



  .. image:: ../../user_guide/img/navigation/panel/shortcut_full.png

  |


- **usermenu**—This is the menu that you can access by clicking on your name in the upper-right corner of the application. Via it you can access your profile, emails, tasks and events. It is always displayed on every page. For more information, see :ref:`User Menu <user-guide-getting-started-user-menu>`.

  |

  .. image:: ../../user_guide/img/intro/user_menu.png

  |

- **calendar_menu**—This is a specialized menu that you can find on the **My Calendar** page. Via it you can change the displayed calendar color, hide or remove a calendar from view. For more information, see :ref:`Add and Manage Calendar Items Displayed <doc-activities-events-manage-calendar-items>`.

  |

  .. image:: ../img/app_look_feel/menus_calendar_menu.png

  |

.. _doc-config-menus-actions-viewmenu:

View a Menu
~~~~~~~~~~~~

To view a menu, click the corresponding row or the |IcView| **View** icon.


.. _doc-config-menus-configuration:

Menu Configuration
^^^^^^^^^^^^^^^^^^

When you open the menu configuration, you can see a list of menu items in the left panel of the page. A menu can be multi-level (as a default main menu, for example) with child menu items nested under a parent menu items (e.g. **Reports**, **Manage Custom** reports are child menu items of the **Reports&Segments** menu item in the main menu).

Menu items in a menu can be visually separated by a divider (a horizontal line). Dividers help you logically organize menu items.

.. note:: Some menus (or some menu levels) cannot display dividers. For example, if you add a divider to the first level of the main menu (**application_menu**), this divider will not be displayed.

|

.. image:: ../img/app_look_feel/menus_application.png

|

.. _doc-config-menus-actions-hideorshowpanel:

Hide / Show the Left Menu Panel
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To minimize or maximize the left menu panel, click a double arrow in the upper-right corner of the panel.


|

.. image:: ../img/app_look_feel/menus_application_showpanel.png

|

.. _doc-config-menus-actions-expandorcollapse:

Expand / Collapse a Menu
~~~~~~~~~~~~~~~~~~~~~~~~~

To expand / collapse a parent menu item, click an arrow in front of it.



|

.. image:: ../img/app_look_feel/menus_application_expand.png

|

To expand / collapse all menu items, click the ellipses dropdown menu in the upper-right corner of the left panel and click **Expand All** or **Collapse All**.

|

.. image:: ../img/app_look_feel/menus_application_expall.png

|



.. _doc-config-menus-actions-search:

Find a Menu Item
~~~~~~~~~~~~~~~~~

To quickly find a menu item, enter its name into the search field and click the |IcSearch| **Search** icon or press :guilabel:`Enter`.


|

.. image:: ../img/app_look_feel/menus_application_search.png

|

.. _doc-config-menus-actions-viewandedit:

View / Edit a Menu Item
~~~~~~~~~~~~~~~~~~~~~~~~

1. In the left panel, click a menu item that you want to view / edit.

2. In the right part of the page, review / edit the menu item settings. See step 3 of the :ref:`Add a Menu Item <doc-config-menus-actions-addmenuitem>` action description for information about menu item fields.


.. important::
    You cannot edit URI for default menu items.


.. _doc-config-menus-actions-addmenuitem:

Add a Menu Item
~~~~~~~~~~~~~~~

1. In the left panel, click a menu item which will be parent for the menu item that you create.

2. Click the :guilabel:`Create` dropdown in the upper-right corner of the page and click :guilabel:`Create Menu Item` on the list.

   |

   .. image:: ../img/app_look_feel/menus_createmenuitem.png

   |

   The created menu item will appear as the last one on the list of children of the same parent item. You can move it to the position that you need as described in the :ref:`Rearrange Menu Items / Dividers <doc-config-menus-actions-draganddrop>` action description.

3. In the right part of the page, specify the following information:

   - **Title**—A name for the menu item. This is how this menu item will be represented in the menu.

     Click the |IcTranslations| **Translations** icon to provide spelling for different languages. Click the |IcTranslationsC| **Default Language** icon to return to the single-language view.

     |

     .. image:: ../img/app_look_feel/menus_actions_create_translations.png

     |


   - **URI**—An web address of the page or resource that this menu item opens.

     You can specify an absolute URI or one relative to the application URI (as specified in :ref:`Application Settings <admin-configuration-application-settings>`).

     If this menu item serves as a non-clickable parent that does not link itself to any resource (like **Customers** in the default main menu), type *\#*.

   - **Icon**—From the list, select the icon that will denote the menu item.

     .. note:: Sometimes menus (or menu levels) may not be supposed to display icons. For example, icons added to the first level of the main menu (**application_menu**) are displayed only when this menu is set to appear on the left.

   - **Description**—Type a short but meaningful description of the menu item.

     Click the |IcTranslations| **Translations** icon to provide spelling for different languages. Click the |IcTranslationsC| **Default Language** icon to return to the single-language view.

   |

   .. image:: ../img/app_look_feel/menus_actions_create_general.png

   |

4. Click :guilabel:`Save` to save your changes. If you wish to start creating another menu item right away, click :guilabel:`Save and New` in the upper-right corner of the page.


.. important::
    You need to reload a page to see changes.

.. _doc-config-menus-actions-adddivider:

Add a Divider
~~~~~~~~~~~~~

1. In the left panel, click a menu item which will be parent for the menu divider that you create.

2. Click the :guilabel:`Create` dropdown in the upper-right corner of the page and click :guilabel:`Create Divider` on the list.

|

.. image:: ../img/app_look_feel/menus_createdivider.png

|

The created divider will appear as the last one on the list of children of the same parent item. You can move it to the position that you need, as described in the :ref:`Rearrange Menu Items / Dividers <doc-config-menus-actions-draganddrop>` action description.

.. important::
    You need to reload the page to see changes.

.. note:: Some menus (or some menu levels) cannot display dividers. For example, if you add a divider to the first level of the main menu (**application_menu**), this divider will not be displayed.

.. _doc-config-menus-actions-draganddrop:

Rearrange Menu Items / Dividers
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

You can change the position of an item / divider in a menu by dragging and dropping it in the left panel. You can change the order of menu items at the same level as well as move an item / divider to the higher or lower level.


When you drag-and-drop items, pay attention to the arrow that shows where the item will be placed:


- If an arrow points to the place between items, that is where the moved item will be placed.

  |

  .. image:: ../img/app_look_feel/menus_actions_d&dsame.png

  |



- If and arrow appears in front of a menu item, then the moved item will become a child of the item that the arrow points to.

  |

  .. image:: ../img/app_look_feel/menus_actions_d&dunder.png

  |


.. _doc-config-menus-actions-delete:

Delete a Menu Item / Divider
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. important::
    - You cannot delete default menu items.

    - When you delete a menu item that has child items, they will not be deleted but moved to the parent of the menu item that you delete.


1. In the left panel, click a menu item / divider that you want to delete.

2. Click the :guilabel:`Delete` button in the upper-right corner of the page.

3. In the **Delete Confirmation** dialog box, click :guilabel:`Yes, Delete`.

.. important::
     You need to reload the page to see changes.


.. _doc-config-menus-actions-hide:

Hide a Menu Item
~~~~~~~~~~~~~~~~

If you do not want one of the default menu items to be visible on the interface, you can hide it.

.. important::
    - If a menu that you hide has child items, they will be hidden too.

    - You cannot hide non-default menu items.

To hide a menu item, perform the following steps:

1. In the left panel, click a menu item that you want to hide.

2. Click the :guilabel:`Hide` button in the upper-right corner of the page.

.. important::
    You need to reload the page to see changes.


.. _doc-config-menus-actions-show:

Show a Menu Item
~~~~~~~~~~~~~~~~

To show a previously hidden menu item, perform the following steps:

1. In the left panel, click a menu item that you want to show.

2. Click the :guilabel:`Show` button in the upper-right corner of the page.

.. note::
    If a menu item that you want to show has a parent, it will become visible too.

.. important::
    You need to reload the page to see changes.


.. _doc-config-menus-actions-reset:

Reset a Menu
~~~~~~~~~~~~

1. In the left panel, click a menu name.

2. Click the :guilabel:`Reset` button in the upper-right corner of the page.

3. In the **Reset Confirmation** dialog box, click :guilabel:`Yes, Reset`.

.. important::
    You need to reload the page to see changes.


See Also
--------

   :ref:`Managing the Application Menu <doc-managing-app-menu>`

   :ref:`How to Create and Customize the Application Menu <doc-create-and-customize-app-menu>`

   :ref:`Display Settings <admin-configuration-display-settings>`

   :ref:`Language Settings <admin-configuration-language-settings>`


.. |IcView| image:: ../../img/buttons/IcView.png
	:align: middle

.. |IcSearch| image:: ../../img/buttons/IcSearch.png
	:align: middle

.. |IcTranslations| image:: ../../img/buttons/IcTranslations.png
	:align: middle

.. |IcTranslationsC| image:: ../../img/buttons/IcTranslationsC.png
    :align: middle
