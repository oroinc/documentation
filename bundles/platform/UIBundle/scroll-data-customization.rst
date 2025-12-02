.. _bundle-docs-platform-ui-bundle-scroll-data:

Scroll Data Customization
=========================

Developers can customize the data rendered by the `scrollData(...)` macro from `macros.html.twig` by listening to a special event triggered at the very beginning of macro processing.
The event name has the format ``oro_ui.scroll_data.before.<dataTarget>``, where `<dataTarget>` is the string identifier passed as the first argument to the macro. This allows developers to modify the data that will be rendered on any page using the `scrollData` macro.

The event object is an instance of ``Oro\Bundle\UIBundle\Event\BeforeListRenderEvent``.
It provides:

* A ``\Twig\Environment`` object
* The scroll data wrapped in a ``Oro\Bundle\UIBundle\View\ScrollData`` object
* An optional `FormView` instance

The scroll data can be fully replaced if needed.

The **ScrollData** object provides several useful methods to add or modify content:

* **addBlock($title, $priority, $class, $useSubBlockDivider)** – Adds a new block at the end of the list; the block title is required.
* **addSubBlock($blockId, $title)** – Adds a sub-block to a block with the specified identifier (array key).
* **addSubBlockData($blockId, $subBlockId, $html)** – Adds HTML content to an existing sub-block within the specified block.

Customization Example
---------------------

Below is an example of customizing scroll data for the User update page. First, define a listener service:

.. code-block:: yaml

    user_update_scroll_data_listener:
        class: ...
        tags:
            - { name: kernel.event_listener, event: oro_ui.scroll_data.before.user-profile, method: onUserUpdate }

This service listens for the event ``oro_ui.scroll_data.before.user-profile`` with handler method ``onUserUpdate``.
It will be executed before rendering the page identified as ``user-profile``.

The listener implementation might look like this:

.. code-block:: php

    use Oro\Bundle\UIBundle\Event\BeforeListRenderEvent;

    class UpdateUserListener
    {
        public function onUserUpdate(BeforeListRenderEvent $event)
        {
            $template = $event->getEnvironment()->render(
                '@My/User/my_update.html.twig',
                ['form' => $event->getFormView()]
            );
            $event->getScrollData()->addSubBlockData(0, 0, $template);
        }
    }

And the corresponding Twig template `@My/User/my_update.html.twig`:

.. code-block:: none

   {{ form_row(form.myField) }}

This example demonstrates how to add an additional field to the User update page.
The template is rendered via the Twig environment and added dynamically to the scroll data through the ``oro_ui.scroll_data.before.<dataTarget>`` event.

