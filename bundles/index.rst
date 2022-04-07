:title: OroPlatform and OroCommerce Bundles Documentation

.. meta::
   :description: A list of OroCommerce and OroCRM bundles

.. _bundle-docs:

Oro Bundles
===========

Bundles in Oro applications are a collection of files with the source code, configurations and additional assets organized in a conventional structure and providing ready-to-use functionality. Each Oro application comes with many prebuilt bundles organized in composer packages.

This section extends the rest of the Developer Guide, providing insight into core bundles implementation architecture and infrequently customizable features, which is particularly useful for non-standard customizations for backend and frontend developers as many features are interconnected.

.. _bundle-docs-platform:

OroPlatform Bundles
-------------------

OroPlatform offers a wide range of bundles that contain the core functionality of the application. OroPlatform bundles reside in our GitHub repository. All documentation that relates to OroPlatform bundles is collected below.

.. csv-table::

    "**A**",":ref:`DistributionBundle <bundle-docs-platform-distribution-bundle>`",":ref:`InstallerBundle <bundle-docs-platform-installer-bundle>` ",":ref:`RedisConfigBundle <bundle-docs-platform-redis-bundle>`"
    ":ref:`ActionBundle <bundle-docs-platform-action-bundle>`",":ref:`DigitalAssetBundle <bundle-docs-platform-dam>`",":ref:`IntegrationBundle <bundle-docs-platform-integration-bundle>` ",":ref:`ReportBundle <bundle-docs-platform-report-bundle>`"
    ":ref:`ActivityBundle <bundle-docs-platform-activity-bundle>`","**E**","**L** ","**S**"
    ":ref:`ActivityListBundle <bundle-docs-platform-activity-list-bundle>`",":ref:`ElasticSearchBundle <bundle-docs-platform-elastic-search-bundle>`",":ref:`LayoutBundle <bundle-docs-platform-layout-bundle>` ",":ref:`ScopeBundle <bundle-docs-platform-scope-bundle>`"
    ":ref:`AddressBundle <bundle-docs-platform-address-bundle>`",":ref:`EmailBundle <bundle-docs-platform-email-bundle>`",":ref:`LocaleBundle <bundle-docs-platform-locale-bundle>` ",":ref:`SearchBundle <bundle-docs-platform-search-bundle>`"
    ":ref:`ApiBundle <bundle-docs-platform-api-bundle>`",":ref:`EmbeddedFormBundle <bundle-docs-platform-embedded-form-bundle>`",":ref:`LoggerBundle <bundle-docs-platform-logger-bundle>` ",":ref:`SecurityBundle <bundle-docs-platform-security-bundle>`"
    ":ref:`AssetBundle <bundle-docs-platform-asset-bundle>`",":ref:`EntityBundle <bundle-docs-platform-entity-bundle>` ","**M**",":ref:`SegmentBundle <bundle-docs-platform-segment-bundle>`"
    ":ref:`AttachmentBundle <bundle-docs-platform-attachment-bundle>`",":ref:`EntityConfigBundle <bundle-docs-platform-entity-config-bundle>`",":ref:`MessageQueueBundle <bundle-docs-platform-message-queue-bundle>`",":ref:`SidebarBundle <bundle-docs-platform-sidebar-bundle>`"
    "**B**",":ref:`EntityExtendBundle <bundle-docs-platform-entity-extend-bundle>`",":ref:`MicrosoftSyncBundle <bundle-docs-platform-microsoft-sync-bundle>`",":ref:`SyncBundle <bundle-docs-platform-sync-bundle>`"
    ":ref:`BatchBundle <bundle-docs-platform-batch-bundle>`",":ref:`EntityMergeBundle <bundle-docs-platform-entity-merge-bundle>`",":ref:`MigrationBundle <bundle-docs-platform-migration-bundle>`","**T**"
    "**C**",":ref:`EntityPaginationBundle <bundle-docs-platform-entity-pagination-bundle>` ","**N**",":ref:`TagBundle <bundle-docs-platform-tag-bundle>`"
    ":ref:`CacheBundle <bundle-docs-platform-cache-bundle>`",":ref:`EntitySerializedFieldsBundle <bundle-docs-platform-entity-serialized-bundle>` ",":ref:`NavigationBundle <bundle-docs-platform-navigation-bundle>`",":ref:`TestFrameworkBundle <bundle-docs-platform-test-framework-bundle>`"
    ":ref:`CalendarBundle <bundle-docs-platform-calendar-bundle>`","**F** ",":ref:`NoteBundle <bundle-docs-platform-note-bundle>`",":ref:`ThemeBundle <bundle-docs-platform-theme-bundle>`"
    ":ref:`ChartBundle <bundle-docs-platform-chart-bundle>`",":ref:`FeatureToggleBundle <bundle-docs-platform-feature-toggle-bundle>` ",":ref:`NotificationBundle <bundle-docs-platform-notification-bundle>` ",":ref:`TranslationBundle <bundle-docs-platform-translation-bundle>`"
    ":ref:`CommentBundle <bundle-docs-platform-comment-bundle>`",":ref:`FilterBundle <bundle-docs-platform-filter-bundle>` ","**O** ",":ref:`TwigInspectorBundle <bundle-docs-platform-twig-inspector-bundle>`"
    ":ref:`ConfigBundle <bundle-docs-platform-checkout-bundle>`",":ref:`FormBundle <bundle-docs-platform-form-bundle>` ",":ref:`OAuth2ServerBundle <bundle-docs-platform-oauth2-server-bundle>`","**U**"
    ":ref:`CronBundle <bundle-docs-platform-cron-bundle>`","**G** ",":ref:`OrganizationBundle <bundle-docs-platform-organization-bundle>`",":ref:`UIBundle <bundle-docs-platform-ui-bundle>`"
    ":ref:`CurrencyBundle <bundle-docs-platform-currency-bundle>`",":ref:`GaufretteBundle <bundle-docs-platform-gaufrette-bundle>` ","**P**","**W**"
    "**D**",":ref:`GridFSConfigBundle <bundle-docs-platform-gridfs-config-bundle>` ",":ref:`PlatformBundle <bundle-docs-platform-platform-bundle>` ",":ref:`WindowsBundle <bundle-docs-platform-windows-bundle>`"
    ":ref:`DashboardBundle <bundle-docs-platform-dashboard-bundle>`","**I** ","**Q** ",":ref:`WorkflowBundle <bundle-docs-platform-workflow-bundle>`"
    ":ref:`DataAuditBundle <bundle-docs-platform--data-audit>`",":ref:`ImapBundle <bundle-docs-platform-imap-bundle>` ",":ref:`QueryDesignerBundle <bundle-docs-platform-query-designer-bundle>`",
    ":ref:`DataGridBundle <bundle-docs-platform-datagrid>`",":ref:`ImportExportBundle <bundle-docs-platform-import-export-bundle>` ","**R**",

