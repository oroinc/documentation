.. _admin-configuration-integrations-google:

Google Integration Settings
===========================

.. contents:: :local:
    :depth: 2


The only integration by default available in the community editions is integration with Google. You can define the details used for Google Single Sign-on,  which enables users with the same Google account email address and OroCRM primary email address to log-in only once in the session. More information on integration with Google is described in the :ref:`Google Single Sign-on guide <user-guide-google-single-sign-on>`.

.. image:: /user_guide/system/img/configuration/google_settings.png

Google Integration Settings
---------------------------

Please, read `instructions on the Google side <https://support.google.com/cloud/answer/6158862?hl=en>`_ for obtaining credentials. Make sure that your Oro domain is included into `Authorized JavaScript origins` and `Authorized redirect URIs`.

.. csv-table::
   :header: "Field", "Description"
   :widths: 10, 30
     
   "**Client ID** ","The Client ID generated in the API console."
   "**Client Secret**","The Client Secret generated in the API console."
   "**Google API Key** ","The API Key generated in the API console. Provide a valid `Google API key <https://developers.google.com/maps/documentation/javascript/get-api-key>`_ to activate maps for addresses in the system."

Google Sign-on
--------------

+------------------------------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| **Field**                    | Description                                                                                                                                                                                                                          |
+==============================+======================================================================================================================================================================================================================================+
| **Enable**                   | Check **Enable** to activate Google Single Sign-on.                                                                                                                                                                                  |
+------------------------------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| **Domains**                  | Domains is a comma separated list of allowed domains. It limits the list of mailboxes for which single sign-on can be used (e.g., only a domain used specifically by your company). Leave the field empty to set no such limitation. |
+------------------------------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| **OAuth 2.0 for email sync** | Check **Enable** to activate sync. Please, make sure that Gmail API is enabled in `Google Developers Console <https://console.developers.google.com/apis>`_.                                                                         |
+------------------------------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+

.. image:: /user_guide/system/img/google_integration/oro_google_integration_new.jpg

Google Hangouts
---------------

+-----------------------+-----------------------------------------------------+
| **Option**            | **Description**                                     |
+=======================+=====================================================+
| **Enable For Emails** | Check the box to enable Google Hangouts for emails. |
+-----------------------+-----------------------------------------------------+
| **Enable For Phones** | Check the box to enable Google Hangouts for phones. |
+-----------------------+-----------------------------------------------------+

By default, **Enable For Emails** and **Enable For Phones** are enabled.