.. _bundle-docs-extensions-smart-brief:

OroSmartBriefBundle
===================

OroSmartBriefBundle adds :ref:`AI Smart Brief <concept-guide--ai--smart-brief>` to the back-office customer and request for quote (RFQ) view pages. The block shows a short AI-written paragraph with a list of key facts about the record next to it.

Fact providers compute the facts from OroCommerce data. The AI provider only turns these facts into a paragraph. The bundle reuses the OpenAI and Vertex AI integrations of :ref:`OroAiContentGenerationBundle <bundle-docs-extensions-ai-content-generation>` but has its own AI client. Both bundles are included in the ``oro/gen-ai`` package.

Configuration
-------------

To enable the feature, select the AI integration, and configure the cache, see :ref:`Configure Global AI Smart Brief Settings <admin-configuration-smart-brief-settings>` and :ref:`Configure AI Smart Brief Settings per Organization <organization-smart-brief-settings>`.

The bundle uses the following system configuration options:

.. csv-table::
   :header: "Option","Default","Scopes","Description"
   :widths: 25, 10, 15, 30

   "``oro_smart_brief.enabled``","``false``","global, organization","Enables the ``oro_smart_brief`` feature."
   "``oro_smart_brief.integration``","``null``","global, organization","The ID of the OpenAI or Vertex AI integration that writes the summaries."
   "``oro_smart_brief.customer_enabled``","``false``","global, organization","Shows the summary on customer view pages."
   "``oro_smart_brief.rfq_enabled``","``false``","global, organization","Shows the summary on RFQ view pages."
   "``oro_smart_brief.cache_ttl``","``14400``","global","The cache lifetime of a summary, in seconds."
   "``oro_smart_brief.cache_invalidate_on_change``","``true``","global","Writes a summary again when its facts change (**Refresh on Data Change**)."
   "``oro_smart_brief.regenerate_enabled``","``false``","global, organization","Shows the **Regenerate** button in the block. The button requests a new summary from the AI provider without using the cache."
   "``oro_smart_brief.expanded``","``true``","global, organization, user","Opens the block expanded. When a user expands or collapses the block, the browser keeps that state for the record until the facts of the record change."

The organization scope is available only in the Enterprise edition. The user scope of ``oro_smart_brief.expanded`` is in the **Display Settings** of the user configuration.

Technical Components
--------------------

The bundle consists of the following main components:

* ``oro_smart_brief`` --- The placeholder item rendered in the ``page_title_after`` placeholder of the ``@OroUI/actions/view.html.twig`` template. It loads the block content from the ``oro_smart_brief_widget`` route after the page has loaded.
* ``Oro\Bundle\SmartBriefBundle\Generator\SummaryGenerator`` (service ``oro_smart_brief.generator``) --- The entry point that turns a record into a summary. It resolves the fact provider, reads and writes the cache, calls the AI client, and returns the facts only when the AI client fails.
* ``Oro\Bundle\SmartBriefBundle\Provider\SummaryFactProviderInterface`` --- The interface of the fact providers. The built-in providers are ``oro_smart_brief.fact_provider.customer`` and ``oro_smart_brief.fact_provider.rfq``.
* ``Oro\Bundle\SmartBriefBundle\ValueType\FactValueTypeInterface`` --- The interface of the fact value types that format, normalize, and restore fact values.
* ``Oro\Bundle\SmartBriefBundle\Prompt\SummaryRequestBuilder`` --- Builds the AI request from the prompt translations and the facts.
* ``oro_smart_brief.cache`` --- The cache pool for summaries and the Vertex AI access token. It is based on ``oro.data.cache``.
* ``Oro\Bundle\SmartBriefBundle\EventListener\Datagrid\SmartBriefFilterBuilderListener`` --- Adds the ``orosmartbrief/js/datagrid/smart-brief-filter-builder`` grid builder to the grids that the key facts link to. The builder applies the filter of a link to the grid on the current page without a page reload.

Links Next to the Key Facts
^^^^^^^^^^^^^^^^^^^^^^^^^^^

