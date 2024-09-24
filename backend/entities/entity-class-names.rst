.. _dev-entities-entity-class-name-provider:

Entity Class Name Provider
==========================

This service aims to provide human-readable representation in **English** of an entity class name. OroPlatform uses this provider to generate a description of REST API resources that are generated on the fly. See |DictionaryEntityApiDocHandler| for details.

**Interface of an entity class name provider**

The |entity class name provider| service is a "chain" service. It works by asking a set of prioritized providers to get a human-readable representation of an entity class name. Each child service must implement |EntityClassNameProviderInterface|. This interface declares the following methods:

- *getEntityClassName* - returns a human-readable representation for an entity class.
- *getEntityClassPluralName* - returns a human-readable representation in plural for an entity class.

**Create custom entity class name provider**

To create own provider just create a class implementing |EntityClassNameProviderInterface| and register it in DI container with the tag **oro_entity.class_name_provider**. You can also use the existing |abstract provider| as a superclass for your provider.

.. oro_integrity_check:: 2028ed4062ecd0e7c92ca7dbf0e9c5e4fcf0e886

   .. literalinclude:: /code_examples/commerce/demo/Provider/AcmeClassNameProvider.php
       :caption: src/Acme/Bundle/DemoBundle/Provider/AcmeClassNameProvider.php
       :language: php
       :lines: 3-31

.. oro_integrity_check:: 8895434b9b4194d7764a669ac25399169c151b75

   .. literalinclude:: /code_examples/commerce/demo/Resources/config/services.yml
       :caption: src/Acme/Bundle/DemoBundle/Resources/config/services.yml
       :language: yaml
       :lines: 2, 97-104

You can specify the priority to move the provider up or down the provider's chain. The bigger the priority number is, the earlier the provider will be executed. The priority value is optional and defaults to 0.

.. include:: /include/include-links-dev.rst
   :start-after: begin
