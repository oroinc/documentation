.. _dev-entities-dictionaries:

Dictionaries
============

Dictionary entities are responsible for storing a predefined set of values of a certain type and their translations. They values within a dictionary can have a priority or some other data.

Automatic Creation of REST API for Dictionaries
-----------------------------------------------

REST API resources for viewing dictionary values are created automatically and they are accessible by the following URL: ``/api/{dictionary_plural_alias}``. For example ``/api/casestatuses``.

Please refer to :ref:`entity aliases <entity-aliases>` topic to get a better understanding how the aliases are generated.

**Dictionary types supported out-of-the-box**

REST API resources are created automatically for the following types of dictionaries:

- Non-translatable dictionary
- Translatable dictionary (implements ``Gedmo\Translatable\Entity\MappedSuperclass\AbstractTranslation``)
- Personal translatable dictionary (implements ``Gedmo\Translatable\Entity\MappedSuperclass\AbstractPersonalTranslation``)
- Enum (Option set)

**Creating a custom dictionary type**

If you have a group of entities which can be classified as a dictionary, but by some reason they are not included in the ``dictionary`` group in the entity configuration, and you want to have its entities added to the dictionary REST API, you need to do two things.

1. Create a dictionary value list provider implementing the |DictionaryValueListProviderInterface| interface.

2. Register your provider service in the DI container by the following tag: ``oro_entity.dictionary_value_list_provider``:

.. code-block:: yaml

    oro_entity.dictionary_value_list_provider.default:
        class: Oro\Bundle\EntityBundle\Provider\DictionaryValueListProvider
        public: false
        arguments:
            - '@oro_entity_config.config_manager'
            - '@doctrine'
        tags:
            - { name: oro_entity.dictionary_value_list_provider, priority: -100 }

.. note:: Please note that you can specify the priority for the dictionary value list provider. The bigger the priority number is, the earlier the provider will be executed.

If there are more than one dictionary value list providers that support the same type of dictionary, only the one with the greater priority will be executed. The priority value is optional and defaults to 0.

.. include:: /include/include-links-dev.rst
   :start-after: begin
