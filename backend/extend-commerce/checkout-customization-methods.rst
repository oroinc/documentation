.. _dev-extend-commerce-mastering-checkouts:

Common Checkout Customization Methods
=====================================

This document provides details on the most common checkout workflow customizations. To customize the checkout process, you can follow two methods. The first method requires modifying the configuration and logic of an existing checkout. The second method involves creating a new checkout workflow with a custom name and then making all the necessary customizations based on that custom name. For the examples provided, let us assume that we have extended a multistep checkout workflow and named the new workflow `acme_demo_checkout`.

.. oro_integrity_check:: e590962369da68ce06c78a1759e479da3491d27a

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/workflows/acme_demo_checkout.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/workflows.yml
        :language: yaml
        :lines: 1-6

Transfer Custom Data from Shopping List to Order with Checkout
--------------------------------------------------------------

The most common checkout change is the addition of new attributes and their display on the checkout form.
As an illustration, let us add the ``external_po_number`` field to the Shopping List and transfer it to the Order:

1. Add an extendable field ``external_po_number`` to the Shopping List, Checkout and Order entities with migration.

   .. oro_integrity_check:: 5d373b119287aadcaeff881b7a348c2f9fccfffe

      .. literalinclude:: /code_examples/commerce/demo/Migrations/Schema/v1_13/AddExternalPoNumberColumn.php
         :caption: src/Acme/Bundle/DemoBundle/Migrations/Schema/v1_13/AddExternalPoNumberColumn.php
         :language: php

2. Define the storage for ``external_po_number`` during the Checkout. Add an extendable field ``external_po_number`` to the Checkout Entity and expose it as an attribute in the Checkout workflow:

      .. oro_integrity_check:: 186cbe40e37fe6ca30e70dcba3f8cab0b15d1e82

         .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/workflows/acme_demo_checkout.yml
            :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/workflows.yml
            :language: yaml
            :lines: 8-9,13-16


.. admonition:: Alternative

    You can define a checkout workflow attribute and store the data in the Workflow Data:

    .. code-block:: yaml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/workflows.yml

        workflows:
            acme_demo_checkout:
                attributes:
                    # Extends the list of attributes of the b2b_flow_checkout.attributes
                    external_po_number:
                        type: string


3. Transfer the ``external_po_number`` value from the Shopping List to the Checkout.

    To transfer the data from the source object to the checkout during the checkout start decorate an action group ``Oro\Bundle\CheckoutBundle\Workflow\ActionGroup\StartShoppingListCheckout`` that is responsible for the start logic:

   .. oro_integrity_check:: f532db6aac5703eba7cf5e453f7c5d95d4589e0d

      .. literalinclude:: /code_examples/commerce/demo/Workflow/ActionGroup/StartShoppingListCheckout.php
         :caption: src/Acme/Bundle/DemoBundle/Workflow/ActionGroup/StartShoppingListCheckout.php
         :language: php

   Make sure you register the service.

   .. oro_integrity_check:: 958ee9061730b0b71be945a6e9743cfdad9f658b

      .. literalinclude:: /code_examples/commerce/demo/Resources/config/services_checkout.yml
         :caption: src/Acme/Bundle/DemoBundle/Resources/config/services.yml
         :language: yaml
         :lines: 1,2-8

.. admonition:: Alternative

    To transfer the data from the source object to the checkout at checkout start, you can decorate or replace the transition service, or add an event listener on the ``oro_workflow.start`` event.


4. Modify the ``place_order`` transition form to include the new attribute.

   a. Add the attribute to the transition form fields

   .. oro_integrity_check:: 6c6f5d72782d78d9349b496dbe5c12c72d3df66c

      .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/workflows/acme_demo_checkout.yml
         :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/workflows.yml
         :language: yaml
         :lines: 8-9,30-31,42-45

   b. Render the new attribute. For more information, see documentation on :ref:`Layouts <dev-doc-frontend-layouts-layout>`.

