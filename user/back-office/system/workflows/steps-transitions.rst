:oro_documentation_types: OroCRM, OroCommerce

.. _user-guide--system--workflow-management-steps-transitions:

Configure Workflow Steps, Transitions, and Attributes in the Back-Office
------------------------------------------------------------------------

Each process or action applied to a record is called a workflow transition. On the interface, transitions are usually initiated when a user clicks the corresponding button or icon. There are two types of transitions:

-	Transitions that take a user from one state to another and connect to each step in the workflow.
-	Self-transitions that do not change steps in the workflow.

Every workflow has the **Start** transition that launches the workflow.

A transition can be defined as soon as there is at least one step besides **Start**. However, it is often simpler to define all workflow steps and then all the transitions between them.

.. image:: /user/img/system/workflows/1_transitions_steps.png

Attributes are characteristics of the record. For example, a ZIP code and a street name are attributes of an address. In the course of each transition, you can change some attributes of the processed record.

A workflow may have configuration parameters (also known as variables). For example, the Alternative Checkout workflow includes reviewing of an order by an authorized person. This is usually required only for orders exceeding a certain amount, so the workflow's configuration parameter enables you to set an order subtotal limit that triggers the alternative checkout.

.. image:: /user/img/system/workflows/workflow_set_config_param.png

.. note:: The alternative checkout workflow is available as a |demo extension| and should be installed separately.

If enabled (see the section below), the workflow widget displays the process steps defined in workflow configuration on the record view page. Multiple workflow widgets can be displayed for one record at the same time.

.. image:: /user/img/system/workflows/21_osf_ui_5.png

.. include:: /include/include-links-user.rst
   :start-after: begin

.. include:: /include/include-images.rst
   :start-after: begin