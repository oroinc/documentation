Placeholders ``placeholders.yml``
=================================

+----------+---------------------------------------------------------------------+
| Filename | ``placeholders.yml``                                                |
+----------+---------------------------------------------------------------------+
| Root Node| ``placeholders``                                                    |
+----------+---------------------------------------------------------------------+
| Sections | * :ref:`items <reference-placeholders-section-items>`               |
|          | * :ref:`placeholders <reference-placeholders-section-placeholders>` |
+----------+---------------------------------------------------------------------+

.. _reference-placeholders-section-items:

``items``
---------

**type**: ``map``

The ``items`` option is a map that is used to create named items which will then later be assigned
to different :ref:`placeholders <reference-placeholders-section-placeholders>`. Each key is a
unique key which will later be used to refer to a certain item. The value is a map that controls
how an item will be rendered when being assigned to a placeholder:

``acl``
~~~~~~~

**type**: ``string``

The item will only be rendered if the user is granted access to the configured access control list.

``action``
~~~~~~~~~~

**type**: ``string``

A controller that will be called when rendering the item. This option is useful when some complex
logic needs to be executed when rendering the placeholder item. For simple templates, you should
use the `template`_ option instead.

``applicable``
~~~~~~~~~~~~~~

**type**: ``string``

An expression that will be evaluated at runtime to determine whether or not the item should be
rendered.

``template``
~~~~~~~~~~~~

A template reference that will be included when the item is rendered.

**type**: ``string``

.. _reference-placeholders-section-placeholders:

``placeholders``
----------------

**type**: ``map``

With the ``placeholders`` option you assign your defined :ref:`items <reference-placeholders-section-items>`
to some placeholders. The keys of this map are the names of placeholders items should be assigned
to. Placeholders that do not exist will be ignored. The value of the map is another map with the
only key being ``items``:

``items``
~~~~~~~~~

**type**: ``map``

The map keys are the names of :ref:`defined items <reference-placeholders-section-items>`. The
value can be an optional map with ``order`` being the only allowed key. The value of the ``order``
option controls the order in which multiple items will be rendered within a placeholder. When the
order is not important, the item can be appended to the list of existing items by using ``~`` (the
YAML ``null`` value).
