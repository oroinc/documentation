.. _post-install:

Perform Post-Install Configuration
==================================

Activate Background Tasks
-------------------------

To launch scheduled execution of the operations required by the Oro application, set up a
cron command with the `oro:cron` CLI command as an application entry point (see the sample configuration below).

.. code-block:: text

    */1 * * * * /path/to/php [$folder_location]/orocommerce/app/console oro:cron --env=prod > /dev/null

.. seealso::

    You can also create your own commands that are executed in the background at certain times.
    Read more about it in the :ref:`chapter about executing cron commands <book-time-based-command-execution>`.

.. TODO fix link, replace crm link with the platform one when the cron is migrated into the shared space

Time consuming or blocking tasks should usually be performed in the background to avoid negative impact on the application response time. For example, OroPlatform uses the `MessageQueueComponent`_
together with `MessageQueueBundle`_ to asynchronously run maintenance tasks. Ensure that one or more consumers are always running:

.. code-block:: text

    /path/to/php [$folder_location]/orocommerce/app/console oro:message-queue:consume --env=prod > /dev/null

.. important::

   To ensure that required number of consumers keeps running, set up a supervisor.
    Here is `example of supervisord configuration`_.

.. note::

   If a socket server is running, it checks periodically whether consumers are alive. If no consumers are alive, a flash message notification appears informing users about the consumers' state. The same check is performed upon a user logging in.

.. include:: /install_upgrade/installation/vars.rst
   :start-after: begin_vars
