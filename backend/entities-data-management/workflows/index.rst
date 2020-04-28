.. _dev-doc--workflows:

Workflows
=========

In a business application, a ``workflow`` is a sequence of steps or rules applied to a process from its initiation to completion.
In Oro applications, workflows organize and direct users’ work, making them follow particular steps in a pre-defined order, or preventing them from performing actions that either contradict or conflict with the logical steps of a process.

A workflow ``step`` is a state of an entity record. It is represented by an instance of the :class:`Oro\\Bundle\\WorkflowBundle\\Entity\\WorkflowStep` class.
The process of moving an entity from one step to another is called a ``transition``.

This guide explains and illustrates how to create workflows through configuration files, and provides details on workflow components and their translation.

**Table of Contents**

* :ref:`Introduction <backend--workflows--intro>`
* :ref:`Configuration Reference <backend--workflows--config-reference>`
* :ref:`Basic Workflow Configuration <backend--workflows--create>`
* :ref:`Transition Forms <backend--workflows--transition-forms>`
* :ref:`Managing Elements <backend--workflows--managing-elements>` (:ref:`Actions <backend--workflows--transition-actions>` and :ref:`Conditions <backend--workflows--transition-conditions>`)
* :ref:`Workflow Translations <backend--workflows--translation-wizard>`
* :ref:`Example of Workflow Configuration <backend-workflows-example>`

.. hint:: For information on how to create simple workflows via the user interface (application back-office), see the :ref:`Workflow Management <doc--system--workflow-management>` user guide.

.. toctree::
   :hidden:

   intro
   configuration-reference
   elements
   create
   transition-forms
   translations-wizard
   config-example
