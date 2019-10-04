.. _templates-twig:

Templates (Twig)
================

Templates define the way the :ref:`tree of layout blocks <dev-doc-frontend-layout-blocks>` is rendered on the page.

We use |Twig| as a templating engine. Twig enables you to write concise,
readable templates that are more friendly to web designers, and, in
several ways, more powerful than PHP templates.

.. seealso::

   :ref:`Front-rendered Underscore.js Templates <frontend-architecture-js-templates>`

.. _dev-doc-frontend-twig-blocks-and-block-themes:

Twig Blocks & Block Themes
--------------------------

Each layout block is rendered with a **Twig block**, as in:

.. code:: twig

   {% block _header_widget %}
       <header{{ block('block_attributes') }}>
           {{ block_widget(block) }}
       </header>
   {% endblock %}

Twig blocks are organized to Twig files named **block themes**.

For instance, |this block theme| is used as a theme for the product display page.

.. _dev-doc-frontend-twig-block-names:

Twig Block Names
----------------

You can define Twig block for a single layout block or for all the
layout blocks of the same block type.

Layout engine will try to find Twig block by layout block ID first, then
by the block type, then by the parent block type if it is defined and
so on. The Twig block found first will be used for rendering:

1.  ``{% block _<block_id>_widget %}``
2.  ``{% block <block_type>_widget %}``
3.  ``{% block <parent_block_type>_widget %}``

Twig block names are build with the following rules:
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

-  Names always end with the ``_widget`` suffix.
-  Names for block IDs start with the underscore (``_``) character, then goes the
   block ID, then the ``_widget`` suffix.
-  Names for block types start with a block type name, then the ``_widget``
   suffix.

For instance, to define a layout block named ``header`` with the ``container`` block type, you need:

.. code:: yaml

   layout:
       actions:
           - '@add':
               id: header
               parentId: head
               blockType: container

The layout engine will look for:

1.  ``{% block _header_widget %}`` - starts with an underscore, then the block ID and the ``_widget`` suffix.
2.  ``{% block container_widget %}`` - a block type name with the ``_widget`` suffix.

If ``_header_widget`` is found, it will be used, if not,
``container_widget`` will be used for rendering the ``header`` layout block.

.. _dev-doc-frontend-apply-block-theme:

Apply a Block Theme
-------------------

To use a block theme on a page, you have to add the ``setBlockTheme`` instruction to the :ref:`layout update <dev-doc-frontend-layouts-layout-updates>` yaml file.

.. code:: yaml

   layout:
       actions:
           - '@setBlockTheme':
               themes: 'profile.html.twig'

Where ``profile.html.twig`` is the relative path to the template, from
the layout update file where ``setBlockTheme`` instruction is defined.

You can pass multiple block themes to the instruction:

.. code:: yaml

   layout:
       actions:
           - '@setBlockTheme':
               themes: ['profile.html.twig', 'sidebar.html.twig']

To reference the template from another bundle, you can use standard
Symfony syntax with the bundle name and folder name inside the
``Resources/views`` folder:

.. code:: yaml

   layout:
       actions:
           - '@setBlockTheme':
               themes: '@AcmeLayout/layouts/default/base.html.twig'

**Note:** Form themes are managed separately from the layout block
themes, see |Form Themes| for more details. To apply the form theme, use the ``@setFormTheme`` action.

.. _dev-doc-frontend-locate-block-themes:

Locate Block Themes
-------------------

To find the block theme Twig file and the Twig block that is used for rendering a
specific block of content, you can use |Twig Inspector| that enables
you to navigate instantly from a Browser to the Twig template which opens
automatically in a PhpStorm.

.. _dev-doc-frontend-dump-block-variables:

Dump Block Variables
--------------------

To discover variables available in a block, you can use the snippets below:

-  To dump all variables

   .. code:: twig

      {{ dump(_context) }}

-  To dump all variables to the |Symfony Profiler|

   .. code:: twig

      {% dump(_context) %}

-  To dump a single variable

   .. code:: twig

      {{ dump(variableName) }}

.. _dev-doc-frontend-pass-variables-to-the-twig-block:

Pass Variables to the Twig Block
--------------------------------

Block Type Options
^^^^^^^^^^^^^^^^^^

You can pass variables from layout update yaml files to Twig blocks with
options that are defined by :ref:`block type <dev-doc-frontend-block-types>`.

For example:

.. code:: yaml

   layout:
       actions:
           - '@add':
               id: call_button
               parentId: profile
               blockType: button
               options:
                   action: submit
                   text: 'Call Client'
                   icon: 'phone'

Now, you can use the ``action``, ``text``, and ``icon`` options in a block theme:

.. code:: twig

   {% block _call_button_widget %}
       <button
           type="{{ action in ['submit', 'reset'] ? action : 'button' }}"
           {%- if action in ['submit', 'reset'] %} type="{{ action }}"{% endif %}
           {{ block('icon_block') }}
           {{ text|trans }}
       </button>
   {% endblock %}

HTML Attributes
^^^^^^^^^^^^^^^

To pass HTML attributes to the Twig block, use the ``attr`` option.

For example:

