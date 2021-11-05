.. _bundle-docs-platform-ui-bundle-scroll-data:

Scroll Data Customization
=========================

To customize data rendered with macros `scrollData(...)` from `macros.html.twig` developer can use special event
triggered in the very beginning of marcos processing. Event name has format `oro_ui.scroll_data.before.<dataTarget>`
where `<dataTarget>` is a string identifier passed to macros as a first argument. This way developer can modify
data that will be rendered on any page where scrollData macros is used.

Event object used in this case is ``Oro\Bundle\UIBundle\Event\BeforeListRenderEvent`` - it provides ``\Twig\Environment``
object, data wrapped into ``Oro\Bundle\UIBundle\View\ScrollData`` object and optional `FormView` instance. Data can be
completely replaced.

Scroll Data
-----------

Scroll data object provides several useful methods to add information to scroll data:

- **addBlock($title, $priority, $class, $useSubBlockDivider)** adds a new block at the end of the list, block title is required
- **addSubBlock($blockId, $title)** adds a new sub-block to a block with a specified identifier (an array key)
- **addSubBlockData($blockId, $subBlockID, $html)** adds HTML code to the existing sub-block inside the specified block

Customization Example
---------------------

Lets look at an example of scroll data customization. Here is definition of listener used to customize scroll data:

.. code-block:: yaml
   :linenos:

    user_update_scroll_data_listener:
        class: ...
        tags:
            - { name: kernel.event_listener, event: oro_ui.scroll_data.before.user-profile, method: onUserUpdate }


This definition shows service used as an event listener for event ``oro_ui.scroll_data.before.user-profile`` with handler method ``onUserUpdate``. This listener will be executed before rendering of user update page (it has identifier ``user-profile``). Here is how such listener can look like:

.. code-block:: php
   :linenos:

    use Oro\Bundle\UIBundle\Event\BeforeListRenderEvent;

    class UpdateUserListener
    {
        /**
         * @param BeforeListRenderEvent $event
         */
        public function onUserUpdate(BeforeListRenderEvent $event)
        {
            $template = $event->getEnvironment()->render(
                'MyBundle:User:my_update.html.twig',
                ['form' => $event->getFormView()]
            );
            $event->getScrollData()->addSubBlockData(0, 0, $template);
        }
    }

And the corresponding template `MyBundle:User:my_update.html.twig`:

.. code-block:: none

   {{ form_row(form.myField) }}

csvThis example demonstrates addition of an additional field to the User update page - the template is rendered via the environment object
and added to the scroll data.

