.. _dev-entities-entity-class-name-provider:

Entity Class Name Provider
==========================

This service provides a human-readable representation in **English** of an entity class name. OroPlatform uses it to describe REST API resources generated on the fly. See |DictionaryEntityApiDocHandler| for details.

**Interface of an entity class name provider**

The |entity class name provider| service is a "chain" service. It asks a set of prioritized providers for a human-readable representation of an entity class name. Each child service must implement |EntityClassNameProviderInterface|, which declares the following methods:

- *getEntityClassName* - returns a human-readable representation for an entity class.
- *getEntityClassPluralName* - returns a human-readable representation in plural for an entity class.

**Create custom entity class name provider**

To create your own provider, create a class implementing |EntityClassNameProviderInterface| and register it in the DI container with the tag **oro_entity.class_name_provider**. You can also use the existing |abstract provider| as a superclass.

.. oro_integrity_check:: f2eec7dccdd2ebc9e97138acec553d4e0172b6fc

   .. literalinclude:: /code_examples/commerce/demo/Provider/AcmeClassNameProvider.php
       :caption: src/Acme/Bundle/DemoBundle/Provider/AcmeClassNameProvider.php
       :language: php
       :lines: 3-35

.. oro_integrity_check:: 8895434b9b4194d7764a669ac25399169c151b75

   .. literalinclude:: /code_examples/commerce/demo/Resources/config/services.yml
       :caption: src/Acme/Bundle/DemoBundle/Resources/config/services.yml
       :language: yaml
       :lines: 2, 97-104

Specify a priority to move the provider up or down the chain. The higher the priority number, the earlier the provider runs. The priority value is optional and defaults to 0.

.. include:: /include/include-links-dev.rst
   :start-after: begin
