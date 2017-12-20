
.. _user-guide-magento-channel-integration:

Integration with Magento
========================

OroCRM supports out of the box integration with Magento.

The integration enables loading  data from and to a Magento-based eCommerce store ("Magento store") and processing it in
the OroCRM.
This article describes how to define and edit the integration and synchronization settings.

.. hint::

    While Magento integration capabilities are pre-implemented, OroCRM can be integrated with different third-party
    systems.

.. note:: See a short demo on `how to setup an integration between a Magento and your Oro application <https://www.orocrm.com/media-library/setup-magento-crm-integration>`_, or keep reading the guidance below.

   .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/MfQdP2BClk0" frameborder="0" allowfullscreen></iframe>

On the Magento Side
-------------------

The integration is made possible with the OroCRM Bridge Magento Extension. The OroCRM Bridge can be installed through MagentoConnect.

Once the extension has been successfully installed, you need to login to your Magento account and to set up a SOAP API
user within Magento, as described below:


.. note::

    The integration can also be created without installation of the OroCRM Bridge Magento Extension, however the
    synchronization will then take longer, and some options, such as two-way synchronization, and synchronization of
    the custom records data will not be available.


Define a New Role
^^^^^^^^^^^^^^^^^

1. Once logged in, go to the **System > Web Services > SOAP/XML - RPC - Roles**

   .. image:: ../img/magento_integration/magento_01.png
  
2. On the table of all roles, click **Add New Role**

   .. image:: ../img/magento_integration/magento_02.png
 
3. Define the Role Name that corresponds to your eCommerce store.

   .. image:: ../img/magento_integration/magento_03.png

4. Click **Save Role**. The role will be saved and you will get to the page of the role.

5. Click  the **Role Resources** on the left.
  
   .. image:: ../img/magento_integration/magento_04.png

6. In the Roles Resources section, set the **Resource Access** field value to **All** and save the role.

   .. image:: ../img/magento_integration/magento_05.png


Define a New User
^^^^^^^^^^^^^^^^^

1. Go to the **System > Web Services > SOAP/XML - RPC - Users**

2. You will get to the Users page. Click **Add New User**.

3. Define the following fields:

   .. csv-table::
     :header: "Field", "Description"
     :widths: 10, 30
    
     "**User Name**","The name used for login into the account."
     "**First Name**","The first part of the name displayed in the system to refer to the user."
     "**Last Name**","The last part of the name displayed in the system to refer to the user."
     "**Email**","The email address of the user."
     "**API Key**","Define a password for the account. The key shall be at least 6 symbols long."
     "**API Key Confirmation**","Confirm the password."
     "**The account is**","Set the value to **Active** in order to use the user account created."

4. Save the user.

   .. image:: ../img/magento_integration/magento_06.png

5. The user account will be saved and you will get to page of the user.
6. Click  the **User Role** on the left

   .. image:: ../img/magento_integration/magento_07.png

7. Select the role that you have created for your store.
  
   .. image:: ../img/magento_integration/magento_08.png

8. Click **Save User** on the top right.


.. _user-guide-magento-channel-integration-details:

Enable WSDL Cache
^^^^^^^^^^^^^^^^^

In order to accelerate the performance of the initial sync, please make sure WSDL cache is enabled in the Magento configuration. 

To enable the cache:

1. Go to the **System > Configuration**
2. Go to the **Services** section in the tab on the left.
3. Click on the **Magento Core API** link

   |Services|

4. Choose **Yes** in the **Enable WSDL Cache** field of the General Settings.

   |EnableWSDL|

   .. hint::

     The CSV support is not supported for the initial import of Magento data to OroCRM, but if you have concerns regarding
     the impact the import might have on the production environment, you can set up a staging instance with the latest 
     production data, run initial synchronization on the environment and update the integration URL to production once it 
     has been done.

On the Oro Side
---------------

Create Magento Integration
^^^^^^^^^^^^^^^^^^^^^^^^^^

1. To create integration with Magento, create a channel of Magento type as described in the :ref:`Channels Management <user-guide-channel-guide-create>` guide.
2. As soon as the channel type is set to **Magento**, a mandatory **Integration** field  will appear in the **General** section.
  	  
   .. image:: ../img/magento_integration/configure_integration.png

3. Click the **Configure integration** link. The form will emerge.

   .. image:: ../img/magento_integration/MagentoIntegrationCreate.png

