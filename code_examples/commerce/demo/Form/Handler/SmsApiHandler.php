<?php

namespace Acme\Bundle\DemoBundle\Form\Handler;

use Acme\Bundle\DemoBundle\Entity\Sms;
use Acme\Bundle\DemoBundle\Form\Type\SmsApiType;
use Doctrine\Persistence\ObjectManager;
use Oro\Bundle\FormBundle\Form\Handler\RequestHandlerTrait;
use Oro\Bundle\SoapBundle\Controller\Api\FormAwareInterface;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 *  This API handler is the implementation of REST API.
 */
class SmsApiHandler implements FormAwareInterface
{
    use RequestHandlerTrait;

    /**
     * @var FormFactory
     */
    protected $formFactory;

    /**
     * @var RequestStack
     */
    protected $requestStack;

    /**
     * @var ObjectManager
     */
    protected $manager;

    public function __construct(FormFactory $formFactory, RequestStack $requestStack, ObjectManager $manager)
    {
        $this->formFactory = $formFactory;
        $this->requestStack = $requestStack;
        $this->manager = $manager;
    }

    /**
     * Process form
     *
     * @param  Sms $entity
     * @return bool True on successful processing, false otherwise
     */
    public function process(Sms $entity)
    {
        $form = $this->getForm();
        $form->setData($entity);

        $request = $this->requestStack->getCurrentRequest();

        if (\in_array($request->getMethod(), ['POST', 'PUT'], true)) {
            $this->submitPostPutRequest($form, $request);
            if ($form->isValid()) {
                $this->onSuccess($entity);

                return true;
            }
        }

        return false;
    }

    #[\Override]
    public function getForm()
    {
        return $this->formFactory->createNamed('', SmsApiType::class);
    }

    /**
     * "Success" form handler
     */
    protected function onSuccess(Sms $entity)
    {
        $this->manager->persist($entity);
        $this->manager->flush();
    }
}
