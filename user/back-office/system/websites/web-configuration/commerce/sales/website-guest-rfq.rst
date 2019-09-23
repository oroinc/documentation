.. _user-guide--system-configuration--commerce-sales--rfq--website:
.. _sys--conf--commerce--sales--rfq-notifications--website:

Guest Request for Quote per Website
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

In the Request For Quote section, you can enable guest request for quote submission and configure RFQ notifications:

.. begin_rfq

1. Navigate to **System > Websites** in the main menu.
2. For the necessary website, hover over the |IcMore| **More Options** menu to the right of the necessary website and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Sales > Request for Quote** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/websites/web_configuration/RFQNotificationsWebsite.png
       :class: with-border

4. In the **Notifications** section, configure the notifications options for:

   * Assigned Sales Representatives Of The Customer
   * The Owner Of The Customer User
   * The Owner Of The Customer

   To customize any of these options, clear the **Use System** check box next to the option and select the corresponding option from the list.

   * Select **Always** to notify the related entity each time an RFQ is submitted.
   * Select **If user has no sales reps assigned** to notify the related entity only in case they do not have any assigned sales representatives.

5. In the **Guest RFQ** section, set whether guests are allowed to submit a request for quote.

   By default, guest request for quote submission is disabled.

   To enable it, clear *Use System* and select the *Enable Guest RFQ* check box.

   When the guest RFQ is enabled, click **Save Settings** to display the additional **Guest RFQ Owner Settings** section.

6. In the **Guest RFQ Owner Settings** section, select the user who will be the default owner of all guest RFQs.  Depending on the roles and permissions of the owner, guest RFQs may or may not be viewed and managed by the users who are subordinated to the owner.

   .. note::  To enable users from the same business unit or organization (that the owner belongs to) to view and manage guest RFQs, adjust permissions for the Request for Quote entity in their roles accordingly.

7. Click **Save Settings**.

.. finish_rfq

.. include:: /include/include-images.rst
   :start-after: begin