.. _bundle-docs-commerce:

OroCommerce Bundles
-------------------

All documentation that relates to OroCommerce-specific bundles is collected below.

.. csv-table::

   "**C**", ":ref:`InventoryBundle <bundle-docs-commerce-inventory-bundle>`", "**S**"
   ":ref:`CatalogBundle <bundle-docs-commerce-catalog-bundle>`", "**O**", ":ref:`SEOBundle <bundle-docs-commerce-seo-bundle>`"
   ":ref:`CheckoutBundle <bundle-docs-commerce-checkout-bundle>`", ":ref:`OrderBundle <bundle-docs-commerce-order-bundle>`", "**T**"
   ":ref:`CMSBundle <bundle-docs-commerce-cms-bundle>`", "**P**", ":ref:`TaxBundle <bundle-docs-commerce-tax-bundle>`"
   ":ref:`ConsentBundle <bundle-docs-commerce-consent-bundle>`", ":ref:`PayPalBundle <bundle-docs-commerce-paypal-bundle>`", "**W**"
   ":ref:`CookieConsentBundle <bundle-docs-commerce-cookie-consent-bundle>`", ":ref:`PricingBundle <bundle-docs-commerce-pricing-bundle>`", ":ref:`WebCatalogBundle <bundle-docs-commerce-webcatalog-bundle>`"
   ":ref:`CustomerBundle <bundle-docs-commerce-customer-portal-customer-bundle>`", ":ref:`ProductBundle <bundle-docs-commerce-product-bundle>`", ":ref:`WebsiteElasticSearchBundle <bundle-docs-commerce-website-elastic-search-bundle>`"
   "**F**", ":ref:`PromotionBundle <bundle-docs-platform-promotion-bundle>`", ":ref:`WebsiteSearchBundle <bundle-docs-commerce-website-search-bundle>`"
   ":ref:`FrontendBundle <bundle-docs-commerce-customer-portal-frontend-bundle>`", "**R**"
   "**I**", ":ref:`RedirectBundle <bundle-docs-commerce-redireect-bundle>`"



.. _bundle-docs-extensions:

Extensions' Bundles
-------------------

All documentation that relates to extensions' bundles is collected below.


.. csv-table::

   "**D**", "M", ""
   ":ref:`DotmailerBundle <bundle-docs-extensions-dotdigital>`",":ref:`MailchimpBundle <bundle-docs-extensions-mailchimp>`",""


