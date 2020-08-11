:oro_documentation_types: OroCommerce

.. _web-api--storefront-routes:

Storefront Routes
=================

Storefront API has an API resource, named as ``routes``, that returns the information about the storefront URLs.
This information includes a resource type and the relative URL of an API resource that be used to get the data.

To provide this information, the two types of resolvers are used:

 - the resource type resolver, that is represented by |ResourceTypeResolverInterface|;
 - the API URL resolver, that is represented by |ResourceApiUrlResolverInterface|.

The resource type resolvers should be registered in service container with a tag ``oro_frontend.api.resource_type_resolver``,
and optionally the ``routeName`` tag attribute can be used to specify the route for which the resolver is applicable.

The API URL resolvers should be registered in service container with a tag ``oro_frontend.api.resource_api_url_resolver``,
and optionally the ``routeName`` tag attribute can be used to specify the route for which the resolver is applicable.

An example of resolvers registration in ``services_api.yml`` file:

.. code-block:: yaml

    services:
        oro_cms.api.resource_type_resolver.landing_page:
            class: Oro\Bundle\FrontendBundle\Api\ResourceTypeResolver
            arguments:
                - 'landing_page' # the resource type should be returned for the route oro_cms_frontend_page_view
            tags:
                - { name: oro_frontend.api.resource_type_resolver, routeName: oro_cms_frontend_page_view }

        oro_cms.api.resource_api_url_resolver.landing_page:
            class: Oro\Bundle\FrontendBundle\Api\ResourceRestApiGetActionUrlResolver
            arguments:
                - '@router'
                - '@oro_api.rest.routes_registry'
                - '@oro_api.value_normalizer'
                - Oro\Bundle\CMSBundle\Entity\Page
            tags:
                - { name: oro_frontend.api.resource_api_url_resolver, routeName: oro_cms_frontend_page_view, requestType: rest }

Here are some useful implementations of |ResourceTypeResolverInterface| and |ResourceApiUrlResolverInterface|:

- |ResourceTypeResolver| - resolves a resource type by a route name.
- |ResourceRestApiGetActionUrlResolver| - resolves the URL of the :ref:`get <get-action>` action REST API resource by a route name.
- |ResourceRestApiGetListActionUrlResolver| - resolves the URL of the :ref:`get_list <get-list-action>` action REST API resource by a route name.


.. include:: /include/include-links-dev.rst
   :start-after: begin
