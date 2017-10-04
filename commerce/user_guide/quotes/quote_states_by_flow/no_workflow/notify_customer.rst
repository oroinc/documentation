.. _quotes--actions--notify-customer:

Notify a Customer
=================

.. begin

.. important:: You can send notification to the customer in this way only when the :ref:`Quote Management Flow <simple-quote-management>` / :ref:`Backoffice Quote Flow with Approvals <quote-management-with-approvals>` are inactive.

To notify a customer that their quote is prepared:

1. In the main menu, navigate to **Sales > Quotes**.
#. Choose the quote in the list and click it. The quote details page opens.
#. Click |IcSortDesc| next to **Notify Customer** on the top right of the page, and then click **Notify By Email**.
#. In the **Notify By Email** dialog that appears, review the email draft. If required, add additional recipients to the **To**, **CC**, or **BCC** fields, or make other changes. The email body may be adjusted to be more personalized.

   .. image:: /user_guide/img/quotes/quotes_notifycustomer2.png
      :width: 50%

#. Click **Send**.

.. hint:: By default, the quote_email_link email template is used for this type of notifications. You can select another one or, if you have corresponding permissions, you can :ref:`adjust the email template <user-guide-email-template>`. If you do not have permissions to modify templates, ask your administrator for help.

The quote internal status becomes *Sent to Customer*.

.. finish

.. include:: /user_guide/include_images.rst
    :start-after: begin
