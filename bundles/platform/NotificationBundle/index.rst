.. _bundle-docs-platform-notification-bundle:

OroNotificationBundle
=====================

OroNotificationBundle extends the OroEmailBundle capabilities and enables the email notification feature in Oro applications. It provides the UI and CLI tool to send and manage email notifications.

Console Commands
----------------

* ``oro:maintenance-notification`` - Sends an email notification to the application users.

The *oro:maintenance-notification* command sends an email notification to the recipients listed in System Configuration > General Setup > Email Configuration > Maintenance Notifications > Recipients.

If the recipient list in the system configuration is left empty, the notification will be sent to all active application users.

.. code-block:: bash

   php bin/console oro:maintenance-notification --env=prod

The text of the message can be provided either as the value of the ``--message`` option or it can be read from a text file specified in the --file option:

.. code-block:: bash

   php bin/console oro:maintenance-notification --message=<message-text> --env=prod
   php bin/console oro:maintenance-notification --file=<path-to-text-file> --env=prod

The ``--subject`` option can be used to override the default subject provided by the configured email template:

.. code-block:: bash

   php bin/console oro:maintenance-notification --message=<message> --subject=<subject> --env=prod

The ``--sender_name`` and ``--sender_email`` options can be used to override the default name and email address of the sender:

.. code-block:: bash

   php bin/console oro:maintenance-notification --message=<message> --sender_name=<name> --sender_email=<email> --env=prod


Create Notification Rule
------------------------

For detailed steps on how to create a notification rule, please see :ref:`user documentation <system-notification-rules>`.

`Contact Emails` enables you to check recipients stored in the entity fields marked as `Contact Information` > `Email`.

.. hint::
    For more information about configuring such fields, see :ref:`Create Entity Fields <doc-entity-fields-create>`.

When you create the rule, specify the events that will create jobs for the consumer to submit emails chosen in the `Recipient list` group.
Make sure that the consumer is running.

Extend Additional Associations
------------------------------

To add new associations to `Additional Associations` group, create a class that implements |AdditionalEmailAssociationProviderInterface| and registered in the DI container with the `oro_notification.additional_email_association_provider` tag.

An example:

1. Create an additional associations provider:

   .. code-block:: php

        class MyAdditionalEmailAssociationProvider implements AdditionalEmailAssociationProviderInterface
        {
            public function getAssociations(string $entityClass): array
            {
                if (!is_a($entityClass, MyEntity::class, true)) {
                    return [];
                }

                return [
                    'someAccociation' => [
                        'label'        => $this->translator->trans('acme.my_entity.some_accociation'),
                        'target_class' => MyTargetEntity::class
                    ]
                ];
            }

            public function isAssociationSupported($entity, string $associationName): bool
            {
                return
                    $entity instanceof MyEntity
                    && 'someAccociation' === $associationName;
            }

            public function getAssociationValue($entity, string $associationName)
            {
                $targetEntity = get target entity logic

                return $targetEntity;
            }
        }

2. Register the provider in the DI container:

   .. code-block:: yaml

        services:
            acme.additional_email_association_provider.my:
                class: Acme\Bundle\AcmeBundle\Provider\MyAdditionalEmailAssociationProvider
                public: false
                tags:
                    - { name: oro_notification.additional_email_association_provider }

.. _notification-bundle-event:

Register an Event to Send Notification Emails
---------------------------------------------

To allow creating :ref:`notification rules <system-notification-rules>` for new types of events, register them in the ``Resources/config/oro/app.yml`` file in your bundle.

.. code-block:: yaml
   :caption: Resources/config/oro/app.yml

    oro_notification:
        events:
            - my_custom_event_1
            - my_custom_event_2

.. include:: /include/include-links-dev.rst
   :start-after: begin