A line of the **Key facts** list can link to the records behind it, for example, the open RFQs of the customer. The link filters the grid of these records to them, scrolls to the grid, and highlights it.

The fact providers keep the identifiers of these records in the fact set with ``FactSet::setRecords()``, for example, the RFQ IDs, the quote numbers, or the order numbers. A fact keeps at most ``FactSet::RECORD_LIMIT`` (20) identifiers. With more records, the providers keep none, and the link shows the whole grid. The identifiers are stored in the summary cache with the facts, but they are not sent to the AI provider and do not change the cache key.

When the grid is on the current page, the block filters it in place, as the grid filters do. Otherwise, the link opens the page that contains the grid, with the filter in the grid state of the URL. The last contact links to the email, call, or conversation itself.

The ``Oro\Bundle\SmartBriefBundle\Provider\KeyFactsProvider`` service (``oro_smart_brief.provider.key_facts``) builds the **Key facts** list from lines. Each line has a lead fact, without which the line is not shown, optional detail facts that follow the lead value, an icon, and an optional link: a grid of a page filtered to the records of the lead fact, a section of the page, or the record behind the lead fact. A fact that no line shows is listed on its own, without a link. The RFQ price ranges are never shown: they are sent only to the AI provider. The datagrid builder is added to every grid that a link filters.

.. _bundle-docs-extensions-smart-brief--cache:

Clear the Summary Cache
-----------------------

Existing summaries are not written again when a prompt, the AI integration, or a permission changes. They are used until the cache lifetime expires. To remove all cached summaries at once, run the following command in the application root directory:

.. code-block:: bash

   php bin/console cache:pool:clear oro_smart_brief.cache

The next view of each record requests a new summary from the AI provider. The command also removes the cached Vertex AI access token.

.. _bundle-docs-extensions-smart-brief--logging:

Log the Generation Metrics
--------------------------

Each attempt to generate a summary writes one ``oro_smart_brief.generation`` entry at the ``info`` level to the ``oro_smart_brief`` log channel. You can use these entries to monitor the quality, cost, and use of AI Smart Brief. Warnings about a missing AI paragraph and errors that hide the block are written to the same channel.

The entry contains the following fields:

* ``entity_type`` --- The record type, ``customer`` or ``rfq``.
* ``channel_type`` --- The AI integration type, ``open_ai`` or ``vertex_ai``. The field is empty when no AI call was made, for example, when a cached summary is used.
* ``model`` --- The AI model that wrote the summary, when an AI call succeeded.
* ``cache`` --- ``hit`` when a cached summary was used, ``miss`` when a new summary was requested, and ``none`` when the cache was not checked.
* ``refresh_on_change`` --- Whether the **Refresh on Data Change** option was enabled.
* ``latency_ms`` --- The time spent on the attempt, in milliseconds.
* ``input_tokens`` and ``output_tokens`` --- The number of tokens used by the AI call. These fields appear only when the AI provider reports them.
* ``outcome`` --- The result of the attempt: ``ok``, ``fallback``, ``no_activity``, or ``hidden``. The ``no_activity`` outcome means that the record has nothing to summarize, so the block shows a note without calling the AI provider.
* ``fallback_reason`` and ``http_status`` --- For the ``fallback`` outcome, why the AI paragraph is missing and the HTTP status of the provider response, if any.
* ``hidden_reason`` --- For the ``hidden`` outcome, why the block is not shown.

The ``fallback_reason`` field has one of the following values:

* ``client_error`` --- The AI provider returned an error, or the AI client could not be created.
* ``timeout`` --- The AI provider did not respond in time.
* ``rate_limited`` --- The AI provider rejected the request because of its rate limits.
* ``truncated`` --- The AI answer was cut off because it reached the maximum length.

The ``hidden_reason`` field has one of the following values:

* ``switch_off`` --- The summary for this record type is disabled.
* ``error`` --- An unexpected error occurred.
* ``feature_off`` and ``no_provider`` --- The feature is disabled, or the record type is not supported. The back-office block does not produce these values, because it does not request a summary in these cases. Custom code that calls the ``oro_smart_brief.generator`` service directly can produce them.

