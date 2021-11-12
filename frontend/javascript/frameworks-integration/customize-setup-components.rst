.. _dev-doc-customize-setup-components:

Customize Framework Setup Components
====================================

ORO provides the ability to integrate Vue/React libraries and create your own micro-application. You can use ``data-page-component-vue-app`` or ``data-page-component-react-app`` respectively for Vue and React. Which will allow you to create and run a mini app in basic form.

But often a Vue/React application may need more flexible customization or the addition of some ``third-party`` libraries to extend the standard functionality of the application.

Let's see how to do it with an example of a component for Vue.
As an example, let's add a manager for the state to our mini-application.

1. Let's create the module itself with `Store`. Let's create. Do not forget to export the created `store` so that it can be later connected to the application.

.. code-block:: javascript
    :caption: src/{YourBundleName}/Resources/public/js/vue/store/index.js

    import { createStore } from 'vuex';

    const store = createStore({
        state () {
            return {
                count: 0
            }
        },
        mutations: {
            increment (state) {
                state.count++
            }
        }
    });

    export default store;

2. Let's create the file itself to extend the functionality in your bundle.

.. code-block:: javascript
    :caption: src/{YourBundleName}/Resources/public/js/app/components/custom-vue-app-component.js

    import VueAppComponent from 'oroui/js/app/components/vue-app-component';
    import store from '../../vue-app/store';

    const CustomVueAppComponent = VueAppComponent.extend({
        constructor: function CustomVueAppComponent(...args) {
            CustomVueAppComponent.__super__.constructor.apply(this, args);
        },

        beforeAppMount() {
            this.app.use(store);
        }
    });

    export default CustomVueAppComponent;

3. The next step is to create a shortcut that allows you to conveniently use the page component and Twig templates. Create an ``app-module`` to do this. You can learn more about shortcuts here :ref:`Component Shortcuts <dev-doc-frontend-component-shortcuts>`

.. code-block:: javascript
    :caption: src/{YourBundleName}/Resources/public/js/app/modules/custom-vue-module.js

    import ComponentShortcutsManager from 'oroui/js/component-shortcuts-manager';

    ComponentShortcutsManager.add('custom-vue-app', {
        moduleName: '{yourbundlename}/js/app/components/custom-vue-app-component',
        scalarOption: 'vueApp'
    });

4. Next, you need to register the new module as ``app-module``. Let's create yaml config. Learn more about ``app-modules`` here :ref:`App Modules <frontend-architecture-app-module>`.

.. code-block:: yaml
    :caption: src/{YourBundleName}/Resources/views/layouts/{theme}/config/jsmodules.yml

    app-modules:
        - {yourbundlename}/js/app/modules/custom-vue-module
    dynamic-imports:
        acmevueapp:
            - {yourbundlename}/js/app/components/custom-vue-app-component

5. Now we can use the new shortcut in Twig.

.. code-block:: html+jinja
    :caption: src/{YourBundleName}/Resources/views/layout.html.twig

    {% block _custom_block_widget %}
        {% set attr = layout_attr_defaults(attr, {
            'data-page-component-custom-vue-app': {
                vueApp: '{yourbundlename}/js/vue-app/App'
            }
        }) %}

        <div {{ block('block_attributes') }}>
            {{ block_widget(block) }}
        </div>
    {% endblock %}

8. Register your new widget and append it to the page container in layout. For this, create file. For more on layout update, see the :ref:`Layout <dev-doc-frontend-layouts-layout>` topic.

.. code-block:: yaml
    :caption: src/{YourBundleName}/Resources/views/layouts/{theme}/layout.yml

    layout:
        actions:
            - '@setBlockTheme':
                themes: 'layout.html.twig'

            - '@add':
                id: custom_block
                parentId: page_container
                prepend: true
                blockType: block

.. note:: You can use a similar approach for React.
