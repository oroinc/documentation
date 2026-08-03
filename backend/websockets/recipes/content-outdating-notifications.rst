.. _dev-cookbook-system-websockets-content-outdating-notifications:

Use Content Outdated Notifications in Oro Applications
======================================================

A continuous WebSocket connection links the Oro application server and the user’s browser. Thanks to it, users receive a flash-message about content changes when they edit a page at the same time as another user.

.. note:: A user can receive this message only if another user makes a change. No notification is received if the same user made changes in a new browser tab, window, or on another device.

It works out-of-the-box with content types (entities) delivered in Oro applications. 

If you want your custom entities to have this functionality, refer to the sections below.

How It Works
------------

On the frontend side, the Content Manager JS component tracks outdated content. It stores an array of tags (content identifiers) for every content item to track its status.

The content manager subscribes to the **oro/data/update** WebSockets topic. The server sends a notification to this topic whenever content changes on the server side.

The change message includes only the tag (identifier) of the changed content. The content manager compares this tag against its list of tracking tags.

If the tag is in the list, the content manager runs the actions planned for content with that tag. If the tag is not tracked, the content manager ignores the WebSocket message.

To have the content manager track a content item, explicitly request it by passing a **unique content tag** and an optional **callback** to the **tagContent** method.

.. code-block:: javascript

    import loadModules from 'oroui/js/app/services/load-modules';

    loadModules('orosync/js/content-manager')
        .then(contentManager => contentManager.tagContent([someContentTag], callback);

How to Get the Unique Content Tag
---------------------------------

You can create a content tag for each content item yourself, but the Oro application also offers Tag Generator services for convenience. A TagGenerator receives a content item (any data object) and creates a unique content tag from it.

Oro applications have implemented three built-in tag generators:
 
* *DoctrineTagGenerator*
* *SimpleTagGenerator*
* *ChainTagGenerator*
 
DoctrineTagGenerator, for example, receives an entity object and creates a content tag based on the information about the entity type and the entity object ID. ChainTagGenerator combines all registered generators in the application.

To create your own generator, you should develop a class that implements **TagGeneratorInterface** and register it as a service with the **oro_sync.tag_generator** tag.

To generate a content tag on the **frontend side**, you should use the **oro_sync_get_content_tags** Twig function:

.. code-block:: php

    oro_sync_get_content_tags(data, includeCollectionTag = false, processNestedData = false)

Therefore, the full example for adding the content to the tracked one in Content Manager is:

.. code-block:: php

    {% import '@OroUI/macros.html.twig' as UI %}

    <div {{ UI.renderPageComponentAttributes({
        module: 'orosync/js/app/components/tag-content',
        options: {
            tags: oro_sync_get_content_tags(data, includeCollectionTag)
        }
    }) }} ></div>

This is what the **syncContentTags** macro does --- see its source in the *Oro/Bundle/SyncBundle/Resources/views/Include/contentTags.html.twig* file. The shortest code to add content to the Content Manager tracking registry is:

.. code-block:: twig

    {% import '@OroSync/Include/contentTags.html.twig' as syncMacro %}
    {{ syncMacro.syncContentTags(entity) }}

To generate a content tag on the backend side, use the **oro_sync.content.tag_generator** service directly:

.. code-block:: php

    /** @var TagGeneratorInterface $tagGenerator */
    $tagGenerator = $container->get(‘oro_sync.content.tag_generator’);
    $contentTag = $tagGenerator->generate(entity);

When the Server Sends Messages to the Frontend about Outdated Content
---------------------------------------------------------------------

**DoctrineTagEventListener** listens for changes in Doctrine-managed entities. When an entity record changes, the listener generates the entity content tag with *DoctrineTagGenerator* and sends the content tags of the changed entities to the **oro/data/update** WebSockets topic.

How to Add the Custom Content Type to the Content Manager Tracking Registry
---------------------------------------------------------------------------

If you use the base *OroUIBundle* templates for your content type's view/edit pages and a Doctrine-managed entity to store it, the *Oro/Bundle/UIBundle/Resources/views/actions/view.html.twig* and *Oro/Bundle/UIBundle/Resources/views/actions/update.html.twig* templates already add your content items to the Content Manager registry. DoctrineTagEventListener already listens for changes to your content.

If you use a *custom base template* for the view/edit pages, use the *syncContentTags* macro to add the content tag of your content item to the Content Manager registry.

If your content type depends on another content type, and you want the user to receive notifications about another content type on your content type page, you have to add another content type tag to the Content Manager tracking registry:

.. code-block:: twig

    {% import '@OroSync/Include/contentTags.html.twig' as syncMacro %}
    {{ syncMacro.syncContentTags(primaryEntity) }}
    {{ syncMacro.syncContentTags(anotherEntity) }}

To add custom information to content outdated tracking (for example, to inform a user about being assigned a new task) --- on top of the built-in functionality that tracks and sends a message about the changed information --- you need to develop a custom *TagGenerator* that creates identifiers for your content.

In this case, the complete customization scenario might look like this:

1. Create and register *Doctrine event listener* that waits for changes in the Tasks entities.
2. Create and register *Tag Generator* that creates *content tags* for user task data based on the user identifier.
3. In the listener, when a user's task set is changed, *send a message* to the WebSocket *oro/data/update* topic with the generated content tag.
4. On all frontend pages, add *content tag* of the user's task set to the Content Manager tracking registry.


