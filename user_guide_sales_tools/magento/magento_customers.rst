.. _user-guide-magento-entities-customers:

Magento Customers
=================


The *"Magento Customer"* records represent clients of a Magento-based store, for which data is collected within the 
channel. The entity must be assigned to a Magento channel.

After the successful :ref:`synchronization with Magento <user-guide-magento-channel-integration>`, the list of 
Web Customers and their details will be loaded to OroCRM and, if 
:ref:`two-way synchronization has been enabled <user-guide-magento-channel-integration-synchronization>` 
can be processed in OroCRM.


Create a Magento Customer Record
--------------------------------

If the two-way synchronization has been enabled, you can create a new Magento customer from OroCRM.

In order to create a new Magento customer in the system:

- Go to the **Customers** -→ **Magento Customers**.

- Click :guilabel:`Create Magento Customer` button.

- The **Create Magento Customer** :ref:`form <user-guide-ui-components-create-pages>` will appear:

|
  
.. image:: /img/magento_entities/magento-customer_create.png

|

The following fields are mandatory and **must** be defined:

.. csv-table::
  :header: "Field", "Description"
  :widths: 10, 30

  "**Channel**","Choose the channel for which the customer is being created. All the active 
  channels of the Magento type are available."
  "**Store**","Choose a Magento store for which the customer is being created. All the stores
  available within the channel specified will be available."
  "**Customer Group**","Choose a customer group to which the created customer will be assigned in Magento. All the 
  customer groups available within the store specified will be available."
  "**First Name** and **Last Name**","Define the name used to refer to the customer in Magento."
  "**Owner**","Limits the list of users that can manage the customer to users whose 
  :ref:`roles <user-guide-user-management-permissions>` allow managing 
  Magento customers assigned to the owner (e.g. the owner, members of the same business unit, system administrator, 
  etc.).
  
  By default, the user creating the record is chosen."
  "**Password**","Define the password for the Magento Customer. Empty password cannot be set."

The rest of the fields are optional. They have been added to the system based on the best Magento practices and keep 
additional details of the customer (such as the customer's 
middle name, birthday, gender, related :ref:`Contact <user-guide-contacts>` and :ref:`Account <user-guide-accounts>`).
The optional fields may be left empty.

Once all the necessary fields have been defined, click the button in the right top corner of the page to save the 
customer in the system.


.. _user-guide-magento-customers-actions:

Manage Magento Customer Records 
-------------------------------

The following actions can be performed for Magento customers:

From the :ref:`grid <user-guide-ui-components-grids>` you can:

      |
  
.. image:: /img/magento_entities/mag_customers_grid.png

|

- Subscribe or unsubscribe the customers to/from the 
  :ref:`Magento Newsletter <user-guide-magento-entities-newsletters>`: |IcSub| or |IcUns|

- Get to the :ref:`Edit form <user-guide-ui-components-create-pages>` of the customer: |IcEdit| 

- Get to the :ref:`View page <user-guide-ui-components-view-pages>` of the customer:  |IcView| 

.. image:: /img/magento_entities/magento_customers_view.png
  
From the View page you can:

- Create an order for the customer in Magento: click the :guilabel:`Create Order` to get to the Admin Panel and 
  place and order in Magento.

- Subscribe or unsubscribe the customers to/from the 
  :ref:`Magento Newsletter <user-guide-magento-entities-newsletters>`: click the :guilabel:`Subscribe` or 
  :guilabel:`Unubscribe` buttons.
  
- The rest of the actions available from the View page depend on the system settings defined in the **Communication & Collaboration** section of the **Magento Customer** entity configuration. See step 4 of the :ref:`Create an Entity <doc-entity-actions-create>` action description.


.. |IcView| image:: /img/buttons/IcView.png
   :align: middle

.. |IcEdit| image:: /img/buttons/IcEdit.png
   :align: middle
   
.. |IcSub| image:: /img/buttons/IcSub.png
   :align: middle

.. |IcUns| image:: /img/buttons/IcUns.png
   :align: middle
