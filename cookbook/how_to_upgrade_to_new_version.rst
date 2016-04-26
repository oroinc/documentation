.. index::
    single: Upgrade

How to Upgrade to a New Version
===============================

1. Checkout from the GitHub Repository
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To retrieve a new version and upgrade your ORO CRM instance, please execute the following steps:

**1** Create backups of your Database and Code.

**2** Stop the cron tasks

.. code-block:: bash

$ crontab -e -uwww-data

Comment this line.

.. code-block:: text

# */1 * * * * /usr/bin/php /srv/prod/crm-application/app/console --env=prod oro:cron >> /dev/null

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

**4** Pull changes from the repository.

.. code-block:: bash

$ sudo -uwww-data git pull
$ sudo -uwww-data git checkout <VERSION TO UPGRADE>

**5** Upgrade the composer dependency and set correct owner to the retrieved files.

.. code-block:: bash

$ sudo php composer.phar install --prefer-dist --no-dev
$ sudo chown www-data:www-data -R ./*

**6** Remove old caches.

.. code-block:: bash

$ sudo -u www-data app/console cache:clear --env prod

or, as alternative

.. code-block:: bash

$ sudo rm -rf app/cache/*

**7** Upgrade the platform.

.. code-block:: bash

$ sudo -u www-data php app/console oro:platform:update --env prod --force

**8** Remove the caches.

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

# */1 * * * * /usr/bin/php /srv/prod/crm-application/app/console --env=prod oro:cron >> /dev/null

**11** Unlock the access to your application.

.. code-block:: bash

$ sudo -uwww-data app/console lexik:maintenance:unlock --env prod


2. Download the Source Code Archive
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To retrieve a new version and upgrade your ORO CRM instance, please execute the following steps:

**1** Create backups of your Database and Code.

**2** Stop the cron tasks

.. code-block:: bash

$ crontab -e -uwww-data

Comment this line.

.. code-block:: text

# */1 * * * * /usr/bin/php /srv/prod/crm-application/app/console --env=prod oro:cron >> /dev/null

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

**4** Download the latest OroCRM version from the `download section`_ on `orocrm.com <http://www.orocrm.com/>`_ , unpack
      archive and overwrite existing system files.

**5** Upgrade the composer dependency and set correct owner to the retrieved files.

.. code-block:: bash

$ sudo php composer.phar install --prefer-dist --no-dev
$ sudo chown www-data:www-data -R ./*

**6** Remove old caches.

.. code-block:: bash

$ sudo -u www-data app/console cache:clear --env prod

or, as alternative

.. code-block:: bash

$ sudo rm -rf app/cache/*

**7** Upgrade the platform.

.. code-block:: bash

$ sudo -u www-data php app/console oro:platform:update --env prod --force

**8** Remove the caches.

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

# */1 * * * * /usr/bin/php /srv/prod/crm-application/app/console --env=prod oro:cron >> /dev/null

**11** Unlock the access to your application.

.. code-block:: bash

$ sudo -uwww-data app/console lexik:maintenance:unlock --env prod

.. _`download section`: http://www.orocrm.com/download
