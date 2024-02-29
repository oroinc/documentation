.. _dev-translation:

Content and User Interface Translation
======================================

There are three ways to translate content displayed in the Oro applications to a user. You can use:

* `Standard Symfony Translator`_
* `Translatable Doctrine Extension`_
* `LocalizedFallbackValue Entity from OroLocaleBundle`_

This topic explains when to use the three approaches and provides implementation examples.

.. _dev-translation--symfony-translator:

Standard Symfony Translator
---------------------------

.. csv-table::
    :header: "Pros", "Cons"
    :widths: 15,15

    "Does not require additional implementation and can be used in Symfony framework out-of-the-box.", "Cannot be applied to translate dynamic content in the application."

The application you are developing is highly likely to contain some static content that is independent of any dynamic
application data, is always displayed in the same place, and never changes. Examples of such content are labels of field
forms, static text in the interface, flash messages, etc. Keep in mind that this translation approach is used only for static
content that does not impact any entity (entity field values).

To translate labels, use the Translation component, one of the main Symfony framework components.

Oro application adds the translation functionality on top of Symfony's standard approach, which enables modification of
translations via UI.

To use this approach, add translations to |Symfony Translation Files|, e.g., `Resources/translations/messages.en.yml`:

.. code-block:: yaml

    oro:
       translation:
           some_field:
               label: Localized value

Use the Symfony translator to translate a label in the ``twig`` template:

.. code-block:: twig

    {{ 'oro.translation.some_field.label'|trans }}

or in the ``php`` code:

.. code-block:: php

    namespace Acme\Bundle\DemoBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Contracts\Translation\TranslatorInterface;

    class ExampleController extends AbstractController
    {
        private TranslatorInterface $translator;

        /**
         * @param TranslatorInterface $translator
         * @return void
         */
        public function __construct(TranslatorInterface $translator)
        {
            $this->translator = $translator;
        }

        /**
         * @return array
         */
        public function viewAction(): array
        {
            return [
                'label' => $this->translator->trans('oro.translation.some_field.label')
            ];
        }
    }

More information on how to use it is available in |Symfony Documentation (Translations)|.

Translatable Doctrine Extension
-------------------------------

.. csv-table::
    :header: "Pros", "Cons"
    :widths: 15,15

    " * Dynamic content in the application can be easily translated.
     * The translatable fields have a value related to the actual language of the application.", "
     * The user must switch the current language to the required language in the system configuration to fill the fields with the required values.
     * Translatable fields can have values only for some languages but not for `Localizations`."


Dynamic content is another type of content used in Oro applications. What is displayed in the UI is based on data loaded
from fixtures into the database and entered by users in the UI. As a rule, this data is based on dictionaries used in
certain entities.

Examples of such data are the Country and Region fields used in the Address entity. The application has
dictionaries for each of these entities with all available translations for all translatable fields of these entities
(into all available languages).
For instance, these fields must consider the language selected for the interface when users must be
able to filter and sort data by Country and Region in a grid with addresses. In this case, use
|Gedmo/Translatable|.
Such fields are displayed in the UI in the selected language. All requests to the database will change for the
translations grid to retrieve data based on the current locale.

Below is an example of an entity that must work with ``Gedmo/Translatable`` for the ``name`` field of this entity.

.. code-block:: php

    namespace Acme\Bundle\DemoBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use Gedmo\Mapping\Annotation as Gedmo;
    use Gedmo\Translatable\Translatable;

    #[ORM\Entity]
    #[ORM\Table('acme_demo_country')]
    #[Gedmo\TranslationEntity(class: 'Acme\Bundle\DemoBundle\Entity\CountryTranslation')]
    class Country implements Translatable
    {
        /**
         * @var string
         */
        #[ORM\Column(name: 'name', type: 'string', length: 255)]
        #[Gedmo\Translatable]
        protected string $name;

        /**
         * @var string
         */
        #[Gedmo\Locale]
        protected string $locale;

        /**
         * @param string $name
         * @return void
         */
        public function setName(string $name): void
        {
            $this->name = $name;
        }

        /**
         * @return string
         */
        public function getName(): string
        {
            return $this->name;
        }

        /**
         * @param string $locale
         * @return void
         */
        public function setLocale(string $locale): void
        {
            $this->locale = $locale;
        }

        /**
         * @return string
         */
        public function getLocale(): string
        {
            return $this->locale;
        }
    }

Also, ``Gedmo/Translatable`` requires a dictionary with all translations for the original entity fields:


.. code-block:: php

    namespace Acme\Bundle\DemoBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use Gedmo\Translatable\Entity\MappedSuperclass\AbstractTranslation;

    #[ORM\Entity]
    #[ORM\Table(name: 'oro_acme_country_trans')]
    class CountryTranslation extends AbstractTranslation
    {
        /**
         * @var string
         */
        #[ORM\Column(type: 'string', length: 255)]
        protected $content;
    }


For the grid to have working translations for entities with ``Gedmo`` fields, add the ``HINT_TRANSLATABLE`` hint
in `Resources/config/oro/datagrids.yml` configuration file:

