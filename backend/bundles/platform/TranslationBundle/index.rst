.. _bundle-docs-platform-translation-bundle:

OroTranslationBundle
====================

OroTranslationBundle enables a translation framework in the Oro applications and an integration with third-party translation services. Out-of-the-box, it provides integration with CrowdIn.

The bundle enables developers to define translation strings in the YAML configuration files and provides the translation management UI for users to manage languages and translations strings, synchronize translations between the Oro application and third-party services.

Translation Context Resolver
----------------------------

Translation context resolver should be used to humanize translation keys and give some additional info to developers and translators.

Classes Description
^^^^^^^^^^^^^^^^^^^

* **TranslationBundle\Extension\TranslationContextResolverInterface** - extensions interface for resolving Translation Context by translation key.

Configuration
~~~~~~~~~~~~~

The context resolver must implement ``oro\Bundle\TranslationBundle\Extension\TranslationContextResolverInterface``, for example:

.. code-block:: php

    namespace Oro\Bundle\TranslationBundle\Extension;

    use Symfony\Contracts\Translation\TranslatorInterface;

    /**
     * Default context resolver
     */
    class TranslationContextResolver implements TranslationContextResolverInterface
    {
        protected TranslatorInterface $translator;

        public function __construct(TranslatorInterface $translator)
        {
            $this->translator = $translator;
        }

        /**
         * {@inheritdoc}
         */
        public function resolve($id)
        {
            /**
             * Do something with key, for example parse key and based on parsed data prepare context string
             */
            return $this->translator->trans('oro.translation.context.ui_label');
        }
    }


Context resolver should be registered with tag `oro_translation.extension.translation_context_resolver`, for example:

.. code-block:: yaml

    # default context resolver definition
    oro_translation.extension.translation_context_resolver:
        class: Oro\Bundle\TranslationBundle\Extension\TranslationContextResolver
        arguments:
            - '@translator'
        tags:
            - { name: oro_translation.extension.translation_context_resolver, priority: -100 }

Form Types
----------

Translation bundle provide form types for easier translation on frontend.

Form Types Description
^^^^^^^^^^^^^^^^^^^^^^

* **translatable\_entity**

  This form type works exactly as regular |entity form type|, but it supports translatable entities and performs translation using one DB request.

  Options:

  * **class** - entity class name, this option is required;
  * **property** - class property that should be used as label, by default string representation of entity will be used;
  * **query\_builder** - custom query builder or callback to extract entities.

* **oro\_select2\_translatable\_entity**

  This form type is extended from translatable\_entity and renders using Select2 JS widget with autocomplete.

Classes Description
^^^^^^^^^^^^^^^^^^^

* **TranslationBundle \ Form \ Type \ TranslatableEntityType** - class for translatable\_entity form type, provides functionality to work with translatable entities;

* **TranslationBundle \ Form \ DataTransformer \ CollectionToArrayTransformer** - extends standard Doctrine transformer to support empty array as data source.

Configuration
^^^^^^^^^^^^^

.. code-block:: yaml

    services:
        Oro\Bundle\TranslationBundle\Form\Type\TranslatableEntityType:
            arguments: ["@doctrine"]
            tags:
                - { name: form.type, alias: translatable_entity }

        oro_form.type.jqueryselect2_translatable_entity:
            parent: oro_form.type.select2
            arguments: ["translatable_entity"]
            tags:
                - { name: form.type, alias: oro_select2_translatable_entity }

Translation Strategies
----------------------

Translation bundle provides mechanism of translation strategies to handle translation fallbacks.
Each strategy provides locale fallback tree that describes which locales must be used as fallback locale
for each source fallback. Here is example of such tree:

.. code-block:: twig

    [
        'en' => [
            'en_US' => [
                'en_CA' => [],
                'en_MX' => [],
             ],
            'en_CA' => [],
            'en_GB  => [],
            ...
        ],
        ...
    ]

Current strategy can be extracted from strategy provider - this class is used to store selected strategy and
perform some additional manipulations with it. Translator uses strategy provider and current strategy to handle
translation fallbacks.


Classes Description
^^^^^^^^^^^^^^^^^^^

* ``TranslationBundle\Strategy\TranslationStrategyInterface``

  Main interface for translation strategies.

  Methods:

  * **getName** - returns text identifier of the strategy;
  * **getLocaleFallbacks** - returns tree of locale fallbacks.


* ``TranslationBundle\Strategy\DefaultTranslationStrategy``

  Implementation of TranslationStrategyInterface to handle default one-locale translation fallback.

* ``TranslationBundle\Strategy\TranslationStrategyProvider``

  The main purpose of this class is storing of current translation strategy and performing additional manipulations with it.

  Methods:

  * **getStrategy** - returns current strategy;
  * **setStrategy** - sets specified strategy as current;
  * **getFallbackLocales** - returns list of allowed fallback locales for specified strategy and source locale;
  * **getAllFallbackLocales** - returns list of all fallback locales for specified strategy.

Dependency Injection Tags
-------------------------

* **oro_translation.extension.translation_strategy** - Registers strategy for providing translation locale fallbacks. Strategy must implement |TranslationStrategyInterface|.

**Related Documentation**

* :ref:`Translate Content in Oro Applications <dev-translation>`

.. include:: /include/include-links-dev.rst
   :start-after: begin

