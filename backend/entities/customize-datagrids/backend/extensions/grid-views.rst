.. _customize-datagrids-extensions-grid-views:

Grid Views Extension
====================

Configure All Grid View Label
-----------------------------

All Grid View Label is set in ``Oro\Bundle\DataGridBundle\EventListener\DefaultGridViewLoadListener`` and in ``orodatagrid/js/datagrid/grid-views/view.``

There are 2 ways to set a label for `All grid view`:

* Via an option in datagrid config:

.. code-block:: yaml
   :linenos:

    # ...
    options:
        gridViews:
            allLabel: acme.bundle.translation_key # Translation key for All label

* Via a pre-defined translation key for the entity used in the datagrid datasource. The translation key uses the following pattern: `[vendor].[bundle].[entity].entity_grid_all_view_label`, e.g. for ``Oro\Bundle\TranslationBundle\Entity\Language`` - `oro.translation.language.entity_grid_all_view_label`.

If bundle name equals entity name, then entity name is skipped, e.g. for ``Oro\Bundle\TranslationBundle\Entity\Translation`` - `oro.translation.entity_grid_all_view_label`.

If the `allLabel` option is not specified and translation key is not translated, then the label for All grid view is created by concatenating the `oro.datagrid.gridView.all` translation key and the entity name in the plural form, e.g., for the Contact entity in the English language it is "All Contacts".

