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
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

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
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To port an existing bundle to a bundle-less structure, you must update the directory structure to the one shown above. There is no automatic tool for this update, so you must move your code following these guidelines:

Migrations
""""""""""

.. code-block:: none

    {BundleDir}/Migrations/Schema -> migrations/{EntityNameDir}/Schema

    Example:
    Bundle/UserNamingBundle/Migrations/Schema/ -> migrations/UserNaming/Schema/

Fixtures
""""""""

.. code-block:: none

    {BundleDir}/Migrations/Data -> migrations/{EntityNameDir}/Data

    Example:
    Bundle/UserNamingBundle/Migrations/Data/ -> migrations/UserNaming/Data/

Entity
""""""

.. code-block:: none

    {BundleDir}/Entity/{YourEntity} -> src/Entity/{YourEntity}

    Example:
    Bundle/UserNamingBundle/Entity/UserNamingType.php -> src/Entity/UserNamingType.php

Controllers
"""""""""""

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
"""""

.. code-block:: none

   {BundleDir}/Resources/views/{YourEntityName}/index.html.twig -> templates/{entity_alias_underscore}/index.html.twig

Translations
""""""""""""

.. code-block:: none

    {BundleDir}/Resources/translations/messages.en.yml -> translations/messages.en.yml

Gridview
"""""""""

.. code-block:: none

    {BundleDir}/Resources/config/oro/datagrids.yml -> config/oro/datagrids/{name_your_feature.yml}

    Templates:
    BundleDir}/Resources/views/{YourEntityName}/Datagrid/yourTemplate.html.twig -> templates/{entity_alias_underscore}/Datagrid/yourTemplate.html.twig

Search
""""""

.. code-block:: none

   {BundleDir}/Resources/config/oro/search.yml -> config/oro/search/{your_search_name.yml}

    Templates:
    {BundleDir}/Resources/views/{YourEntityName}/Search/yourTemplate.html.twig -> templates/{entity_alias_underscore}/Search/yourTemplate.html.twig

Navigation
""""""""""

.. code-block:: none

   {BundleDir}/Resources/config/oro/navigation.yml -> config/oro/navigation/{your_navigation_name.yml}

Entity
"""""""

.. code-block:: none

  {BundleDir}/Resources/config/oro/entity.yml -> config/oro/entity/{your_entity_name.yml}

ACLS
"""""

.. code-block:: none

  {BundleDir}/Resources/config/oro/acls.yml -> config/oro/acls/{your_acls_name.yml}

API
"""

.. code-block:: none

  {BundleDir}/Resources/config/oro/api.yml -> config/oro/api/{your_api_name.yml}

Channels
""""""""

.. code-block:: none

    {BundleDir}/Resources/config/oro/channels.yml -> config/oro/channels/{your_channel_name.yml}

Charts
""""""

.. code-block:: none

    {BundleDir}/Resources/config/oro/charts.yml -> config/oro/charts/{your_chart_name.yml}

Workflows
"""""""""

.. code-block:: none

    {BundleDir}/Resources/config/oro/workflows.yml -> config/oro/workflows/workflows.yml

.. important:: All application-level workflows can be stored in separate directories but must be registered in the /config/oro/workflows.yml file (via an import directive).


Processes
"""""""""

.. code-block:: none

    {BundleDir}/Resources/config/oro/processes.yml -> config/oro/processes/processes.yml

.. important:: All application-level processes must be registered in the /config/oro/processes.yml file.


ACL Categories
""""""""""""""

.. code-block:: none

   {BundleDir}/Resources/config/oro/acl_categories.yml -> config/oro/acl_categories/your_acl_name.yml

Address Format
""""""""""""""

.. code-block:: none

   {BundleDir}/Resources/config/oro/address_format.yml -> config/oro/address_format/your_format_name.yml


API Frontend
""""""""""""

.. code-block:: none

   {BundleDir}/Resources/config/oro/api_frontend.yml -> config/oro/api_frontend/your_api_name.yml

Application Base Configuration
""""""""""""""""""""""""""""""

.. code-block:: none

   {BundleDir}/Resources/config/oro/app.yml -> config/oro/app/your_app_name.yml


Configurable Permissions
""""""""""""""""""""""""

.. code-block:: none

    {BundleDir}/Resources/config/oro/configurable_permissions.yml -> config/oro/configurable_permissions/your_permission_name.yml

Dashboards
""""""""""

