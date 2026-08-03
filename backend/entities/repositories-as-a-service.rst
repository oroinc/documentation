.. _dev-entities-repositories:

Entity Repositories as a Services
=================================

EntityBundle and Doctrine let you define entity repositories as Symfony DI container services. You can then use them as regular services --- for example, inject them into other services or inject additional services into repositories.

Definition
----------

To define an entity repository as a service, declare the service (with or without an appropriate repository class), use ``oro_entity.abstract_repository`` as the parent, and pass the entity class name as an argument. For this to work, the repository class must have the default constructor signature ``public function __construct($em, Mapping\ClassMetadata $class)``.

Here is an example of a repository service definition:

.. code-block:: yaml

    services:
        Oro\Bundle\ProductBundle\Entity\Repository\ProductRepository:
            parent: oro_entity.abstract_repository
            arguments:
                - 'Oro\Bundle\ProductBundle\Entity\Product'
            tags:
                - { name: doctrine.repository_service }


This defines a repository for the ``Oro\Bundle\ProductBundle\Entity\Product`` entity. There are several ways to get it. You can fetch it as a regular service from the container:

.. code-block:: php

   $productRepository = $this->container->get(ProductRepository::class);

Alternatively, you can get it via ManagerRegistry or DoctrineHelper:

.. code-block:: php

    $productRepository = $this->container->get('doctrine')
        ->getManagerForClass('Oro\Bundle\ProductBundle\Entity\Product')
        ->getRepository('Oro\Bundle\ProductBundle\Entity\Product');

    $productRepository = $this->container->get('oro_entity.doctrine_helper')
        ->getEntityRepository('Oro\Bundle\ProductBundle\Entity\Product');

All these calls return the same entity repository instance, created via the Symfony DI container.

Decoration
----------

Extending repositories is a common customization task. For example, after you install a new package, a repository may need to apply additional conditions, such as filtering. The best practice here is to decorate the repository service.

Here is an example of what repository decoration can look like:

.. code-block:: yaml

    services:
        Oro\Bundle\ProductBundle\Entity\Repository\NewProductRepository:
            parent: oro_entity.abstract_repository
            decorates: Oro\Bundle\ProductBundle\Entity\Repository\ProductRepository
            decoration_inner_name: oro_product.repository.product.original
            arguments:
                - 'Oro\Bundle\ProductBundle\Entity\Product'
            calls:
                - ['setDecoratedRepository', ['@oro_product.repository.product.original']]

Here, the ``Oro\Bundle\ProductBundle\Entity\Repository\NewProductRepository`` service decorates the ``Oro\Bundle\ProductBundle\Entity\Repository\ProductRepository`` service, and the original repository is injected into the decorator via the `setDecoratedRepository` method. Now, whenever the application requests the original repository (as the ``Oro\Bundle\ProductBundle\Entity\Repository\ProductRepository`` service or by the ``Oro\Bundle\ProductBundle\Entity\Product`` entity class name), it receives the decorator instead of the original repository.