.. code:: diff

     layout:
         actions:
             - '@add':
                 id: call_button
                 parentId: profile
                 blockType: button
                 options:
                     action: submit
                     text: 'Call Client'
                     icon: 'phone'
   +                 attr:
   +                    class: btn
   +                    id: call-button

In block themes, HTML attributes are rendered with ``{{ block('block_attributes') }}``:

.. code:: diff

     {% block _call_button_widget %}
   -      <button
   +      <button {{ block('block_attributes') }}
             type="{{ action in ['submit', 'reset'] ? action : 'button' }}"
             {%- if action in ['submit', 'reset'] %} type="{{ action }}"{% endif %}
             {{ block('icon_block') }}
             {{ text|trans }}
         </button>
     {% endblock %}

Custom Variables
^^^^^^^^^^^^^^^^

To pass custom variables that are not defined in the layout block type, use the ``vars`` options. For example:

.. code:: diff

     layout:
         actions:
             - '@add':
                 id: call_button
                 parentId: profile
                 blockType: button
                 options:
                     action: submit
                     text: 'Call %username%'
                     icon: 'phone'
   +                 vars:
   +                     userName: John Doe

Now, you can use an additional ``userName`` variable in a block theme for the ``call_button`` block:

.. code:: diff

     {% block _call_button_widget %}
         <button {{ block('block_attributes') }}
             type="{{ action in ['submit', 'reset'] ? action : 'button' }}"
             {%- if action in ['submit', 'reset'] %} type="{{ action }}"{% endif %}
             {{ block('icon_block') }}{% endif %}
   -         {{ text|trans }}
   +         {{ text|trans({'%userName%': userName}) }}
         </button>
     {% endblock %}

.. _twig-filters-and-functions:

Twig Filters and Functions
--------------------------

-  |Twig filters| are used to modify variables. Twig comes with many |built in filters|.
-  |Twig functions| are used to generate content. |List of built-in Twig functions|.

Oro defines a lot of additional filters and functions. To get the full list, run:

.. code:: bash

   bin/console debug:twig

Render List of Items with the Same Template
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Iteration over an array or a collection of data can be implemented in a block template
of a block theme file, for instance:

.. code:: twig

    {% block _attributes_container_widget %}
        <div class="attributes-container">
            {% for attribute in attributes %}
                {% do block|merge_context({'attribute': attribute}) %}
                {{ block('container_widget') }}
            {% endfor %}
        </div>
    {% endblock %}

This block will iterate over all values from the ``attributes``
collection, pass the ``attribute`` variable with the appropriate value
to all children blocks, and render all children blocks for every
existing attribute.

Provide Defaults for Block Attributes
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To simplify block attribute configuration, use the
``layout_attr_defaults(attr, default_attr)`` Twig function :

.. code:: twig

    {% set attr = layout_attr_defaults(attr, {
        required: 'required',
        autofocus: true,
        '~class': " input input--full input--size-m {{ class_prefix }}--another-modifier"
    }) %}

If you use prefix ``~`` value ``attr``, concatenate the ``default_attr`` value with this prefix.

Access Layout Block by ID
^^^^^^^^^^^^^^^^^^^^^^^^^

You can access any layout block from a different block using its ID and
modify the template based on the existing block or any of its
properties.

.. code:: twig

    {% block root_widget %}
        <!DOCTYPE {{ doctype|default('html') }}>
        {% if blocks.sidebar is defined and blocks.sidebar.children|length > 0 %}
            {% set attr = attr|merge({'class': 'layout-with-sidebar'}) %}
        {% endif %}
        <html{{ block('block_attributes') }}>
        {{ block_widget(block) }}
        </html>
    {% endblock %}

.. _overriding-templates:

Override Templates
------------------

Layout blocks are rendered with Twig blocks. To override the block in
Twig, you can define the new block with the same name in another block
theme file and load it with ``setBlockTheme`` in layout update Yaml
file:

1) First, you need to :ref:`locate the block <dev-doc-frontend-locate-block-themes>` that is used for rendering the
   content you want to override.
2) Then, find the name for a new block. If the original block name starts
   with the underscore character (``_``), than you can use the same block
   name. Otherwise, the Twig block is used for rendering multiple layout
   blocks, and you should select the content you want to override.

   *  To override all the places where the found template is used, use the
      same block name as the original one.
   *  To override only the single place, use :ref:`block name <dev-doc-frontend-twig-block-names>` for block ID
      instead.

   You can read the :ref:`Symfony Profiler Layout Section <dev-doc-frontend-layouts-debugging-layout-tree>` to find out how to name the corresponding twig blocks naming logic.

3) Find the folder, :ref:`where to locate a layout update yaml file <dev-doc-frontend-where-to-place-layout-updates>`.
4) If no folder found in step 3, create a new block theme Twig file and place a new block with the name you found in step 2 into this folder.
5) Create a :ref:`layout update yaml file <dev-doc-frontend-layouts-layout-updates>` with the ``setBlockTheme``
   instruction that will :ref:`apply block theme <dev-doc-frontend-apply-block-theme>` Twig file from step 4.


.. include:: /include/include-links.rst
   :start-after: begin
