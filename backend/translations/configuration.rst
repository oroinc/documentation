Translation Configuration
=========================

Debug Translator
----------------

Debug translator enables you to check and debug translations in the UI. To enable it, set option `debug_translator` to `true` in the config.yml file:

.. code-block:: yaml

    oro_translation:
        debug_translator: true


Additionally, refresh the backend and browser cache. All translated strings will then be wrapped into brackets, and untranslated strings will be wrapped into exclamation marks with dashes. Frontend translations have suffix "JS" to distinguish them from backend translations.

.. code-block:: none

    [Contact] - translated backend string
    !!!---Account---!!! - not translated backend string

    [Reset]JS - translated frontend string
    !!!---Refresh---!!!JS - not translated frontend string


Debug JS Translations
---------------------

Debugging JS translations allows to turn off on fly JS translations generation, it can slightly boost performance on slow hardware configurations and make the application more stable on Windows. If `kernel.debug` is set to `false`, the value of debugging JS translations is ignored. To turn off JS translations generation, set option `js_translation.debug` to `false` in the config.yml file:

.. code-block:: yaml

    oro_translation:
        js_translation:
            debug: false


If you turned off JS translations generation, do it manually by executing the command below, which dumps translations for use in JavaScript:

.. code-block:: none

    php bin/console oro:translation:dump

The ``--locale`` option can be used to dump translations only for the specified locales:

.. code-block:: none

    php bin/console oro:translation:dump --locale=<locale1> --locale=<locale2> --locale=<localeN>