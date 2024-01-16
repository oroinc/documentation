<?php

namespace Acme\Bundle\DemoBundle\Controller\Api\Rest;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Oro\Bundle\SecurityBundle\Annotation\Acl;
use Oro\Bundle\SoapBundle\Controller\Api\FormAwareInterface;
use Oro\Bundle\SoapBundle\Controller\Api\Rest\RestController;
use Oro\Bundle\SoapBundle\Entity\Manager\ApiEntityManager;
use Symfony\Component\HttpFoundation\Response;

/**
 * REST API controller for Sms entity.
 */
class SmsController extends RestController
{
    /**
     * REST DELETE
     *
     * @param int $id
     *
     * @ApiDoc(
     *      description="Delete sms",
     *      resource=true
     * )
     * @Acl(
     *      id="acme_demo_sms_delete",
     *      type="entity",
     *      permission="DELETE",
     *      class="Acme\Bundle\DemoBundle\Entity\Sms"
     * )
     * @return Response
     */
    public function deleteAction(int $id)
    {
        return $this->handleDeleteRequest($id);
    }

    /**
     * Get entity Manager
     *
     * @return ApiEntityManager
     */
    public function getManager()
    {
        return $this->container->get('acme_demo_sms.manager.api');
    }

    /**
     * @return FormAwareInterface
     */
    public function getFormHandler()
    {
        return $this->container->get('acme_demo_sms.form.handler.sms_api');
    }
}
