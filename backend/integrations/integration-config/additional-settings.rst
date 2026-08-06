.. _dev-integrations-integrations-settings:

Additional Serializable Fields
==============================

The Integration entity contains two additional serializable fields where developers can store platform-specific
settings: **synchronization settings** and **mapping settings**. Retrieve them with the getters
``getSynchronizationSettings()`` and ``getMappingSettings()`` respectively.

.. note:: doctrine2 will not update object type fields if values were changed by reference, due to this getters return **cloned** objects.

To let you add configuration fields to the integration creation form, the ``integrations.yml`` config file type was added.
Use ``integrations`` as the root node and place the form configuration under the ``form`` node.

**Example**

.. code-block:: yaml


    integrations:
        form:
            synchronization_settings: # form name (now synchronization_settings and mapping_settings are available)
                isTwoWaySyncEnabled:  # field name
                    type: checkbox    # form field type
                    options:          # form options
                        label:    oro.integration.integration.is_two_way_sync_enabled.label
                        required: false
                    applicable: [some_integration_type]  # on which integration types this setting should be shown

This configuration will be resolved by ``SystemAwareResolver`` so any node can contain DI service calls or constants.
For example, to add dynamic behavior to the ``applicable`` node, put a service call there; ``$channelType$`` is available in the resolver context. The string ``applicable: @some.service->methodOfService($channelType$)`` then invokes the function ``methodOfService`` in the class registered in DI as ``some.service``.
