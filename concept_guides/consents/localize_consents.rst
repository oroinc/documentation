.. _user-guide--consents--localizing-consents:

Localize Consents
-----------------

To translate the consent labels and content from English into the required language, make sure to take the following steps:

1. Create a necessary :ref:`localization <localization--localizations>` under **System > Localization > Localizations**.

2. Add the required localization to the list of enabled localizations under **System > Configuration > System Configuration > General Setup > Localization**. It enables customers to select a desired language of the website content in the storefront.

   .. image:: /img/system/consents/consents_enabled_localization.png
      :alt: Add the necessary localizations to the list of enabled localizations

3. Enable consents on the :ref:`global <admin--guide--commerce--configuration--customers--consents--enable--globally>` and :ref:`website <admin--guide--commerce--configuration--customers--consents--enable--website>` levels.

4. Select a consent that needs to be localized under **System > Consent Management** and provide a translation of the consent name following the guidance in the :ref:`Translations and Localizations section <localization--localization>`.

   .. image:: /img/system/consents/translate_consent_name.png
      :alt: Provide a translation of the consent name

5. Create a consent :ref:`landing page <user-guide--consents--add>` with the title and description of the consent in the target language (e.g., German, French, etc) and add the landing page to the existing content tree node that requires translation.

   .. image:: /img/system/consents/create_landing_page_german.png
      :alt: A sample of the consent landing page with the title and text of the consent in German

.. note:: Keep in mind that for each localization you need to create a new landing page in the corresponding language.

6. Set the visibility restriction of the consent landing page to a certain localization. This defines which consent variant to display to the customer based on the language they select in the storefront.

   .. image:: /img/system/consents/add_landing_pages_to_consents.png
      :alt: Steps that need to be performed to add consent landing pages to a content node

The changes in the storefront are applied immediately once the settings are saved.

7. Check the consent translation in the storefront by selecting the desired localization.

   .. image:: /img/system/consents/german_consent.png
      :alt: View the consent translated to German when the German localization is selected

8. Click the consent link to open the consent landing page.

   .. image:: /img/system/consents/german_consent_example.png
      :alt: A sample of the consent landing page translated to German