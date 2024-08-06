.. index::
    single: Patch

:title: Organize OroPlatform Based Application Code Without Bundles

.. _dev-backend-architecture-bundle-less-structure:

Bundle-less Structure
=====================

You can organize an OroPlatform-based application code within :ref:`Symfony bundles <how-to-create-new-bundle>` or plain directories. Bundle-less directory structure support was added to OroPlatform v5.1 to follow the Symfony best practices and lower the entry level for new developers.
This guide overviews the bundle-less structure and explains how to migrate the application code from the bundles-based to bundle-less structure.

.. note:: The use of **bundle-less structure** is optional. However, you can use a bundle-less structure for individual customization and expansion of Oro functionality or when creating a new bundle is impractical.

The *bundle-less structure* includes the application structure changes outlined below (configuration and directory).

Application-level Structure Changes
-----------------------------------

.. code-block:: none

    oro-application/
    ├── assets/
    |   |── your-assets-dir                             # Here we can store the (scss, js, image, fonts) resources.
    |   └── ...
    ├── config/
    │   ├── batch_jobs                                  # Import and Export Configuration.
    |   |   |── jobs-config.yml
    |   |   └── ...
    │   ├── doctrine.yml                                # Doctrine DBAL Configuration.
    │   ├── oro/                                        # This is where all Oro advanced features configuration is stored.
    |   |   |── acl_categories/                         # ACL category extending configuration.
    |   |   |   |── acl_category_config.yml
    |   |   |   └── ...
    |   |   |── acls/                                   # ACLS extending configuration.
    |   |   |   |── acls_config.yml
    |   |   |   └── ...
    |   |   |── address_format/                         # Address formatting extending configuration.
    |   |   |   |── address_format_config.yml
    |   |   |   └── ...
    |   |   |── api/
    |   |   |   |── api_config.yml                      # API extending configuration.
    |   |   |   └── ...
    |   |   |── api_frontend/                           # API frontend extending configuration.
    |   |   |   |── api_frontend_config.yml
    |   |   |   └── ...
    |   |   |── app/                                    # App extending configuration.
    |   |   |   |── app_config.yml
    |   |   |   └── ...
    |   |   |── cache_metadata/                         # Cache metadata configuration.
    |   |   |   |── cache_metadata.yml
    |   |   |   └── ...
    |   |   |── channels/                               # Channels extending configuration.
    |   |   |   |── channels_config.yml
    |   |   |   └── ...
    |   |   |── charts/                                 # Charts extending configuration.
    |   |   |   |── charts_config.yml
    |   |   |   └── ...
    |   |   |── configurable_permissions/               # Configurable permissions extending configuration.
    |   |   |   |── configurable_perm_config.yml
    |   |   |   └── ...
    |   |   |── dashboards/                             # Dashboards extending configuration.
    |   |   |   |── dashboards_config.yml
    |   |   |   └── ...
    |   |   |── datagrids/                              # Datagrids extending configuration.
    |   |   |   |── datagrids_config.yml
    |   |   |   └── ...
    |   |   |── entity/                                 # Entity extending configuration.
    |   |   |   |── entity_config.yml
    |   |   |   └── ...
    |   |   |── entity_extend/                          # Entity extend extending configuration.
    |   |   |   |── entity_extend_config.yml
    |   |   |   └── ...
    |   |   |── entity_hidden_fields/
    |   |   |   |── entity_hidden_fields_config.yml
    |   |   |   └── ...
    |   |   |── features/                               # Feature Toggle extending configuration.
    |   |   |   |── features_config.yml
    |   |   |   └── ...
    |   |   |── help/
    |   |   |   |── help_config.yml
    |   |   |   └── ...
    |   |   |── locale_data/                            # Locale data extending configuration.
    |   |   |   |── locale_data_config.yml
    |   |   |   └── ...
    |   |   |── name_format/                            # Name formatting extending configuration.
    |   |   |   |── name_format_config.yml
    |   |   |   └── ...
    |   |   |── navigation/                             # Navigation extending configuration.
    |   |   |   |── navigation_config.yml
    |   |   |   └── ...
    |   |   |── permissions/                            # Permissions extending configuration.
    |   |   |   |── permissions_config.yml
    |   |   |   └── ...
    |   |   |── placeholders/                           # Placeholders extending configuration.
    |   |   |   |── placeholders_config.yml
    |   |   |   └── ...
    |   |   |── processes/                              # Processes extending configuration.
    |   |   |   └── processes.yml                       # All application-level processes configuration must be registered here.
    |   |   |── query_designer/
    |   |   |   |── query_designer_config.yml
    |   |   |   └── ...
    |   |   |── search/                                 # Search extending configuration.
    |   |   |   |── search_config.yml
    |   |   |   └── ...
    |   |   |── system_configuration/
    |   |   |   |── system_configuration_config.yml
    |   |   |   └── ...
    |   |   |── workflows/
    |   |   |   |── workflows_import/                    # A directory of workflows that can be registered with an import directive.
    |   |   |   └── workflows.yml                        # All application-level workflows must be registered here.
    |   |   |── websocket_routing/                       # Gos PubSub routing resources.
    |   |   |   |── websocket_routing_config.yml
    |   |   |   └── ...
    |   |   |── sanitize                                 # Sanitizing rules configuration
    |   |   |   |── sanitize_config.yml
    |   |   |   └── ...
    |   |   |── assets.yml                               # Assets for administration themes/layouts.
    |   |   |── jsmodules.yml                            # Js modules for administration themes/layouts.
    |   |   └── behat_services.yml                       # Behat services must be registered here.
    │   └── ...
    ├── src/
    │   ├── ...
    │   |── Entity/                                      # Required to set up a Doctrine mapping.
    │   └── Tests/                                       # Application-level tests.
    |   |   |── Behat/
    |   |   |── Unit/
    |   |   └── Functional/
    ├── templates/
    ├── migrations/                                      # All Oro application level migrations and fixture store.
    │   |── your_feature_name/
    |   |   |── Data/
    |   |   └── Schema/
    │   └── ...
    ├── translations/
    └── ...

