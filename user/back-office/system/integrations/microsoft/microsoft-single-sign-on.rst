:oro_documentation_types: OroCRM, OroCommerce

.. _user-guide-integrations-microsoft-single-sign-on:

Configure Microsoft 365 Single Sign-On in the Back-Office
=========================================================

Oro application supports Microsoft 365 Single Sign-On. This means that for a user that has the same primary email
in the Oro application and Microsoft accounts, it is possible to use only their Microsoft set of credentials to
securely authenticate into ORO application without using usual back-office login form.

Microsoft Side
--------------

Please follow the steps outlined in the :ref:`Configure Microsoft 365 OAuth Integration <user-guide-integrations-azure-oauth>` section on how to register an Application in Azure.

.. note:: In addition to the above, the **Redirect URI** from the ORO Microsoft 365 Single Sign-On settings must be added in Azure Application Redirect URIs configuration.

Oro Application Side
--------------------

Configure Microsoft 365 Single Sign-On
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To configure the Single Sign-On with Microsoft 365 in your OroCRM or OroCommerce application:

1. Navigate to **System > Configuration** in the main menu.
2. In the left panel, click **Integrations > Microsoft Settings**.
3. Ensure the following fields for **Microsoft Integration Settings** are defined:

.. csv-table::
   :header: "Field", "Description"
   :widths: 10, 30
     
   "**Application (Client) ID** ","The Client ID generated in the Azure portal."
   "**Client Secret**","The Client Secret generated in the Azure portal."
   "**Directory (Tenant) ID** ","The Tenant generated in the Azure portal."

4. Define the following fields for **Microsoft 365 Single Sign-on:**

+------------------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| **Field**        | Description                                                                                                                                                                                |
+==================+============================================================================================================================================================================================+
| **Enable**       | Check **Enable.**                                                                                                                                                                          |
+------------------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| **Domains**      | Domains is a comma separated list of allowed domains. It limits the list of application domains for which single sign-on can be used. Leave the field empty to set no for such limitation. |
+------------------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| **Redirect URI** | **READ-ONLY** field, the value is auto-generated and should be added in Azure Application Redirect URIs configuration                                                                      |
+------------------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+

.. image:: /user/img/microsoft/oro_microsoft_365_settings.jpg
   :alt: Microsoft 365 Single Sign-On settings


Log in with Microsoft 365
^^^^^^^^^^^^^^^^^^^^^^^^^

When a user gets to the login page of an instance for which single sign-on capability has been enabled, the **Log in with Microsoft 365** button is displayed.

.. image:: /user/img/microsoft/log_in_with_microsoft_365.jpg
   :alt: The login page with the button to log in with Microsoft 365

If the user is not logged into Microsoft accounts after the button has been clicked, a usual Microsoft log-in page will appear.

.. image:: /user/img/microsoft/usual_microsoft_365_login_page.jpg
   :alt: The usual Microsoft 365 log-in page

As soon as the user has logged into their Microsoft account, a request to use the account in order to log-in to Oro application is displayed (details defined for the consent screen is used).

.. image:: /user/img/microsoft/microsoft_connection.jpg
   :alt: Microsoft account page

For now on, for a user logged-in into a Microsoft account, it is enough to
click the **Log in with Microsoft 365** button to get into Oro application.

.. note:: Note that the email used for the Microsoft account and the primary email of the user in Oro application must be the same.


.. include:: /include/include-links-user.rst
   :start-after: begin
