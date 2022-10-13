.. _dev-entities-repositories:

Entity Repositories as a Services
=================================

EntityBundle and Doctrine provide the possibility to define entity repositories as Symfony DI container services. Consequently, the developer can use entity repositories as regular services - e.g., inject them into other services or inject additional services into repositories.

Definition
----------

To define entity repositories as a service, define the service with or without a class of an appropriate repository, use service ``oro_entity.abstract_repository`` as a parent and the pass entity class name as an argument. To work properly, the repository class must have the default constructor signature ``public function __construct($em, Mapping\ClassMetadata $class)``.

Here is an example of a repository service definition:

.. code-block:: yaml

    services:
        Oro\Bundle\ProductBundle\Entity\Repository\ProductRepository:
            parent: oro_entity.abstract_repository
            arguments:
                - 'Oro\Bundle\ProductBundle\Entity\Product'
            tags:
                - { name: doctrine.repository_service }


This is a repository for the ``Oro\Bundle\ProductBundle\Entity\Product`` entity, and there are several ways to get this repository. You can get it just as a regular service from the container:

.. code-block:: php

   $productRepository = $this->container->get(ProductRepository::class);

Alternatively, you can get it via ManagerRegistry or DoctrineHelper:

.. code-block:: php

    $productRepository = $this->container->get('doctrine')
        ->getManagerForClass('Oro\Bundle\ProductBundle\Entity\Product')
        ->getRepository('Oro\Bundle\ProductBundle\Entity\Product');

    $productRepository = $this->container->get('oro_entity.doctrine_helper')
        ->getEntityRepository('Oro\Bundle\ProductBundle\Entity\Product');

All these calls will return the same instance of the entity repository created via the Symfony DI container.

Decoration
----------

Extension of repositories is a typical case for application customization. For example, after a new package is installed, the repository has to consider additional conditions, such as filtering. The best practice for this case is using the repository service decoration.

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

Here, repository service ``Oro\Bundle\ProductBundle\Entity\Repository\ProductRepository`` is decorated with repository service ``Oro\Bundle\ProductBundle\Entity\Repository\NewProductRepository``, and the original repository is injected into a decorator via the `setDecoratedRepository` method. Now every time application requests the original repository (as a service ``Oro\Bundle\ProductBundle\Entity\Repository\ProductRepository`` or by entity class name ``Oro\Bundle\ProductBundle\Entity\Product``), an instance of repository decorator will be returned instead of the original repository.