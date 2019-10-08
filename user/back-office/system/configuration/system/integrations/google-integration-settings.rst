:oro_documentation_types: OroCRM, OroCommerce

.. _admin-configuration-integrations-google:

Google Settings
===============

.. hint:: Read more on this topic in :ref:`Google Integration <admin-configuration-google>`.

To configure Google integration-related settings in the back-office:

1. Navigate to **System > Configuration** in the main menu.
2. In the panel to the left, click **System Configuration > Integrations > Google Settings**.

.. image:: /user/img/system/config_system/google_settings_new.png

.. note:: These settings can be configured globally and :ref:`per organization <user-guide-hangouts-org>`.

Google Integration Settings
---------------------------

Before you begin, check out the |instructions on obtaining credentials the Google side|. Make sure that your Oro domain is included into `Authorized JavaScript origins` and `Authorized redirect URIs`.

In the Google Integration Settings section, provide the following details:

.. csv-table::
   :header: "Field", "Description"
   :widths: 10, 30
     
   "**Client ID** ","The Client ID generated in the API console."
   "**Client Secret**","The Client Secret generated in the API console."
   "**Google API Key** ","The API Key generated in the API console. Provide a valid |Google API key| to activate maps for addresses in the system."

Google Sign-on
--------------

In the Google Sign-on section, provide the following details:

+------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| **Field**                    | Description                                                                                                                                                                                                               |
+==============================+===========================================================================================================================================================================================================================+
| **Enable**                   | Check **Enable** to activate Google Single Sign-on.                                                                                                                                                                       |
+------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| **Domains**                  | Domains is a comma separated list of allowed domains. It limits the list of mailboxes for which single sign-on can be used (e.g., only a domain used specifically by your company). Leave the field empty to set no such  |
|                              | limitation.                                                                                                                                                                                                               |
+------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| **OAuth 2.0 for email sync** | Check **Enable** to activate sync. Please, make sure that Gmail API is enabled in |Google Developers Console|.                                                                                                            |
+------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+

.. image:: /user/img/system/config_system/oro_google_integration_new.jpg

Google Hangouts
---------------

In the :ref:`Google Hangouts <user-guide-hangouts>` section, provide the following details:

+-----------------------+-----------------------------------------------------+
| **Option**            | **Description**                                     |
+=======================+=====================================================+
| **Enable For Emails** | Check the box to enable Google Hangouts for emails. |
+-----------------------+-----------------------------------------------------+
| **Enable For Phones** | Check the box to enable Google Hangouts for phones. |
+-----------------------+-----------------------------------------------------+

By default, **Enable For Emails** and **Enable For Phones** are enabled.


.. include:: /include/include-links.rst
   :start-after: begin