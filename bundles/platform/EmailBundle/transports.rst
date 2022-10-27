Transports
==========

Main Transport
--------------

OroEmailBundle introduces a mailer transport with the ``oro://system-config`` DSN that is responsible for sending
email messages via either SMTP settings taken from **System > Configuration > System Configuration > General Setup > Email Configuration**
or DSN specified in the `fallback` parameter (e.g., ``oro://system-config?fallback=native://default``) if the SMTP settings
from the System Configuration are not eligible.

.. note:: Transport ``oro://system-config`` should be at the top of the list in the `framework.mailer.transports` configuration section to be used as default.

Using Another Transport
-----------------------

To use another mailer transport to send an email message:

- Ensure that the required transport is defined in the `framework.mailer.transports` configuration section.
- Add the email message to the `X-Transport` header with the name of the transport required for sending. See |Multiple Email Transports| for more information.



.. include:: /include/include-links-dev.rst
   :start-after: begin
