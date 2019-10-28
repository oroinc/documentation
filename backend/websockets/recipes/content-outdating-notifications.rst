.. _dev-cookbook-system-websockets-content-outdating-notifications:

Use Content Outdated Notifications in Oro Applications
======================================================

Thanks to the continuous WebSocket connection between the Oro application server and the user’s browser, when a user tries to edit
a page simultaneously with another user, they receives a flash-message informing about changes in the content.

.. note:: A users can receive this message only if somebody else made a change. No notification is received if changes were made by the same user in a new browser tab, window or on another device. 

It works out-of-the-box with content types (entities) delivered in Oro applications. 

If you want your custom entities to have this functionality, please have a look at the sections below.

How It Works
------------

On the frontend side, there is the Content Manager JS component, which is responsible for tracking outdated content.
The Content Manager stores an array of tags (content identifiers) for every content item to track it getting outdated.

The Content Manager is subscribed to the **oro/data/update** WebSockets topic. The server sends a notification to this
topic whenever any content on the server side has been changed.

In the message about the content change, only the tag (identifier) of the changed content is sent to the content
manager. If this tag is in the list tracked by the content manager, then the content manager launches certain actions
that were planned to be run when the content with this tag is changed. If this tag is not tracked, the content
manager will simply ignore this WebSocket message.

For the Content Manager to keep track of the actuality of the content item, it must be explicitly asked to do so by
sending to the **tagContent** method a **unique content tag** for this content and a **callback** that must be
executed if the content is changed.

.. code-block:: php
    :linenos:

    <script type="text/javascript">
        loadModules(['orosync/js/content-manager'],
        function(contentManager) {
            contentManager.tagContent([someContentTag], callback);
        });
    </script>

Where Can I Get the Unique Content Tag
--------------------------------------

You can create a content tag for every content item by yourself, but for convenience purposes, Oro application offers Tag
Generators services. TagGenerator receives a content item (any data object) and creates a unique content tag based on the content item object.

Oro applications have implemented three built-in Tag Generators:
 
* *DoctrineTagGenerator*
* *SimpleTagGenerator*
* *TagGeneratorChain*
 
DoctrineTagGenerator, for example, receives an entity object and creates a content tag based on information about entity type and the entity object ID. TagGeneratorChain combines all registered generators in the application.

To create your own generator and add it into *TagGeneratorChain registry*, you should develop a class that implements
**TagGeneratorInterface** and register it as a service with the **oro_sync.tag_generator** tag.

To generate a content tag on the **frontend side**, you should use the **oro_sync_get_content_tags** Twig function that uses the
TagGeneratorChain service inside:

.. code-block:: php
    :linenos:

    oro_sync_get_content_tags(data, includeCollectionTag = false, processNestedData = false)

Therefore, the full example for adding the content to the tracked one in Content Manager is:

.. code-block:: php
    :linenos:

    <script type="text/javascript">
        loadModules(['orosync/js/content-manager'],
        function(contentManager) {
            contentManager.tagContent(oro_sync_content_tags(entity), callback);
        });
    </script>

That is what the macro **syncContentTags** does if you see in its source code in the *Oro/Bundle/SyncBundle/Resources/views/Include/contentTags.html.twig* file. In other words, the shortest code to add content
to the Content Manager tracking registry is

.. code-block:: php
    :linenos:

    {% import 'OroSyncBundle:Include:contentTags.html.twig' as syncMacro %}
    {{ syncMacro.syncContentTags(entity) }}

To generate a content tag on the backend side, you can use the**TagGeneratorChain** service directly:

.. code-block:: php
    :linenos:

    /** @var $tagGeneratorChain TagGeneratorChain */
    $tagGeneratorChain = $container->get(‘oro_sync.content.tag_generator’);
    $contentTag = $tagGeneratorChain->generate(entity);

When does the Sever Send Messages to the Frontend about Outdated Content?
-------------------------------------------------------------------------

**DoctrineTagEventListener** is a listener for Doctrine events that listens for the changes in doctrine-managed
entities. If entity record was changed, the listener generates the entity content tag with *DoctrineTagGenerator* and
sends content tags of changed entities to the **oro/data/update** WebSockets topic.

How To Add the Custom Content Type to the Content Manager Tracking Registry?
----------------------------------------------------------------------------

If you use the base *OroUIBundle* templates for the view/edit pages of your content type and a doctrine-managed entity
to store it, then you have *Oro/Bundle/UIBundle/Resources/views/actions/view.html.twig* and *Oro/Bundle/UIBundle/Resources/views/actions/update.html.twig* templates already added your content items in the Content Manager
registry. DoctrineTagEventListener already listens to the changes of your content.

If you use your *custom base template* for the view/edit pages, use macro *syncContentTags* to add the content tag of your content item in the *Content Manager registry*.

If your content type depends on another content type and you want the user to receive notifications about another
content type on your content type page, you have to add another content type tag to the Content Manager tracking registry:

.. code-block:: twig
    :linenos:

    {% import 'OroSyncBundle:Include:contentTags.html.twig' as syncMacro %}
    {{ syncMacro.syncContentTags(primaryEntity) }}
    {{ syncMacro.syncContentTags(anotherEntity) }}

If you want to add custom information to content outdated tracking (for example, to inform a
user about being assigned a new task), on top of the functionality that will track and send a message about the
changed information, you may also have to develop custom *TagGenerator* to create identifiers for your content.
In this case, the complete customization scenario might look like this:

1. Create and register a *Doctrine events listener* that waits for changes in the Tasks entities.
2. Create and register a *Tag Generator* that will create *content tags* for user tasks data based on the user identifier.
3. In the listener, when a user's task set is changed, *send a message* to the WebSocket *oro/data/update* topic with the generated content tag.
4. On all frontend pages, add the *content tag* of the user's task set *to the Content Manager tracking registry*.


