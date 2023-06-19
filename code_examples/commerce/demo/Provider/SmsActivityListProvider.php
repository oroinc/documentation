<?php

namespace Acme\Bundle\DemoBundle\Provider;

use Acme\Bundle\DemoBundle\Entity\Sms;
use Oro\Bundle\ActivityBundle\Tools\ActivityAssociationHelper;
use Oro\Bundle\ActivityListBundle\Entity\ActivityList;
use Oro\Bundle\ActivityListBundle\Entity\ActivityOwner;
use Oro\Bundle\ActivityListBundle\Model\ActivityListDateProviderInterface;
use Oro\Bundle\ActivityListBundle\Model\ActivityListProviderInterface;
use Oro\Bundle\CommentBundle\Model\CommentProviderInterface;
use Oro\Bundle\CommentBundle\Tools\CommentAssociationHelper;
use Oro\Bundle\EntityBundle\ORM\DoctrineHelper;
use Oro\Component\DependencyInjection\ServiceLink;

/**
 * Provides a way to use Sms entity in an activity list.
 */
class SmsActivityListProvider implements
    ActivityListProviderInterface,
    CommentProviderInterface,
    ActivityListDateProviderInterface
{
    /** @var DoctrineHelper */
    protected $doctrineHelper;

    /** @var ServiceLink */
    protected $entityOwnerAccessorLink;

    /** @var ActivityAssociationHelper */
    protected $activityAssociationHelper;

    /** @var CommentAssociationHelper */
    protected $commentAssociationHelper;

    public function __construct(
        DoctrineHelper $doctrineHelper,
        ServiceLink $entityOwnerAccessorLink,
        ActivityAssociationHelper $activityAssociationHelper,
        CommentAssociationHelper $commentAssociationHelper
    ) {
        $this->doctrineHelper            = $doctrineHelper;
        $this->entityOwnerAccessorLink   = $entityOwnerAccessorLink;
        $this->activityAssociationHelper = $activityAssociationHelper;
        $this->commentAssociationHelper  = $commentAssociationHelper;
    }

    /**
     * {@inheritdoc}
     */
    public function isApplicableTarget($entityClass, $accessible = true)
    {
        return $this->activityAssociationHelper->isActivityAssociationEnabled(
            $entityClass,
            Sms::class,
            $accessible
        );
    }

    /**
     * {@inheritdoc}
     * @param Sms $entity
     */
    public function getSubject($entity)
    {
        return substr(trim($entity->getMessage()), 0, 20);
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription($entity)
    {
        return null;
    }

    /**
     * {@inheritdoc}
     * @param Sms $entity
     */
    public function getOwner($entity)
    {
        return $entity->getOwner();
    }

    /**
     * {@inheritdoc}
     * @param Sms $entity
     */
    public function getCreatedAt($entity)
    {
        return $entity->getCreatedAt();
    }

    /**
     * {@inheritdoc}
     * @param Sms $entity
     */
    public function getUpdatedAt($entity)
    {
        return $entity->getUpdatedAt();
    }

    /**
     * {@inheritdoc}
     */
    public function getData(ActivityList $activityList)
    {
        /** @var SMS $sms */
        $sms =  $this->doctrineHelper
            ->getEntityManager($activityList->getRelatedActivityClass())
            ->getRepository($activityList->getRelatedActivityClass())
            ->find($activityList->getRelatedActivityId());

        return [
            'fromContact' => $sms->getFromContact(),
            'toContact' => $sms->getToContact()
        ];
    }

    /**
     * {@inheritdoc}
     * @param Sms $entity
     */
    public function getOrganization($entity)
    {
        return $entity->getOrganization();
    }

    /**
     * {@inheritdoc}
     */
    public function getTemplate()
    {
        return '@AcmeDemo/Sms/js/activityItemTemplate.html.twig';
    }

    /**
     * {@inheritdoc}
     */
    public function getRoutes($entity)
    {
        return [
            'itemView'   => 'acme_demo_sms_widget_info',
            'itemEdit'   => 'acme_demo_sms_update',
            'itemDelete' => 'acme_demo_api_delete_sms'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getActivityId($entity)
    {
        return $this->doctrineHelper->getSingleEntityIdentifier($entity);
    }

    /**
     * {@inheritdoc}
     */
    public function isApplicable($entity)
    {
        if (\is_object($entity)) {
            return $entity instanceof Sms;
        }

        return $entity === Sms::class;
    }

    /**
     * {@inheritdoc}
     * @param Sms $entity
     */
    public function getTargetEntities($entity)
    {
        return $entity->getActivityTargets();
    }

    /**
     * {@inheritdoc}
     */
    public function isCommentsEnabled($entityClass)
    {
        return $this->commentAssociationHelper->isCommentAssociationEnabled($entityClass);
    }

    /**
     * {@inheritdoc}
     * @param Sms $entity
     */
    public function getActivityOwners($entity, ActivityList $activityList)
    {
        $organization = $this->getOrganization($entity);
        $owner = $this->entityOwnerAccessorLink->getService()->getOwner($entity);

        if (!$organization || !$owner) {
            return [];
        }

        $activityOwner = new ActivityOwner();
        $activityOwner->setActivity($activityList);
        $activityOwner->setOrganization($organization);
        $activityOwner->setUser($owner);

        return [$activityOwner];
    }

    /**
     * {@inheritDoc}
     */
    public function isActivityListApplicable(ActivityList $activityList): bool
    {
        return true;
    }
}
