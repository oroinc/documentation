.. _user-guide--sales--requests-for-quote:

Request for Quote (RFQ)
=======================

:abbr:`RFQs (Requests for quotes)` are used by sales representatives to assist customers and meet their needs through negotiations on a better price, more convenient quantities of products, or additional services. Once a customer submits a request for quotes in the Oro storefront, it immediately becomes available in the Oro management console.

Prior to starting your work with RFQs, make sure that you have:

1. **Configured RFQ related workflows** --- activate or deactivate the RFQ :ref:`workflows <doc--workflows--actions--system>` that control the interactions between the storefront and the management console. These workflows help buyers and sales managers run the process automatically and provide the corresponding status upon this interaction.

   .. image:: /user_guide/img/sales/requests_for_quote/rfq_1.png
      :width: 100%

2. **Configured RFQ notification options** --- :ref:`configure RFQ notification options <sys--conf--commerce--sales--rfq-notifications--general>` to ensure that both the customers and the sales representatives receive email notifications on submitting a new RFQ.

3. **Configured guest RFQs** --- to let unregistered customers request quotes on the items they are interested in, you can enable :ref:`guest RFQ forms <user-guide--system-configuration--commerce-sales--rfq>` in your Oro application.


.. note::
    See a short demo on `how to manage RFQs in OroCommerce <https://www.oroinc.com/orocommerce/media-library/manage-request-for-quotes>`_, or keep reading the sections below.

    .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/tNSZFHNDdQU" frameborder="0" allowfullscreen></iframe>

To learn more about RFQs in OroCommerce, see the following topics:

* :ref:`View Requests for Quote Summary <user-guide--sales--requests-for-quote--summary>`
* :ref:`Review RFQ Statuses <user-guide--sales--requests-for-quote--statuses>`
* :ref:`View RFQ Details <user-guide--sales--requests-for-quote--details>`
* :ref:`Manage RFQs <user-guide--sales--requests-for-quote--manage>`
* :ref:`RFQ in Workflows <user-guide--sales--requests-for-quote--examples>`

**Related Topics**

* :ref:`Quotes <user-guide--sales--quotes>`
* :ref:`Orders <user-guide--sales--orders>`
* :ref:`Workflow Management <doc--workflows--actions--system>`


.. include:: /img/buttons/include_images.rst
   :start-after: begin

.. toctree::
   :titlesonly:
   :maxdepth: 1
   :hidden:

   rfq_summary
   manage_rfq            
   rfq_steps_and_transitions
   review_statuses
   rfq_example

   

