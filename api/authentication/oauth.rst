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

It is implemented by the :ref:`OroOAuth2ServerBundle <bundle-docs-platform-oauth2-server-bundle>` that supports
|OAuth 2.0 Authorization Code Grant|, |OAuth 2.0 Client Credentials Grant| and |OAuth 2.0 Password Grant|.

For more details, see :ref:`Manage OAuth Applications <oauth-applications>`
and :ref:`Manage Customer User OAuth Applications <customer-user-oauth-app>`.

Generate Tokens
---------------

.. toctree::
   :titlesonly:

   oauth-authorization-code
   oauth-client-credentials
   oauth-password
   oauth-password-refresh


.. note::

    In order to use OAuth authentication, private and public keys should be generated and placed
    to the server. Please contact your administrator or please follow
    the :ref:`OroOAuth2ServerBundle documentation <bundle-docs-platform-oauth2-server-bundle--configuration>`
    if you see the following error message:

    *The encryption key does not exist.*

.. note::

    If the system has the customer portal package installed, OAuth authorization for customer users
    to the storefront API resources is enabled automatically.


.. admonition:: Business Tip

    Want to take advantage of the new digital commerce trend? Check out everything you need to know about a |B2B wholesale marketplace|.


.. include:: /include/include-links-dev.rst
   :start-after: begin

.. include:: /include/include-links-seo.rst
   :start-after: begin