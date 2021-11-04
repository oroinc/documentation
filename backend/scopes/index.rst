:title: Scopes Configuration in OroCommerce, OroCRM, OroPlatform

.. meta::
   :description: Introduction to the Oro scope entity and its configuration settings with examples

.. _dev-scopes:

Scopes
======

A scope is a set of application parameters that have different values in different requests.

For a working example of using scopes in Oro applications, please check out the *VisibilityBundle* and *CustomerBundle* codes.

.. _scopes-overview:

How Scopes Work
---------------

Sometimes, in bundle activities, you need to alter behavior or data based on the set of criteria that the bundle is not able to evaluate. The scope manager gets you the missing details by polling dedicated scope criteria providers. In the scope-consuming bundle, you can request information using one of the `Scope Operations`_. As a first parameter, you usually pass the scope type (e.g., web_content in the following examples). A scope type helps the scope manager find the scope-provider bundles, which can deliver the information that your bundle is missing. As the second parameter, you usually pass the context, the information available to your bundle that is used as a scope filtering criteria.

.. note:: The scope manager evaluates the priority of the registered scope criteria providers to deliver information for the requested scope type and scope criteria, and sorts the results based on the criteria priority.

Scope Manager
^^^^^^^^^^^^^

The scope manager is a service that provides an interface for collecting the scope items in the Oro application. It is in charge of the following functions:

* Expose scope-related operations (find, findOrCreate, findDefaultScope, findRelatedScopes) to the scope-aware bundles and deliver requested scope(s) as a result. See `Scope Operations`_ for more information.
* Create a collected scope in response to the findOrCreate operation (if the scope is not found).
* Use scope criteria providers to get a portion of the scope information.

.. code-block:: php


    // Find an existing scope or return null
    $scope = $scopeManager->find(ProductVisibility::getScopeType(), [
        ScopeCriteriaProvider::WEBSITE => $website,
    ]);

    // Find an existing scope or create a new one
    $scope = $scopeManager->findOrCreate(ProductVisibility::getScopeType(), [
        ScopeCriteriaProvider::WEBSITE => $website,
    ]);

Scope Criteria Providers
^^^^^^^^^^^^^^^^^^^^^^^^

A scope criteria provider is a service that calculates the value for the scope criteria based on the provided context. Scope criteria help model a relationship between the scope and the scope-consuming context. In any bundle, you can create a :ref:`scope criteria provider <scope-criteria-providers-configuration>` service and register it as scope provider for the specific scope type. This service shall deliver the scope criteria values to the scope manager, which, in turn, uses the scope criteria to filter the scope instances or find the one matching to the provided context.

Scope Type
^^^^^^^^^^

A scope type is a tag that groups scope providers that are used by particular scope consumers. One scope provider may be reused in several scope types. It may happen, that a particular scope criteria provider, like the one for a customer group, is not involved in the scope construction, because it serves the scope-consumers with the different scope type (e.g., web_content). In this case, the scope manager searches the scope(s) that do(es) not prompt to evaluate this criterion.

Scope Model
^^^^^^^^^^^

A scope model is a data structure for storing scope items. Every scope item has fields for every scope criterion registered by the scope criteria provider services. When the scope criterion is not involved in the scope (based on the scope type), the value of the field is NULL.

Add Scope Criteria
^^^^^^^^^^^^^^^^^^

To add criteria to the scope, extend the scope entity using migration, as shown in the following example:

.. code-block:: php


    class OroCustomerBundleScopeRelations implements Migration, ScopeExtensionAwareInterface
    {
        use ScopeExtensionAwareTrait;

        /**
         * {@inheritdoc}
         */
        public function up(Schema $schema, QueryBag $queries)
        {
            $this->scopeExtension->addScopeAssociation(
                $schema,
                'customer',
                OroCustomerBundleInstaller::ORO_CUSTOMER_TABLE_NAME,
                'name'
            );
        }
    }


.. _scope-criteria-providers-configuration:

Configure Scope Criteria Providers
----------------------------------

To extend a scope with a criterion that may be provided by your bundle:

