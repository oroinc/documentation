.. _bundle-docs-platform-ui-bundle-twig-filters:

TWIG Filters
============

HTML
----

oro_html_sanitize
^^^^^^^^^^^^^^^^^

The **oro_html_sanitize** filter removes all HTML elements except those explicitly allowed.
The list of allowed HTML tags can be found in the |app.yml| configuration file.

.. code-block:: twig

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

This will produce:

.. code-block:: html

    <div class="test">
        <h1>Header</h1>
        <p>Paragraph 1: <strong>Strong</strong> like <b>Bold</b></p>
        <p>Paragraph 2: <em>Italic</em></p>
    </div>

oro_html_strip_tags
^^^^^^^^^^^^^^^^^^^

The **oro_html_strip_tags** filter removes all HTML tags entirely.

.. code-block:: twig

   {{ data|oro_html_strip_tags() }}

**Example**

.. code-block:: twig

    {% set data %}
        <p>Paragraph 1: <strong>Strong</strong> like <b>Bold</b></p>
        <p>Paragraph 2: <em>Italic</em></p>
        <script type="text/javascript">alert("message");</script>
    {% endset %}

    {{ data|oro_html_strip_tags() }}

Result:

.. code-block:: html

    Paragraph 1: Strong like Bold Paragraph 2: Italic alert("message");

oro_html_escape
^^^^^^^^^^^^^^^

The **oro_html_escape** filter allows HTML tags, but escapes all forbidden tags.

.. code-block:: twig

   {{ data|oro_html_escape() }}

**Example**

.. code-block:: twig

    {% set data %}
        <p>Paragraph 1: <strong>Strong</strong> like <b>Bold</b></p>
        <p>Paragraph 2: <em>Italic</em></p>
        <script type="text/javascript">alert("message");</script>
    {% endset %}

    {{ data|oro_html_escape() }}

Result:

.. code-block:: html

    <p>Paragraph 1: <strong>Strong</strong> like <b>Bold</b></p>
    <p>Paragraph 2: <em>Italic</em></p>
    &lt;script type="text/javascript"&gt;alert("message");&lt;/script&gt;

Array
-----

Sort By
^^^^^^^

The **oro_sort_by** filter sorts an array by a given property. For example, you can sort blocks by `priority`:

.. code-block:: twig

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

In this example, `channelSectionBlocks` may be empty, in which case the block is not rendered.
If it exists, it is rendered between `general` and `sales` blocks by using the `priority` property and the **oro_sort_by** filter.

The **oro_sort_by** filter supports the following options:

* **property** – The property to sort by. Can be a simple property name or any valid expression supported by |Symfony PropertyAccess Component|. Default is **priority**.
* **reverse** – Whether to reverse the sort order. Default is **false**.
* **sorting-type** – The sorting type. Can be **number**, **string**, or **string-case**. **string-case** performs a case-insensitive string comparison. Default is **number**.

**Example:** Sorting an array by the `name` property using case-insensitive comparison:

.. code-block:: twig

   {% set items = items|oro_sort_by({'property': 'name', 'sorting-type': 'string-case'}) %}


.. include:: /include/include-links-dev.rst
   :start-after: begin