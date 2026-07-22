.. _bundle-docs-platform-email-bundle-templates-security-policy:

Email Template Security Policy Checking
=======================================

|OroEmailBundle| validates email templates against the Twig sandbox security policy before they are
saved or rendered. The mechanism performs static analysis of each template field — by default
``subject`` and ``content`` — and reports disallowed tags, filters, functions, and entity property or
method accesses as structured violations. At render time, any access that slips through validation is
caught gracefully so that a non-compliant template does not break the rendering pipeline.

Architecture
------------

The following classes form the security policy checking subsystem:

``Oro\Bundle\EmailBundle\Twig\SecurityPolicy\EmailTemplateSecurityPolicyCheckerInterface``
   Public interface for the email-template security checker. Accepts an ``EmailTemplateInterface`` and
   returns a list of ``EmailTemplateSecurityPolicyViolationInterface`` objects.

``Oro\Bundle\EmailBundle\Twig\SecurityPolicy\EmailTemplateSecurityPolicyChecker``
   Implements the interface. For each configured template field it resolves the associated entity class,
   dispatches ``EmailTemplateSecurityPolicyCheckBefore`` so listeners can enrich the variable-type map,
   then delegates to ``TemplateSecurityPolicyChecker`` (from OroEntityBundle). Raw
   ``SecurityPolicyViolationInterface`` results are wrapped in email-specific violation objects that also
   carry the field name where the violation was found. Checked fields can be overridden at any time by
   calling ``setEmailTemplateFields()``.

``Oro\Bundle\EmailBundle\Twig\SecurityPolicy\Violation\EmailTemplateSecurityPolicyViolationInterface``
   Extends ``SecurityPolicyViolationInterface`` with a ``getTemplateField()`` method that identifies
   which email template field (e.g., ``subject`` or ``content``) contained the violation. Concrete
   subtypes exist for each violation kind: tag, filter, function, property, and method.

``Oro\Bundle\EmailBundle\Validator\Constraints\EmailTemplateSecurityPolicy``
   Symfony Validator constraint applied at the class level on ``EmailTemplateInterface`` implementations.
   Defines five error codes (one per violation kind) and five configurable message translation keys.

``Oro\Bundle\EmailBundle\Validator\Constraints\EmailTemplateSecurityPolicyValidator``
   Constraint validator. Validates the default template and every non-fallback localized translation
   by calling ``EmailTemplateSecurityPolicyCheckerInterface::checkSecurityPolicy()``. Each violation
   is reported as a Symfony constraint violation with a message tailored to the violation kind.
   Twig syntax errors (``SyntaxError``) are silently ignored — syntax validation is handled separately.

``Oro\Bundle\EmailBundle\SecurityPolicyInspector\EmailTemplateSecurityPolicyInspector``
   High-level service used by the console command. Loads templates from the database (one by name or
   all) and runs validation through the Symfony Validator using the ``EmailTemplateSecurityPolicy``
   constraint. Returns ``EmailTemplateSecurityPolicyInspectionResult`` objects, each pairing a template
   with its full ``ConstraintViolationList``.

``Oro\Bundle\EmailBundle\Event\EmailTemplateSecurityPolicyCheckBefore``
   Event dispatched before each security check. Carries the email template being validated and a mutable
   ``variableTypes`` map (variable name to FQCN). Listeners add extra variable type entries to improve
   the accuracy of the static analysis for templates that rely on variables beyond the root entity.

``Oro\Bundle\EmailBundle\Twig\SafeGetAttributeNodeExtension``
   Twig extension registered on the sandboxed email template environment. Its sole purpose is to register
   ``SafeGetAttrNodeVisitor`` so that every attribute access node in the compiled template is replaced
   with the safe variant at compile time.

``Oro\Bundle\EmailBundle\Twig\NodeVisitor\SafeGetAttrNodeVisitor``
   AST node visitor (priority 1, runs after ``GetAttrNodeVisitor``). Replaces every ``GetAttrNode``
   instance in the compiled template AST with a ``SafeGetAttrNode``.

