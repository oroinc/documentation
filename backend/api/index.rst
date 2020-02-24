.. _web-api:

API Developer Guide
===================

This section describes the Web API development framework for the application data. It provides the ability to define API in the YAML configuration files regardless of standards or formats. Out-of-the-box, the framework opens REST API that conforms the |JSON:API specification| and enables CRUD operations support for the application ORM entities.

The Web API development framework is implemented by :ref:`OroApiBundle <bundle-docs-platform-api-bundle>` and based on the following components:

* |ChainProcessor| --- Organizes data processing flow.
* |EntitySerializer| --- Provides fast access to entities data.
* |Symfony Form| --- Provides a flexible way to map request data to entity object.

|FOSRestBundle| and |NelmioApiDocBundle| are also used for REST API.

.. note:: The main format for REST API is described at |JSON:API|. Please make sure that you are familiar with it before you start creating REST API for your entities.

The auto-generated documentation and sandbox for REST API is available at `/api/doc`, e.g. |http://demo.orocrm.com/api/doc|.

By default, only custom entities, dictionaries, and enumerations are accessible through the back-office API. For how to make other entities available via the API, see :ref:`Configuration Reference <web-api--configuration>`.

.. toctree::
   :titlesonly:

   commands
   security
   firewall-listeners
   configuration
   configuration-extra
   configuration-extensions
   forms
   documentation
   actions
   request-type
   processors
   headers
   filters
   how-to
   cors
   testing
   storefront
   storefront-routes


.. include:: /include/include-links-dev.rst
   :start-after: begin
