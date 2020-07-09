.. _dev-doc-frontend-registry:

Registry
========

A registry is a singleton service that allows to share some instances with unique identifiers (with property `globalId`). It takes care of the lifecycle for shared instances, and collects information about those who requested the instance and removes it once the list of applicants gets empty.

Registry API
------------

The `put` method is used to add the objects with the unique `globalId` value to the registry.
The second parameter, `applicant`, is an instance of `PageComponent`, `Model`, `Collection`, `View` or any other instance that has life cycle and triggers `dispose` event at the end.

It is used by the registry to preserve only the objects (instances, passed in a first parameter) that are still in use by any applicant. If all the applicants for the object are disposed, the registry disposes the object as well.                                      

.. code-block:: javascript
   :linenos:

    /**
     * Puts instance into registry
     *
     * @param {{globalId: string}} instance
     * @param {RegistryApplicant} applicant
     * @throws {Error} invalid instance or instance already exists in registry
     */
    put: function(instance, applicant) { ... }


The `globalId` is also used to get the object from the registry:

.. code-block:: javascript
   :linenos:

    /**
     * Fetches instance from registry by globalId
     *
     * @param {string} globalId
     * @param {RegistryApplicant} applicant
     * @return {Object|null}
     */
    fetch: function(globalId, applicant) { ... }


It is pretty common case when these two methods are used together to fetch existing instance or create a new one and return it.

.. code-block:: javascript
   :linenos:

    var registry = require('oroui/js/app/services/registry');
    var BaseClass = require('oroui/js/base-class');
    
    var Unique = BaseClass.extend({
        globalId: null,
        constructor: function(globalIds) {
            this.globalId = globalId;
        }
    }, {
        getObject: function(globalId, applicant) {
            var obj = registry.fetch(globalId, applicant); 
            if (!obj) {
                obj = new Unique(globalId);
                registry.put(obj, applicant);
            }
            return obj;
        }
    });
    
    // and after, inside PageComponent
    
    initialize: function(options) {
        this.obj = Unique.getObject('uniqueKey', this);
    }

There are two other methods that allow maintain the up-to-date information in the list of actual applicants:

.. code-block:: javascript
   :linenos:

    /**
     * Adds applicant relation to registry for instance
     *
     * @param {{globalId: string}} instance
     * @param {RegistryApplicant} applicant
     */
    retain: function(instance, applicant) { ... }

    /**
     * Removes applicant relation from registry for instance
     *
     * @param {{globalId: string}} instance
     * @param {RegistryApplicant} applicant
     */
    relieve: function(instance, applicant) { ... }

If the instance was passed in the options and you need to preserve it in the property for the future use, the
registry has to be notified that the new applicant holds the instance.

.. code-block:: javascript
   :linenos:

        initialize: function(options) {
            this.instance = options.instance;
            registry.retain(this.instance, this); 
        }


When the applicant does not need a shared instance any more, it can notify the registry with `relieve` method:

.. code-block:: javascript
   :linenos:

        disable: function() {
            registry.relieve(this.instance, this);
            delete this.instance;
        }

.. hint::
    See other methods documentation in |registry.js|


.. include:: /include/include-links-dev.rst
   :start-after: begin