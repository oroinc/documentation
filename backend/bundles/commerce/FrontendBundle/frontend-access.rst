Frontend Access
===============

Close Website for Non-Authenticated Visitors
--------------------------------------------

In order to prevent non-registered customers from accessing the storefront, you can disable website access for these users.

To change access, navigate to **Configuration > Commerce > Guests > Website Access** and set the **Enable Guest Access** option.

When access is disabled, all non-authenticated visitors are redirected to the login page.
``Oro\Bundle\FrontendBundle\EventListener\GuestAccessRequestListener`` creates a redirect response; to get a better understanding of how it makes works, take a look at the description inside the class.

A few system URLs are still available, even if access for non-authenticated visitors is restricted.
A list of patterns of those URLs can be found in ``Oro\Bundle\FrontendBundle\GuestAccess\Provider\GuestAccessAllowedUrlsProvider``.

To add a pattern to the list of allowed URL patterns, call `addAllowedUrlPattern` of the `oro_frontend.guest_access.provider.guest_access_urls_provider` service or create your own provider which should implement ``Oro\Bundle\FrontendBundle\GuestAccess\Provider\GuestAccessAllowedUrlsProviderInterface``, and register it in the DI container with the tag `oro_frontend.guest_access_urls_provider`.

.. code-block:: yaml
   :linenos:

    acme_frontend.guest_access.provider.guest_access_urls_provider:
        class: Acme\Bundle\MyFrontendBundle\GuestAccess\Provider\MyGuestAccessAllowedUrlsProvider
        tags: ['oro_frontend.guest_access_urls_provider']

Frontend Datagrids
------------------

The `frontend` option in the datagrid configuration controls the display of the management console datagrids in the storefront. By default, it is suggested that all datagrids are intended to be used in the management console. To allow a datagrid to be visible in the storefront, the `frontend` option should be set to `true`.

.. code-block:: yaml
   :linenos:

    acme_frontend.frontend_customers_users:
        options:
            frontend: true

