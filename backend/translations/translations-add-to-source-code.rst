.. _dev-translation--add-to-source-code:

Add Translations To Source Code
===============================

Out-of-the-box, only base English translations (``en`` language code) are loaded from the translation files.
As described in |Symfony Translation Files|, these files are located in the `Resources/translations` directory of any bundle
and the `translations` directory of the application, e.g. `Resources/translations/messages.en.yml`,
`Resources/translations/validators.en.yml`, etc.
These translations are compiled in the :ref:`Symfony translation catalogues <dev-translation--symfony-translator>`,
which are sets of PHP files. As a result, these files are cached by |OPcache| and so it is fairly quick to get these translations.
Translations for other languages can be downloaded from :ref:`Crowdin <doc--community--ui-translations>`
or added manually in the :ref:`Back-Office <localization--translations--config>`.
These translations are loaded from the database to the application cache and getting them is not as fast
as from the Symfony translation catalogues. To minimize performance issues, consider adding them
to the source code, as described below:

1. Use :ref:`oro:translation:dump-files <oro-translation-dump-files-command>` to dump translations
   to the `translations` directory of the application.

2. When you have updated the existing translations, use a file comparison tool of your choice to verify the dumped files.

3. Push the files to the version control system (git).

To rebuild Symfony translation catalogues with new translations and remove them from the database,
use the ``oro:platform:update`` command.

Please take into account that languages loaded from the dumped files will be disabled from management via Crowdin in the UI
and the data should be managed by a developer.

.. include:: /include/include-links-dev.rst
   :start-after: begin
