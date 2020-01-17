.. _bundle-docs-commerce-cms-bundle-editor-components:

Create Editor Components
========================

.. hint:: GrapesJS component description is available in the |GrapesJS Api Documentation|, as well as the way of |creating component types|.

To simplify adding new types of component there, component type builders were created that include all needed data of a new component type. Under the hood, they implement the same actions that are propose in the GrapesJS documentation but make component type declaration more structured and convenient.

Type Builder
------------

To create your own component type, first create a descendant of BaseTypeBuilder:

.. code-block:: javascript
   :linenos:

    import BaseTypeBuilder from 'orocms/js/app/grapesjs/type-builders/base-type-builder';

    const SomeNewComponent = BaseTypeBuilder.extend({
        button: {
            label: 'Button label',
            category: 'Basic',
            attributes: {
                'class': 'fa fa-hand-pointer-o'
            }
        },

        modelMixin: {
            defaults: {
                classes: ['component-class', 'some-class'],
                tagName: 'span',
                content: 'Inner content'
            },

            someMethod() {
                // Some custom logic
            }
        },

        viewMixin: {
            onRender() {
                // Some custom logic
            }
        },

        editorEvents: {
            'component:create': 'onCreate',
            'prevent component:selected': 'onSelect'
        },

        commands: {
            'my-command': () => {
                // Some custom logic
            }
        },

        usedTags: ['div', 'span'],

        constructor: function SomeNewComponent(options) {
            SomeNewComponent.__super__.constructor.call(this, options);
        },

        onInit() {
            this.editor.runCommand('my-command');
        },

        onCreate() {
            // Some custom logic
        },

        onSelect() {
            // Some custom logic
        },

        isComponent(el) {
            let result = null;

            if (el.tagName === 'sometag') {
                result = {
                    type: this.componentType
                };
            }

            return result;
        }
    });

    export default SomeNewComponent;

Properties
----------

.. csv-table::

   "`componentType`","String","The name of a new component type"
   "`parentType`","String","The name of the component type that used as a parent. If it is not determined, use the `default` type"
   "`editor`","Object","An instance of GrapesJS WYSIWYG"
   "`button`","Object","Data to register a panel button (if required for the new component type)"
   "`label`","String","The button label"
   "`category`","String","Place the button to the category container"
   "`attributes`","Object","An object of the attributes such as class name or data attribute"
   "`modelMixin`","Object","Methods and props used to extend the WYSIWYG |component model|. Prop `defaults` is merged with the default model attributes."
   "`viewMixin`","Object","Methods and props used to extend the WYSIWYG component view"
   "`isComponent`","Function","Identify the |the component type|"
   "`onInit`","Function","Call after the component is initialized"
   "`commands`","Object","The key is the command name and the value is the command callback"
   "`editorEvents`","Object","The key is the event name and the value is the name of the builder method"
   "`template`","HTML","Set the component template; if the template is not set, the button will use its own component type as content."
   "`getButtonTemplateData`","Function","Return data for the button template"

Component Type Registration
---------------------------

Register the created type builder in the component manager:

.. code-block:: javascript
   :linenos:

    import ComponentManager from 'orocms/js/app/grapesjs/plugins/components/component-manager';
    import SomeTypeBuilder from 'orocms/js/app/grapesjs/type-builders/some-type-builder';

    ComponentManager.registerComponentTypes({
        'some': {
            Constructor: SomeTypeBuilder
        }
    });

The best way to create an appmodule is to make sure that the builder is registered before the application starts.

.. include:: /include/include-links-dev.rst
   :start-after: begin