Moving Existing Bundle to Bundle-less Structure
-----------------------------------------------

To port an existing bundle to a bundle-less structure, you must update the directory structure to the one shown above. There is no automatic tool for this update, so you must move your code following these guidelines:

Migrations
~~~~~~~~~~

.. code-block:: none

    {BundleDir}/Migrations/Schema -> migrations/{EntityNameDir}/Schema

    Example:
    Bundle/UserNamingBundle/Migrations/Schema/ -> migrations/UserNaming/Schema/

Fixtures
~~~~~~~~

.. code-block:: none

    {BundleDir}/Migrations/Data -> migrations/{EntityNameDir}/Data

    Example:
    Bundle/UserNamingBundle/Migrations/Data/ -> migrations/UserNaming/Data/

Entity
~~~~~~

.. code-block:: none

    {BundleDir}/Entity/{YourEntity} -> src/Entity/{YourEntity}

    Example:
    Bundle/UserNamingBundle/Entity/UserNamingType.php -> src/Entity/UserNamingType.php

Controllers
~~~~~~~~~~~

.. code-block:: none

    {BundleDir}/Controller/{YourController.php} -> src/Controller/{YourController.php}

.. note:: Don't forget about declaring the controller as a service in the configuration.

.. code-block:: yaml

    App\Controller\UserNamingController:
    calls:
      - [ 'setContainer', [ '@Psr\Container\ContainerInterface' ] ]
    tags:
      - { name: container.service_subscriber }

Views
~~~~~

.. code-block:: none

   {BundleDir}/Resources/views/{YourEntityName}/index.html.twig -> templates/{entity_alias_underscore}/index.html.twig

Translations
~~~~~~~~~~~~

.. code-block:: none

    {BundleDir}/Resources/translations/messages.en.yml -> translations/messages.en.yml

Gridview
~~~~~~~~

