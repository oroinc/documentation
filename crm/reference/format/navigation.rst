Navigation
==========

+-----------+----------------------------+
| Filename  | ``navigation.yml``         |
+-----------+----------------------------+
| Root Node | ``menu_config``            |
+-----------+----------------------------+
| Sections  | * `items`_                 |
|           |                            |
|           |   * `aclResourceId`_       |
|           |   * `attributes`_          |
|           |   * `childrenAttributes`_  |
|           |   * `extras`_              |
|           |   * `label`_               |
|           |   * `labelAttributes`_     |
|           |   * `route`_               |
|           |   * `translateDomain`_     |
|           |   * `translateParameters`_ |
|           |   * `showNonAuthorized`_   |
|           |   * `uri`_                 |
|           |                            |
|           | * `templates`_             |
|           |                            |
|           |   * `allow_safe_labels`_   |
|           |   * `ancestorClass`_       |
|           |   * `currentAsLink`_       |
|           |   * `currentClass`_        |
|           |   * `firstClass`_          |
|           |   * `lastClass`_           |
|           |   * `rootClass`_           |
|           |   * `template`_            |
|           |                            |
|           | * `tree`_                  |
|           |                            |
|           |   * `children`_            |
|           |   * `type`_                |
+-----------+----------------------------+

``items``
---------

**type**: ``map``

Each entry in the map is a new menu item. The keys are used to identify the items. The following
options can be used to configure each menu item:

``aclResourceId``
~~~~~~~~~~~~~~~~~

**type**: ``string``

This is the name of an ACL that a user must be granted access for to see the menu item (unless
``showNonAuthorized`` is enabled).

``attributes``
~~~~~~~~~~~~~~

**type**: ``map``

To customize the generated HTML, you can configure additional HTML attributes:

``class`` (**type**: ``string``)

    A custom HTML class added to the item's HTML element.

``id`` (**type**: ``string``)

    The value of the element's ``id`` attribute.

``childrenAttributes``
~~~~~~~~~~~~~~~~~~~~~~

**type**: ``map``

To customize the generated HTML, you can configure additional HTML attributes for the elements of a
menu item's children:

``class`` (**type**: ``string``)

    A custom HTML class added to the item's HTML element.

``id`` (**type**: ``string``)

    The value of the element's ``id`` attribute.

``extras``
~~~~~~~~~~

**type**: ``map``

Additional options that control the behavior and look-and-feel of the menu item:

``description`` (**type**: ``string``)

    A human-readable description of the item.

``icon`` (**type**: ``string``)

    The name of a `Font Awesome Icon`_ (OroPlatform uses the old 3.2.1 version of the Font
    Awesome Icons).

``position`` (**type**: ``integer``)

    This option defines the position of the item if there are more than one item on the same level.
    Items with lower ``position`` values will be shown before items with higher values.

``routes`` (**type**: ``sequence``)

    A list of route names or route name patterns for which the menu item will be marked as active
    (the item will be marked as active when one of the listed route names is equal to the current
    route or if one of the wildcards matches the name of the current route).

``safe_label`` (**type**: ``boolean`` **default**: ``false``)

    If set to ``true`` and the menu template has the option ``allow_safe_labels`` enabled, the menu
    item's label will not be escaped, but will be printed as is instead.

``label``
~~~~~~~~~

**type**: ``string``

The visible label.

.. tip::

    The label will be passed to the translator. This means that you can also use translation keys
    here.

``labelAttributes``
~~~~~~~~~~~~~~~~~~~

**type**: ``map``

To customize the generated HTML, you can configure additional HTML attributes for the menu item's
label element:

``class`` (**type**: ``string``)

    A custom HTML class added to the item's HTML element.

``id`` (**type**: ``string``)

    The value of the element's ``id`` attribute.

``route``
~~~~~~~~~

**type**: ``string``

The name of the route that is used to generate the URL.

``translateDomain``
~~~~~~~~~~~~~~~~~~~

**type**: ``string``

The translation domain used to translate the menu item label. By default, the ``messages`` domain
is used if you do not configure the domain explicitly.

``translateParameters``
~~~~~~~~~~~~~~~~~~~~~~~

**type**: ``map``

A map of translation parameters passed to the translator's ``trans()`` method when the label is
translated.

``showNonAuthorized``
~~~~~~~~~~~~~~~~~~~~~

**type**: ``boolean`` **default**: ``false``

If enabled, the menu item will be show even if the user is not authorized.

``uri``
~~~~~~~

**type**: ``string``

Instead of linking to a certain route you can also hardcode URLs using the ``uri`` option. If you
want the menu item to act as a placeholder (for example, to nest menu items), you can use ``#`` as
a value for this option.

``templates``
-------------

**type**: ``map``

For each menu item, a template is used to properly render the needed HTML. When you create your own
menu or you want to entirely change the way menu items are rendered, you can define new templates
using the following options of the ``templates`` key. The options are grouped by keys which are
treated as identifiers for the templates.

``allow_safe_labels``
~~~~~~~~~~~~~~~~~~~~~

**type**: ``boolean`` **default**: ``false``

If set to ``false``, menu items can define raw HTML labels that will not be escaped in the template
when the item's ``safe_label`` extra key is set to ``true``.

``ancestorClass``
~~~~~~~~~~~~~~~~~

**type**: ``string``

An HTML class that will be added to all ancestor menu items of the active menu item.

``currentAsLink``
~~~~~~~~~~~~~~~~~

**type**: ``boolean`` **default**: ``true``

If set to ``false``, the currently active menu item cannot be clicked.

``currentClass``
~~~~~~~~~~~~~~~~

**type**: ``string``

The name of an HTML class that will be rendered for the active menu item.

``firstClass``
~~~~~~~~~~~~~~

**type**: ``string``

The HTML class that will be rendered for the first menu item of each level.

``lastClass``
~~~~~~~~~~~~~

**type**: ``string``

The HTML class that will be rendered for the last menu item of each level.

``rootClass``
~~~~~~~~~~~~~

**type**: ``string``

An HTML class that will be added to the HTML element of the menu's root item.

``template``
~~~~~~~~~~~~

**type**: ``string``

The name of the Twig template to render the menu tree.

``tree``
--------

**type**: ``map``

This option hooks the items into existing menus. The keys are the names of existing menus. There is
only one option available:

``children``
~~~~~~~~~~~~

**type**: ``map``

The keys of this map are the names of menu items as created using the `items`_ option. Specify
``~`` (``null``) as the value if the item does not have child items. Otherwise, you can use the
``children`` options as the value to create a nested map of child items.

``type``
~~~~~~~~

**type**: ``string``

The ``type`` option can be used to choose one of the defined `templates`_ to render the menu.

.. caution::

    This option can only be used for the root item of a menu.

.. _`Font Awesome Icon`: http://fontawesome.io/3.2.1/icons/
