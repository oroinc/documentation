:oro_documentation_types: OroCommerce

.. _mc-sales-rfq-manage:

Manage RFQs
===========

From the **Requests for Quote** page, you can perform the following actions:

* `Create a Quote from an RFQ`_
* `Create an Order from an RFQ`_
* `Edit an RFQ`_
* `Use RFQ Transitions`_
* `Mark the RFQ as Processed`_
* `Request More Information from the Customer`_
* `Decline an RFQ`_
* `Delete an RFQ`_

You can also engage RFQs in various activities, such as :ref:`adding a note <user-guide-add-note>`, :ref:`sending an email <user-guide-using-emails>` or :ref:`adding an event <doc-activities-events>` to an RFQ.

.. image:: /user/img/sales/rfq/rfq_4.png

Create a Quote from an RFQ
--------------------------

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

  .. image:: /user/img/sales/rfq/rfq_7.png
     :width: 100%

Once the message is prepared and sent, the quote backoffice status is changed to *Sent to customer*.

.. image:: /user/img/sales/rfq/rfq_8.png
   :width: 100%

From this page, you can cancel |IcTimes| or expire |IcExpireQuote| the quote, delete |IcDelete| the quote, and the backoffice status will change to *Closed*.

Additionally, you can create a new quote for the customer, or, if the customer declined the offer, you can mark this quote as **Declined by Customer**.

For more detailed information, please check the :ref:`Quote Management Flow <simple-quote-management>` to learn additional details on the steps and actions available at every step.

Create an Order from an RFQ
---------------------------

To create an order from an RFQ:

1. Navigate to **Sales > Request for Quotes** in the main menu.
2. Find the required RFQ and click on it.
3. Click **Create an Order** on the top right.

.. note:: You can find more information on how to create an order from an RFQ, add additional products, add offers specific for the customer, edit or add shipping and billing information, calculate shipping options, add discounts and more, in the relevant :ref:`Create an Order from an RFQ <user-guide--sales--orders--create--from-rfq>` topic.

The **More Actions** menu enables users to :ref:`add notes <user-guide-add-note>` to the order, :ref:`send an email <user-guide-using-emails>` to the customer or :ref:`add an event <doc-activities-events>`. An event could be used to schedule a call or a meeting.

.. image:: /user/img/sales/rfq/rfq_11.png


.. _user-guide--sales--requests-for-quote--edit:

Edit an RFQ
-----------

To edit an RFQ:

1. Navigate to **Sales > Request for Quotes** in the main menu.
2. Find the required RFQ and click on it.
3. Click **Edit** on the top right of the page.
4. Check the fields required in the **General** section and modify the information, if necessary.
5. Add notes and assignees.
6. Adjust target prices, quantity and add additional products.

   .. image:: /user/img/sales/rfq/rfq_10.png

7. Click **Save and Close** on the top right to save all the changes made.

.. _user-guide--sales--requests-for-quote--steps-and-transitions:

Use RFQ Transitions
-------------------

.. note:: The workflow transitions are available for customers and sales representatives when :ref:`RFQ Submission Flow <system--workflows--rfq-frontoffice-workflow>` and :ref:`RFQ Management Flow <system--workflows--rfq-backoffice-workflow>` workflows are activated in the system configuration.

To control RFQ using transitions exposed by RFQ workflows (:ref:`RFQ Submission Flow <system--workflows--rfq-frontoffice-workflow>` and :ref:`RFQ Management Flow <system--workflows--rfq-backoffice-workflow>`):

1. Navigate to **Sales > Request for Quotes** in the main menu.
2. Find the required RFQ and click on it to open RFQ details.

Now you can perform the following actions with an RFQ in the back-office:

.. contents:: :local:

Once the RFQ is submitted by a customer in the storefront, it becomes immediately available in the RFQ back-office in the *Open* status.

.. image:: /user/img/sales/rfq/rfq_12.png
   :class: with-border

.. image:: /user/img/sales/rfq/rfq_13.png
   :class: with-border

.. _user-guide--sales--requests-for-quote--steps-and-transitions--processed:

Mark the RFQ as Processed
^^^^^^^^^^^^^^^^^^^^^^^^^

To mark the RFQ as processed, click **Mark as Processed** |IcMarkProcessed| on the RFQ page. This will notify the assigned sales representative that the quote is being processed.

Marking RFQ as processed will change its internal status to *Processed*.

.. image:: /user/img/sales/rfq/rfq_14.png
   :class: with-border

.. _user-guide--sales--requests-for-quote--steps-and-transitions--more-info:

Request More Information from the Customer
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To request more information from a customer:

1. Click **Request More Information** |IcRequestMoreInfo| to open a text dialog for you to communicate with the customer.
2. Enter a comment.
3. Click **Submit**.

The customer will be notified by email and through the customer’s store account that more information is required.

The internal status should then change to *More Information Requested*, and the customer status should change to *Requires Attention*.

.. image:: /user/img/sales/rfq/rfq_16.png
   :class: with-border

Once the customer responds to the request for additional information, the assigned sales representative is notified that the customer has provided the requested information and can continue processing the request.

The internal status changes back to *Open*, and the customer status changes back to *Submitted*.

.. _user-guide--sales--requests-for-quote--steps-and-transitions--decline:

Decline an RFQ
^^^^^^^^^^^^^^

To decline the RFQ,  click **Decline** on the RFQ page.

This will change the internal status to *Declined*, and the customer status to *Cancelled*.

.. image:: /user/img/sales/rfq/rfq_17.png
   :class: with-border

.. _user-guide--sales--requests-for-quote--steps-and-transitions--delete:

Delete an RFQ
^^^^^^^^^^^^^

To delete the RFQ from the list, click **Delete** on the RFQ page.

The RFQ will be removed from the customer user’s account.

The internal status will be changed to *Deleted*.

.. image:: /user/img/sales/rfq/rfq_18.png
   :class: with-border

.. include:: /include/include-images.rst
   :start-after: begin
