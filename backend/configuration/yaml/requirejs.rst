.. _reference-format-requirejs:

Require.JS
==========

+-----------+------------------------------------------------------------+
| Filename  | ``requirejs.yml``                                          |
+-----------+------------------------------------------------------------+
| Root Node | none                                                       |
+-----------+------------------------------------------------------------+
| Sections  | * `build`_                                                 |
|           |                                                            |
|           |   * :ref:`paths <reference-format-requirejs-build-paths>`  |
|           |                                                            |
|           | * `config`_                                                |
|           |                                                            |
|           |   * `map`_                                                 |
|           |   * :ref:`paths <reference-format-requirejs-config-paths>` |
|           |   * `shim`_                                                |
+-----------+------------------------------------------------------------+

``build``
---------

**type**: ``map``

By default, all module files will be merged into a large optimized JavaScript file. The ``build``
node can be used to exclude any module from the build file. It's only option is a map named
``paths``.

.. _reference-format-requirejs-build-paths:

``paths``
~~~~~~~~~

**type**: ``map``

With this map, you have to assign every module that should be excluded using the special empty
path:

.. code-block:: yaml
    :linenos:

    # src/Acme/DemoBundle/Resources/config/requirejs.yml
    build:
        paths:
            'bootstrap': 'empty:'

``config``
----------

**type**: ``map``

This node is used to configure where to find all available Require.JS modules. It offers the
following three options:

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

    config:
        map:
            '*':
                'jquery': 'oroui/js/jquery-extend'
            'oroui/js/jquery-extend':
                'jquery': 'jquery'

.. tip::

    ``*`` is a special key that matches all module contexts.

.. _reference-format-requirejs-config-paths:

``paths``
~~~~~~~~~

**type**: ``map``

This option tells the bundle where each module can be found. The keys of the map are module names
which are mapped to the actual path of the file that contains the module's source code.

``shim``
~~~~~~~~

**type**: ``map``

To make legacy libraries available for Require.JS, they can be wrapped as a Require.js module. Each
key of the map is the name of a module to be created. For each module, a map must be specified that
configures the module. It can consist of the following keys:

``deps`` (**type**: ``sequence``)

    If the library depends on other libraries, these dependencies can be listed here. Note that the
    dependencies are treated as Require.js modules. This means that you may have to create more
    modules if your library depends on other traditionall built libraries.

``exports`` (**type**: ``string``)

    The name of a JavaScript symbol that will be exposed to other parts of the system that use this
    module.

.. include:: /include/include-links.rst
   :start-after: begin

