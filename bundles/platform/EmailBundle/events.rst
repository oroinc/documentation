Events
======

On top on Symfony's ``\Symfony\Component\Mailer\Event\MessageEvent``, OroEmailBundle introduces ``\Oro\Bundle\EmailBundle\Event\BeforeMessageEvent``.
Both events allow modifying an email message and an envelope, and the difference between them is in the point at which they do that.

`BeforeMessageEvent` is dispatched before `MessageEvent` and from the ``\Oro\Bundle\EmailBundle\Mailer\Transport\Transport``
wrapper before an email message is passed to the Symfony Mailer transport (e.g., ``Symfony\Component\Mailer\Transport\Transports``) that
detects which mailer transport should be used based on the `X-Transport` header.
