.. _orocloud-usage:

Basic Usage
===========

Once you are connected to the OroCloud server, you can run a series of maintenance commands.

Commands List
-------------

To list available OroCloud maintenance management commands, run `orocloud-cli` without parameters.

To get the current environment version, run `orocloud-cli --version` and use the major version.

.. warning:: OroCloud maintenance commands may affect application performance. Please use them with extreme care and contact the OroCloud or Oro Support team for any questions.


Logs
----

List Logs
~~~~~~~~~

.. code-block:: none

   orocloud-cli log:list

The command output is similar to the following:

.. code-block:: none

    ------ ------------- ----------------- 
    Logs   Page 1 of 4   Rows 1-25 of 91  
    ------ ------------- ----------------- 
    +---------------------+------+-----------------------------------------------------------------------+-----------------+---------+----------------------------+
    | Date                | User | Command                                                               | Result          | Took    | Identifier                 |
    +---------------------+------+-----------------------------------------------------------------------+-----------------+---------+----------------------------+
    | 2024-08-14 14:15:30 | user | app:package:update 6.0.2 6.0.2-20240901 -vvv --label=Reference: 6.0.2 | Completed       | 15m 15s | 01J58KWT7FR0BZFXZARBD0PVNN |


View Logs
~~~~~~~~~

To view a log, use a log identifier from `orocloud-cli log:list`

.. code-block:: none

    orocloud-cli log:view 01J58KWT7FR0BZFXZARBD0PVNN

The command output is similar to the following:

.. code-block:: none

        $ orocloud-cli app:package:update 6.0.2 6.0.2-20240901 -vvv --label=Reference: 6.0.2
        $ Cloning repository 
        $ git -C /source init
        hint: Using 'master' as the name for the initial branch. This default branch name
        hint: is subject to change. To configure the initial branch name to use in all
        hint: of your new repositories, which will suppress this warning, call:
        hint: 
        hint:   git config --global init.defaultBranch <name>
        hint: 
        hint: Names commonly chosen instead of 'master' are 'main', 'trunk', and
        hint: 'development'. The just-created branch can be renamed via this command:
        hint: 
        hint:   git branch -m <name>
        Initialized empty Git repository in /source/.git/

Locks
-----

Any time the `orocloud-cli` command runs with any argument or options, `orocloud-cli` is locked to prevent its simultaneous execution.
This is required to avoid cases when different users execute commands that may lead to environment corruption, e.g., when different users run `app:package:deploy` and `app:package:upgrade` at the same time.
If this happens, a warning message is displayed.

As an example:

.. code-block:: none

    [WARNING] Another command is running: "orocloud-cli app:package:deploy" by some user

Secrets
-------

Environment variables with secrets can be configured for application usage, as illustrated below:

.. code-block:: none

    $ orocloud-cli secret:list

    +-------+-------+--------+
    | Name  | Value | Status |
    +-------+-------+--------+
    |     List is empty      |
    +-------+-------+--------+

    $ orocloud-cli secret:set SHELL_VERBOSITY

    Type value:
    > 1

    [OK] Secrets addition pending.

    $ orocloud-cli secret:apply

    All you have to do is confirm the action [No]:
    [y] Yes
    [n] No
    > y
                                                                                                                            
    [OK] Secrets successfully applied.       

    $ orocloud-cli secret:list

    +-----------------+-------+--------+
    | Name            | Value | Status |
    +-----------------+-------+--------+
    | SHELL_VERBOSITY | *     | Ready  |
    +-----------------+-------+--------+

.. admonition:: Business Tip

   Want to know everything on |eCommerce B2B| and understand how it differs from B2C? Read our detailed guide on this topic.

.. include:: /include/include-links-cloud.rst
   :start-after: begin

.. include:: /include/include-links-seo.rst
   :start-after: begin
