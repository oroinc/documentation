Workflow
========

+-----------+------------------------------------------------------------------+
| Filename  | ``workflows.yml``                                                |
+-----------+------------------------------------------------------------------+
| Root Node | ``workflows``                                                    |
+-----------+------------------------------------------------------------------+
| Sections  | * `attributes`_                                                  |
|           |                                                                  |
|           |   * :ref:`entity_acl <reference-workflow-attributes-entity-acl>` |
|           |   * :ref:`label <reference-workflow-attributes-label>`           |
|           |   * `options`_                                                   |
|           |   * `property_path`_                                             |
|           |   * `type`_                                                      |
|           |                                                                  |
|           | * `entity`_                                                      |
|           | * `entity_attribute`_                                            |
|           | * `is_system`_                                                   |
|           | * :ref:`label <reference-workflow-label>`                        |
|           | * `start_step`_                                                  |
|           | * `steps`_                                                       |
|           |                                                                  |
|           |   * `allowed_transitions`_                                       |
|           |   * :ref:`entity_acl <reference-workflow-steps-entity-acl>`      |
|           |   * :ref:`label <reference-workflow-steps-label>`                |
|           |   * `is_final`_                                                  |
|           |   * `order`_                                                     |
|           |                                                                  |
|           | * `steps_display_ordered`_                                       |
|           | * `transition_definitions`_                                      |
|           | * `transitions`_                                                 |
|           |                                                                  |
|           |   * `acl_message`_                                               |
|           |   * `acl_resource`_                                              |
|           |   * `dialog_template`_                                           |
|           |   * `display_type`_                                              |
|           |   * `form_options`_                                              |
|           |   * `frontend_options`_                                          |
|           |   * `is_hidden`_                                                 |
|           |   * `is_start`_                                                  |
|           |   * `is_unavailable_hidden`_                                     |
|           |   * `message`_                                                   |
|           |   * `page_template`_                                             |
|           |   * `step_to`_                                                   |
|           |   * `transition_definition`_                                     |
|           |                                                                  |
+-----------+------------------------------------------------------------------+

attributes
----------

**type**: ``map``

During each step transition, a set of entity attributes can be shown to the user for which they can
enter values. Each entry in this map is the name of an attribute which can be configured with a map
that can contain the following options:

.. _reference-workflow-attributes-entity-acl:

``entity_acl``
~~~~~~~~~~~~~~

**type**: ``map``

There are two keys that can be used with this option: If the ``delete`` key is set to ``true``, the
attribute is treated as the name of an ACL that is evaluated to check if the user is allowed to
delete the underlying entity. If ``update`` is set to ``true``, the ACL is used to check for update
permissions.

.. _reference-workflow-attributes-label:

``label``
~~~~~~~~~

**type**: ``string``

The label shown next to the attribute form in the UI.

``options``
~~~~~~~~~~~

**type**: ``map``

There two options which must be configured based on the chosen ``type``:

``class`` (**type**: ``string``)

    A fully qualified class name which is needed when the attribute type is ``entity`` or
    ``object``.

``multiple`` (**type**: ``boolean``)

    When the type is ``entity``, this option control whether or not multiple entities can be
    selected.

.. _reference-format-workflow-attributes-property-path:

``property_path``
~~~~~~~~~~~~~~~~~

**type**: ``string``

An optional property path used to access the attribute's value (if this is set, the other options
can be guessed). You can refer to the underlying entity by a variable whose name is controled with
the :ref:`entity_attribute option <reference-format-workflow-entity-attribute>` (its default value
is ``entity``).

``type``
~~~~~~~~

**type**: ``string``

The attribute's type can be any scalar (``boolean``/``bool``, ``float``, ``int``/``integer``,
``string``), ``array`` (list of scalars or objects that are serializable), ``object`` (a
serializable object) or ``entity`` (FCQN of a Doctrine entity).

entity
------

**type**: ``string``

The fully qualified class name of the entity the workflow is associated with (a workflow can only
be used with exactly one entity type).

.. _reference-format-workflow-entity-attribute:

entity_attribute
----------------

**type**: ``string`` **default**: ``entity``

Name of an attribute used to store main entity.

is_system
---------

**type**: ``boolean``

If this option is set to ``true``, the workflow is treated as built-in which means that it cannot
be modified or removed in the UI.

.. _reference-workflow-label:

label
-----

