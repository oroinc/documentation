.. _bundle-docs-commerce-redireect-bundle:

OroRedirectBundle
=================

|OroRedirectBundle| enables slug management for the product, category, brand, and landing pages in the OroCommerce storefront.

The bundle enables OroCommerce management console administrators to configure automatic slug generation and related options in the system configuration UI. It also provides the ability for content managers to modify slugs manually for every sluggable page.

Semantic URLs
-------------

Entity Interfaces
^^^^^^^^^^^^^^^^^

Semantic URLs, also sometimes referred to as clean URLs, RESTful URLs, user-friendly URLs, or search engine-friendly URLs, are Uniform Resource Locators (URLs) intended to improve the usability and accessibility of a website or a web service by being immediately and intuitively meaningful to non-expert users.

**Concepts**

- A Slug Prototype is part of a semantic URL representing the current entity without the context part and unique suffixes.

- A Slug is a complete representation of a semantic URL with a parent slug included. Optionally, it can include an automatically generated uniqueness suffix.

- Option *with redirect*. When the with redirect option is given, an entry is created in the redirect table with an instruction to redirect from the old URL to the new one.

You can extend an entity in the system with only a slug prototype if it has no slugs but only provides prototypes. An entity can also contain a collection of related slugs.

Entities that support slug prototypes should implement one of the following interfaces:

- ``Oro\Bundle\RedirectBundle\Entity\LocalizedSlugPrototypeAwareInterface`` - for localized slug prototypes. Interface is implemented in ``Oro\Bundle\RedirectBundle\Entity\LocalizedSlugPrototypeAwareTrait``.
- ``Oro\Bundle\RedirectBundle\Entity\LocalizedSlugPrototypeWithRedirectAwareInterface`` - for localized slug prototypes with redirect. Interface is implemented in ``Oro\Bundle\RedirectBundle\Entity\LocalizedSlugPrototypeWithRedirectAwareTrait``.
- ``Oro\Bundle\RedirectBundle\Entity\TextSlugPrototypeAwareInterface`` - for localized slug prototypes where slugs are stored in a text field. Interface is implemented in ``Oro\Bundle\RedirectBundle\Entity\TextSlugPrototypeAwareTrait``.
- ``Oro\Bundle\RedirectBundle\Entity\TextSlugPrototypeWithRedirectAwareInterface`` - for localized slug prototypes where slugs are stored in a text field with redirect. Interface is implemented in ``Oro\Bundle\RedirectBundle\Entity\TextSlugPrototypeWithRedirectAwareTrait``.

Entities that support slugs should implement ``Oro\Bundle\RedirectBundle\Entity\SlugAwareInterface`` which is implemented in ``Oro\Bundle\RedirectBundle\Entity\SlugAwareTrait``.
In most cases, you can use ``Oro\Bundle\RedirectBundle\Entity\SluggableInterface``. It extends ``LocalizedSlugPrototypeWithRedirectAwareInterface`` and ``SlugAwareInterface``. The corresponding trait name is ``SlugAwareTrait``.

.. _bundle-docs-commerce-redireect-bundle-migration-extension:

Migration Extension
^^^^^^^^^^^^^^^^^^^

``SlugExtension`` is used to simplify sluggable entities management in migration. When creating a new installer or an update script that manages sluggable entities, implement ``SlugExtensionAwareInterface`` and use methods of ``SlugExtension`` to add a new slug prototype and slug relations:

- ``addLocalizedSlugPrototypes`` - adds a relation to a localized slug prototype
- ``addSlugs`` - creates a slugs relation table

Canonical URLs
^^^^^^^^^^^^^^

Typical implementations of the canonical link relation specify the preferred version of an IRI from duplicate pages created with the addition of IRI parameters (e.g., session IDs) or specify the single-page version as preferred over the same content separated on multiple component pages.

At Oro, one of the system URLs or semantic URLs can be used as a canonical URL. This option is managed by the ``oro_redirect.canonical_url_type`` system config option.

Semantic URL Caching
^^^^^^^^^^^^^^^^^^^^

Each time a sluggable URL is generated, the system checks the database for the existence of a semantic URL for the requested route with route parameters.

This can lead to a considerable amount of DB queries, increased page response time, and an increased number of queries to the DB. To avoid this, you can cache Semantic URLs. Oro provides three caches types and two URL providers.

URL Caches
~~~~~~~~~~

Each Oro installation can take place in different environments. To give system administrators maximum flexibility, OroCommerce provides three types of caches that can be configured with the DI parameter `oro_redirect.url_cache_type`.

- **storage** (default) - stores cached URLs in groups. It is the best fit for filesystem-based caches as its usage minimizes the required space and number of available inodes. This type of cache groups the same URLs. You can tune the grouping factor with the DI parameter `oro_redirect.url_storage_cache.split_deep`, which is an integer in range 1..32. The default is set to 2, which handles up to 1M of slugs. For an installation that has more slugs, increase this parameter. Note that increasing this option will lead to an increased number of cache files which may require more space and inodes.

- **key_value** - stores each cached value by its key. It is the best fit for key-value-based caches like Redis.

- **local** - stores caches in local array cache. It can be used with a `database` URL provider, allowing semantic URLs usage without their actual caching in the persistent cache.

Service `oro_redirect.url_cache`  must be used for interaction with semantic URL caches.

URL Provider
~~~~~~~~~~~~

Semantic URLs should be received from URL providers. These services interact with caches and provide URLs that can be returned to the output.
There are two providers in OroCommerce:

- **cache** - reads data from `oro_redirect.url_cache`. Semantic URLs are available only after they appear in cache (URL is processed by MQ).

- **database** - if a URL is not found in the decorated cache, this provider performs a request to the database. If URL is found, it is stored in the cache. Using this provider, you'll get a semantic URL immediately, but it can send requests to the database, which may decrease performance.

You can change the URL provider with the DI parameter `oro_redirect.url_provider_type`.

Sluggable URLs Matching
^^^^^^^^^^^^^^^^^^^^^^^

In Oro, we have implemented an extension over the Symfony default routing logic to match Semantic URLs. System URLs are matched first, followed by semantic.
To skip some URL from slug matching, skip the list by calling `addSkippedUrlPattern` of  the `oro_redirect.routing.matched_url_decision_maker` service.

.. include:: /include/include-links-dev.rst
   :start-after: begin
