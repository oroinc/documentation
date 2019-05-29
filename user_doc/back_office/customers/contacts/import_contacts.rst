.. _import-contacts:

Import Contacts
===============

.. start

**Import File** option helps import a large bulk of contact information into the contact list using the .csv file.

**Example of contact bulk import template**

.. container:: scroll-table

   .. csv-table::
      :header: "ID","Name prefix","First name","Last name","Gender", "Birthday", "Owner Username"
      :widths: 5, 10, 15, 15, 15, 10, 10

      111, "Mr.", "Jerry", "Coleman", "male", "03-07-1973", "james.valenzuela"

To import a bulk of contacts:

1. In the main menu, navigate to **Customers > Contacts**. The contact list opens.

2. Click **Import File** on the top right.

3. Click **Choose File** and select the .csv file you prepared.

4. Click **Export Template** to download a sample .csv file with the necessary headers.

5. **Prepare data for import**: Based on the downloaded file, create your bulk information in the .csv format. Once your file is ready, click **Choose File** and select the prepared comma-separated values (.csv) file.

6. Select the strategy for uploading the file:

   * **Add and Replace** strategy overrides the existing contact information with the new one from the imported file.

   * **Add** strategy adds new contacts from the .csv file to the existing list.

   .. image:: /user_doc/img/customers/contacts/import_contacts.png

7. **Validate import results**: Click **Validate** to check your import results. If there are any *Records with errors*, fix them in the .csv file before starting the import.

8. **Launch import:** After successful validation, click **Import File**.

9. Click **Cancel** to decline the import.

.. important:: Interactive status messages inform about the import progress, and once the import is complete, the changes are reflected in the list upon refresh. Additionally, an email message with the import status is delivered to your mailbox.

Follow the on-screen guidance for any additional actions. For example, for the inventory template, select one of the options: a) inventory statuses only or b) detailed inventory levels.

.. raw:: HTML

   <iframe width="560" height="315" src="https://www.youtube.com/embed/shpqpFao6bA" frameborder="0" allowfullscreen></iframe>


.. finish