.. _bundle-docs-commerce-customer-portal-customer-bundle:

OroCustomerBundle
=================

OroCustomerBundle enables B2B-customer-related features in Oro applications and provides UI to manage B2B customers, customers groups, customer users, and customer user roles in the back-office and the storefront UI.

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
   :linenos:

    <?php
    ....

     /**
     * @ORM\Entity()
     * @Config(
     *      defaultValues={
     *          "ownership"={
     *              "frontend_owner_type"="FRONTEND_USER",
     *              "frontend_owner_field_name"="customerUser",
     *              "frontend_owner_column_name"="customer_user_id",
     *              "frontend_customer_field_name"="customer",
     *              "frontend_customer_column_name"="customer_id"
     *          },
     *          "security"={
     *              "type"="ACL",
     *              "group_name"="commerce",
     *          },
     *      }
     * )
     */
     class SomeEntity extends ExtendSomeEntity
     {
         /**
          * @var Customer
          *
          * @ORM\ManyToOne(targetEntity="Oro\Bundle\CustomerBundle\Entity\Customer")
          * @ORM\JoinColumn(name="customer_id", referencedColumnName="id", onDelete="SET NULL")
          */
         protected $customer;

         /**
          * @var CustomerUser
          *
          * @ORM\ManyToOne(targetEntity="Oro\Bundle\CustomerBundle\Entity\CustomerUser")
          * @ORM\JoinColumn(name="customer_user_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
          */
         protected $customerUser;
     ...
     }


Configure Anonymous Customer User
---------------------------------

Anonymous customer user functionality consists of the sections below.

AnonymousCustomerUserToken
^^^^^^^^^^^^^^^^^^^^^^^^^^

|OroBundleCustomerBundleSecurityTokenAnonymousCustomerUserToken| is the token class that is extended from ``AnonymousToken``. It is tied with the ``CustomerVisitor`` entity class which persisted anonymous customer user data for later use. Besides it, the token stores the info taken from the ``visitor_id`` and ``session_id`` cookies. When the token is initialized for the first time, it is filled with the ``Anonymous Customer User`` string to provide compatibility with Symfony security system.

.. code-block:: php
   :linenos:

    $token = new AnonymousCustomerUserToken(
        'Anonymous Customer User',
        [$currentWebsite->getGuestRole()->getRole()]
    );


The AnonymousCustomerUserToken is created in the ``authenticate`` method of :ref:`AnonymousCustomerUserAuthenticationProvider <customerbundle-authentication-provider>`.

CustomerVisitor Entity
^^^^^^^^^^^^^^^^^^^^^^

The |OroBundleCustomerBundleEntityCustomerVisitor| class has the following properties:

* id
* lastVisit - tracks guest last visit datetime
* sessionId - a unique identifier
* customerUser - one-to-one relation to ``CustomerUser`` entity. Used to retrieve the customer info from the token. For such cases, the `Guest Customer User`_ term is used, because it is not a "true" user.

The session id property is generated through Doctrine ``PrePersist`` Lifecycle Event:

.. code-block:: php
   :linenos:

    $this->sessionId = bin2hex(random_bytes(10));


Listener
^^^^^^^^

The |OroBundleCustomerBundleSecurityFirewallAnonymousCustomerUserAuthenticationListener| class listens requests on the firewall and calls |OroBundleCustomerBundleSecurityAnonymousCustomerUserAuthenticationProvider| using the ``handle`` method.

The listener checks the token, and if it is the instance of ``AnonymousCustomerUserToken``, sets a visitor Id and a session Id taken from the ``customer_visitor`` cookie to the token.
If the authentication of ``AnonymousCustomerUserToken`` object is successful, you need to update cookie using the lifetime parameter, ``oro_customer.customer_visitor_cookie_lifetime_days``. By default, this param is 30 days, and it is accessible through the System > Configuration > Commerce > Customer > Customer User section on the global and organization levels:

.. code-block:: php
   :linenos:

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

.. _customerbundle-authentication-provider:

Authentication Provider
^^^^^^^^^^^^^^^^^^^^^^^

The ``authenticate`` method of the |OroBundleCustomerBundleSecurityAnonymousCustomerUserAuthenticationProvider| class  verifies ``AnonymousCustomerUserToken``. The |OroBundleCustomerBundleEntityCustomerVisitorManager| class finds the ``CustomerVisitor`` entity using the ``visitor_id`` and ``session_id`` key fields and creates or updates the ``CustomerVisitor`` entity if it was created earlier. As a result, the ``AnonymousCustomerUserToken`` object is created and is populated with user, roles, and organization data, and holds the ``CustomerVisitor`` object.

AnonymousCustomerUserFactory
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The |OroBundleCustomerBundleDependencyInjectionSecurityAnonymousCustomerUserFactory| class ties |listener| and |provider|.
Also, it defines the ``update_latency`` configuration option. It helps prevent sending too many requests to the database when updating the ``lastVisit`` datetime of the ``AnonymousCustomerUser`` entity. Its default value is set in the DI container and is expressed in seconds:

.. code-block:: yaml
   :linenos:

   oro_customer.anonymous_customer_user.update_latency: 600 # 10 minutes in seconds


Firewall Configuration
^^^^^^^^^^^^^^^^^^^^^^

To activate anonymous customer user functionality for some routes or apply it to the existing ones, define it in the ``security`` section with the ``anonymous_customer_user: true`` property:

.. code-block:: yaml
   :linenos:

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
   :linenos:

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

When we implement guest functionality for some product, it should be tied with the related feature and added to system configuration on the global, organization, and website level). By default, it should be disabled:

.. code-block:: php
   :linenos:

   //.../DependencyInjection/Configuration.php
   'guest_product_toggle' => ['type' => 'boolean','value' => false],
   'guest_product_owner' => ['type' => 'string', 'value' => null]


.. code-block:: yaml
   :linenos:

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
   :linenos:

   #...Resources/config/oro/features.yml
   features:
       guest_product_feature:
           label: some.label
           description: some.description
           toggle: guest_product_toggle


Next, we should activate feature toggle voter in the DI configuration:

.. code-block:: yaml
   :linenos:

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
   :linenos:

   #.../Migrations/Data/ORM/data/frontend_roles.yml
   ANONYMOUS:
       permissions:
           entity|Oro\Bundle\SomeBundle\Entity\Some: [VIEW_BASIC, CREATE_BASIC, EDIT_BASIC, DELETE_BASIC]
           action|some_action: [EXECUTE]

Once the application is installed, the predefined Non-Authenticated Visitors role will have the mentioned permissions/capabilities enabled.



.. include:: /include/include-links-dev.rst
   :start-after: begin





