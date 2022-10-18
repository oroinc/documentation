.. _book-entities-extended-entities-extend-fields-view:

Extending the Extended Field Rendering
--------------------------------------

Before extending field rendering on the view page, fire the ``oro.entity_extend_event.before_value_render`` event.
Using this event, you can customize field rendering.

As example of an event listener registration:

.. code-block:: yaml

    oro_entity_extend.listener.extend_field_value_render:
        class: Oro\Bundle\EntityExtendBundle\EventListener\ExtendFieldValueRenderListener
        arguments:
            - '@oro_entity_config.config_manager'
            - '@router'
            - '@oro_entity_extend.extend.field_type_helper'
            - '@doctrine.orm.entity_manager'
        tags:
            - { name: kernel.event_listener, event: oro.entity_extend_event.before_value_render, method: beforeValueRender }

Each event listener decides on how to display the field value. To change the field view value, it uses ``$event->setFieldViewValue($viewData);``.

Example:

.. code-block:: php

    $underlyingFieldType = $this->fieldTypeHelper->getUnderlyingType($type);
        if ($value && $underlyingFieldType == 'manyToOne') {
            $viewData = $this->getValueForManyToOne(
                $value,
                $this->extendProvider->getConfigById($event->getFieldConfigId())
            );

            $event->setFieldViewValue($viewData);
        }

In this code, we should:

* check if the value is not null, and the field type is "manyToOne".
* calculate the field view value and set it by calling ``$event->setFieldViewValue($viewData);``

Variable ``$viewData`` can have a simple string or an array ``['link' => 'example.com', 'title' => 'some text representation']``.
In case of a string, it will be formatted in a twig template automatically based on the field type. In case of an array, we show a field with text equal to ``'title'``. Title will also be escaped. If the ``'link'`` option exists, we show the field as a link with href that equals the ``'link'`` option value.


.. include:: /include/include-links-dev.rst
   :start-after: begin
