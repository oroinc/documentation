User Impersonation
==================

.. contents:: :local:
    :depth: 3


Overview
----------

There are situations when a developer needs to log in into the system on behalf of a user. For example, the developer may want to check whether a customized feature works as intended. Such need mostly arises when a user reports a bug and the developers need to ensure firsthand that the reported issue really exists and that everything works smoothly when they have fixed it.

In this case, the regular way of logging into the system using the login and the password has a stumbling point: the user would have to share their credentials with the developer. For one thing, this is not a safe operation for a user, as there is a risk of compromising credentials each time they are sent over Internet. For another, it is inconvenient for the developer who cannot start troubleshooting the issue immediately and has to wait for the user to share their credentials. It becomes even more troublesome, if the developer needs to check accounts of several users.  


Oro developers can use another approach known as user impersonation, which considerably facilitates troubleshooting. With the help of this approach, the developer uses a special link to log into the system on behalf of a user. The link contains a token that grants access to the system. 



Generate an Impersonation Link
------------------------------

.. important::
	To generate an impersonation link a developer must have access to the Oro application server environment and the command line. 



     
In the php console, execute the ``oro:user:impersonate <username>`` command, where <username> is the username of the user you want to impersonate. For example, if you want to impersonate the **johndoe** user, execute:

    .. code-block:: bash

    	$ php app/console oro:user:impersonate johndoe
 
After code execution, you will see the impersonation link in the console:

    .. code-block:: bash

    	http://crm-enterprise.example.com/?_impersonation_token=86d6006830b8bbf13493beb45222001fb10970b4 


Use this link to log into the system. You can also share this token with another developer (who, for example, does not have access to the system console and thus cannot generate the link for themselves). 

The link consists of the application URL specified in the **Application Settings** and a query string that specifies an acces token.


|

.. image:: ./img/user_impersonation/impersonate_url.png 

|

There is no possibility to generate a token from any external sources, only the php command line must be used. 

.. important::
  The link can be used once only. Upon an attempt to use it again you will see the **Login** page with the 'Impersonation token is already used' message. Should you require to log into the system on behalf of this user a number of times, generate several links. 

  When the token expires, you will see the **Login** page with the 'Impersonation token has expired' message on it.

.. note::      	
  By default, each impersonation link is valid for one day. You can generate links that will be valid for longer or shorter periods as well as change other link parameters. For how to do this, see the following Impersonation Link Options section.


Impersonation Command Options
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This section describes the most popular options.  
To check all possible options, execute the ``oro:user:impersonate -h`` command in the php console.

   .. code-block:: bash

    	$ php app/console oro:user:impersonate -h


