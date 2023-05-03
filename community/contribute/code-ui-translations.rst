.. _doc--community--ui-translations:

Contribute to Translations
==========================

Oro applications support localization and internationalization for multiple languages and locales.
All strings that may be translated are defined in the bundle translation domain files and are exposed via the translation management service |Crowdin| to enable the collaborative translation efforts.

To contribute to Oro translation into your native language:

#. :ref:`Join the translation team <translations-join-the-team>`.

#. :ref:`Submit your translations <translations-submit>`.

#. Wait for your translation to be approved.

#. :ref:`Ensure that synchronization is enabled for the target language <translations-language-settings>`.

:ref:`Contact Oro translation team <translations-contact>` if you face any issues (e.g., your translation does not appear in the Oro application after it has been approved).

.. _translations-join-the-team:

Join the Translation Team
-------------------------

#. Sign into your Crowdin account or sign up for a new user account if you do not have one yet:

   a) Open |Crowdin| in your browser.

   #) Sign in using your github or social network account (Facebook, Google+, Twitter).

      Alternatively, create a new Crowdin account: enter your email, user name, password, and password confirmation, and click **Create account**. Follow the link in the confirmation email to activate you account.

#. Open |OroCommerce project|.

   .. note:: To offer translations for OroCRM and OroPlatform, please use their dedicated translation projects: |OroCRM project| and |OroPlatform project|.

#. Select the target language for OroCommerce translation and click **Join** next to the following message: “You must join the translators team to be able to participate in this project”.

#. Type in the reason for joining the translation team (e.g., "As a developer, I would like to enable Korean translation for OroCommerce and my customization") and click **Join**.

#. Your request will be reviewed by the Oro support team. Upon approval, you will get an email from Crowdin with an invitation to start contributing.

.. _translations-submit:

Submit Your Translations
------------------------

#. To open the translation project, click **Get Involved** in the email from Crowdin that confirms your OroCommerce project team membership.

   Alternatively, use the |OroCommerce project| link to open the project.

#. Select the target language (e.g. Korean).

   Translations are stored in yaml files organized by bundles (e.g. OroAlternativeCheckoutBundle, OroCatalogBundle) and by groups (e.g. messages, jsmessages).

#. Select the yaml file with the translations you would like to contribute to.

#. Submit your translation. For more information on using Crowdin, please see the |Crowdin tutorial|.

After you have submitted the translation, it will be queued for proofreading. Other translators can vote for it.

When the translation is approved, it is marked with a green check mark and moved to the end of the list on the translation page. Approved translations are merged (published) to the Oro application translations once a day and become available in Oro application in the language settings (to open the language settings, in the main menu, navigate to **System > Configuration > Language Settings**).

.. _translations-language-settings:

Update Translation in Oro Application
-------------------------------------

1. Navigate to the **System > Localization > Languages** in the main menu.

2. If your target language is not listed, click **Add Language** at the top right corner. Select the target language from the available list in the popup dialog. Click **Add Language** in the bottom right of the dialog.

3. Import the system elements translation from the |Crowdin| project by clicking the |IcCloudDownload| icon at the end of the row and then **Install** in the popup form. The import is available if the status in the **Updates** column is set to **Can be installed** signifying that the corresponding translation has been provided on the Crowdin website.

4. If the status for your target language is *Disabled*, click the |IcCheck| **Enable** icon at the end of the row.

5. If you see *Update is available* in the **Updates** column, click |IcCloudDownload| **Update** at the end of the row to update translations from the Crowdin project.

.. include:: /include/include-links-dev.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin

.. _translations-contact:

Contact Oro Translation Team
----------------------------

.. include:: /community/report-issues/translation.rst
   :start-after: begin_report_translation_issue
   :end-before: finish_report_translation_issue

**See Also**

* :ref:`Version Control <code-version-control>`

* :ref:`Code Style <doc--community--code-style>`

* :ref:`Set Up a Development Environment <doc--dev-env-best-practices>`

* :ref:`Contribute to Documentation <documentation-standards>`

* :ref:`Report an Issue <doc--community--issue-report>`

* :ref:`Report a Security Issue <reporting-security-issues>`

* :ref:`Contact Community <doc--community--contact-community>`

* :ref:`Release Process <doc--community--release>`

.. include:: /include/include-images.rst
   :start-after: begin

