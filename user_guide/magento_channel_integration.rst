
.. _user-guide-magento-channel-integration:

Integration with Magento
========================

OroCRM supports out of the box integration with Magento.
The integration enables loading  data from and to a Magento-based E-commerce store (Magento store) and processing it in
the OroCRM.
This article describes how to define and edit the integration and synchronization settings.

.. hint::

    While Magento integration capabilities are pre-implemented, OroCRM can be integrated with different third-party
    systems.


.. _user-guide-magento-channel-integration-details:

Create Magento Integration
---------------------------

To create integration with Magento, create a channel of Magento type as described in the
:ref:`Channels Management <user-guide-channel-guide-create>` guide .

As soon as the channel type is set to *Magento*, a mandatory **Integration*** field  will appear in the "General"
section.

.. image:: ./img/magento_integration/configure_integration.png

Click *Configure integration* link. The form will emerge.

General Settings
^^^^^^^^^^^^^^^^

Define the following details in the *"General"* section:

.. image:: ./img/magento_integration/configure_integration_form.png


.. list-table::
   :widths: 10 30
   :header-rows: 1

   * - Field
     - Description

   * - **Name***
     - Configuration name. Used to refer to the configuration within the system

   * - **SOAP WSDL URL***
     - A URL of the SOAP v.2 WSDL source (this is the URL of your Magento installation plus
       **api/v2_soap/?wsdl=1**). For example, if your installation were available at
       *http://example.com/magento/index.php/*, the SOAP WSDL URL would be
       *http://example.com/magento/index.php/api/v2_soap/?wsdl=1*.

   * - **SOAP API Key***

       **SOAP API User***

     - SOAP API credentials.

   * - **WS-I Compliance**
     - Defines whether `WS-I compliance mode <http://www.magentocommerce.com/api/soap/wsi_compliance.html>`_ is enabled for the Magento store.

   * - **Sync start date**
     - Data will be synchronized as of the date defined.

.. hint::

    Please address your Magento administrator for the information on the SOAP settings details.

At this point, click :guilabel:`Check Connection` button, to see if the settings defined above are correct.
Once the connection details have been verified, the following fields will be filled with default settings.

.. list-table:: **System Channel Entities (continued)**
   :widths: 12 30
   :header-rows: 1

   * - Field
     - Description

   * - **Website***
     - The list of all the Websites available for the shop. *All Websites* option is chosen by default.

       You can edit the field value and choose one of the Websites available. Only entries of the selected Website are
       synchronized.

       Click "Sync website list" link if the list of Websites is outdated.

   * - **Admin url**
     - Optional field. A url to the administrator panel of the specified Magento store.

   * - **Default owner***
     - Specifies what users can manage the configuration. By default is filled with the user creating the integration.


.. _user-guide-magento-channel-integration-synchronization:

Synchronization Settings
^^^^^^^^^^^^^^^^^^^^^^^^

Use the *Synchronization Settings* section to enable/disable two way synchronization.

.. image:: ./img/magento_integration/synch_settings.png

Check *Enable Two Way Sync* box, if you want to download data both from Magento to OroCRM and
back. If the box is unchecked, data from Magento will be loaded to OroCRM, but changes performed in OroCRM will not be
loaded to Magento.

If the two-way synchronization is enabled, define the priority used for the conflict resolution (e.g. if the same
customer details were edited from the both OroCRM and Magento:

- *Remote wins*: Magento data will be applied to the both Magento and OroCRM

- *Local wins*: OroCRM data will be applied to the both Magento and OroCRM


.. _user-guide-magento-channel-integration-details_edit:

Edit Integration
----------------

To edit integration details:

- Go to the :ref:`Edit form <user-guide-ui-components-create-pages>` of the channel and click *"Edit"* link by the
  integration name

  The integration form will appear. Priory defined settings will be shown in the form. Once synchronization has been
  performed, it is impossible to change the Sync start date.

  .. image:: ./img/magento_integration/edit_form.png

- Click :guilabel:`Done` button to save the changes

.. hint::

    To remove an integration from the system, go to the :ref:`Edit form <user-guide-ui-components-create-pages>`
    of the channel and click |IcCross| located next to the integration name


.. _user-guide-magento-channel-start-synchronization:

Start Synchronization Manually
-------------------------------

Once integration has been created, the data will be automatically synchronized. However, you can also start the
synchronization manually:

- Go to the System → Integrations → Manage Integrations and click the |BSchedule|
  :ref:`grid action icon <user-guide-ui-components-grid-action-icons>` or

- Go to the :ref:`View page <user-guide-ui-components-view-pages>` of the channel and click the integration name link:

  .. image:: ./img/magento_integration/edit_from_view.png

- The *"View"* page of the integration will appear.

  .. image:: ./img/magento_integration/integration_view.png


- Click :guilabel:`Schedule Sync` button. *A sync*
  :ref:`job <book-job-execution>`
  *has been added to the queue.   Check progress.* note will appear.

- The data is being synchronized. You can click *Check progress* link to see the synchronization status.

After the successful synchronization, you can use OroCRM to manage Magento customer relations, as described
in the *Magento Entities Management* guide.


.. |IcCross| image:: ./img/buttons/IcCross.png
   :align: middle

.. |BSchedule| image:: ./img/buttons/BSchedule.png
   :align: middle
