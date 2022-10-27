:oro_documentation_types: OroCommerce

.. _user-guide--marketing--web-catalog--node--visibility:
.. _user-guide--marketing--web-catalog--content--visibility:
.. _user-guide--marketing--web-catalog--customize:

Customize Web Catalog Contents for Localization, Customer, Customer Group, or Website
-------------------------------------------------------------------------------------

.. begin

Set Up Visibility of Content Node
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

By default, the web catalog with all its nodes has no visibility restrictions and can be displayed for any localization, on any website, and for any customer.

The web catalog node inherits visibility settings from the root node or its parent node.

.. image:: /user/img/marketing/web_catalogs/InheritParent.png
   :alt: Check the Inherit Parent box to apply the visibility settings of the parent node

However, you can adjust it to be displayed for particular localization, on a specific website, and/or for the selected customer(s).

To modify the inherited default settings, clear the **Inherit Parent** box, and specify the restrictions by selecting all or some of the following: target localization, website, and customer or customer group.

.. note:: Only one field must be chosen for customers at a time, either a customer group or a customer.

.. warning:: Never leave the restrictions for a non-default variant empty. This may cause an unexpected priority collision between the default and the non-default variant.

.. image:: /user/img/marketing/web_catalogs/InheritParentOff.png
   :alt: Modify the inherited default settings by clearing the Inherit Parent box

Set Up Visibility of Content Variants
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Once you add more than one content variant, you must apply restrictions to any non-default variants.

These restrictions help you set the conditions where content should override the default option.

This may be necessary for multiple localizations, where the content item should link to the system page written in the appropriate language. Another example is when your products, product categories, or collections differ for various countries, e.g., you might need an alternative product collection for USA and UK. Finally, you might like to limit the offerings based on your customer business and any legal limitations.

Set a restriction by selecting all or some of the following: target localization, website, and customer or customer group.

.. note:: Only one field must be chosen for customers at a time, either a customer group or a customer.

.. warning:: Never leave the restrictions for a non-default variant empty. This may cause an unexpected priority collision between the default and the non-default variant.

To apply content to more than one localization, website, and customer group or customer, click **Add** and set up additional conditions where content should override the default option.

.. image:: /user/img/marketing/web_catalogs/AddMoreRestrictions.png
   :alt: Click Add and set up additional conditions

.. finish