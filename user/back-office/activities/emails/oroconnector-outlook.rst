.. _oroconnector-for-microsoft-outlook:

OroConnector Add-in for Outlook
===============================


The OroConnector add-in is a valuable tool for users of the Enterprise Oro applications. With its integration with email clients, this add-in provides effortless access to critical information, enhancing collaboration and increased efficiency. The OroConnector eliminates the need for time-consuming switching between applications, streamlining workflow processes, and improving productivity. Its seamless integration with your email client makes it a game-changer for Oro users, providing a more convenient and streamlined workflow.

Prerequisites
-------------

To work with OroConnector, you need to have a Outlook account, be an Oro application user and have the connector installed by your organization's administrator.

Connect
-------

Once OroConnector has been installed in your mail client, a new icon will appear in the side panel, indicating that the add-in is ready for use.

To connect the add-in to your Oro application:

1. Open the OroConnector add-in by clicking on the Oro icon.
2. Click **Connect**.
3. Provide valid Oro credentials to log in to your Oro application.

   .. image:: /user/img/system/config_system/connector-outlook/login-cred.png
      :align: center

4. Click **Grant** to allow the connector to access information from the Oro application.

   .. image:: /user/img/system/config_system/connector-outlook/grant.png
      :align: center

Manage OroConnector Menu
------------------------

The connector's menu offers the following actions:

.. csv-table::

   "**About**","Read more information about the connector."
   "**Disconnect**","End the connection with the connector."
   "**Refresh**","Update the connector."
   "**Manage Add-on**","Access the connector's settings. This option is only available to the organization's administrator who installed the connector."

.. image:: /user/img/system/config_system/connector-outlook/addon-menu.png
   :align: center
   :scale: 70%

Search & Context
----------------

Once you have completed the setup process, OroConnector is available for you to start your search for the necessary information and add or remove context from the add-in.

In Oro applications, context is a piece of information relevant to a particular user, task, or process within the application. When an OroConnector user opens an email thread in their mail client, they can see Oro entities related to that particular email and retrieve the latest context of the conversation. Context search is performed by the *From/To/CC/BCC* fields of the email being viewed.

By default, the following data is passed from your Oro application to the connector and vice versa:

* Accounts
* Contacts
* Customer users
* Leads
* Opportunities
* Orders
* Users
* Customers
* Tasks
* Cases
* Requests for quotes.

To begin your search, type a query into the search bar and click Enter. If the search returns many entities, click **Load More** to view all available search results.

.. image:: /user/img/system/config_system/connector-outlook/search-result.png
   :align: center
   :scale: 70%

.. hint:: OroConnector will also give you prompts if there is an association with an entity, for example *Could Be Related To* or *In Context Of*.

          .. image:: /user/img/system/config_system/connector-outlook/in-context-of-association.png
             :align: center
             :scale: 70%

Manage Context
--------------

Click on the desired entity from the search results to view its details. Here, you can perform the following actions:

* **Open.**

  To view an entity you found in the OroConnector in the Oro application, click Open. You will be redirected to the view page of this entity on the Oro side.

   .. image:: /user/img/system/config_system/connector-outlook/add-open-buttons.png
      :align: center
      :scale: 70%

* **Add Context.**

  You can connect any relevant entities to an email thread as context. When the connector and Oro application are synchronized, you can easily view the added context on both the email and Oro application side. You can add multiple entities as necessary to provide additional context to the email.

  To add an entity as context, click **Add Context** on its details page.

* **Remove Context.**

  Removing context in the OroConnector removes it on the Oro application side as well. To disconnect entities from the email thread as its context, click **Remove Context** on the details page of the entity.


  .. image:: /user/img/system/config_system/connector-outlook/remove.png
     :align: center
     :scale: 70%


