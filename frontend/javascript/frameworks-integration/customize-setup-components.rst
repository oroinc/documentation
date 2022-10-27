.. _dev-doc-customize-setup-components:

Customize Framework Setup Components
====================================

Oro provides the ability to integrate Vue/React libraries and create your custom micro-application. You can use ``data-page-component-vue-app`` or ``data-page-component-react-app`` for Vue and React, respectively, which will enable you to create and run a mini-app in its basic form.

A Vue/React application may often need more flexible customization or the addition of some ``third-party`` libraries to extend the standard functionality of the application.

We are going to illustrate how to do it with an example of a component for Vue. As an example, let's add a manager for the state to the mini-application.

1. Create a module with `Store`. Remember to export the created `store` so that it can be later connected to the application.

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

2. Create a file to extend the functionality in your bundle.

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

3. Create a shortcut that enables you to use the page component and Twig templates. Create an ``app-module`` to do this. To learn more about shortcuts, see the :ref:`Component Shortcuts <dev-doc-frontend-component-shortcuts>` topic.

   .. code-block:: javascript
      :caption: src/{YourBundleName}/Resources/public/js/app/modules/custom-vue-module.js

        import ComponentShortcutsManager from 'oroui/js/component-shortcuts-manager';

        ComponentShortcutsManager.add('custom-vue-app', {
            moduleName: '{yourbundlename}/js/app/components/custom-vue-app-component',
            scalarOption: 'vueApp'
        });

4. Register the new module as ``app-module`` and create a yaml config file. See :ref:`App Modules <frontend-architecture-app-module>` for more information.

   .. code-block:: yaml
      :caption: src/{YourBundleName}/Resources/views/layouts/{theme}/config/jsmodules.yml

        app-modules:
            - {yourbundlename}/js/app/modules/custom-vue-module
        dynamic-imports:
            acmevueapp:
                - {yourbundlename}/js/app/components/custom-vue-app-component

5. You can now use the new shortcut in Twig.

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

8. Register your new widget and append it to the page container in the layout. For this, create a file. For more information on the layout update, see the :ref:`Layout <dev-doc-frontend-layouts-layout>` topic.

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
