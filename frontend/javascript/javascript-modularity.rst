.. _dev-doc-frontend-javascript-modularity:

JavaScript Modularity
=====================

Overview
--------

Nowadays Oro uses **ES6** modularity approach as best practices.
However since a build of JS gets made with webpack other types of modules are supported as well (e.g. **AMD**, **CommonJS**).

.. note::
    Since OroPlatform uses ES6 only starting from 4v a lot of legacy **AMD** modules are still present in the code.

ES6 modules (recommended)
-------------------------

ES Modules are the ECMAScript standard for working with modules.
Making components available in other files, we must first export and then import using **export** and **import** keywords.

.. seealso::

    You can find more information on how to write modular JavaScript using ES Modules in:

    * |ECMAScript wiki|
    * |ES6 Modules|

.. code-block:: javascript
    :linenos:

    import BaseEmailVariableView from 'oroemail/js/email/variable/view';

    const MyEmailVariableView = BaseEmailVariableView.extend({
        /* define extended logic here */
    };

    export default MyEmailVariableView

.. note::
    We recommend to use this solution because it gives benefits like: automatically resolving cyclic dependencies,
    readable syntax, possibility to import module partially etc.

AMD, CommonJS (legacy)
----------------------

AMD (**A**\ synchronous **M**\ odule **D**\ efinition) – is a concept of creating modular
JavaScript code with a defined set of dependencies. It defines the order in which resources
have to be loaded and executed and, therefore, keeping the global scope clean.

.. seealso::

    You can find more information on how to write modular JavaScript using AMD and CommonJS in:

    * |Asynchronous Module Definition|
    * |CommonJS|
    * |Writing Modular JavaScript|

.. code-block:: javascript
    :linenos:

    define(function (require) {
        'use strict';

        const MyEmailVariableView;
        const BaseEmailVariableView = require('oroemail/js/email/variable/view');

        MyEmailVariableView = BaseEmailVariableView.extend({
            /* define extended logic here */
        });

        return MyEmailVariableView;
    });

Loading script from remote resources
------------------------------------

Sometimes you need to download dependency which is not managed by webpack.
For that you may use |scriptjs| library.
It takes care of downloading and evaluating the external script at runtime.

.. code-block:: javascript
    :linenos:

    import scriptjs from 'scriptjs';
    import BaseView from 'oroui/jsbase/view';

    const MyView = BaseView.extend({
        initialize() {
            scriptjs('foo.js', () => {
                // foo.js is ready;

                this.doShomething();
            })
        },

        doShomething() {
            /* do something */
        }
    });

    export default MyView

.. include:: /include/include-links-dev.rst
   :start-after: begin
