:oro_show_local_toc: false

.. _WYSIWYG-field-dev-guide:

WYSIWYG Field
=============

|WYSIWYG| field type utilizes an editor that provides advanced editing capabilities. Any editor can be integrated with WYSIWYG fields, and the |GrapesJS| editor is integrated out of the box.
An administrator can add a new WYSIWYG field to any entity available in Entity Management. Landing Page and :ref:`Content Blocks <bundle-docs-commerce-cms-bundle-content-blocks>` entities use WYSIWYG for their content fields by default.

Structure
---------

Each WYSIWYG field data is divided and stored in three separate pieces: HTML markup, CSS styles, JSON properties.
In practice, the field with the ``content`` name is stored in three fields:

 * ``content`` - the main field (database column) to save the HTML markup of the content;
 * ``content_style`` - an additional field (database column) to save the CSS styles applied by the editor to the content;
 * ``content_properties`` - an additional field (database column) to save additional JSON metadata stored by the editor to properly initialize its UI.

Related Documentation
---------------------

* |WYSIWYG|
* |GrapesJS|


.. toctree::
   :maxdepth: 1
   :hidden:

   how-to-add-wysiwyg-field
   how-to-display-wysiwyg-field
   how-to-change-textarea-field-to-wysiwyg-field
   wysiwyg-field-validation

.. include:: /include/include-links-dev.rst
   :start-after: begin
