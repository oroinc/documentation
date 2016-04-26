.. index::
    single: Upgrade

How to upgrade to new version
==============================

1. Checkout from the GitHub Repository
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To retrieve new version and upgrade your ORO CRM instance, please execute the next steps:

**1** Create backups of your Database and Code.

**2** Pull changes from repository

.. code-block:: bash
git pull
git checkout <VERSION TO UPGRADE>

**3** Upgrade composer dependency

.. code-block:: bash
php composer.phar install --prefer-dist --no-dev

**4** Remove old caches and assets

.. code-block:: bash
rm -rf app/cache/*
rm -rf web/js/*
rm -rf web/css/*

**5** Upgrade platform

.. code-block:: bash
php app/console oro:platform:update --env=prod --force

2. Download the Source Code Archive
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To retrieve new version and upgrade your ORO CRM instance, please execute the next steps:

**1** Create backups of your Database and Code.

**2** Download the latest OroCRM version from the `download section`_ on `orocrm.com <http://www.orocrm.com/>`_ , unpack
      archive and overwrite existing system files.

**3** Clear the "vendor" folder

.. code-block:: bash
rm -rf vendor/*

**4** Upgrade composer dependency

.. code-block:: bash
php composer.phar install --prefer-dist --no-dev

**5** Remove old caches and assets

.. code-block:: bash
rm -rf app/cache/*
rm -rf web/js/*
rm -rf web/css/*

**6** Upgrade platform

.. code-block:: bash
php app/console oro:platform:update --env=prod --force
