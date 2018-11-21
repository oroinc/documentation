.. _user-guide-activities-requests-create-manually:

How to Create a Contact Request Manually
----------------------------------------

In case you need to register a certain request received from a customer by phone or email, you can create a contact request manually from within your Oro application.

1. Navigate to **Activities > Contact Requests** in the main menu.
2. Click **Create Contact Request** on the top right.
3. Provide the following details on the page that appears: 

   .. csv-table::
     :header: "**Name**","**Description**"
     :widths: 10, 30

     "**First Name**","The first name of the person who requested support."
     "**Last Name**","The last name of the person who requested support."
     "**Organization Name**","The name of an organization, on behalf of which the request has been filed, if any. This field is for information and search purposes only."
     "**Preferred Contact Method**","Choose the contact method to be used on the list. The possible values are:

     - Both phone and email
     - Phone
     - Email

     By default, the field is set to *Email*."
     "**Phone** and **Email**","Contact details related to the request. The values are determined by the *Preferred Contact
     Method* and must be defined."
     "**Contact Reason**","Choose a contact reason from the list to simplify request analysis. By default, the field is set to *Other*. To create a new contact reason that can be assigned to a certain contact request, refer to the :ref:`Contact Reasons <admin-guide-contact-reasons>` topic for more details."
     "**Comment**","The text of the request."

   .. image:: /user_guide/img/getting_started/activities/CreateContactRequestCRM.png

4. Click **Save** on the top right.

.. note:: If you use OroCommerce application, you can also relate a contact request to a customer user or a website, if necessary.

          .. image:: /user_guide/img/getting_started/activities/CreateContactRequestCommerce.png
















