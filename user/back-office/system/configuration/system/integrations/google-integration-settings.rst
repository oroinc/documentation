:oro_documentation_types: OroCRM, OroCommerce

.. _admin-configuration-integrations-google:

Configure Global Google Settings
================================

.. hint:: Read more on this topic in :ref:`Google Integration <admin-configuration-google>`.

To configure Google integration-related settings in the back-office:

1. Navigate to **System > Configuration** in the main menu.
2. In the panel to the left, click **System Configuration > Integrations > Google Settings**.

.. image:: /user/img/system/config_system/google_settings_new.png
   :alt: Global Google settings

.. note:: These settings can be configured globally and :ref:`per organization <user-guide-hangouts-org>`.

Google Integration Settings
---------------------------

Before you begin, check out the |instructions on obtaining credentials the Google side|. Make sure that your Oro domain is included into `Authorized JavaScript origins` and `Authorized redirect URIs`.

In the Google Integration Settings section, provide the following details:

* **Client ID** --- The Client ID generated in the API console.

* **Client Secret** --- The Client Secret generated in the API console.

* **Google API Key** --- The API Key generated in the API console. Provide a valid |Google API key| to activate maps for addresses in the system.

Google Sign-on
--------------

In the Google Sign-on section, provide the following details:

* **Enable** --- Check **Enable** to activate Google Single Sign-on.

* **Domains** --- Domains is a comma separated list of allowed domains. It limits the list of mailboxes for which single sign-on can be used (e.g., only a domain used specifically by your company). Leave the field empty to set no such limitation

Google Tag Manager Settings
---------------------------

In the **Google Tag Manager Settings** section, clear the **Use Default** check box and select a :ref:`Google Tag Manager Integration <gtm-integration>` from the list to configure it for the application and enable data mapping.

Google Tag Manager settings can be configured globally, :ref:`per organization <organization-google-settings>`, and :ref:`per website <website-google-settings>`.

OAuth 2.0 for email sync
------------------------

In the **OAuth 2.0 for email sync** section, check **Enable** to activate sync. Please, make sure that Gmail API is enabled in |Google Developers Console|.

Google Hangouts
---------------

In the :ref:`Google Hangouts <user-guide-hangouts>` section, provide the following details:

* **Enable For Emails** --- Check the box to enable Google Hangouts for emails.

* **Enable For Phones** --- Check the box to enable Google Hangouts for phones.

By default, **Enable For Emails** and **Enable For Phones** are enabled.



.. include:: /include/include-links-user.rst
   :start-after: begin