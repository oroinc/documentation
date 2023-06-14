.. _dev-entities-doctrine-field-types:

Doctrine Field Types
====================

Some entities have fields with data that are money or percentages, so we have added new field types with these values.

The **money** field type allows storing money data. It is an alias for the decimal (19,4) type.

You can use this field type:

.. code-block:: php

    /**
     * @var decimal
     *
     * @ORM\Column(name="tax_amount", type="money")
     */
    protected $taxAmount;

The **percent** field type allows storing percent data. It is an alias to float type.

You can use this field type:

.. code-block:: php

    /**
     * @var float
     *
     * @ORM\Column(name="percent_field", type="percent")
     */
    protected $percentField;

These two data types are available in extended fields. You can create new fields with these types. Additionally, on view and edit pages and in grids, these fields will be automatically formatted with currency or percent formatters.

In the grid, for percent data type, a generated percent filter applies automatically.

The **config_object** type maps and converts ``Oro\Component\Config\Common\ConfigObject`` based on PHP’s JSON encoding functions. Values retrieved from the database are always converted to ``Oro\Component\Config\Common\ConfigObject`` or null if no data is present.

You can use this field type:

.. code-block:: php

    /**
     * @var \Oro\Component\Config\Common\ConfigObject
     *
     * @ORM\Column(name="map_config", type="config_object")
     */
    protected $mapConfigField;

The **duration** field type allows storing time duration in seconds. It is an alias for an integer type.

You can use this field type:

.. code-block:: php

    /**
     * @var int
     *
     * @ORM\Column(name="duration", type="duration")
     */
    protected $duration;


**See Also**

Oro Doctrine Extensions |Oro Doctrine Extensions|

.. include:: /include/include-links-dev.rst
    :start-after: begin
