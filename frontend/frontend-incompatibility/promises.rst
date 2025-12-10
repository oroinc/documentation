Using Native Promises Instead of jQuery Deferred
================================================

Starting with OroCommerce 7.0, the frontend framework is transitioning away from ``jQuery Deferred`` in favor of **native Promises**. Native Promises provide
a standardized, modern, and more reliable way to handle asynchronous logic, and they integrate smoothly with newer features, such as **async/await**.

This document shows examples of replacing ``$.Deferred`` and ``$.when`` with equivalent Promise-based patterns.

Replacing initLayout().done() to initLayout().then()
----------------------------------------------------

+-------------------------------------------------------------+-------------------------------------------------------------+
| Before (using .done() method)                               | After (using .then() method)                                |
+=============================================================+=============================================================+
| .. code-block:: javascript                                  | .. code-block:: javascript                                  |
|                                                             |                                                             |
|     import BaseView from 'oroui/js/app/views/base/view';    |     import BaseView from 'oroui/js/app/views/base/view';    |
|                                                             |                                                             |
|     const SomeView = BaseView.extend({                      |     const SomeView = BaseView.extend({                      |
|         render: function() {                                |         render: function() {                                |
|             this.initLayout().done(() => {...});            |             this.initLayout().then(() => {...});            |
|         }                                                   |         }                                                   |
|     });                                                     |     });                                                     |
|                                                             |                                                             |
|     export default SomeView;                                |     export default SomeView;                                |
+-------------------------------------------------------------+-------------------------------------------------------------+

Replacing $.Deferred With Promise
---------------------------------

+-------------------------------------------------------------+-------------------------------------------------------------+
| Before (using $.Deferred)                                   | After (using native Promise)                                |
+=============================================================+=============================================================+
| .. code-block:: javascript                                  | .. code-block:: javascript                                  |
|                                                             |                                                             |
|     function loadData() {                                   |     function loadData() {                                   |
|       var d = $.Deferred();                                 |       return new Promise(function (resolve, reject) {       |
|       $.ajax({                                              |         $.ajax({                                            |
|         url: '/api/data',                                   |           url: '/api/data',                                 |
|         success: function (result) {                        |           success: resolve,                                 |
|           d.resolve(result);                                |           error: function () {                              |
|         },                                                  |             reject('Request failed');                       |
|         error: function () {                                |           }                                                 |
|           d.reject('Request failed');                       |         });                                                 |
|         }                                                   |       });                                                   |
|       });                                                   |     });                                                     |
|       return d.promise();                                   |     }                                                       |
|     }                                                       |                                                             |
|     loadData()                                              |     loadData()                                              |
|       .done(function (result) {                             |       .then(function (result) {                             |
|         console.log('Loaded:', result);                     |         console.log('Loaded:', result);                     |
|       })                                                    |       })                                                    |
|       .fail(function (err) {                                |       .catch(function (err) {                               |
|         console.error(err);                                 |         console.error(err);                                 |
|       });                                                   |       });                                                   |
+-------------------------------------------------------------+-------------------------------------------------------------+

Replacing $.when With Promise.all
---------------------------------

+-------------------------------------------------------------+-------------------------------------------------------------+
| Before (using $.when)                                       | After (using Promise.all)                                   |
+=============================================================+=============================================================+
| .. code-block:: javascript                                  | .. code-block:: javascript                                  |
|                                                             |                                                             |
|     $.when(loadUser(), loadSettings())                      |     Promise.all([loadUser(), loadSettings()])               |
|       .done(function (user, settings) {                     |       .then(function ([user, settings]) {                   |
|         console.log(user, settings);                        |         console.log(user, settings);                        |
|       })                                                    |       })                                                    |
|       .fail(function () {                                   |       .catch(function () {                                  |
|         console.error('Failed');                            |         console.error('Failed');                            |
|       });                                                   |       });                                                   |
+-------------------------------------------------------------+-------------------------------------------------------------+

Using async/await (optional)
----------------------------

Native Promises can also be used with ``async``/``await``, which can simplify
asynchronous code and make it easier to read.

.. code-block:: javascript

    async function init() {
      try {
        const result = await loadData();
        console.log('Loaded:', result);
      } catch (err) {
        console.error(err);
      }
    }

    init();

Summary of mappings
-------------------

.. list-table::
   :header-rows: 1
   :widths: 25 25 40

   * - jQuery Deferred
     - Native Promise
     - Note

   * - ``$.Deferred()``
     - ``new Promise()``
     - Replace custom deferred wrappers.

   * - ``promise.done(fn)``
     - ``promise.then(fn)``
     - Success callback.

   * - ``promise.fail(fn)``
     - ``promise.catch(fn)``
     - Error callback.

   * - ``promise.always(fn)``
     - ``promise.finally(fn)``
     - Runs whether success or failure.

   * - ``$.when(a, b)``
     - ``Promise.all([a, b])``
     - Returns array of results.
