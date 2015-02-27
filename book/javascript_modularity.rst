JavaScript Modularity
=====================

Overview
--------

The Oro Platform uses *Asynchronous Module Definition* in order to provide JavaScript modularity.

    AMD (**A**\ synchronous **M**\ odule **D**\ efinition) – is a concept of creating modular
    JavaScript code with a defined set of dependencies. It defines the order in which resources
    have to be loaded and executed and therefore keeping the global scope clean.

RequireJS
---------

The Oro Platform leverages the `RequireJS`_ library to follow the AMD approach. RequireJS is a
JavaScript library that provides functions to define modules and to declare dependencies on other
modules in a module. A module is like a common JavaScript except that it defines a well-scoped
object and hence does not pollute the global namespace. To use functions from other modules, the
developers uses the RequireJS syntax to list the dependencies a module requires. Instead of
have the need to manually pull the required dependencies into the module, RequireJS ensures that
all dependencies are injected into the module following the `inversion of control`_ principle while
making it possible to load dependencies asynchronously.

.. seealso::

    You can find more information on how to write modular JavaScript using AMD in:

    * `RequireJS API`_
    * `Writing Modular JavaScript`_

.. _module-definition:

RequireJS comes with two important functions that form the backbone of the library:

``define``
    :ref:`Facilitates a module definition. <book-requirejs-defining-a-module>`

``require``
    :ref:`Handles the loading of dependencies in top-level JavaScript files. <book-requirejs-dependency-handling>`

.. _book-requirejs-defining-a-module:

Defining a Module
~~~~~~~~~~~~~~~~~

Each module is defined in its own file using ``define()`` which has the following signature:

.. code-block:: javascript
    :linenos:

    define(
        module_id /*optional*/,
        [dependencies] /*optional*/,
        definition function /*function for instantiating the module or object*/
    );

In its simplest form, a RequireJS module is just an object defining pair-value pairs:

.. code-block:: javascript
    :linenos:

    // foo.js

    define({
        foo: bar,
        foobar: baz,
        baz: function (param) {
            // do something

            return ...;
        }
    });

You can even use a function if you need to do some initialization stuff:

.. code-block:: javascript
    :linenos:

    // foo.js

    define(function () {
        var bar = ...;

        return {
            foo: bar,
            foobar: baz,
            baz: function (param) {
                // do something

                return ...;
            }
        }
    });

.. note::
    Usually, you don't have to define a ``module_id`` since it is automatically derived from the
    path of the file the module is stored in by the `RequireJS optimization tool`_. In the example
    above, the module name would be ``foo`` as it was stored in the ``foo.js`` file.

Usually, your modules will need to work with some code from other modules. For example, a ``bar``
module depends on the previously created ``foo`` module:

.. code-block:: javascript
    :linenos:

    // bar.js
    define(['foo'], function (foo) {
        var baz = ...;
        var bar = foo.baz(baz);

        return bar;
    });

In this example, the list of dependencies specified in the first argument, is resolved by RequireJS
and the resolved modules are then passed as arguments to module function. This way, the ``baz``
function defined in the ``foo`` module can be called by invoking ``baz`` on the ``foo`` variable
which actually holds the ``foo`` module object.

.. _book-requirejs-dependency-handling:

Loading Dependencies with ``require``
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Sometimes, you don't have to define a module, but you need to pull in some dependencies and use
them immediately. For example, your application may require both the ``foo`` and the ``bar`` module
to boot:

.. code-block:: javascript
    :linenos:

    require(['app', 'foo', 'bar'], function (app, foo, bar) {
        app.start(foo.baz(bar));
    });

The usage of ``require()`` almost looks the same as ``define()``, but there are some important
difference to note:

* ``require()`` does not build a module. Thus, you can't specify a module id and nothing will be
  exported.
* The last argument for ``require()`` always is a function that will be executed when all
  dependencies have been loaded. Contrary, the last argument passed to ``define()`` can be an
  object if you don't have to execute any initialization logic. In ``define()``, you cannot omit
  the last argument whereas you don't need it in ``require`` at all and simply use it to load the
  application dependencies, for example.

.. _requirejs-configuration:

Using RequireJS with the Oro Platform
-------------------------------------

The `RequireJSBundle`_ eases the RequireJS integration into an application based on the Oro
Platform. It scans each bundle for a RequireJS configuration file named ``requirejs.yml``
located in its ``Resources/config`` directory.

Such a configuration file can define two sections:

``config``
    :ref:`Configure modules and paths. <book-requirejs-configuration>`

``build``
    :ref:`Customize the build process. <book-requirejs-build-process-customization>`

`RequireJSBundle`_ was developed to simplify RequireJS configuration and
building process. It collects parts of RequireJS configuration
``Resources/config/requirejs.yml`` from the bundles and merges them
into a single config file.

.. _book-requirejs-configuration:

Configuration
~~~~~~~~~~~~~

``shim``
........

