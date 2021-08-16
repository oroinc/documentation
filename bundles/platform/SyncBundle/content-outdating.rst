Content Outdating
=================

To see if an opened page or page that comes from the local cache (JS when a page is pinned) has been changed, notify the client application when content is changed ASAP. To improve timings, we use WebSocket pub/sub protocol for pushing notifications to the client.

Frontend Implementation
-----------------------

The content manager object is responsible for storing cached content and tags related to content (for just loaded or cached).
Hash navigation is responsible for caching content, and templates are responsible for content tagging.
If your template is based on base templates of UIBundle (such as action/index.html.twig, action/update.html.twig), your content will be tagged automatically; when you need to add tags dynamically, use content manager directly.

**Example**

.. code-block:: html+jinja

    {% import '@OroUI/macros.html.twig' as UI %}

    <div {{ UI.renderPageComponentAttributes({
        module: 'orosync/js/app/components/tag-content',
        options: {
            tags: [/* list of tags*/]
        }
    }) }} ></div>

When your template extends the base template, but content depends on some additional objects, use macros defined in ``SyncBundle/Resources/views/Include/contentTags.html.twig``.

**Example**

.. code-block:: twig

    {% block sync_content_tags %}
        {# Main entity here #}
        {{ syncMacro.syncContentTags(entity) }}

        {# Additional entity here #}
        {{ syncMacro.syncContentTags(someAdditionalEntity) }}
    {% endblock %}

Backend Implementation
----------------------

For doctrine entities, tag generation is covered in the onFlush event listener. For each entity modified into UnitOfWork, the `ChainTagGenerator#generate` method will be invoked.
To add your own generator into the chain, develop a class that implements `TagGeneratorInterface` and register it as a service with the `oro_sync.tag_generator` tag.