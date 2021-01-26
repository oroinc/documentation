.. _dev-entities-events:

Events
======

All events are available in the ``Oro\Bundle\EntityBundle\Event`` namespace.

Entity Structure Options Event
------------------------------

Class name: ``EntityStructureOptionsEvent`` (``oro_entity.structure.options``)

This event occurs when 
the ``Oro\Bundle\EntityBundle\Provider\EntityStructureDataProvider`` has filled in or updated the data of Entities
structure. So any listener can fill in or modify needed options in this data.
