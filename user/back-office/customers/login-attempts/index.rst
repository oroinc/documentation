:oro_documentation_types: OroCommerce

.. _user-guide--customers--customer-login-attempts:

Customer User Login Attempts
============================

To simplify investigation of any security-related incidents, the administrator can check the successful and unsuccessful
login attempts of customer users.

The login info data is stored in the database and in the logs in the **security** log channel. The logs have the ID parameter used in the database to enable you to find a particular log item quickly.

The list of all customer user login attempts is available under **Customers > Customer User Login Attempts** in the main back-office menu. 

.. image:: /user/img/customers/login_attempts/login_attempts.png
   :alt: Customer User Login Attempts

The administrator can also open this list directly from the customer user view page by clicking on the link with the date of the  last login:

.. image:: /user/img/customers/login_attempts/customer_user_view_page.png
   :alt: Link to Customer User Login Attempts on View Page

In this case, the data in datagrid will be filtered by this customer user:

.. image:: /user/img/customers/login_attempts/filtered_login_attempts.png
   :alt: Filtered Customer User Login Attempts

.. include:: /include/include-images.rst
   :start-after: begin