1. Create a class that implements |ScopeCriteriaProviderInterface|,
   as shown in the following example:

.. code-block:: php


    class ScopeUserCriteriaProvider implements ScopeCriteriaProviderInterface
    {
        public const USER = 'user';

        private TokenStorageInterface $tokenStorage;

        public function __construct(TokenStorageInterface $tokenStorage)
        {
            $this->tokenStorage = $tokenStorage;
        }

        /**
         * {@inheritdoc}
         */
        public function getCriteriaField()
        {
            return self::USER;
        }

        /**
         * {@inheritdoc}
         */
        public function getCriteriaValue()
        {
            $token = $this->tokenStorage->getToken();
            if (null !== $token) {
                $user = $token->getUser();
                if ($user instanceof User) {
                    return $user;
                }
            }

            return null;
        }

        /**
         * {@inheritdoc}
         */
        public function getCriteriaValueType()
        {
            return User::class;
        }
    }


2. Register the created provider as a service tagged with the `oro_scope.provider` tag, like in the following example:

.. code-block:: yaml


    oro_customer.customer_scope_criteria_provider:
        class: Oro\Bundle\CustomerBundle\Provider\ScopeCustomerCriteriaProvider
        tags:
            - { name: oro_scope.provider, scopeType: web_content, priority: 200 }


.. note:: The same provider can be used in many scope types.

.. _scopes-use-context:

Use Context
-----------

When you need to find a scope based on the information that differs from the current context, you can pass the custom context (array or object) as a second parameter of the *find* and *findOrCreate* method.

.. _scopes-scope-operations:

Scope Operations
----------------

The scope manager exposes the following operations for the scope-consuming bundles:

* Find the scope by the context (when the context is provided), or

* Find the scope by current data (when the context is NULL)

.. code-block:: php


    $scopeManager->find($scopeType, $context = null)


Find the scope or create a new one, if it is not found

.. code-block:: php


    $scopeManager->findOrCreate($scopeType, $context = null)


Get the default scope (returns a scope with empty scope criteria)

.. code-block:: php


    $scopeManager->findDefaultScope()


Get all scopes that match the given context. When some scope criteria are not provided in the context, the scopes are filtered by the available criteria.

.. code-block:: php


    $scopeManager->findRelatedScopes($scopeType, $context = null);

.. _scopes-use-related-scopes:

Example: Use Related Scopes
---------------------------

For example, let's create the following scope criteria providers and register them for the *web_content* scope type.

* ScopeCustomerCriteriaProvider (priority:200)

* ScopeWebsiteCriteriaProvider (priority:100)

.. note:: The third ScopeCustomerGroupCriteriaProvider is NOT involved in the scope type, so the scope will be filtered to have no CustomerGroup criteria defined.

The scope model has three fields:

.. code-block:: php


    class Scope
    {
        protected $customer;
        protected $customerGroup;
        protected $website;
        ...
    }


and the existing scopes in the scope repository are as follows:

.. csv-table::
   :header: "id", "customer_id", "customer_group_id", "website_id"

   "1","1","","1"
   "2","2","","1"
   "3","1","","2"
   "4","1","",""
   "5","","1","1"
   "6","","1",""


In order to fetch all scopes that match the customer with id equal to 1, you can use findRelatedScopes and pass *web_content* and 'customer'=>1 in the parameters.

.. code-block:: php


    $context = ['customer' => 1];
    $scopeManager->findRelatedScopes('web_content', $context)


We may or may not know other scope criteria that are available for this scope type. The scope manager fills in the blanks and adds the *criterion IS NOT NULL* condition for any scope criterion we do not have in the context. For our example, the scope manager's query looks like:

.. code-block:: sql


    WHERE customer_id = 1 AND website_id IS NOT NULL AND customer_group_id IS NULL;


where:

* **customer_id** - is a parameter provided in the context
* **website_id** - is not provided, but it is required based on the scope type
* **customer_group_id** - should be missing (NULL) in the scope, as it does not participate in the scope type.

