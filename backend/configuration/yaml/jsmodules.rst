.. _reference-format-jsmodules:

JS Modules
==========

+-----------+------------------------------------------------------------+
| Filename  | ``jsmodules.yml``                                          |
+-----------+------------------------------------------------------------+
| Root Node | none                                                       |
+-----------+------------------------------------------------------------+
| Sections  | * `aliases`_                                               |
|           | * `app-modules`_                                           |
|           | * `configs`_                                               |
|           | * `dynamic-imports`_                                       |
|           | * `map`_                                                   |
|           | * `shim`_                                                  |
+-----------+------------------------------------------------------------+

``aliases``
-----------

**type**: ``map``

This section is used when a desired module name does not match the path to the module.
The keys of the map are module names with trailing `$` which are mapped to the actual path of the file that contains the module's source code.
Webpack provides the corresponding syntax and description in its documentation (see |Webpack Resolve Alias|).
Aliases can help import certain modules easily using short names.

.. code-block:: yaml
    :linenos:

    aliases:
        backbone$: npmassets/backbone/backbone
        oro/block-widget$: oroui/js/widget/block-widget

``app-modules``
---------------

**type**: ``sequence``

Introduces a list of modules that should be initialized before application is launched. They can be used to track certain page events with bundle specific handlers, etc.

.. code-block:: yaml
    :linenos:

    app-modules:
        - oroui/js/app/modules/jstree-actions-module
        - oroui/js/app/modules/layout-module

``configs``
-----------

**type**: ``map``

Each module that should be configured at runtime (e.g., via twig templates) must be specified in this section where the key of the map is a module name, and the value is an empty object.

.. code-block:: yaml
    :linenos:

    configs:
        controllers/page-controller: {}
        oroui/js/app: {}

``dynamic-imports``
-------------------

**type**: ``map``

Add a module name to this section to be able to import a module with the name that is determined at runtime.

.. code-block:: javascript
    :linenos:

    import loadModules from 'oroui/js/app/services/load-modules';

    loadModules(moduleName).then(module => module.init());

Insert a module name to this section nested into the subsection with the name of webpack build chunk where modules have to be added.

.. code-block:: yaml
    :linenos:

    dynamic-imports
        oroui:
            - jquery
            - oroui/js/app/components/view-component

.. note::

    A chunk name should either be a new name or already exist in another bundle.
    It is preferred to group modules that are used together or/and on specific pages for the maximum benefit of the webpack chunk concept.

.. _reference-format-jsmodules-map:

``map``
-------

**type**: ``map``

The map option allows to substitute a module with the given ID with a different module. Such substitution is working for the given module prefix.

For example, |OroUIBundle| is delivered with an extended version of the jQuery library. This means
that all modules should receive the extended jQuery library from the OroUIBundle. However, since
the bundle itself needs the original version of the library to be able to extend it, it must get
the original version when requiring it:

.. code-block:: yaml
    :linenos:

    map:
        '*':
            'jquery': 'oroui/js/jquery-extend'
        'oroui/js/jquery-extend':
            'jquery': 'jquery'

.. tip::

    ``*`` is a special key that matches all module contexts.

``shim``
--------

**type**: ``map``

Webpack places each module in its local scope, however, some third party libraries may expect global dependencies (e.g., $ for jQuery). The libraries may also create globals which need to be exported, so they can stop working. To solve this issue, webpack offers a shimming feature. See |Webpack Shimming|
In our `shim` section, each key of the map is the name of a module to be created. For each module, a map that
configures the module must be specified. It can consist of the following keys:

``imports`` (**type**: ``sequence``)

    If the library depends on specific global variables, these dependencies can be listed here. See |Webpack Imports Loader| for the detail.

``exports`` (**type**: ``string``)

    The name of a JavaScript symbol that is exposed to other parts of the system that use this symbol. See |Webpack Exports Loader| for the details.

``expose`` (**type**: ``sequence``)

    Specify which local variables have to be exposed globally. See |Webpack Expose Loader| for the details.

.. code-block:: yaml
    :linenos:

    shim:
        bootstrap-typeahead:
            imports:
                - jQuery=jquery
        jquery:
            expose:
                - $
                - jQuery
        jquery.select2:
            exports: Select2
            imports:
                - jQuery=jquery
        oroui/js/app/services/app-ready-load-modules:
            expose: loadModules

.. include:: /include/include-links-dev.rst
   :start-after: begin

