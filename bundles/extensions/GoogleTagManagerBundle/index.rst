.. _bundle-docs-extensions-gtm:

GoogleTagManagerBundle
======================

|OroGoogleTagManagerBundle| adds integration with |Google Tag Manager| (GTM), which enables users to add tracking tags to their OroCommerce web store pages with the help of |Enhanced E-commerce| and collect information on customer behavior, purchases, product clicks, page views, etc. All this information can subsequently be shared with Google Analytics to measure various user interactions with products on their website through |E-Commerce reports|. This can help you get a full picture of on-page visitor behavior, how well your marketing strategies work, and how to target your audience better.

To learn how to create a new integration with Google Tag Manager in your Oro application, please see :ref:`a step-by-step user guide on configuring GTM <gtm-integration>`.

Add Server-Side Events
----------------------

Create Custom Collector
^^^^^^^^^^^^^^^^^^^^^^^

The easiest way to add a GTM message to a web page is to create a custom collector class.
Your collector class must implement ``\Oro\Bundle\GoogleTagManagerBundle\DataLayer\Collector\CollectorInterface`` and be tagged by ``oro_google_tag_manager.data_layer.collector``.

For example:

.. code-block:: php

    namespace Acme\Bundle\AcmeBundle\DataLayer\Collector;

    use Doctrine\Common\Collections\Collection;
    use Oro\Bundle\GoogleTagManagerBundle\DataLayer\Collector\CollectorInterface;

    class CustomCollector implements CollectorInterface
    {
        public function handle(Collection $data): void
        {
            $data->add([
                'event' => 'acmeEventName',
                'my-custom-key' => 'My custom data',
            ]);
        }
    }


.. code-block:: yaml

    services:
        acme_bundle.data_layer.collector.user_detail:
            class: Acme\Bundle\AcmeBundle\DataLayer\Collector\CustomCollector
            tags:
                - { name: oro_google_tag_manager.data_layer.collector }


Add Event to DataLayerManager Manually
--------------------------------------

In cases when you need to add data to the GTM data layer manually, use service `oro_google_tag_manager.data_layer.manager` directly.
The example below illustrates adding an event when the entity changes:

.. code-block:: php

    namespace Acme\Bundle\AcmeBundle\EventListener;

    use Acme\Bundle\AcmeBunde\Entity\SomeEntity;
    use Doctrine\ORM\Event\PreUpdateEventArgs;
    use Oro\Bundle\GoogleTagManagerBundle\DataLayer\DataLayerManager;
    use Oro\Bundle\GoogleTagManagerBundle\Provider\GoogleTagManagerSettingsProviderInterface;

    class ExampleEventListener
    {
        /** @var DataLayerManager */
        private $dataLayerManager;

        /** @var GoogleTagManagerSettingsProviderInterface */
        private $settingsProvider;

        /** @var array */
        private $data = [];

        public function __construct(
            DataLayerManager $dataLayerManager,
            GoogleTagManagerSettingsProviderInterface $settingsProvider
        ) {
            $this->dataLayerManager = $dataLayerManager;
            $this->settingsProvider = $settingsProvider;
        }

        public function preUpdate(SomeEntity $entity, PreUpdateEventArgs $args): void
        {
            // Check enabled GTM integration
            if (!$this->isApplicable()) {
                return;
            }

            // For example, we will add message when changing a specific field
            if ($args->hasChangedField('someFieldName')) {
                $this->data[] = [
                    'oldValue' => $args->getOldValue('someFieldName'),
                    'newValue' => $args->getNewValue('someFieldName'),
                ];
            }
        }

        public function postFlush(): void
        {
            // Add all collected messages to DataLayerManager
            foreach ($this->data as $data) {
                $this->dataLayerManager->add([
                    'event' => 'acmeSomeEntityUpdate',
                    'entityUpdate' => $data,
                ]);
            }

            // Clear listener
            $this->onClear();
        }

        public function onClear(): void
        {
            $this->data = [];
        }

        private function isApplicable(): bool
        {
            // Check enable GTM integration
            if (!$this->settingsProvider->getGoogleTagManagerSettings()) {
                return false;
            }

            // If necessary, check any other global conditions to apply this listener

            return true;
        }
    }


Register this listener as a service:

.. code-block:: yaml

    services:
        oro_google_tag_manager.event_listener.checkout:
        acme_bundle.event_listener.example:
            class: Acme\Bundle\AcmeBundle\EventListener\ExampleEventListener
            public: false
            arguments:
                - '@oro_google_tag_manager.data_layer.manager'
                - '@oro_google_tag_manager.provider.google_tag_manager_settings'
            tags:
                - { name: doctrine.orm.entity_listener, entity: 'Acme\Bundle\AcmeBunde\Entity\SomeEntity', event: preUpdate }
                - { name: doctrine.event_listener, event: postFlush }
                - { name: doctrine.event_listener, event: onClear }

Add Client-Side Events
----------------------

Product Events
^^^^^^^^^^^^^^

Service `oro_google_tag_manager.provider.product_detail` is responsible for transferring product data to Google Analytics.
Below is an example of updating the product block for product lists via layout update functionality:

.. code-block:: yaml

    layout:
        actions:
            - '@setBlockTheme':
                themes: '@OroGoogleTagManager/layouts/blank/imports/oro_product_list_item/oro_product_list_item.html.twig'
            - '@add':
                id: __google_tag_manager_product_model_expose
                parentId: __product
                blockType: block
                options:
                    # This block must be rendered only when GTM integration is active
                    visible: '=data["oro_google_tag_manager_settings"].isReady()'


.. code-block:: twig

    {% block __oro_product_list_item__google_tag_manager_product_model_expose_widget %}
        {% if product is defined %}
            {# In this block, we have a Product entity from which we need to get data #}
            {% set productDetail = oro_google_tag_manager_product_detail(product) %}
            {% set attr = layout_attr_defaults(attr, {'~class': ' hidden', 'data-gtm-model': productDetail}) %}
            <div {{ block('block_attributes') }}></div>
        {% endif %}
    {% endblock %}

See more in |products-embedded-list-gtm-component.js| and |product-details-gtm-helper.js|.

Push GTM Message In JavaScript
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To push some data to the GTM data layer from the javascript code, trigger event `gtm:event:push`.

For example:

.. code-block:: javascript

    var mediator = require('oroui/js/mediator');
    mediator.trigger('gtm:event:push', {
        event: 'eventName',
        anyEventKeys: 'Any event data'
    });

.. include:: /include/include-links-dev.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin