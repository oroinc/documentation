.. index::
    single: Upgrade

How to Upgrade to a New Version
==============================

1. Checkout from the GitHub Repository
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To retrieve a new version and upgrade your ORO CRM instance, please execute the following steps:

**1** Create backups of your Database and Code.

**2** "Cd" to the crm root folder and pull changes from the repository.

.. code-block:: bash

$ cd cd /path/to/crm_folder
$ git pull
$ git checkout <VERSION TO UPGRADE>

**3** Upgrade the composer dependency.

.. code-block:: bash

$ php composer.phar install --prefer-dist --no-dev

**4** Remove old caches and assets.

.. code-block:: bash

$ rm -rf app/cache/*
$ rm -rf web/js/*
$ rm -rf web/css/*

**5** Upgrade the platform.

.. code-block:: bash

php app/console oro:platform:update --env=prod --force

2. Download the Source Code Archive
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To retrieve a new version and upgrade your ORO CRM instance, please execute the following steps:

**1** Create backups of your Database and Code.

**2** Download the latest OroCRM version from the `download section`_ on `orocrm.com <http://www.orocrm.com/>`_ , unpack
      archive and overwrite existing system files.

**3** "Cd" to the crm root folder and Clear the "vendor" folder.

.. code-block:: bash

$ cd cd /path/to/crm_folder
$ rm -rf vendor/*

**4** Upgrade the composer dependency.

.. code-block:: bash

$ php composer.phar install --prefer-dist --no-dev

**5** Remove old caches and assets.

.. code-block:: bash

$ rm -rf app/cache/*
$ rm -rf web/js/*
$ rm -rf web/css/*

**6** Upgrade the platform.

.. code-block:: bash

$ php app/console oro:platform:update --env=prod --force

.. _`download section`: http://www.orocrm.com/download