.. code-block:: none

    {BundleDir}/Resources/config/oro/dashboards.yml -> config/oro/dashboards/your_dashboard.yml

    Templates:
    {BundleDir}/Resources/views/Dashboard/yourTemplate.html.twig -> templates/Dashboard/yourTemplate.html.twig

Entity Extend
"""""""""""""

.. code-block:: none

    {BundleDir}/Resources/config/oro/entity_extend.yml -> config/oro/entity_extend/your_config.yml

Entity Hidden Fields
""""""""""""""""""""

.. code-block:: none

    {BundleDir}/Resources/config/oro/entity_hidden_fields.yml -> config/oro/entity_hidden_fields/your_config.yml

Locale Data
"""""""""""

.. code-block:: none

    {BundleDir}/Resources/config/oro/locale_data.yml -> config/oro/locale_data/your_config.yml

Naming Format
"""""""""""""

.. code-block:: none

    {BundleDir}/Resources/config/oro/name_format.yml -> config/oro/name_format/your_config.yml

Permissions
"""""""""""

.. code-block:: none

    {BundleDir}/Resources/config/oro/permissions.yml -> config/oro/permissions/your_config.yml

Placeholders
"""""""""""""

.. code-block:: none

    {BundleDir}/Resources/config/oro/placeholders.yml -> config/oro/placeholders/your_config.yml

System Configurations
"""""""""""""""""""""

.. code-block:: none

    {BundleDir}/Resources/config/oro/system_configuration.yml -> config/oro/system_configuration/your_config.yml


Extension and Configuration Moving
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

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
~~~~~~~~~~~~~~~~

1. Assets for themes should be moved to ``/src/assets/{your_theme_dir}/``.
2. Admin theme configuration:

   - ``/config/oro/assets.yml``
   - ``/config/oro/jsmodules.yml``

3. Storefront Themes and layouts should be placed in ``/templates/layouts/{your_theme_dir}/``.

   -  Themes configuration: ``/templates/layouts/{your_theme_dir}/theme.yml``
   -  Layout assets configuration: ``/templates/layouts/{your_theme_dir}/config/assets.yml``
   -  Layout theme configuration: ``/templates/layouts/{your_theme_dir}/config/config.yml``

Asset Handling in Application Development
"""""""""""""""""""""""""""""""""""""""""

If the build uses the image or any other asset, it is automatically copied to the public folder. Copying ensures that the assets are readily available and can be served to users without issues.

However, in some scenarios where assets are not directly utilized within the build process, placing them directly in the public folder from the beginning is recommended. This approach eliminates the need for automatic copying since the assets are already in the correct location.

To adhere to the best practices mentioned above, manually move the image or any other static asset to the public folder.

Referencing Assets using the asset() Function in Twig
"""""""""""""""""""""""""""""""""""""""""""""""""""""

Once the asset is placed in the public folder, you can reference it within your application using the asset() function in Twig. The asset() function provides a convenient way to generate the correct URL for the asset, allowing you to include it within your templates or code.

.. code-block:: twig

    {# the image lives at "public/images/example.jpg" #}
    <img src="{{ asset('images/example.jpg') }}" alt="Example Image"/>

Tests
~~~~~

1. Unit tests should be placed in ``/src/Test/Unit/``.
2. Functional tests should be placed in ``/src/Test/Functional/``.
3. Behat tests should be placed in ``/src/Test/Behat/``.

   - Configuration for Behat services: ``/config/oro/behat_services.yml``
