Contributing to Translatiion
============================

.. contents:: :local:

OroCommerce supports localization and internationalization for multiple languages and locales.
All strings that may be translated are defined in the bundle translation domain files and are exposed via the translation
management service `CrowdIn`_ to enable the collaborative translation efforts.

To contribute to OroCommerce translation into your native language:

#. `Join the Translation Team`_.

#. `Submit Your Translations`_.

#. Wait for your translation to be approved.

#. In OroCommerce, in **System > Localization > Languages** section, ensure that synchronization is enabled for the target language. `Contact Oro Translation Team if you Face any Issues`_ (e.g. your translation does not appear in the OroCommerce after it has been approved).

Join the Translation Team
-------------------------

#. Sign in into your Crowdin account or sign up for a new user account if you don not have one yet:

   a) Open `Crowdin <https://crowdin.com/join>`_ in your browser.

   #) Sign in using your github account or social media account (facebook, google+, twitter). Alternatively, create a new Crowdin account: enter your email, user name, password and password confirmation, and click **Create account**. Follow the link in the confirmation Email to activate you account.

#. Open `OroCommerce project <https://crowdin.com/project/orocommerce>`_. **Note:** To offer translations for OroCRM and OroPlatform, please use their dedicated translation projects: `OroCRM project <https://translate.orocrm.com>`_ and `OroPlatrom project <http://translate.platform.orocrm.com>`_.

#. Select the target language for OroCommerce translation and click :guilabel:`Join` next to the following message: “You must join the translators team to be able to participate in this project”.

#. Type in the reason for joining the translation team (e.g. as a developer, I'd like to enable Korean translation for OroCommerce and my customization) and click :guilabel:`Join`.

#. Your request will be reviewed by the Oro support team. Upon approval, you will get an email from Crowdin with an invitation to start contributing.

Submit Your Translations
------------------------

#. To open OroCommerce translation project, click :guilabel:`Get Involved` in the email from Crowdin that confirms your OroCommerce project team membership. Alternatively, use the `OroCommerce project <https://crowdin.com/project/orocommerce>`_ link to open the project.

#. Select the target language (e.g. Korean).

   Translations are stored in *yaml* files organized by bundles (e.g. OroAlternativeCheckoutBundle, OroCatalogBundle) and by groups (e.g. messages, tooltips).

#. Select the yaml file with the translations you would like to contribute to.

#. Submit your translation. For more information on using Crowdin, please see the `Crowdin tutorial <https://support.crowdin.com/for-translators/onlineworkbench/translation-tutorial/>`_.

#. After you have submitted the translation, it will be queued for `proofreading <https://support.crowdin.com/for-translators/onlineworkbench/proofreading>`_. Other translators can `vote <https://support.crowdin.com/for-translators/onlineworkbench/voting>`_ for it.

#. When the translation is approved, it is marked with a green check and moved to the end of the list on the translation page. Approved translations are merged (published) to the OroCommerce translations once a day and become available in OroCommerce on the **System > Configuration > Language Settings** page.

  .. _translations-language-settings:

Update Translation in OroCommerce
---------------------------------

.. TODO: OroCommerce UI has changed. Confirm th correct process for translation sync with crowdin.

1. Navigate to the **System > Localization > Languages** in the main menu.

2. If your target language is not listed, click :guilabel:`Add language`, select the target language from the list and click **Add language** in the box to confirm the action. This will trigger the download of the translation files from the Crowdin project into OroCommerce.

3. If the status for your target language is *Disabled*, click on a **tick** icon in the **Updates** column. This will enable loading the translation updates automatically from the Crowdin project into OroCommerce.

Contact Oro Translation Team if you Face any Issues
---------------------------------------------------

.. include:: ./issues/translation.rst
   :start-after: begin
