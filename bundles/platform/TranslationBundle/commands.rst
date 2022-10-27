.. _bundle-docs-platform-translation-bundle--commands:

CLI Commands (TranslationBundle)
================================

.. _oro-translation-dump-command:

oro:translation:dump
--------------------

The ``oro:translation:dump`` command dumps the translations used by JavaScript code into the predefined public resource files.

.. code-block:: none

    php bin/console oro:translation:dump

The ``--locale`` option can be used to dump translations only for the specified locales:

.. code-block:: none

    php bin/console oro:translation:dump --locale=<locale1> --locale=<locale2> --locale=<localeN>

.. _oro-translation-load-command:

oro:translation:load
--------------------

The ``oro:translation:load`` command loads translations to the database.

.. code-block:: none

    php bin/console oro:translation:load

The ``--languages`` option can be used to limit the list of the loaded languages:

.. code-block:: none

    php bin/console oro:translation:load --languages=<language1> --languages=<language2> --languages=<languageN>

The ``--rebuild-cache`` option will trigger the translation cache rebuild after the translations are loaded:

.. code-block:: none

    php bin/console oro:translation:load --rebuild-cache

.. _oro-translation-rebuild-cache-command:

oro:translation:rebuild-cache
-----------------------------

To rebuilds the translation cache, use the following commad:

.. code-block:: none

   php bin/console oro:translation:rebuild-cache

.. _oro-translation-update-command:

oro:translation:update
----------------------

The ``oro:translation:update`` command downloads and installs a new version of translations for a specified language:

.. code-block:: none

    php bin/console oro:translation:update <language>

The ``--all`` option can be used to download and update translations for all installed languages:

.. code-block:: none

    php bin/console oro:translation:update --all

The command will print the list of all languages installed in the application if run without any options:

.. code-block:: none

    php bin/console oro:translation:update

.. _oro-translation-dump-files-command:

oro:translation:dump-files
--------------------------

The ``oro:translation:dump-files`` command dumps translations from the database or Crowdin to files
into the `translations` directory of the application.

.. code-block:: none

    php bin/console oro:translation:dump-files --locale=en_US

By default, the translations are dumped from the database. You can load translations to the database
via the :ref:`back-office UI <localization--languages>` or via the `oro:translation:load`_ command.

To dump from the Crowdin use the ``--source`` option:

.. code-block:: none

    php bin/console oro:translation:dump-files --locale=en_US --source=crowdin

To determine whether only new translations should be applied to existing dumped files, use the ``--new-only`` option:

.. code-block:: none

    php bin/console oro:translation:dump-files --locale=en_US --new-only

The default format of the dumped translations is YAML. To specify another format, use the ``--format`` option:

.. code-block:: none

    php bin/console oro:translation:dump-files --locale=en_US --format=xlf
