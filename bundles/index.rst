:title: Oro Application Bundles Documentation

.. meta::
   :description: A list of Oro application bundles

.. _bundle-docs:

Oro Bundles and Components
==========================

Bundles in Oro applications are a collection of files with the source code, configurations and additional assets organized in a conventional structure and providing ready-to-use functionality. Each Oro application comes with many prebuilt bundles organized in composer packages.

This section extends the rest of the Developer Guide, providing insight into core bundles implementation architecture and infrequently customizable features, which is particularly useful for non-standard customizations for backend and frontend developers as many features are interconnected. It also covers the Oro Config Component that provides additional resource types to the Symfony Config Component infrastructure.

Components
----------

Components documentation covers the Oro Config Component. It provides additional resource types to the Symfony Config Component infrastructure responsible for loading configurations from different data sources and optionally monitoring these data sources for changes.

* :ref:`Resource Types <dev-components-cumulative-resources>` provide a way to configure a bundle from other bundles.
* :ref:`Resource Merge <dev-components-configuration-merger>` provides a way to merge configurations of some resource both from one or many bundles. Supports two strategies: replace and append.
* :ref:`System Aware Resolver <dev-components-system-aware-resolver>` allows to make your configuration files more dynamic. For example, you can call service's methods, static methods, constants, context variables etc.


.. _bundle-docs-platform:

OroPlatform Bundles
-------------------

OroPlatform offers a wide range of bundles that contain the core functionality of the application. OroPlatform bundles reside in our GitHub repository. All documentation that relates to OroPlatform bundles is collected below.

