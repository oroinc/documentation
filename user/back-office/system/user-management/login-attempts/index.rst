:oro_documentation_types: OroCRM, OroCommerce
:oro_show_local_toc: false

.. _user-guide-user-management-login-attempts:

Login Attempts
==============

.. note::
    The feature available starting from platform version 5.0.3.

To simplify investigation of any security-related incidents, the administrator can check the successful and unsuccessful
login attempts.

The login info data is stored in the database and in the logs in the **security** log channel. The logs have the ID parameter used in the database to enable you to find a particular log item quickly.

The list of all login attempts is available under **System > User Management > Login Attempts** in the main back-office menu. 

.. image:: /user/img/system/user_management/login_attempts/login_attempts.png
   :alt: Login Attempts

The administrator can also open this list directly from the customer user view page by clicking on the link with the date of the  last login:

.. image:: /user/img/system/user_management/login_attempts/user_view_page.png
   :alt: Link to Login Attempts on View Page

In this case, the data in datagrid will be filtered by this user:

.. image:: /user/img/system/user_management/login_attempts/filtered_login_attempts.png
   :alt: Filtered Login Attempts

.. include:: /include/include-images.rst
   :start-after: begin
