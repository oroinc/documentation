:oro_show_local_toc: false

.. _bundle-docs-platform-locale-bundle-commands:

CLI Commands (LocaleBundle)
===========================

oro:localization:localized-fallback-values:cleanup-unused
---------------------------------------------------------

.. hint:: The command is available starting from OroPlatform v5.0.3. To check which application version you are running, see the :ref:`system information <system-information>`.

Use the ``oro:localization:localized-fallback-values:cleanup-unused`` command to find and delete orphaned ``Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue`` entities that could appear due to the disabled `orphanRemoval` option.