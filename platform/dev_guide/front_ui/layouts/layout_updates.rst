.. _dev-guide-layouts-layout-updates:

Layout Updates
==============

A **layout update** is a set of actions that should be performed with the :ref:`layout <dev-guide-layouts-layout>` in order to
customize the page look depending on your needs.

The layout update instructions are read from Yaml files, which should be placed in the :ref:`theme <dev-guide-layouts-theming-dir-stucture>` folder.

.. contents:: Table of Contents
    :local:
    :depth: 2
    :backlinks: entry

Yaml Syntax of the Layout Updates
---------------------------------

The **layout update** file

* can have an `arbitary` name
* should have `layout` as a root node
* may consist of the `Actions`_ and `Conditions`_ nodes.

Actions
^^^^^^^

**Actions** is an array node with a set of actions to execute.

.. note:: Each action is usually compiled as a separate call to the corresponding method of the `LayoutManipulatorInterface <https://github.com/oroinc/platform/blob/master/src/Oro/Component/Layout/LayoutManipulatorInterface.php>`_.

Here is the list of the available actions:

=================  ===========
Action name        Description
=================  ===========
`add`              Add a new item to the layout
`addTree`          Add multiple items defined in the tree hierarchy. [See expanded doc](#addtree-action).
`remove`           Remove the item from the layout.
`move`             Change the layout item position. Could be used to change the parent item or ordering position.
`addAlias`         Add an alias for the layout item. Could be used for backward compatibility.
`removeAlias`      Remove the alias previously defined for the layout item.
`setOption`        Set the option value for the layout item.
`appendOption`     Add a new value in addition to existing values of an option of the layout item.
`subtractOption`   Remove the existing value from an option of the layout item.
`replaceOption`    Replace one value with another value of an option of the layout item.
`removeOption`     Unset the option from the layout item.
`changeBlockType`  Change the block type of the layout item.
`setBlockTheme`    Define the theme file where the renderer should look for block templates.
`clear`            Clear the state of the manipulator. This can prevent execution of all the previously collected actions.
=================  ===========

Actions definition is processed as a multidimensional array where the key is the **action name** prefixed by the `@` sign, and the value is a list of arguments that is passed directly to the proxied method call.

Arguments can be passed as a sequential list, or an associative array.

**Example**

.. code-block:: yaml
   :linenos:

    layout:
        actions:
            - '@add': # Sequential list
                - block_id
                - parent_block_id
                - block_type
            - '@remove': # Named arguments
                id: content

The previous example is compiled in the following PHP code:

.. code-block:: php
   :linenos:

    $layoutManipulator->add( 'block_id', 'parent_block_id', 'block_type' );
    $layoutManipulator->remove( 'content' );

Optional parameters can be skipped when named arguments are used. In the following example, we skip the optional argument `parentId` that will be set to the default value automatically.

**Example**

.. code-block:: yaml
   :linenos:

    layout:
        actions:
            - '@move':
                id:        block_id
                siblingId: sibling_block_id

AddTree Action
~~~~~~~~~~~~~~

You can add a set of blocks with the `addTree` action. It requires two nodes to be defined, `items` and `tree`.

In the **Items** node, specify the list of block definitions. Use the **block id**  as the item key. This will result in the `@add` action for every specified block.

In the **Tree** node, arrange the items into the desired hierarchy. Use the existing parent **block id** as the first node of the tree. The items will be added as its children.


**Example**

.. code-block:: yaml
   :linenos:

    layout:
        actions:
            - '@addTree':
                items:
                    head:
                        blockType:   head
                    meta_charset:
                        blockType:   meta
                        options:
                            charset: 'utf-8'
                    content:
                        blockType: body
                tree:
                    root:
                        head:
                            meta_charset: ~
                        content: ~

.. note:: The tree definition should refer only to the *items* that are declared in the same `@addTree` action, otherwise a syntax error will occur.

Leaves of the tree can be defined as sequentially ordered array items. However, you should take into account the fact that *YAML* syntax does not allow mixing both approaches in the same array node. We, therefore, recommend to use the associative array syntax.

Conditions
^^^^^^^^^^

**Conditions** is an array node which contains conditions that must be satisfied for the **layout update** to be executed.

As an example, let us assume that a set of actions should be executed only for a page that is currently served to a mobile device.

The syntax of conditions declaration is very similar to *actions*, except that it should contain a single condition.

Special grouping conditions (such as `or`, `and`) can be used to combine multiple conditions.

**Example**

.. code-block:: yaml
   :linenos:

    layout:
        actions:
            ....
        conditions: 'context["is_mobile"] == true or context["navbar_position"] == "top"'

:ref:`Layout context <dev-guide-layouts-layout-context>` could be accessed through the condition expressions by referencing to `$context` variable.

Please, refer to the `Symfony expression syntax <http://symfony.com/doc/current/components/expression_language/syntax.html>`_ documentation for a more detailed explanation.

Importing Layout Updates
------------------------

Syntax:

.. code-block:: yaml
   :linenos:

    layout:
        actions: []
        imports:
            -
                id: 'customer_user_role_form_actions'

or just

.. code-block:: yaml
   :linenos:

    layout:
        actions: []
        imports:
            - 'customer_user_role_form_actions'

In this example, **customer_user_role_form_actions** is the name of the folder in the **layouts/{theme_name}/imports** and the unique import identifier.

This means that all layout updates will be loaded from the **layouts/{theme_name}/imports/customer_user_role_form_actions** folder on import statement.

As the result, all actions will be executed if the condition (if it exists) of the imported layout update is true.
In this case, you do not need any special syntax in the layout updates.

To import the same layout update repeatedly, provide unique IDs for all layout blocks using the following special syntax:

.. code-block:: yaml
   :linenos:

    # Layout Update in Imports Folder:

    layout:
        actions:
            - '@setBlockTheme':
                themes: 'AcmeLayoutBundle:layouts:default/layout.html.twig'
            - '@addTree':
                items:
                    __update:
    blockType: button
                        options:
                            action: submit
                            text: 'Save label'
                    __cancel:
    blockType: link
                        options:
                            route_name: oro_route_index
                            text: 'Cancel label'
                            attr:
                                'class': btn
                tree:
                    #'__root' reserved root import option
                    __root:
    __update: ~
                        __cancel: ~

Double underscore means that the namespace can be provided for these blocks. The namespace should be passed to the import statement in the following way:

.. code-block:: yaml
   :linenos:

    imports:
        -
            id: 'customer_user_role_form_actions'
            root: 'form_fields_container'
            namespace: 'form_fields'

A special `root` parameter will replace `__root` in the imported layout updates. As a result, we get the following tree:

.. code-block:: yaml
   :linenos:

    tree:
        form_fields_container: #root option replaces “__root”
            form_fields_update: ~ #namespace option replaces all first underscore of “__”
            form_fields_cancel: ~

When you provide a block theme for the imported layout update, the end identifier is not known. To state it, use a special syntax for the block name in the  `__{unique import identifier}{import block id before namespace added}_widget` template.

.. code-block:: twig
   :linenos:

    {% block __customer_user_role_form_actions__update_widget %}
    {% endblock %}

    {% block __customer_user_role_form_actions__root_widget %}
    {% endblock %}

You also can provide a template for the block template by the end identifier in the layout update which has an import statement like:

.. code-block:: twig
   :linenos:

    {% block _form_fields_container_widget %}
    {% endblock %}

    {% block _form_fields_update_widget %}
    {% endblock %}

Referencing Imported Blocks Using block_type_widget_id
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

When you need the imported block to be rendered without a direct reference to its template name, you can use the TWIG variable `block_type_widget_id` which refers to the twig widget ID for current block type, like `container_widget`, `menu_widget`, etc.

For example, here is the customized toolbar element defined in the `DataGridBundle`_ on the product page (`ProductBundle`_) in the OroCommerce application:

.. code-block:: twig
   :linenos:

    {% block _datagrid_toolbar_mass_actions_widget %}
        ...
        <div class="catalog__filter-controls__item">
            <div{{ block('block_attributes') }}>{{ block(block_type_widget_id) }}</div>
        </div>
    {% endblock %}

*Note:* By default, the element contains the `{{ block_widget(block) }}` which renders the block as a template defined in imports. We replaced it with the `block(block_type_widget_id)` to avoid mentioning the template name.

Additional Importing Examples
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Have a look at how the toolbar element in our example was imported and what the default way it rendered was.

First, the datagrid toolbar in `DataGridBundle` was imported with the following definitions:

1) ID in the `layout.yml`:

