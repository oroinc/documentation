.. _system-information:

View System Information in the Back-Office
==========================================

The system information page provides users with detailed insights into various aspects of the system, including metrics on products and sales orders, as well as an inventory of installed packages and third-party packages. This feature is useful for system administrators, integrators, developers, and users who require a clear understanding of the system's current state and its components.

To view the system information,

1. Navigate to **System > System Information** in the main menu.

.. image:: /user/img/system/system_info/system_information.png
   :alt: The default product options details page


2. The **Application Usage** section is available as of OroCommerce version 6.0.2 and displays the following details:

   * **Products** --- The total number of products in the database (for single-organization applications) or the total number of products within the selected organization (for multi-organization applications).
   * **Back-Office Users** --- The total number of back-office users in the database (for single-organization applications) or the total number of back-office users within the selected organization (for multi-organization applications). The number is calculated based on the organization that the user belongs to, determined by entity ownership.
   * **Revenue** --- The table with information about orders revenue grouped by order statuses and order currency. Data limited from the license start date (or from the start of the year if license start was not specified) to current date.

   .. hint:: The number DOES NOT include sub-orders. Available only in enterprise

   * **Revenue In Previous Period** --- The table with information about orders revenue grouped by order statuses and order currency. Data limited from the license start date (or from the start of the year if license start was not specified) minus 1 year to license start date (or from the start of the year if license start was not specified).

   .. hint:: The number DOES NOT include sub-orders. Available only in enterprise

3. The **Deployment** section displays the type of the environment deployment.

4. The **Packages** section displays the current versions and licenses of the application you are running, as well as other installed packages.
