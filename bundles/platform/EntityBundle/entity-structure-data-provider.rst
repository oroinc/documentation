.. _bundle-docs-platform-entity-bundle-entity-structure-data-provider:

EntityStructureDataProvider
===========================

**EntityStructureDataProvider**:

 - provides access over `EntityStructuresCollection` to :ref:`EntityStructure API <dev-entities-structure-data-provider>`.
 - shares the same instance of `EntityStructuresCollection` between providers
 - contains a pack of helper methods to filter and navigate across entity relations

Get the EntityStructureDataProvider instance
--------------------------------------------

Static method `createDataProvider` of `EntityStructureDataProvider` allows to get the provider's instance:

.. code-block:: javascript

    import EntityStructureDataProvider from 'oroentity/js/app/services/entity-structure-data-provider';

        // ...
        initialize(options) {
            var providerOptions = {
                rootEntity: 'Oro\\Bundle\\UserBundle\\Entity\\User'
            };
            EntityStructureDataProvider
                .createDataProvider(providerOptions, this)
                .then(provider => this.provider = provider);
        }

The signature for `createDataProvider` method is the following:

.. code-block:: javascript

    /**
     * Creates instance of data provider and returns it with the promise object
     *
     * @param {Object=} options
     * @param {string} [options.rootEntity] class name of root entity
     * @param {string} [options.filterPreset] name of filter preset
     * @param {Object.<string, boolean>} [options.optionsFilter] acceptable entity's and fields' options
     *  example:
     *      {auditable: true, configurable: true, unidirectional: false}
     * @param {[Object|string]} [options.exclude]
     *  examples:
     *      ['relationType'] - will exclude all entries that has 'relationType' key (means relational fields)
     *      [{type: 'date'}] - will exclude all entries that has property "type" equals to "date"
     * @param {[Object|string]} [options.include]
     *  examples:
     *      ['relationType'] - will include all entries that has 'relationType' key (means relational fields)
     *      [{type: 'date'}] - will include all entries that has property "type" equals to "date"
     * @param {fieldsFilterer} [options.fieldsFilterer]
     * @param {boolean} [options.isRestrictiveWhitelist] - says if only fields from whitelist
     *  has to be represented in results
     * @param {Object.<string, Object.<string, boolean>>} [options.fieldsFilterWhitelist]
     *  whitelist of fields that has NOT to be filtered out
     *  examples:
     *      {'Oro\\Bundle\\UserBundle\\Entity\\User': {groups: true}} - groups field of User entity
     *          has to be included to results, despite it might not pass the filters
     * @param {Object.<string, Object.<string, boolean>>} [options.fieldsFilterBlacklist]
     *  blacklist of fields that HAS to be filtered out
     *  examples:
     *      {'Oro\\Bundle\\UserBundle\\Entity\\User': {groups: true}} - groups field of User entity
     *          has to be excluded from results, despite it might pass the filters
     * @param {Object.<string, Object.<string, Object>>} [options.fieldsDataUpdate]
     *  data update that has to be applied to fields of filtered results
     *  examples:
     *      {'Oro\\Bundle\\UserBundle\\Entity\\User': {
     *          groups: {type: 'enum'},  // groups field of User entity will be represented as enum
     *          viewHistory: {type: 'collection', label: 'View history'} // new field will be added
     *      }}
     * @param {RegistryApplicant} applicant
     * @return {Promise.<EntityStructureDataProvider>}
     */
    createDataProvider: function(options, applicant) { ... }

Where the first argument is the options for the provider:

- `rootEntity` class name of the entity where navigation by fields and relations starts from
- `optionsFilter`, `exclude` and `include` rules allow to define constraints for the entities and the fields that the provider returns
- `fieldsFilterer` custom filter function
- `filterPreset` name of the preconfigured filter
- `isRestrictiveWhitelist` defines mode of whitelist, by default it is not restrictive
- `fieldsFilterWhitelist` and `fieldsFilterBlacklist` allows to define filter strategy for specific fields
- `fieldsDataUpdate` allows to define updates for filtered data

And the second argument is the applicant (who the structure is requested for). It allows to define life cycles of shared `EntityStructuresCollection` instance in registry (see :ref:`registry <dev-doc-frontend-registry>` for details).

The method works asynchronously, it returns provider instance within promise.
The promise assures the instance `EntityStructuresCollection` of the provider already contains
fetched data from the server and the provider is ready to use.

Define Filter's Preset
----------------------

It is common for several providers to use the same filter configuration.
For such cases, you can define filter preset:

