.. _bundle-docs-extensions-maker:

Code Generator for OroPlatform-based Applications (OroMakerBundle)
==================================================================

|OroMakerBundle| provides a set of generators that create basic code for your project blazing fast with deep utilization of Oro Platform functionality.

What Can Be Generated
---------------------

- Bundle
- Doctrine Entities
- Validation Configuration for generated entities
- Translation strings for generated entities and external relations
- Data Grids for generated entities
- Data Grids for toMany external relations based on the related entity default Data Grid configuration
- Configure backend Search
- Configure ACLs for generated entities when needed
- Form Types for generated entities
- CreateOrSelect autocomplete form types with entity selection grid
- Controllers for CRUD
- Ability to add toMany relation items from the UI
- Actions (actions.yml) for the Attach relation functionality
- Navigation including menu items and shortcuts
- Enable API for generated entities
- Basic Import Export configuration. toMany relations are not configured
- Ability to use entities from the existing application as relation targets
- toMany relation grids are added to view pages of entities, including existing entities outside the generated bundle

Code Generation
---------------

Installation
^^^^^^^^^^^^

Install Oro Maker Bundle as a dev dependency:

.. code-block:: shell

   composer require --dev "oro/maker"


Execution
^^^^^^^^^

To run the code generator, prepare the config file that fits your requirements and execute the maker command:

.. code-block:: shell

   bin/console make:by-config /path_to_examples/example_config.yml


To generate code using a bundle-less structure, add the `--bundle-less` option to the command. For more information, see :ref:`Bundle-less Structure <dev-backend-architecture-bundle-less-structure>`.

.. code-block:: shell

   bin/console make:by-config --bundle-less /path_to_examples/example_config.yml

Configuration File Format
^^^^^^^^^^^^^^^^^^^^^^^^^

All information about entities and their fields required for code generation is provided in the YAML format to improve re-usability and create complex bundles quickly. The structure of the config is minimalistic and requires a minimal amount of data.

In most cases, you need to define organization and package name and list entities and their fields with types.

.. code-block:: yaml

    generate:
        options:
            organization: acme
            package: example
        entities:
            seller:
                configuration:
                    owner: user
                fields:
                    name:
                        type: string
                        required: true
                    price:
                        type: float
                    description:
                        type: html

Global `options` section contains two required elements: `organization` and `package` names. The `entities` section follows it. The key is an entity name.

You can configure its `owner` (possible values: user, organization, business_unit) and `frontend_owner` (possible values: customer and customer_user) in the optional `configuration` section of the entity.

In the same section, you can also disable the generation of:

- CRUD `create_crud: false`
- API `configure_api: false`
- Import Export `create_import_export: false`
- Search `configure_search: false`
- Data audit `auditable: false`

Use the `label` option to define a custom entity label.

The only requirement for the Entity is to have `fields`. The field section starts with the field name as a key of the section. Each field must containa  `type`.

Supported field types:

- boolean
- integer, smallint, bigint, float, decimal, percent
- string
- text
- email
- html (TinyMCE used as form type), wysiwyg (GrapesJS editor used)
- date, datetime
- image
- enum
- enum[] (so-called multi enums)
- relations

Supported optional field options:

- `default_value`
- `label` - the label used as a field label
- `values` - list of values for enum and multi enum (enum[])
- `required` - default false, indicates that field is required and cannot be empty
- `min_length` and `max_length` for the string and text fields
- `disable_data_audit`, `disable_import_export` to disable audit and import-export for the field
- `force_show_on_grid` to force field rendering on the grid

Relation Configuration
~~~~~~~~~~~~~~~~~~~~~~

- Relations to existing project entities (FQCN prefixed with `@`)
- toMany relations (FQCN or internal entity name optionally suffixed with `[]`)

Optionally for relation field types next options may be set:

- `relation_type` (possible values: many-to-one, one-to-many, many-to-many)
- `relation_target` - FQCN of a related entity or name of the entity within the current config file
- `is_owning_side` - can be used for a many-to-many relation to set a relation target as the owning side

Complex Example
^^^^^^^^^^^^^^^

.. code-block:: yaml

    generate:
        options:
            organization: acme
            package: example
        entities:
            home:
                label: Property
                configuration:
                    owner: user
                fields:
                    title:
                        type: string
                        required: true
                        max_length: 255
                    address:
                        type: text
                        disable_data_audit: true
                        disable_import_export: true
                    address_description_page:
                        type: '@Oro\Bundle\CMSBundle\Entity\Page'
                    photo:
                        label: Preview
                        type: image
                    description:
                        type: wysiwyg
                    build_year:
                        type: enum
                        values:
                            - 'Older than 1940'
                            - '1940 - 1960'
                            - '1960 and newer'
                    available_since:
                        type: date
                    equipment:
                        type: enum[]
                        values:
                            - Furniture
                            - Refrigerator
                            - TV
                    exclusive_seller:
                        type: '@seller'
                    sold_by:
                        type: '@seller[]'
                        relation_type: many-to-many
                    buyers:
                        type: relation
                        relation_type: many-to-many
                        relation_target: 'Oro\Bundle\CustomerBundle\Entity\CustomerUser'
                    related_products:
                        type: relation
                        relation_type: one-to-many
                        relation_target: 'Oro\Bundle\ProductBundle\Entity\Product'
                    view_requests:
                        type: '@view_request[]'
            seller:
                configuration:
                    owner: user
                fields:
                    title:
                        type: string
                        required: true
                    first_name:
                        type: string
                    last_name:
                        type: string
                    contact_email:
                        type: email
                    contact_phone:
                        type: string
                        required: true
                    is_private_person:
                        type: boolean
                    about:
                        type: html
                    contacts:
                        type: relation
                        relation_type: many-to-many
                        relation_target: 'Oro\Bundle\ContactBundle\Entity\Contact'
                    moderated_by:
                        type: relation
                        relation_type: many-to-many
                        relation_target: 'Oro\Bundle\UserBundle\Entity\User'
                        is_owning_side: false
            view_request:
                configuration:
                    is_related_entity: true
                    owner: organization
                    frontend_owner: customer_user
                fields:
                    proposal_text:
                        type: text
                        required: true
                        force_show_on_grid: true
                        min_length: 100
                        max_length: 2048
                    contact_person:
                        type: string

`is_related_entity` indicates that the entity has no CRUD and is managed through the owning entity.

.. include:: /include/include-links-dev.rst
   :start-after: begin