``Oro\Bundle\EmailBundle\Twig\Node\SafeGetAttrNode``
   Overrides the ``attribute()`` method of ``GetAttrNode``. Instead of propagating
   ``SecurityNotAllowedMethodError`` or ``SecurityNotAllowedPropertyError``, it returns ``null``
   and logs the error at the ``error`` level via the ``oro_email`` Monolog channel.

Validating Email Templates
--------------------------

The ``EmailTemplateSecurityPolicy`` constraint can be applied programmatically using the Symfony
Validator component. The constraint is a class-level constraint targeting ``EmailTemplateInterface``
objects:

.. code-block:: php

   use Oro\Bundle\EmailBundle\Validator\Constraints\EmailTemplateSecurityPolicy;
   use Symfony\Component\Validator\Validator\ValidatorInterface;

   // $validator and $emailTemplate are injected or retrieved from the container
   $violations = $validator->validate($emailTemplate, new EmailTemplateSecurityPolicy());

   if (count($violations) > 0) {
       foreach ($violations as $violation) {
           // $violation->getMessage()  - translated error message
           // $violation->getCause()    - EmailTemplateSecurityPolicyViolationInterface instance
       }
   }

The validator checks the default template content and, when an ``EmailTemplate`` entity is provided,
all non-fallback localized translations as well.

To call the checker directly (bypassing Symfony Validator), inject
``oro_email.twig.security_policy.email_template_checker`` and call ``checkSecurityPolicy()``:

.. code-block:: php

   use Oro\Bundle\EmailBundle\Twig\SecurityPolicy\EmailTemplateSecurityPolicyCheckerInterface;

   // $checker is injected via the DI container
   $violations = $checker->checkSecurityPolicy($emailTemplate);

   foreach ($violations as $violation) {
       // $violation->getName()          - disallowed element name
       // $violation->getTemplateField() - 'subject' or 'content'
       // $violation->getEntityClass()   - FQCN (null for tag/filter/function violations)
       // $violation->getTemplateLine()  - source line (-1 when unavailable)
   }

Extending the Security Check
----------------------------

To add extra variable type information for templates that reference variables beyond the root entity,
listen to ``EmailTemplateSecurityPolicyCheckBefore`` and update the variable map:

.. code-block:: php

   use Oro\Bundle\EmailBundle\Event\EmailTemplateSecurityPolicyCheckBefore;
   use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

   #[AsEventListener]
   class MySecurityPolicyListener
   {
       public function __invoke(EmailTemplateSecurityPolicyCheckBefore $event): void
       {
           $variableTypes = $event->getVariableTypes();
           $variableTypes['customer'] = \Acme\Bundle\Entity\Customer::class;
           $event->setVariableTypes($variableTypes);
       }
   }

The listener receives the email template being validated in ``$event->getEmailTemplate()`` and can
inspect it to conditionally add type entries only for relevant templates.

Graceful Rendering of Disallowed Accesses
-----------------------------------------

Even after validation, a template may attempt to access a property or method that is not allowed by
the sandbox policy — for example because the policy changed after the template was saved or because
an edge case was not caught by static analysis. To prevent such accesses from breaking the rendering
pipeline, the sandboxed email template Twig environment registers ``SafeGetAttributeNodeExtension``.

This extension installs ``SafeGetAttrNodeVisitor``, which rewrites every ``GetAttrNode`` in the
compiled template AST to a ``SafeGetAttrNode`` at compile time. When the sandbox denies access at
runtime, ``SafeGetAttrNode`` catches the ``SecurityNotAllowedMethodError`` or
``SecurityNotAllowedPropertyError`` exception, logs the error at the ``error`` level via the
``oro_email`` Monolog channel, and returns ``null`` instead of propagating the exception. For
``is-defined`` tests on denied attributes, it returns ``false``.

The net effect is that a template containing an access violation renders with an empty value for the
offending expression rather than failing entirely. This is intentional — it maintains delivery of
the email while producing a diagnostic log entry that operators can monitor.

Console Command
---------------

The ``oro:email:template:security-policy-check`` console command runs the security policy inspection
against templates stored in the database. See :ref:`CLI Commands (EmailBundle)
<bundle-docs-platform-email-bundle-commands>` for the full command reference and usage examples.

.. include:: /include/include-links-dev.rst
   :start-after: begin
