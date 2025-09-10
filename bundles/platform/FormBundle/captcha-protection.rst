.. _bundle-docs-platform-form-bundle-captcha:

CAPTCHA Protection
==================

CAPTCHA (Completely Automated Public Turing test to tell Computers and Humans Apart) is a type of security measure known
as challenge-response authentication. The purpose of CAPTCHA is to safeguard forms from spam by requiring completion of a straightforward test that verifies
the user's identity as a human being and not a computer program attempting to gain unauthorized access to the resource.

Protecting Forms with CAPTCHA
-----------------------------

To protect form with CAPTCHA, you can choose one of the following options:

Set ``captcha_protection_enabled`` form option to true. In this case, the form will be protected with CAPTCHA when this type of
protection is enabled and configured.

.. code-block:: php

    namespace Acme\Bundle\DemoBundle\Form\Type;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class UserType extends AbstractType
    {
        // ...

        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults([
                'captcha_protection_enabled' => true
            ]);
        }
    }


To enable or disable the protection of a particular form,  add the DI tag ``oro_form.captcha_protected``
and pass the form name with ``form_name``. The use of the DI tag allows the administrator to configure the protection status
of the form in question. CAPTCHA protection must be enabled and configured. You can also add the `scope_restrictions` attribute to the tag, which specifies the configuration scope where the current form type can be configured. The available scopes are "all," "global," "organization," and "website" (only in Enterprise Edition).

Using a specific scope restriction means that the form configuration options will be available in the current scope and all top-level scopes. For example, a global scope restriction will display form configuration options in app, organization, and website configurations. An organization scope will show options in the organization and website, while the "all" scope will display options across all existing scopes.

If you do not specify the `scope_restriction` attribute in the tag, the form type will be configured with all scope restrictions available.

.. code-block:: yaml
    :caption: src/Acme/Bundle/DemoBundle/Resources/config/services.yml

    services:
        acme.user_type:
            class: 'Acme\Bundle\DemoBundle\Form\Type\UserType'
            tags:
                - { name: form.type }
                - { name: oro_form.captcha_protected, form_name: user_form, scope_restrictions: all }


For correct form listing the translation, make sure that key ``oro_form.captcha.protected_form_name.<form_name>`` is defined.

.. code-block:: yaml
    :caption: src/Acme/Bundle/DemoBundle/Resources/translations/messages.en.yml

    oro_form.captcha.protected_form_name.user_form: Acme User Form


Implementing Custom CAPTCHA service
-----------------------------------

Oro comes with a set of popular CAPTCHA services.
To create a custom service, you need to implement ``Oro\Bundle\FormBundle\Captcha\CaptchaServiceInterface`` and add a form type
that will be responsible for the CAPTCHA form element rendering and optional JS logic implementation.
In addition, you need to define system config options to simplify CAPTCHA service configuration.

.. code-block:: php
    :caption: src/Acme/Bundle/DemoBundle/Captcha/CustomCaptchaService.php

    namespace Acme\Bundle\DemoBundle\Captcha;

    use GuzzleHttp\ClientInterface as HTTPClientInterface;
    use Oro\Bundle\ConfigBundle\Config\ConfigManager;
    use Oro\Bundle\SecurityBundle\Encoder\SymmetricCrypterInterface;
    use Psr\Log\LoggerInterface;
    use Symfony\Component\HttpFoundation\RequestStack;

    class CustomCaptchaService implements CaptchaServiceInterface
    {
        public function __construct(
            protected HTTPClientInterface $httpClient,
            protected LoggerInterface $logger,
            protected ConfigManager $configManager,
            protected SymmetricCrypterInterface $crypter,
            protected RequestStack $requestStack
        ) {
        }

        public function isConfigured(): bool
        {
            return $this->getPrivateKey() && $this->getPublicKey();
        }

        public function isVerified($value): bool
        {
            $request = $this->requestStack->getCurrentRequest();

            try {
                $response = $this->httpClient->request(
                    'POST',
                    'https://captcha-provider.com/siteverify',
                    [
                        'form_params' => [
                            'secret' => $this->getPrivateKey(),
                            'response' => $value,
                            'remoteip' => $request?->getClientIp()
                        ]
                    ]
                );
                $responseData = json_decode($response->getBody()->getContents(), JSON_OBJECT_AS_ARRAY);

                return (bool)($responseData['success'] ?? false);
            } catch (\Exception $e) {
                $this->logger->warning(
                    'Unable to verify CAPTCHA',
                    ['exception' => $e]
                );

                return false;
            }
        }

        public function getPublicKey(): ?string
        {
            return $this->configManager->get('acme_demo.custom_captcha_public_key');
        }

        private function getPrivateKey(): ?string
        {
            $encryptedPrivateKey = $this->configManager->get('acme_demo.custom_captcha_private_key');
            if ($encryptedPrivateKey) {
                try {
                    return $this->crypter->decryptData($encryptedPrivateKey);
                } catch (\Exception) {
                    return null;
                }
            }

            return null;
        }
    }


.. code-block:: php
    :caption: src/Acme/Bundle/DemoBundle/Form/Type/CustomCaptchaType.php

    namespace Acme\Bundle\DemoBundle\Form\Type;

    use Oro\Bundle\FormBundle\Captcha\CaptchaServiceInterface;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\HiddenType;
    use Symfony\Component\Form\FormInterface;
    use Symfony\Component\Form\FormView;

    class CustomCaptchaType extends AbstractType
    {
        public const string NAME = 'acme_custom_captcha_token';

        public function __construct(
            private CaptchaServiceInterface $captchaService
        ) {
        }

        public function finishView(FormView $view, FormInterface $form, array $options)
        {
            $view->vars = array_replace_recursive($view->vars, [
                'attr' => [
                    'data-page-component-module' => 'acme/js/app/components/custom-captcha-component',
                    'data-page-component-options' => json_encode([
                        'site_key' => $this->captchaService->getPublicKey()
                    ])
                ]
            ]);
        }

        public function getParent(): ?string
        {
            return HiddenType::class;
        }

        public function getName(): string
        {
            return $this->getBlockPrefix();
        }

        public function getBlockPrefix(): string
        {
            return static::NAME;
        }
    }

Adding a New Scope Restriction to CAPTCHA Protected Form Services
-----------------------------------------------------------------

To add a new CAPTCHA-protected form scope restriction, call the `addScopeToRestrictionMapping` method in your bundle's compiler pass. Then, use the restriction name in the `scope_restriction` attribute within the `oro_form.captcha_protected` tag to display form options in the required scopes.

.. code-block:: php
    :caption: src/Acme/Bundle/DemoBundle/DependencyInjection/Compiler/CaptchaProtectedFormsCompilerPass.php

    namespace Acme\Bundle\DemoBundle\DependencyInjection\Compiler;

    use Oro\Bundle\OrganizationConfigBundle\Config\OrganizationScopeManager;
    use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
    use Symfony\Component\DependencyInjection\ContainerBuilder;

    class CaptchaProtectedFormsCompilerPass implements CompilerPassInterface
    {
        private const CUSTOM_RESTRICTION_LEVEL = 3;

        public function process(ContainerBuilder $container): void
        {
            $container->getDefinition('oro_form.captcha.protected_forms_registry')
                ->addMethodCall(
                    'addScopeToRestrictionMapping',
                    [
                        'custom', // configuration scope name
                        'custom', // restriction name that used in scope_restrictions tag attribute
                        self::CUSTOM_RESTRICTION_LEVEL // scope restriction level
                    ]
                );
        }
    }
