Transports
==========

Main Transport
--------------

OroEmailBundle introduces a mailer transport with the ``oro://system-config`` DSN that is responsible for sending
email messages via either SMTP settings taken from **System > Configuration > System Configuration > General Setup > Email Configuration**
or DSN specified in the `fallback` parameter (e.g., ``oro://system-config?fallback=native://default``) if the SMTP settings
from the System Configuration are not eligible.

The ``fallback`` parameter must be the last parameter of the ``oro://system-config`` DSN. The application uses all
text after ``fallback=`` as the fallback DSN, including its options. For example, with
``oro://system-config?fallback=smtp://user:password@smtp.example.com:587?require_tls=1&ssl[cafile]=/etc/pki/oro/ca.pem``,
the fallback transport requires STARTTLS and verifies the server certificate with the specified CA certificate.
For more information about the TLS options, see :ref:`SMTP <backend--setup--env-vars--tls-connections--smtp>`.

The application decodes the credentials of the fallback DSN once. Encode the reserved characters of the username and
the password once. For example, for the ``p/ss`` password, use ``p%2Fss``. A password that is encoded twice, such as
``p%252Fss``, does not work through the fallback.

.. note:: Transport ``oro://system-config`` should be at the top of the list in the `framework.mailer.transports` configuration section to be used as default.

Using Another Transport
-----------------------

To use another mailer transport to send an email message:

- Ensure that the required transport is defined in the `framework.mailer.transports` configuration section.
- Add the email message to the `X-Transport` header with the name of the transport required for sending. See |Multiple Email Transports| for more information.



.. include:: /include/include-links-dev.rst
   :start-after: begin
