.. _dev-integrations-integrations-settings:

Additional Serializable Fields
==============================

Integration entity contains two additional serializable fields that allow developers to store platform specific
settings there. Those fields are **synchronization settings** and **mapping settings**. They could be retrieved using
getters `getSynchronizationSettings()` and `getMappingSettings()` respectively.

.. note:: doctrine2 will not update object type fields if values were changed by reference, due to this getters return **cloned** objects.

In order to allow putting configuration fields into integration creation form the `integrations.yml` config file type was added.
The root node should be `integrations` and the form configuration should be placed under the `form` node.

**Example**

.. code-block:: yaml
   :linenos:

    integrations:
        form:
            synchronization_settings: # form name (now synchronization_settings and mapping_settings are available)
                isTwoWaySyncEnabled:  # field name
                    type: checkbox    # form field type
                    options:          # form options
                        label:    oro.integration.integration.is_two_way_sync_enabled.label
                        required: false
                    applicable: [some_integration_type]  # on which integration types this setting should be shown

This configuration will be resolved by `SystemAwareResolver` so any node can contain DI service calls or constants.
For example, if you want to bring dynamic behavior to the `applicable` node you can put service call there, `$channelType$`will be in the resolver context. In this case, string `applicable: @some.service->methodOfService($channelType$)` will invoke function `methodOfService` in the class registered in the DI as `some.service`.
