:oro_documentation_types: OroCRM, OroCommerce

.. _export-records:

Export Records
==============

You might need to export the necessary information and download it as a .csv file to reuse it in the third-party systems. You can export customer data (accounts, contacts, customers, customer users, business customers), sales data (leads, opportunities, prices in the price list, products), taxes (rates, rules), warehouse, and inventory information (inventory levels and statuses).

Another scenario for using export is when you plan bulk data update that is easily automated in the spreadsheet software (e.g. raise the price by 20%).

To export the necessary records (e.g., customer information) in a .csv format:

1. In the main menu, navigate to menu item to export the list of the necessary data (e.g., **Customers > Customers**).

   The following screen opens.

   .. image:: /user/img/getting_started/records/export_1.png
      :alt: Highlight the Export button on the record's details page

2. Click **Export** on the top right.

.. hint:: You may receive the following warning message which notifies you about the limits for the number of columns that can be exported. Such warning can be displayed on the listing page of any exportable entity.

            +------------------------------------------------------------------------------------------------------------------------------+
            | It appears that the number of fields stored as columns in the X table (the fields that are relations or that have ever been  |
            | marked as "A", "B", "C") has approached the limit after which it may no longer be possible to export Y with the standard X   |
            | export.                                                                                                                      |
            +------------------------------------------------------------------------------------------------------------------------------+

            Once 90% of the limit is reached, you will receive a flash message with the related warning.

            Reaching 100% of the limit triggers a warning message on a potential inactive export when clicking the Export button.


3. Once export is complete, you will receive an email to download the .csv file.

.. note:: Keep in mind that by clicking **Export** you download all records of the selected entity regardless of the filters applied to the grid. To export only the list of filtered records, use the **Export Grid** functionality where it is available.



         .. image:: /user/img/getting_started/export_import/export_grid_leads.png
            :alt: Highlight the Export Grid button

