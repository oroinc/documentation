.. _dev-entities-fallback:

Entity Fallback Values
======================

You can set up an entity field to fall back to a different entity's field value.
To set up such a field, add it to the entity as a property (or create a migration for adding it), and add a @ConfigField annotation and Doctrine association to |EntityFieldFallbackValue| (or array configuration in migration) like the following configuration:

.. code-block:: php

    /**
     * @var EntityFieldFallbackValue
     *
     * @ORM\OneToOne(targetEntity="Oro\Bundle\EntityBundle\Entity\EntityFieldFallbackValue", cascade={"All"})
     * @ORM\JoinColumn(name="some_field_name_fallback_id", referencedColumnName="id", onDelete="SET NULL")
     * @ConfigField(
     *     defaultValues={
     *          "fallback": {
     *              "fallbackList": {
     *                  "someFallbackId" : {
     *                      "fieldName": "someFieldName"
     *                  },
     *                  "systemConfig": {
     *                      "configName": "oro_entity.some_configuration_name"
     *                  }
     *              }
     *          }
     *     }
     * )
     */
    protected $someFieldName;

An example of adding a field by migration:

.. code-block:: php

    $someTable = $schema->getTable('oro_some_table');
    $fallbackTable = $schema->getTable('oro_entity_fallback_value');
    $this->extendExtension->addManyToOneRelation(
        $schema,
        $someTable,
        'someFieldName',
        $fallbackTable,
        'id',
        [
            'extend' => [
                'owner' => ExtendScope::OWNER_CUSTOM,
                'cascade' => ['all'],
            ],
            'form' => [
                'is_enabled' => false,
            ],
            'view' => [
                'is_displayable' => false,
            ],
            'datagrid' => [
                'is_visible' => DatagridScope::IS_VISIBLE_FALSE,
            ],
            'fallback' => [
                'fallbackList' => [
                    'someFallbackId' => ['fieldName' => 'someFieldName'],
                    'systemConfig' => ['configName' => 'oro_entity.some_configuration_name'],
                ],
            ],
        ]
    );

The `fallbackType` specifies the field value type - it is only mandatory if there is no defined system configuration fallback (which should have the `data_type` in the form definition in `system_configuration.yml`:

.. code-block:: yaml

    system_configuration:
        (...)
        fields:
            oro_entity.some_configuration_name:
                data_type: boolean
                type: choice

You can find possible values for the `fallbackType` in |EntityFallbackResolver|::$allowedTypes.

The `fallbackList` contains a list of possible fallback entities. The **systemConfig** fallback is a predefined ID for falling
back to a system configuration |ConfigValue| value, for which the ``configName`` fallback configuration is mandatory (which refers to the form type name defined in ``system_configuration.yml``). There is a predefined fallback provider for ``systemConfig`` in |SystemConfigFallbackProvider|.

If a field configured as a fallback field has a null value (no EntityFieldFallbackValue set at all), the resolver would try to automatically read the fallback value from the defined `fallbackList`, in the order of definition. In the example above, first, try the
`someFallbackId`, then the `systemConfig` fallback.

To fallback to a new entity field, you need to create a new fallback provider, extending |AbstractEntityFallbackProvider|, with a service definition in ``Resources/config/fallbacks.yml`` like:

.. code-block:: yaml

    oro_entity.fallback.provider.system_config_provider:
        class: Oro\Bundle\EntityBundle\Fallback\Provider\SystemConfigFallbackProvider
        parent: oro_entity.fallback.provider.abstract_provider
        arguments:
            - "@oro_config.manager"
        tags:
            - { name: oro_entity.fallback_provider, id: systemConfig }

Extend the parent ``oro_entity.fallback.provider.abstract_provider`` service, inject some dependencies, and tag it with
`oro_entity.fallback_provider` as tag name, and `systemConfig` as id (this id will go into the @ConfigField `fallbackList` configuration as fallback name.
The provider will then need to implement `getFallbackHolderEntity`, which defines how to access the parent fallback entity, `getFallbackLabel`, which is used for translating the fallback name,
and optionally, the function `isFallbackSupported`, which can add some conditions on whether the fallback should appear as an option on the UI for a specific instance.

Next, render the field in the main object's class type by embedding the |EntityFieldFallbackValueType| in the main form type:

.. code-block:: php

    $builder->add('someFieldName', EntityFieldFallbackValueType::class);

This type defines three fields: `scalarValue` (which will hold the entity's own value if no fallback is wanted), `useFallback` (checkbox for the UI to select/deselect fallback possibility) and `fallback` (which by default will render a dropdown with the fallback list and which will map to the fallback field of |EntityFieldFallbackValue| holding the fallback ID (like `systemConfig`).
The options and types of those three fields can be overridden with `value_options`, `fallback_options`, `use_fallback_options`, `value_type` and `fallback_type`. Internally, the submitted own value will be saved in `scalarValue`, if it is scalar, or `arrayValue`, if it's an array.

Examples
--------

**An example of a fallback widget**

.. image:: /img/backend/entities/fallback_example.png
   :alt: Example of fallback widget

**EntityFieldFallbackValue table content**

.. image:: /img/backend/entities/fallback_table.png
   :alt: Fallback table content

If the `fallback` column contains a value, it means the entity uses the fallback value. If it is null and the `scalar_value` or `array_value` column contains data, it means that the entity has its own value

The bundle also exposes a twig function to get the fallback compatible value of a field, which internally uses the |EntityFallbackResolver|.

.. code-block:: twig

  {{ oro_entity_fallback_value(entity, 'someFieldName') }}

.. include:: /include/include-links-dev.rst
   :start-after: begin