Use the `shim`_ option to configure exports and dependencies for JavaScript libraries that don't
support RequireJS, but are loaded in the *traditional* way. For example, the following
configuration defines modules named ``underscore`` (for the Underscore.js library) and ``backbone``
for the Backbone.js library:

.. code-block:: yaml
    :linenos:

    # src/Acme/DemoBundle/Resources/config/requires.yml
    config:
        shim:
            'underscore':
                exports: '_'
            'backbone':
                deps:
                    - 'underscore'
                    - 'jquery'
                exports: 'Backbone'

The ``deps`` option is used to define the list of dependencies (the Backbone.js library requires
the Underscore.js and the jQuery libraries). The ``exports`` option specifies which object will be
exposed by the module.

.. note::

    Use the :ref:`paths option <book-requirejs-config-paths>` to configure the paths where the
    library files can be located.

``map``
.......

Sometimes, you may want to load a different version of a module based on the context it is
required. For example, the `OroUIBundle`_ ships with an extended version of the jQuery library.
Use the `map`_ option to substitute a module ID for a given prefix:

.. code-block:: yaml
    :linenos:

    # src/Acme/DemoBundle/Resources/config/requires.yml
    config:
        map:
            '*':
                'jquery': 'oroui/js/jquery-extend'
            'oroui/js/jquery-extend':
                'jquery': 'jquery'

The example uses the special ``*`` which maps all module prefixes. This means that all modules get
the extended jQuery library from the OroUIBundle. However, since the bundle itself needs the
original version of the library to be able to extend it, it will receive the original version given
that there is the more specific ``oroui/js/jquery-extend`` entry that will take precedence.

.. _book-requirejs-config-paths:

``paths``
.........

The `paths`_ option tells the optimization tool under which locations certain modules can be found:

.. code-block:: yaml
    :linenos:

    # src/Acme/DemoBundle/Resources/config/requires.yml
    config:
        paths:
            'jquery': 'bundles/oroui/lib/jquery-1.10.2.js'
            'underscore': 'bundles/oroui/lib/underscore.js'
            'backbone': 'bundles/oroui/lib/backbone.js'
            'oroui/js/jquery-extend': 'bundles/oroui/js/jquery-extend.js'

.. _book-requirejs-build-process-customization:

Build Process Customization
~~~~~~~~~~~~~~~~~~~~~~~~~~~

You can use the ``build`` option to exclude a module from being included in the build file by the
optimization tool:

.. code-block:: yaml
    :linenos:

    # src/Acme/DemoBundle/Resources/config/requirejs.yml
    build:
        paths:
            'bootstrap': 'empty:'

With this configuration, the ``bootstrap`` module will be loaded from its actual path on runtime.

Full Configuration Example
~~~~~~~~~~~~~~~~~~~~~~~~~~

A full working example of a RequireJS configuration in a bundle can look like this:

.. code-block:: yaml
    :linenos:

    # src/Acme/DemoBundle/Resources/config/requirejs.yml
    config:
        shim:
            # shim configures the exports and dependencies for older, traditional
            # "browser globals" scripts that do not use define() to declare
            # the dependencies and set a module value;
            'jquery-ui':
                deps:
                    - 'jquery'
            'underscore':
                exports: '_'
            'backbone':
                deps:
                    - 'underscore'
                    - 'jquery'
                exports: 'Backbone'
        map:
            # maps for the given module prefix, instead of loading the module with
            # the given ID, substitutes a different module_id;
            '*':
                'jquery': 'oroui/js/jquery-extend'
            'oroui/js/jquery-extend':
                'jquery': 'jquery'
        paths:
            # path mappings for module names not found directly under baseUrl
            'jquery': 'bundles/oroui/lib/jquery-1.10.2.js'
            'jquery-ui': 'bundles/oroui/lib/jquery-ui.min.js'
            'bootstrap': 'bundles/oroui/lib/bootstrap.min.js'
            'underscore': 'bundles/oroui/lib/underscore.js'
            'backbone': 'bundles/oroui/lib/backbone.js'
            'oroui/js/jquery-extend': 'bundles/oroui/js/jquery-extend.js'

    build:
        paths:
            # says not to include bootstrap module into the build file
            'bootstrap': 'empty:'

.. _`RequireJS`: http://requirejs.org/
.. _`inversion of control`: http://en.wikipedia.org/wiki/Inversion_of_control
.. _`RequireJS API`: http://requirejs.org/docs/api.html
.. _`Writing Modular JavaScript`: http://addyosmani.com/writing-modular-js/
.. _`RequireJS optimization tool`: http://requirejs.org/docs/optimization.html
.. _`RequireJSBundle`: https://github.com/orocrm/platform/tree/master/src/Oro/Bundle/RequireJSBundle
.. _`shim`: http://requirejs.org/docs/api.html#config-shim
.. _`map`: http://requirejs.org/docs/api.html#config-map
.. _`OroUIBundle`: https://github.com/orocrm/platform/tree/master/src/Oro/Bundle/UIBundle
.. _`paths`: http://requirejs.org/docs/api.html#config-paths
