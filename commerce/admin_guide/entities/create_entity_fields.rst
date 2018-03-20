.. _doc-entity-fields:
.. _admin-guide-create-entity-fields:
.. _doc-entity-fields-create:

Create Entity Fields
====================


Fields are used to store details of entity records. For example, a 'street name', a 'zip code', and a 'building number' may be fields of an 'address.' You can add new fields to any :term:`custom entity <Custom Entity>` or an extendable :term:`system entity <System Entity>`.

This topic describes how you can create custom entity fields, explains what basic and advanced entity field properties are available for them, and illustrates :ref:`examples <admin-guide-create-entity-fields-example>` of adding new fields to existing entities.

 .. note:: See a short demo on `how to create a custom field <https://www.orocrm.com/media-library/create-custom-field>`_, or keep reading the step-by-step guidance below.

   .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/DwXQG9dcB0k" frameborder="0" allowfullscreen></iframe>   

To create a custom entity field:

1. Navigate **System > Entities > Entities Management** in the main menu.
2. On the **All Entities** page, click the required entity to open its page. 
3. On the entity page, click **Create Field**  on the top right. 
4. Provide the :ref:`basic entity field properties <admin-guide-create-entity-fields-basic>`, such as the name, the field and field storage types.
5. Click **Continue**.
6. Provide :ref:`advanced field properties <admin-guide-create-entity-fields-advanced>`, some of which can be field-type-related.
7. Click **Save and Close** when you finish creating the new entity field.
8. Once the field is saved, :ref:`update the schema <admin-guide-update-schema>`, if the storage type for the field is set to **Table Column**. 


.. include:: /user_guide/include_images.rst
   :start-after: begin

**Related Topics**

* :ref:`Manage Entity Fields <admin-guide-manage-entity-fields>`
* :ref:`Examples of Creating Custom Entity Fields <admin-guide-create-entity-fields-example>`

.. toctree::
   :hidden:
   :maxdepth: 1
      
   entity_fields_basic_properties
   entity_fields_advanced_properties
   entity_field_type_related_properties
   create_entity_field_example
