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

Identify The Block To Customize
-------------------------------

When you need to find out the specific block and its template to customize the design or content on the storefront, use the `Twig Inspector <https://github.com/oroinc/twig-inspector>`_ tool, that is part of the OroCommerce application since v.3.1.

Please, refer to the `Twig Inspector manual <https://github.com/oroinc/twig-inspector/blob/master/Bundle/Resources/doc/usage.md>`_ for the detailed information on how to use it.

Related Links
-------------

* `Oro Layout component`_

.. _`Oro Layout component`: https://github.com/oroinc/platform/tree/master/src/Oro/Component/Layout