**type**: ``string``

A human readable string that is used in the UI to distinguish workflows.

start_step
----------

**type**: ``string``

The name of the workflow's start step. The value must refer to one of the steps configured with the
`steps`_ option.

steps
-----

**type**: ``map``

The ``steps`` option configured the states a workflow can have. The keys are step names and each
value is a map that contains options that configure the particular step:

``allowed_transitions``
~~~~~~~~~~~~~~~~~~~~~~~

**type**: ``sequence``

A list of `transitions`_ that can be applied at this stage.

.. _reference-workflow-steps-entity-acl:

``entity_acl``
~~~~~~~~~~~~~~

**type**: ``map``

Two options can be configured under this key to control which kind of actions can be performed in
this step:

``delete`` (**type**: ``boolean``)

    If ``true``, the entity can be removed.

``update`` (**type**: ``bolean``)

    If ``true``, the entity can be modified.

.. _reference-workflow-steps-label:

``label``
~~~~~~~~~

**type**: ``string``

A human-readable string to identify the step in the UI.

``is_final``
~~~~~~~~~~~~

**type**: ``boolean``

This option must be set to ``true`` to identify final workflow states.

``order``
~~~~~~~~~

**type**: ``integer``

Steps are ordered by this value in the workflow steps widget.

steps_display_ordered
---------------------

**type**: ``boolean``

If set to ``true``, all steps will be shown in the workflow step widget in the UI. Otherwise, only
steps that have an `order`_ value less than or equal to the current step will be shown. This is
useful to indicate the following steps of an entity.

transition_definitions
----------------------

**type**: ``map``

transitions
-----------

**type**: ``map``

Transitions define how one step is transformed into another using the following options:

``acl_message``
~~~~~~~~~~~~~~~

**type**: ``string``

A message that will be shown in case the user does not have access granted through the access
control list configured with the `acl_resource`_ option. This option will be translated before
being shown in the UI.

``acl_resource``
~~~~~~~~~~~~~~~~

**type**: ``string``

The id of an access control list a user must be granted access to to perform the transition.

``dialog_template``
~~~~~~~~~~~~~~~~~~~

**type**: ``string`` **default**: ``OroWorkflowBundle:Widget:widget/transitionForm.html.twig``

When the `display_type`_ is ``dialog``, this template will be used to create the page displayed in
the front-end. The template being referenced here should extend the default
``OOroWorkflowBundle:Widget:widget/transitionForm.html.twig`` template.

``display_type``
~~~~~~~~~~~~~~~~

**type**: ``string``

The type of the widget to be shown when the transition is performed. This can be either ``dialog``
or ``page``. When the ``page`` value is used, the `form_options`_ must be configured too.

``form_options``
~~~~~~~~~~~~~~~~

**type**: ``map``

Form options that will be passed to the created form type when the `display_type`_ option is set to
``page``.

``frontend_options``
~~~~~~~~~~~~~~~~~~~~

**type**: ``map``

``is_hidden``
~~~~~~~~~~~~~

**type**: ``boolean``

If ``true``, this transition is hidden from the front-end.

``is_start``
~~~~~~~~~~~~

**type**: ``boolean``

If set to ``true``, this transition can be applied when a workflow is not in a start step. There
must be at least on transition having this option set to ``true`` if the workflow does not have at
least one start step.

``is_unavailable_hidden``
~~~~~~~~~~~~~~~~~~~~~~~~~

**type**: ``boolean``

When the user is not allowed to perform this transition, it will not be displayed in the front-end
when this option is set to ``true``.

``message``
~~~~~~~~~~~

**type**: ``string``

A notification message that will be shown in the front-end before the transition is performed. This
message will be translated before being shown in the UI.

``page_template``
~~~~~~~~~~~~~~~~~

**type**: ``string`` **default**: ``OroWorkflowBundle:Workflow:transitionForm.html.twig``

When the `display_type`_ is ``page``, this template will be used to create the page displayed in
the front-end. The template being referenced here should extend the default
``OroWorkflowBundle:Workflow:transitionForm.html.twig`` template.

``step_to``
~~~~~~~~~~~

**type**: ``string``

The name of the step the workflow is transformed to (this must be one of the keys used in the
`steps`_ option.

``transition_definition``
~~~~~~~~~~~~~~~~~~~~~~~~~

**type**: ``string``

A transition definition to be applied to this transition.
