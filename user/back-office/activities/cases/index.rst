:oro_documentation_types: OroCRM

.. _doc-activities-overview-cases:

Cases
=====

Cases are issues or problems reported by customers or found internally. With Oro, you can record, monitor, and solve cases in time to ensure that small and big issues do not harm the business of your company.

Oro application also provides an out-of-box integration with the :ref:`Zendesk <user-guide-zendesk-integration>` customer support platform. Once Oro and Zendesk are integrated, you can sync Zendesk tickets as cases into the Oro application.

Before proceeding to the step-by-step guidance, have a look at a short demo on |how to create and manage cases in your Oro application|.

.. raw:: html

   <iframe width="560" height="315" src="https://www.youtube.com/embed/qaLIO6H6po4" frameborder="0" allowfullscreen></iframe>

.. _user-guide-activities-cases:

Create a Case
-------------

.. begin_create_case

To create a new case:

1. Navigate to **Activities > Cases** in the main menu.
2. Click **Create Case** on the top right of the page.
3. Provide the following information:

   .. csv-table::
     :header: "**Name**","**Description**"
     :widths: 10, 30

     "**Subject**","Provide a meaningful title for the case."
     "**Description**","Provide the description for the issue (optional)."
     "**Resolution**","Provide problem resolution details (optional)."
     "**Owner**","Limits the list of users that can manage the case (view, edit) to users, whose :ref:`roles <user-guide-user-management-permissions>` allow managing cases assigned to the owner (e.g., the owner, owner's managers, colleagues, etc.).

     By default is set to the user filing the case.

     To clear the field, click **x**.

     You can choose a different owner from the list."
     "**Assigned To**","Assign a user responsible for resolving the issue (optional)."
     "**Source**","Provide the source of the issue. The possible options are email, other (default), phone, or web."
     "**Status**","Defines the current status of the case processing. The possible options are open (default), in progress, resolved, and closed."
     "**Priority**","Define priority of the task. The possible options are low, normal (default), high."
     "**Related Contact**","Define a :term:`contact record <Contact>` related to the case (optional)."
     "**Related Account**","Define an :term:`account record <Account>` related to the case (optional)."

4. Click **Save** on the top right.

.. _user-guide-activities-cases-edit:

View and Manage Cases
---------------------

You can view cases from the following pages in your Oro application:

1. From the page of all cases under **Activities > Cases**.

2. From the **Additional Information** section on the page of the user to whom the case was assigned (**System > User Management > Users**).

3. From the **Additional Information** section on the page of a contact related to the case (**Customers > Contacts**).

4. From the **Additional Information** section on the page of an account related to the case (**Customers > Accounts**).

5. You can view, edit, and delete cases using the following action icons on the pages of case-related records:

   .. image:: /user/img/activities/CasesMoreOptions.png
      :alt: The actions available for cases on the page of a case-related record

.. note:: The tasks can also be mapped to the Zendesk account as described in the :ref:`Integration with Zendesk <user-guide-zendesk-integration>` topic.

.. note:: Keep in mind that the ability to view and edit cases depends on specific roles and permissions defined in the system.

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-links.rst
   :start-after: begin