The entry contains no fact values, prompts, or AI text.

The bundle adds the ``oro_smart_brief`` log handler, which writes the ``oro_smart_brief`` channel from the ``info`` level to the ``var/logs/smart_brief_<environment>.log`` file, for example, ``var/logs/smart_brief_prod.log``. Each request of the block writes one metrics entry to this file. The entries are also passed to the handlers of the application, so errors are still written to the main log.

To stop writing the file, set the type of the ``oro_smart_brief`` handler to ``'null'`` in the ``config/config_prod.yml`` file of the application.

For more information about log handlers, see :ref:`Logging <dev-guide-system-logging>`.

Extension Points
----------------

You can extend AI Smart Brief from your own bundle without changing OroSmartBriefBundle.

.. important:: Every fact that you add is sent to the external AI provider. A fact must be a typed value that your code computes on purpose. Do not add names, email addresses, or phone numbers of people, postal addresses, message subjects or bodies, or free-text fields, such as notes, PO numbers, or comments. List the data of every fact that you add for your data protection review, in addition to the :ref:`data sent to the AI provider <concept-guide--ai--smart-brief--data>` by the built-in facts.

Each fact provider must also follow these rules:

* Check class-level VIEW permission for each entity class that a fact is based on. Use the ``oro_smart_brief.provider.summary_access`` service (``SummaryAccessProvider::canView()``). If the user cannot view the class, do not emit the facts based on it.
* Apply the ACL to each query, for example, with ``Oro\Bundle\SecurityBundle\ORM\Walker\AclHelper::apply()``, so that the facts describe only the records that the user can view.
* Skip a fact when its data is missing. Do not emit placeholder values.
* Prefix the keys of your facts, for example, with ``acme_``, to avoid conflicts with built-in keys. A ``FactSet`` does not accept two facts with the same key.

Add a Fact to an Existing Record Type
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To add a fact to the customer or RFQ summary, decorate the ``oro_smart_brief.fact_provider.customer`` or ``oro_smart_brief.fact_provider.rfq`` service. The decorator calls the inner provider and adds its own facts.

The following decorator adds the number of open support tickets of a customer. ``Acme\Bundle\SupportBundle\Provider\OpenTicketCounter`` is a project service that counts the tickets with the ACL applied:

.. code-block:: php

   namespace Acme\Bundle\SupportBundle\SmartBrief;

   use Acme\Bundle\SupportBundle\Entity\Ticket;
   use Acme\Bundle\SupportBundle\Provider\OpenTicketCounter;
   use Oro\Bundle\SmartBriefBundle\Model\Fact;
   use Oro\Bundle\SmartBriefBundle\Model\FactSet;
   use Oro\Bundle\SmartBriefBundle\Model\FactValueType;
   use Oro\Bundle\SmartBriefBundle\Provider\SummaryAccessProvider;
   use Oro\Bundle\SmartBriefBundle\Provider\SummaryFactProviderInterface;

   class CustomerSummaryFactProvider implements SummaryFactProviderInterface
   {
       public const string OPEN_TICKET_COUNT = 'acme_open_ticket_count';

       public function __construct(
           private readonly SummaryFactProviderInterface $innerProvider,
           private readonly SummaryAccessProvider $accessProvider,
           private readonly OpenTicketCounter $openTicketCounter
       ) {
       }

       public function supportsClass(string $entityClass): bool
       {
           return $this->innerProvider->supportsClass($entityClass);
       }

       public function getEntityType(): string
       {
           return $this->innerProvider->getEntityType();
       }

       public function getEnabledConfigKey(): string
       {
           return $this->innerProvider->getEnabledConfigKey();
       }

       public function getFacts(object $entity): FactSet
       {
           $facts = $this->innerProvider->getFacts($entity);
           if ($this->accessProvider->canView(Ticket::class)) {
               $count = $this->openTicketCounter->countOpenTickets($entity);
               $facts->add(new Fact(self::OPEN_TICKET_COUNT, FactValueType::INTEGER, $count));
           }

           return $facts;
       }
   }

