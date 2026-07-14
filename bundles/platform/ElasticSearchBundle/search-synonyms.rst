.. _bundle-docs-platform-elastic-search-bundle-synonyms:

Back-Office Search Synonyms
===========================

The back-office Elasticsearch engine supports configurable search synonyms, so abbreviated and spelled-out forms resolve to the same matches
(for example, ``123 Main St`` ≡ ``123 Main Street``, ``118 NE Dr`` ≡ ``118 Northeast Drive``, ``NC`` ≡ ``North Carolina``).

This is a config-driven, developer-facing capability and there is no synonyms management UI in the back-office.
Synonym groups are stored as ``Oro\Bundle\ElasticSearchBundle\Entity\Synonym`` reference data (one Solr synonym group per row) and are usually seeded via a data migration.

Enabling Synonyms for Entity Index
----------------------------------

1. Mark the entity as synonym-aware in its ``Resources/config/oro/search.yml``:

   .. code-block:: yaml

       search:
           Acme\Bundle\AcmeBundle\Entity\MyEntity:
               alias: acme_my_entity
               synonyms_enabled: true
               # ... fields

2. Enable the **Enable Search Synonyms** option under :ref:`System Configuration > General Setup > Search > Search Synonyms <bundle-docs-platform-elastic-search-bundle-synonyms>` in the back-office (``oro_elastic_search.synonyms_enabled``).
Toggling it applies synonyms live, no full reindex is required.

3. Seed ``Synonym`` rows for the entity alias (one row per synonym group), for example via a data migration.

Synonyms are also injected into the index settings at creation time, so they persist across ``oro:search:reindex``. Run ``oro:elasticsearch:search-synonyms:refresh`` to re-apply synonyms to existing indexes manually.

Extensibility
-------------

The synonym filter is populated through the ``Oro\Bundle\ElasticSearchBundle\Event\ElasticSearchIndexSettingsEvent`` event (``oro_elastic_search.index_settings``),
dispatched in ``Engine\IndexAgent`` before an index is created. Any bundle can listen to this event to inject custom analysis settings without patching the engine.

Listener example:

.. code-block:: php

    namespace Acme\Bundle\AcmeBundle\EventListener;

    use Oro\Bundle\ElasticSearchBundle\Event\ElasticSearchIndexSettingsEvent;

    class MyEntityIndexSettingsEventListener
    {
        public function onIndexSettings(ElasticSearchIndexSettingsEvent $event): void
        {
            if ($event->getClass() !== \Acme\Bundle\AcmeBundle\Entity\MyEntity::class) {
                return;
            }

            $settings = $event->getSettings();
            $settings['analysis']['filter']['synonym']['synonyms'] = ['street, st', 'avenue, ave'];
            $event->setSettings($settings);
        }
    }

Register the listener for the ``oro_elastic_search.index_settings`` event:

.. code-block:: yaml

    services:
        acme_bundle.event_listener.my_entity_index_settings:
            class: Acme\Bundle\AcmeBundle\EventListener\MyEntityIndexSettingsEventListener
            tags:
                - { name: kernel.event_listener, event: oro_elastic_search.index_settings, method: onIndexSettings }
