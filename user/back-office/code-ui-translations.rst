:orphan:

..  _doc--community--ui-translations:

Contribute to Translations
==========================

Oro applications support localization and internationalization for multiple languages and locales.
All strings that may be translated are defined in the bundle translation domain files and are exposed via the translation management service |Crowdin| to enable the collaborative translation efforts.

To contribute to OroCRM translation into your native language:

#. :ref:`Join the translation team <translations-join-the-team>`.

#. :ref:`Submit your translations <translations-submit>`.

#. Wait for your translation to be approved.

#. :ref:`Ensure that synchronization is enabled for the target language <translations-language-settings>`.

:ref:`Contact Oro translation team <translations-contact>` if you face any issues (e.g., your translation does not appear in the Oro application after it has been approved).

.. _translations-join-the-team:

Join the Translation Team
-------------------------

#. Sign into your Crowdin account or sign up for a new user account if you don not have one yet:

   a) Open |Crowdin| in your browser.

   #) Sign in using your github or social network account (Facebook, Google+, Twitter).

      Alternatively, create a new Crowdin account: enter your email, user name, password and password confirmation, and click **Create account**. Follow the link in the confirmation email to activate you account.

#. Open |OroCRM|.

   .. note:: To offer translations for OroCommerce and OroPlatform, please use their dedicated translation projects: |OroCommerce project| and |OroPlatform project|.

#. Select the target language for OroCRM translation and click **Join** next to the following message: “You must join the translators team to be able to participate in this project”.

#. Type in the reason for joining the translation team (e.g., "As a developer, I would like to enable Korean translation for OroCRM and my customization") and click **Join**.

#. Your request will be reviewed by the Oro support team. Upon approval, you will get an email from Crowdin with an invitation to start contributing.


.. _translations-submit:

Submit Your Translations
------------------------

#. To open the translation project, click **Get Involved** in the email from Crowdin that confirms your OroCrm project team membership.

   Alternatively, use the |OroCRM project| link to open the project.

#. Select the target language (e.g., Korean).

   Translations are stored in yaml files organized by bundles (e.g., OroAccountBundle, OroActivityContactBundle) and by groups (e.g., messages, tooltips).

#. Select the yaml file with the translations you would like to contribute to.

#. Submit your translation. For more information on using Crowdin, please see the |Crowdin tutorial|.

After you have submitted the translation, it will be queued for |proofreading|. Other translators can |vote| for it.

When the translation is approved, it is marked with a green check mark and moved to the end of the list on the translation page. Approved translations are merged (published) to the Oro application translations once a day and become available in Oro application in the language settings (to open the language settings, in the main menu, navigate to **System > Configuration > Language Settings**).


.. _translations-language-settings:

Update Translation in Oro Application
-------------------------------------

.. TODO: OroCRM UI has changed. Confirm th correct process for translation sync with crowdin.

1. Navigate to the **System > Localization > Languages** in the main menu.

2. If your target language is not listed, click **Add language**, in the **Add Language** dialog that opens, select the target language from the list and click **Add language**. This will trigger the download of the translation files from the Crowdin project into the Oro application.

3. If the status for your target language is *Disabled*, click the |IcCheck| **Enable** icon at the end of the row.
   .. This will enable loading the translation updates automatically from the Crowdin project into the Oro application.

4. If you see *Update is available* in the **Updates** column, click |IcCloudDownload| **Update** at the end of the row to update translations from the Crowdin project.


.. _translations-contact:

Contact Oro Translation Team
----------------------------

In order to report a translation-related issue, please use the
|contact| link in the **Owner** section on the |OroCRM project| in Crowdin.

Please do not hesitate to contact us from Crowdin if:

* Your translation has been marked as approved for over one day but has not appeared in OroCRM

* Your translation is still not approved after more than seven days of review.

* You would like to help proofread a target language.

* You have any other questions and issues related to translations that are not covered in Oro documentation and the Crowdin tutorial.



.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-links.rst
   :start-after: begin