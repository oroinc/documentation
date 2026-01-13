:oro_show_local_toc: false

:title: Oro Application Web API Development

.. meta::
   :description: WebAPI engine architecture and backend developer guides

.. _web-services-api:

Web Services API Guide
======================

REST API enables developers to integrate Oro functionality into third-party software systems.

An application programming interface (API) is a software interface designed to be used by other software for integration with the application.
Whilst an ordinary software program is used by a (human) computer user, an API is a software program used by
another software program.

The Representational State Transfer (REST) architectural style is an abstraction of the architectural elements
within a distributed hypermedia system. REST ignores the details of component implementation and protocol syntax to focus on the roles of the components, the constraints on their interaction with other components, and their
interpretation of significant data elements. It encompasses the fundamental constraints on components, connectors,
and data that define the basis of the Web architecture, and thus the essence of its behavior as a network-based
application.

|JSON:API| is a specification for how a client should request those resources to
be fetched or modified, and how a server should respond to them. It is designed to minimize both the number of requests
and the amount of data transmitted between the clients and the servers. This efficiency is achieved without compromising
on readability, flexibility, or discoverability.

Therefore, here and below, the term *API* referі to the REST API that conforms to the JSON:API specification,
providing programmatic access to read and write data. All requests and responses use JSON format.

All API access is over HTTP or HTTPS (depending on the server configuration) and is accessed from the ``http(s)://<hostname_of_your_oro_application>/api/<resource_name>``

A typical request can be performed via curl or JSON sandbox.

**Curl Example**

.. code-block:: http

    GET /api/users/1 HTTP/1.1

    curl -X "GET" -H "Accept: application/vnd.api+json"
         -H "Authorization: Bearer ..."
    http://localhost.com/api/users/1

Please note that to simplify the representation of request examples in the document, a short format is used, e.g.:

.. code-block:: http

    GET /api/users/1 HTTP/1.1
    Accept: application/vnd.api+json

Find more information about Web API in the following topics:

.. toctree::
   :titlesonly:
   :maxdepth: 1

   enabling-api-feature
   sandbox
   authentication/index
   Checkout API <checkout-api>
   http-methods
   http-header-specifics
   response-status-codes
   error-messages
   resource-fields
   filters
   create-update-related-resources
   upsert-operation
   validate-operation
   client-requirements
   batch-api
   sync-batch-api

The documentation for the server-side developers can be found in :ref:`API Developer Guide <web-api>`.


.. admonition:: Business Tip

    Looking for the |open source B2B eCommerce platform| that can meet your business needs? Make sure to check our comprehensive platform comparison page.





.. include:: /include/include-links-dev.rst
   :start-after: begin

.. include:: /include/include-links-seo.rst
   :start-after: begin

.. toctree::
   :hidden:

   simple-search
   advanced-search
