.. _notification-bundle-event:

Register an Event to Send Notification Emails
=============================================

To allow creating :ref:`notification rules <system-notification-rules>` for new types of events, register them in the
``Resources/config/oro/app.yml`` file in your bundle.

   .. code-block:: yaml
      :caption: Resources/config/oro/app.yml
      :linenos:

      oro_notification:
          events:
              - my_custom_event_1
              - my_custom_event_2
