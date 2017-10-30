.. _user-guide--sales--requests-for-quote:

Request for Quote (RFQ)
=======================

:abbr:`RFQs (Requests for quotes)` are used by sales representatives to assist customers and meet their needs through negotiations on a better price, more convenient quantities of products, or additional services. Once a customer submits a request for quotes in the Oro front store, it immediately becomes available in the Oro management console.

.. contents:: :local:
   :depth: 3

Before You Begin
----------------

Prior to starting your work with RFQs, make sure that you have:

1. **Configured RFQ related workflows** --- activate or deactivate the RFQ :ref:`workflows <doc--workflows--actions--system>` that control the interactions between the front store and the management console. These workflows help buyers and sales managers run the process automatically and provide the corresponding status upon this interaction.

   .. image:: /user_guide/img/sales/requests_for_quote/rfq_1.png
      :width: 100%

2. **Configured RFQ notification options** --- :ref:`configure RFQ notification options <sys--conf--commerce--sales--rfq-notifications--general>` to ensure that both the customers and the sales representatives receive email notifications on submitting a new RFQ.

3. **Configured guest RFQs** --- to let unregistered customers request quotes on the items they are interested in, you can enable :ref:`guest RFQ forms <user-guide--system-configuration--commerce-sales--rfq>` in your Oro application.


.. note::
    See a short demo on `how to manage RFQs in OroCommerce <https://www.orocommerce.com/media-library/manage-request-for-quotes>`_, or keep reading the step-by-step guidance below.

    .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/tNSZFHNDdQU" frameborder="0" allowfullscreen></iframe>

View RFQ List Page
------------------

.. include:: /user_guide/rfq/rfq_summary.rst
   :start-after: begin
   :end-before: finish

Review RFQ Statuses
-------------------

The visibility of the RFQ statuses, displayed below, depends on whether the corresponding workflow is enabled or disabled. The statuses are available for customers and sales representatives when :ref:`RFQ Submission Flow <system--workflows--rfq-frontoffice-workflow>` and :ref:`RFQ Management Flow <system--workflows--rfq-backoffice-workflow>` workflows are  activated in the system configuration.

.. include:: /user_guide/system/workflows/rfq_frontoffice.rst
   :start-after: start_customer_statuses
   :end-before: stop_customer_statuses

.. include:: /user_guide/system/workflows/rfq_backoffice.rst
   :start-after: start_internal_statuses
   :end-before: stop_internal_statuses

.. include:: /user_guide/system/workflows/rfq_backoffice.rst
   :start-after: start_csv_table_statuses
   :end-before: stop_csv_table_statuses

View RFQ Details
----------------

.. include:: /user_guide/rfq/rfq_details.rst
   :start-after: begin
   :end-before: finish

Manage RFQs
-----------

From the **Requests for Quote** page, you can perform the following actions:

* `Create a Quote from an RFQ`_
* `Edit an RFQ`_
* `Create an Order from an RFQ`_
* `Use RFQ Transitions`_ if system workflows are active
* Use **More Actions** at the end of the required RFQ row to :ref:`add a note <user-guide-add-note>`, :ref:`send an email <user-guide-using-emails>` or :ref:`add an event <doc-activities-events-view-page>`.

  .. image:: /user_guide/img/sales/requests_for_quote/rfq_4.png
     :width: 100%

Create a Quote from an RFQ
^^^^^^^^^^^^^^^^^^^^^^^^^^

To create a new quote from a specific RFQ:

1. Navigate to **Sales > Request for Quotes** in the main menu.
2. Find the required RFQ and click on it.
3. Click **Create Quote**.

See more information about creating a quote from the RFQ in the relevant :ref:`Create a Quote from the RFQ <quote--create-from-rfq>` topic.

Additionally, you can perform the following actions by clicking on the corresponding buttons on the far right of the Quote page:

