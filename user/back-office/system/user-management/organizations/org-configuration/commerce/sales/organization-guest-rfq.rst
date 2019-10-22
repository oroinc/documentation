:oro_documentation_types: OroCommerce

.. _user-guide--system-configuration--commerce-sales--rfq--organization:

Guest Request for Quote Submission per Organization
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. begin_rfq

To enable guest request for quote submission per organization:

1. Navigate to **System > User Management > Organizations** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu to the right of the necessary organization and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Sales > Request for Quote** in the menu to the left.

   .. note::
      For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/user_management/org_configuration/sales/RFQOrg.png

4. In the **Guest RFQ** section, set whether guests are allowed to submit a request for quote.

   By default, guest request for quote submission is disabled.

   To enable it, clear *Use System* and select the *Enable Guest RFQ* check box.

   When the guest RFQ is enabled, click **Save Settings** to display the additional **Guest RFQ Owner Settings** section.

5. In the **Guest RFQ Owner Settings** section, select the user who will be the default owner of all guest RFQs.  Depending on the roles and permissions of the owner, guest RFQs may or may not be viewed and managed by the users who are subordinated to the owner.

   .. note::  To enable users from the same business unit or organization (that the owner belongs to) to view and manage guest RFQs, adjust permissions for the Request for Quote entity in their roles accordingly.

6. Click **Save Settings**.

.. finish_rfq

.. include:: /include/include-images.rst
   :start-after: begin
