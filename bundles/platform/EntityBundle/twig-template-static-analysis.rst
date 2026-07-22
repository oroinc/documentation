.. _bundle-docs-platform-entity-bundle-twig-static-analysis:

Twig Template Static Analysis
=============================

OroEntityBundle provides a static analysis mechanism for Twig templates. It parses a template into an
AST, resolves all property and method accesses on typed variables, and can validate those accesses against
the Twig sandbox security policy. The primary use case is pre-validating user-authored templates before
rendering them in a sandboxed environment.

Architecture
------------

The mechanism is built from the following classes:

``Oro\Bundle\EntityBundle\Twig\Analyzer\TemplateAccessAnalyzer``
   Entry point for static analysis. Accepts a raw template source and a variable-to-FQCN map, tokenizes
   and parses the template, then delegates AST traversal to ``AccessNodeVisitor``. Returns a flat list of
   ``TemplateAccessEntry`` objects — one per resolved property or method access.

``Oro\Bundle\EntityBundle\Twig\Analyzer\AccessNodeVisitor``
   Recursively walks the Twig AST. Tracks variable types through ``for`` loops and ``set`` assignments
   using ``ScopeTracker``, resolves each ``GetAttrExpression`` node via the registered
   ``TypeResolverInterface``, and records a ``TemplateAccessEntry`` for every resolved access.

``Oro\Bundle\EntityBundle\Twig\Analyzer\TemplateAccessEntry``
   Immutable value object representing a single resolved access. Carries the class name (``$className``),
   the template variable name (``$variableName``), the attribute or method name (``$attributeName``),
   the access type (``ACCESS_TYPE_PROPERTY`` or ``ACCESS_TYPE_METHOD``), and the source line number.

``Oro\Bundle\EntityBundle\Twig\Analyzer\ScopeTracker``
   Maintains a stack of variable-to-FQCN maps to support nested scopes introduced by ``{% for %}``
   loops and ``{% set %}`` assignments. Resolves a variable name by searching from the innermost scope
   outward.

``Oro\Bundle\EntityBundle\Twig\Analyzer\TypeResolverInterface``
   Resolves a single attribute access on a given class to a ``ResolvedAccess`` value object that carries
   the canonical attribute name, access type, optional return class, and flags for collections and
   virtual-variable namespaces (``skipAccessEntry``).

``Oro\Bundle\EntityBundle\Twig\Analyzer\ChainTypeResolver``
   Implements ``TypeResolverInterface`` as a chain of responsibility. Iterates the registered resolvers
   in priority order and returns the first non-``null`` result. Used as the primary implementation wired
   in the DI container.

``Oro\Bundle\EntityBundle\Twig\Analyzer\DoctrineTypeResolver``
   Resolves attribute accesses via Doctrine ORM class metadata. Supports both direct property access
   and getter methods (strips the ``get`` prefix and normalises between camelCase and snake_case).
   For association fields it returns the target entity class so that chained accesses can be resolved
   further.

``Oro\Bundle\EntityBundle\Twig\Analyzer\TemplateRendererConfigTypeResolver``
   Resolves virtual variables defined by ``EntityVariablesProviderInterface`` implementations. When an
   attribute name is a namespace prefix of a dotted virtual variable (e.g., ``url`` when ``url.view`` is
   a known variable), it returns a ``ResolvedAccess`` with ``skipAccessEntry = true`` to prevent false
   positive security-policy violations.

``Oro\Bundle\EntityBundle\Twig\Analyzer\NoopResolver``
   Fallback resolver. Returns a generic ``ResolvedAccess`` for any property or method access without
   performing actual type resolution. Useful when type propagation through a chain is not required.

``Oro\Bundle\EntityBundle\Twig\SecurityPolicy\TemplateSecurityPolicyChecker``
   Validates a raw template source against the Twig sandbox security policy. Performs two independent
   checks and combines their results:

   - **Compile-time check** — creates a Twig template object and catches any
     ``SecurityNotAllowedTagError``, ``SecurityNotAllowedFilterError``, or
     ``SecurityNotAllowedFunctionError`` thrown by the sandbox extension.
   - **Static access check** — calls ``TemplateAccessAnalyzer`` for the supplied variable types and
     tests each ``TemplateAccessEntry`` against
     ``SandboxExtension::checkPropertyAllowed()`` or ``SandboxExtension::checkMethodAllowed()``.

   Returns an empty list when the ``SandboxExtension`` is not registered or when no violations are found.
   Throws ``Twig\Error\SyntaxError`` if the template contains syntax errors.

``Oro\Bundle\EntityBundle\Twig\SecurityPolicy\Violation\SecurityPolicyViolationInterface``
   Represents a single sandbox violation. Concrete subtypes cover the five possible violation kinds —
   tag, filter, function, property, and method — each carrying the element name, the template variable
   name (for property/method violations), the entity class, the source line number, and the originating
   Twig exception.

How to Use
----------

Analyzing Template Accesses
^^^^^^^^^^^^^^^^^^^^^^^^^^^

Inject ``TemplateAccessAnalyzer`` and call ``analyzeTemplate()`` with the raw template source and a
variable-to-FQCN map. The method returns a list of ``TemplateAccessEntry`` objects:

