.. _configuration--commerce--design--theme--theme-settings--globally:
.. _configuration--commerce--design--theme--page-templates:
.. _configuration--commerce--design--theme--filter-settings:
.. _configuration--commerce--design--theme--menu-templates:
.. _configuration--commerce--design--theme:

Theme
=====

In your Oro application, you can control and customize the storefront look and feel.

.. hint:: This can be done on three levels -- globally, :ref:`per organization <configuration--commerce--design--theme--theme-settings--organization>` and :ref:`website <configuration--commerce--design--theme--theme-settings--website>`.

.. begin_body

You can set the following theme-related options that apply globally by default:

.. begin_theme_overview

* Pre-designed theme for the storefront
* The layout for the product page details (default tabbed view, short, two column, or list)
* Style of the selector in filters
* Display mode for the user menu on the storefront

.. finish_theme_overview

To configure the storefront theme options globally:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Design > Theme** in the menu to the left.

.. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

The following page opens:

.. image:: /user_doc/img/system/config_commerce/design/design_theme_global.png

3. In the **Theme Settings** section, select the theme from the list. The theme controls general design of the storefront that defines its look and feel. *Default*, *blank*, and *custom* themes are available out of the box for the storefront.

   For example, this is how the address book looks in the storefront when for the default and custom themes:

   **Default theme**

   .. image:: /user_doc/img/system/config_commerce/design/MyProfileAddressBooks.png

   **Custom theme**

   .. image:: /user_doc/img/system/config_commerce/design/address_book_compact.png

4. In the **Page Templates** section, select the product page template from the list.

   This page template is used to render the product page in the storefront by default, unless the template is overridden in the product details.

   *Default template* (tabbed), *Short page*, *Two-column page*, and *List page* templates are available out of the box. For preview and more information on these options, see the :ref:`Manage Product Page Design with Page Templates <user-guide--page-templates>` topic.

   Select the **Use Parent Scope Value** check box to use the default value.

5. In the **Filter Settings** section, specify how the multi-select filters should look in the storefront. Available options are *Drop-down* and *All at once*.

   For example, this is how the user menu looks for different values:

   **Drop-down**

   .. image:: /user_doc/img/system/config_commerce/design/filter_settings_dropdown.png

   **All at once**

   .. image:: /user_doc/img/system/config_commerce/design/filter_settings_allatonce.png

6. In the **Menu Templates** section, select the user menu display mode that defines the look and feel of the user menu in the storefront.

   For example, this is how the user menu looks for different values:

   **Show all items at once**

   .. image:: /user_doc/img/system/config_commerce/design/ShowAllItemsAtOnce.png

   **Show subitems in a popup**

   .. image:: /user_doc/img/system/config_commerce/design/ShowSubitemsInPopup.png

7. Click **Save Settings**.

.. finish_body
