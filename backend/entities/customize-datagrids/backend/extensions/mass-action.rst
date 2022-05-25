.. _customize-datagrid-extensions-mass-action:

Mass Action Extension
=====================

The simplest mass action that works out-of-box with datagrids is `delete`. To enable it, add the following into the `datagrids.yml` of the corresponding grid :

.. code-block:: yaml

    datagrids:
        users-grid:
           actions:
               delete:
                   type:         delete
                   label:        oro.grid.action.delete
                   link:         delete_link
                   icon:         trash-o
                   acl_resource: oro_user_user_delete

Empty checkboxes and the `trash` icon will then be displayed in every grid row. By clicking it, you can delete a single current row.
A button with label `...` is displayed on right side of the grid header. By click on it, the `Delete` mass action button appears.
Check every necessary row manually or use the checkbox in the header and click `Delete` to perform the mass action.

If you wish to disable a mass action, specify the following:

.. code-block:: yaml

    datagrids:
        users-grid:
            mass_actions:
                delete:
                    disabled: true

Create Simple Mass Action
-------------------------

Below is an illustration of implementing a simple AJAX mass action for Unlock User on User Management grid.

1. Implement the handler service.

.. code-block:: php
   :caption: src/Acme/Bundle/DemoBundle/Datagrid/Extension/MassAction/UserUnlockHandler.php

   namespace Acme\Bundle\DemoBundle\Datagrid\Extension\MassAction;

   use Doctrine\ORM\EntityManager;
   use Doctrine\ORM\OptimisticLockException;
   use Doctrine\ORM\ORMException;
   use Oro\Bundle\DataGridBundle\Datasource\ResultRecord;
   use Oro\Bundle\DataGridBundle\Extension\MassAction\MassActionHandlerArgs;
   use Oro\Bundle\DataGridBundle\Extension\MassAction\MassActionHandlerInterface;
   use Oro\Bundle\DataGridBundle\Extension\MassAction\MassActionResponse;
   use Oro\Bundle\SecurityBundle\Acl\BasicPermission;
   use Oro\Bundle\SecurityBundle\ORM\Walker\AclHelper;
   use Oro\Bundle\UserBundle\Entity\User;
   use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
   use Symfony\Contracts\Translation\TranslatorInterface;

   class UserUnlockHandler implements MassActionHandlerInterface
   {
       protected const FLUSH_BATCH_SIZE = 100;

       protected AclHelper $aclHelper;
       protected TokenStorageInterface $tokenStorage;
       protected TranslatorInterface $translator;

       protected string $successMessage;
       protected string $errorMessage;

       protected ?User $currentUser;

       /**
        * @param AclHelper             $aclHelper
        * @param TokenStorageInterface $tokenStorage
        * @param TranslatorInterface   $translator
        * @param string                $successMessage
        * @param string                $errorMessage
        */
       public function __construct(
           AclHelper $aclHelper,
           TokenStorageInterface $tokenStorage,
           TranslatorInterface $translator,
           string $successMessage,
           string $errorMessage
       ) {
           $this->aclHelper      = $aclHelper;
           $this->tokenStorage   = $tokenStorage;
           $this->translator     = $translator;
           $this->successMessage = $successMessage;
           $this->errorMessage   = $errorMessage;
       }

       /**
        * @inheritDoc
        */
       public function handle(MassActionHandlerArgs $args)
       {
           $token = $this->tokenStorage->getToken();
           $count = 0;
           if ($token && $this->currentUser = $token->getUser()) {
               set_time_limit(0);
               $results = $args->getResults();
               $query   = $results->getSource();
               $this->aclHelper->apply($query, BasicPermission::EDIT);
               $em = $results->getSource()->getEntityManager();

               $processedEntities = [];
               foreach ($results as $result) {
                   if ($this->processUser($result)) {
                       $count++;
                   }
                   $processedEntities[] = $result->getRootEntity();
                   if ($count % self::FLUSH_BATCH_SIZE === 0) {
                       $this->finishBatch($em, $processedEntities);
                       $processedEntities = [];
                   }
               }

               $this->finishBatch($em, $processedEntities);
           }

           $this->currentUser = null;

           return $count > 0
               ? new MassActionResponse(true, $this->translator->trans($this->successMessage, [
                   '%count%' => $count
               ]))
               : new MassActionResponse(false, $this->translator->trans($this->errorMessage, [
                   '%count%' => $count
               ]));
       }

       /**
        * @param ResultRecord $result
        *
        * @return bool
        */
       protected function processUser(ResultRecord $result): bool
       {
           $user = $result->getRootEntity();
           if (!$user instanceof User) {
               return false; //unexpected result record
           }
           if ($user->getId() === $this->currentUser->getId()) {
               return false; //disable operation on current user
           }
           if ($user->isEnabled()) {
               return false; //do not count not affected records
           }

           $user->setEnabled(true);

           return true;
       }

       /**
        * @param EntityManager $em
        * @param User[] $processedEntities
        * @throws OptimisticLockException
        * @throws ORMException
        */
       protected function finishBatch(EntityManager $em, array $processedEntities): void
       {
           foreach ($processedEntities as $entity) {
               $em->flush($entity);
               $em->detach($entity);
           }
       }
   }

