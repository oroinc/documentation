.. _book-entities-extended-entities-extend-fields-view:

Extending the Extended Field Rendering
--------------------------------------

To customize field rendering on the view page, use the ``oro.entity_extend_event.before_value_render`` event, which fires before a field's value is rendered.

Example of an event listener registration:

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

Each event listener decides how to display the field value. To change the field view value, it calls ``$event->setFieldViewValue($viewData);``.

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

``$viewData`` can be a simple string or an array, such as ``['link' => 'example.com', 'title' => 'some text representation']``.

A string is formatted automatically in a Twig template based on the field type.

An array renders the field with text equal to the escaped ``'title'`` value. If the ``'link'`` option exists, the field renders as a link with an href equal to the ``'link'`` value.


.. include:: /include/include-links-dev.rst
   :start-after: begin