Register the decorator in the ``Resources/config/services.yml`` file of your bundle:

.. code-block:: yaml

   services:
       acme_support.smart_brief.fact_provider.customer:
           class: Acme\Bundle\SupportBundle\SmartBrief\CustomerSummaryFactProvider
           decorates: oro_smart_brief.fact_provider.customer
           arguments:
               - '@.inner'
               - '@oro_smart_brief.provider.summary_access'
               - '@acme_support.provider.open_ticket_counter'

The decorator takes over the ``oro_smart_brief.fact_provider`` tag of the decorated service, so do not tag it again.

Add the label of the fact to the ``Resources/translations/messages.en.yml`` file of your bundle. The label key is ``oro_smart_brief.fact.<fact key>.label``:

.. code-block:: yaml

   oro_smart_brief:
       fact:
           acme_open_ticket_count:
               label: Open support tickets

The fact appears in the prompt and in the **Key facts** list after the facts of the inner provider.

Add a Record Type
^^^^^^^^^^^^^^^^^

To show AI Smart Brief on the view page of another entity, register a service that implements ``SummaryFactProviderInterface`` and has the ``oro_smart_brief.fact_provider`` tag. The placeholder, the route, the generator, and the cache need no changes. The view page must be based on the ``@OroUI/actions/view.html.twig`` template, which renders the ``page_title_after`` placeholder with the ``entity`` variable.

``SummaryFactProviderInterface`` has the following methods:

* ``supportsClass()`` --- Returns ``true`` for the entity class that the provider summarizes. Decide by the class name only, without loading anything.
* ``getEntityType()`` --- Returns a stable lowercase key of the record type. The key selects the ``oro_smart_brief.prompt.<entity type>`` prompt translation.
* ``getEnabledConfigKey()`` --- Returns the full system configuration key of the switch that enables the summary for this record type.
* ``getFacts()`` --- Returns the facts about the entity, limited to the records that the current user can view.

The following provider summarizes a project entity, ``Acme\Bundle\WarrantyBundle\Entity\WarrantyClaim``:

.. code-block:: php

   namespace Acme\Bundle\WarrantyBundle\SmartBrief;

   use Acme\Bundle\WarrantyBundle\Entity\WarrantyClaim;
   use Oro\Bundle\SmartBriefBundle\Model\Fact;
   use Oro\Bundle\SmartBriefBundle\Model\FactSet;
   use Oro\Bundle\SmartBriefBundle\Model\FactValueType;
   use Oro\Bundle\SmartBriefBundle\Provider\CalendarDateProvider;
   use Oro\Bundle\SmartBriefBundle\Provider\SummaryFactProviderInterface;

   class WarrantyClaimSummaryFactProvider implements SummaryFactProviderInterface
   {
       public const string ENTITY_TYPE = 'acme_warranty_claim';
       public const string CLAIMED_ITEM_COUNT = 'acme_claimed_item_count';
       public const string SUBMITTED_DATE = 'acme_claim_submitted_date';

       public function __construct(
           private readonly CalendarDateProvider $calendarDateProvider
       ) {
       }

       public function supportsClass(string $entityClass): bool
       {
           return WarrantyClaim::class === $entityClass;
       }

       public function getEntityType(): string
       {
           return self::ENTITY_TYPE;
       }

       public function getEnabledConfigKey(): string
       {
           return 'acme_warranty.smart_brief_enabled';
       }

       /**
        * @param WarrantyClaim $entity
        */
       public function getFacts(object $entity): FactSet
       {
           $facts = new FactSet();
           $facts->add(new Fact(self::CLAIMED_ITEM_COUNT, FactValueType::INTEGER, $entity->getItems()->count()));
           if (null !== $entity->getSubmittedAt()) {
               $facts->add(new Fact(
                   self::SUBMITTED_DATE,
                   FactValueType::DATE,
                   $this->calendarDateProvider->toDate($entity->getSubmittedAt())
               ));
           }

           return $facts;
       }
   }

