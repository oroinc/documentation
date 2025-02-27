.. _orocloud-manage-maintenance-mode:

.. important:: You are viewing the upcoming documentation for OroCloud, scheduled for release later in 2025. For accurate and up-to-date information, please refer only to the documentation of |the latest LTS version|.

How to Manage Maintenance Mode
==============================

.. Scheduling Maintenance Mode
.. ---------------------------

.. Oro Support Team will get a P1 notification after 1 hour of enabled maintenance mode.
.. You can set custom maintenance mode duration and comment to avoid P1 escalation using the following options:

.. .. code-block:: none

..     --maintenance-mode-duration[=MAINTENANCE-MODE-DURATION]  (OPTIONAL) Maintenance mode duration, by default 1 hour. Expected format: '{number}d{number}h{number}m'. Usage example: '1d3h15m' means 1 day 3 hours 15 minutes OR '30m' means 30 minutes.
..     --maintenance-mode-comment[=MAINTENANCE-MODE-COMMENT]    Comment for provided custom maintenance mode value. Required if [--maintenance-mode-duration] provided. Wrap with double-quotes if contains spaces.

Maintenance Commands
--------------------

Maintenance commands enable you to turn on the maintenance mode for the webserver and services (consumers, cron, websocket).

Maintenance On
^^^^^^^^^^^^^^

To enable maintenance mode for the webserver and services (consumers, cron, websocket), use the `maintenance:on` command.


.. code-block:: none

    maintenance:on

Maintenance Off
^^^^^^^^^^^^^^^

To disable maintenance mode for the webserver and services (consumers, cron, websocket), use the `maintenance:off` command.

.. code-block:: none

    maintenance:off

Emergency Commands
------------------

Emergency commands enable you to turn the maintenance mode for the webserver without stopping services.

Emergency On
^^^^^^^^^^^^

The idea behind this command is that it does not block the infrastructure from changes that are rolling out continuously (unlike when you turn on the usual maintenance where the infrastructure is blocked from rolling out changes).

To enable emergency mode for the webserver without stopping services, use the `emergency:on` command.

.. code-block:: none

    emergency:on

Emergency Off
^^^^^^^^^^^^^

To disable emergency mode for the webserver, use the `emergency:off` command.

.. code-block:: none

    emergency:off

.. include:: /include/include-links-cloud.rst
   :start-after: begin