.. _user-guide--sales--requests-for-quote--steps-and-transitions:

Use RFQ Transitions
===================

.. begin_1

.. note:: The workflow transitions are available for customers and sales representatives when :ref:`RFQ Submission Flow <system--workflows--rfq-frontoffice-workflow>` and :ref:`RFQ Management Flow <system--workflows--rfq-backoffice-workflow>` workflows are activated in the system configuration.

To control RFQ using transitions exposed by RFQ workflows (:ref:`RFQ Submission Flow <system--workflows--rfq-frontoffice-workflow>` and :ref:`RFQ Management Flow <system--workflows--rfq-backoffice-workflow>`):

1. Navigate to **Sales > Request for Quotes** in the main menu.
2. Find the required RFQ and click on it to open RFQ details.

Now you can perform the following actions with an RFQ in the management console:

.. contents:: :local:

Once the RFQ is submitted by a customer in the storefront, it becomes immediately available in the RFQ management console in the *Open* status.

.. image:: /user_guide/img/sales/requests_for_quote/rfq_12.png
   :class: with-border

.. image:: /user_guide/img/sales/requests_for_quote/rfq_13.png
   :class: with-border

.. finish_1

.. _user-guide--sales--requests-for-quote--steps-and-transitions--processed:

.. begin_2

Mark the RFQ as Processed
-------------------------

To mark the RFQ as processed, click **Mark as Processed** |IcMarkProcessed| on the RFQ page. This will notify the assigned sales representative that the quote is being processed.

Marking RFQ as processed will change its internal status to *Processed*.

.. image:: /user_guide/img/sales/requests_for_quote/rfq_14.png
   :class: with-border

.. finish_2

.. _user-guide--sales--requests-for-quote--steps-and-transitions--more-info:

.. begin_3

Request More Information from the Customer
------------------------------------------

To request more information from a customer:

1. Click **Request More Information** |IcRequestMoreInfo| to open a text dialog for you to communicate with the customer.
2. Enter a comment.
3. Click **Submit**.

   .. image:: /user_guide/img/sales/requests_for_quote/rfq_15.png
      :class: with-border

The customer will be notified by email and through the customer’s store account that more information is required.

The internal status should then change to *More Information Requested*, and the customer status should change to *Requires Attention*.

.. image:: /user_guide/img/sales/requests_for_quote/rfq_16.png
   :class: with-border

Once the customer responds to the request for additional information, the assigned sales representative is notified that the customer has provided the requested information and can continue processing the request.

The internal status changes back to *Open*, and the customer status changes back to *Submitted*.

.. finish_3

.. _user-guide--sales--requests-for-quote--steps-and-transitions--decline:

.. begin_4

Decline the RFQ
---------------

To decline the RFQ,  click **Decline** on the RFQ page.

This will change the internal status to *Declined*, and the customer status to *Cancelled*.

.. image:: /user_guide/img/sales/requests_for_quote/rfq_17.png
   :class: with-border

.. finish_4

.. _user-guide--sales--requests-for-quote--steps-and-transitions--delete:

.. begin_5

Delete the RFQ
--------------

To delete the RFQ from the list, click **Delete** on the RFQ page.

The RFQ will be removed from the customer user’s account.

The internal status will be changed to *Deleted*.

.. image:: /user_guide/img/sales/requests_for_quote/rfq_18.png
   :class: with-border

.. finish_5

.. include:: /img/buttons/include_images.rst
   :start-after: begin