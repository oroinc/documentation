.. _bundle-docs-platform-email-bundle-templates-send:

Sending an Email Created from an Email Template
===============================================

OroEmailBundle provides ``\Oro\Bundle\EmailBundle\Sender\EmailTemplateSender`` as the main entry point to create and send an email based on an email template.

``\Oro\Bundle\EmailBundle\Sender\EmailTemplateSender`` uses ``\Oro\Bundle\EmailBundle\Sender\EmailModelSender`` to send an email model created by ``\Oro\Bundle\EmailBundle\Factory\EmailModelFromEmailTemplateFactory`` from the email template loaded by ``\Oro\Bundle\EmailBundle\Provider\EmailTemplateProvider`` and rendered by ``\Oro\Bundle\EmailBundle\Provider\EmailRenderer``.

.. note:: For more information, see :ref:` How to Render an Email Template <bundle-docs-platform-email-bundle-templates-rendering>`.

Examples
--------

.. code-block:: php


    use Oro\Bundle\EmailBundle\Sender\EmailTemplateSender;
    use Oro\Bundle\NotificationBundle\Model\NotificationSettings;
    use Oro\Bundle\UserBundle\Entity\User;

    class Sample
    {
        private NotificationSettings $notificationSettings;

        private EmailTemplateSender $emailTemplateSender;

        private User $user;

        public function send(): void
        {
            // ...

            $from = $this->notificationSettings->getSender();

            $emailUserEntity = $this->emailTemplateSender
                ->sendEmailTemplate($from, $this->user, 'invite_user', $templateParams);

            // ...
        }
    }



.. include:: /include/include-links-dev.rst
    :start-after: begin
