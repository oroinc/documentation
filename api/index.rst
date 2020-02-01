:title: OroCommerce and OroCRM Web API Development

.. meta::
   :description: WebAPI engine architecture and backend developer guides

.. _web-services-api:

:oro_show_local_toc: false

Web Services API Guide
======================

REST API enables developers to integrate Oro functionality into third-party software systems.

An application programming interface (API) is a software interface which is designed to be used by other software for integration with this application.
Whilst an ordinary software program is used by a (human) computer user, an API is a software program used by
another software program.

The Representational State Transfer (REST) architectural style is an abstraction of the architectural elements
within a distributed hypermedia system. REST ignores the details of component implementation and protocol syntax in
order to focus on the roles of the components, the constraints on their interaction with other components, and their
interpretation of significant data elements. It encompasses the fundamental constraints on components, connectors,
and data that define the basis of the Web architecture, and thus the essence of its behavior as a network-based
application.

|JSON API| is a specification for how a client should request those resources to
be fetched or modified, and how a server should respond to them. It is designed to minimize both the number of requests
and the amount of data transmitted between the clients and the servers. This efficiency is achieved without compromising
on readability, flexibility or discoverability.

Therefore, here and below the term *API* will refer to the REST JSON API that gives programmatic access
to read and write data. Request and response body should use JSON format.

Find more information about Web API in the following topics:

.. toctree::
   :titlesonly:
   :maxdepth: 1

   enabling-api-feature
   sandbox
   authentication/index
   schema
   http-methods
   http-header-specifics
   response-status-codes
   error-messages
   resource-fields
   filters
   create-update-related-resources
   client-requirements

The documentation for the server-side developers can be found in :ref:`API Developer Guide <web-api>`.

.. include:: /include/include-links-dev.rst
   :start-after: begin

.. toctree::
   :hidden:

   simple-search
   advanced-search
