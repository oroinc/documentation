.. _user-guide-magento-entities-newsletters:
  
Magento Newsletter Subscribers
==============================


If the Magento Newsletter Subscribers entity has been :ref:`assigned to a channel <user-guide-channel-guide-entities>` 
of Magento type, after the :ref:`synchronization <user-guide-magento-channel-integration>` the list of all the 
Magento Customers assigned to Magento Newsletter will be uploaded to OroCRM. 

.. caution::

    The Magento Newsletter Subscribers are only supported with OroBridge version 1.1.5 or higher.

To see the Magento Newsletter Subscribers :ref:`grid <user-guide-ui-components-grids>` go to the *Marketing* → 
*Magento Newsletter Subscribers*.

      |
  
.. image:: /img/magento_entities/nl_menu.png

|

From the :ref:`grid <user-guide-ui-components-grids>` of Magento Customers you can:

- Subscribe or unsubscribe Magento customers to/from the Magento Newsletter: |IcSub| or |IcUns|

- Get to the :ref:`View page <user-guide-ui-components-view-pages>` of the list :  |IcView| 

  - You can also unsubscribe/subscribe customers to the newsletter with the button in the
    :ref:`View page <user-guide-ui-components-view-pages>` of a 
    :ref:`Magento customer <user-guide-magento-entities-customers>`.

.. note::

    Editing the subscription list is only possible if 
    :ref:`two-way synchronization <user-guide-magento-channel-integration-synchronization>` has been enabled. 


.. |IcView| image:: /img/buttons/IcView.png
   :align: middle
   
.. |IcSub| image:: /img/buttons/IcSub.png
   :align: middle

.. |IcUns| image:: /img/buttons/IcUns.png
   :align: middle