A date fact value is a ``Y-m-d`` string. ``CalendarDateProvider::toDate()`` converts a stored date and time to a calendar date in the user's time zone.

The ``Fact`` constructor has an optional fourth argument, ``informative``. Pass ``false`` for a fact, such as a name, that alone does not justify a summary. If a record has no informative facts, the block shows the *There is no recent activity to summarize.* note, and the AI provider is not called.

Register the provider in the ``Resources/config/services.yml`` file of your bundle:

.. code-block:: yaml

   services:
       acme_warranty.smart_brief.fact_provider.warranty_claim:
           class: Acme\Bundle\WarrantyBundle\SmartBrief\WarrantyClaimSummaryFactProvider
           arguments:
               - '@oro_smart_brief.provider.calendar_date'
           tags:
               - { name: oro_smart_brief.fact_provider, priority: 0 }

Declare the switch in the ``DependencyInjection/Configuration.php`` file of your bundle, as described in :ref:`System Configuration <backend-system-configuration>`:

.. code-block:: php

   SettingsBuilder::append($rootNode, [
       'smart_brief_enabled' => ['value' => false, 'type' => 'boolean'],
   ]);

Add the switch to the AI Smart Brief section in the ``Resources/config/oro/system_configuration.yml`` file of your bundle:

.. code-block:: yaml

   system_configuration:
       fields:
           acme_warranty.smart_brief_enabled:
               data_type: boolean
               type: Oro\Bundle\ConfigBundle\Form\Type\ConfigCheckbox
               options:
                   label: acme.warranty.system_configuration.fields.smart_brief_enabled.label

       tree:
           system_configuration:
               platform:
                   children:
                       integrations:
                           children:
                               smart_brief:
                                   children:
                                       smart_brief_settings:
                                           children:
                                               - acme_warranty.smart_brief_enabled

To make the switch available per organization, add the same node to the ``organization_configuration`` tree.

Add the prompt and the fact labels to the ``Resources/translations/messages.en.yml`` file of your bundle:

.. code-block:: yaml

   oro_smart_brief:
       prompt:
           acme_warranty_claim: >-
               Task: summarize this warranty claim for the service representative: the number
               of claimed items and the submission date.
       fact:
           acme_claimed_item_count:
               label: Claimed items
           acme_claim_submitted_date:
               label: Submitted

   acme:
       warranty:
           system_configuration:
               fields:
                   smart_brief_enabled:
                       label: Warranty Claim Summary

The ``oro_smart_brief.prompt.<entity type>`` prompt describes the task only. OroCommerce adds the common rules from the ``oro_smart_brief.prompt.common`` translation in front of it.

To replace a built-in provider, decorate its service, or register a provider for the same class with a higher ``priority`` in the tag. The registry uses the first provider that supports the class, starting with the highest priority.

Add a Value Type
^^^^^^^^^^^^^^^^

A value type formats a fact value for the prompt and the **Key facts** list, and converts the value to a stable form for the cache. The built-in value types are ``date``, ``integer``, ``percent``, ``money``, ``text``, ``enum_option``, and ``choice``. Their names are the constants of ``Oro\Bundle\SmartBriefBundle\Model\FactValueType``. A ``date`` value is a ``Y-m-d`` string, or a range of dates as an ISO 8601 interval, for example, ``2026-09-03/2026-10-27``. A ``percent`` value is a decimal string, for example, ``8.3`` for 8.3 %, or a range from the lowest to the highest value, for example, ``-13.0/8.3``.

To add a value type, register a service that implements ``FactValueTypeInterface``, has the ``oro_smart_brief.fact_value_type`` tag, and returns a unique name from ``getName()``. ``FactValueTypeInterface`` has the following methods:

* ``getName()`` --- Returns the name that facts use in their ``type`` property.
* ``format()`` --- Formats the value of the fact in the current user's language and formatting locale. Call the translator and the Oro formatters without a locale, as they use the user's settings by default. The ``$forDisplay`` argument is ``false`` for the prompt and ``true`` for the **Key facts** list.
* ``canonicalize()`` --- Returns the stable form of a raw value. This form is used in the cache key and in the cached summary.
* ``restore()`` --- Returns the raw value from its stable form when the summary is read from the cache. Formatting the restored value must give the same text as formatting the original value.

