.. _bundle-docs-platform-security-bundle-example:

Access Levels and Ownership (Example)
=====================================

The following sections provide some insight on how the ACL checks work. It is assumed that there
are two organizations, *Main Organization* and *Second Organization*. The *Main Organization*
contains the *Main Business Unit*, *Second Organization* contains *Second Business Unit*.
*Child Business Unit* is a subordinate of *Second Business Unit*. Additionally, the following users
have been created:

+--------+-------------------------+--------------------------+------------------------+
| User   | Created in Organization | Created in Business Unit | Assigned to            |
+========+=========================+==========================+========================+
| John   | Main Organization       | Main Business Unit       | - Main Business Unit   |
|        |                         |                          | - Child Business Unit  |
+--------+-------------------------+--------------------------+------------------------+
| Mary   | Main Organization       | Main Business Unit       | - Main Business Unit   |
|        |                         |                          | - Second Business Unit |
+--------+-------------------------+--------------------------+------------------------+
| Mike   | Second Organization     | Child Business Unit      | - Child Business Unit  |
+--------+-------------------------+--------------------------+------------------------+
| Robert | Second Organization     | Second Business Unit     | - Main Business Unit   |
|        |                         |                          | - Second Business Unit |
+--------+-------------------------+--------------------------+------------------------+
| Mark   | Second Organization     | Second Business Unit     |                        |
+--------+-------------------------+--------------------------+------------------------+

User Ownership
~~~~~~~~~~~~~~

Imagine that each user created two accounts (one in *Main Organization* and one in *Second
Organization*):

==========  =================  ===================
Created by  Main Organization  Second Organization
==========  =================  ===================
John        Account A          Account E
Mary        Account B          Account F
Mike        Account G          Account C
Robert      Account H          Account D
Mark        Account I          Account J
==========  =================  ===================

.. image:: /developer/img/backend/security/user-ownership.png

The users can now access the accounts depending on the organization context they login into as
described below:

John
....

+---------------+-------------------+---------------------+
| Access Level  | Main Organization | Second Organization |
+===============+===================+=====================+
| User          | - Account A       | - Account E         |
+---------------+-------------------+---------------------+
| Business Unit | - Account A       | - Account E         |
|               | - Account B       | - Account C         |
|               | - Account H       |                     |
+---------------+-------------------+---------------------+
| Division      | - Account A       | - Account E         |
|               | - Account B       | - Account C         |
|               | - Account H       |                     |
+---------------+-------------------+---------------------+
| Organization  | - Account A       | - Account E         |
|               | - Account B       | - Account C         |
|               | - Account H       | - Account D         |
|               | - Account G       | - Account F         |
|               | - Account I       | - Account J         |
+---------------+-------------------+---------------------+

Mary
....

+---------------+-------------------+---------------------+
| Access Level  | Main Organization | Second Organization |
+===============+===================+=====================+
| User          | - Account B       | - Account F         |
+---------------+-------------------+---------------------+
| Business Unit | - Account B       | - Account F         |
|               | - Account A       | - Account D         |
|               | - Account H       |                     |
+---------------+-------------------+---------------------+
| Division      | - Account B       | - Account F         |
|               | - Account A       | - Account D         |
|               | - Account H       | - Account C         |
|               |                   | - Account E         |
+---------------+-------------------+---------------------+
| Organization  | - Account B       | - Account F         |
|               | - Account A       | - Account D         |
|               | - Account H       | - Account C         |
|               | - Account G       | - Account E         |
|               | - Account I       | - Account J         |
+---------------+-------------------+---------------------+

Mike
....

The user Mike cannot login into the *Main Organization*.

+---------------+---------------------+
| Access Level  | Second Organization |
+===============+=====================+
| User          | - Account C         |
+---------------+---------------------+
| Business Unit | - Account C         |
|               | - Account E         |
+---------------+---------------------+
| Division      | - Account C         |
|               | - Account E         |
+---------------+---------------------+
| Organization  | - Account C         |
|               | - Account E         |
|               | - Account D         |
|               | - Account F         |
|               | - Account J         |
+---------------+---------------------+

Robert
......

+---------------+-------------------+---------------------+
| Access Level  | Main Organization | Second Organization |
+===============+===================+=====================+
| User          | - Account H       | - Account D         |
+---------------+-------------------+---------------------+
| Business Unit | - Account H       | - Account D         |
|               | - Account A       | - Account F         |
|               | - Account B       | - Account E         |
+---------------+-------------------+---------------------+
| Division      | - Account H       | - Account D         |
|               | - Account A       | - Account F         |
|               | - Account B       | - Account E         |
|               |                   | - Account C         |
+---------------+-------------------+---------------------+
| Organization  | - Account H       | - Account D         |
|               | - Account A       | - Account F         |
|               | - Account B       | - Account E         |
|               | - Account G       | - Account C         |
|               | - Account I       | - Account J         |
+---------------+-------------------+---------------------+

