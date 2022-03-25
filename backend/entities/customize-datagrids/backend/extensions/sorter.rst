:oro_show_local_toc: false

.. _customize-datagrids-extensions-sorters:

Sorter Extension
================

This extension provides sorting, it also is responsible for passing the "sorter" settings to the view layer.

Settings
--------

Sorters setting should be placed under the `sorters` tree node.

.. code-block:: none


    datagrids:
        demo:
            source:
                type: orm
                query:
                    select
                        - o.label
                        - 2 as someAlias
                        - test.some_id as someField
                    from:
                        - { table: Acme\Bundle\AppBundle\Entity\SomeEntity, alias: o }
                    join:
                        left:
                            joinNameOne:
                                join: o.someEntity
                                alias: someEntity
                            joinNameTwo:
                                join: o.testRel
                                alias: test
                        inner:
                            innerJoinName:
                                join: o.abcTestRel
                                alias: abc

            columns:
                label:
                    type: field

                someColumn:
                    type: fixed
                    value_key: someAlias

                otherColumn:
                    disabled: true

            ....

            sorters:
                toolbar_sorting: true #optional, shows additional sorting control in toolbar
                columns:
                    label:  # column name for view layer
                        data_name: o.label   # property in result set (column name or alias), if main entity has alias
                                             # like in this example it will be added automatically
                        type: string #optional, affects labels in toolbar sorting
                    someColumn:
                        data_name: someAlias
                        apply_callback: callable # if you want to apply some operations instead of just adding ORDER BY
                    otherColumn:
                        disabled: true|false # allows to disable sorting for the column if it is defined somewhere
                default:
                    label: DESC # sorters enabled by default, key is a column name

                multiple_sorting: true|false # is multisorting mode enabled ? False by default

                disable_default_sorting: true|false # When set to true, no default sorting will be applied

                disable_not_selected_option: true|false(default) # If enabled (true) it will hide `not_selected`
                    (Please select) option from sorting dropdown.
                    Consider enabling it will work only if there is `default` sorting option available and
                    `disable_default_sorting` is not true.
                    In other words `not_selected` will always appear in select dropdown (even if
                    disable_not_selected_option set to true) in such cases:
                    1. If a customer already selected 'not_selected' option earlier.
                    2. If the 'default' option is empty or not defined
                    3. If the 'disable_default_sorting' option is set to true
            


.. note::
     * Customization can be done using the `apply_callback` options.
     * Column name should be equal to the name of the corresponding column.
     * You must disable the sorter if it is defined but the column is disabled
