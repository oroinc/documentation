.. _quotes--basic-lifecycle-management:

Basic Quote Lifecycle Management (When Workflows Are Disabled)
==============================================================

Available options depend on the current status of the quote and your permissions. These actions appear only when all the quote-related workflows are disabled and the default (basic) quote management applies.

Edit a Quote
------------

.. include:: /user_doc/back_office/sales/quotes/manage.rst
   :start-after: begin
   :end-before: finish

Learn :ref:`more ways to edit a quote <quotes--actions--edit>`.

.. _quotes--actions--notify-customer:

Notify a Customer About the Quote
---------------------------------

.. begin

.. important:: You can send notification to the customer in this way only when the :ref:`Quote Management Flow <simple-quote-management>` / :ref:`Backoffice Quote Flow with Approvals <quote-management-with-approvals>` are inactive.

To notify a customer that their quote is prepared:

1. In the main menu, navigate to **Sales > Quotes**.
#. Choose the quote in the list and click it. The quote details page opens.
#. Click |IcSortDesc| next to **Notify Customer** on the top right of the page, and then click **Notify By Email**.
#. In the **Notify By Email** dialog that appears, review the email draft. If required, add additional recipients to the **To**, **CC**, or **BCC** fields, or make other changes. The email body may be adjusted to be more personalized.

   .. image:: /user/img/sales/quotes/quotes_notifycustomer2.png
      :width: 50%

#. Click **Send**.

.. hint:: By default, the quote_email_link email template is used for this type of notifications. You can select another one or, if you have corresponding permissions, you can :ref:`adjust the email template <user-guide-email-template>`. If you do not have permissions to modify templates, ask your administrator for help.

The quote internal status becomes *Sent to Customer*.

.. finish

.. _quotes--actions--expire:

Mark a Quote as Expired
-----------------------
.. _quotes--actions--expire--fromgrid:

Expire a Quote From the Grid
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. begin

.. important:: You can expire a quote in this way only when the :ref:`Quote Management Flow <simple-quote-management>` / :ref:`Backoffice Quote Flow with Approvals <quote-management-with-approvals>` are inactive.

To indicate that the quote's validity period is over from the quote list:

1. In the main menu, navigate to **Sales > Quotes**. The quote list opens.
2. Choose the quote that you need to expire, click the |IcMore| **More Options** menu at the end of the row, and then click the |IcExpireQuote| **Expire Quote** icon.
#. In the confirmation dialog, click **Mark as Expired**.

The quote's **Expired** field in the list is now set to *Yes*.

.. finish

.. _quotes--actions--expire--fromviepage:

Expire a Quote From the Quote View Page
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. important:: You can expire a quote in this way only when the :ref:`Quote Management Flow <simple-quote-management>` / :ref:`Backoffice Quote Flow with Approvals <quote-management-with-approvals>` are inactive.

To indicate that the quote's validity period is over from the quote details page:

1. In the main menu, navigate to **Sales > Quotes**.
#. Choose the quote in the list and click it. The quote details page opens.
#. Click the **Expire Quote** button on the top right of the page.
#. In the confirmation dialog, click **Mark as Expired**.

The quote is now marked as *Expired*:

.. image:: /user/img/sales/quotes/quotes_expired.png

Expire a Quote From the Quote Edit Page
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. important:: You can expire a quote in this way only when the :ref:`Quote Management Flow <simple-quote-management>` / :ref:`Backoffice Quote Flow with Approvals <quote-management-with-approvals>` are inactive.  Otherwise, use the Edit transition defined within the active workflow:

   .. image:: /user/img/sales/quotes/quotes_workflowedit1.png

To indicate that the quote's validity period is over from the quote details page:

1. In the main menu, navigate to **Sales > Quotes**.
#. Choose the quote in the list and click it. The quote details page opens.
#. Click **Edit** on the top right of the page:

   .. image:: /user/img/sales/quotes/quotes_edit1.png

#. Update the **Quote General Information**, **Line Items**, **Shipping Address**, or **Shipping Information** sections. See :ref:`Create a Quote <user-guide--quotes--create>` section for detailed information on the available options.
#. Click **Save** on the top right of the page.

The quote is updated.

Learn :ref:`more ways to expire a quote <quotes--actions--expire>`.

Delete a Quote
^^^^^^^^^^^^^^

.. include:: /user_doc/back_office/sales/quotes/manage.rst
   :start-after: begin
   :end-before: finish

Learn :ref:`more ways to delete a quote <quotes--actions--delete>`.

.. include:: /include/include_images.rst
    :start-after: begin
