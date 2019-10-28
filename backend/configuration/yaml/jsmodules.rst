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
~~~~~~~~~~~

**type**: ``map``

This section used in case when desired module name doesn't match path to module.
The keys of the map are module names with trailing `$` which are mapped to the actual path of the file that contains the module's source code.
That syntax provided Webpack and described in its documentation (see |Webpack Resolve Alias|).
Aliases can be useful for replacing original module with own one.

.. code-block:: yaml
    :linenos:

    aliases:
        backbone$: npmassets/backbone/backbone
        oro/block-widget$: oroui/js/widget/block-widget

``app-modules``
~~~~~~~~~~~~~~~

**type**: ``sequence``

Presents list of modules that should be initialized before application is started. They can be used for start listening some page events with bundle specific handlers, etc.

.. code-block:: yaml
    :linenos:

    app-modules:
        - oroui/js/app/modules/jstree-actions-module
        - oroui/js/app/modules/layout-module

``configs``
~~~~~~~~~~~

**type**: ``map``

Each module that has to be configurable in runtime (e.g. via twig templates) should be present in this section where key of the map is module name and value is empty object

.. code-block:: yaml
    :linenos:

    configs:
        controllers/page-controller: {}
        oroui/js/app: {}

``dynamic-imports``
~~~~~~~~~~~~~~~~~~~

**type**: ``map``

Add module name in this section to ability import module on runtime into inline scripts or using module name that is passed via twig templates. Place it in this section to subsection with name of webpack build chunk where modules have to be added.

.. code-block:: yaml
    :linenos:

    dynamic-imports
        oroui:
            - jquery
            - oroui/js/app/components/view-component

.. note::

    Chunk name might be new one or already exist in another bundle.
    Please group modules that used together or/and on specific pages for maximum benefit of webpack chunk concept.

.. _reference-format-jsmodules-map:

``map``
~~~~~~~

**type**: ``map``

The map option makes it possible to map module names to other module names depending on the module
context in which they are required.

For example, the |OroUIBundle| ships with an extended version of the jQuery library. This means
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
~~~~~~~~

**type**: ``map``

Webpack puts each module in local scope so a lot of modules that aren't designed to that can stop to work. To solve the problem webpack proposes shimming feature. See |Webpack Shimming|
In our `shim` section each key of the map is the name of a module to be created. For each module, a map must be specified that
configures the module. It can consist of the following keys:

``imports`` (**type**: ``sequence``)

    If the library depends on specific global variables, these dependencies can be listed here. See |Webpack Imports Loader| for detail

``exports`` (**type**: ``string``)

    The name of a JavaScript symbol that will be exposed to other parts of the system that use this. See |Webpack Exports Loader| for detail
    module.

``expose`` (**type**: ``sequence``)

    Here can be pointed which local variables have to be exposed globally. See |Webpack Expose Loader| for detail

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

.. include:: /include/include-links.rst
   :start-after: begin