Mark
....

The user Mark cannot login into the *Main Organization*.

+---------------+---------------------+
| Access Level  | Second Organization |
+===============+=====================+
| User          | - Account J         |
+---------------+---------------------+
| Business Unit | - Account J         |
+---------------+---------------------+
| Division      | - Account J         |
+---------------+---------------------+
| Organization  | - Account J         |
|               | - Account F         |
|               | - Account E         |
|               | - Account C         |
|               | - Account D         |
+---------------+---------------------+

Business Unit Ownership
~~~~~~~~~~~~~~~~~~~~~~~

When the ownership type is *"Business Unit"*, access cannot be granted on the user level. The
minimum acccess level is the Business Unit level.

Imagine that the following data has been created:

=========  ===================  ===============
Account    Organization         Business Unit
=========  ===================  ===============
Account A  Main Organization    Business Unit A
Account B  Main Organization    Business Unit A
Account C  Second Organization  Business Unit C
Account D  Second Organization  Business Unit B
Account E  Second Organization  Business Unit B
=========  ===================  ===============

.. image:: /developer/img/backend/security/business-unit-ownership.png

The users can now access the accounts as described below:

John
....

+---------------+-------------------+---------------------+
| Access Level  | Main Organization | Second Organization |
+===============+===================+=====================+
| Business Unit | - Account A       | - Account C         |
|               | - Account B       |                     |
+---------------+-------------------+---------------------+
| Division      | - Account A       | - Account C         |
|               | - Account B       |                     |
+---------------+-------------------+---------------------+
| Organization  | - Account A       | - Account C         |
|               | - Account B       | - Account D         |
|               |                   | - Account E         |
+---------------+-------------------+---------------------+

Mary
....

+---------------+-------------------+---------------------+
| Access Level  | Main Organization | Second Organization |
+===============+===================+=====================+
| Business Unit | - Account A       | - Account D         |
|               | - Account B       | - Account E         |
+---------------+-------------------+---------------------+
| Division      | - Account A       | - Account D         |
|               | - Account B       | - Account E         |
|               |                   | - Account C         |
+---------------+-------------------+---------------------+
| Organization  | - Account A       | - Account D         |
|               | - Account B       | - Account E         |
|               |                   | - Account C         |
+---------------+-------------------+---------------------+

Mike
....

The user Mark cannot login into the *Main Organization*.

+---------------+---------------------+
| Access Level  | Second Organization |
+===============+=====================+
| User          | - Account J         |
+---------------+---------------------+
| Business Unit | - Account J         |
+---------------+---------------------+
| Division      | - Account J         |
+---------------+---------------------+
| Organization  | - Account J         |
|               | - Account F         |
|               | - Account E         |
|               | - Account C         |
|               | - Account D         |
+---------------+---------------------+

Robert
......

+---------------+-------------------+---------------------+
| Access Level  | Main Organization | Second Organization |
+===============+===================+=====================+
| Business Unit | - Account A       | - Account C         |
|               | - Account B       |                     |
+---------------+-------------------+---------------------+
| Division      | - Account A       | - Account C         |
|               | - Account B       |                     |
+---------------+-------------------+---------------------+
| Organization  | - Account A       | - Account C         |
|               | - Account B       | - Account D         |
|               |                   | - Account E         |
+---------------+-------------------+---------------------+

Mark
....

The user Mark cannot login into the *Main Organization*.

+---------------+---------------------+
| Access Level  | Second Organization |
+===============+=====================+
| User          | - Account J         |
+---------------+---------------------+
| Business Unit | - Account J         |
+---------------+---------------------+
| Division      | - Account J         |
+---------------+---------------------+
| Organization  | - Account J         |
|               | - Account F         |
|               | - Account E         |
|               | - Account C         |
|               | - Account D         |
+---------------+---------------------+

Organization Ownership
~~~~~~~~~~~~~~~~~~~~~~

When the ownership type is *"Organization"*, access cannot be granted on the user level, the
business level or the division level. The minimum acccess level is the Organization level.

Imagine that the following data has been created:

=========  ===================
Account    Organization
=========  ===================
Account A  Main Organization
Account B  Main Organization
Account C  Second Organization
Account D  Second Organization
Account E  Second Organization
=========  ===================

.. image:: /developer/img/backend/security/organization-ownership.png

The users can now access the accounts as described below:

John, Mary, Robert
..................

+--------------+-------------------+---------------------+
| Access Level | Main Organization | Second Organization |
+==============+===================+=====================+
| Organization | - Account A       | - Account C         |
|              | - Account B       | - Account D         |
|              |                   | - Account E         |
+--------------+-------------------+---------------------+

Mike, Mark
..........

The users cannot login into the *Main Organization*.

+--------------+---------------------+
| Access Level | Second Organization |
+==============+=====================+
| Organization | - Account C         |
|              | - Account D         |
|              | - Account E         |
+--------------+---------------------+