.. code-block:: php

   use Oro\Bundle\EntityBundle\Twig\Analyzer\TemplateAccessAnalyzer;
   use Oro\Bundle\EntityBundle\Twig\Analyzer\TemplateAccessEntry;

   // $analyzer is injected via the DI container
   $entries = $analyzer->analyzeTemplate(
       '{{ entity.firstName }} {{ entity.lastName }}',
       ['entity' => \Acme\Bundle\Entity\Contact::class],
   );

   foreach ($entries as $entry) {
       // $entry->className    - FQCN of the class being accessed
       // $entry->variableName - template variable name (e.g., 'entity')
       // $entry->attributeName - property or method name
       // $entry->accessType   - TemplateAccessEntry::ACCESS_TYPE_PROPERTY or ACCESS_TYPE_METHOD
       // $entry->lineNumber   - source line in the template
   }

Checking Security Policy Violations
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Inject ``TemplateSecurityPolicyChecker`` and call ``checkSecurityPolicy()`` with the template source
and an optional variable-to-FQCN map:

.. code-block:: php

   use Oro\Bundle\EntityBundle\Twig\SecurityPolicy\TemplateSecurityPolicyChecker;
   use Oro\Bundle\EntityBundle\Twig\SecurityPolicy\Violation\SecurityPolicyViolationInterface;

   // $checker is injected via the DI container
   $violations = $checker->checkSecurityPolicy(
       '{{ entity.firstName }}',
       ['entity' => \Acme\Bundle\Entity\Contact::class],
   );

   foreach ($violations as $violation) {
       // $violation->getName()         - disallowed element name
       // $violation->getEntityClass()  - FQCN (null for tag/filter/function violations)
       // $violation->getTemplateLine() - source line (-1 when unavailable)
       // $violation->getCause()        - original Twig exception
   }

When no variable types are passed, only the compile-time sandbox check (tags, filters, functions) is
performed. Pass the variable map to also validate property and method accesses.

Wiring Services in the DI Container
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The classes in the ``Analyzer`` namespace are not registered as global services — each consuming bundle
defines its own service tree scoped to the Twig environment it uses. The pattern used by
|OroEmailBundle| is:

.. code-block:: yaml
   :caption: Resources/config/services.yml


   acme.twig.analyzer.doctrine_type_resolver:
       class: Oro\Bundle\EntityBundle\Twig\Analyzer\DoctrineTypeResolver
       arguments:
           - '@doctrine'
       tags:
           - { name: acme.twig.analyzer.type_resolver }

   acme.twig.analyzer.chain_type_resolver:
       class: Oro\Bundle\EntityBundle\Twig\Analyzer\ChainTypeResolver
       arguments:
           - !tagged_iterator acme.twig.analyzer.type_resolver

   acme.twig.analyzer.access_node_visitor:
       class: Oro\Bundle\EntityBundle\Twig\Analyzer\AccessNodeVisitor
       arguments:
           - '@acme.twig.analyzer.chain_type_resolver'

   acme.twig.analyzer.template_access_analyzer:
       class: Oro\Bundle\EntityBundle\Twig\Analyzer\TemplateAccessAnalyzer
       arguments:
           - '@twig'
           - '@acme.twig.analyzer.access_node_visitor'

   acme.twig.security_policy.template_checker:
       class: Oro\Bundle\EntityBundle\Twig\SecurityPolicy\TemplateSecurityPolicyChecker
       arguments:
           - '@twig'
           - '@acme.twig.analyzer.template_access_analyzer'

When the sandbox must run in an isolated Twig environment (e.g., a sandboxed email template renderer),
pass that environment instance instead of ``@twig``.

How to Extend
-------------

Implementing a Custom Type Resolver
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To teach the analyzer about additional attribute types — for example from a custom entity extension or
a non-Doctrine data source — implement ``TypeResolverInterface`` and register the service with the
bundle-specific tag:

.. code-block:: php

   use Oro\Bundle\EntityBundle\Twig\Analyzer\ResolvedAccess;
   use Oro\Bundle\EntityBundle\Twig\Analyzer\TemplateAccessEntry;
   use Oro\Bundle\EntityBundle\Twig\Analyzer\TypeResolverInterface;
   use Twig\Template;

   class AcmeCustomTypeResolver implements TypeResolverInterface
   {
       public function resolve(string $className, string $attributeName, string $twigCallType): ?ResolvedAccess
       {
           if ($twigCallType === Template::ARRAY_CALL) {
               return null;
           }

           if ($className !== \Acme\Entity\Product::class || $attributeName !== 'category') {
               return null;
           }

           return new ResolvedAccess(
               attributeName: $attributeName,
               accessType: TemplateAccessEntry::ACCESS_TYPE_PROPERTY,
               entityClass: \Acme\Entity\Category::class,
           );
       }
   }

Register the resolver with the bundle-specific tag and a ``priority`` to control evaluation order.
Higher priority values run first. ``DoctrineTypeResolver`` uses the default priority (0), so assign
a higher value when the custom resolver must take precedence:

.. code-block:: yaml

   acme.twig.analyzer.custom_type_resolver:
       class: Acme\Bundle\Twig\Analyzer\AcmeCustomTypeResolver
       tags:
           - { name: acme.twig.analyzer.type_resolver, priority: 50 }

``TemplateRendererConfigTypeResolver`` should generally be registered with a higher priority than
``DoctrineTypeResolver`` (for example, priority 100) to prevent false positives for virtual variables
provided by ``EntityVariablesProviderInterface``.

.. include:: /include/include-links-dev.rst
   :start-after: begin