2. Register the handler service.

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/config/services.yml

   services:
       Acme\Bundle\DemoBundle\Datagrid\Extension\MassAction\UserUnlockHandler:
           public: true
           arguments:
               - '@oro_security.acl_helper'
               - '@security.token_storage'
               - '@translator'
               - 'acme.demo.mass_actions.unlock_user.success_message'
               - 'acme.demo.mass_actions.unlock_user.error_message'

3. Configure mass action for Datagrid.

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/datagrids.yml

   datagrids:
       users-grid:
           mass_actions:
               unlock_user:
                   type: ajax
                   label: acme.demo.mass_actions.unlock_user.label
                   # required, should be valid service
                   handler: Acme\Bundle\DemoBundle\Datagrid\Extension\MassAction\UserUnlockHandler
                   # optional for AJAX mass actions
                   route: oro_datagrid_mass_action
                   route_parameters: [ ]
                   icon: unlock
                   data_identifier: u.id
                   object_identifier: u
                   defaultMessages:
                       confirm_title: acme.demo.mass_actions.unlock_user.confirm_title
                       confirm_content: acme.demo.mass_actions.unlock_user.confirm_content
                       confirm_ok: acme.demo.mass_actions.unlock_user.confirm_ok
                   allowedRequestTypes: [ POST ]
                   requestType: POST
                   acl_resource: oro_user_user_update

.. note::

    - `allowedRequestTypes` is intended to use for the mass action request server-side validation. If it is not specified, the request is compared to the `GET` method.
    - `requestType` is intended to be used for mass action to override the default HTTP request type `GET` to one from the allowed types. If it is not specified, the `GET` type is used.

Alternatively, you can configure a mass action with operations. See :ref:`Operations <bundle-docs-platform-action-bundle-operations>` on how to configure them.

4. Add translations for the mass action label and the response message.

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resource/translations/messages.en.yml

   acme:
       demo:
           mass_actions:
               unlock_user:
                   success_message: "{0} Can't unlock selected user(s)|[1,Inf[%count% user(s) were unlocked"
                   error_message: "{0} Can't unlock selected user(s)|[1,Inf[%count% user(s) were unlocked"
                   label: Unlock

5. Add translations for the mass action modal. To actualize js translations, run ``oro:translation:dump``.

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resource/translations/jsmessages.en.yml

   acme:
       demo:
           mass_actions:
               unlock_user:
                   label: Unlock Users
                   confirm_title: Unlock Users
                   confirm_content: Selected users will be unlocked.
                   confirm_ok: Yes, Unlock

6. View results on the ``/admin/users`` page.

    .. image:: /img/backend/entities/datagrid_mass_action_grid.png
       :scale: 100%
       :alt: Mass action button on a grid toolbar

Register Custom Mass Action Type
--------------------------------

In case of a more complicated mass action logic, register your service with the ``oro_datagrid.extension.mass_action.type`` tag:

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/config/services.yml

   services:
      Acme\Bundle\DemoBundle\Datagrid\Extension\MassAction\CustomTypeAction:
         shared: false
         tags:
            - { name: oro_datagrid.extension.mass_action.type, type: custom_type }

Next, implement the custom type logic. The example below defines the required options, the default options and the request types logic:

.. code-block:: php
   :caption: src/Acme/Bundle/DemoBundle/Datagrid/Extension/MassAction/CustomTypeAction.php

   namespace Acme\Bundle\DemoBundle\Datagrid\Extension\MassAction;

   use Oro\Bundle\DataGridBundle\Extension\Action\ActionConfiguration;
   use Oro\Bundle\DataGridBundle\Extension\MassAction\Actions\AbstractMassAction;
   use Symfony\Component\HttpFoundation\Request;

   class CustomTypeAction extends AbstractMassAction
   {
       /** @var array */
       protected $requiredOptions = ['handler'];

       /**
        * @inheritDoc
        */
       public function setOptions(ActionConfiguration $options)
       {
           if (empty($options['frontend_handle'])) {
               $options['frontend_handle'] = 'ajax';
           }

           if (empty($options['route'])) {
               $options['route'] = 'oro_datagrid_mass_action';
           }

           if (empty($options['route_parameters'])) {
               $options['route_parameters'] = [];
           }

           if (!isset($options['confirmation'])) {
               $options['confirmation'] = true;
           }

           return parent::setOptions($options);
       }

       /**
        * @inheritDoc
        */
       protected function getAllowedRequestTypes(): array
       {
           return [Request::METHOD_POST];
       }

       /**
        * @inheritDoc
        */
       protected function getRequestType(): string
       {
           return Request::METHOD_POST;
       }
   }