* Click |IcEdit| to edit the quote.
* Click |IcClone| to clone the quote.
* Click |IcDelete| to delete it.
* Click |IcSend| **Send to Customer** to send a notification email message the customer user regarding their quote.

  .. image:: /user_guide/img/sales/requests_for_quote/rfq_7.png
     :width: 100%

Once the message is prepared and sent, the quote backoffice status is changed to *Sent to customer*.

.. image:: /user_guide/img/sales/requests_for_quote/rfq_8.png
   :width: 100%

From this page, you can cancel |IcTimes| or expire |IcExpireQuote| the quote, delete |IcDelete| the quote, and the backoffice status will change to *Closed*.

Additionally, you can create a new quote for the customer, or, if the customer declined the offer, you can mark this quote as **Declined by Customer**.

For more detailed information, please check the :ref:`Quote Management Flow <simple-quote-management>` to learn additional details on the steps and actions available at every step.

.. _user-guide--sales--requests-for-quote--edit:

Edit an RFQ
^^^^^^^^^^^

To edit an RFQ:

1. Navigate to **Sales > Request for Quotes** in the main menu.
2. Find the required RFQ and click on it.
3. Click **Edit** on the top right of the page.
4. Check the fields required in the **General** section and modify the information, if necessary.
5. Add notes and assignees.

   .. image:: /user_guide/img/sales/requests_for_quote/rfq_9.png
      :width: 100%

6. Adjust target prices, add additional lines and products.

   .. image:: /user_guide/img/sales/requests_for_quote/rfq_10.png
      :width: 100%

7. Click **Save and Close** on the top right to save all the changes made.

Create an Order from an RFQ
^^^^^^^^^^^^^^^^^^^^^^^^^^^

To create an order from an RFQ:

1. Navigate to **Sales > Request for Quotes** in the main menu.
2. Find the required RFQ and click on it.
3. Click **Create an Order** on the top right.

.. note:: You can find more information on how to create an order from an RFQ, add additional products, add offers specific for the customer, edit or add shipping and billing information, calculate shipping options, add discounts and more, in the relevant :ref:`Create an Order from an RFQ <user-guide--sales--orders--create--from-rfq>` topic.

The **More Actions** menu enables users to :ref:`add notes <user-guide-add-note>` to the order, :ref:`send an email <user-guide-using-emails>` to the customer or :ref:`add an event <doc-activities-events-view-page>`. An event could be used to schedule a call or a meeting.

 .. image:: /user_guide/img/sales/requests_for_quote/rfq_11.png
    :width: 100%

Use RFQ Transitions
^^^^^^^^^^^^^^^^^^^

.. include:: /user_guide/rfq/rfq_steps_and_transitions.rst
   :start-after: begin_1
   :end-before: finish_1

.. include:: /user_guide/rfq/rfq_steps_and_transitions.rst
   :start-after: begin_2
   :end-before: finish_2

.. include:: /user_guide/rfq/rfq_steps_and_transitions.rst
   :start-after: begin_3
   :end-before: finish_3

.. include:: /user_guide/rfq/rfq_steps_and_transitions.rst
   :start-after: begin_4
   :end-before: finish_4

.. include:: /user_guide/rfq/rfq_steps_and_transitions.rst
   :start-after: begin_5
   :end-before: finish_5

RFQ in Use: Example
-------------------

The RFQ management procedure depends on the active RFQ-related workflows.

Out of the box, OroCommerce supports the following:

* :ref:`RFQ Submission Flow <system--workflows--rfq-frontoffice-workflow-rfq-illustration>`
* :ref:`RFQ Management Flow <system--workflows--rfq-backoffice-workflow-illustration>`

Related Topics
--------------

* :ref:`Quotes <user-guide--sales--quotes>`
* :ref:`Orders <user-guide--sales--orders>`
* :ref:`Workflow Management <doc--workflows--actions--system>`


.. include:: /user_guide/include_images.rst
   :start-after: begin

.. toctree::
   :hidden:

   rfq_details

   rfq_steps_and_transitions

   rfq_summary

