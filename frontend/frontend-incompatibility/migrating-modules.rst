Migrating AMD/CJS to ES Modules
===============================

This guide provides examples for migrating UI components built with **jQuery**, **Underscore**, or **Backbone** using **default exports**.
ESM is now the recommended and default module system in OroCommerce 7.0, allowing for clearer syntax, improved tooling support, and more reliable bundling.

Use this document to identify how your existing modules are structured and apply the
appropriate migration pattern. The examples below cover the most common scenarios.

Migrating AMD to ESM
--------------------

The following example demonstrates how to convert a typical AMD module using
``define()`` into an ES Module with ``import`` and ``export default``.

.. code-block:: diff

   -define(['jquery', 'oroui/js/app/views/base/view'], function ($, BaseView) {
   -  'use strict';
   +  import $ from 'jquery';
   +  import BaseView from 'oroui/js/app/views/base/view';

      const FooBarView = BaseView.extend({...});

   -  return FooBarView;
   +  export default FooBarView;
   -});

Migrating CommonJS Modules to ESM
---------------------------------

CommonJS modules using ``require()`` and ``module.exports`` must be rewritten
using the ``import`` syntax and a ``default export``. This results in clearer,
more consistent module definitions.

.. code-block:: diff

   -define(function(require) {
   -  'use strict';

   -  const $ = require('jquery');
   -  const BaseView = require('oroui/js/app/views/base/view');
   +  import $ from 'jquery';
   +  import BaseView from 'oroui/js/app/views/base/view';

      const FooBarView = BaseView.extend({...});

   -  return FooBarView;
   +  export default FooBarView;
   -});

Another example of a situation where ``module.exports`` is used directly:

.. code-block:: diff

   -const $ = require('jquery');
   -const BaseView = require('oroui/js/app/views/base/view');
   +import $ from 'jquery';
   +import BaseView from 'oroui/js/app/views/base/view';

    const FooBarView = BaseView.extend({...});

   -module.exports = FooBarView;
   +export default FooBarView;

Importing ESM Modules from Legacy CJS Code
------------------------------------------

In some projects, migrating all modules to ESM at once may not be feasible. If you need to keep certain modules in CommonJS form, but they must import
an ESM module, note that CommonJS will wrap the imported module. As a result, the value must be accessed via the ``.default`` property.

This is important when using ``require()`` to load an ESM module:

.. code-block:: diff

    define(function(require) {
      'use strict';

      const $ = require('jquery');
      const BaseView = require('oroui/js/app/views/base/view');
   -  const SomeESModue = require('path/to/esm');
   +  const SomeESModue = require('path/to/esm').default;

      const FooBarView = BaseView.extend({...});

      return FooBarView;
    });
