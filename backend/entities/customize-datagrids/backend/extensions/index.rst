.. _customize-datagrid-extensions:

Extensions
==========

A datagrid object only takes care of converting datasource to the result set. All other operations are performed by extensions(e.g., pagination, filtering, etc.).

Here is a list of already implemented extensions:

- :ref:`Formatter <customize-datagrids-extensions-formatter>` - responsible for backend field formatting(e.g., generating URL using router, translation using Symfony translator, etc.). This extension also takes care about passing columns configuration to the view layer.
- :ref:`Pager <customize-datagrid-extensions-pager>` - responsible for pagination
- :ref:`Sorter <customize-datagrids-extensions-sorters>` - responsible for sorting
- :ref:`Action <customize-datagrids-extensions-action>` - provides actions configurations for grid
- :ref:`Mass Action <customize-datagrid-extensions-mass-action>` - provides mass actions configurations for grid
- :ref:`Toolbar <customize-datagrid-extensions-toolbar>` - provides toolbar configuration for view
- :ref:`Grid Views <customize-datagrids-extensions-grid-views>` - provides configuration for grid views toolbar
- :ref:`Export <customize-datagrids-extensions-export>` - responsible for export grid data
- :ref:`Field ACL <customize-datagrids-extensions-acl>` - allow to protect entity fields with ACL
- :ref:`Board <customize-datagrids-extensions-board>` - responsible for adding Kanban board views for datagrids
- :ref:`Filter <backend-entities-filters-grid-extension>` - responsible for adding filtering and filter widgets to grid

Customization
-------------

To implement your extension you have to do following:

- Develop class that implements ExtensionVisitorInterface (also there is basic implementation in AbstractExtension class)
- Register you extension as service with tag { name: oro_datagrid.extension }

.. toctree::
   :hidden:
   :maxdepth: 1

   action
   board
   export
   field-acl
   formatter
   grid-views
   inline-editing
   mass-action
   mode
   pager
   sorter
   toolbar
   totals