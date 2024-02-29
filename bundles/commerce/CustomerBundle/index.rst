.. _bundle-docs-commerce-customer-portal-customer-bundle:

OroCustomerBundle
=================

|OroCustomerBundle| enables B2B-customer-related features in Oro applications and provides UI to manage B2B customers, customers groups, customer users, and customer user roles in the back-office and the storefront UI.

The bundle also allows back-office administrators to configure B2B-customer-related settings in the system configuration UI for the entire system, individual organizations, and websites.

Bundle Responsibilities
-----------------------

OroCustomerBundle is responsible for:

- Customer user CRUD
- Assigning roles to customer users
- Activating and deactivating customer users
- Sending welcome emails
- Editing password and automatically generating password for a new customer user

Configure Frontend Permissions (ACL)
------------------------------------

OroCustomerBundle extends security model of ``OroSecurityBundle`` for entities which should be accessible for customer users in the storefront. It adds few new fields to ownership configuration of entities.

The example of the frontend permissions configuration for entity is provided below.

.. code-block:: php

    #[ORM\Entity]
    #[Config(
        defaultValues: [
            'ownership' => [
                'frontend_owner_type' => 'FRONTEND_USER',
                'frontend_owner_field_name' => 'customerUser',
                'frontend_owner_column_name' => 'customer_user_id',
                'frontend_customer_field_name' => 'customer',
                'frontend_customer_column_name' => 'customer_id'
            ],
            'security' => [
                'type' => 'ACL',
                'group_name' => 'commerce'
            ]
        ]
    )]
    class SomeEntity implements ExtendEntityInterface
    {
        /**
         * @var Customer
         */
        #[ORM\ManyToOne(targetEntity: 'Oro\Bundle\CustomerBundle\Entity\Customer')]
        #[ORM\JoinColumn(name: 'customer_id', referencedColumnName: 'id', onDelete: 'SET NULL')]
        protected $customer;

        /**
         * @var CustomerUser
         */
        #[ORM\ManyToOne(targetEntity: 'Oro\Bundle\CustomerBundle\Entity\CustomerUser')]
        #[ORM\JoinColumn(name: 'customer_user_id', referencedColumnName: 'id', nullable: true, onDelete: 'SET NULL')]
        protected $customerUser;
        ...
    }


Configure Anonymous Customer User
---------------------------------

Anonymous customer user functionality consists of the sections below.

AnonymousCustomerUserToken
^^^^^^^^^^^^^^^^^^^^^^^^^^

|OroBundleCustomerBundleSecurityTokenAnonymousCustomerUserToken| is the token class that is extended from ``AnonymousToken``. It is tied with the ``CustomerVisitor`` entity class which persisted anonymous customer user data for later use. Besides it, the token stores the info taken from the ``visitor_id`` and ``session_id`` cookies.

.. code-block:: php


    $token = new AnonymousCustomerUserToken(
            $customerVisitor, //instanceof UserInterface
            $this->rolesProvider->getRoles(), // optional - array of roles
            $organization // optional - an organization
    );


The ``AnonymousCustomerUserToken`` is created in the ``createToken`` method of |OroBundleCustomerBundleSecurityAnonymousCustomerUserAuthenticator|.

CustomerVisitor Entity
^^^^^^^^^^^^^^^^^^^^^^

The |OroBundleCustomerBundleEntityCustomerVisitor| class has the following properties:

* id
* lastVisit - tracks guest last visit datetime
* sessionId - a unique identifier
* customerUser - one-to-one relation to ``CustomerUser`` entity. Used to retrieve the customer info from the token.

The session id property is generated through Doctrine ``PrePersist`` Lifecycle Event:

.. code-block:: php


    $this->sessionId = bin2hex(random_bytes(10));

.. _customerbundle-authenticator:

Authenticator
^^^^^^^^^^^^^

.. note:: See |OroBundleCustomerBundleSecurityAnonymousCustomerUserHowToWriteACustomAuthenticator| for more details on the custom authenticator.


The |OroBundleCustomerBundleSecurityAnonymousCustomerUserAuthenticator| class represents a significant evolution in the authentication process of the storefront's anonymous users in Symfony 6.4. This class replaces the traditional combination of a Listener and an Authentication Provider, streamlining the process with advanced techniques and new methodologies.


