JavaScript Modularity
=====================

Overview
--------
The Oro Platform uses Asynchronous Module Definition in order to provide JavaScript modularity.

AMD (Asynchronous Module Definition) – is an approach of code development that
enables creation of modular javascript-code with defined set of dependencies,
manages the order of resource loading and execution, keeps the global scope
clean. `RequireJS`_ lib allows to adopt this approach.


Module Definition
-----------------
There are two main methods used to implement the AMD approach in the `RequireJS`_:
 * ``define`` -- facilitates a module definition;
 * ``require`` -- handles dependency loading.

``define`` is used to define named or unnamed modules based on the proposal using
the following signature:

.. code-block:: javascript

    define(
        module_id /*optional*/,
        [dependencies] /*optional*/,
        definition function /*function for instantiating the module or object*/
    );

.. note::

    The ``module_id`` is typically equivalent to a folder path of simple packages,
    so there is no need to define it.

In the general case, the module definition looks as follows:

.. code-block:: javascript

    define(['foo', 'bar'], function (Foo, Bar) {
        var factory = {
            getFoo: function() {
                return new Foo();
            },
            getBar: function() {
                return new Bar();
            }
        };
        return factory;
    });


``require`` on the other hand is typically used to load code in a top-level JavaScript
file or within a module should you wish to dynamically fetch dependencies.

.. code-block:: javascript

    require(['foo', 'bar'], function (foo, bar) {
        // rest of your code here
        foo.doSomething();
    });

You can find more information on how to write modular JavaScript using AMD in:
 * `RequireJS API`_
 * `Writing Modular JavaScript`_

RequireJS Configuration
-----------------------

`RequireJSBundle`_ was developed to simplify RequireJS configuration and
building process. It collects parts of RequireJS configuration
``Resources/config/requirejs.yml`` from the bundles and merges them
into a single config file.

.. code-block:: yaml

    # Resources/config/requirejs.yml
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

There are two root sections:
 * ``config`` -- defines RequireJS configuration
 * ``build`` -- allows to override defined RequireJS configuration for the building process

.. note::
    If there is a need to exclude a module from the build, add its ``module_id`` into the
    ``build.paths`` configuration with the path value ``'empty:'``. This module will be
    excluded from the build file, and will be loaded directly from its path in the runtime.

For more details, `RequireJSBundle`_.

.. _`RequireJS`: http://requirejs.org/
.. _`RequireJS API`: http://requirejs.org/docs/api.html
.. _`Writing Modular JavaScript`: http://addyosmani.com/writing-modular-js/
.. _`RequireJSBundle`: https://github.com/orocrm/platform/tree/master/src/Oro/Bundle/RequireJSBundle


