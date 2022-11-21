.. _backend-security-bundle-access-rules:

Access Rules
============

Symfony security system allows checking access to an existing object by the Authorization Checker's `isGranted` method.

You can also check access to queries, such as Doctrine ORM query or Search query.

Protect ORM Queries
-------------------

To protect ORM queries, an |AclHelper| was implemented. With its help, when you call the `apply` method of the ACL helper with ORM Query Builder or ORM Query, the |AccessRuleWalker| is used
to process the query. This walker modifies the query's AST following the restrictions imposed by access rules.

An access rule is a class that implements the |AccessRuleInterface| interface.

Each access rule modifies expressions of the |Criteria object|.

You can change the behavior of access rules and AccessRuleWalker with additional options that you can set as the third parameter of the `apply` method.

The options that can change the behavior of AccessRuleWalker:

- **checkRootEntity** --- Determines whether the root entity should be protected. The default value is `true`.
- **checkRelations** --- Determines whether entities associated with the root entity should be protected. The default value is `true`.

The options that can change the behavior of access rules:

- **aclDisable** --- Allows to disable the |AclAccessRule|. The default value is `false`.
- **aclCheckOwner** --- Enables checking of the current joined entity if it is the owner of the parent entity.
- **aclParentClass** --- Contains the parent class name of the current joined entity. This option is used together with the check owner option.
- **aclParentField** --- Contains the field name by which the current entity is joined. This option is used together with the check owner option.
- **availableOwnerEnable** --- Enables the |AvailableOwnerAccessRule|. The default value is `false`.
- **availableOwnerTargetEntityClass**  --- The target class name whose access level should be used for the check in |AvailableOwnerAccessRule|.
- **availableOwnerCurrentOwner** --- The owner's ID that should be available even if the ACL check denies access.

To find all possible options, see classes that implement |AccessRuleInterface|.

Criteria Object
---------------

The criteria hold the necessary information about the type of query being checked, the object that should be checked, the access level, additional options, and the expression that should be added to the query to limit access to the given object.

Additional criteria options represent a list of parameters that you can use to modify the behavior of an access rule.

Criteria Expression
-------------------

Each access rule can add expressions that should be applied to limit access to the given object.

Each Expression is a class that implements the |ExpressionInterface| interface.

The following types of expressions are supported:

* |CompositeExpression| contains a list of expressions combined by the AND or OR operations.

* |Comparison| implements the comparison of expressions on the left and right by the given operator.

The following is a list of supported operators:

- **=** - Equality;
- **<>** - Inequality;
- **<** - Less than;
- **<=** - Less than or equal;
- **\>** - Greater than;
- **\>=** - Greater than or equal;
- **IN** - Checks that the left operand matches any value in the list from the right operand;
- **NIN** - Checks that the left operand does not match any value in the list from the right operand;
- **CONTAINS** - For string fields, it checks that the left operand contains a substring from the right operand. For array fields, it checks that any value in the list from the left operand is matched any value in the list from the right operand.

If the value of the expression on the left or right is not the expression object, it is converted to a *value expression*.

* |NullComparison| represents IS NULL or IS NOT NULL comparison expression.

* |Path| expression sets the path to the field. It is usually used as the left operand in the Comparison expression.

* |Value| expression holds the static value. It is usually used as the right operand in the Comparison expression.

* |AccessDenied| package/platform/src/Oro/Bundle/SecurityBundle/AccessRule/Expr/AccessDenied.php) is an expression that denies access to an object.

* |Exists| is an expression that is used to test for the existence of any record in a subquery.

* |Subquery| is used to build a subquery.

* |Association| is used to check access rules by a related association.

Add a New Access Rule
---------------------

To add a new access rule, create a new class that implements |AccessRuleInterface|, for example:

.. code-block:: php

    namespace Acme\Bundle\DemoBundle\AccessRule;

    use Doctrine\Common\Util\ClassUtils;
    use Oro\Bundle\SecurityBundle\AccessRule\AccessRuleInterface;
    use Oro\Bundle\SecurityBundle\AccessRule\Criteria;
    use Oro\Bundle\SecurityBundle\AccessRule\Expr\Comparison;
    use Oro\Bundle\SecurityBundle\AccessRule\Expr\CompositeExpression;
    use Oro\Bundle\SecurityBundle\AccessRule\Expr\Path;

    class ContactAccessRule implements AccessRuleInterface
    {
        /**
         * @inheritDoc
         */
        public function isApplicable(Criteria $criteria): bool
        {
            return true;
        }

        /**
         * @inheritDoc
         */
        public function process(Criteria $criteria): void
        {
            $criteria->andExpression(new Comparison(new Path('source'), Comparison::EQ, 'call'));
        }
    }


Next, the access rule class should be registered as a service with the `oro_security.access_rule` tag:

.. code-block:: yaml

    acme_demo.access_rule.contact:
        class: Acme\Bundle\DemoBundle\AccessRule\ContactAccessRule
        tags:
            - { name: oro_security.access_rule, type: ORM, entityClass: Acme\Bundle\DemoBundle\Entity\Contact }

Here, the `type` and `entityClass` are options for the `oro_security.access_rule` tag used to define conditions when an access rule should be applied.

This example applies the access rule to all ACL-protected ORM queries with the *Contact* entity.

The `oro_security.access_rule` tag options that can be used for any access rule:

- `type` - the query type, e.g. `ORM`.
- `permission` - the ACL permission, e.g. `VIEW`.
- `entityClass` - the FQCN of an entity.
- `loggedUserClass` - the FQCN of a logged-in user.

.. note::
    You can use The`oro_security.access_rule` tag with options specific to a particular access rule. Using options for the `oro_security.access_rule` tag is preferable to implementing logic in the `isApplicable()` method because it allows not to initialize a rule service if it is not applicable. The `isApplicable()` method is intended for complex logic that cannot be achieved via the tag options.

To add additional options you need to create a class that implements |AccessRuleOptionMatcherInterface| and decorate the service `oro_security.access_rule_option_matcher`.

Access Rules Visitor
--------------------

If you want to apply access rule expressions to your type of query, use a class that extends an abstract |Visitor|.

For example,|AstVisitor| converts access rule expressions to Doctrine AST conditions.

Check |AccessRuleWalker| for details on how to use this visitor.

Adding OR Expressions
---------------------

The OR expressions should be added with the lowest priority. If the OR expression is added first, it will effectively function as an AND expression.

.. include:: /include/include-links-dev.rst
   :start-after: begin