Functionality and Workflow
^^^^^^^^^^^^^^^^^^^^^^^^^^

1. **Support Check**: The **supports(Request $request): bool** method determines if the current request should be authenticated as a customer visitor. This involves checking the request type and the presence of an existing token in the token storage.
2. **Authentication Process**: The **authenticate(Request $request): Passport** method is responsible for the core authentication process. It retrieves the current website and its associated organization, ensuring that they are valid and exist. It then creates an ``AnonymousSelfValidatingPassport`` with an ``AnonymousCustomerUserBadge``, which is built using the credentials from the customer visitor cookie.
3. **Token Creation**: The **createToken(Passport $passport, string $firewallName): TokenInterface** method generates an ``AnonymousCustomerUserToken``. This token is populated with user, roles, organization data, and holds a ``CustomerVisitor`` object. It ensures the token is saved in the token storage for future use.
4. **Authentication Success and Failure**: The methods **onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response** and **onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response** handle the outcomes of the authentication process, logging the appropriate information.
5. **Credential Management**: The **saveCredentials(Request $request, Passport $passport): void** method manages the credentials, setting the necessary attributes and cookie information in the request.
6. **Visitor Authentication**: The **getVisitor(string $credentials): CustomerVisitor** method is a crucial component of the authenticator. It decodes the credentials and retrieves or creates a ``CustomerVisitor`` entity using the ``CustomerVisitorManager``.

This authenticator integrates seamlessly with Symfony's security system, offering a more efficient and streamlined approach to handling anonymous customer user authentication. The use of badges, passports, and a modernized token system enhances the security and robustness of the process, aligning it with contemporary web application standards.

If the authentication of ``AnonymousCustomerUserToken`` object is successful, you need to update cookie using the lifetime parameter, ``oro_customer.customer_visitor_cookie_lifetime_days``.
By default, this param is 30 days, and it is accessible through the :ref:`System > Configuration > Commerce > Customer > Customer User <sys-config--configuration--commerce--customers--customer-users>` section on the global and organization levels:

.. code-block:: php


    const COOKIE_ATTR_NAME = '_security_customer_visitor_cookie';
    const COOKIE_NAME = 'customer_visitor';

    $cookieLifetime = $this->configManager->get('oro_customer.customer_visitor_cookie_lifetime_days');

    $cookieLifetime = $cookieLifetime * Configuration::SECONDS_IN_DAY;

    $request->attributes->set(
        self::COOKIE_ATTR_NAME,
        new Cookie(
            self::COOKIE_NAME,
            base64_encode(json_encode([$visitor->getId(), $visitor->getSessionId()])),
            time() + $cookieLifetime
        )
    );


The |OroBundleCustomerBundleSecurityListenerCustomerVisitorCookieResponseListener| listens ``kernel.response`` events. If the request has an ``_security_customer_visitor_cookie`` attribute, it sets a cookie to it.

AnonymousCustomerUserFactory
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The |OroBundleCustomerBundleDependencyInjectionSecurityAnonymousCustomerUserFactory| class ties |OroBundleCustomerBundleSecurityAnonymousCustomerUserAuthenticator|.
Also, it defines the ``update_latency`` configuration option. It helps prevent sending too many requests to the database when updating the ``lastVisit`` datetime of the ``AnonymousCustomerUser`` entity. Its default value is set in the DI container and is expressed in seconds:

.. code-block:: yaml


   oro_customer.anonymous_customer_user.update_latency: 600 # 10 minutes in seconds


Firewall Configuration
^^^^^^^^^^^^^^^^^^^^^^

To activate anonymous customer user functionality for some routes or apply it to the existing ones, define it in the ``security`` section with the ``anonymous_customer_user: true`` property:

.. code-block:: yaml


   security:
       firewalls:
           frontend:
               anonymous_customer_user: true


In this example, we enable guest functionality for the application storefront.

Guest Customer User
^^^^^^^^^^^^^^^^^^^

Guest Customer User is a customer user with the following DB properties:

   * ``confirmed`` = ``false``
   * ``enabled`` = ``false``
   * ``is_guest`` = ``true``