General Settings
""""""""""""""""

Define the following details in the **General** section:

.. csv-table::
  :header: "Field", "Description"
  :widths: 10, 30

  "**Name**","The configuration name used to refer to the configuration within the system."
  "**SOAP WSDL URL**","A URL of the SOAP v.2 WSDL source (this is the URL of your Magento installation plus
  **api/v2_soap/?wsdl=1**). For example, if your installation were available at http://example.com/magento/index.php, the SOAP WSDL URL would be http://example.com/magento/index.php/api/v2_soap/?wsdl=1."
  "**SOAP API Key**","The API Key defined for the Magento user above."
  "**SOAP API User**","The username defined for the Magento user above."
  "**WS-I Compliance**","Defines whether `WS-I compliance mode <http://www.magentocommerce.com/api/soap/wsi_compliance.html>`_ is enabled for the Magento store."
  "**Guest Customer Sync**","Checking this option will cause guest orders to be combined under a single customer based on email. If a registered customer exists with this email, all guest orders with this email will be attributed to that :ref:`account <user-guide-accounts>`."
  "**Sync start date**","Data will be synchronized as of the date defined."

At this point, click **Check Connection**, to see if the settings defined above are correct.

Once the connection details have been verified, the following fields will be filled with default settings.

.. csv-table::
  :header: "Field", "Description"
  :widths: 20, 30

  "**Website**","The list of all the Websites available for the shop. **All Websites** option is chosen by default.

  You can edit the field value and choose one of the Websites available. Only entries of the selected Website are
  synchronized.

  Click **Sync website list** if the list of Websites is outdated."
  "**Admin URL**","Optional field. A URL to the administrator panel of the specified Magento store."
  "**Import Order Comments as Order Notes**","When the option is disabled, order notes are displayed on the Magento Order page only. When the option is enabled, order notes are also displayed on the Magento Customer and Account pages. The option is set to **Yes** by default."
  "**Split by Full Name**","Separate customer accounts are created for Magento customers with the specified email(s) during import. To enter multiple emails, use semicolons or commas."
  "**Default owner**","Specifies what users can manage the configuration, subject to the :ref:`access and permission settings <user-guide-user-management-permissions>`. By default is filled with the user creating the integration."

.. note:: Be aware that comments added to an order on the Magento side are synced only when OroBridge extension v. 1.2.19 is installed on the Magento side. Otherwise, the *Import Order Comments as Order Notes* field is disabled in Oro, and no comments are imported.

.. _user-guide-magento-channel-integration-synchronization:

Synchronization Settings
""""""""""""""""""""""""

Use the **Synchronization Settings** section to enable/disable two-way synchronization.

.. image:: ../img/magento_integration/synch_settings.png

Check the **Enable Two Way Sync** box, if you want to download data both from Magento to OroCRM and back. If the box is unchecked, data from Magento will be loaded to OroCRM, but changes performed in OroCRM will not be loaded to Magento.

If two-way synchronization is enabled, define the priority used for conflict resolution (e.g. if the same customer details were edited from both OroCRM and Magento):

- **Remote wins**: Magento data will be applied to the both Magento and OroCRM.
- **Local wins**: OroCRM data will be applied to the both Magento and OroCRM.


.. _user-guide-magento-channel-integration-details_edit:

Edit the Integration
^^^^^^^^^^^^^^^^^^^^

To edit the integration details:

1. Go to the :ref:`Edit form <user-guide-ui-components-create-pages>` of the channel and click **Edit** link by the integration name.

   The integration form will appear. Priory defined settings will be shown in the form. Once synchronization has been
   performed, it is impossible to change the Sync start date.

   .. image:: ../img/magento_integration/MagentoIntegrationFillIn.png

2. Click **Done** button to save the changes

   .. hint::

      To remove an integration from the system, go to the :ref:`Edit form <user-guide-ui-components-create-pages>`
      of the channel and click |IcCross| located next to the integration name

.. _user-guide-magento-channel-start-synchronization:

Start Synchronization Manually
------------------------------

Once integration has been created, the data will be automatically synchronized. However, you can also start the
synchronization manually from OroCRM:

1. Go to **System > Integrations > Manage Integrations**.
2. Click the required integration on the list of integrations to open its page.
3. Click **Schedule Sync**. 

   .. image:: ../img/magento_integration/MagentoIntegrationEdit.png

4. The following note emerges:

   *A sync* :ref:`job <book-job-execution>` *has been added to the queue. Check progress*.
  
   .. image:: ../img/magento_integration/MagentoIntegrationNote.png

   This indicates data is being synchronized. You can click **Check progress** link to see the synchronization status.

After successful synchronization, details of the Magento entity records defined for the channel will be loaded to OroCRM and can be processed therein, for example cart can be converted, customer details can be edited and new customers can be added to the system.

.. important:: When you *create* a channel of Magento type, perform initial sync of the created Magento integration and later delete the channel, Magento Сustomers will be deleted but Accounts and Contacts will remain in the system. If you *re-create* the channel of Magento type, perform initial sync of the created Magento integration once more, Accounts and Contacts will be populated into the system again, doubling their quantity by duplicates. Please, be aware that this behavior is standard.

.. |IcCross| image:: ../../img/buttons/IcCross.png
   :align: middle

.. |BSchedule| image:: ../../img/buttons/BSchedule.png
   :align: middle

.. |Services| image:: ../img/magento_integration/services.png
   :align: middle
   
.. |EnableWSDL| image:: ../img/magento_integration/enable_wsdl.png
   :align: middle
