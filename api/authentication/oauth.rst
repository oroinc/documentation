.. _web-services-api--authentication--oauth:

:oro_show_local_toc: false

.. index::
    single: Security; OAuth Authorization; OAuth Authentication
    single: OAuth Authorization
    single: OAuth Authentication

OAuth Authentication
====================

|OAuth 2.0| is the industry-standard protocol for authorization. OAuth 2.0 focuses on client developer simplicity
while providing specific authorization flows for web applications, desktop applications, mobile phones,
and living room devices.

It is implemented by the |OroOAuth2ServerBundle| that supports |OAuth 2.0 Client Credentials Grant|
and |OAuth 2.0 Password Grant|.

For more details, see :ref:`Manage OAuth Applications <oauth-applications>`
and :ref:`Manage Storefront OAuth Applications <storefront-oauth-app>`.

Generate Tokens
---------------

.. toctree::
   :titlesonly:

   oauth-client-credentials
   oauth-password
   oauth-password-refresh


.. note::

    In order to use OAuth authentication, private and public keys should be generated and placed
    to the server. Please contact your administrator if you see the following error message:

    *The encryption key does not exist.*


.. include:: /include/include-links-dev.rst
   :start-after: begin
