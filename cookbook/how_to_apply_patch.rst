.. index::
    single: Patch

How to apply patch
==================

The patch file name supports the following naming convention: {package}-{version_to_apply}.patch.
For example, platform-1.9.2.patch.

**1** Create backups of your Database and Code.

**2** Stop the cron tasks

.. code-block:: bash

    $ crontab -e -uwww-data

Comment this line.

.. code-block:: text

     */1 * * * * /usr/bin/php /srv/prod/crm-application/app/console --env=prod oro:cron >> /dev/null

Kill the related processes.

.. code-block:: bash

    $ ps ax|grep php5
    $ kill <process_pid>

<process_pid> - is a PID of currently executing application cron task. For example:

.. code-block:: text

    /path/to/application/app/console jms-job-queue:run --max-runtime=3600 --max-concurrent-jobs=5 --env=prod

**3** "Cd" to the crm root folder and lock the access to your application.

.. code-block:: bash

    $ cd /path/to/crm_folder
    $ sudo -uwww-data app/console lexik:maintenance:lock --env prod

**5** Copy the patch file to the package directory

.. code-block:: text

/path/to/crm_folder/vendor/oro/{package}

So, "platform-1.9.2.patch" file should be copied to "/path/to/crm_folder/vendor/oro/platform".

**6** "cd" to the package folder and execute "patch" command to apply the patch.

.. code-block:: bash

    $ cd /path/to/crm_folder/vendor/oro/{package}
    $ patch -p1 < platform-1.9.2.patch


**7** "Cd" to crm root folder and clear "app/cache" folder.

.. code-block:: bash

    $ cd /path/to/crm_folder

Remove the caches.

.. code-block:: bash

    $ sudo -u www-data app/console cache:clear --env prod

or, as alternative

.. code-block:: bash

    $ sudo rm -rf app/cache/*

**8** Execute  command "oro:platform:update" and clear caches.

.. code-block:: bash

    $ sudo -u www-data php app/console oro:platform:update --env prod --force

Remove the caches.

.. code-block:: bash

    $ sudo -u www-data app/console cache:clear --env prod

or, as alternative

.. code-block:: bash

    $ sudo rm -rf app/cache/*

**9** Warm up the cahes

.. code-block:: bash

    $ sudo -u www-data app/console cache:warmup --env prod

**10** Enable cron.

.. code-block:: bash

    $ crontab -e -uwww-data

Uncomment this line.

.. code-block:: text

    */1 * * * * /usr/bin/php /srv/prod/crm-application/app/console --env=prod oro:cron >> /dev/null

**11** Unlock the access to your application.

.. code-block:: bash

    $ sudo -uwww-data app/console lexik:maintenance:unlock --env prod