The |OroBundleCustomerBundleEntityGuestCustomerUserManager| class has a logic of creation ``Guest Customer User``.

It is used for creating some business products under Anonymous Customer, like RFQ or Order, in the storefront.
For example, when creating one of the mentioned products, we can tie it with Guest Customer info taken from ``AnonymousCustomerUserToken`` token:

.. code-block:: php


   // $request is a some Request object
   $token = $this->tokenAccessor->getToken();

   if ($token instanceof AnonymousCustomerUserToken) {
       $visitor = $token->getVisitor();
       $user = $visitor->getCustomerUser();
       if ($user === null) {
           $user = $this->guestCustomerUserManager
               ->generateGuestCustomerUser(
                   [
                       'email' => $request->getEmail(),
                       'first_name' => $request->getFirstName(),
                       'last_name' => $request->getLastName(),
                       ...
                   ]
               );
           $visitor->setCustomerUser($user);
       }
       $request->setCustomerUser($user);
   }


Ownership
^^^^^^^^^

When using guest functionality for some business products, you should specify their owner. With |OroBundleCustomerBundleEntityCustomerVisitorOwnerAwareInterface| and |OroBundleCustomerBundleOwnerAnonymousOwnershipDecisionMaker|, you can do it using the following conditions:

   * entity should implement ``CustomerVisitorOwnerAwareInterface``
   * token should be instance of ``AnonymousCustomerUserToken``
   * entity should contain ``CustomerVisitor`` and it should equal the current visitor in the session

Configure Guest Access and Permissions
--------------------------------------

When we implement guest functionality for some product, it should be tied with the related feature and added to system configuration on the global, organization, and website levels. By default, it should be disabled:

.. code-block:: php


   //.../DependencyInjection/Configuration.php
   'guest_product_toggle' => ['type' => 'boolean','value' => false],
   'guest_product_owner' => ['type' => 'string', 'value' => null]


.. code-block:: yaml


   #...Resources/config/oro/system_configuration.yml
   system_configuration:
       groups:
           guest_product_section:
               title: some.title
           guest_product_owner_section:
               title: some.title
       fields:
           guest_product:
               data_type: boolean
               type: Oro\Bundle\ConfigBundle\Form\Type\ConfigCheckbox
               options:
                   label: some.title
                   tooltip: some.tooltip
           guest_product_owner:
               ui_only: true
               data_type: string
               type: Oro\Bundle\UserBundle\Form\Type\UserSelectType
               options:
                   label: some.title
                   tooltip: some.tooltip
                   required: true
       tree:
           system_configuration:
               commerce:
                   children:
                       sales:
                           children:
                               guest_product_section:
                                   children:
                                       - guest_product
                               guest_product_owner_section:
                                   children:
                                       - guest_product_owner


.. code-block:: yaml


   #...Resources/config/oro/features.yml
   features:
       guest_product_feature:
           label: some.label
           description: some.description
           toggle: guest_product_toggle


Next, we should activate feature toggle voter in the DI configuration:

.. code-block:: yaml


   oro_bundle.voter.guest_product:
       parent: oro_customer.voter.anonymous_customer_user
       calls:
           - [ setFeatureName, ['guest_product_feature'] ]
       tags:
           - { name: oro_featuretoggle.voter }

   oro_bundle.voter.guest_customer_user:
       parent: oro_customer.voter.customer_user
       calls:
           - [ setFeatureName, ['guest_product_feature'] ]
       tags:
           - { name: oro_featuretoggle.voter }

Sometimes, it is necessary to open some business entity or action for guests using ACL configuration.

So, to enable certain entities and actions for the Anonymous Customer User role by default, use the following code example:

.. code-block:: yaml


   #.../Migrations/Data/ORM/data/frontend_roles.yml
   ANONYMOUS:
       permissions:
           entity|Oro\Bundle\SomeBundle\Entity\Some: [VIEW_BASIC, CREATE_BASIC, EDIT_BASIC, DELETE_BASIC]
           action|some_action: [EXECUTE]

Once the application is installed, the predefined Non-Authenticated Visitors role will have the mentioned permissions/capabilities enabled.

.. include:: /include/include-links-dev.rst
   :start-after: begin





