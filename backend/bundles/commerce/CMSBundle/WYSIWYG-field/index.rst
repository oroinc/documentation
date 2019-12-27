:oro_show_local_toc: false

.. _WYSIWYG-Field:

WYSIWYG Field
=============

|WYSIWYG| field type utilizes an editor that provides advanced editing capabilities. Any such editor can be integrated with WYSIWYG fields, and the |GrapesJS| editor is integrated out of the box.
An administrator can add a new WYSIWYG field to any entity available in Entity Management. Landing Page and |Content Blocks md| entities use WYSIWYG for their content fields by default.

Structure
---------

Each WYSIWYG field stores data in three separate pieces:

 * ``content`` - a field (database column) to save the HTML markup of the content;
 * ``styles`` - a field (database column) to save the CSS styles applied by the editor to the content;
 * ``properties`` - a field (database column) to save additional JSON metadata stored by the editor to properly initialize its UI.

When using Entity Management UI, the system takes care of managing the additional fields in the background. For example, if you add a WYSIWYG field called ``description`` to some entity, the system will automatically create fields called ``description_styles`` and ``description_properties``. When adding a WYSIWYG field programatically, developers should create and name all three fields and databases columns themselves.

Related Documentation
---------------------

* |WYSIWYG|
* |GrapesJS|


.. toctree::
   :maxdepth: 1
   :hidden:

   how-to-add-wysiwyg-field
   how-to-change-textarea-field-to-wysiwyg-field
   wysiwyg-field-validation

.. include:: /include/include-links-dev.rst
   :start-after: begin