.. code-block:: php

    datagrids:
       acme-country-grid:
           source:
               type: orm
               query:
                   ...
               hints:
                   - HINT_TRANSLATABLE

Below is a simple example of a grid configuration that uses the hint:

.. code-block:: php

    datagrids:
       acme-country-grid:
           source:
               type: orm
               query:
                   select:
                       - country.id
                       - country.name
                   from:
                       - { table: Acme\Bundle\DemoBundle\Entity\Country, alias: country }
               hints:
                   - HINT_TRANSLATABLE

           columns:
               name:
                   label: Country Name

           sorters:
               columns:
                   name:
                       data_name: country.name

           filters:
               columns:
                   name:
                       type: string
                       data_name: country.name


In this case, the values in the name field are displayed in the required language, and filtering and sorting for the values happen in the selected language.

.. _localizedfallbackvalue-entity-from-orolocalebundle:

LocalizedFallbackValue Entity from OroLocaleBundle
--------------------------------------------------

.. csv-table::
    :header: "Pros", "Cons"
    :widths: 15,15

    " * The translatable fields can be translated for each `Localization` available in the application.
     * It is easy to provide values for the `Localizations` in the entity form without changing the actual UI language.", "
     * Translated values cannot be used in the datagrids for filtering and sorting out-of-the-box.
     * Additional implementation is required to render translated values for the actual `Localization`."

UI language is incorporated into the localization entity. You can have several localizations in the application with the
same interface language. However, data for various localizations may differ.
In addition, if the current localization is assigned a parent localization, then in cases when a field value does not
exist, it is taken from the parent. This allows for setting up a flexible translation tree via the UI.

To implement this approach, use the :ref:`LocalizedFallbackValue <bundle-docs-platform-locale-bundle-localization>`.

To use ``LocalizedFallbackValue`` for fields in the entity, make it extendable:

.. code-block:: php

    namespace Acme\Bundle\DemoBundle\Entity;

    use Doctrine\Common\Collections\Collection;
    use Doctrine\ORM\Mapping as ORM;
    use Oro\Bundle\EntityExtendBundle\Entity\ExtendEntityInterface;
    use Oro\Bundle\EntityExtendBundle\Entity\ExtendEntityTrait;
    use Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue;

    #[ORM\Entity]
    #[ORM\Table(name: 'acme_demo_some')]
    class Some implements ExtendEntityInterface
    {
        use ExtendEntityTrait;

        /**
         * @var Collection|LocalizedFallbackValue[]
         */
        #[ORM\ManyToMany(
            targetEntity: 'Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue',
            cascade: ['ALL'],
            orphanRemoval: true
        )]
        #[ORM\JoinTable(name: 'acme_demo_some_name')]
        #[ORM\JoinColumn(
            name: 'some_id',
            referencedColumnName: 'id',
            onDelete: 'CASCADE'
        )]
        #[ORM\inverseJoinColumn(
            name: 'localized_value_id',
            referencedColumnName: 'id',
            unique: true,
            onDelete: 'CASCADE'
        )]
        protected $names;
    }


Enable ``Oro\Bundle\LocaleBundle\DependencyInjection\Compiler\EntityFallbackFieldsStoragePass`` for the entity and the field
inside the bundle class:


.. code-block:: php

    namespace Acme\Bundle\DemoBundle;

    use Oro\Bundle\LocaleBundle\DependencyInjection\Compiler\EntityFallbackFieldsStoragePass;
    use Symfony\Component\DependencyInjection\ContainerBuilder;
    use Symfony\Component\HttpKernel\Bundle\Bundle;

    class AcmeDemoBundle extends Bundle
    {
        /**
         * @inheritDoc
         */
        public function build(ContainerBuilder $container): void
        {
            parent::build($container);

            $container->addCompilerPass(new EntityFallbackFieldsStoragePass([
                'Acme\Bundle\DemoBundle\Entity\Some' => [
                    'name' => 'names'
                ]
            ]));
        }
    }

To be able to provide translations in the UI, use the following example of the form type:


.. code-block:: php

    namespace Acme\Bundle\DemoBundle\Form\Type;

    use Oro\Bundle\LocaleBundle\Form\Type\LocalizedFallbackValueCollectionType;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;

    class SomeType extends AbstractType
    {
        /**
         * @inheritDoc
         */
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder->add(
                'names',
                LocalizedFallbackValueCollectionType::class,
                ['label' => 'acme_demo.some.names.label']
            );
        }
    }

To retrieve a name for the ``Localization``, it is enough to use the ``getName()`` method.

**More Sources on Translations**

*Business User Documentation*

* :ref:`Localization and Translation Concept Guide <concept-guide--localization-translation>`
* :ref:`System Localizations and Translations <sys--config--sysconfig--general-setup--localization>`

    * :ref:`Languages <localization--languages>`
    * :ref:`Translations <localization--translations>`
    * :ref:`Localizations <localization--localizations>`

*Media Library*

* |How to Set up Localization, Translation, and Language|

*SlideShare Translation and Localization Slides*

* |Data Localization and Translation (Slideshare)|


.. include:: /include/include-links-dev.rst
    :start-after: begin
