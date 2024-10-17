:oro_show_local_toc: false

.. _bundle-docs-commerce-sales-frontend-bundle-cors:

Cross-Origin Resource Sharing (CORS)
====================================

|SalesFrontendBundle| automatically configures |CORS| headers to allow cross-origin requests to the OroCommerce application made from the Sales Frontend application.

CORS is automatically configured for the following URLs:

* ``%oro_sales_frontend.routing_prefix%/oauth2/check-token``
* ``%oro_sales_frontend.routing_prefix%/oauth2/refresh-token``
* ``%oro_sales_frontend.routing_prefix%/user/login``
* ``%oro_sales_frontend.routing_prefix%/user/logout``

where ``%oro_sales_frontend.routing_prefix%`` is ``/admin/sales-frontend`` by default.

.. note:: Routing prefix can be changed via the bundle configuration, see more in :ref:`Routing Prefix <bundle-docs-commerce-sales-frontend-bundle-routing-prefix>` configuration.

CORS is configured by ``\Oro\Bundle\SalesFrontendBundle\EventListener\Kernel\SetCrossOriginResourceSharingPolicyListener`` that by default sets the following:

* Allowed origins: the Sales Frontend application hosts (configured automatically as per the ``oro_sales_frontend.app_base_urls`` bundle configuration setting).
* Allowed methods: ``GET``, ``POST``
* Allowed credentials: ``true``
* Allowed headers: ``all``
* Exposed headers: ``none``
* Max age: ``600 seconds``

.. note:: You can customize methods, headers and max age via corresponding setter methods in ``SetCrossOriginResourceSharingPolicyListener``

Back-Office Web API
-------------------

|SalesFrontendBundle| automatically configures |CORS| for :ref:`Back-office Web API <web-api>` to ensure that the Sales Frontend application can communicate with it:

* Allowed origins: the Sales Frontend application hosts (configured automatically as per the ``oro_sales_frontend.app_base_urls`` bundle configuration setting).
* Allowed credentials: ``true``

Other CORS settings of the :ref:`Back-Office Web API <web-api>` remain unchanged.

.. include:: /include/include-links-dev.rst
   :start-after: begin
