.. _user-guide--marketing--web-catalog--node--visibility:

.. begin

Configure Content Visibility
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Set Up Visibility of Content Node
"""""""""""""""""""""""""""""""""

By default, the web catalog with all its nodes has no visibility restrictions and may be displayed for any localization, on any website, and for any customer.

The web catalog node inherits visibility settings from the root node or its parent node.

.. image:: /user_guide/img/marketing/web_catalogs/InheritParent.png
   :class: with-border

However, you can adjust it to be displayed for particular localization, on a specific website, and/or for the selected customer(s).

To modify the inherited default settings, clear the **Inherit Parent** box, and specify the restrictions by selecting all or some of the following: target localization, website, and customer or customer group.

.. note:: Only one field must be chosen for customers at a time, either a customer group and a customer.

.. warning:: Never leave the restrictions for non-default variant empty. This may cause unexpected priority collision between the default and non-default variant.

.. image:: /user_guide/img/marketing/web_catalogs/InheritParentOff.png
   :class: with-border

.. include:: /user_guide/marketing_web_catalog/edit_content_tree/content_variant_visibility.rst
   :start-after: start
   :end-before: stop

.. finish

.. toctree::
   :hidden:

   content_variant_visibility