.. code-block:: none

    {BundleDir}/Resources/config/oro/datagrids.yml -> config/oro/datagrids/{name_your_feature.yml}

    Templates:
    BundleDir}/Resources/views/{YourEntityName}/Datagrid/yourTemplate.html.twig -> templates/{entity_alias_underscore}/Datagrid/yourTemplate.html.twig

Search
~~~~~~

.. code-block:: none

   {BundleDir}/Resources/config/oro/search.yml -> config/oro/search/{your_search_name.yml}

    Templates:
    {BundleDir}/Resources/views/{YourEntityName}/Search/yourTemplate.html.twig -> templates/{entity_alias_underscore}/Search/yourTemplate.html.twig

Navigation
~~~~~~~~~~

.. code-block:: none

   {BundleDir}/Resources/config/oro/navigation.yml -> config/oro/navigation/{your_navigation_name.yml}

Entity
~~~~~~

.. code-block:: none

  {BundleDir}/Resources/config/oro/entity.yml -> config/oro/entity/{your_entity_name.yml}

ACLS
~~~~

.. code-block:: none

  {BundleDir}/Resources/config/oro/acls.yml -> config/oro/acls/{your_acls_name.yml}

API
~~~

.. code-block:: none

  {BundleDir}/Resources/config/oro/api.yml -> config/oro/api/{your_api_name.yml}

Channels
~~~~~~~~

.. code-block:: none

    {BundleDir}/Resources/config/oro/channels.yml -> config/oro/channels/{your_channel_name.yml}

Charts
~~~~~~

.. code-block:: none

    {BundleDir}/Resources/config/oro/charts.yml -> config/oro/charts/{your_chart_name.yml}

Workflows
~~~~~~~~~

.. code-block:: none

    {BundleDir}/Resources/config/oro/workflows.yml -> config/oro/workflows/workflows.yml

.. important:: All application-level workflows can be stored in separate directories but must be registered in the /config/oro/workflows.yml file (via an import directive).


Processes
~~~~~~~~~

.. code-block:: none

    {BundleDir}/Resources/config/oro/processes.yml -> config/oro/processes/processes.yml

.. important:: All application-level processes must be registered in the /config/oro/processes.yml file.


ACL Categories
~~~~~~~~~~~~~~

.. code-block:: none

   {BundleDir}/Resources/config/oro/acl_categories.yml -> config/oro/acl_categories/your_acl_name.yml

Address Format
~~~~~~~~~~~~~~

.. code-block:: none

   {BundleDir}/Resources/config/oro/address_format.yml -> config/oro/address_format/your_format_name.yml


API Frontend
~~~~~~~~~~~~

.. code-block:: none

   {BundleDir}/Resources/config/oro/api_frontend.yml -> config/oro/api_frontend/your_api_name.yml

Application Base Configuration
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. code-block:: none

   {BundleDir}/Resources/config/oro/app.yml -> config/oro/app/your_app_name.yml


Configurable Permissions
~~~~~~~~~~~~~~~~~~~~~~~~

.. code-block:: none

    {BundleDir}/Resources/config/oro/configurable_permissions.yml -> config/oro/configurable_permissions/your_permission_name.yml

Dashboards
~~~~~~~~~~

.. code-block:: none

    {BundleDir}/Resources/config/oro/dashboards.yml -> config/oro/dashboards/your_dashboard.yml

    Templates:
    {BundleDir}/Resources/views/Dashboard/yourTemplate.html.twig -> templates/Dashboard/yourTemplate.html.twig

Entity Extend
~~~~~~~~~~~~~

.. code-block:: none

    {BundleDir}/Resources/config/oro/entity_extend.yml -> config/oro/entity_extend/your_config.yml

Entity Hidden Fields
~~~~~~~~~~~~~~~~~~~~

.. code-block:: none

    {BundleDir}/Resources/config/oro/entity_hidden_fields.yml -> config/oro/entity_hidden_fields/your_config.yml

Locale Data
~~~~~~~~~~~

.. code-block:: none

    {BundleDir}/Resources/config/oro/locale_data.yml -> config/oro/locale_data/your_config.yml

Naming Format
~~~~~~~~~~~~~