The resulting scopes delivered to the scope consumer by the scope manager are:

.. csv-table::
   :header: "id", "customer_id", "customer_group_id", "website_id"

   "1","1","","1"
   "3","1","","2"


.. _scopes-use-scope-criteria:

Example: Use Scope Criteria
---------------------------

When the slug URLs are linked to the scopes, in a many-to-many way, and we need to find a slug URL related to the scope with the highest priority, fitting best for the current context, this is what happens:

The scope criteria providers are already registered in the *service.yml* file:

.. code-block:: yaml


    oro_customer.customer_scope_criteria_provider:
        class: Oro\Bundle\CustomerBundle\Provider\ScopeCustomerCriteriaProvider
        tags:
            - { name: oro_scope.provider, scopeType: web_content, priority: 200 }

    oro_customer.customer_group_scope_criteria_provider:
        class: Oro\Bundle\CustomerBundle\Provider\ScopeCustomerGroupCriteriaProvider
        tags:
            - { name: oro_scope.provider, scopeType: web_content, priority: 100 }


In this code example, we build a query and modify it with the ScopeCriteria methods:

.. code-block:: php


    $qb->select('slug')
        ->from(Slug::class, 'slug')
        ->innerJoin('slug.scopes', 'scopes')
        ->where('slug.url = :url')
        ->setParameter('url', $slugUrl)
        ->setMaxResults(1);

    $scopeCriteria = $this->scopeManager->getCriteria('web_content');
    $scopeCriteria->applyToJoinWithPriority($qb, 'scopes');

As you do not pass the context to the scope manager in the getCriteria method, the current context is used by default (e.g., a logged-in customer is part of Customer with id=1, and this customer is part of CustomerGroup with id=1).

The scopes applicable for the current context are:

.. csv-table::
   :header: "id", "customer_id", "customer_group_id"

   "4","1",""
   "6","","1"


Here is the resulting modified query:

.. code-block:: sql


    SELECT slug.*
    FROM oro_redirect_slug slug
    INNER JOIN oro_slug_scope slug_to_scope ON slug.id = slug_to_scope.slug_id
    INNER JOIN oro_scope scope ON scope.id = slug_to_scope.scope_id
        AND (
            (scope.customer_id = 1 OR scope.customer_id IS NULL)
            AND (scope.customer_group_id = 1 OR scope.customer_group_id IS NULL)
            AND (scope.website_id IS NULL)
        )
    WHERE slug.url = :url
    ORDER BY scope.customer_id DESC, scope.customer_group_id DESC
    LIMIT 1;


Now, let's add another scope criterion provider to `WebsiteBundle` for the *web_content* scope type and see how the list of scopes and the modified query change.

In the bundle's *service.yml* file, we add:

.. code-block:: yaml


    oro_website.website_scope_criteria_provider:
        class: Oro\Bundle\WebsiteBundle\Provider\ScopeCriteriaProvider
        tags:
            - { name: oro_scope.provider, scopeType: web_content, priority: 100 }


In the current context, the website id is 1, and the scopes of the web_content type are:

.. csv-table::
   :header: "id", "customer_id", "customer_group_id", "website_id"

   "1","1","","1"
   "4","1","",""
   "5","","1","1"
   "6","","1",""

The updated query is automatically changed to the following one:

.. code-block:: none


    SELECT slug.*
    FROM oro_redirect_slug slug
    INNER JOIN oro_slug_scope slug_to_scope ON slug.id = slug_to_scope.slug_id
    INNER JOIN oro_scope scope ON scope.id = slug_to_scope.scope_id
        AND (
            (scope.customer_id = 1 OR scope.customer_id IS NULL)
            AND (scope.customer_group_id = 1 OR scope.customer_group_id IS NULL)
            AND (scope.website_id 1 OR scope.website_id IS NULL)
        )
    WHERE slug.url = :url
    ORDER BY scope.customer_id DESC, scope.customer_group_id DESC, scope.website_id DESC
    LIMIT 1;'



.. include:: /include/include-links-dev.rst
   :start-after: begin
