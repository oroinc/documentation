.. _web-api--storefront:

Storefront REST API
===================

The REST API resources for the storefront are accessible via ``http://<hostname>/api``, while REST API resources for the back-office is accessible via ``http://<hostname>/admin/api``. There are also two REST API sandboxes, one for the storefront (``http://<hostname>/api/doc``) and another
for the back-office (``http://<hostname>/admin/api/doc``).

.. note:: Please note that the **admin** prefix is used by default and can be changed via the ``web_backend_prefix`` parameter.

All approaches described in :ref:`API Developer Guide <web-api>` are applicable to REST API resources for the storefront, but there are several differences:

- for configuration files, use ``Resources/config/oro/api_frontend.yml``, not ``Resources/config/oro/api.yml``
- the default value for the ``exclusion_policy`` option is ``custom_fields``, which means that all custom fields (fields with ``is_extend`` = ``true`` and ``owner`` = ``Custom`` in ``extend`` scope in entity configuration) that are not configured explicitly are excluded
- for documentation files, use the ``Resources/doc/api_frontend`` folder, not ``Resources/doc/api``
- for API processors, use the ``frontend`` request type
- for API routes, use the ``Oro\Bundle\FrontendBundle\Controller\FrontendRestApiController`` controller instead of ``Oro\Bundle\ApiBundle\Controller\RestApiController``, use the ``frontend_rest_api`` group instead of ``rest_api`` and set the ``frontend`` option to ``true``
- for :ref:`CORS requests configuration <api-cors-config>`, use the ``oro_frontend / frontend_api / cors`` section, not ``oro_api / cors``
- for API functional tests, use ``Oro\Bundle\FrontendBundle\Tests\Functional\ApiFrontend\FrontendRestJsonApiTestCase`` instead of
  ``Oro\Bundle\ApiBundle\Tests\Functional\RestJsonApiTestCase``. By default, all API requests are executed by an anonymous user. To execute them by the customer user with administrative permissions, use the  ``Oro\Bundle\CustomerBundle\Tests\Functional\ApiFrontend\DataFixtures\LoadAdminCustomerUserData`` data fixture and add the ``$this->loadFixtures([LoadAdminCustomerUserData::class]);`` in ``setUp()`` method of your test class. To execute the test by the customer user with buyer permissions, you can use the ``Oro\Bundle\CustomerBundle\Tests\Functional\ApiFrontend\DataFixtures\LoadBuyerCustomerUserData`` data fixture.

When :ref:`Public Storefront API <admin-configuration-application>` is enabled some API resources can be used by non-authenticated visitors. The list of such resources is configured by developers by ``oro_customer / frontend_api / non_authenticated_visitors_api_resources`` in `Resources/config/oro/app.yml`, for example:

.. code-block:: yaml

    oro_customer:
        frontend_api:
            non_authenticated_visitors_api_resources:
                - Acme\Bundle\DemoBundle\Entity\SomeEntity

Additional notes:

- You can use the |SetWebsite| processor to assign an entity to the current website.
- You can use the |SetCurrency| processor to set the current currency to an entity.
- You can use the |SetCustomer| processor to assign an entity to the current customer.
- You can use the |SetCustomerUser| processor to assign an entity to the current customer user.

An example of registration of such processors:

.. code-block:: yaml

    services:
        oro_customer.api.customer_user.set_website:
            class: Oro\Bundle\WebsiteBundle\Api\Processor\SetWebsite
            arguments:
                - '@oro_api.form_property_accessor'
                - '@oro_website.manager'
            tags:
                - { name: oro.api.processor, action: customize_form_data, event: pre_validate, requestType: frontend, parentAction: create, class: Oro\Bundle\CustomerBundle\Entity\CustomerUser, priority: 20 }

        oro_order.api.set_currency_to_order:
            class: Oro\Bundle\CurrencyBundle\Api\Processor\SetCurrency
            arguments:
                - '@oro_api.form_property_accessor'
                - '@oro_locale.settings'
            tags:
                - { name: oro.api.processor, action: customize_form_data, event: pre_validate, requestType: frontend, parentAction: create, class: Oro\Bundle\OrderBundle\Entity\Order, priority: 15 }

        oro_customer.api.customer_address.set_customer:
            class: Oro\Bundle\CustomerBundle\Api\Processor\SetCustomer
            arguments:
                - '@oro_api.form_property_accessor'
                - '@oro_security.token_accessor'
                - 'frontendOwner'
            tags:
                - { name: oro.api.processor, action: customize_form_data, event: pre_validate, requestType: frontend, parentAction: create, class: Oro\Bundle\CustomerBundle\Entity\CustomerAddress, priority: 10 }

        oro_customer.api.customer_user_address.set_customer_user:
            class: Oro\Bundle\CustomerBundle\Api\Processor\SetCustomerUser
            arguments:
                - '@oro_api.form_property_accessor'
                - '@oro_security.token_accessor'
                - 'frontendOwner'
            tags:
                - { name: oro.api.processor, action: customize_form_data, event: pre_validate, requestType: frontend, parentAction: create, class: Oro\Bundle\CustomerBundle\Entity\CustomerUserAddress, priority: 10 }


.. include:: /include/include-links-dev.rst
   :start-after: begin