Limit the Link Lifetime
"""""""""""""""""""""""

By default, links expire in one day. If you want the link to be valid for an hour or, vice versa, a month, use the ``-t`` parameter. 

Your command will look the following way: ``oro:user:impersonate -t<numberofseconds> <username>``. 

   .. code-block:: bash

    	$ php app/console oro:user:impersonate -t3600 johndoe


You can also specify the time in the format that the strtotime() php parser can translate into Unix timestamp. This can be a wide range of English textual datetimes. You can check the examples at http://www.w3schools.com/php/func_date_strtotime.asp, http://php.net/manual/en/datetime.formats.time.php, and http://php.net/manual/en/datetime.formats.date.php.   

   .. code-block:: bash

    	$ php app/console oro:user:impersonate -t"1 month" johndoe


Impersonate a User in the Silent Mode
"""""""""""""""""""""""""""""""""""""

By default, the system automatically notifies a user when someone impersonates them.


However, you can choose to impersonate the user in the *silent* mode, that is without sending them a notification about the fact of impersonation. For this, use the ``-S`` parameter. 


Your command will look the following way: ``oro:user:impersonate -S <username>``.

   .. code-block:: bash

    	$ php app/console oro:user:impersonate -S johndoe





Find a Required User
--------------------

List Enabled Users
^^^^^^^^^^^^^^^^^^^

If you want to impersonate a user but you do not have a username (for example, you have a username of the user that you are troubleshooting, but you also want to check whether everything works OK for other users of the same business unit), you can check what users exist in the system via the console.  

In the php console, execute the ``oro:user:list`` command.

   .. code-block:: bash

      $ php app/console oro:user:list

This command generates a list of all users with the **Enabled** status. You will see a table that shows user IDs, usernames, statuses, first and last names, and roles.

   .. code-block:: bash
     
	+----+--------------------------+-----------------------+-------------+-----------+-------------------+
	| ID | Username                 | Enabled (Auth Status) | First Name  | Last Name | Roles             |
	+----+--------------------------+-----------------------+-------------+-----------+-------------------+
	| 1  | admin                    | Enabled (Active)      | John        | Doe       | Administrator     |
	| 2  | sale123                  | Enabled (Active)      | Ellen       | Rowell    | Sales Manager     |
	| 3  | mbuckley                 | Enabled (Active)      | Michael     | Buckley   | Marketing Manager |
	+----+--------------------------+-----------------------+-------------+-----------+-------------------+ 


This list is paginated, by default 20 users are shown on each page. To see a particular page, use the ``-p<page_number>`` parameter. 
For example, to see page 2, execute: 

   .. code-block:: bash

      $ php app/console oro:user:list -p2


You can limit the number of users displayed on each page. For this, use the ``-l<number_of_users>`` parameter. 
For example, to see 10 users per page, execute: 

   .. code-block:: bash

      $ php app/console oro:user:list -l10

You can use the same parameter to see all users in the system on one page. For this, specify the number of pages as ``-1``:


   .. code-block:: bash

      $ php app/console oro:user:list -l-1


To check all possible options, execute the ``oro:user:list -h`` command in the php console.

   .. code-block:: bash
   
    	$ php app/console oro:user:list -h

List All Users
^^^^^^^^^^^^^^^^

By default, the ``oro:user:list`` command shows only users with the **Enabled** status.  
To include users with the **Disabled** status as well, use the ``-a`` parameter:

   .. code-block:: bash
   
      $ php app/console oro:user:list -a
      
      
You will see all users that exist in the system.       

Find Users with a Specific Role
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To see only the users with a specific role, use the ``-r"<role_name>"`` parameter. For example, to see users with the **Marketing Manager** role, execute:

   .. code-block:: bash

      $ php app/console oro:user:list -r"Marketing Manager"
      
      
You can specify multiple roles:

   .. code-block:: bash
   
    	$ php app/console oro:user:list -r"Marketing Manager" -r"Sales Manager"


Other Listing Command Options
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To check all possible options, execute the ``oro:user:list -h`` command in the php console.

   .. code-block:: bash
   
    	$ php app/console oro:user:list -h



Notify a User
-------------

Notification Email
^^^^^^^^^^^^^^^^^^

When someone uses the impersonation link, a user receives a notification email:

|

.. image:: ./img/user_impersonation/impersonate_notification_email.png 

|

This helps avoid surprises when the user notices that something has changed in the system but cannot figure out why this has happened. Additionally, such email can instruct the user to contact the system administrator if they noticed suspicious activity, thus preventing possible fraud.

The default notification email template is **user_impersonate**. It can be found on the **All Templates** page of your Oro application (**System>Emails>Templates**).


This behavior can be overridden if you select the silent mode when generating the impersonation link. (See the `Impersonate a User in the Silent Mode <./user-impersonation#impersonate-a-user-in-the-silent-mode>`__ section.) 


Data Audit
^^^^^^^^^^^

If a developer who impersonates a user makes changes in OroCRM on behalf of the user, these changes are marked accordingly in the **Data Audit** section of the system and in the change history of the corresponding entity record:


|

.. image:: ./img/user_impersonation/impersonate_dataaudit.png 

|


.. image:: ./img/user_impersonation/impersonate_changehistory.png 

|
