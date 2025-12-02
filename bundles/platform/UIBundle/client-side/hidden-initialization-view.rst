.. _bundle-docs-platform-ui-bundle-hidden-initialization-view:

HiddenInitializationView ⇐ `BaseView`
=====================================

* **Extends:** `BaseView`
* **Kind:** global class

HiddenInitializationView()
--------------------------

The **HiddenInitializationView** is used to temporarily hide a section of the DOM until all page components within it are fully initialized.

Usage Example
-------------

.. note::
   All attributes on the `<div>` element below are required for correct functionality.

.. code-block:: html

    <div class="invisible"
            data-page-component-module="oroui/js/app/components/view-component"
            data-page-component-options="{'view': 'oroui/js/app/views/hidden-initialization-view'}"
            data-layout="separate">
        <!-- write anything here -->
    </div>


