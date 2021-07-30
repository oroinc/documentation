.. _bundle-docs-platform-locale-bundle-managing-localizations:

Managing Localizations
======================

Caching Notice
--------------

Localization objects are cached to provide better performance. You must disable cache usage if you need to persist, delete or assign the returned Localization (see *$useCache* parameter below).

LocalizationManager
-------------------

LocalizationManager provides all the necessary methods for accessing localizations.
You can easily access it from the controller:

.. code-block:: php

   $this->get('oro_locale.manager.localization');

``Oro\Bundle\LocaleBundle\Manager::getLocalization($id\[, $useCache = true\])``

Gets a single Localization object.

An example of usage:

.. code-block:: php

    // Will get single Localization object
    $localizationManager = $this->get('oro_locale.manager.localization');
    $localization = $localizationManager->getLocalization(1);

``Oro\Bundle\LocaleBundle\Manager::getLocalizations(array $ids\[, $useCache = true\])``

Gets one or selected Localization objects.

An example of usage:

.. code-block:: php

    $localizationManager = $this->get('oro_locale.manager.localization');

    // Will get all Localizations from database
    $localizations = $localizationManager->getLocalizations();

    // Will get Localizations with ids 1, 3, 5, 7.
    // If there is no Localization with provided id, this id will be skipped.
    $localizations = $localizationManager->getLocalizations([1, 3, 5, 7]);

``Oro\Bundle\LocaleBundle\Manager::getDefaultLocalization(\[$useCache = true\])``

Gets the default Localization. The default Localization is obtained from the system configuration (see |OroConfigBundle| for more information).

An example of usage:

.. code-block:: php

    $localizationManager = $this->get('oro_locale.manager.localization');
    $defaultLocalization = $localizationManager->getDefaultLocalization();

``Oro\Bundle\LocaleBundle\Manager::clearCache``

Removes Localization objects from cache. The next time a user calls getLocalization,
getLocalizations, getDefaultLocalization or warmUpCache, cache will be recreated.

An example of usage:

.. code-block:: php

    $localizationManager = $this->get('oro_locale.manager.localization');
    $defaultLocalization = $localizationManager->clearCache();

.. note:: Keep in mind that cache is also cleared when you run

.. code-block:: bash

   php bin/console cache:clear

``Oro\Bundle\LocaleBundle\Manager::warmUpCache``

Gets all Localization objects from the database and stores them into cache.

An example of usage:

.. code-block:: php

    $localizationManager = $this->get('oro_locale.manager.localization');
    $defaultLocalization = $localizationManager->warmUpCache();

.. note:: Keep in mind that cache is also warmed up when you run

.. code-block:: bash

   php bin/console cache:clear

.. include:: /include/include-links-dev.rst
   :start-after: begin

