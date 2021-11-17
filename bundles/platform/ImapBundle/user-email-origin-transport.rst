User Email Origin Transport
===========================

OroImapBundle introduces a mailer transport with ``oro://user-email-origin`` DSN, responsible for sending email messages using user-defined SMTP settings (taken from ``Oro\Bundle\ImapBundle\Entity\UserEmailOrigin``). The mailer is switched to this transport by ``Oro\Bundle\ImapBundle\EventListener\SetUserEmailOriginTransportListener`` when
an email message contains the `X-User-Email-Origin-Id` header with the ID of the `UserEmailOrigin` entity.

Email messages from a user mailbox are sent using ``Oro\Bundle\EmailBundle\Sender\EmailModelSender`` with specified `UserEmailOrigin` that makes the mailer switch to the `user-email-origin` transport.

OroImapBundle expects `oro_user_email_origin` transport to be defined in the `framework.mailer.transports` configuration section. The name of the `user-email-origin` transport can be changed via the `oro_imap.user_email_origin_transport` configuration option.

.. warning:: Transport with DSN ``oro://user-email-origin`` must not be used as the default one as it expects the header `X-User-Email-Origin-Id` to be always defined in the email message.


.. include:: /include/include-links-dev.rst
   :start-after: begin
