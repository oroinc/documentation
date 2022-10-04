:oro_documentation_types: OroCRM, OroCommerce

.. _user-guide-dotmailer-configuration:
.. _user-guide-dotmailer-configuration--dotmailer-side:


Configure Dotdigital Integration in the Back-Office
===================================================


Create API Managed User on the Dotdigital Side
----------------------------------------------

To configure integration with OroCRM and OroCommerce on the Dotdigital side, create **an API managed user**:

1. Log in to Dotdigital.
2. Navigate to **Settings > Access**.

   .. image:: /user/img/marketing/marketing/dotdigital/access.png
      :alt: Open the Access menu to create a new user

3. Click the **New User** button.

   Your unique email address is generated in the **Email Address** field. You need this email address to configure Oro integration with Dotdigital.

4. Create and confirm your **Password**. The **Description** field is optional. Mark your user **Enabled** and click **Save** to proceed.
   
   .. image:: /user/img/marketing/marketing/dotdigital/dotdigital_api_users_new_user_details.png
      :alt: Creating a new user

.. _user-guide-dotmailer-configuration--oro-side:

Create Integration on the Oro Application Side
----------------------------------------------

1. Navigate to **System > Integrations > Manage Integrations** in the main menu.
2. Click **Create Integration** in the upper-right corner of the page.

   .. image:: /user/img/marketing/marketing/dotdigital/oro_create_dotdigital_integration_new.png
      :alt: Creating the integration on the Oro application side

3. Complete the following fields:

   .. csv-table::
     :header: "Field", "Description"
     :widths: 10, 30
   
     "**Type**","Select Dotdigital from the list of integrations available in the dropdown."
     "**Name**","Enter the integration name to refer to within the system."
     "**Username**","Enter an API user name from your Dotdigital **Manage users** page."
     "**Password**","Enter the password you set for your API user on the Dotdigital side. Click **Check connection**. **Connection Successful** message indicates that connection to Dotdigital has been established."
     "**Client ID**","The Dotdigital uses OAuth 2.0 to provide single |sign-on|. Client ID is the ID of the OAuth 2.0 making the request. Single sign-on provides the means for a Dotdigital user to log into their account just once, removing the need to constantly re-enter credentials. To register to use OAuth you will need to be on a Dotdigital Enterprise license and to contact your Dotdigital account manager. More information on sign-on is available in the :ref:`Configure Single Sign-on <user-guide-dotmailer-single-sign-on>` section of the guide."
     "**Client Secret key**","The pre-shared client secret, used to authenticate your application when making token request."
     "**Custom OAuth Domain**","Enter custom domain if it is used in Dotdigital. By default |https://r1-app.dotdigital.com/| is used."
     "**Default Owner**","Select the owner of the integration. The selected user will be defined as the owner for all the records imported within the integration."

4. Once all the details of the integration have been specified, click **Save and Close**.

   As soon as the integration is successfully configured, it will appear in the integration grid.

   In addition, **dotdigital menu group** will become available under **Marketing** in the main menu.

   The Dotdigital menu group contains the following sections:

   - **Email Studio** (see :ref:`Configure Single Sign-on guide <user-guide-dotmailer-single-sign-on>`)
   - **Data Fields** (see :ref:`Manage Dotdigital Data Fields and Mappings guide <user-guide-dotmailer-data-fields>`)
   - **Data Field Mappings** (see :ref:`Manage Dotdigital Data Fields and Mappings guide <user-guide-dotmailer-data-fields>`)

   .. image:: /user/img/marketing/marketing/dotdigital/dotdigital-menu.png
      :alt: The dotdigital menu under the Marketing main menu

Sync Dotdigital Integration
^^^^^^^^^^^^^^^^^^^^^^^^^^^

To sync Dotdigital integration:

1.  Navigate to **System > Integrations > Manage Integrations**.
2.  Select the newly created integration.
3.  Click **Schedule Sync** in the upper-right corner of the page.


.. admonition:: Business Tip

   Are you considering |B2B eCommerce| for your business? Make a business case using our in-depth guide, which is filled with useful statistics and examples.

   
**Related Articles**

- :ref:`Dotdigital Overview <user-guide-dotmailer-overview>`
- :ref:`Dotdigital Single Sign-on <user-guide-dotmailer-single-sign-on>`
- :ref:`Manage Dotdigital Data Fields and Mappings <user-guide-dotmailer-data-fields>`
- :ref:`Sending Email Campaign via Dotdigital <user-guide-dotmailer-campaign>`
- :ref:`Dotdigital Integration Settings <admin-configuration-dotmailer-integration-settings>`


.. include:: /include/include-links-user.rst
   :start-after: begin

.. include:: /include/include-links-seo.rst
   :start-after: begin