.. code-block:: none

    {BundleDir}/Resources/config/oro/name_format.yml -> config/oro/name_format/your_config.yml

Permissions
~~~~~~~~~~~

.. code-block:: none

    {BundleDir}/Resources/config/oro/permissions.yml -> config/oro/permissions/your_config.yml

Placeholders
~~~~~~~~~~~~

.. code-block:: none

    {BundleDir}/Resources/config/oro/placeholders.yml -> config/oro/placeholders/your_config.yml

System Configurations
~~~~~~~~~~~~~~~~~~~~~

.. code-block:: none

    {BundleDir}/Resources/config/oro/system_configuration.yml -> config/oro/system_configuration/your_config.yml


Cache Metadata
~~~~~~~~~~~~~~

.. note:: This feature is available as of OroPlatform version 5.1.9.

.. code-block:: none

    {BundleDir}/Resources/config/oro/cache_metadata.yml  -> config/oro/cache_metadata/cache_metadata.yml

.. important:: All application-level caching data must be registered in the /config/oro/cache_metadata/cache_metadata.yml file.


Moving Extension and Configuration
----------------------------------

1. Create Extension and Configuration classes in ``/src/Configuration``.

.. code-block:: php

    class YourExtension extends Extension
    {
        /**
         * {@inheritDoc}
         */
        public function load(array $configs, ContainerBuilder $container): void
        {
            $config = $this->processConfiguration(new YourConfigurationClass(), $configs);
            $container->prependExtensionConfig($this->getAlias(), SettingsBuilder::getSettings($config));
        }

        /**
         * {@inheritDoc}
         */
        public function getAlias(): string
        {
            return YourConfigurationClass::ROOT_NODE;
        }
    }

2. Register the extension in ``AppKernel::build``.

.. code-block:: php

    /**
     * {@inheritDoc}
     */
    protected function build(ContainerBuilder $container)
    {
        $container->registerExtension(new YourExtension());
    }

Themes & Layouts
----------------

1. Assets for themes should be moved to ``/assets/{your_theme_dir}/``.

2. Storefront Themes and layouts should be placed in ``/templates/layouts/{your_theme_dir}/``.

   -  Themes configuration: ``/templates/layouts/{your_theme_dir}/theme.yml``
   -  Layout assets configuration: ``/templates/layouts/{your_theme_dir}/config/assets.yml``
   -  Layout theme configuration: ``/templates/layouts/{your_theme_dir}/config/config.yml``

Asset Handling in Application Development
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

If the build uses the image or any other asset, it is automatically copied to the public folder. Copying ensures that the assets are readily available and can be served to users without issues.

However, in some scenarios where assets are not directly utilized within the webpack build process, placing them directly in the public folder from the beginning is recommended. This approach eliminates the need for automatic copying since the assets are already in the correct location.

To adhere to the best practices mentioned above, manually move the image or any other static asset to the public folder.

Overriding SASS Variables
~~~~~~~~~~~~~~~~~~~~~~~~~

Below is an example of overriding SASS variables in a custom theme:

1. Define a custom theme. Add theme file `appRoot/templates/layouts/{theme_name}/theme.yml`:

.. code-block:: yaml

    label: 'Default New'
    groups: [ commerce ]
    svg_icons_support: true
    parent: default
    rtl_support: true

2. Define theme-related styles:

`appRoot/assets/{theme_name}/css/scss/settings/_colors.scss`