.. toctree::
   :hidden:

   ActionBundle <platform/ActionBundle/index>
   ActivityBundle <platform/ActivityBundle/index>
   ActivityListBundle <platform/ActivityListBundle/index>
   AddressBundle <platform/AddressBundle/index>
   ApiBundle <platform/ApiBundle/index>
   AssetBundle <platform/AssetBundle/index>
   AttachmentBundle <platform/AttachmentBundle/index>
   BatchBundle <platform/BatchBundle/index>
   CacheBundle <platform/CacheBundle/index>
   CalendarBundle <platform/CalendarBundle/index>
   ChartBundle <platform/ChartBundle/index>
   CookieConsentBundle <commerce/CookieConsentBundle/index>
   CommentBundle <platform/CommentBundle/index>
   ConfigBundle <platform/ConfigBundle/index>
   CronBundle <platform/CronBundle/index>
   CurrencyBundle <platform/CurrencyBundle/index>
   DashboardBundle <platform/DashboardBundle/index>
   DataAuditBundle <platform/DataAuditBundle/index>
   DataGridBundle <platform/DataGridBundle/index>
   DistributionBundle <platform/DistributionBundle/index>
   DigitalAssetBundle <platform/DigitalAssetBundle/index>
   ElasticSearchBundle <platform/ElasticSearchBundle/index>
   EmailBundle <platform/EmailBundle/index>
   EmbeddedFormBundle <platform/EmbeddedFormBundle/index>
   EntityBundle <platform/EntityBundle/index>
   EntityConfigBundle <platform/EntityConfigBundle/index>
   EntityExtendBundle <platform/EntityExtendBundle/index>
   EntityMergeBundle <platform/EntityMergeBundle/index>
   EntityPaginationBundle <platform/EntityPaginationBundle/index>
   EntitySerializedFieldsBundle <platform/EntitySerializedFieldsBundle/index>
   FeatureToggleBundle <platform/FeatureToggleBundle/index>
   FilterBundle <platform/FilterBundle/index>
   FormBundle <platform/FormBundle/index>
   GaufretteBundle <platform/GaufretteBundle/index>
   GridFSConfigBundle <platform/GridFSConfigBundle/index>
   ImapBundle <platform/ImapBundle/index>
   ImportExportBundle <platform/ImportExportBundle/index>
   InstallerBundle <platform/InstallerBundle/index>
   IntegrationBundle <platform/IntegrationBundle/index>
   LayoutBundle <platform/LayoutBundle/index>
   LocaleBundle <platform/LocaleBundle/index>
   LoggerBundle <platform/LoggerBundle/index>
   MessageQueueBundle <platform/MessageQueueBundle/index>
   MigrationBundle <platform/MigrationBundle/index>
   MicrosoftSyncBundle <platform/MicrosoftSyncBundle/index>
   NavigationBundle <platform/NavigationBundle/index>
   NoteBundle <platform/NoteBundle/index>
   NotificationBundle <platform/NotificationBundle/index>
   OAuth2ServerBundle <platform/OAuth2ServerBundle/index>
   OrganizationBundle <platform/OrganizationBundle/index>
   PlatformBundle <platform/PlatformBundle/index>
   QueryDesignerBundle <platform/QueryDesignerBundle/index>
   RedisConfigBundle <platform/RedisConfigBundle/index>
   ReportBundle <platform/ReportBundle/index>
   ScopeBundle <platform/ScopeBundle/index>
   SearchBundle <platform/SearchBundle/index>
   SecurityBundle <platform/SecurityBundle/index>
   SegmentBundle <platform/SegmentBundle/index>
   SidebarBundle <platform/SidebarBundle/index>
   SyncBundle <platform/SyncBundle/index>
   TagBundle <platform/TagBundle/index>
   TestFrameworkBundle <platform/TestFrameworkBundle/index>
   ThemeBundle <platform/ThemeBundle/index>
   TranslationBundle <platform/TranslationBundle/index>
   TwigInspectorBundle <platform/TwigInspectorBundle/index>
   UIBundle <platform/UIBundle/index>
   WindowsBundle <platform/WindowsBundle/index>
   WorkflowBundle <platform/WorkflowBundle/index>
   DraftBundle <platform/DraftBundle/index>
   CatalogBundle <commerce/CatalogBundle/index>
   CheckoutBundle <commerce/CheckoutBundle/index>
   CMSBundle <commerce/CMSBundle/index>
   ConsentBundle <commerce/ConsentBundle/index>
   CustomerBundle <commerce/CustomerBundle/index>
   FrontendBundle <commerce/FrontendBundle/index>
   InventoryBundle <commerce/InventoryBundle/index>
   OrderBundle <commerce/OrderBundle/index>
   PayPalBundle <commerce/PayPalBundle/index>
   PromotionBundle <commerce/PromotionBundle/index>
   PricingBundle <commerce/PricingBundle/index>
   ProductBundle <commerce/ProductBundle/index>
   RedirectBundle <commerce/RedirectBundle/index>
   SEOBundle <commerce/SEOBundle/index>
   TaxBundle <commerce/TaxBundle/index>
   WebCatalogBundle <commerce/WebCatalogBundle/index>
   WebsiteElasticSearchBundle <commerce/WebsiteElasticSearchBundle/index>
   WebsiteSearchBundle <commerce/WebsiteSearchBundle/index>
   DotmailerBundle <extensions/DotmailerBundle/index>
   MailchimpBundle <extensions/MailchimpBundle/index>
