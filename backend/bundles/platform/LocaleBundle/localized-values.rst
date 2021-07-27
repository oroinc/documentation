.. _bundle-docs-platform-locale-bundle-localized-values:

Localized Values
================

Format Values in Twig
---------------------

Use `localized_value` twig filter

.. code-block:: twig

    {# mytwig.html.twig #}
    localization.titles|localized_value

Format Values in Layout Configs
-------------------------------

Use `locale` layout data provider and `getLocalizedValue()`.

.. code-block:: yaml

    # .../Resources/views/layouts/.../myconfig.yml
    layout:
        actions:
            - '@add':
                ...
                options:
                    ...
                    content: '=data["locale"].getLocalizedValue(data["localization"].getTitles())'

Format Values in Datagrids
--------------------------

Use datagrid property with type `localized_value` and attribute `data_name` to set the required property by path, for example `titles`, `relation.subrelation.titles`.
If the current localization is not detected, SQL relation will be joined to the default fallback values. Otherwise, it will be received by LocalizationHelper; sorters and filters will be removed.

.. code-block:: yaml

    # .../Resources/config/oro/datagrids.yml
    datagrids:
        my-localizations-grid:
            source:
                type: orm
                query:
                    select:
                        - l.id
                        - l.name
                    from:
                        - { table: Oro\Bundle\LocaleBundle\Entity\Localization, alias: l }
            properties:
                title:
                    type: localized_value # property type
                    data_name: titles # property path to localized property of an entity
            columns:
                name:
                    label: Name
                title:
                    label: Title
            sorters:
                columns:
                    name:
                        data_name: name
                    title:
                        data_name: title
            filters:
                columns:
                    name:
                        type: string
                        data_name: name
                    title:
                        type: string
                        data_name: title