.. code-block:: css

   /* @theme: theme-name; */
   $color-palette: (
       'primary': (
           'main': #0a7f8f,
           'hover': #075963,
           'active': #05444d,
           'disabled': #7d999e,
           'light': #e8fcff
       ),
       'secondary': (
           'c1': #ffc221,
           'c2': #f7941d,
           'c3': #6e98dc,
           'c4': #7ea6a4,
           'c5': #197b30,
           'sale': #9c0067
       ),
       'neutral': (
           'white-100': #fff,
           'white-50': rgb(255 255 255 / .5),
           'white-30': rgb(255 255 255 / .3),
           'white-15': rgb(255 255 255 / .15),
           'grey1': #f0f3f5,
           'grey2': #d4dcdd,
           'grey3': #c3cfcf,
           'dark': #002434,
           'focus': #1a69fe
       ),
       'text': (
           'primary': #002434,
           'secondary': #45606e,
           'disabled': #8e9da4,
           'inverse': #fff,
           'inverse-70': rgb(255 255 255 / .7),
           'link': red,
           'link-hover': red,
           'link-hover-on-dark': red
       ),
       'destructive': (
           'light': #ffebed,
           'light-on-dark': rgb(255 107 107 / .3),
           'base': #de0b07,
           'main': #b50400,
           'main-on-dark': #ff6b6b,
           'dark': #9c0000,
           'disabled': #d17573
       ),
       'success': (
           'light': #e2fbe9,
           'dark': #005e1f
       ),
       'warning': (
           'light': #fff7d1,
           'base': #f19500,
           'dark': #8f3700
       ),
       'info': (
           'light': #edf5ff,
           'dark': #143dd4
       )
   );

.. note:: If you extend your theme from existing themes, your new color palette must include all the colors present in the parent theme. Otherwise, you will encounter an assets build error, which is why in this example, $color-palette is fully shown and includes all the colors from the default theme.

`appRoot/assets/{theme_name}/css/scss/settings/primary-settings.scss`

.. code-block:: css

    /* @theme: {theme_name}; */

    @import 'colors';


`appRoot/assets/{theme_name}/css/scss/variables/page-header-config.scss`

.. code-block:: css

    /* @theme: {theme_name}; */

    $page-header-background-color: get-color('primary', 'light');

3. Define theme-related assets config:

`appRoot/templates/layouts/{theme_name}/config/assets.yml`

.. code-block:: yaml

    styles:
        inputs:
            - '../../assets/{theme_name}/css/scss/settings/primary-settings.scss'
            - '../../assets/{theme_name}/css/scss/variables/page-header-config.scss'
        output: 'css/styles.css'

4. Enable the new theme. Update the application config:

`appRoot/config/config.yml`

.. code-block:: yaml

    ...

    oro_layout:
        enabled_themes:
            - default
            - {theme_name}

    ...

5. To apply changes, clear the application cache and re-install assets.

.. code-block:: text

    php bin/console cache:clear
    php bin/console oro:assets:install


For more information on :ref:`Storefront Customization <dev-doc-frontend-layouts-quick-start>` and :ref:`AssetBundle CLI Commands <bundle-docs-platform-asset-bundle-commands>`, see the frontend developer guide.

Referencing Assets Using the asset() Function in Twig
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Once the asset is placed in the public folder, you can reference it within your application using the asset() function in Twig. The asset() function provides a convenient way to generate the correct URL for the asset, allowing you to include it within your templates or code.

.. code-block:: twig

    {# the image lives at "public/images/example.jpg" #}
    <img src="{{ asset('images/example.jpg') }}" alt="Example Image"/>

Admin Theme Configuration
~~~~~~~~~~~~~~~~~~~~~~~~~

The admin theme can be configured using the following files:

   - ``/config/oro/assets.yml``
   - ``/config/oro/jsmodules.yml``

These configuration files can also be used to customize the admin theme.

For more information on the :ref:`Back-Office Customization <dev-doc-frontend-back-office-theming>`, see the frontend developer guide.

Tests
-----

1. Unit tests should be placed in ``/src/Test/Unit/``.
2. Functional tests should be placed in ``/src/Test/Functional/``.
3. Behat tests should be placed in ``/src/Test/Behat/``.

   - Configuration for Behat services: ``/config/oro/behat_services.yml``

   - Example of loading fixtures in behat test:

      .. code-block:: gherkin

        @fixture-app:payment_rules.yml

        Feature: Payment Rules
            Scenario: Creating Payment Rule
                Given I login as administrator
                When I go to System/ Payment Rules
                And I click "Create Payment Rule"
                Then I fill "Payment Rule Form" with:
                  | Method | PayPal |

