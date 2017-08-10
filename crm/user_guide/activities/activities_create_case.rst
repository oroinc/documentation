.. _user-guide-activities-cases:


Create a Case
=============

In order to keep the details of a certain issue, problem or failures reported by the customers, define their priority 
and the person responsible for handling them, use the "*Create Case*" action.


.. note:: See a short demo on `how to create and manage cases <https://www.orocrm.com/media-library/create-manage-cases-orocrm>`_, or keep reading the step-by-step guidance below.

Cases can be created from the Cases grid:

1. Navigate to **Activities>Cases** in the main menu.

2. Click **Create Case** in the top right corner of the page.

3. Define the following fields:

   .. csv-table::
     :header: "**Name**","**Description**"
     :widths: 10, 30

     "**Subject***","The case title. Must be defined."
     "**Description**","A free text tab. Contains the problem description. May be left empty."
     "**Resolution**","A free text tab. Contains the problem resolution details. May be left empty."
     "**Owner***","Limits the list of users that can manage the case (view, edit) to users,  whose
     :ref:`roles <user-guide-user-management-permissions>` allow managing
     cases assigned to the owner (e.g. the owner, owner's managers, colleagues, etc.).

     By default is set to the user filing the case.

     To clear the field, click **x**.

     You can choose another owner from the list."
     "**Assigned To**","Defines the user, who shall resolve the issue. The field may be left empty."
     "**Source***","Defines how you have received information about the issue. The possible options are:

     - *Email*
     - *Other*
     - *Phone*
     - *Web*

     The field is by default filled with the *Other* option."
     "**Status***","Defines the current status of the case processing. The possible options are:

     - *Open*
     - *In Progress*
     - *Resolved*
     - *Closed**

     The field is by default filled with the *Open* option."
     "**Priority***","Defines the task priority. The possible options are:

     - *Low*
     - *Normal*
     - *High*

     The field is by default set to the *Normal* option."
     "**Related Contact**","Defines a :term:`contact record <Contact>` related to the case, if any. The field may be left empty."
     "**Related Account**","Defines an :term:`account record <Account>` related to the case, if any. The field may be left empty."
     "**Tags**","Defines :term:`tags <Tag>` for the case. Click the :guilabel:`Select and existing tag or create new` button and either choose a tag from the drop-down menu or enter a new tag. Any number of tags may be added."

4. Click **Save** to save the case.

Sample Flow
^^^^^^^^^^^

For example, the company has received a phone call from a manager of the Acuserv company informing that some of the details in the previous supply were faulty. The head of the purchasing department in Acuserv is Jennifer Paxton (a related contact). We have assigned the issue to Michael Buckley from the Marketing department and defined its priority as high. We have added the "Business" and "Gold Partner" tags for this case.

.. image:: ../img/activities/create_case_ex.png



.. |IcDelete| image:: ../../img/buttons/IcDelete.png
   :align: middle

.. |IcEdit| image:: ../../img/buttons/IcEdit.png
   :align: middle

.. |IcView| image:: ../../img/buttons/IcView.png
   :align: middle

