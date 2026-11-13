.. _bundle-docs-platform-entity-bundle-search-api-processor:

EntitySelectSearchApiAccessor ⇐ SearchApiAccessor
=================================================

Provides access to entity_select search API.

**Extends:** :ref:`SearchApiAccessor <bundle-docs-platform-ui-bundle-search-api-accessor>`.

.. csv-table::
   :header: "Param","Type", "Description"
   :widths: 20, 20, 20

   "options","`Object`","-"
   "options.entity_name","`string`","The entity name to search in"
   "options.field_name","`string`","The field to search by and to show in UI"

The ``entity_select`` search API searches only the entity fields that are declared for it. The target field of an extended many-to-one relation is declared automatically. Declare any other field in the ``entity_select_targets`` section of the ``Resources/config/oro/entity.yml`` file of your bundle.

To declare the ``name`` field of the ``Repository`` entity for a datagrid column that is edited inline with this accessor, add the following configuration:

.. code-block:: yaml
   :caption: Acme/Bundle/DemoBundle/Resources/config/oro/entity.yml

    oro_entity:
        entity_select_targets:
            Acme\Bundle\DemoBundle\Entity\Repository: [name]

The search API applies the following restrictions to a declared field:

* The field must be a ``string`` or ``text`` field.
* A field hidden in the ``exclusions`` section of the ``entity.yml`` file is not searched.

A request for any other field fails with the HTTP 400 status code.
