Workflow Management
===================

*Used application: OroPlatform 1.0.0*

This article provides description of Workflow Management feature from the point of a user.

Basics
------

Let's start from describing of the main concept and terms.

**Workflow** is a set of ordered actions that can be performed with the specific entity. Workflow allows user to
manage entities, update existing and create new ones. From the user point of view workflow can be described as a
list of buttons that can open forms to fill and save entity data.

Each entity can have unlimited number of workflows related to it, bun only one of them can be active.
Entity can be passed through only one workflow in one time, so it's possible to have several flows for one
entity and switch between them according to requirements. When workflow is deleted all related entities loose relation
with it.

**Step** is a "static" element of workflow. At any given moment of time, the workflow entity must be in some step -
as a consequence, at least one step is mandatory for the workflow. In some cases step can de considered
as a synonym to entity status, but some entities may have both step and status - in this cases it is important to
explain user what purposes they have and what is the difference between them. Each entity passed through workflow
has workflow step.

Workflow can have default step - it means that new entities (which workflow in assigned to) will be created with
started workflow in default step. Also steps can be used to collect statistics and build reports for entities.

**Transition** is a "dynamic" element of workflow. Transitions are used to move from one workflow step to another,
to manipulate workflow data, and to commit some additional actions. The transition can point to the same step
it is initiated from (so called "self-transition"). Each step has transitions attached to it,
and each such transition correspond to button shown on the entity view page. Transition may have ACL resource
that specifies whether with transition should be available for current user. Together steps and transitions form
so called `directed graph`_ where steps are nodes and transitions are arcs.

Starting transition is a special case of transition. Main difference from regular transition is that
it has no starting step. Workflow must have either default step or starting transition.

**Preconditions** are the set of conditions that define whether the transition is available.
Preconditions are checked every time the step view is accessed, and if they are not met, transition button
shall not appear on the step view. Preconditions are also checked when the transition form is committed,
and if they are not met, the transaction is not conducted.
*Preconditions are temporary not available from the interface.*

**Conditions** are additional conditions that are checked only when the transition form is committed,
and they determine whether the transaction will be conducted further, or not.
*Conditions are temporary not available from the interface.*

**Post actions** are actions that are committed after the transaction is conducted
(i.e. the workflow is moved to the step that is determined in the transition). Those actions may include,
but not limited to, creation of another entity, manipulation of the existing entity data, email notifications, etc.
If new created entity has another workflow with default step it will be started automatically.
*Post actions are temporary not available from the interface.*

.. _directed graph: http://en.wikipedia.org/wiki/Directed_graph


Grid Description
----------------


Form Overview
-------------


Example of Workflow
-------------------

FAQ
---



