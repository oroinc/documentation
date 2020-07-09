.. _dev-doc-frontend-javascript-unit-tests:

JavaScript UnitTests
====================

Installation
------------

The following software is required to run JS tests:

 - |Node.js| (JavaScript Engine)
 - |Karma| (Test Runner for JavaScript)
 - |Jasmine 3.5| (Behavior-Driven Development Testing Framework)

.. hint:: For instructions on how to install **Node.js**, navigate to the |Node.js official website|.

Once the `node` is installed, install several modules using |Node Packaged Modules| manager by executing the following command from the root folder of your application:

.. code-block:: bash
   :linenos:

    npm install --prefix=vendor/oro/platform/build

Where the `--prefix` parameter specifies the relative path to the `platform/build` directory.

Configuration
-------------

Configuration for the test-run is placed in `build/karma.config.js.dist`.

.. hint:: See more information in the official |Karma documentation|.

It can be useful to create a separate configuration file by copying the `./vendor/oro/platform/build/karma.config.js.dist` file to `./vendor/oro/platform/build/karma.config.js` and modifying it.

Running
-------

To run tests, call the following command:

.. code-block:: bash
   :linenos:

   ./vendor/oro/platform/build/node_modules/.bin/karma start ./vendor/oro/platform/build/karma.conf.js.dist --single-run

Remember to change the path to `platform/build` directory, if it is different in your application.

To run testsuite with a custom configuration, you can use the command line parameters which overwrite the parameters in the configuration file.

There are few custom options added for preparing karma config:

- `--mask` _string_ file mask for Spec files. By default it is `'vendor/oro/**/Tests/JS/**/*Spec.js'` that matches all Spec files in the project within oro vendor directory.
- `--spec` _string_ path for a certain Spec file, if it passed then the search by mask is skipped and the test is run single Spec file.
- `--skip-indexing` _boolean_ allows to skip phase of collection Spec files and reuse the collection from previews run (if it exists).  
- `--theme` _string_ theme name is used to generate webpack config for certain theme. By default it is `'admin.oro'`.

The following extensions can be useful if you use PHPStorm:

- |Karma plugin| helps to run testsuite from IDE and view results there;
- |ddescriber for jasmine| helps to turn off or skip some tests from testsuite quickly.

Writing
-------

.. hint:: See |Jasmine 3.5| documentation for extensive information on writing tests with **Jasmine 3.5**.

The example below illustrates the spec for the `oroui/js/mediator` module:

.. code-block:: js
   :linenos:

   import mediator from 'oroui/js/mediator';
   import Backbone from 'backbone';

   describe('oroui/js/mediator', function () {
       it("compare mediator to Backbone.Events", function() {
           expect(mediator).toEqual(Backbone.Events);
           expect(mediator).not.toBe(Backbone.Events);
       });
   });

karma-jsmodule-exposure
^^^^^^^^^^^^^^^^^^^^^^^

This approach allows to test the public API of a module. But what about

Use the  |karma-jsmodule-exposure| plugin on a fly injects exposing code inside the js-module and provides API to manipulate internal variables:

.. code-block:: js
   :linenos:

    import someModule from 'some/module';
    import jsmoduleExposure from 'jsmodule-exposure';
    
    // get exposure instance for tested module
    var exposure = jsmoduleExposure.disclose('some/module');
    
    describe('some/module', function () {
        var foo;
    
        beforeEach(function () {
            // create mock object with stub method 'do'
            foo = jasmine.createSpyObj('foo', ['do']);
            // before each test, pass it off instead of original
            exposure.substitute('foo').by(foo);
        });
    
        afterEach(function () {
            // after each test restore original value of foo
            exposure.recover('foo');
        });
    
        it('check doSomething() method', function() {
            someModule.doSomething();
    
            // stub method of mock object has been called
            expect(foo.do).toHaveBeenCalled();
        });
    });

Jasmine-jQuery
^^^^^^^^^^^^^^

|Jasmine-jQuery| extends the base Jasmine functionality, specifically it:

 - adds a number of useful matchers, and allows to check the state of a jQuery instance easily
 - applies HTML-fixtures before each test and rolls back the document after tests
 - provides a way to load HTML and JSON fixtures required for a test

However, because `Jasmine-jQuery` requires the full path to a fixture resource, it is better to use `import` to load the fixtures by a related path.

.. code-block:: js
   :linenos:

      import 'jasmine-jquery';
      import $ from 'jquery';
      import html from 'text-loader!./Fixture/markup.html';

      describe('some/module', function () {
          beforeEach(function () {
              // appends loaded html to document's body,
              // after test rolls back it automatically
              window.setFixtures(html);
          });

          it('checks the markup of a page', function () {
              expect($('li')).toHaveLength(5);
          });
      });


.. include:: /include/include-links-dev.rst
   :start-after: begin
