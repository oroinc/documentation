.. index::
    single: Patch

How to apply patch
==================

The patch file name supports the following naming convention: {package}-{version_to_apply}.patch.
For example, platform-1.9.2.patch.

**1**. ``cd`` to the crm root folder and switch the application to the maintenance mode.

.. code-block:: bash
    :linenos:

    $ cd /path/to/application
    $ sudo -uwww-data app/console lexik:maintenance:lock --env prod


**2**. Stop the cron tasks.

.. code-block:: bash
    :linenos:

    $ crontab -e -uwww-data


.. note::

    www-data can be changed to user under which your web server runs

Comment this line.

.. code-block:: text
    :linenos:

     */1 * * * * /usr/bin/php /path/to/application/app/console --env=prod oro:cron >> /dev/null

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

    $ sudo -u www-data app/console cache:clear --env prod

or, as an alternative:

.. code-block:: bash
    :linenos:

    $ sudo rm -rf app/cache/prod

**8**. Execute the ``oro:platform:update`` command and clear caches.

.. code-block:: bash
    :linenos:

    $ sudo -u www-data php app/console oro:platform:update --env=prod --force

Remove the caches.

.. code-block:: bash
    :linenos:

    $ sudo -u www-data app/console cache:clear --env prod

or, as alternative:

.. code-block:: bash
    :linenos:

    $ sudo rm -rf app/cache/prod
    $ sudo -u www-data app/console cache:warmup --env prod

**9**. Run the consumer(s).

.. code-block:: bash
    :linenos:

    $ sudo -u www-data app/console oro:message-queue:consume --env prod

**10**. Enable cron.

.. code-block:: bash
    :linenos:

    $ crontab -e -uwww-data

Uncomment this line.

.. code-block:: text
    :linenos:

    */1 * * * * /usr/bin/php /path/to/application/app/console --env=prod oro:cron >> /dev/null

**11**. Switch your application back to normal mode from the maintenance mode.

.. code-block:: bash
    :linenos:

    $ sudo -uwww-data app/console lexik:maintenance:unlock --env prod

.. note::

    If PHP bytecode cache tools (e.g. opcache) are used, PHP-FPM (or Apache web server) should be restarted
    after the uprgade to flush cached bytecode from the previous installation.