The following value type shows a boolean value as *Yes* or *No*:

.. code-block:: php

   namespace Acme\Bundle\WarrantyBundle\SmartBrief;

   use Oro\Bundle\SmartBriefBundle\Model\Fact;
   use Oro\Bundle\SmartBriefBundle\ValueType\FactValueTypeInterface;
   use Symfony\Contracts\Translation\TranslatorInterface;

   class YesNoValueType implements FactValueTypeInterface
   {
       public const string NAME = 'acme_yes_no';

       public function __construct(
           private readonly TranslatorInterface $translator
       ) {
       }

       public function getName(): string
       {
           return self::NAME;
       }

       public function format(Fact $fact, bool $forDisplay = false): string
       {
           return $this->translator->trans(
               $fact->value ? 'acme.warranty.smart_brief.yes' : 'acme.warranty.smart_brief.no'
           );
       }

       public function canonicalize(mixed $value): int
       {
           return $value ? 1 : 0;
       }

       public function restore(string|int|array $canonical): bool
       {
           return (bool)$canonical;
       }
   }

Register the value type in the ``Resources/config/services.yml`` file of your bundle:

.. code-block:: yaml

   services:
       acme_warranty.smart_brief.fact_value_type.yes_no:
           class: Acme\Bundle\WarrantyBundle\SmartBrief\YesNoValueType
           arguments:
               - '@translator'
           tags:
               - { name: oro_smart_brief.fact_value_type }

A fact provider then uses the value type by its name, for example, ``new Fact('acme_claim_approved', YesNoValueType::NAME, true)``.

Two value types with the same name cause an error. To change a built-in value type, decorate its ``oro_smart_brief.fact_value_type.<name>`` service, for example, ``oro_smart_brief.fact_value_type.date``.

Change Prompts and Labels
^^^^^^^^^^^^^^^^^^^^^^^^^

The prompts, fact labels, and block labels are translations. To change them for all installations of your project, override the translation keys in the ``translations`` directory of the application or in a bundle, as described in :ref:`Add Translations to Source Code <dev-translation--add-to-source-code>`. Administrators can also edit them in the back-office, as described in :ref:`Edit the Prompts <concept-guide--ai--smart-brief--prompts>`.

The bundle uses the following translation keys:

* ``oro_smart_brief.prompt.common`` --- The rules for all summaries. The ``%language%`` placeholder is replaced with the English name of the user's language, and ``%facts_open%`` and ``%facts_close%`` with the ``<facts>`` and ``</facts>`` delimiters of the facts block. The delimiters are parameters because the translator strips tag-like text from translated messages.
* ``oro_smart_brief.prompt.<entity type>`` --- The task for a record type, for example, ``oro_smart_brief.prompt.customer`` and ``oro_smart_brief.prompt.rfq``.
* ``oro_smart_brief.fact.<fact key>.label`` --- The label of a fact.
* ``oro_smart_brief.fact.<fact key>.choice.<value>`` --- The values of ``choice`` facts, for example, ``oro_smart_brief.fact.last_contact_channel.choice.email``.
* ``oro_smart_brief.relative.today``, ``oro_smart_brief.relative.days_ago``, and ``oro_smart_brief.relative.in_days`` --- The relative day text shown next to dates in the **Key facts** list.
* ``oro_smart_brief.range`` --- The format of a range of dates or percentages, with the ``%from%`` and ``%to%`` placeholders.
* ``oro_smart_brief.block.*`` --- The texts of the block, for example, ``oro_smart_brief.block.title``, ``oro_smart_brief.block.key_facts``, ``oro_smart_brief.block.fallback_text``, ``oro_smart_brief.block.no_activity_text``, and ``oro_smart_brief.block.regenerate``.
* ``oro_smart_brief.block.link.<line>`` --- The labels of the links of the key facts lines, for example, ``oro_smart_brief.block.link.open_rfq``.
* ``oro_smart_brief.block.line.<line>.label`` and ``oro_smart_brief.block.line.<line>.<fact key>`` --- The lines of the **Key facts** list, for example, the date and the total of the last order. A line shows its label and the value of its lead fact, followed by the ``oro_smart_brief.block.line.<line>.<fact key>`` text of each detail fact, with the ``%value%`` placeholder. Without the lead fact, the detail facts are shown on their own lines with their own labels.