5. Transfer ``external_po_number`` from the Checkout to the Order during Order placement by adding an event listener to the ``extendable_action.finish_checkout`` event.

   .. oro_integrity_check:: 5d6f81288324cc07a0ecf05a5df1050713b78f6c

      .. literalinclude:: /code_examples/commerce/demo/Workflow/EventListener/FinishCheckoutEventListener.php
         :caption: src/Acme/Bundle/DemoBundle/Workflow/EventListener/FinishCheckoutEventListener.php
         :language: php

   .. oro_integrity_check:: e913d99be7a223dd2bcad2042cd767590be47fe8

      .. literalinclude:: /code_examples/commerce/demo/Resources/config/services_checkout.yml
         :caption: src/Acme/Bundle/DemoBundle/Resources/config/services.yml
         :language: yaml
         :lines: 1,10-12

Add Intermediate Step to Existing Multistep Checkout
----------------------------------------------------

Another frequently implemented Checkout workflow customization is adding a new step to gather additional information.

.. note::
   For simplicity, less important allowed transitions (such as back_to_*) are not listed. Be sure to include them in your customization.

To illustrate such customization, consider a case where only a customer user with manager permissions can place an Order if ``external_po_number`` starts with the **EXT-** prefix.

This scenario covers the following aspects:

- Adding an intermediate step to the existing multistep checkout
- Modifying/extending the transition logic with service-based transitions
- Implementing the ability to direct users to different destinations based on a specific condition
- Adding and checking a new ACL permission

1. Define a new workflow with additional step ``manager_approval``. To reach this step, modify the configuration of the ``place_order`` transition by adding the ``conditional_steps_to`` option and rewriting the ``transition_service``.

2. After this change, if the *external_po_number* field starts with the *EXT-* prefix, buyers without the *acme_demo_checkout_approve* ACL permission cannot proceed with the checkout and are redirected to the *manager_approval* step. Only users with manager permissions will be able to complete orders in this workflow. Managers will also have the ability to place such orders directly from the Order Review step without restrictions.

   .. oro_integrity_check:: 2f64c5679dd5e12d26309f5b091d1fc9209464f1

      .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/workflows/acme_demo_checkout.yml
         :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/workflows.yml
         :language: yaml
         :lines: 1-41

3. Define the ACL permission.

   .. oro_integrity_check:: 304493183c504879abb9eeca6c0bce45118b833f

      .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/acls.yml
         :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/acls.yml
         :language: yaml
         :lines: 1,17-21

4. Change the implementation of the Place Order transition to avoid creating an order when it is now allowed.

   .. oro_integrity_check:: 26ae6af7ea6546f27756f9ebf5fbd1d57c88c7b3

      .. literalinclude:: /code_examples/commerce/demo/Workflow/Transition/PlaceOrder.php
         :caption: src/Acme/Bundle/DemoBundle/Workflow/Transition/PlaceOrder.php
         :language: php

   .. oro_integrity_check:: 3de6c1cd563ee12294f5c167962b6907bb52f8ae

      .. literalinclude:: /code_examples/commerce/demo/Resources/config/services_checkout.yml
         :caption: src/Acme/Bundle/DemoBundle/Resources/config/services.yml
         :language: yaml
         :lines: 1,23-30

Block Checkout Transition Availability or Execution
---------------------------------------------------

To limit the availability and execution of the transition, use workflow guard events, such as ``oro_workflow.pre_announce``, ``oro_workflow.announce``, ``oro_workflow.pre_guard`` and ``oro_workflow.guard``. Thr ``pre_announce`` and ``pre_guard`` events are executed before any transition logic, while  the ``announce`` and ``guard`` are executed immediately after. The ``*announce`` events serve to limit transition availability, whereas the ``*guard`` events are used to limit execution.

The example below illustrates a scenario where customer users belonging to the Guest customer group are not allowed to place orders if the total amount is less than 100 USD. Here, the limit should apply only to ``acme_demo_checkout``.

.. oro_integrity_check:: ce54007840b5f04259d83de45576a6e96eed5083

    .. literalinclude:: /code_examples/commerce/demo/Workflow/EventListener/DisallowCheapOrdersForGuestsEventListener.php
        :caption: src/Acme/Bundle/DemoBundle/Workflow/EventListener/DisallowCheapOrdersForGuestsEventListener.php
        :language: php