.. csv-table::

    "**A**",":ref:`DigitalAssetBundle <bundle-docs-platform-dam>`",":ref:`InstallerBundle <bundle-docs-platform-installer-bundle>`","**Q**"
    ":ref:`ActionBundle <bundle-docs-platform-action-bundle>`",":ref:`DistributionBundle <bundle-docs-platform-distribution-bundle>`",":ref:`QueryDesignerBundle <bundle-docs-platform-query-designer-bundle>`","**R**"
    ":ref:`ActivityBundle <bundle-docs-platform-activity-bundle>`","**E**","**L**",":ref:`RedisConfigBundle <bundle-docs-platform-redis-bundle>`"
    ":ref:`ActivityListBundle <bundle-docs-platform-activity-list-bundle>`",":ref:`ElasticSearchBundle <bundle-docs-platform-elastic-search-bundle>`",":ref:`LayoutBundle <bundle-docs-platform-layout-bundle>`",":ref:`ReportBundle <bundle-docs-platform-report-bundle>`"
    ":ref:`AddressBundle <bundle-docs-platform-address-bundle>`",":ref:`EmailBundle <bundle-docs-platform-email-bundle>`",":ref:`LocaleBundle <bundle-docs-platform-locale-bundle>`","**S**"
    ":ref:`ApiBundle <bundle-docs-platform-api-bundle>`",":ref:`EmbeddedFormBundle <bundle-docs-platform-embedded-form-bundle>`",":ref:`LoggerBundle <bundle-docs-platform-logger-bundle>`",":ref:`ScopeBundle <bundle-docs-platform-scope-bundle>`"
    ":ref:`AssetBundle <bundle-docs-platform-asset-bundle>`",":ref:`EntityBundle <bundle-docs-platform-entity-bundle>`","**M**",":ref:`SearchBundle <bundle-docs-platform-search-bundle>`"
    ":ref:`AttachmentBundle <bundle-docs-platform-attachment-bundle>`",":ref:`EntityConfigBundle <bundle-docs-platform-entity-config-bundle>`",":ref:`McpBundle <bundle-docs-platform-mcp-bundle>`",":ref:`SecurityBundle <bundle-docs-platform-security-bundle>`"
    "**B**",":ref:`EntityExtendBundle <bundle-docs-platform-entity-extend-bundle>`",":ref:`MessageQueueBundle <bundle-docs-platform-message-queue-bundle>`",":ref:`SegmentBundle <bundle-docs-platform-segment-bundle>`"
    ":ref:`BatchBundle <bundle-docs-platform-batch-bundle>`",":ref:`EntityMergeBundle <bundle-docs-platform-entity-merge-bundle>`",":ref:`MicrosoftSyncBundle <bundle-docs-platform-microsoft-sync-bundle>`",":ref:`SidebarBundle <bundle-docs-platform-sidebar-bundle>`"
    "**C**",":ref:`EntityPaginationBundle <bundle-docs-platform-entity-pagination-bundle>`",":ref:`MigrationBundle <bundle-docs-platform-migration-bundle>`",":ref:`SyncBundle <bundle-docs-platform-sync-bundle>`"
    ":ref:`CacheBundle <bundle-docs-platform-cache-bundle>`",":ref:`EntitySerializedFieldsBundle <bundle-docs-platform-entity-serialized-bundle>`","**N**","**T**"
    ":ref:`CalendarBundle <bundle-docs-platform-calendar-bundle>`","**F**",":ref:`NavigationBundle <bundle-docs-platform-navigation-bundle>`",":ref:`TagBundle <bundle-docs-platform-tag-bundle>`"
    ":ref:`ChartBundle <bundle-docs-platform-chart-bundle>`",":ref:`FeatureToggleBundle <bundle-docs-platform-feature-toggle-bundle>`",":ref:`NoteBundle <bundle-docs-platform-note-bundle>`",":ref:`TestFrameworkBundle <bundle-docs-platform-test-framework-bundle>`"
    ":ref:`CommentBundle <bundle-docs-platform-comment-bundle>`",":ref:`FilterBundle <bundle-docs-platform-filter-bundle>`",":ref:`NotificationBundle <bundle-docs-platform-notification-bundle>`",":ref:`ThemeBundle <bundle-docs-platform-theme-bundle>`"
    ":ref:`ConfigBundle <bundle-docs-platform-checkout-bundle>`",":ref:`FormBundle <bundle-docs-platform-form-bundle>`","**O**",":ref:`TranslationBundle <bundle-docs-platform-translation-bundle>`"
    ":ref:`CronBundle <bundle-docs-platform-cron-bundle>`","**G**",":ref:`OAuth2ServerBundle <bundle-docs-platform-oauth2-server-bundle>`",":ref:`TwigInspectorBundle <bundle-docs-platform-twig-inspector-bundle>`"
    ":ref:`CurrencyBundle <bundle-docs-platform-currency-bundle>`",":ref:`GaufretteBundle <bundle-docs-platform-gaufrette-bundle>`",":ref:`OidcBundle <bundle-docs-platform-oidcbundle>`","**U**"
    "**D**",":ref:`GridFSConfigBundle <bundle-docs-platform-gridfs-config-bundle>`","**P**",":ref:`UIBundle <bundle-docs-platform-ui-bundle>`"
    ":ref:`DashboardBundle <bundle-docs-platform-dashboard-bundle>`","**I**",":ref:`PdfGeneratorBundle <bundle-docs-platform-pdf-generator-bundle>`","**W**"
    ":ref:`DataAuditBundle <bundle-docs-platform--data-audit>`",":ref:`ImapBundle <bundle-docs-platform-imap-bundle>`",":ref:`PlatformBundle <bundle-docs-platform-platform-bundle>`",":ref:`WindowsBundle <bundle-docs-platform-windows-bundle>`"
    ":ref:`DataGridBundle <bundle-docs-platform-datagrid>`",":ref:`ImportExportBundle <bundle-docs-platform-import-export-bundle>`","**Q**",":ref:`WorkflowBundle <bundle-docs-platform-workflow-bundle>`"


.. _bundle-docs-commerce:

OroCommerce Bundles
-------------------

All documentation that relates to OroCommerce-specific bundles is collected below.

