:orphan:

.. _user-guide--system--menu--menu-frontend:

.. insert into: Customize Default Frontend Menus (www.oroinc.com/doc/orocommerce/current/user-guide/system/menu)

Edit a Frontend Menu
~~~~~~~~~~~~~~~~~~~~

.. start

To update the frontend menu contents, follow the :ref:`Customize Default Frontend Menus <doc--system--menu--config-levels--frontend-menus>` guide and click the menu name or on the |IcView| View icon in the corresponding row of the frontend menu list.

.. image:: /configuration_guide/img/menus/frontend_menu_1.png

On the page that opens, the menu item tree is shown in the left panel. The **General Information** section is reserved for the menu item configuration, which you can update, as shown in the :ref:`Add a Menu Item <doc--system--menu--config--add-menu-item>` section.

.. image:: /configuration_guide/img/menus/frontend_menu_2.png

Moreover, you can customize additional visibility restrictions in the following fields in order to selectively display or hide some menu items from the customer:

.. contents:: :local:

User Agent
""""""""""

User agent is unique to every customer. It reveals a catalog of technical data about the device and software that the customer is using. You can control whether to show or hide some menu items from the customer by proceeding with the following steps:

1) Click **+Add** next to the **User Agent** field.

The following text field displays:

.. image:: /configuration_guide/img/menus/frontend_menu_3.png

2) Fill in the text field with a user agent substring or a string, if required.

.. note::
   A user agent string is a combination of user agent application versions, operating systems, crawlers, and other scripts which are specific for each user (e.g. Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36).

   A user agent substring is a part of the aforementioned string (e.g. Mozilla, Windows, Safari, etc).

.. image:: /configuration_guide/img/menus/frontend_menu_4.png
   :width: 70%

3) Select the corresponding operation from the list.

   * The *contains* operation determines whether the specified substring is included in the user agent string (e.g. in case you mention Mozilla, all the versions of Mozilla in the user agent string will meet the requirements of this function).

   * The *does not contain* operation determines whether the specified substring is not included in the user agent string.

   * The *matches* operation checks whether the specified value fully matches the user agent string (e.g. you need to provide a version of Mozilla to meet the requirements of this function).

   * The *does not match* operation checks when the specified value does not match the user agent string.

   .. image:: /configuration_guide/img/menus/frontend_menu_5.png
      :width: 70%

4) To create more advanced condition, you can combine constrains into the expression using logical AND and OR operators:

   * Click **+ And** below the operation field within the same block to add another constrain block into the expression via AND.

     *AND* operation means that only those user agents that comply with all the specified conditions in a group will be selected.

   .. image:: /configuration_guide/img/menus/frontend_menu_6.png

   * Click **+ Add** at the bottom of the expression block to add another constrain block into the expression via OR.

     *OR* operation activates the expression once any of the constraint blocks in a group evaluates to true.

   .. image:: /configuration_guide/img/menus/frontend_menu_7.png

Exclude On Screens
""""""""""""""""""

**Exclude On Screens** enables you to hide the menu items on the specified screens sizes.

1) Click any screen size to select the one for which the menu will be hidden from the customer.
2) Hold **Ctrl** and click the value to select/deselect multiple screens.
3) Click **Save**.

.. image:: /configuration_guide/img/menus/frontend_menu_8.png

As an illustration, let us hide the **About** menu item from the desktops with 13 in. screen by enabling **Exclude On Screens** and selecting the corresponding screen size.

.. image:: /configuration_guide/img/menus/frontend_menu_9.png

Condition
"""""""""

**Condition** enables you to restrict visibility of a menu item using the following functions:

* The *is_logged_in()* function stands for the *registered users*. If entered, only the users who have logged into the Oro front store are enabled to view the corresponding menu item.

  .. image:: /configuration_guide/img/menus/frontend_menu_10.png

* The *!is_logged_in()* function stands for the *non-registered users*. If entered, only the unregistered users are enabled to view the corresponding menu item.

* The *config_value('some_identifier')* function limits visibility of the corresponding menu item upon specifying the certain value instead of *'some_identifier'*.

  As an example, let us make the **About** section in the front store visible to customers with configured taxes. For this, we need to:

  a) Customize the *config_value('some_identifier')* function with the required value instead of *some_identifier*. In our case, it is the *oro_tax.tax_enable* value.

  b) Click **Save** on the top right of the About menu page to save the changes.

  b) Enable **Tax Calculation** in the system configuration. More information on tax configuration can be found in the relevant :ref:`Configure Tax Calculation <user-guide--taxes--tax-configuration>` topic.

  c) Click **Save** on the top right of the Tax Calculation configuration page.

  The steps are illustrated below:

     .. image:: /configuration_guide/img/menus/frontend_menu_11.png
        :class: with-border

     .. image:: /configuration_guide/img/menus/frontend_menu_12.png
        :class: with-border

.. finish

.. include:: /user_guide/include_images.rst
   :start-after: begin










