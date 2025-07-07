.. _layouts-old-themes:

Old Themes
==========

Purpose of Legacy Theme Detection
---------------------------------

Adding new functionality to an existing theme can accidentally break views or other features of the legacy (old) theme.
To avoid such issues, it is important to identify whether the current theme is a legacy theme or inherits from it. This allows you to apply changes conditionally, ensuring that backward compatibility is maintained and that the expected behavior of the old theme is preserved.

How to use ``OldThemeProvider`` to Detect Legacy Theme:

1. **Inject ``OldThemeProvider`` into your service**

   .. code-block:: yaml

      services:
          my_custom.service:
              class: 'Acme\Bundle\MyBundle\Service\MyCustomService'
              arguments:
                  - '@oro_layout.old_theme_provider'
                  - ['default_51', 'default_50', 'default_60']

2. **Check if the current Theme is a legacy theme**

    .. code-block:: php

        namespace Acme\Bundle\MyBundle\Service;

        use Oro\Component\Layout\Extension\Theme\Model\OldThemeProvider;

        class MyCustomService
        {
            public function __construct(
                private readonly OldThemeProvider $oldThemeProvider,
                private array $oldThemes,
            ) {
            }

            public function doSomething(): void
            {
                if ($this->oldThemeProvider->isOldTheme($this->oldThemes)) {
                    return;
                }
                ...
            }
        }

.. note::
    The method ``isOldTheme(array $themeNames): bool`` returns true if the current theme matches or inherits from any themes in the provided array. This is useful when applying layout logic or rendering adjustments specific to particular theme versions.

.. note::
    For more details, see the implementation in the ``\Oro\Component\Layout\Extension\Theme\Model\OldThemeProvider``.

.. include:: /include/include-links-dev.rst
   :start-after: begin
