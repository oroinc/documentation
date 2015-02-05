.. index::
    single: Extension; Install extension
    single: Extension; Install extension from command line
    single: Extension

How to install Oro Platform extensions
======================================

*Used application: OroPlatform 1.**

There are several ways to install extensions from command line:

.. caution::

    Before extension installation we recommend to backup database and application code source. Once installed extension cannot be uninstalled

Composer command-line
---------------------

.. code-block:: bash

    # remove caches before install extension
    $ rm app/cache/*
    # upgrade composer to latest version
    $ composer self-update
    # add and download extension
    $ composer required <extension name>:<extension-version> --prefer-dist --update-no-dev
    # install extension
    $ app/console oro:platform:update --env=prod --force
    # remove caches to prevent permissions for www-data user
    $ rm app/cache/*

Package Manager command-line
----------------------------

.. code-block:: bash

    # remove caches before install extension
    $ rm app/cache/*
    # download and install extension
    $ app/console oro:package:install <extension name> <extension-version> --env=prod
    # remove caches to prevent permissions for www-data user
    $ rm app/cache/*


List of available extensions
----------------------------

.. code-block:: bash

    $ app/console oro:package:available --env prod

List of installed extensions
----------------------------

.. code-block:: bash

    $ app/console oro:package:installed --env prod
