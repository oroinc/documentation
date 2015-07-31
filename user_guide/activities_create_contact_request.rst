.. _user-guide-activities-requests:

Create Contact Request
======================

Requests for OroCRM support, including partnership proposals, complaints, additional 
information and assistance requests that come from a :ref:`third-party application <admin-embedded-forms>` or have been 
registered directly in OroCRM are collected with the *"Create Contact Request"* actions.   


Create a Contact Request from OroCRM
------------------------------------

In order to create a contact request from OroCRM:

1. Go to *Activities → Contact Requests*.

2. Click the :guilabel:`Create Contact Request` button.

3. The "Create Contact Request" form will appear. The form has the following fields:

.. csv-table::
  :header: "**Name**","**Description**"
  :widths: 10, 30

  "**First Name***","The first name of the person, who has requested support."
  "**Last Name***","The last name of the person, who has requested support."
  "**Channel***","The :term:`channel <Channel>` from which the request was received. The drop-down menu contains all the 
  channels to which the Contact Request :term:`entity <Entity>` has been 
  :ref:`assigned <user-guide-channel-guide-entities>`  in the 
  alphabetical order. By default, it is filled with the first channel in the list."
  "**Organization Name**","The name of an organization, on behalf of which the request has been filed, if any. This 
  field is for information and search purposes only."
  "**Preferred Contact Method***","Choose the contact method to be used of the list. The possible values are:
  
  - Both phone and email
  - Phone
  - Email  
  
  By default, the field is set to *Email*."
  "**Phone** and **Email**","Contact details related to the request. The values are determined by the *Preferred Contact 
  Method* and must be defined."
  "**Contact Reason**","Choose a contact reason from the drop-down menu to simplify the request analysis. The field is 
  by default set to *Other*."
  "**Comment***","Actual text of the request. This must be filled."

4. Click the button in the top right corner to save the request.
  
For example, there was a request from Mr. Jack Johnson, representative of the General Ltd. interested in OroCRM's 
multichannel functionality. 

      |
	  
.. image:: ./img/activities/request_create.png

  
Create a Contact Request from a Third-Party Application
-------------------------------------------------------

Add the code for the form on your site, as described in the :ref:`Embedded Forms guide <admin-embedded-forms>`. 
Use the forms of the "Magento Contact Us Request" type for the Magento-based businesses and of the "Contact Request"
type for the other websites. Every time a user has filled the form it will be added to the Contact Requests grid in
Oro CRM.

.. note::

    Other contact request types can be developed in the course of integration, according to your specific business needs.


View and Manage Contact Requests
--------------------------------

.. note:

    The ability to view and edit contact requests depends on the specific roles and permissions defined in the system. 
   
- All the Contact Requests can be viewed from the Contact Requests grid.

.. image:: ./img/activities/request_grid.png

- From the grid, you can manage the Contact Request using the action icons:

  - Delete the request: |IcDelete|

  - Get to the :ref:`Edit form <user-guide-ui-components-create-pages>` of the request: |IcEdit|

  - Get to the :ref:`View page <user-guide-ui-components-view-pages>` of the request:  |IcView|


.. |IcDelete| image:: ./img/buttons/IcDelete.png
   :align: middle

.. |IcEdit| image:: ./img/buttons/IcEdit.png
   :align: middle

.. |IcView| image:: ./img/buttons/IcView.png
   :align: middle
