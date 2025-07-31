<?php

namespace Acme\Bundle\DemoBundle\Controller;

use Acme\Bundle\DemoBundle\Entity\Favorite;
use Oro\Bundle\EntityBundle\ORM\DoctrineHelper;
use Oro\Bundle\SecurityBundle\Attribute\Acl;
use Oro\Bundle\SecurityBundle\Attribute\AclAncestor;
use Oro\Bundle\SecurityBundle\Attribute\CsrfProtection;
use Oro\Bundle\SecurityBundle\ORM\Walker\AclHelper;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Acl\Voter\FieldVote;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Contains CRUD actions for Favorite
 */
#[Route(path: '/favorite', name: 'acme_demo_favorite_')]
class FavoriteController extends AbstractController
{
    #[Route(path: '/', name: 'index')]
    #[Template]
    #[AclAncestor('acme_demo_favorite_index')]
    public function indexAction(): array
    {
        return ['entity_class' => Favorite::class];
    }

    #[Route(path: '/custom', name: 'custom')]
    #[CsrfProtection]
    #[Template('@AcmeDemo/Favorite/index.html.twig')]
    #[Acl(
        id: 'acme_demo_favorite_custom',
        type: 'entity',
        class: 'Acme\Bundle\DemoBundle\Entity\Favorite',
        permission: 'VIEW'
    )]
    public function customAction(): array
    {
        return ['entity_class' => Favorite::class];
    }

    #[Route(path: '/new-edit', name: 'new_edit')]
    #[Template('@AcmeDemo/Favorite/index.html.twig')]
    #[AclAncestor('acme_demo_favorite_new_edit')]
    public function newEditAction()
    {
        $entity = $this->getUser();
        if (!$this->isGranted('VIEW', $entity)) {
            throw new AccessDeniedException();
        }
        // check access to the given entity field
        $authorizationChecker = $this->container->get('security.authorization_checker');
        if (!$authorizationChecker->isGranted('VIEW', new FieldVote($entity, '_field_name_'))) {
            throw new AccessDeniedException('Access denied');
        }

        return ['entity_class' => Favorite::class];
    }

    #[Route(path: '/protected', name: 'protected')]
    #[CsrfProtection]
    #[Template('@AcmeDemo/Favorite/index.html.twig')]
    #[Acl(id: 'acme_demo_favorite_protected_action', type: 'action')]
    public function protectedAction()
    {
        $repository = $this->container->get(DoctrineHelper::class)
            ->getEntityManager(Favorite::class)
            ->getRepository(Favorite::class);
        $queryBuilder = $repository
            ->createQueryBuilder('f')
            ->where('f.viewCount > :viewCount')
            ->orderBy('f.viewCount', 'ASC')
            ->setParameter('viewCount', 6);
        $aclHelper = $this->container->get(AclHelper::class);
        $query = $aclHelper->apply($queryBuilder, 'VIEW');

        return [
            'data' => $query->getResult()
        ];
    }

    #[\Override]
    public static function getSubscribedServices(): array
    {
        return array_merge(
            parent::getSubscribedServices(),
            [AclHelper::class, DoctrineHelper::class]
        );
    }
}
