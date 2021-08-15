InlineEditableViewComponent ⇐ `BaseComponent`
=============================================

Allows to connect inline editors on view pages.
Currently used only for tags-editor. See the :ref:`index of supported editors <bundle-docs-platform-form-bundle-editor>`.

**Extends:** `BaseComponent`

.. **Todo**
.. [ ] update after connecting other editors

Sample:

.. code-block:: none

    {% import '@OroUI/macros.html.twig' as UI %}
    <div {{ UI.renderPageComponentAttributes({
       module: 'oroform/js/app/components/inline-editable-view-component',
       options: {
           frontend_type: 'tags',
           value: oro_tag_get_list(entity),
           fieldName: 'tags',
           metadata: {
               inline_editing: {
                   enable: is_granted('oro_tag_assign_unassign'),
                   save_api_accessor: {
                       route: 'oro_api_post_taggable',
                       http_method: 'POST',
                       default_route_parameters: {
                           entity: oro_class_name(entity, true),
                           entityId: entity.id
                       }
                   },
                   autocomplete_api_accessor: {
                       class: 'oroui/js/tools/search-api-accessor',
                       search_handler_name: 'tags',
                       label_field_name: 'name'
                   },
                   editor: {
                       view_options: {
                           permissions: {
                               oro_tag_create: is_granted('oro_tag_create')
                           }
                       }
                   }
               }
           }
       }
    }) }}></div>

.. csv-table::
   :header: "Param","Type","Description"
   :widths: 20, 20, 20

   "options","`Object`","Options container"
   "options.\_sourceElement","`Object`","The element to which the view should be connected (passed automatically when page component is :ref:`connected through DOM attributes <frontend-architecture-page-component>`)"
   "options.frontend_type","`string`","frontend type, please find |available keys here|"
   "options.value","`*`","value to edit"
   "options.fieldName","`string`","field name to use when sending value to server"
   "options.metadata","`Object`","Editor metadata"
   "options.metadata.inline_editing","`Object`","inline-editing configuration"

inlineEditableViewComponent.initialize
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

**Kind**: instance class of InlineEditableViewComponent

**new initialize (options)**

.. csv-table::
   :header: "Param","Type"
   :widths: 20, 20

   "options","Object"

inlineEditableViewComponent.resizeTo()
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Resizes editor to base view width

**Kind**: instance method of the InlineEditableViewComponent

.. include:: /include/include-links-dev.rst
   :start-after: begin
