:oro_documentation_types: crm, commerce

.. _localization--languages:

Languages
---------

.. begin

In the Oro applications, language is a core component of system localization and content translation. It performs the following functions:

* Groups translations for all the text system elements available to the user (labels, UI, etc).
* Enables download (export) and upload (import) of the system elements identifiers and their translation to the target language. This enables you to customize translation and update it in the current instance only.
* Enables installation of the translation updates from the third party translation services.

To view and update the existing languages, or add new ones, navigate to **System > Localization > Languages** in the main menu.

.. image:: /user/img/system/localization/languages.png

The following information about the languages is available in the All Languages list:

+--------------------------+-------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Name                     | Description                                                                                                                                                 |
+==========================+=============================================================================================================================================================+
| LANGUAGE                 | The language of the text system elements available to the user.                                                                                             |
+--------------------------+-------------------------------------------------------------------------------------------------------------------------------------------------------------+
| STATUS                   | The status of the target language that identifies whether the translation is enabled or disabled for the Oro application.                                   |
+--------------------------+-------------------------------------------------------------------------------------------------------------------------------------------------------------+
| TRANSLATION COMPLETENESS | The translation completion progress measured in percentages.                                                                                                |
+--------------------------+-------------------------------------------------------------------------------------------------------------------------------------------------------------+
| UPDATES                  | The status that defines whether the corresponding language translation can be installed and updated via the |Crowdin| service.                              |
+--------------------------+-------------------------------------------------------------------------------------------------------------------------------------------------------------+


Every language covers the Oro application elements translation for a specific localization. For example, French (Canada) or English (Canada) localization may be linked to a respective language with translations that apply to Canada only.

To add a new translation and start using it for localization:

1. Click **Add Language** at the top right corner.
2. Select the target language from the available list in the popup dialog. Start typing the language name in the blank field to narrow down the choices.
3. Click **Add Language** in the bottom right of the dialog.

.. image:: /user/img/system/localization/languages_add.png

Now, once the language has appeared in the list, you can perform the following actions:

.. image:: /user/img/system/localization/languages_actions.png

1. Import the file with the system elements translation from the |Crowdin| service into the Oro application by clicking the |IcCloudDownload| icon at the end of the row and then **Install** in the popup form. The import is available if the status in the **Updates** column is set to *Can be installed* signifying that the corresponding translation has been provided on the Crowdin website. More information on how to contribute to the Oro application translation is described in the :ref:`Contribute to Translations <doc--community--ui-translations>` section.

2. If there is no translation available on the Crowdin website, or it is not enough to cover all the text system elements in the application, provide your own translation:

   a) Click |IcDownload| and download the file with all the items required for translation.
   #) Receive the email with the exported file upon completion.
   #) Fill in the file with the proper translation of the UI elements.

3. Once the translation is completed, you can upload the file into the application:

   a) Click |IcUpload| to trigger a popup import dialog.
   #) Click **Choose File** and select the .csv file you have prepared.
   #) Select the strategy for uploading the file.

      * **Add and Replace** strategy adds a translation to the elements that had no translation before and overrides the existing translation with the one mentioned in the file.
      * **Reset and Add** strategy removes all the existing translations for the selected language and adds only the ones mentioned in the file.

      .. image:: /user/img/system/localization/languages_import_strategy.png

   #) Click **Submit** to start the file import.
   #) Click **Cancel** to decline the import.

   .. important:: Interactive status messages inform about the import progress. Additionally, an email message with the import status is delivered to your mailbox. Once the import is complete, check out the changes in the :ref:`Translations <localization--translations>` section.

4. Click |IcActivate| to enable the language for the application.


Now, you need to update the translation cache so that all the changes could enter into force. Click the reference link at the top and follow the steps described in the :ref:`Translations <localization--translations>` section.

   .. image:: /user/img/system/localization/languages_reference_link.png

.. finish

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-links.rst
   :start-after: begin