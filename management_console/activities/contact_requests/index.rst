.. _user-guide-activities-requests:

Contact Requests
================

.. contents:: :local:

Contact requests are used to track contact with individuals who are requesting information such as product information, support, partnership information, or any other types of assistance. Oro has a standard embedded contact form out-of-the-box for you to add to your websites. When your customers use this form, contact requests are automatically generated and added to the page of all contacts in your Oro application. 

Additionally, contact requests are used for consent management purposes when a customer :ref:`declines a consent <user-guide--consents--create>` in the OroCommerce storefront. When the **Declined Consent Notification** option is enabled for a specific consent, a notification is created in the management console as a contact request to inform that the consent has been declined. Read more information on consents in the relevant :ref:`Data Protection and Consent Management <user-guide--consents>` topic.

See a short demo in our media library on `how to create and manage contact requests <https://www.oroinc.com/orocrm/media-library/manage-contact-requests>`_, or keep reading the guidance below.

.. raw:: html

   <iframe width="560" height="315" src="https://www.youtube.com/embed/psQnfsFxQeg" frameborder="0" allowfullscreen></iframe>

.. _user-guide-activities-requests-create-manually:

Create a Contact Request
------------------------

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

4. Click **Save** on the top right.

.. note:: If you use OroCommerce application, you can also relate a contact request to a customer user or a website, if necessary.

          .. image:: /img/activities/CreateContactRequestCommerce.png
             :alt: Display the additional section with the options to select a customer user or a website

Create a Contact Request from a Third-Party Application
-------------------------------------------------------

Add the code for the form to your website, as described in the :ref:`Embedded Forms guide <admin-embedded-forms>` topic. Every time a customer completes the form, the information is automatically synced to your Oro application.

.. note::  Use the *Contact Request form* type for your website. Other contact request types can be developed in the course of integration, according to your specific business needs.

View and Manage Contact Requests
--------------------------------

The ability to view and edit contact requests depends on the specific :ref:`roles and permissions <user-guide-user-management-permissions-roles--acl>` defined in the system. 
   
All contact requests can be viewed from the page of all contact requests under **Activities > Contact Requests** in the main menu. From this page, you can view, edit, and delete contact requests.


.. include:: /img/buttons/include_images.rst
   :start-after: begin

