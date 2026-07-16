# reStructuredText Syntax

This guide provides basic information about text formatting using the reStructuredText (reST) markup language.

It contains the syntax required to create and update documentation files in the Oro documentation.

For more information, refer to the Sphinx [reStructuredText Primer](https://www.sphinx-doc.org/en/master/usage/restructuredtext/basics.html) and the [Quick reStructuredText](https://docutils.sourceforge.io/docs/user/rst/quickref.html) guide by [docutils](https://docutils.sourceforge.io/).

The most complete information is available in the [reStructuredText specifications](https://docutils.sourceforge.io/docs/ref/rst/restructuredtext.html).

For information about documentation structure, topic organization, file naming conventions, and adding new topics, see [CONTRIBUTING.md](CONTRIBUTING.md).


## Headings

Use the following markup for headings to split your topic into sections, subsections, and more granular parts.

Use an underline with `=`, `-`, `^`, `~`, or `"` to mark up sections.

Example:

```rst
Section 1
=========

Section 1.1
-----------

Section 1.1.1
^^^^^^^^^^^^^

Section 1.1.1.1
~~~~~~~~~~~~~~~

Paragraph Title
"""""""""""""""
```

Preserve the same level of indentation for all lines of the paragraph.


## Inline Markup

Surround text with:

| Syntax | Result |
|---|---|
| `*text*` | *italic* |
| `**text**` | **bold** |
| ````text```` | ``preformatted`` |

To use these symbols in text without affecting formatting, escape them with a backslash (`\`).

Example:

```rst
\*not italic\*
```


## Bulleted Lists

To create a bullet list, start a line with `*`, `+`, or `-` followed by whitespace.

Example:

```rst
* Item A
* Item B

    - Item C
    - Item D

        + Item E
        + Item F
```


## Numbered Lists

To create numbered lists, use:

- Arabic numerals (`1`, `2`, `3`)
- Uppercase or lowercase letters (`A`, `B`, `C`)
- Roman numerals (`I`, `II`, `III`)

You can automatically enumerate lists by using `#`.

Example:

```rst
#. Item A
#. Item B

    #. Item C
    #. Item D
```


## Text Blocks

### Attention

Syntax:

```rst
.. attention:: The attention message.
```

### Caution

Syntax:

```rst
.. caution:: The caution message.
```

### Warning

Syntax:

```rst
.. warning:: The warning message.
```

### Hint

Syntax:

```rst
.. hint:: The hint message.
```

### Note

Syntax:

```rst
.. note:: The note message.
```

### Tip

Syntax:

```rst
.. tip:: The tip message.
```

### Important

Syntax:

```rst
.. important:: The important message.
```


## Tables

### Grid Tables

Example:

```rst
+------------+------------+-----------+
| Header 1   | Header 2   | Header 3  |
+============+============+===========+
| Cell 1.1   | Cell 1.2   | Cell 1.3  |
+------------+------------+-----------+
| Cell 2.1   | Cell 2.2   | Cell 2.3  |
+------------+------------+-----------+
```

### CSV Tables

Example:

```rst
.. csv-table::
   :header: "**OroCommerce Field**","**Outlook Field**"
   :widths: 20, 20

   "Subject","Subject"
   "Priority","Priority"
   "Due Date","Due Date"
```


## Internal Links

RST supports references across documentation pages.

Create an anchor at the beginning of a section:

```rst
.. _anchor-name:

Quotes
======

See the :ref:`Quotes <anchor-name>` section for more details.
```

Anchors allow references to continue working if files are renamed.

To link to another section in the same file:

```rst
See `Section About the Elephants`_.
```


## External Links

Oro documentation uses named references for external links instead of standard RST links.

Use vertical bars:

```rst
|GDPR portal|
```

Then define the link in the appropriate include file, depending on whether you are contributing to the user, developer, or cloud guides. Include files are located in the `include` folder at the documentation root.

```rst
.. |GDPR portal| raw:: html

   <a href="https://www.eugdpr.org/" target="_blank">GDPR portal</a>
```

Make sure you add the required links file at the bottom of the file you are contributing to:

```rst
.. include:: /include/include-links-cloud.rst
   :start-after: begin
```

or:

```rst
.. include:: /include/include-links-dev.rst
   :start-after: begin
```

or:

```rst
.. include:: /include/include-links-user.rst
   :start-after: begin
```