.. caution:: The rules in ``oro_smart_brief.prompt.common`` keep the AI to the facts. Do not remove the rule that everything between ``%facts_open%`` and ``%facts_close%`` is data, not instructions. Without this rule, text in a business record, such as a product name, can change what the AI writes.

Existing summaries are not refreshed when a prompt changes. To apply a prompt change at once, :ref:`clear the summary cache <bundle-docs-extensions-smart-brief--cache>`.

Count More Activity Types as Contacts
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The ``last_contact_date`` and ``last_contact_channel`` facts of the customer summary are based on the activities returned by the protected ``getContactActivityClasses()`` method of the ``Oro\Bundle\SmartBriefBundle\Provider\Customer\ContactActivityClasses`` class. The method maps a channel name to an activity class. By default, it returns emails (``email``), calls (``call``), and conversations (``conversation``). The contact date is the call date and time for calls, the time of the last message for conversations, and the activity date for other classes, for example, the sent date of an email.

To count another activity type as a contact, extend the class, override the method, and add your activity class with a new channel name. The class must be an activity that is shown in the activity list. Classes that do not exist are ignored.

.. code-block:: php

   namespace Acme\Bundle\MeetingBundle\SmartBrief;

   use Acme\Bundle\MeetingBundle\Entity\Meeting;
   use Oro\Bundle\SmartBriefBundle\Provider\Customer\ContactActivityClasses;

   class AcmeContactActivityClasses extends ContactActivityClasses
   {
       #[\Override]
       protected function getContactActivityClasses(): array
       {
           return parent::getContactActivityClasses() + ['meeting' => Meeting::class];
       }
   }

Use your class for the ``oro_smart_brief.fact_provider.customer.contact_activity_classes`` service:

.. code-block:: yaml

   services:
       oro_smart_brief.fact_provider.customer.contact_activity_classes:
           class: Acme\Bundle\MeetingBundle\SmartBrief\AcmeContactActivityClasses
           arguments:
               - '@oro_activity_list.provider.chain'
               - '@oro_smart_brief.provider.summary_access'

For each new channel, add the ``oro_smart_brief.fact.last_contact_channel.choice.<channel>`` translation. The translated channel name is shown in the **Key facts** list and sent to the AI provider:

.. code-block:: yaml

   oro_smart_brief:
       fact:
           last_contact_channel:
               choice:
                   meeting: Meeting

Replace the Text Post-Processor
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Before OroCommerce caches and shows the AI paragraph, the ``oro_smart_brief.generator.text_post_processor`` service tidies it. The default ``Oro\Bundle\SmartBriefBundle\Generator\SummaryTextPostProcessor`` class keeps the ``**bold**`` values that the prompt asks for and removes unpaired bold markers, other Markdown emphasis, and leading list and heading markers. It also collapses whitespace and trims the text. The block shows the text escaped, with only the bold values as markup.

To apply your own rules, decorate or replace this service with a class that implements ``Oro\Bundle\SmartBriefBundle\Generator\SummaryTextPostProcessorInterface``. The ``process()`` method receives the AI text and returns the tidied text. If nothing usable remains, the method must throw ``Oro\Bundle\SmartBriefBundle\Client\SummaryClientException``. In this case, the block shows the facts without the paragraph.

**Related Articles**

* :ref:`AI Smart Brief Concept Guide <concept-guide--ai--smart-brief>`
* :ref:`Configure Global AI Smart Brief Settings <admin-configuration-smart-brief-settings>`
* :ref:`Configure AI Smart Brief Settings per Organization <organization-smart-brief-settings>`

.. include:: /include/include-links-dev.rst
   :start-after: begin
