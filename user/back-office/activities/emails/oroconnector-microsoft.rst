.. _oroconnector-for-microsoft:

OroConnector Add-in for Microsoft 365
=====================================

.. note::  OroConnector Add-in for Microsoft 365 is available for Enterprise Edition only.

The OroConnector add-in is a valuable tool for users of the Enterprise Oro applications. It allows users to interact with Oro applications from within Outlook through an Outlook add-in. The OroConnector eliminates the need for time-consuming switching between applications, streamlining workflow processes, and improving productivity. Its seamless integration with your email client makes it a game-changer for Oro users, providing a more convenient and streamlined workflow.

Requirements
------------

Ensure you have the following installed on your system before proceeding:

* |Node.js| (v14+ recommended)
* |pnpm| (package manager for Node.js) – Install via:

.. code-block:: bash

   npm install -g pnpm


Set Up the Project
------------------

Set Up the Project Manually
^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. Clone the MS365 Mailbox add-in repository code to your project folder (for Enterprise customers only).
2. Install node_modules:

.. code-block:: bash

   pnpm i

3. Add a new *.env* file and set up environment variables following the example in the *.env.example* file.
4. Run the following command to generate a manifest file:

.. code-block:: bash

   pnpm run generate-manifest

5. Run the following command to create a build folder:

.. code-block:: bash

   pnpm run build

6. Deploy **dist** folder on [your-addin-domain] (for example on Azure server).

Set Up Individual Local Environment
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. Generate certificates for local environment.

   * Install office-addin-dev-certs lib:

   .. code-block:: bash

      npm i -g office-addin-dev-certs

   * Generate certificates:

   .. code-block:: bash

      office-addin-dev-certs install

2. Open your |Get add-ins window|.
3. Navigate to **Add-Ins for Outlook > My add-ins > Custom Addins > + Add a custom add-in > Add from file**.

.. image:: /user/img/activities/connector-outlook/add-from-file.png
   :alt: View the Get add-ins popup window

4. Choose the generated manifest file.
5. Run the following command:

.. code-block:: bash

   pnpm run dev

6. Open your Outlook client. Open any email and find the OroConnector add-in.

Configure the OAuth Application
-------------------------------

To create a new OAuth application in Oro:

Navigate to **System > User Management > OAuth Applications** in your Oro application. Create a new OAuth application with the following settings:

* **Grant Type**: Authorization Code

* **Redirect URL**: Enter the required URL in the ``https://[your-addin-domain].com/grant-access-token-success`` format. For local setup it should be: ``https://localhost:3000/grant-access-token-success``.

.. image:: /user/img/activities/connector-outlook/oauth-app-ms.png
   :alt: Creating a new OAuth app in the Oro application

Once saved, the system will generate **Client ID** and **Client Secret** for the OAuth application. Update your *.env* file with the generated credentials, where:

.. code-block::

   VITE_APP_CLIENT_ID = Client ID
   VITE_APP_CLIENT_SECRET = Client Secret

.. image:: /user/img/activities/connector-outlook/client-id-secret.png
   :alt: Pasting the newly generated client id and client secret into the env. file

.. note:: For more details on OAuth application configuration, refer to the :ref:`related documentation <oauth-applications>`.

Deploy Production and Publish on the Internal Marketplace
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. Log in to |Azure Service|.
2. Navigate to **Applications > App registrations** and click **+ New registration** to create a new registration.

.. image:: /user/img/activities/connector-outlook/new-registration.png
   :alt: Highlighting the New registration button on the App registrations page

3. Fill in the app name, choose a supported account type, and select the **Single-page application (SPA)** option from the dropdown menu under **Redirect URI**. Click **Register**.

.. image:: /user/img/activities/connector-outlook/registration-details.png
   :alt: Highlighting the fields a user needs to fill when creating a new registration

4. The system will generate **Application (client) ID** and **Directory (tenant) ID** for your application. Update your *.env* file with the generated credentials, where:

.. code-block::

   VITE_APP_AZURE_CLIENT_ID: Application (client) ID
   VITE_APP_AZURE_TENANT_ID: Directory (tenant) ID

.. image:: /user/img/activities/connector-outlook/app-id-directory-id.png
   :alt: Pasting the newly generated application id and directory id into the env. file

5. Navigate to the **API permissions** subsection and click **+ Add a permission**.

.. image:: /user/img/activities/connector-outlook/add-permissions.png
   :alt: Highlighting the Add a permission button under API permissions menu

