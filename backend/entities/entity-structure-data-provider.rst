.. _dev-entities-structure-data-provider:

Entity Structure Data Provider
==============================

Namespace: ``Oro\Bundle\EntityBundle\Provider\EntityStructureDataProvider``

This provider supplies data for all configurable entities. It collects the following (see ``Oro\Bundle\EntityBundle\Model\EntityStructure``):

- Entity aliases
- Entity labels (translated)
- Entity fields (see ``Oro\Bundle\EntityBundle\Model\EntityFieldStructure``)
- Entity options (for example, `auditable`)
- Entity routes.

For every field, the following information is provided:

- name
- type
- label (translated)
- type of relation (`oneToMany`, `manyToMany` and so on)
- options (for example ``[configurable: true, auditable: false]``).

The API can return this data.

You can extend or modify this data through an event (see :ref:`Entity Structure Options Event <dev-entities-events>`).

