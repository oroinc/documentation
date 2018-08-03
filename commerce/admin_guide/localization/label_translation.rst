.. _localization--translations--labels:

Translate Product Attribute Labels
==================================

.. contents:: :local:

There are two ways to translate product attribute labels in OroCommerce:

* By changing the source language to the target language for the label and then adding the label translation to the required attribute on its edit page.
* By updating the attribute label translation directly on the Translations page.

You may find option 1 less time consuming and more straightforward. However, with option 2 you can search for any attribute labels or entity fields within a single Translations table.

Option 1
--------

To translate a product attribute label from English into the required language, change the default language first:

1. Navigate to **System > Configuration > System Configuration > General Setup > Language Settings** in the main menu.
#. In the **Language Settings**, select the required language from the list to add to **Supported Languages**. 

   .. image:: /admin_guide/img/localization/labels/add_supported_language.png
      :alt: Add another supported language to the application in the system configuration 

   .. note:: Make sure you have enabled the corresponding language(s) in the **System > Localization > Languages** menu to make them available in the list. 

#. Click **Save Settings**.
#. Navigate to your user configuration by clicking on your user name on the top right of the page and clicking **My Configuration**.

   .. image:: /admin_guide/img/localization/labels/user_config_menu.png
      :alt: User configuration menu

#. Clear the **Use Organization** checkbox and set the language that you have just added (e.g. German) as the default language for the UI elements displayed in the management console.
 
   .. image:: /admin_guide/img/localization/labels/user_confi_language_settings.png
      :alt: Changing the default language on user level

#. Click **Save Settings**.

Once the default language is changed, update the label for the required product attributes:

1. Navigate to **Products > Product Attributes** in the main menu.
 
   .. image:: /admin_guide/img/localization/labels/product_att_menu.png
      :alt: Navigating to the product attributes menu

#. Open the edit page of the required product attribute.

   .. image:: /admin_guide/img/localization/labels/edit_product_att.png
      :alt: Editing a product attribute from the grid

#. Update the text for the label.

   .. image:: /admin_guide/img/localization/labels/translated_label.png
      :alt: The product attribute label translated once the application language on use level is updated

#. Update the translation cache by clicking on the link in the pop-up dialog.

   .. image:: /admin_guide/img/localization/labels/update_translation_cache.png
      :alt: Click on the link to update cache once the label is translated

#. Once you are redirected to the translations page, click **Update Cache** (or its version in your default language) on the top right.

   .. image:: /admin_guide/img/localization/labels/update_cache_page.png
      :alt: Update translation cache

#. Click **Save and Close** (or its version in your default language).

   The product attribute label is updated in the storefront.

   .. image:: /admin_guide/img/localization/labels/label_updated.png
      :alt: Updated product attribute label in the storefront

Option 2
--------

To translate a product attribute label from within the Translations grid, navigate to **System > Localization > Translations** in the main menu.

**If the attribute has been created in one of the supported languages in a language other than English, use the following filters to narrow down the search and locate the attribute label key:**

* **Languages** --- The language in which the attribute was created
* **Translated Value** --- [Attribute Name] or its part, e.g demo_attribute
* **English Translation** -- Not available

  Please note that when an attribute is created under a non-English localization, English translation is absent.

* **Key** --- oro.product.

  All product attribute labels start with *oro.product.* and include the name of the attribute (often with underscores). You are looking for the key that ends with a *label*. For example, oro.product.deutsch_demo_attribute.label

* **Domain** --- messages

  .. image:: /admin_guide/img/localization/labels/filtered_attributes.png
     :alt: Filtered attributes

Once you locate the key, you can use it to translate the label into any selected language using the following filters:

* **Languages** --- All (or selected)
* **Key** --- [Your Key] e.g. oro.product.deutsch_demo_attribute.label

  .. image:: /admin_guide/img/localization/labels/translations_all_languages.png
     :alt: Translating the filtered label 

**If the attribute has been created in English, use the following filters to narrow down the search and locate the attribute label key:**

* **English Translation** --- [Attribute Name], e.g english_demo_attribute
* **Language** --- English

  .. image:: /admin_guide/img/localization/labels/english_attr_label_located_translations_grid.png
     :alt: Locating the key for the label

Once you locate the key, you can use it to translate the label into any selected language using the Key filter:

* **Key** --- [Your Key] e.g. oro.product.english_demo_attribute.label

  .. image:: /admin_guide/img/localization/labels/english_pr_att_translation_grid.png
     :alt: Translating the label from English using the key filter