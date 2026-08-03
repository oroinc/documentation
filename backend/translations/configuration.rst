Translation Configuration
=========================

Debug Translator
----------------

The debug translator lets you check and debug translations in the UI. To enable it, set the `debug_translator` option to `true` in the config.yml file:

.. code-block:: yaml

    oro_translation:
        debug_translator: true


Then refresh the backend and browser cache. Oro now wraps translated strings in brackets and untranslated strings in exclamation marks with dashes. Frontend translations carry the suffix "JS" to distinguish them from backend translations.

.. code-block:: none

    [Contact] - translated backend string
    !!!---Account---!!! - not translated backend string

    [Reset]JS - translated frontend string
    !!!---Refresh---!!!JS - not translated frontend string


Debug JS Translations
---------------------

Debugging JS translations lets you turn off JS translation generation on the fly. This can slightly boost performance on slow hardware and make the application more stable on Windows.

If `kernel.debug` is set to `false`, the debugging JS translations value is ignored.

To turn off JS translation generation, set the `js_translation.debug` option to `false` in the config.yml file:

.. code-block:: yaml

    oro_translation:
        js_translation:
            debug: false


If you turned off JS translation generation, dump the translations manually by running the command below, which prepares them for use in JavaScript:

.. code-block:: none

    php bin/console oro:translation:dump

Use the ``--locale`` option to dump translations only for specific locales:

.. code-block:: none

    php bin/console oro:translation:dump --locale=<locale1> --locale=<locale2> --locale=<localeN>