.. code-block:: javascript

    EntityStructureDataProvider.defineFilterPreset('workflow', {
        optionsFilter: {unidirectional: false, configurable: true},
        exclude: [
            {relationType: 'manyToMany'},
            {relationType: 'oneToMany'}
        ]
    });

Once the preset is defined, its name can be used to configure the provider:

.. code-block:: javascript

    EntityStructureDataProvider
        .createDataProvider({
            filterPreset: 'workflow',
            include: [{type: 'date'}, {type: 'datetime'}]
        }, applicant)

The direct definition of `fieldsFilterer`, `optionsFilter`, `exclude` and `include` options have higher priority over the defined onr in used `filterPreset`. This allows to customize filter configuration for a certain provider.

Entity tree
-----------

Data provider has magic property `entityTree` that returns linked objects. It allows to navigate over entities and their relations.

.. code-block:: javascript

    console.log(provider.entityTree);
    { // list with enumerable entities
        user: (...),
        organization: (...),
        userrole: (...)
        // ...
    }

    console.log(provider.entityTree.user);
    { // list with enumerable fields of user entity
        id: (...),
        firstName: (...),
        roles: (...)
        // ...
    }

    console.log(provider.entityTree.user.roles);
    { // list with enumerable fields of userrole entity
        id: (...),
        label: (...),
        // ...
    }

    console.log(provider.entityTree.user.roles.label);
    {} // object of non-relation field has no enumerable properties

Each tree node can represent entity or/and field:
 - root nodes are only entities
 - leaf nodes are only fields
 - intermediate nodes are both fields and entities, since they represent relation fields

All nodes have magic properties `__isField` and `__isEntity`.

.. code-block:: javascript

    // root nodes are entity
    console.log(provider.entityTree.user.__isEntity); // true;
    console.log(provider.entityTree.user.__isField); // false;

    // relation-field nodes are both fields and entities
    console.log(provider.entityTree.user.roles.__isEntity); // true;
    console.log(provider.entityTree.user.roles.__isField); // true;

    // leaf nodes are field
    console.log(provider.entityTree.user.roles.label.__isEntity); // false;
    console.log(provider.entityTree.user.roles.label.__isField); // true;

Field nodes have magic property `__field`, that returns information about the field.

.. code-block:: javascript

    // relation field
    console.log(provider.entityTree.user.roles.__field);
    {
        label: 'Roles',
        name: 'roles',
        relationType: 'manyToMany',
        relatedEntityName: 'Oro\\Bundle\\UserBundle\\Entity\\Role',
        parentEntity: {
            label: 'User',
            alias: 'user',
            className: 'Oro\\Bundle\\UserBundle\\Entity\\User',
            fields: [ /* ... */ ]
            // ...
        },
        relatedEntity: {
            label: 'Role',
            alias: 'userrole',
            className: 'Oro\\Bundle\\UserBundle\\Entity\\Role',
            fields: [ /* ... */ ]
            // ...
        }
        // ...
    }

    // non-relation field
    console.log(provider.entityTree.user.roles.label.__field);
    {
        label: 'Label',
        name: 'label',
        type: 'string',
        parentEntity: {
            label: 'Role',
            alias: 'userrole',
            className: 'Oro\\Bundle\\UserBundle\\Entity\\Role',
            fields: [ /* ... */ ]
            // ...
        }
        // ...
    }

Entity nodes have magic property `__entity`, that returns information about the entity.

.. code-block:: javascript

    console.log(provider.entityTree.user.__entity);
    {
        label: 'User',
        alias: 'user',
        className: 'Oro\\Bundle\\UserBundle\\Entity\\User',
        fields: [ /* ... */ ]
        // ...
    }

    console.log(provider.entityTree.user.roles.__entity);
    {
        label: 'Role',
        alias: 'userrole',
        className: 'Oro\\Bundle\\UserBundle\\Entity\\Role',
        fields: [ /* ... */ ]
        // ...
    }

Get EntityTreeNode by property path
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

There's method `getEntityTreeNodeByPropertyPath` in `EntityStructureDataProvider` allows to get the node by property path string

.. code-block:: javascript

    const node = provider.getEntityTreeNodeByPropertyPath('user.roles.label');

    console.log(node.__isField); // true
    console.log(node.__isEntity); // false
    console.log(node.__field);
    {
        label: 'Label',
        name: 'label',
        type: 'string',
        parentEntity: {
            label: 'Role',
            alias: 'userrole',
            className: 'Oro\\Bundle\\UserBundle\\Entity\\Role',
            fields: [ /* ... */ ]
            // ...
        }
        // ...
    }

See other methods of |oroentity/js/app/services/entity-structure-data-provider|.

.. include:: /include/include-links-dev.rst
   :start-after: begin
