Frequently Asked Questions (FAQs)
=================================

This section is aimed to provide answers to common questions and help Oro developers find the right solution for the recurring issues they face when customizing the Oro application.

.. contents:: :local:
    :depth: 1

How to fix the UI label of a column?
--------------------------------------

Q: How to fix the UI label of the column that was added to an entity in a migration script. It shows the Oro.Sales.Lead.<myColumnName>.Label instead of myColumnName.

A: The labels for the extended entity’s fields are translatable strings with predefined translation keys (oro.sales.lead.<myColumnName>.label). You need to create the Resources/translations/messages.en.yml file in your bundle and provide a proper translation for this key to display the desired UI label name. For example, *Collector* instead of *Oro.Sales.Lead.Collector.Label*:

.. code-block:: bash
    :linenos:

    oro:
        sales:
            lead:
                collector:
                    label: Collector


After that, perform the following console command:

.. code-block:: bash
    :linenos:

    php app/console oro:translation:load --rebuild-cache --timeout=900

The oro.sales.lead.collector.label string acquires the translation provided and is now displayed as Collector.

To update the translation, navigate to **System > Localization > Translations** in the management console of your Oro application.

For more detailed information on how to translate the UI system elements and content to the target language, refer to the related :ref:`System Localization and Translations <sys--config--sysconfig--general-setup--localization>` documentation.


How to change a form type (selection, checkbox, etc) for the values in a column?
--------------------------------------------------------------------------------

Q: How to change a form type (selection, checkbox, etc) for the values in a column that was added to an entity in a migration script?

A: The form type for a field can be changed in the **oro_options** array of a particular migration file. Here is an example of a migration script with a checkbox value provided for the form type field:

.. code-block:: bash
    :linenos:

    class AddCollectorToLead implements Migration
    {
        public function up(Schema $schema, QueryBag $queries)
        {
            $table = $schema->getTable('orocrm_sales_lead');
            $table->addColumn(
                'collector',
                'boolean',
                [
                    'oro_options' => [
                        'extend'    => ['is_extend' => true, 'owner' => ExtendScope::OWNER_CUSTOM],
                        'datagrid'  => ['is_visible' => false],
                        'form' => [
                            'is_enabled' => true,
                            'form_type' => 'checkbox',
                            'form_options' => [
                                'tooltip' => 'some tooltip'
                            ]
                        ],
                    ],
                ]
            );
        }
    }


