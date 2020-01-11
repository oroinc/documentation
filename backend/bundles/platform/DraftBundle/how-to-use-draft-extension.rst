.. _draft-bundle--use-draft-extension:

How to Use a Draft Extension
============================

An extension is a service that enables you to modify entity data when creating a draft entity.
The extension is responsible for filters and matchers load. If the entity does not fit the extension criteria, it ignores the execution and does not change the entity.

How to Create an Extension
--------------------------

To create an extension, you must create a class, extend it from ``AbstractDuplicatorExtension``, and register it as a service.
Add the ``oro_draft.duplicator.extension`` tag to your extension configuration.

Extension
^^^^^^^^^

To simplify the implementation, you can use the default ``DuplicatorExtension`` extension and register it in the configuration.

Example:

.. code-block:: php
   :linenos:

    oro_draft.duplicator_extension.localization_extension:
        class: Oro\Bundle\DraftBundle\Duplicator\Extension\DuplicatorExtension
        arguments:
            - !service
                class: DeepCopy\Matcher\PropertyTypeMatcher
                arguments: ['Oro\Bundle\LocaleBundle\Entity\Localization']
            - !service
                class: DeepCopy\Filter\KeepFilter
        tags:
            - { name: oro_draft.duplicator.extension, priority: 0 }

.. note::
    Keep your extension priorities in mind. If two extensions have one area of ​​responsibility, then the higher priority extension will apply. All other extensions will be ignored.

**context** - use context parameter to control the expansion workflow. In the process, you will find *actions* that use the extension only at the draft creation stage and do not use it during the draft publication.

Default actions:

1. DraftManager::ACTION_CREATE_DRAFT.
2. DraftManager::ACTION_PUBLISH_DRAFT.

The example below illustrates the way to use context. We only update the draft entity creation date. The draft entity publication date remains unchanged.

.. code-block:: php
   :linenos:

   <?php

   namespace Oro\Bundle\DraftBundle\Duplicator\Extension;

   use DeepCopy\Filter\Filter;
   use DeepCopy\Matcher\Matcher;
   use DeepCopy\Matcher\PropertyTypeMatcher;
   use Oro\Bundle\DraftBundle\Duplicator\Filter\DateTimeFilter;
   use Oro\Bundle\DraftBundle\Entity\DraftableInterface;
   use Oro\Bundle\DraftBundle\Manager\DraftManager;

   /**
    * Responsible for copying behavior of DateTime type parameters.
    */
   class DateTimeExtension extends AbstractDuplicatorExtension
   {
       /**
        * @return Filter
        */
       public function getFilter(): Filter
       {
           return new DateTimeFilter();
       }

       /**
        * @return Matcher
        */
       public function getMatcher(): Matcher
       {
           return new PropertyTypeMatcher(\DateTime::class);
       }

       /**
        * @inheritDoc
        */
       public function isSupport(DraftableInterface $source): bool
       {
           return $this->getContext()->offsetGet('action') === DraftManager::ACTION_CREATE_DRAFT;
       }
   }

Filter
^^^^^^

The filter is responsible for the entity data modification.

The example below illustrates the way to create and use the filter. This filter uses dependency to update the owner of a draft entity.

.. code-block:: php
   :linenos:

   <?php

   namespace Oro\Bundle\DraftBundle\Duplicator\Filter;

   use Oro\Bundle\DraftBundle\Entity\DraftableInterface;
   use Oro\Component\Duplicator\Filter\Filter;
   use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

   /**
    * Responsible for updating  draft owner field.
    */
   class OwnerFilter implements Filter
   {
       /**
        * @var TokenStorageInterface
        */
       private $tokenStorage;

       /**
        * OwnerFilter constructor.
        *
        * @param TokenStorageInterface $tokenStorage
        */
       public function __construct(TokenStorageInterface $tokenStorage)
       {
           $this->tokenStorage = $tokenStorage;
       }

       /**
        * @param DraftableInterface $object
        * @param string $property
        * @param callable $objectCopier
        */
       public function apply($object, $property, $objectCopier): void
       {
           $user = $this->tokenStorage->getToken()->getUser();
           $object->setDraftOwner($user);
       }
   }

Matcher
^^^^^^^

Matcher indicates the criteria that the filter is following to work successfully.

As an example, consider a matcher that takes properties names. This enables you to use one filter for multiple properties.

.. code-block:: php
   :linenos:

   <?php

   namespace Oro\Bundle\DraftBundle\Duplicator\Matcher;

   use DeepCopy\Matcher\Matcher;

   /**
    * Determines whether a filter can be applied to the specified properties
    */
   class PropertiesNameMatcher implements Matcher
   {
       /**
        * @var string[]
        */
       private $properties;

       /**
        * @param string[] $properties
        */
       public function __construct(array $properties = [])
       {
           $this->properties = $properties;
       }

       /**
        * @inheritDoc
        */
       public function matches($object, $property): bool
       {
           return in_array($property, $this->properties);
       }
   }
