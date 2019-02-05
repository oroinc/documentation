.. _sys--config--sysconfig--general-setup--localization:
.. _doc-user-management-users-configuration-localization:

System Localization and Translations
------------------------------------

Localization is the process of translating and adapting a product for a specific country or region. Oro application allows a user to customize the format of date and time, numeric, percent , and monetary values as well as the format of names and addresses.

Oro application supports localization and provides decent out-of-the-box translation coverage for the most used languages. With out-of-the-box integration to CrowdIn service, OroCommerce has live access to the most recent updates from the Oro team and community.

See :ref:`Translating OroCommerce into your Native Language <doc--community--ui-translations>` for more information about the translation process.

Keep reading to learn about the localization process (:ref:`open the quick visual guide <config-localization-quick-start>`):

+-------------+-----------------------------------+--------------------------------------------------------------------+
| Process     | Management Console Localization   | Storefront Localization                                            |
+=============+===================================+====================================================================+
| **Step 1**  | In the :ref:`Languages <localization--languages>` section,                                             |
|             | you can add more languages to the system, enable/disable                                               |
|             | them, import and export translation texts for the language,                                            |
|             | and install translation updates from the CrowdIn project.                                              |
|             |                                                                                                        |
+-------------+--------------------------------------------------------------------------------------------------------+
| **Step 2**  | In the :ref:`Translations <localization--translations>` section, you can view the                      |
|             | items available for translation to the enabled and disabled languages in OroCommerce,                  |
|             | add and modify translation text for these items, and delete these items if necessary.                  |
|             |                                                                                                        |
+-------------+--------------------------------------------------------------------------------------------------------+
| **Step 3**  | In the :ref:`Language Settings <sys--config--sysconfig--general-setup--language-settings>`,            |
|             | you can set the default language used in the management console and supported languages for            |
|             | email notification templates.                                                                          |
+-------------+-----------------------------------+--------------------------------------------------------------------+
| **Step 4**  | N/a                               | In the :ref:`Localizations <localization--localizations>` section, |
|             |                                   | you can create a system where localization inherits a translation  |
|             |                                   | from another language when the translation to the main language of |
|             |                                   | the localization is not available. This helps to avoid double      |
|             |                                   | efforts when translating to similar and related languages and      |
|             |                                   | dialects of the same language.                                     |
|             |                                   |                                                                    |
+-------------+-----------------------------------+--------------------------------------------------------------------+
|             |                                                                                                        |
| **Note**    | Once the required languages and localizations are created, you can set up the translation frame        |
|             | for the in-place UI and content elements displayed to the user both in the storefront and              |
|             | the management console.                                                                                |
+-------------+-----------------------------------+--------------------------------------------------------------------+
| **Step 5**  | N/a                               | In the :ref:`Localization Settings <localization--localization>`,  |
|             |                                   | you can configure the default or custom localization and select    |
|             |                                   | the language of the text system elements displayed in the front    |
|             |                                   | store.                                                             |
|             |                                   |                                                                    |
+-------------+-----------------------------------+--------------------------------------------------------------------+
| **Step 6**  |                                   | Use inline :ref:`content translation <content-translation>`        |
|             |                                   | available for most of the text                                     |
|             |                                   | fields (e.g. names, titles, labels, descriptions, etc.)            |
|             |                                   |                                                                    |
|             |                                   | To enter translation manually, click |IcTranslate| next to the     |
|             |                                   | field, clear the                                                   |
|             |                                   | **Use <parent translation>** check box next to the required        |
|             |                                   | language, and provide your version of the translation.             |
|             |                                   |                                                                    |
|             |                                   | |Translation_img|                                                  |
+-------------+-----------------------------------+--------------------------------------------------------------------+

.. |Translation_img| image:: /user_guide/img/products/products/ProductsCreateTranslation.png
                     :width: 200px

For detailed information on these topics, please see the following sections:

* :ref:`Add and Enable Languages. Export and Import Translations to the Target Language <localization--languages>`
* :ref:`Edit and Cache Translations <localization--translations>`
* :ref:`Add and Manage Localizations <localization--localizations>`
* :ref:`Configure Localization Settings <localization--localization>`
* :ref:`Configure Language Settings <sys--config--sysconfig--general-setup--language-settings>`
* :ref:`Translate Content <content-translation>`
* :ref:`Translate Product Attribute Labels <localization--translations--labels>`
* :ref:`Translate Content Blocks <user-guide--landing-pages--marketing--content-blocks--translation>`
* :ref:`Translate Consents <user-guide--consents--localizing-consents>`


.. include:: /img/buttons/include_images.rst
   :start-after: begin

.. toctree::
   :maxdepth: 1
   :hidden:

   languages
   translations
   localizations
   localization_configuration
   organization_localization
   website_localization
   user_localization
   language_settings
   intro
   content_translation
   label_translation