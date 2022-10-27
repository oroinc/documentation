Calendar Context Menu
=====================

The calendar context menu is used to manage calendars on the *My Calendar* page. Available actions are:

- Show/Hide calendar
- Remove calendar
- Change calendar color

.. image:: /img/bundles/CalendarBundle/context-menu.png
   :align: center
   :alt: Calendar context menu in the UI

Extendability
-------------

Calendar Context Menu is based on knplabs/knp-menu (see |KnpMenuBundle|). You can extend the menu with new action items from any bundle. To add a new action to the menu, add the action configuration to the navigation.yml file, for example:

.. code-block:: yaml

    menu_config:
        items:
            oro_calendar_remove_action:
                label: 'oro.calendar.context.remove'
                uri: '#'
                extras:
                    position: 20
                    module: 'orocalendar/js/calendar/menu/remove-calendar'
                    template: '@OroCalendar/Calendar/Menu/removeCalendar.html.twig'
        tree:
            calendar_menu:
                type: calendar_menu
                children:
                    oro_calendar_remove_action: ~

You can define the following attributes:

- **Label** - is the name of action.
- **Position** - specifies the order in context menu.
- **Module** - is a path to the JavaScript module. It handles an item action.
- **Template** - is the name of an item template. Example of an item template:

  .. code-block:: twig

        <li{{ oro_menu.attributes(itemAttributes) }}>
            <a href="#" class="action">
            <% if (visible) { %>
                {{ 'oro.calendar.context.hide'|trans }}
            <% } else { %>
                {{ 'oro.calendar.context.show'|trans }}
            <% } %>
            </a>
        </li>

In the template, provide the ``<li{{ oro_menu.attributes(itemAttributes) }}>`` tag. If the template was not defined, the item is displayed the way it is presented in the |context menu template|.

**Module** receives the following values from **options** into **initialize**:

- **el** - context menu item.
- **model** - a |Backbone model| represents a calendar connection .
- **collection** - a |Backbone collection|.
- **colorManager** - |manager|.
- **connectionsView** - a Backbone view represents a |calendar items list|.

In the JavaScript module, you can use the default method **execute**. This method is called when a user clicks on your item menu, for example:

.. code-block:: javascript

    execute: function (model, actionSyncObject) {
        var removingMsg = messenger.notificationMessage('warning', __('oro.calendar.flash_message.calendar_removing')),
            $connection = this.connectionsView.findItem(model);
        try {
            $connection.hide();
            model.destroy({
                wait: true,
                success: _.bind(function () {
                    removingMsg.close();
                    messenger.notificationFlashMessage('success', __('oro.calendar.flash_message.calendar_removed'));
                    actionSyncObject.resolve();
                }, this),
                error: _.bind(function (model, response) {
                    removingMsg.close();
                    this._showError(__('Sorry, the calendar removal has failed.'), response.responseJSON || {});
                    $connection.show();
                    actionSyncObject.reject();
                }, this)
            });
        } catch (err) {
            removingMsg.close();
            this._showError(__('Sorry, an unexpected error has occurred.'), err);
            $connection.show();
            this.actionSyncObject.reject();
        }
    },

**Execute()** function must receive two parameters:

- **model** is a |Backbone model| that consists of the calendar item property.
- **actionSyncObject** is a jQuery deferred object that synchronizes the context menu action and the rendering calendar. If a custom action is performed successfully, the promise object should perform the **resolve()** function. In other cases, it should perform the **reject()** method.

You can also use other events or functions to execute the context menu action in the module. In this case, the module should call method **_initActionSyncObject()** of object **connectionsView** before starting the action so that a user cannot run other menu actions. After the action is performed, the module should execute **resolve()** or **reject()** functions of object **connectionsView._actionSyncObject**.

Remember to execute ``cache:clear`` after updating the navigation.yml file.

.. include:: /include/include-links-dev.rst
   :start-after: begin
