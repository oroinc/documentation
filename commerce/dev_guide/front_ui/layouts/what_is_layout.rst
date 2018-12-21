.. _dev-guide-layouts-layout:

What is Layout
==============

A **layout** defines the visual structure of the user interface element, such as a page or a widget. In other words, a **layout** is a
recursive system that knows how an element should be positioned and drawn.

Content of any page of an application is usually separated by a set of blocks grouped by content or structure.

Have a look at the following page structure:

.. image:: /dev_guide/front_ui/layouts/img/layout.png
    :alt: Page layout structure example

Here, we are splitting the page into the following blocks hierarchy:

* root
   * header
   * body
        * sidebar
        * main content
   * footer

Each of these blocks has children in the final structure, so they represent a *container*.

- A **Container** is a block type responsible for holding and rendering its children.
- A **Final block** is a block type that renders content based on data, but it cannot have children.

Each block has a **type class** that is responsible for passing options and data into view, and building the
inner structure of the block into *containers*.

The **layout** should be built by providing a set of actions called a :ref:`layot update <dev-guide-layouts-layout-updates>`.
Layout updates can be defined for a specific route and a specific :ref:`theme <dev-guide-layouts-theming>`.

Block Types
-----------

The following are the block types to build HTML layout structure:

===================  ===================
Type name            Default HTML output
===================  ===================
`root`               `<html>`
`head`               `<head>`
`title`              `<title>`
`meta`               `<meta>`
`style`              `<style>` with content or `<link>` with external resource
`script`             `<script>`
`external_resource`  `<link>`
`body`               `<body>`
`form_start`         `<form>`
`form_end`           `</form>`
`form`               Creates three child blocks: `form_start`, `form_fields`, `form_end`
`form_fields`        Adds form fields based on the Symfony form
`form_field`         Block will be rendered differently depending on the field type of the Symfony form
`fieldset`           `<fieldset>`
`link`               `<a>`
`list`               `<ul>`
`ordered_list`       `<ol>`
`list_item`          `<li>`, this block type can be used if you want to control rendering of the `li` tag and its attributes
`text`               Text node
`input`              Input node
`button`             `<button>` or `<input type="submit/reset/button">`
`button_group`       No HTML output. It is used for logical grouping of buttons. You can define how to render the button group in your application
===================  ===================

.. _dev-guide-layouts-find-block-to-customize:

Identify a Block for Customization
----------------------------------

To locate a specific block and its template to customize the design or content in the storefront, use the **Block Information Debugger** OroCommerce development tool, as described below:

.. note:: You have to perform the following steps in the application *development* mode.

1. Enable the block's debug information in HTML source code of the storefront pages, as described in the :ref:`Debug Layout Blocks <dev-guide-layouts-debugging-debug-blocks>` topic.

   Once debug information is enabled, attributes ``data-layout-debug-block-id`` with the block ID and ``data-layout-debug-block-template`` with the block template file name are displayed in the root HTML tag of every layout block on the page.

#. With browser development tools (or by browsing a storefront page HTML source code):

   * For the point you want to change, find the closest **parent HTML node** with the *block id* and *block template* data and note down their details for later. They contain the information about the **main** desired layout block.
   * Find the closest **next HTML node** *after* the point you want to change, which has such block information and note down its details for later. They contain information about the **auxiliary** desired layout block.

#. Use the **Layouts** tab of the Symfony Profiler to find the stack of applicable template name prefixes for the blocks with retrieved IDs:

   #. :ref:`Open the Layouts tab of the Symfony Profiler <dev-guide-layouts-debugging>`
   #. In the :ref:`Layout Tree <dev-guide-layouts-debugging_layouts_tree>`, find the blocks with the retrieved IDs.
   #. For each of the *main* and *auxiliary* blocks:

      * Click on the tree node with the block ID.
      * Expand the **Variables** section on the right side of the layout tree; it displays variables for selected block.
      * Find the **block_prefixes** variable. It contains a list of applicable block template prefixes sorted by priority in ascending order.

        It means that if there are two templates for the block in the application (the one with the last prefix on the list and the second with the next-to-last prefix), the template with the last prefix will be applied to the block.

#. Open the block template files (discovered in the second step) for the *main* and *auxiliary* blocks.

#. In the opened template files, locate the applied block template for both blocks.

   Starting from the end of *block_prefixes* list for block, for each block prefix:

   * Figure out the block template name for this prefix by concatenating the block prefix with a ``_widget`` suffix.
   * Search the block template with a figured template name in the opened template file.
   * If the file contains the searched template, **you have found the desired block template** responsible for the representation of the desired block.
   * If template file does not contain the template with a figured name, go to the next block prefix on the *block_prefix* list.
   * Repeat these steps until you find the block template. The *block_prefix* list **must** contain the prefix for the applied block template.

#. At this step, you have found the templates for the *main* and *auxiliary* blocks.

   In most cases, the desired HTML markup is located in the *main* block template. In a rare cases, it may be located in the *auxiliary* block template.

Related Links
-------------

* `Oro Layout component`_

.. _`Oro Layout component`: https://github.com/oroinc/platform/tree/master/src/Oro/Component/Layout
