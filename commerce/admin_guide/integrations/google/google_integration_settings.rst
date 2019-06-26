.. _admin-configuration-integrations-google:

Configure Google Integration Settings
=====================================

.. contents:: :local:
    :depth: 2

To configure Google integration-related settings on the OroCommerce side:

1. Navigate to **System > Configuration** in the main menu.
2. In the panel to the left, click **System Configuration > Integrations > Google Settings**.

   .. image:: /user_guide/system/img/configuration/google_settings.png

3. In the **Google Integration Settings**, provide the following information:

   .. hint:: Before you begin, check out the `instructions on obtaining credentials the Google side <https://support.google.com/cloud/answer/6158862?hl=en>`_. Make sure that your domain is included into `Authorized JavaScript origins` and `Authorized redirect URIs`.

   * **Client ID**  --- The Client ID generated in the API console.
   * **Client Secret** --- The Client Secret generated in the API console.
   * **Google API Key** --- The API Key generated in the API console. Provide a valid `Google API key <https://developers.google.com/maps/documentation/javascript/get-api-key>`_ to activate maps for addresses in the system.

4. In the **Google Single Sign-on** section, click **Enable** to activate Google Single Sign-on and provide domain information to limit the list of mailboxes for which single sign-on can be used (e.g., only a domain used specifically by your company). Leave the **Domains** field empty to set no such limitation.

5. In the **Google Tag Manager Settings** section, clear the **Use Default** check box and select a :ref:`Google Tag Manager Integration <gtm-integration>` from the list to configure it for the application and enable data mapping.

   .. hint:: Google Tag Manager settings can be configured globally, :ref:`per organization <organization-google-settings>` and :ref:`per website <website-google-settings>`.

6. In the **OAuth 2.0 for Email Sync** section, select the **Enable** check box to activate sync. Please, make sure that Gmail API is enabled in `Google Developers Console <https://console.developers.google.com/apis>`_.

7. In the **Google Hangouts** section, provide the following details:

   * **Enable For Emails** --- Check the box to enable Google Hangouts for emails.
   * **Enable For Phones** --- Check the box to enable Google Hangouts for phones.

   By default, **Enable For Emails** and **Enable For Phones** are enabled.

8. Click **Save Settings**.
