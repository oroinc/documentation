.. _bundle-docs-platform-ui-bundle-twig-filters:

TWIG Filters
============

HTML
----

oro_html_sanitize
^^^^^^^^^^^^^^^^^

The **oro_html_sanitize** filter removes HTML elements except those that are allowed. You can find the list of allowed HTML tags in the |app.yml| file.

.. code-block:: twig
   :linenos:

   {{ data|oro_html_sanitize() }}

**Example**

.. code-block:: none

   {% set data %}
       <h1>Header</h1>
       <div class="container" data-label="Container Label" id="root">
           <p>Paragraph 1: <strong>Strong</strong> like <b>Bold</b></p>
           <p>Paragraph 2: <em>Italic</em></p>
           <script type="text/javascript">alert("Hello World!");</script>
       </div>
   {% endset %}

   {{ data|oro_html_sanitize() }}

will print result:

.. code-block:: html
   :linenos:

    <div class="test">
        <h1>Header</h1>
        <p>Paragraph 1: <strong>Strong</strong> like <b>Bold</b></p>
        <p>Paragraph 2: <em>Italic</em></p>
    </div>

oro_html_strip_tags
^^^^^^^^^^^^^^^^^^^

The **oro_html_strip_tags** filter removes all HTML tags. 

.. code-block:: twig
   :linenos:

   {{ data|oro_html_strip_tags() }}

**Example**

.. code-block:: twig
   :linenos:

    {% set data %}
        <p>Paragraph 1: <strong>Strong</strong> like <b>Bold</b></p>
        <p>Paragraph 2: <em>Italic</em></p>
        <script type="text/javascript">alert("message");</script>
    {% endset %}

    {{ data|oro_html_strip_tags() }}

will print result:

.. code-block:: html
   :linenos:

    Paragraph 1: Strong like Bold Paragraph 2: Italic alert("message");

oro_html_escape
^^^^^^^^^^^^^^^

The **oro_html_escape** filter allows HTML tags, all forbidden tags are escaped.

.. code-block:: twig
   :linenos:

   {{ data|oro_html_escape() }}

**Example**

.. code-block:: twig
   :linenos:

    {% set data %}
        <p>Paragraph 1: <strong>Strong</strong> like <b>Bold</b></p>
        <p>Paragraph 2: <em>Italic</em></p>
        <script type="text/javascript">alert("message");</script>
    {% endset %}

    {{ data|oro_html_escape() }}

will print result:

.. code-block:: html
   :linenos:

    <p>Paragraph 1: <strong>Strong</strong> like <b>Bold</b></p>
    <p>Paragraph 2: <em>Italic</em></p>
    &lt;script type="text/javascript"&gt;alert("message");&lt;/script&gt;

Array
-----

Sort By
^^^^^^^

The **oro_sort_by** filter sorts an array by a property. The following example shows how items can be sorted by priority:

.. code-block:: twig
   :linenos:

    {% set dataBlocks = [
        {
            'title': 'orocrm.account.sections.general'|trans,
            'class': 'active',
            'subblocks': generalSectionBlocks
        },
        {
            'title': 'orocrm.account.sections.sales'|trans,
            'priority': 100,
            'subblocks': salesSectionBlocks
        }
    ] %}
    {% if channelSectionBlocks %}
        {% set dataBlocks = dataBlocks|merge([
            {
                'title': 'orocrm.account.sections.channels'|trans,
                'priority': 50,
                'subblocks': channelSectionBlocks
            }
        ]) %}
    {% endif %}

    {% set data = {'dataBlocks': dataBlocks} %}

    {% set dataBlocks = data.dataBlocks|oro_sort_by %}

In this example, `channelSectionBlocks` can be empty and in this case it should not be rendered. However, if channels exist, then this block should be rendered between the `general` and `sales` blocks. To achieve this, set the priority property for `channels` and `sales` blocks and then use the **oro_sort_by** filter to sort blocks in the correct order.

You can also use the following options to tune **oro_sort_by** filter:

 - **property** - The path of the property by which the array should be sorted. It can be just the property name or any valid expression supported by |Symfony PropertyAccess Component|. The default value of this option is **priority**.
 - **reverse** - Indicates whether the sorting should be performed in reverse order. The default value of this option is **false**.
 - **sorting-type** - The sorting type. You can use **number**, **string** or **string-case**. The **string-case** means that case-insensitive string comparison should be used. The default value of this option is **number**.

The following example shows how you can sort array by `name` property using case-insensitive comparison:

.. code-block:: twig
   :linenos:

   {% set items = items|oro_sort_by({'property': 'name', 'sorting-type': 'string-case'}) %}

.. include:: /include/include-links-dev.rst
   :start-after: begin