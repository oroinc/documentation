.. _admin-login-audit:

Audit of Login Attempts
-----------------------

.. note:: This is a Platform Enterprise feature.

To simplify investigation of any security-related incidents, the application keeps track of all management console login attempts and the following related security events:

* Successful login
* Unsuccessful login
* Account is locked
* Autodeactivation email has been sent
* Reset password email has been sent

The log is stored in the database in the *oro_logger_log_entry* table.

.. image:: /admin_guide/img/audit_login/oro_logger_log_entry.png
   :alt: Record login details in a database table

In addition to the type of the security event, the following details are recorded in the table:

* user ID
* username
* email
* full name
* user status (enabled or disabled)
* last login date and time
* user creation date and time
* IP address


