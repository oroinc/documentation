.. index::
    single: Patch

.. _reinstall:

Reinstall
=========

To reinstall your Oro application:

1. Drop the database that was used for the previous installation attempt.
2. Create a new database for new Oro application installation.
3. Empty the *<installation directory>/var/cache/prod* and *<installation directory>/var/cache/session* directories.
4. Clear the Installed option in the *config/parameters.yml* file and update the database name, if necessary.
5. Launch the Oro application installation :ref:`via console in a silent mode <silent-installation>`.

.. note:: The installation process terminates with a warning if the environment does not meet the system requirements. Fix the reported issue(s) and launch the installation again.

If any problem occurs, you can see the details in ``var/logs/oro_install.log`` file.

.. hint:: Normally, the installation process is terminated if it detects an already-existing installation.

.. hint:: After the installation finished remember to run ``php bin/console oro:api:doc:cache:clear`` to warm-up the API documentation cache. This process may take several minutes.

How to Apply Patch
------------------

The patch file name supports the following naming convention: {package}-{version_to_apply}.patch.
For example, platform-1.9.2.patch.

**1**. ``cd`` to the crm root folder and switch the application to the maintenance mode.

.. code-block:: bash
    :linenos:

    $ cd /path/to/application
    $ sudo -u www-data bin/console lexik:maintenance:lock --env=prod


**2**. Stop the cron tasks.

.. code-block:: bash
    :linenos:

    $ crontab -e -u www-data


.. note::

    www-data can be changed to user under which your web server runs

Comment this line.

.. code-block:: text
    :linenos:

     */1 * * * * /usr/bin/php /path/to/application/bin/console --env=prod oro:cron >> /dev/null

**3**. Stop all running consumers.

**4**. Create backups of your Database and Code.

**5**. Copy the patch file to the package directory

.. code-block:: text
    :linenos:

    /path/to/application/vendor/oro/{package}

So, the "platform-1.9.2.patch" file should be copied to ``/path/to/crm_folder/vendor/oro/platform``.

**6**. To apply the patch, ``cd`` to the package folder and execute ``patch`` command.

.. code-block:: bash
    :linenos:

    $ cd /path/to/application/vendor/oro/{package}
    $ patch -p1 < platform-1.9.2.patch


**7**. ``cd`` to crm root folder and clear caches.

.. code-block:: bash
    :linenos:

    $ cd /path/to/application

Remove the caches.

.. code-block:: bash
    :linenos:

    $ sudo -u www-data bin/console cache:clear --env=prod

or, as an alternative:

.. code-block:: bash
    :linenos:

    $ sudo rm -rf var/cache/prod

**8**. Execute the ``oro:platform:update`` command and clear caches.

.. code-block:: bash
    :linenos:

    $ sudo -u www-data php bin/console oro:platform:update --env=prod --force

Remove the caches.

.. code-block:: bash
    :linenos:

    $ sudo -u www-data bin/console cache:clear --env=prod

or, as alternative:

.. code-block:: bash
    :linenos:

    $ sudo rm -rf var/cache/prod
    $ sudo -u www-data bin/console cache:warmup --env=prod

**9**. Run the consumer(s).

.. code-block:: bash
    :linenos:

    $ sudo -u www-data bin/console oro:message-queue:consume --env=prod

**10**. Enable cron.

.. code-block:: bash
    :linenos:

    $ crontab -e -u www-data

Uncomment this line.

.. code-block:: text
    :linenos:

    */1 * * * * /usr/bin/php /path/to/application/bin/console --env=prod oro:cron >> /dev/null

**11**. Switch your application back to normal mode from the maintenance mode.

.. code-block:: bash
    :linenos:

    $ sudo -u www-data bin/console lexik:maintenance:unlock --env=prod

.. note::

    If PHP bytecode cache tools (e.g. opcache) are used, PHP-FPM (or Apache web server) should be restarted
    after the uprgade to flush cached bytecode from the previous installation.