.. code-block:: yaml
   :linenos:

    layout:
        actions:
        ...
        imports:
            -
                id: datagrid_toolbar

2) Item tree in `imports/datagrid_toolbar/layout.yml` (block element `__datagrid_toolbar_mass_actions`):

.. code-block:: yaml
   :linenos:

    layout:
        actions:
            - '@setBlockTheme':
                themes: 'AcmeLayoutBundle:layouts:default/layout.html.twig'
            - '@addTree':
                items:
                    __datagrid_toolbar:
    blockType: container
                    __datagrid_toolbar_actions_container:
    blockType: container
                    __datagrid_toolbar_mass_actions:
    blockType: container
                ...
                tree:
                    __root:
    __datagrid_toolbar:
    __datagrid_toolbar_sorting: ~
    __datagrid_toolbar_actions_container:
    __datagrid_toolbar_mass_actions: ~
    ...

3) In the `imports/datagrid_toolbar/layout.html.twig`, the block element `__datagrid_toolbar_mass_actions` looked the following way:

.. code-block:: twig
   :linenos:

    {% block __datagrid_toolbar__datagrid_toolbar_mass_actions_widget %}
        <div{{ block('block_attributes') }}>{{ block_widget(block) }}</div>
    {% endblock %}

Next, we redefined the `imports/datagrid_toolbar/layout.html.twig` block in the `ProductBundle`_, which resulted in the following code:

.. code-block:: twig
   :linenos:

    {% block _datagrid_toolbar_mass_actions_widget %}
        ...
        <div class="catalog__filter-controls__item">
            <div{{ block('block_attributes') }}>{{ block_widget(block) }}</div>
        </div>
    {% endblock %}

We then modified the code to look the following way:

.. code-block:: twig
   :linenos:

    {% block _datagrid_toolbar_mass_actions_widget %}
        ...
        <div class="catalog__filter-controls__item">
            <div{{ block('block_attributes') }}>{{ block(block_type_widget_id) }}</div>
        </div>
    {% endblock %}

.. _`DataGridBundle`: https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/DataGridBundle
.. _`ProductBundle`: https://github.com/oroinc/orocommerce/tree/master/src/Oro/Bundle/ProductBundle