.. oro_integrity_check:: 3f644e51f47b8c2692b58d8a3850c051025a3930

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/services_checkout.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/services.yml
        :language: yaml
        :lines: 1,14-21

Import Workflow Configuration Conditionally
-------------------------------------------

Workflow bundle provides different ways to organize workflow configuration. Workflow configuration can be split into separate parts and added to the workflow configuration using the ``imports`` directive.

.. note::
    Consider following the advice below when organizing the checkout workflow configuration:

    * For complex workflows, use imports and to separate different parts of the configuration, such as steps and transitions.
    * For simple workflows with a limited number of changes, keep all configurations in one place.

While developing a workflow, you may find it necessary to switch to a new implementation of transition logic, such as when migrating to service-based transitions. To solve this and retain the option to easily revert to the old implementation, you can import different versions of the transition configuration by including an ``import_condition`` expression. Another potential use for this feature is to load workflow configuration only when a specific 3rd party package is available.

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/workflows.yml

    imports:
        # BC. Load workflows with definition-based transitions
        # when acme_demo.use_transition_services DI parameter is not present or set to false.
        -
            resource: 'workflows/checkout.yml'
            import_condition: "parameter_or_null('acme_demo.use_transition_services') !== true"

        # NEW. Load workflows with transition as a service implementation
        # when acme_demo.use_transition_services DI parameter is present and set to true
        -
            resource: 'workflows/checkout_with_services.yml'
            import_condition: "parameter_or_null('acme_demo.use_transition_services') === true"

Choose Storage for Additional Checkout Data
-------------------------------------------

When working with checkouts, you have three storage options for additional data: **Checkout Entity**, **Workflow Data**, and **Workflow Result**.

The **Checkout Entity** is a suitable storage option for any data useful for the entire checkout workflow or any logic that may use the Checkout entity outside the workflow. Opting for this method means you must add entity migration and execute the update process. This operation requires a DB schema update for non-extend fields and may require downtime.

On the other hand, data can be stored in the WorkflowData when the workflow attribute is configured. This storage is easier to set up and only requires reloading the workflow definition. It is a good option when data is needed in the checkout workflow itself or is specific to that workflow. For instance, if an additional checkout workflow is initiated for a customer group that requires approval, the approval information is specific to that particular checkout with approval workflow and should be stored in the WorkflowData.

There is a third possible place to store workflow data at runtime, the Workflow Result. In YAML-based checkouts, it is used to store variable values for a transition. It can be used to transfer non-persistent data in the WorkflowItem across various logic parts that have access to the WorkflowItem.

.. warning::
    The data stored in the Workflow Result is not persisted and is only available during the execution of the workflow.

Access the WorkflowItem by the Given Workflow Entity
----------------------------------------------------

As illustrated in the examples above, sometimes only the workflow entity is available. In cases when the data is stored in the WorkflowItem, retrieve it from the available workflow entity first. For this, use the ``oro_workflow.manager`` service. For example, to work with data stored in the WorkflowItem, you can modify the ``FinishCheckoutEventListener`` as follows:

.. oro_integrity_check:: dfa85cb64f45494981f56a88dd4633397b874ac2

    .. literalinclude:: /code_examples/commerce/demo/Workflow/EventListener/Alternatives/FinishCheckoutEventListener.php
        :caption: src/Acme/Bundle/DemoBundle/Workflow/EventListener/Alternatives/FinishCheckoutEventListener.php
        :language: php


**Related Articles**

* :ref:`Checkout Customization <bundle-docs-commerce-checkout-bundle--checkout-customization>`
* :ref:`Checkout Finish <bundle-docs-commerce-checkout-bundle--checkout-finish>`
* :ref:`Workflow Configuration Reference <backend--workflows--config-reference>`
* :ref:`Workflow Transition Forms <backend--workflows--transition-forms>`
* :ref:`Workflow Transition Services <backend--workflows--transition-services>`
* :ref:`Workflow Events <backend--workflows--workflow-events>`
* :ref:`Action Groups <bundle-docs-platform-action-bundle-action-groups>`
* :ref:`Layouts <dev-doc-frontend-layouts-layout>`.
