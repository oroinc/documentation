.. _user-guide-magento-entities-shopping-carts:

Magento Shopping Carts and Orders
=================================

.. include:: /old_version_notice.rst
   :start-after: begin_old_version_notice

To represent actual |WT02|_ of a Magento-based store, OroCRM provides records of the *"Shopping Cart"* entity.

If, by the moment of :ref:`synchronization <user-guide-magento-channel-integration>` with your Magento-based store, 
a customer has added some items to cart, a Magento cart is created in OroCRM. The record is used to save the cart 
details, such as number of items, items description, purchase status, etc.
  
The *"Order"* records represent shopping carts, for which an order has been submitted.

If two-way synchronization has been 
:ref:`enabled`<user-guide-magento-channel-integration-synchronization>` you can process carts and submit orders from 
OroCRM as described below.

Create a Shopping Cart/Order
----------------------------

To created a shopping cart of order: 

- Go to the :ref:`view page <user-guide-ui-components-view-pages>` of a 
  :ref:`Magento customer <user-guide-magento-entities-customers>`.

- Click the :guilabel:`Create Order`.

- Enter the Admin Panel of your Magento shop.

If you don't complete the order placement procedure, a shopping cart will be created. If you submit the order from the 
Admin Panel, this order will be created in OroCRM. 


Convert Shopping Cart into and Order
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
You can also convert a cart in an order. To do so:


- Go to the :ref:`view page <user-guide-ui-components-view-pages>` of a Shopping Cart with status *"Open"*.
  
- Click the :guilabel:`Place and Order`.

  |
  
  |ConvCart|

  |
  
- Enter the Admin Panel of your Magento shop and submit the order in your Magento Store. 


.. caution::

    Be careful not to confuse the cart status and step of the related workflow. For example, a cart at the step
    "Contacted" can still have the "Open" status (items in the carts have not yet been bought).


Manage Shopping Carts and Orders
--------------------------------

The only action available from the :ref:`grid <user-guide-ui-components-grids>` of Shopping Carts and Orders 
is to open the :ref:`view pages <user-guide-ui-components-view-pages>` of their records by 
clicking the |IcView| icon.

.. image:: /img/magento_entities/view_carts.png

From the View pages, you can convert carts into orders (as described above), and:

- Perform actions specified in the **Communication &  Collaboration** section of the **Shopping Cart** entity configuration. See step 4 of the :ref:`Create an Entity <doc-entity-actions-create>` action description..

- Synchronize Data, i.e. upload the latest information for the cart/order from Magento and back (as defined by the
  synchronization settings).



.. important::

    Information for all the carts/order is updated once in a predefined period (default value is 5 minutes).
    However, it is strongly recommended to update a specific Cart record before you perform any actions with it.


.. |WT02| replace:: Shopping Cart
.. _WT02: http://www.magentocommerce.com/magento-connect/customer-experience/shopping-cart.html

.. |IcView| image:: /img/buttons/IcView.png
   :align: middle
   
.. |SubOrd| image:: /img/magento_entities/magento_customers_view.png

.. |ConvCart| image:: /img/magento_entities/view_place_order.png