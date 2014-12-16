
.. _user-guide-magento-entities-guide:

Magento Entities Management Guide
=================================

Magento and OroCRM
------------------

OroCRM supports out of the box integration with Magento. 
The integration data can be loaded from and to a Magento-based E-commerce store and processed in the OroCRM. 
This article describes a set of pre-implemented OroCRM entities devoted to work with Magento based sales-data, 
including a :ref:`dedicated channel type <user-guide-magento-entities-channel>`, :ref:`dedicated 
entities <user-guide-magento-entities-entities>` that can be used to perform 
:ref:`actions <user-guide-magento-entities-actions>`, generate :ref:`reports <user-guide-magento-entities-workflows>` 
and set up :ref:`related workflows <user-guide-magento-entities-workflows>`

.. hint::
    
    While Magento integration capabilities are pre-implemented, OroCRM can be integrated with different third-party 
    systems.

.. _user-guide-magento-entities-channel:

Magento Channel Type
--------------------

A Channel entity represents a source of customers and customer data, which for Magento means specific Magento-base 
E-commerce outlets. A special *Magento* channel type is designed to process data of Magento Stores.

For each Magento Channel created you can:

- Define basic details and a set of entities, for which details of the records will be provided to OroCRM by the 
  Magento, uploaded to the OroCRM and processed there, and (subject to the synchronization settings) updated at 
  the Magento. You can find more details about the way of the channel creation and management in the :ref:`Channels 
  Management <user-guide-channel-guide-create>` guide.

- Integration settings and rules, including synchronization priorities. You can find more information on the integration
  and synchronization settings in the \:ref:`Integration with Magento <user-guide-magento-channel-integration>`\ guide.
  

.. _user-guide-magento-entities-entities:
  
Default Entities of Magento Channel
-----------------------------------
There are three basic Magento entities pre-implemented in the OroCRM for the customer-relation aims of a 
Magento-based business and by default assigned to channels of a Magento type. 

.. hint::
    
    It is possible to add other system and custom entities to the channel, as well as delete most of the default 
    entities from it, subject to you needs. 
    
The default entities are:

.. csv-table:: 
  :header: "Entity", "Instance Description"
  :widths: 10, 30

  "**Web Customer**","Represent one customer identity, for which data is collected within the channel. Must be defined 
  for channels of the Magento channel."
  **Shopping Cart**","Keeps details on the Magento Customer's pre-sales activity with the |WT02|_"
  **Order**","Keeps details of actual sales made by the customer within the channel, including store details, personal 
  and banking data, one-time and total credited, paid and taxed amounts, feed-backs, etc."

Details of all of these entities are uploaded into OroCRM in the course of integration, can be processed from OroCRM UI 
and can be used to perform :ref:`actions <user-guide-magento-entities-actions>`, and 
set up :ref:`related workflows <user-guide-magento-entities-workflows>`.

.. _user-guide-magento-entities-actions:

Managing Magento Entities 
^^^^^^^^^^^^^^^^^^^^^^^^^

The following actions can be performed for every Shopping Cart and Order from their grids (in the *Sales → Shopping 
Carts* and *Sales → Orders* respectively):

.. image:: ./img/magento_entities/grid_actions.png

- Refresh the grid (get the newest data)

- Reset the grid (clear all the filters)

- Export the grid as a .csv file

From the *View* page of every shopping cart with *Open* status (items of the cart have not yet been purchased) you can
place an order. Click the button to get to the Magento *Place an Order* form.

.. image:: ./img/magento_entities/view_place_order.png

.. caution::
  
    You need to enter your credentials when referred to the Magento for the first time in the session.

From the *View* page of any shopping cart or record you can:

- Synchronize Data : uploads the latest information for the cart/order from Magento and back (if so is specified by the 
  synchronization settings).

.. image:: ./img/magento_entities/view_actions.png

.. important:: 

    As a matter of fact, information for all the carts is updated once in a predefined period (5 minutes by default), 
    however it is strongly recommended to update a specific Cart record before you perform any actions with it.

The rest of the \ref:`actions <user-guide-ui-components-view-page-actions>`\ available depend on the system settings 
defined in the \ref:`Communication &  Collaboration <user-guide-entity-management-create-commun-collab>` section of the 
entity


.. _user-guide-magento-entities-workflows:

Workflows with Magento Entities 
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
To provide consistent and customer oriented approach, you can define a specific workflow within which the actions can be
performed for each instance of a Shopping Cart or Order. The following two workflows are pre-implemented in the OroCRM
for Magento-based shops:


*Abandoned Shopping Cart* Workflow
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The workflow is aimed at boosting sales from carts. Basically, once the managers sees a cart that has not been 
converted into an order, the manager can:

1. Contact the customer. Multiple calls an/or E-mails can be made/sent.

2. Convert the cart into an Order or Abandon the cart

It is possible to convert the cart into an order without contacting the customer, but it is impossible to abandon it 
without getting in touch with the customer.

.. image:: ./img/magento_entities/cart_workflow_diagram.png

The workflow helps to improve customer-oriented communications and increase the amount of actual orders. At the 
same time, the managers can see all the information on the relevant items (no long search during the call), switch to 
the customer and account info and even check if the customer has already been contacted.


*Order Follow Up* Workflow
^^^^^^^^^^^^^^^^^^^^^^^^^^

The workflow is aimed to keep track of the customer feedback on the purchase. For each order, the manager can:

1. Contact the customer by E-mail. You can contact the customer by E-mail only once. 

2. If there is no response to the E-mail, it is possible to contact the customer by phone. 
   It is also possible to skip sending an Email and start with a call.
   
3. Once a call was logged, there are two options:

   - Record Feedback: *Record Feedback* form will appear. Fill it, and click :guilabel:`Submit` to save it in the 
     system.
     
     No more calls or E-mails to the customer related to this cart.
   
   - No Reply: you can make a note (e.g. "an answer-machine", "no parents at home, call-back after six"). 

.. image:: ./img/magento_entities/order_followup_workflow_diagram.png

The workflow provides for consistency of the feedback collection and eliminates excessive calls, as each manager can see
the log of previous E-mails and call-attempts, if any.


.. |WT02| replace:: Shopping Cart
.. _WT02: http://www.magentocommerce.com/magento-connect/customer-experience/shopping-cart.html
