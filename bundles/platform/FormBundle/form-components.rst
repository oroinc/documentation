Form Components Overview
========================

This article describes all form components that are stored in OroUIBundle.
Form components are form types, data transformers, and event listeners.

Form Types
----------

* **Form / Type / OroDateType** (name = oro_date) - encapsulates date element logic.
* **Form / Type / OroDateTimeType** (name = oro_datetime) - encapsulates datetime element logic,
* **Form / Type / OroIconType** (name = oro_icon_select) - provide icon selector (based on oro_select2_hidden), supports autocomplete.
* **Form / Type / EntityIdentifierType** (name = oro_entity_identifier) - converts string or array of entity IDs to existing entities of specified type.
* **Form / Type / OroJquerySelect2HiddenType** (name = oro_jqueryselect2_hidden) - supports :ref:`autocompletion <bundle-docs-platform-form-bundle-autocomplete>`.
* **Form / Type / OroDurationType** (name = oro_duration) - time duration field type, supports column style #:#:# and JIRA style #h #m #s time encodings.

Data Transformers
-----------------

* **Form / DataTransformer / ArrayToStringTransformer** - converts array to string and back;
* **Form / DataTransformer / EntitiesToIdsTransformer** - converts entity IDs to entities and back.
* **Form / DataTransformer / EntityToIdTransformer** - converts entity ID to entity and back.
* **Form / DataTransformer / DurationToStringTransformer** - converts numeric duration (in seconds) to string and back.

Event Subscribers
-----------------

* **Form / EventListener / FixArrayToStringListener** - converts array to string on form PRE_SUBMIT event.

Configuration
-------------

Form Types
^^^^^^^^^^

.. code-block:: yaml

    services:
        oro_form.type.date:
            class: Oro\Bundle\FormBundle\Form\Type\OroDateType
            tags:
                - { name: form.type, alias: oro_date }

        oro_form.type.datetime:
            class: Oro\Bundle\FormBundle\Form\Type\OroDateTimeType
            tags:
                - { name: form.type, alias: oro_datetime }

        oro_form.type.entity_identifier:
            class: Oro\Bundle\FormBundle\Form\Type\EntityIdentifierType
            tags:
                - { name: form.type, alias: oro_entity_identifier }
            arguments: ["@doctrine"]

        oro_form.type.jqueryselect2_hidden:
            class: Oro\Bundle\FormBundle\Form\Type\OroJquerySelect2HiddenType
            arguments:
                - '@doctrine.orm.entity_manager'
                - '@oro_form.autocomplete.configuration'
            tags:
                - { name: form.type, alias: oro_jqueryselect2_hidden }

        oro_form.type.duration:
            class: Oro\Bundle\FormBundle\Form\Type\OroDurationType
            tags:
                - { name: form.type, alias: oro_duration }
