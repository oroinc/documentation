.. _localization--translations--labels:

Translate Product Attribute Options
===================================

.. hint:: This section is part of the :ref:`Localization and Translation <concept-guide--localization-translation>` concept guide that provides a general understanding of the localization and translation processes in OroCommerce.

To translate a product attribute option from English into the required language, change the default language first:

1. Navigate to **System > Configuration > System Configuration > General Setup > Localization** in the main menu.
2. In the **Localization Settings**, select the required localization from the list to add to **Enabled Localizations**.

   .. image:: /user/img/system/localization/labels/add_supported_language.png
      :alt: Add another supported language to the application in the system configuration

   .. note:: Make sure you have created the corresponding localization in the **System > Localization > Localizations** menu to make them available in the list.

3. Click **Save Settings**.
4. Navigate to your user configuration by clicking on your user name on the top right of the page and clicking **My Configuration**.

   .. image:: /user/img/system/localization/labels/user_config_menu.png
      :alt: User configuration menu

5. Clear the **Use Organization** checkbox and set the localization that you have just added (e.g., German) as the default language for your application and for the UI system elements and content displayed in the back-office and in the storefront.

   .. image:: /user/img/system/localization/labels/user_config_language_settings.png
      :alt: Changing the default language on user level

6. Click **Save Settings**.

Once the default language is changed, update the label for the required product attributes:

1. Navigate to **Products > Product Attributes** in the main menu.

   .. image:: /user/img/system/localization/labels/product_att_menu.png
      :alt: Navigating to the product attributes menu

2. Open the edit page of the required product attribute.

   .. image:: /user/img/system/localization/labels/edit_product_att.png
      :alt: Editing a product attribute from the grid

3. Update the text for the label.

   .. image:: /user/img/system/localization/labels/translated_label.png
      :alt: The product attribute label translated once the application language on use level is updated

.. note:: Keep in mind that if an attribute is of a *select* or *multi-select* type, you can provide a proper translation to its options directly from the attribute edit page.

   .. image:: /user/img/system/localization/labels/translated_label_options.png
      :alt: Translating the attribute options to German

4. Click **Save and Close** (or its version in your default language).

The product attribute label and it options are updated in the storefront.

   .. image:: /user/img/system/localization/labels/label_updated.png
      :alt: Updated product attribute label in the storefront


.. note:: To translate any UI system element, label, or a popup message, read the :ref:`related documentation <localization--translations--messages>`.