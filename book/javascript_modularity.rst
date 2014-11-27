JavaScript Modularity
=====================

Overview
--------
The Oro Platform uses Asynchronous Module Definition for JavaScript modularity.

AMD (Asynchronous Module Definition) – is approach of code-development which
allows to create modular javascript-code with defined set of dependencies,
manages the order of resources loading and execution, keeps global scope
clean. `RequireJS`_ lib allows to adopt this approach.


Module definition
-----------------
There's two main methods in `RequireJS`_ which implements AMD approach:
 * ``define`` - method for facilitating module definition;
 * ``require`` - method for handling dependency loading.

``define`` is used to define named or unnamed modules based on the proposal using
the following signature:

.. code-block:: javascript

    define(
        module_id /*optional*/,
        [dependencies] /*optional*/,
        definition function /*function for instantiating the module or object*/
    );

.. note::

    Since in general ``module_id`` is equivalent to folder paths in simple packages,
    yon have no need to define it.

In common cases module definition looks:

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

More information how to write modular JavaScript using AMD approach you can find:
 * `RequireJS API`_
 * `Writing Modular JavaScript`_

RequireJS Configuration
-----------------------

To help with RequireJS configurations and building process was developed
`RequireJSBundle`_. It collects partial RequireJS configuration by bundles
``Resources/config/requirejs.yml`` and merges them in to single config file.

.. code-block:: yaml

    # Resources/config/requirejs.yml
    config:
        shim:
            # shim configure the dependencies, exports for older, traditional
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
            # the given ID, substitute a different module_id;
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
            # says not to include bootstrap module into build file
            'bootstrap': 'empty:'

There's two root sections:
 * ``config`` -- defines RequireJS configuration
 * ``build`` -- allows to override defined RequireJS configuration for building process

.. note::
    For some reason you may not want to add some module into build, just add ``module_id``
    into ``build.paths`` configuration with path value ``'empty:'``. This module will be
    excluded from build file, and will be loaded directly from it's path during runtime.

For more details see `RequireJSBundle`_.

.. _`RequireJS`: http://requirejs.org/
.. _`RequireJS API`: http://requirejs.org/docs/api.html
.. _`Writing Modular JavaScript`: http://addyosmani.com/writing-modular-js/
.. _`RequireJSBundle`: https://github.com/orocrm/platform/tree/master/src/Oro/Bundle/RequireJSBundle


