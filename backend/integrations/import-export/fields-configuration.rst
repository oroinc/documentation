.. _dev-integrations-imports-export-fields:

Fields Configuration
====================

Header
------

This option is used to configure a custom column header. A field label is used by default.

.. code-block:: php
   :linenos:

    use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;

    /**
     * @var string
     *
     * @ConfigField(
     *      defaultValues={
     *          "importexport"={
     *              "header"="Custom field"
     *          }
     *      }
     * )
     */
    protected $field;

Order
-----

This option is used to configure a custom column order.

.. code-block:: php
    :linenos:

    use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;

    /**
     * @var string
     *
     * @ConfigField(
     *      defaultValues={
     *          "importexport"={
     *              "order"=100
     *          }
     *      }
     * )
     */
    protected $field;

Identity
--------

The fields with this option are used to identify (search) the entity. It is possible to use multiple identity fields for one entity.

.. code-block:: php
    :linenos:

    use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;

    /**
     * @var string
     *
     * @ConfigField(
     *      defaultValues={
     *          "importexport"={
     *              "identity"=true
     *          }
     *      }
     * )
     */
    protected $field;

Excluded
--------

The fields with this option cannot be exported.

.. code-block:: php
    :linenos:

    use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;

    /**
     * @var string
     *
     * @ConfigField(
     *      defaultValues={
     *          "importexport"={
     *              "excluded"=true
     *          }
     *      }
     * )
     */
    protected $field;


Full
----

All the fields of the related entity are exported. The fields with the [Excluded](#excluded) option are skipped.
If **full** is set to *false* (the default value), only the fields with an identity will be exported. 

.. code-block:: php
    :linenos:

    use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;

    /**
     * @var string
     *
     * @ConfigField(
     *      defaultValues={
     *          "importexport"={
     *              "full"=true
     *          }
     *      }
     * )
     */
    protected $field;


