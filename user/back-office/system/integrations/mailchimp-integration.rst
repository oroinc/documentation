:oro_documentation_types: OroCRM, OroCommerce

.. _user-guide-mc-integration:

Configure MailChimp Integration in the Back-Office
==================================================

.. begin_include

Install Extension
-----------------

To configure MailChimp integration, ensure that you have MailChimp
extension installed in your Oro instance. For installation instructions,
click |here4|.

.. _user-guide-mc-integration--mailchimp-side:

Configure Integration on the MailChimp Side
-------------------------------------------

To configure the integration with Oro application on the MailChimp side, you need to
create an API key. To do that:

1. Login to MailChimp.

2. Navigate to your name in the upper right corner.

3. Select **Account**.

   .. image:: /user/img/system/integrations/mailchimp/mc_account.png
      :alt: Navigate to the account menu

|

4. Go to **Extras > API keys**.

   .. image:: /user/img/system/integrations/mailchimp/mc_extras_api.png
      :alt: The API keys menu

5. Scroll down to the bottom of the page and press **Create a Key**.

   .. image:: /user/img/system/integrations/mailchimp/mc_create_key.png
      :alt: Display the Create a Key button

6. A newly created key will appear at the top of the list. Copy the key.

   .. image:: /user/img/system/integrations/mailchimp/mc_copy_key.png
      :alt: Copy the newly created key

.. _user-guide-mc-integration--oro-side:

Configure Integration on the Oro Side
-------------------------------------

1. Log into your Oro application and navigate to **System > Integrations > Manage Integrations**.

2. Click **Create Integration** in the top right corner.

   .. image:: /user/img/system/integrations/mailchimp/mailchimp_create_integration.png

3. Next, complete the following fields:

   +------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
   | **Field**                    | **Description**                                                                                                                                                                                                                                                                                                                         |
   +==============================+=========================================================================================================================================================================================================================================================================================================================================+
   | **Type**                     | Among other third-party services, choose MailChimp as this is the integration we are configuring. A form specific to MailChimp will be displayed.                                                                                                                                                                                       |
   +------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
   | **Name**                     | Specify the integration **Name** as it will be referred to within Oro application.                                                                                                                                                                                                                                                      |
   +------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
   | **API Key**                  | Paste the API key you copied in your MailChimp account. Click **Check Connection**. **Everything’s Chimpy** means that the connection was successful and    you are now authorized.                                                                                                                                                     |
   +------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
   | **Activity Update Interval** | Now set the **Activity Update Interval** to a period you plan to run your campaign for. This should be set based on the length of your campaign and data    storage requirements specific to your Oro instance.                                                                                                                         |
   +------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
   | **Status**                   | **Active** or **Inactive**. By default, Status is set to Active.                                                                                                                                                                                                                                                                        |
   +------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
   | **Owner**                    | The Owner determines the list of users who can manage the integration and the data synchronized with it. This means that the owner receives the data    produced by the email campaign. All **Entities** imported within the integration will be assigned to the selected user. It is suggested to select a marketing rep as the owner. |
   +------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
   | **Enable Two Way Sync**      | Use this section to enable or disable two-way synchronization. By default, **Enable Two Way Sync** is unchecked. If it remains unchecked, unsubscribes    will pass from MailChimp to Oro application. If enabled, subscription status can be passed from Oro application to MailCHimp and the other way around.                        |
   +------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
   | **Sync Priority:**           | **Remote Wins** means that the MailChimp will be considered the master and override conflicts with the Oro application. **Local Wins** means that local data will    be the master and override any conflicts with MailChimp.                                                                                                           |
   +------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+

   .. image:: /user/img/system/integrations/mailchimp/choose_mc_integration.png

4. Click **Save and Close.**

The integration has been successfully configured and will now appear in the integration grid.

Sync Integration
----------------

In order to sync your integration:

1. Navigate to **System > Integrations > Manage Integrations**.

2. Select your newly created integration.

3. Click **Schedule Sync** in the top right corner.

   .. image:: /user/img/system/integrations/mailchimp/o_manage_integrations_orocrm_schedule_sync.png

**Related Topic**

* :ref:`Sending Email Campaign via MailChimp <user-guide-mailchimp-campaign>`

.. include:: /include/include-links-user.rst
   :start-after: begin
