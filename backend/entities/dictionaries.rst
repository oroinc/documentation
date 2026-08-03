.. _dev-entities-dictionaries:

Dictionaries
============

Dictionary entities store a predefined set of values of a particular type, along with their translations. Values within a dictionary can also have a priority or other data.

Automatic Creation of REST API for Dictionaries
-----------------------------------------------

REST API resources for viewing dictionary values are created automatically and are accessible by the following URL: ``/api/{dictionary_plural_alias}``. For example ``/api/casestatuses``.

Please refer to :ref:`entity aliases <entity-aliases>` topic to better understand how the aliases are generated.

**Dictionary types supported out-of-the-box**

REST API resources are created automatically for the following types of dictionaries:

- Non-translatable dictionary
- Translatable dictionary (implements ``Gedmo\Translatable\Entity\MappedSuperclass\AbstractTranslation``)
- Personal translatable dictionary (implements ``Gedmo\Translatable\Entity\MappedSuperclass\AbstractPersonalTranslation``)
- Enum (Option set)

**Creating a custom dictionary type**

You may have a group of entities that qualify as a dictionary but are not part of the ``dictionary`` group in the entity configuration. To add their entities to the dictionary REST API, do two things.

1. Create a dictionary value list provider implementing the |DictionaryValueListProviderInterface| interface.

2. Register your provider service in the DI container by the following tag: ``oro_entity.dictionary_value_list_provider``:

.. oro_integrity_check:: 70776a22fa8836f3d19325b2704827a29de3223b

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/services.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/services.yml
        :language: yaml
        :lines: 1-3, 71-78

.. note:: You can specify a priority for the dictionary value list provider. The higher the priority number, the earlier the provider runs.

If more than one dictionary value list provider supports the same type of dictionary, only the one with the greater priority runs. The priority value is optional and defaults to 0.

.. include:: /include/include-links-dev.rst
   :start-after: begin
