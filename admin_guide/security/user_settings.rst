
.. _admin-configuration-user-settings:

User settings
=============


In **System>Configuration>System Configuration>General Setup>User Settings**, you can define the user-related options to be applied to your OroCRM instance.

|

.. image:: ../img/configuration/user.png

|

Password Restrictions
---------------------

.. csv-table::
  :header: "Option", "Description"
  :widths: 10, 30 

  "**MinimalPassword Length**","Enter the number of characters to define the length of the password. By default, 8 is specified"
  "**Require a Number**","Specify whether the password should contain a number. By default, the option is enabled."
  "**Require A Lower Case Letter**","Specify whether the password should contain a lower case letter. By default, the option is enabled"
  "**Require An Upper Case Letter**","Specify whether the password should contain an upper case letter. By default, the option is enabled"
  "**Require A Special Character**","Specify whether the password should contain special characters: !""#$%&'()*+-,./:;<=>?@[\]^_`{|}~ and space. By default, the option is disabled"



Login Attempts
--------------

.. csv-table::
  :header: "Option", "Description" 
  :widths: 10, 30 

  "**Enable Failed logins Limit**","Specify whether you wish to enable failed logins limit. By default, the option is enabled."
  "**Max Login Attempts**","Specify the maximum number of failed login attempts. By default, the number is set to 10."

Password Change Policy
----------------------

.. csv-table::
  :header: "Option", "Description"
  :widths: 10, 30 

  "**Enable Password Change Policy**","Enable this option to mandate your users to change their passwords after a certain period. The option is disabled by default."
  "**Maximum Password Age (Days)**","Specify the period of maximum password validity in days. By default, the number is set to 30."
  "**Enable Password History Policy**","This setting determines the number of unique new passwords that must be associated with a user account before an old password can be reused. The option is disabled by default."
  "**Enforce Password History**","The number of previous user passwords which the new password cannot match. The number is set to 12 by default."

Two-factor Authentication
-------------------------

.. csv-table::
  :header: "Option", "Description" 
  :widths: 10, 30 

  "**Security Level**","Determines how often to require authentication via email: never, upon first login from a new computer, or at every login.

  |

  .. image:: ../img/configuration/authentication.png

  |

  The option is disabled by default."
  "**Code Validity Period**","This option determines how long the authentication code will be valid. If not used within the validity period, the code expires and the user must log in again. By default, the option is set to 1 hour."
  "**Code Length**","This option determines the number of characters in authentication code. By default, the option is set to 6."
