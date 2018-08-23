.. _user-guide--system-configuration--commerce-sales--rfq--website:


Configure Guest Request for Quote Submission per Website
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. begin_rfq

1. Navigate to **System > Websites** in the main menu.
2. For the necessary website, hover over the |IcMore| **More Options** menu to the right of the necessary website and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Sales > Request for Quote** in the menu to the left.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

The following page opens:

.. image:: /admin_guide/img/configuration/sales/rfq/RFQWebsite.png

4. In the **Guest RFQ** section, set whether guests are allowed to submit a request for quote.

   By default, guest request for quote submission is disabled.

   To enable it, clear *Use System* and select the *Enable Guest RFQ* check box.

5. In the **Guest RFQ Owner Settings** section, select the user who will be the default owner of all guest RFQs.  Depending on the roles and permissions of the owner, guest RFQs may or may not be viewed and managed by the users who are subordinated to the owner.

   .. note::  To enable users from the same business unit or organization (that the owner belongs to) to view and manage guest RFQs, adjust permissions for the Request for Quote entity in their roles accordingly.

6. Click **Save Settings**.

.. finish_rfq

.. include:: /img/buttons/include_images.rst
   :start-after: begin
