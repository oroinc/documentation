:oro_documentation_types: OroCRM, OroCommerce

.. _user-guide-dotmailer-configuration:

Configure dotmailer Integration in the Back-Office
==================================================

Install Extension
-----------------

To configure dotmailer integration, ensure that you have the dotmailer extension installed in your application. For installation instructions, click |here3|.

.. _user-guide-dotmailer-configuration--dotmailer-side:

Create API Managed User on the dotmailer Side
---------------------------------------------

To configure integration with OroCRM and OroCommerce on the dotmailer side, create **an API managed user**:

1. Log in to dotmailer.
2. Navigate to **Settings > Access**.

   .. image:: /user/img/marketing/marketing/dotmailer/access.png
      :alt: Open the Access menu to create a new user

3. Click the **New User** button.

   Your unique email address is generated in the **Email Address** field. You need this email address to configure Oro integration with dotmailer.

4. Create and confirm your **Password**. The **Description** field is optional. Mark your user **Enabled** and click **Save** to proceed.
   
   .. image:: /user/img/marketing/marketing/dotmailer/dotmailer_api_users_new_user_details.png
      :alt: Creating a new user

.. _user-guide-dotmailer-configuration--oro-side:

Create Integration on the Oro Application Side
----------------------------------------------

1. Navigate to **System > Integrations > Manage Integrations** in the main menu.
2. Click **Create Integration** in the upper-right corner of the page.

   .. image:: /user/img/marketing/marketing/dotmailer/oro_create_dotmailer_integration_new.jpg
      :alt: Creating the integration on the Oro application side

3. Complete the following fields:

   .. csv-table::
     :header: "Field", "Description"
     :widths: 10, 30
   
     "**Type**","Select dotmailer from the list of integrations available in the dropdown."
     "**Name**","Enter the integration name to refer to within the system."
     "**Username**","Enter an API user name from your dotmailer **Manage users** page."
     "**Password**","Enter the password you set for your API user on the dotmailer side. Click **Check connection**. **Connection Successful** message indicates that connection to dotmailer has been established."
     "**Client ID**","The dotmailer uses OAuth 2.0 to provide single |sign-on|. Client ID is the ID of the OAuth 2.0 making the request. Single sign-on provides the means for a dotmailer user to log into their account just once, removing the need to constantly re-enter credentials. To register to use OAuth you will need to be on an dotmailer Enterprise license and to contact your dotmailer account manager. More information on sign-on is available in the :ref:`Configure Single Sign-on <user-guide-dotmailer-single-sign-on>` section of the guide."
     "**Client Secret key**","The pre-shared client secret, used to authenticate your application when making token request."
     "**Custom OAuth Domain**","Enter custom domain if it is used in dotmailer. By default |https://r1-app.dotmailer.com/| is used."
     "**Default Owner**","Select the owner of the integration. The selected user will be defined as the owner for all the records imported within the integration."

4. Once all the details of the integration have been specified, click **Save and Close**.

   As soon as the integration is successfully configured, it will appear in the integration grid.

   In addition, **dotmailer menu group** will become available under **Marketing** in the main menu.

   The dotmailer menu group contains the following sections:

   - **Email Studio** (see :ref:`Configure Single Sign-on guide <user-guide-dotmailer-single-sign-on>`)
   - **Data Fields** (see :ref:`Manage dotmailer Data Fields and Mappings guide <user-guide-dotmailer-data-fields>`)
   - **Data Field Mappings** (see :ref:`Manage dotmailer Data Fields and Mappings guide <user-guide-dotmailer-data-fields>`)

   .. image:: /user/img/marketing/marketing/dotmailer/o_dotmailer_main_menu.jpg
      :alt: The dotmailer menu under the Marketing main menu

Sync dotmailer Integration
^^^^^^^^^^^^^^^^^^^^^^^^^^

To sync dotmailer integration:

1.  Navigate to **System > Integrations > Manage Integrations**.
2.  Select the newly created integration.
3.  Click **Schedule Sync** in the upper-right corner of the page.
   
**Related Articles**

- :ref:`dotmailer Overview <user-guide-dotmailer-overview>`
- :ref:`dotmailer Single Sign-on <user-guide-dotmailer-single-sign-on>`
- :ref:`Manage dotmailer Data Fields and Mappings <user-guide-dotmailer-data-fields>`
- :ref:`Sending Email Campaign via dotmailer <user-guide-dotmailer-campaign>`
- :ref:`dotmailer Integration Settings <admin-configuration-dotmailer-integration-settings>`


.. include:: /include/include-links-user.rst
   :start-after: begin