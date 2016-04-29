.. index::
    single: Patch

How to apply patch
==================

The patch file name supports the following naming convention: {package}-{version_to_apply}.patch.
For example, platform-1.9.2.patch.

**1**. ``cd`` to the crm root folder and switch the application to the maintenance mode.

.. code-block:: bash

    $ cd /path/to/application
    $ sudo -uwww-data app/console lexik:maintenance:lock --env prod


**2**. Stop the cron tasks.

.. code-block:: bash

    $ crontab -e -uwww-data


.. note::

    www-data can be changed to user under which your web server runs

Comment this line.

.. code-block:: text

     */1 * * * * /usr/bin/php /path/to/application/app/console --env=prod oro:cron >> /dev/null

Kill the related job daemon process.

.. code-block:: bash

    $ ps ax|grep php5
    $ kill -9 <process_pid>

<process_pid> - is a PID of currently executing application job daemon process. For example:

.. code-block:: text

    /path/to/application/app/console jms-job-queue:run --max-runtime=3600 --max-concurrent-jobs=5 --env=prod

**3**. Create backups of your Database and Code.

**4**. Copy the patch file to the package directory

.. code-block:: text

    /path/to/application/vendor/oro/{package}

So, the "platform-1.9.2.patch" file should be copied to ``/path/to/crm_folder/vendor/oro/platform``.

**5**. To apply the patch, ``cd`` to the package folder and execute ``patch`` command.

.. code-block:: bash

    $ cd /path/to/application/vendor/oro/{package}
    $ patch -p1 < platform-1.9.2.patch


**6**. ``cd`` to crm root folder and clear caches.

.. code-block:: bash

    $ cd /path/to/application

Remove the caches.

.. code-block:: bash

    $ sudo -u www-data app/console cache:clear --env prod

or, as an alternative:

.. code-block:: bash

    $ sudo rm -rf app/cache/*

**7**. Execute the ``oro:platform:update`` command and clear caches.

.. code-block:: bash

    $ sudo -u www-data php app/console oro:platform:update --env prod --force

Remove the caches.

.. code-block:: bash

    $ sudo -u www-data app/console cache:clear --env prod

or, as alternative:

.. code-block:: bash

    $ sudo rm -rf app/cache/*
    $ sudo -u www-data app/console cache:warmup --env prod

**8**. Enable cron.

.. code-block:: bash

    $ crontab -e -uwww-data

Uncomment this line.

.. code-block:: text

    */1 * * * * /usr/bin/php /path/to/application/app/console --env=prod oro:cron >> /dev/null

**9**. Switch your application back to normal mode from the maintenance mode.

.. code-block:: bash

    $ sudo -uwww-data app/console lexik:maintenance:unlock --env prod

.. note::

    If PHP bytecode cache tools (e.g. opcache) are used, PHP-FPM (or Apache web server) should be restarted
    after the uprgade to flush cached bytecode from the previous installation.

