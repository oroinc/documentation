.. _bundle-docs-commerce-cms-bundle-editor-components:

Create Editor Components
========================

.. hint:: GrapesJS component description is available in the |GrapesJS Api Documentation|, as well as the way of |creating component types|.

To simplify adding new types of component there, component type builders were created that include all needed data of a new component type. Under the hood, they implement the same actions that are propose in the GrapesJS documentation but make component type declaration more structured and convenient.

Creating Type In Single Module
------------------------------

To create your own component type, first create a descendant of BaseTypeBuilder:

.. code-block:: javascript
    :caption: src/{YourBundleName}/Resources/js/app/grapesjs/types/some-type.js

    import BaseType from 'orocms/js/app/grapesjs/types/base-type';

    const SomeType = BaseType.extend({
        button: {
            label: 'Button label',
            category: 'Basic',
            attributes: {
                'class': 'fa fa-hand-pointer-o'
            }
        },

        modelProps: {
            defaults: {
                classes: ['component-class', 'some-class'],
                tagName: 'span'
            },

            // Optional: Define some functionality after model was created
            // Example: Add default child components
            init() {
                const components = this.get('components');

                if (!components.length) {
                    components.add([{
                        type: 'textnode',
                        content: 'Inner content'
                    }]);
                }
            }

            someMethod() {
                // Some custom logic
            },

            // Optional: Define the parent type name that will be extended in the model
            extend: 'parent-type',

            // Optional: Following GrapesJS documentation could define some methods which going to extend for type model
            extendFn: ['someMethod']
        },

        viewProps: {
            onRender() {
                // Some custom logic
            },

            // Optional: Defining parent type name, it type going to extend for view
            extendView: 'parent-type',

            // Optional: Following GrapesJS documentation could define some methods which going to extend for type view
            extendFnView: ['someMethod']
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

        constructor: function SomeType(options) {
            SomeType.__super__.constructor.call(this, options);
        },

        onInit() {
            this.editor.runCommand('my-command');
        },

        onCreate(model) {
            if (this.isOwnModel(model)) {
                // Some custom logic
            }
        },

        onSelect(model) {
            if (this.isOwnModel(model)) {
                // Some custom logic
            }
        },

        isComponent(el) {
            return el.nodeType === Node.ELEMENT_NODE && el.tagName === 'SPAN' && el.classList.contains('some-class');
        }
    }, {
        // Define static property with type name
        type: 'some-type'
    });

    export default SomeType;

Creating Type With Function Constructors
----------------------------------------

You can define the model and the view type as a constructor function, as this gives you more freedom when implementing the required logic. You can provide a more advance method to extend existing types in the editor.
You can also separate large components into different modules, as illustrated in the example below.

**Example** 

Create a type model module called `some-type-model.js`. It is similar to other Backbone components but should be created in a special function with `BaseTypeModel` and other options in the function attributes.

.. code-block:: javascript
    :caption: src/{YourBundleName}/Resources/js/app/grapesjs/types/some-type/some-type-model.js

    export default (BaseTypeModel, {editor}) => {
        const SomeTypeModel = BaseTypeModel.extend({
            constructor: function SomeTypeModel(...args) {
                // Note: Constructor should always return super
                return SomeTypeModel.__super__.constructor.apply(this, args);
            },

            init() {
                const components = this.get('components');

                if (!components.length) {
                    components.add([{
                        type: 'textnode',
                        content: 'Inner content'
                    }]);
                }
            },

            getAttributes(opts = {}) {
                const attributes = SomeTypeModel.__super__.getAttributes.call(this, opts);

                attributes['new-attr'] = 'Attribute value';

                return attributes;
            }
        });

        Object.defineProperty(SomeTypeModel.prototype, 'defaults', {
            value: {
                ...SomeTypeModel.prototype.defaults,
                classes: ['component-class', 'some-class'],
                tagName: 'span'
            }
        });

        return SomeTypeModel;
    };

Create a type view module `some-type-view.js` the same way you create a type model.

.. code-block:: javascript
    :caption: src/{YourBundleName}/Resources/js/app/grapesjs/types/some-type/some-type-view.js

    export default (BaseTypeView, {editor}) => {
        const SomeTypeView = BaseTypeView.extend({
            constructor: function SomeTypeView(...args) {
                // Notice: Constructor should always returns super
                return SomeTypeView.__super__.constructor.apply(this, args);
            },

            onRender() {
                // Do something after rendered
            }
        });

        return SomeTypeView;
    };

Create a component of type `some-type`. It is similar to  `Creating Type In Single Module` but the model and the view are placed in separate modules. Import them into the header of main module and set in properties `ModelType` and `ViewType`.

.. code-block:: javascript
    :caption: src/{YourBundleName}/Resources/js/app/grapesjs/types/some-type/index.js

    import BaseType from 'orocms/js/app/grapesjs/types/base-type';
    import ModelType from './some-type-model.js';
    import ViewType from './some-type-view.js';

    const SomeType = BaseType.extend({
        button: {
            label: 'Button label',
            category: 'Basic',
            attributes: {
                'class': 'fa fa-hand-pointer-o'
            }
        },

        ModelType,

        ViewType,

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

        constructor: function SomeType(options) {
            SomeType.__super__.constructor.call(this, options);
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
            return el.nodeType === Node.ELEMENT_NODE && el.tagName === 'SPAN' && el.classList.contains('some-class');
        }
    }, {
        // Define static property with type name
        type: 'some-type'
    });

    export default SomeType;

Properties
----------

.. csv-table::

   "`parentType`","String","The name of the component type that used as a parent. If it is not determined, use the `default` type"
   "`editor`","Object","An instance of GrapesJS WYSIWYG"
   "`button`","Object","Data to register a panel button (if required for the new component type)"
   "`label`","String","The button label"
   "`category`","String","Place the button to the category container"
   "`attributes`","Object","An object of the attributes such as class name or data attribute"
   "`TypeModel`","Function","Defining model as the constructor function"
   "`TypeView`","Function","Defining view as the constructor function"
   "`modelProps`","Object","Methods and props used to extend the WYSIWYG |component model|. Prop `defaults` is merged with the default model attributes."
   "`viewProps`","Object","Methods and props used to extend the WYSIWYG component view"
   "`commands`","Object","The key is the command name and the value is the command callback"
   "`editorEvents`","Object","The key is the event name and the value is the name of the builder method"
   "`template`","HTML","Set the component template; if the template is not set, the button will use its own component type as content."

Static Properties
-----------------

.. csv-table::

   "`type`","String","Required","Define the component type name"
   "`priority`","Number","Optional","Define the priority order to apply the component type. It is important when creating a type from a parent type"

Methods
-------

.. csv-table::
    :header: "Name","Return","Options","Description"

    "`getTypeModelOptions`","Object","","Return object with properties from wrapper component for provide in the type model instance."
    "`getTypeViewOptions`","Object","","Return object with properties from wrapper component for provide in the type model instance"
    "`getButtonTemplateData`","Object","","Return data for the button template"
    "`isOwnModel`","Boolean","TypeModel","Detect is it model instance of for current type"
    "`onInit`","","Object","Hook after wrapper component initialized"
    "`getType`","String","","Get component type name"
    "`isComponent`","Object|String|Boolean","DOMNode","Identify the |the component type|"

Component Type Registration
---------------------------

For registering new type need create plugin or use exists plugin.
Plugins loading dynamical, required add to `jsmodules.yml` dynamic path

.. hint:: Pay attention type should registered before editor initialized.

Register the created type builder with the component manager:

.. code-block:: javascript
    :caption: src/{YourBundleName}/Resources/js/app/grapesjs/plugins/foo-plugin.js

    import GrapesJS from 'grapesjs';
    import ComponentManager from 'orocms/js/app/grapesjs/plugins/components/component-manager';
    import SomeTypeBuilder from '{yourbundlename}/js/app/grapesjs/types/some-type';

    export default GrapesJS.plugins.add('foo-plugin', () => {
        ComponentManager.registerComponentTypes({
            'some': {
                Constructor: SomeTypeBuilder
            }
        });
    });

Use Symfony Form Type Extension to add the new plugin to the WYSIWYG field. For more information about Symfony forms, see |form type extension|.

.. code-block:: php
    :caption: src/{YourBundleName}/Form/Extension/FooWysiwygTypeExtension.php

    <?php

    namespace App\Form\Extension;

    use Symfony\Component\Form\AbstractTypeExtension;
    use Symfony\Component\Form\Extension\Core\Type\FileType;

    class FooWysiwygTypeExtension extends AbstractTypeExtension
    {
        public function finishView(FormView $view, FormInterface $form, array $options): void
        {
            $pageComponentOptions = json_decode($view->vars['attr']['data-page-component-options'] ?? '', true);
            $pageComponentOptions['builderPlugins']['foo-plugin']['jsmodule'] = '{yourbundlename}/js/app/grapesjs/plugins/foo-plugin';
            $view->vars['attr']['data-page-component-options'] = json_encode($pageComponentOptions);
        }

        /**
         * Returns an array of extended types.
         */
        public static function getExtendedTypes(): iterable
        {
            return [WYSIWYGType::class];
        }
    }

Add the path to the file to dynamic imports in `jsmodules.yml`. If `jsmodules.yml` does not exist, you need to create it.
For more information about `jsmodules.yml`, see :ref:`JS Modules <reference-format-jsmodules>`.

.. code-block:: yaml
    :caption: src/{YourBundleName}/Resources/config/jsmodules.yml

    dynamic-imports:
        foo_app:
            - {yourbundlename}/js/app/grapesjs/plugins/foo-plugin

.. include:: /include/include-links-dev.rst
   :start-after: begin
