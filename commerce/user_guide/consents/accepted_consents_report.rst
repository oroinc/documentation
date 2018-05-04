.. _user-guide-reports-accepted-consents:

Reports with Accepted Consents
==============================

In OroCommerce, you can create a report that shows what and how many customer users have accepted specific consents.

As an illustration, we are creating a report to collect statistics on buyers who accepted the consent to receive email newsletters:

1. Navigate to **Reports & Segments** in the main menu.
#. Click **Create Report** at the top right of the page.
#. In the **General** section, provide the following mandatory information:
 
   * **Name** --- A name that is used to refer to the report on the interface. It is recommended to create a name that indicates the information the report presents.
   * **Entity** --- Select **Customer User** to collect data on the buyers who accepted the consent to receive emails.
   * **Report Type** --- Select *Table*.

#. In the *Columns* section, add the key details to be displayed in the report table:

   * Customer User > First Name
   * Customer User > Last Name
   * Customer User > Email Address

#. In the *Filters* section, add the field condition to sort the data according to the purpose of the report:
 
   * Drag **Field Condition** to the blank panel on the right.
   * Click **Customer User > Accepted Consents**.
   * Select one or several consents from the list.
 
   .. image:: /admin_guide/img/configuration/customer/consents/accepted_consents_report.png
      :alt: An example of a report with accepted consents

#. Click **Save and Close** on the top right of the page.

Once saved, the newly created report appears on the page of all reports:

.. image:: /admin_guide/img/configuration/customer/consents/consent_report_grid.png
   :alt: The table of all reports with the newly created report with accepted consents 

The report itself lists the names of the customer users who have accepted the required consent:

.. image:: /admin_guide/img/configuration/customer/consents/accepted_consents_report_page.png
   :alt: The page of the report with accepted consents