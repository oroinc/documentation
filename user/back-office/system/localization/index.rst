:oro_documentation_types: OroCRM, OroCommerce
:oro_show_local_toc: false

.. _sys--config--sysconfig--general-setup--localization:
.. _doc-user-management-users-configuration-localization:

Manage Localizations, Languages, and Translations in the Back-Office
====================================================================

:term:`Localization` is the process of translating and adapting a product for a specific country or region. Oro application allows a user to customize the format of date and time, numeric, percent, and monetary values as well as the format of names and addresses.

Oro application supports localization and provides decent out-of-the-box translation coverage for the most used languages. With out-of-the-box integration to CrowdIn service, Oro applications have live access to the most recent updates from the Oro team and community.

See :ref:`How to Contribute to Translations <doc--community--ui-translations>` for more information about the translation process.

.. Keep reading to learn about the localization process (:ref:`open the quick visual guide <config-localization-quick-start>`):

Localization Process
--------------------

To translate the Oro application's storefront and back-office to a desired language, make sure to take the following steps in the localization process:

    **Step 1**. In the :ref:`Languages <localization--languages>` section, add desired languages to the system, enable them, import translation texts for the language or install translation updates from the CrowdIn project.

    **Step 2**. In the :ref:`Translations <localization--translations>` section, check the existing and imported translations for the UI system elements (e.g., labels, checkboxes, buttons, notifications, etc.). There, you can add, modify, or delete translation texts for these items if necessary.

              .. note:: Remember to :ref:`update the cache <update-translation-cache>` after each translation adjustment.

    **Step 3**. In the :ref:`Localizations <localization--localizations>` section, create a localization that inherits a translation from another language when the translation to the main language of the localization is not available. This helps avoid double efforts when translating to similar and related languages and dialects of the same language.

    **Step 4**. Once the necessary localizations are created, you can now translate the content elements (e.g., names, titles, labels, descriptions, etc.) using inline :ref:`content translation <content-translation>` available for most of the text fields.

                .. image:: /user/img/system/localization/ProductsCreateTranslation.png
                   :width: 400px

    **Step 5**. Now, enable all the necessary localizations of the UI system and content elements to be displayed to the user both in the storefront and the back-office in the :ref:`Localization Settings <localization--localization>` section.

For detailed information on these topics, please see the following sections:

* :ref:`Add and Enable Languages. Export and Import Translations to the Target Language <localization--languages>`
* :ref:`Edit and Cache Translations <localization--translations>`
* :ref:`Add and Manage Localizations <localization--localizations>`
* :ref:`Configure Localization Settings <localization--localization>`
* :ref:`Translate Content <content-translation>`
* :ref:`Translate Product Attribute Labels <localization--translations--labels>`
* :ref:`Translate Content Blocks <user-guide--landing-pages--marketing--content-blocks--translation>`
* :ref:`Translate Consents <user-guide--consents--localizing-consents>`
* :ref:`Translate Email Templates <localize-email-templates>`



.. include:: /include/include-images.rst
   :start-after: begin

.. toctree::
   :maxdepth: 1
   :hidden:

   Languages <languages/index>
   Translations <translations/index>
   Localizations <localizations/index>
