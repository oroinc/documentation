:oro_documentation_types: OroCommerce

.. _user-guide--sales--requests-for-quote:

Request for Quote (RFQ)
=======================

:term:`RFQs (Requests for quotes) <Request for Quote>` are used by sales representatives to assist customers and meet their needs through negotiations on a better price, more convenient quantities of products, or additional services. Once a customer submits a request for quotes in the Oro storefront, it immediately becomes available in the Oro back-office.

Prior to starting your work with RFQs, make sure that you have:

1. **Configured RFQ related workflows** --- activate or deactivate the RFQ :ref:`workflows <doc--workflows--actions--system>` that control the interactions between the storefront and the back-office. These workflows help buyers and sales managers run the process automatically and provide the corresponding status upon this interaction.

   .. image:: /user/img/sales/rfq/rfq_1.png

2. **Configured RFQ notification options** --- :ref:`configure RFQ notification options <sys--conf--commerce--sales--rfq-notifications--general>` to ensure that both the customers and the sales representatives receive email notifications on submitting a new RFQ.

3. **Configured guest RFQs** --- to let unregistered customers request quotes on the items they are interested in, you can enable :ref:`guest RFQ forms <user-guide--system-configuration--commerce-sales--rfq>` in your Oro application.


.. note::
    See a short demo on |how to manage RFQs in OroCommerce| or keep reading the step-by-step guidance below.

    .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/tNSZFHNDdQU" frameborder="0" allowfullscreen></iframe>

Read more on RFQs in the topic below:

* :ref:`View RFQ List Page <user-guide--sales--requests-for-quote--summary>`
* :ref:`View RFQ Details <user-guide--sales--requests-for-quote--details>`
* :ref:`Manage RFQs <mc-sales-rfq-manage>`
* :ref:`Use RFQ Workflows <mc-sales-rfq-wf>`

Related Topics
--------------

* :ref:`Quotes <user-guide--sales--quotes>`
* :ref:`Orders <user-guide--sales--orders>`
* :ref:`Workflow Management <mc-system-wf>`


.. toctree::
   :hidden:

   rfq-details
   rfq-summary
   manage
   workflows

.. include:: /include/include-links-user.rst
   :start-after: begin

