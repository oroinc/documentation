.. _dev-doc-frontend-layouts-theming-page-templates:

Page Templates
==============

A **page_template** is a collection of files that expand the visual
presentation for one or more route names.

The page templates **configuration file** should be placed in the
`Resources/views/layouts/{theme_name}/config` folder and named `page_templates.yml`,
for example
`DemoBundle/Resources/views/layouts/first_theme/config/page_templates.yml`.

The **allowed page templates configuration options** are the following:

+---------------+------------------------------+-----------------------+
| Option        | Description                  | Required              |
+===============+==============================+=======================+
| `label`       | Label will be displayed in   | yes                   |
|               | the page template management |                       |
|               | UI.                          |                       |
+---------------+------------------------------+-----------------------+
|  `route_name` | Route name identifier, used  | yes                   |
|               | in the path where **layout** |                       |
|               | **updates** stored.          |                       |
+---------------+------------------------------+-----------------------+
| `key`         | Key used in the path where   | yes                   |
|               | **layout updates** are       |                       |
|               | stored.                      |                       |
+---------------+------------------------------+-----------------------+
| `description` | Description will be          | no                    |
|               | displayed in the page        |                       |
|               | template management UI.      |                       |
+---------------+------------------------------+-----------------------+
|  `screenshot` | Screenshot for preview. This | no                    |
|               | will be displayed in the     |                       |
|               | page template management UI. |                       |
+---------------+------------------------------+-----------------------+
|  `enabled`    | Enable/Disable page template | no                    |
+---------------+------------------------------+-----------------------+

**Example:**

.. code-block:: yaml
    :linenos:

    #DemoBundle/Resources/views/layouts/first_theme/config/page_templates.yml
    templates:
       -
           label: Custom page template
           description: Custom page template description
           route_name: demo_first_route_name
           key: custom
       -
           label: Additional page template
           description: Additional page template description
           route_name: demo_first_route_name
           key: additional
       -
           label: Additional page template
           description: Additional page template description
           route_name: demo_second_route_name
           key: additional
    titles:
       demo_first_route_name: First route name title
       demo_second_route_name: Second route name title

.. note:: Be aware that page templates inherit parent themes. To
    override the existing page template, add the **layout update** file to
    the page template path in your child theme. For example, if
    `first_theme` is the parent theme of `second_theme`, put the page
    template into
    `DemoBundle/Resources/views/layouts/second_theme/demo_first_route_name/page_template/custom/layout.yml`.

All page template :ref:`layout updates <dev-doc-frontend-layouts-layout-updates>` should be stored in the
`Resources/views/layouts/{theme_name}/{route_name}/page_template/{page_template_KEY}/`
folder, for example
`DemoBundle/Resources/views/layouts/first_theme/demo_first_route_name/page_template/custom/layout.yml`.


.. include:: /include/include-links-dev.rst
   :start-after: begin
