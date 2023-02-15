.. _content-translation:
.. _sys--config--sysconfig--general-setup--language-settings:

:oro_documentation_types: OroCommerce

Translate Content
-----------------

Provide Spelling for Required Language
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. begin_content_translation

You can provide the translation for all content elements of your storefront (e.g., product names, descriptions, catalog titles, SEO attributes, etc.) using inline content translation available for most of the text fields.

.. image:: /user/img/concept-guides/localization/content-translation-example.png


For that:

1. Create a necessary :ref:`localization <localization--localizations>` under **System > Localization > Localizations**.

2. Add the required localization to the list of enabled localizations under **System > Configuration > System Configuration > General Setup > Localization**. It enables customers to select a desired language of the website content in the storefront.

3. Navigate to the content element you want to provide the translation for.

4. Click the |IcTranslations| **Translations** icon next to the required content element to provide spelling for different languages.

.. image:: /user/img/concept-guides/localization/content_translation.png
   :alt: Click the translations icon next to the Titles to provide spelling for different languages

The corresponding content translation is displayed in the storefront upon selecting this localization.

.. image:: /user/img/concept-guides/localization/translation_frontstore.png
   :alt: View the content translated to German when the German localization is selected in the storefront

.. finish_content_translation

Translate Product Descriptions
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To translate the product description to a required language, move from tab to tab, selecting the desired localization. Provide the related translation or select the parent localization to inherit the translation from. If the localization does not have a parent, you can enable fallback to the default template value.

.. image:: /user/img/concept-guides/localization/translate_product_description.png
   :alt: Selecting the German localization tab under the product description section to open the empty field for translation



.. include:: /include/include-images.rst
   :start-after: begin