.. csv-table::

   "**C**",":ref:`InventoryBundle <bundle-docs-commerce-inventory-bundle>`","**S**"
   ":ref:`CatalogBundle <bundle-docs-commerce-catalog-bundle>`",":ref:`InvoicePaymentBundle <bundle-docs-commerce-invoice-payment-bundle>`",":ref:`SellerDashboardBundle <bundle-docs-commerce-seller-dashboard-bundle>`"
   ":ref:`CheckoutBundle <bundle-docs-commerce-checkout-bundle>`","**M**",":ref:`SEOBundle <bundle-docs-commerce-seo-bundle>`"
   ":ref:`CMSBundle <bundle-docs-commerce-cms-bundle>`",":ref:`MultiWebsiteBundle <bundle-docs-commerce-multi-website-bundle>`",":ref:`ShoppingListBundle <bundle-docs-commerce-shopping-list-bundle>`"
   ":ref:`ConsentBundle <bundle-docs-commerce-consent-bundle>`","**O**",":ref:`SalesFrontendBundle <bundle-docs-commerce-sales-frontend-bundle>`"
   ":ref:`CommerceMenuBundle <bundle-docs-commerce-commerce-menu-bundle>`",":ref:`OrderBundle <bundle-docs-commerce-order-bundle>`","**T**"
   ":ref:`CookieConsentBundle <bundle-docs-commerce-cookie-consent-bundle>`","**P**",":ref:`TaxBundle <bundle-docs-commerce-tax-bundle>`"
   ":ref:`CustomerBundle <bundle-docs-commerce-customer-portal-customer-bundle>`",":ref:`PaymentBundle <bundle-docs-commerce-payment-bundle>`","**W**"
   ":ref:`CustomerRecommendationBundle <bundles--commerce--customer-recommendation>`",":ref:`PayPalBundle <bundle-docs-commerce-paypal-bundle>`",":ref:`WebCatalogBundle <bundle-docs-commerce-webcatalog-bundle>`"
   "**F**",":ref:`PricingBundle <bundle-docs-commerce-pricing-bundle>`",":ref:`WebsiteElasticSearchBundle <bundle-docs-commerce-website-elastic-search-bundle>`"
   ":ref:`FrontendBundle <bundle-docs-commerce-customer-portal-frontend-bundle>`",":ref:`ProductBundle <bundle-docs-commerce-product-bundle>`",":ref:`WebsiteSearchBundle <bundle-docs-commerce-website-search-bundle>`"
   ":ref:`FrontendMcpBundle <bundle-docs-commerce-frontend-mcp-bundle>`",":ref:`PromotionBundle <bundle-docs-commerce-promotion-bundle>`",":ref:`WarehouseBundle <bundle-docs-commerce-warehouse-bundle>`"
   ":ref:`FrontendPdfGeneratorBundle <bundle-docs-commerce-frontend-pdf-generator-bundle>`","**R**",""
   "**I**",":ref:`RedirectBundle <bundle-docs-commerce-redirect-bundle>`",""

.. _bundle-docs-extensions:

Extensions' Bundles
-------------------

Documentation that relates to extensions' bundles is collected below. You can download extensions from the |Oro Extensions Store Commerce|.

.. csv-table::

   "**A**",":ref:`DotmailerBundle <bundle-docs-extensions-dotdigital>`",":ref:`InfinitePayBundle <bundle-docs-extensions-infinitepay>`",":ref:`PaypalExpressBundle <bundle-docs-extensions-paypalexpress>`"
   ":ref:`AiContentGenerationBundle <bundle-docs-extensions-ai-content-generation>`",":ref:`DPDBundle <bundle-docs-extensions-dpd>`","**M**","**S**"
   ":ref:`ApruveBundle <bundle-docs-extensions-apruve>`","**G**",":ref:`MailchimpBundle <bundle-docs-extensions-mailchimp>`",":ref:`StripeBundle <bundle-docs-extensions-stripe>`"
   ":ref:`AuthorizeNetBundle <bundle-docs-extensions-authorizenet>`",":ref:`GoogleTagManagerBundle <bundle-docs-extensions-gtm>`",":ref:`MakerBundle <bundle-docs-extensions-maker>`",":ref:`StripePaymentBundle <bundle-docs-extensions-stripe-payment-bundle>`"
   "**D**","**I**","**P**",":ref:`StorefrontAgentBundle <bundle-docs-extensions-storefront-agent-bundle-commands>`"

