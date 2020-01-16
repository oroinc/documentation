.. _web-services-api--authentication:

Authentication
==============

A RESTful API should be stateless. This means that request authentication should not depend on cookies or sessions.
Instead, each request should come with some authentication credentials.

Out-of-the-box, OroPlatform provides the following authentication mechanism:

.. toctree::
   :titlesonly:
   :maxdepth: 1

   oauth
   wsse

.. important::

    Please note that WSSE authentication is deprecated and will be removed in one of the future LTS releases.
    Use :ref:`OAuth authentication<web-services-api--authentication--oauth>` instead.
