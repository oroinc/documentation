.. _api-request-type:

Request Type
============

A request type is a crucial concept of the ApiBundle.

A set of processors handles each API request, and each one contributes to producing the
requested result. Some processors analyze and validate the request data, while others update the
database and prepare the correct response.

To process different types of API requests, such as REST API and REST API that conform to the
|JSON:API specification|, you need different sets of processors. Some processors work for all
request types, and others only for specific ones.

The request type concept in ApiBundle reflects all of the above and lets you easily configure
shared and specific processors.

Take a look at the |RequestType| class. It holds different aspects of a request, and the
combination of these aspects represents a specific request type.

For instance, if this class contains both ``rest`` and ``json_api``, it represents a request type
for REST API that conforms to the JSON:API specification. Adding the ``my_erp`` aspect means it
represents a REST API built for integration with the "My ERP" system and based on the JSON:API
specification.

As another example, suppose you have two types of REST API: one that conforms to the JSON:API
specification and another that conforms to the GraphQL specification. The RequestType object can
then contain ``rest`` and ``json_api`` for JSON:API requests, and ``rest`` and ``graphql`` for
GraphQL requests.

This combination of aspects enables you to configure different sets of processors for each request type.
See examples of configuring processors for different aspects and their combinations in the
:ref:`Processor Conditions <processor-conditions>` topic.

.. include:: /include/include-links-dev.rst
   :start-after: begin