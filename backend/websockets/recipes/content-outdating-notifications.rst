.. _dev-cookbook-system-websockets-content-outdating-notifications:

Use Content Outdated Notifications in Oro Applications
======================================================

Due to the continuous WebSocket connection between the Oro application server and the user’s browser, users receive a flash-message informing about changes in the content when they try to edit a page simultaneously with another user.

.. note:: A user can receive this message only if another user makes a change. No notification is received if the same user made changes in a new browser tab, window, or on another device.

It works out-of-the-box with content types (entities) delivered in Oro applications. 

If you want your custom entities to have this functionality, refer to the sections below.

How It Works
------------

On the frontend side, there is a Content Manager JS component, which is responsible for tracking the outdated content.
The content manager stores an array of tags (content identifiers) for every content item to track its status.

The content manager is subscribed to the **oro/data/update** WebSockets topic. The server sends a notification to this topic whenever any content on the server side has been changed.

The content change message that the content manager receives includes only the tag (identifier) of the changed content. The content manager has the list of tacking tags. If the tag is in that list, the content manager launches specific actions that are planned to be run when the content with this tag is changed. If this tag is not tracked, the content manager can ignore this WebSocket message.

For the content manager to keep track of the actuality of the content item, it must be explicitly requested by sending **unique content tag** and optional **callback** to the **tagContent** method.

.. code-block:: javascript

    import loadModules from 'oroui/js/app/services/load-modules';

    loadModules('orosync/js/content-manager')
        .then(contentManager => contentManager.tagContent([someContentTag], callback);

How to Get the Unique Content Tag
---------------------------------

You can create a content tag for every content item by yourself, but for convenience purposes, the Oro application offers the Tag Generators services. TagGenerator receives a content item (any data object) and creates a unique content tag based on the content item object.

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

That is what the macro **syncContentTags** does if you see it in its source code in the *Oro/Bundle/SyncBundle/Resources/views/Include/contentTags.html.twig* file. In other words, the shortest code to add content to the Content Manager tracking registry is:

.. code-block:: twig

    {% import '@OroSync/Include/contentTags.html.twig' as syncMacro %}
    {{ syncMacro.syncContentTags(entity) }}

To generate a content tag on the backend side, use the **oro_sync.content.tag_generator** service directly:

.. code-block:: php

    /** @var TagGeneratorInterface $tagGenerator */
    $tagGenerator = $container->get(‘oro_sync.content.tag_generator’);
    $contentTag = $tagGenerator->generate(entity);

When the Sever Sends Messages to the Frontend about Outdated Content
--------------------------------------------------------------------

**DoctrineTagEventListener** is a listener for Doctrine events that listens for the changes in the doctrine-managed entities. If entity record was changed, the listener generates the entity content tag with *DoctrineTagGenerator* and sends content tags of changed entities to the **oro/data/update** WebSockets topic.

How to Add the Custom Content Type to the Content Manager Tracking Registry
---------------------------------------------------------------------------

If you use the base *OroUIBundle* templates for the view/edit pages of your content type and a doctrine-managed entity to store it, it means that your content items are already added into the Content Manager registry of your *Oro/Bundle/UIBundle/Resources/views/actions/view.html.twig* and *Oro/Bundle/UIBundle/Resources/views/actions/update.html.twig* templates. DoctrineTagEventListener already listens to the changes of your content.

If you use your *custom base template* for the view/edit pages, use macro *syncContentTags* to add the content tag of your content item into the Content Manager registry.

If your content type depends on another content type, and you want the user to receive notifications about another content type on your content type page, you have to add another content type tag to the Content Manager tracking registry:

.. code-block:: twig

    {% import '@OroSync/Include/contentTags.html.twig' as syncMacro %}
    {{ syncMacro.syncContentTags(primaryEntity) }}
    {{ syncMacro.syncContentTags(anotherEntity) }}

To add custom information to content outdated tracking (for example, to inform a user about being assigned a new task), on top of the functionality that tracks and sends a message about the changed information, you need to develop custom *TagGenerator* to create identifiers for your content.

In this case, the complete customization scenario might look like this:

1. Create and register *Doctrine event listener* that waits for changes in the Tasks entities.
2. Create and register *Tag Generator* that creates *content tags* for user task data based on the user identifier.
3. In the listener, when a user's task set is changed, *send a message* to the WebSocket *oro/data/update* topic with the generated content tag.
4. On all frontend pages, add *content tag* of the user's task set to the Content Manager tracking registry.