6. Click **Microsoft Graph > Delegated permissions** and select the following permissions:

   * Mail > Mail.Read
   * Mail > Mail.ReadBasic
   * OpenId permissions > Openid
   * OpenId permissions > Profile
   * OpenId permissions > Email
   * User > User.Read


7. Click **Add permissions** to save the request.

.. image:: /user/img/activities/connector-outlook/api-permissions.png
   :alt: Filling the required information to request API permissions for Microsoft Graph

8. Navigate to **Applications > Enterprise applications** in the main menu, then **Manage > All applications** in the submenu. Search by your application name (from Step 3) via the search field and click it.

.. image:: /user/img/activities/connector-outlook/search-app-by-name.png
   :alt: Illustrating the path to your newly added app in the Microsoft admin center

9. Go to **Users and groups** submenu and click the **+ Add users/group** button.

.. image:: /user/img/activities/connector-outlook/add-user-group.png
   :alt: Steps a user needs to take to add a user or a group

10. On the **Add Assignment** page, click **None Selected** under **Users** to add all required users.

11. Choose the users or groups to be added to your application and click **Select**.

.. image:: /user/img/activities/connector-outlook/select-users.png
   :alt: Steps a user needs to take to add a user or a group

12. Click **Assign** to save the list.


Set Up Add-in to Your Organization
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. Create an OAuth Application.
2. Follow the `Set Up the Project Manually`_ flow.
3. Navigate to |MS Admin Panel|.
4. Go to **Settings > Integrated Apps** in the menu to the left.
5. Click **Upload custom apps**.

.. image:: /user/img/activities/connector-outlook/upload-custom-apps.png
   :alt: Path to the Upload custom apps button

6. For **App type** select **Office Add-in** and provide the URL to your manifest file. Click **Next**.

.. image:: /user/img/activities/connector-outlook/upload-custom-apps-step-1.png
   :alt: Providing the app type details and a link to the manifest file

7. On the **Users** step, select users with whom you want to share the OroConnector Add-in. Click **Next**.

8. Complete the details on the **Deployment** step and click **Finish Deployment**.

9. The OroConnector Add-in should now be available at the bottom of the Integrated Apps page.

.. image:: /user/img/activities/connector-outlook/installed-ms-add-in.png
   :alt: Illustrating the OroConnector Add-in at the bottom of the Integrated Apps page


Connect
-------

Once OroConnector has been installed in your mail client, a new icon will appear in the side panel, indicating that the add-in is ready for use.

To connect the add-in to your Oro application:

1. Open the OroConnector add-in by clicking on the Oro icon.
2. Click **Connect**.
3. Provide valid Oro credentials to log in to your Oro application.

   .. image:: /user/img/activities/connector-outlook/login-cred.png
      :align: center

4. Click **Grant** to allow the connector to access information from the Oro application.

   .. image:: /user/img/activities/connector-outlook/grant.png
      :align: center

Manage OroConnector Menu
------------------------

The connector's menu offers the following actions:

.. csv-table::

   "**About**","Read more information about the connector."
   "**Disconnect**","End the connection with the connector."
   "**Refresh**","Update the connector."
   "**Manage Add-in**","Access the connector's settings. This option is only available to the organization's administrator who installed the connector."

.. image:: /user/img/activities/connector-outlook/addon-menu.png
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

.. image:: /user/img/activities/connector-outlook/search-result.png
   :align: center
   :scale: 70%

.. hint:: OroConnector will also give you prompts if there is an association with an entity, for example *Could Be Related To* or *In Context Of*.

          .. image:: /user/img/activities/connector-outlook/in-context-of-association.png
             :align: center
             :scale: 70%

Manage Context
--------------

Click on the desired entity from the search results to view its details. Here, you can perform the following actions:

* **Open.**

  To view an entity you found in the OroConnector in the Oro application, click Open. You will be redirected to the view page of this entity on the Oro side.

   .. image:: /user/img/activities/connector-outlook/add-open-buttons.png
      :align: center
      :scale: 70%

* **Add Context.**

  You can connect any relevant entities to an email thread as context. When the connector and Oro application are synchronized, you can easily view the added context on both the email and Oro application side. You can add multiple entities as necessary to provide additional context to the email.

  To add an entity as context, click **Add Context** on its details page.

* **Remove Context.**

  Removing context in the OroConnector removes it on the Oro application side as well. To disconnect entities from the email thread as its context, click **Remove Context** on the details page of the entity.


  .. image:: /user/img/activities/connector-outlook/remove.png
     :align: center
     :scale: 70%



.. include:: /include/include-links-user.rst
   :start-after: begin


.. include:: /include/include-links-dev.rst
   :start-after: begin