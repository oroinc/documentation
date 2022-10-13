.. _dev-entities-structure-data-provider:

Entity Structure Data Provider
==============================

Namespace: ``Oro\Bundle\EntityBundle\Provider\EntityStructureDataProvider``

It provides data of all configurable entities. Collects the following data (see ``Oro\Bundle\EntityBundle\Model\EntityStructure``):

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

This data can be returned by API.

This data can be extended or modified using an event (see :ref:`Entity Structure Options Event <dev-entities-events>`).