CRM Bundles
-----------

.. csv-table::

    "**A**","**C**", "**S**"
    ":ref:`ActivityContactBundle <bundle-docs-crm-activity-contact-bundle>`", ":ref:`ChannelBundle <bundle-docs-crm-channel-bundle>`", ":ref:`SalesBundle <bundle-docs-crm-sales-bundle>`"
    ":ref:`AnalyticsBundle <bundle-docs-crm-analytics-bundle>`", "", ""


.. admonition:: Business Tip

    Which |B2B eCommerce solutions| are the best ones? Refer to our platform comparison page to explore and evaluate your digital commerce options.


.. toctree::
   :hidden:

   Components <components/index>
   ActionBundle <platform/ActionBundle/index>
   ActivityBundle <platform/ActivityBundle/index>
   ActivityContactBundle <crm/ActivityContactBundle/index>
   ActivityListBundle <platform/ActivityListBundle/index>
   AddressBundle <platform/AddressBundle/index>
   AddressValidationBundle <commerce/AddressValidationBundle/index>
   AiContentGenerationBundle <extensions/AiContentGenerationBundle/index>
   AnalyticsBundle <crm/AnalyticsBundle/index>
   ApiBundle <platform/ApiBundle/index>
   ApruveBundle <extensions/ApruveBundle/index>
   AssetBundle <platform/AssetBundle/index>
   AttachmentBundle <platform/AttachmentBundle/index>
   AuthorizeNetBundle <extensions/AuthorizeNetBundle/index>
   BatchBundle <platform/BatchBundle/index>
   CacheBundle <platform/CacheBundle/index>
   CalendarBundle <platform/CalendarBundle/index>
   CatalogBundle <commerce/CatalogBundle/index>
   ChannelBundle <crm/ChannelBundle/index>
   ChartBundle <platform/ChartBundle/index>
   CheckoutBundle <commerce/CheckoutBundle/index>
   CMSBundle <commerce/CMSBundle/index>
   CommentBundle <platform/CommentBundle/index>
   CommerceInvoiceBundle <commerce/CommerceInvoiceBundle/index>
   CommerceMenuBundle <commerce/CommerceMenuBundle/index>
   ConfigBundle <platform/ConfigBundle/index>
   ConsentBundle <commerce/ConsentBundle/index>
   CookieConsentBundle <commerce/CookieConsentBundle/index>
   CronBundle <platform/CronBundle/index>
   CurrencyBundle <platform/CurrencyBundle/index>
   CustomerBundle <commerce/CustomerBundle/index>
   CustomerRecommendationBundle <commerce/CustomerRecommendationBundle/index>
   DashboardBundle <platform/DashboardBundle/index>
   DataAuditBundle <platform/DataAuditBundle/index>
   DataGridBundle <platform/DataGridBundle/index>
   DigitalAssetBundle <platform/DigitalAssetBundle/index>
   DistributionBundle <platform/DistributionBundle/index>
   DotmailerBundle <extensions/DotmailerBundle/index>
   DPDBundle <extensions/DPDBundle/index>
   DraftBundle <platform/DraftBundle/index>
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
   FrontendBundle <commerce/FrontendBundle/index>
   FrontendMcpBundle <commerce/FrontendMcpBundle/index>
   FrontendPdfGeneratorBundle <commerce/FrontendPdfGeneratorBundle/index>
   GaufretteBundle <platform/GaufretteBundle/index>
   GoogleTagManagerBundle <extensions/GoogleTagManagerBundle/index>
   GridFSConfigBundle <platform/GridFSConfigBundle/index>
   ImapBundle <platform/ImapBundle/index>
   ImportExportBundle <platform/ImportExportBundle/index>
   InfinitePayBundle <extensions/InfinitePayBundle/index>
   InstallerBundle <platform/InstallerBundle/index>
   IntegrationBundle <platform/IntegrationBundle/index>
   InventoryBundle <commerce/InventoryBundle/index>
   InvoiceBundle <platform/InvoiceBundle/index>
   InvoicePaymentBundle <commerce/InvoicePaymentBundle/index>
   LayoutBundle <platform/LayoutBundle/index>
   LocaleBundle <platform/LocaleBundle/index>
   LoggerBundle <platform/LoggerBundle/index>
   MailchimpBundle <extensions/MailchimpBundle/index>
   MakerBundle <extensions/MakerBundle/index>
   McpBundle <platform/McpBundle/index>
   MessageQueueBundle <platform/MessageQueueBundle/index>
   MicrosoftSyncBundle <platform/MicrosoftSyncBundle/index>
   MigrationBundle <platform/MigrationBundle/index>
   MultiWebsiteBundle <commerce/MultiWebsiteBundle/index>
   NavigationBundle <platform/NavigationBundle/index>
   NoteBundle <platform/NoteBundle/index>
   NotificationBundle <platform/NotificationBundle/index>
   OAuth2ServerBundle <platform/OAuth2ServerBundle/index>
   OrderBundle <commerce/OrderBundle/index>
   OidcBundle <platform/OidcBundle/index>
   OrganizationBundle <platform/OrganizationBundle/index>
   PaymentBundle <commerce/PaymentBundle/index>
   PayPalBundle <commerce/PayPalBundle/index>
   PaypalExpressBundle <extensions/PaypalExpressBundle/index>
   PdfGeneratorBundle <platform/PdfGeneratorBundle/index>
   PlatformBundle <platform/PlatformBundle/index>
   PricingBundle <commerce/PricingBundle/index>
   ProductBundle <commerce/ProductBundle/index>
   PromotionBundle <commerce/PromotionBundle/index>
   QueryDesignerBundle <platform/QueryDesignerBundle/index>
   RedirectBundle <commerce/RedirectBundle/index>
   RedisConfigBundle <platform/RedisConfigBundle/index>
   ReportBundle <platform/ReportBundle/index>
   SalesBundle <crm/SalesBundle/index>
   SalesFrontendBundle <commerce/SalesFrontendBundle/index>
   ScimBundle <platform/ScimBundle/index>
   ScopeBundle <platform/ScopeBundle/index>
   SearchBundle <platform/SearchBundle/index>
   SecurityBundle <platform/SecurityBundle/index>
   SegmentBundle <platform/SegmentBundle/index>
   SellerDashboardBundle <commerce/SellerDashboardBundle/index>
   SEOBundle <commerce/SEOBundle/index>
   ShoppingListBundle <commerce/ShoppingListBundle/index>
   SidebarBundle <platform/SidebarBundle/index>
   StorefrontAgentBundle <extensions/StorefrontAgentBundle/commands>
   StripeBundle <extensions/StripeBundle/index>
   StripePaymentBundle <extensions/StripePaymentBundle/index>
   SyncBundle <platform/SyncBundle/index>
   TagBundle <platform/TagBundle/index>
   TaxBundle <commerce/TaxBundle/index>
   TestFrameworkBundle <platform/TestFrameworkBundle/index>
   ThemeBundle <platform/ThemeBundle/index>
   TranslationBundle <platform/TranslationBundle/index>
   TwigInspectorBundle <platform/TwigInspectorBundle/index>
   UIBundle <platform/UIBundle/index>
   WarehouseBundle <commerce/WarehouseBundle/index>
   WebCatalogBundle <commerce/WebCatalogBundle/index>
   WebsiteElasticSearchBundle <commerce/WebsiteElasticSearchBundle/index>
   WebsiteSearchBundle <commerce/WebsiteSearchBundle/index>
   WindowsBundle <platform/WindowsBundle/index>
   WorkflowBundle <platform/WorkflowBundle/index>


.. include:: /include/include-links-seo.rst
   :start-after: begin

.. include:: /include/include-links-dev.rst
   :start-after: begin
