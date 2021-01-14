<?php

namespace Oro\Bundle\BlogPostExampleBundle\Form\Extension;

use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;
use Oro\Bundle\BlogPostExampleBundle\Entity\ProductOptions;
use Oro\Bundle\BlogPostExampleBundle\Form\Type\ProductOptionsType;
use Oro\Bundle\ProductBundle\Entity\Product;
use Oro\Bundle\ProductBundle\Form\Type\ProductType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

/**
 * Form type extension that adds product options field to "product create/update" form
 * and persist the value to the database
 */
class ProductOptionsFormTypeExtension extends AbstractTypeExtension
{
    const PRODUCT_OPTIONS_FIELD_NAME = 'productOptions';

    /** @var ManagerRegistry */
    protected $registry;

    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return ProductType::class;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            self::PRODUCT_OPTIONS_FIELD_NAME,
            ProductOptionsType::class,
            [
                'label' => 'oro.blogpostexample.product_options.entity_label',
                'required' => false,
                'mapped' => false,
            ]
        );

        $builder->addEventListener(FormEvents::POST_SET_DATA, [$this, 'onPostSetData']);
        $builder->addEventListener(FormEvents::POST_SUBMIT, [$this, 'onPostSubmit'], 10);
    }

    /**
     * @param FormEvent $event
     */
    public function onPostSetData(FormEvent $event)
    {
        /** @var Product|null $product */
        $product = $event->getData();
        if (!$product || !$product->getId()) {
            return;
        }

        $options = $this->getProductOptionsRepository()
            ->findOneBy(['product' => $product]);

        $event->getForm()->get(self::PRODUCT_OPTIONS_FIELD_NAME)->setData($options);
    }

    /**
     * @param FormEvent $event
     */
    public function onPostSubmit(FormEvent $event)
    {
        /** @var Product|null $product */
        $product = $event->getData();
        if (!$product) {
            return;
        }

        /** @var ProductOptionsType $form */
        $form = $event->getForm();

        /** @var ProductOptions $options */
        $options = $form->get(self::PRODUCT_OPTIONS_FIELD_NAME)->getData();
        $options->setProduct($product);

        if (!$form->isValid()) {
            return;
        }

        $this->getProductOptionsEntityManager()->persist($options);
    }

    /**
     * @return ObjectManager
     */
    protected function getProductOptionsEntityManager()
    {
        return $this->registry->getManagerForClass(ProductOptions::class);
    }

    /**
     * @return ObjectRepository
     */
    protected function getProductOptionsRepository()
    {
        return $this->getProductOptionsEntityManager()
            ->getRepository(ProductOptions::class);
    }
}
