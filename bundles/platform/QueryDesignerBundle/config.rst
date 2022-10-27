Query Designer Configuration
============================

You can tune the Query Designer behavior using configuration files. Make sure that these files are called `query_designer.yml` and are located in any bundle's `Resources/config/oro` directory. The following code snippet shows the main structure of the `query_designer.yml` file.

.. code-block:: yaml

    query_designer:
        filters:
            # put configuration of filters here
        grouping:
            # put configuration of grouping columns here
        aggregates:
            # put configuration of aggregating functions here

You can find all available configuration options in the |Configuration.php file|.

Filters Configuration
---------------------

This section describes how you can configure the list of filters are displayed on the results page (e.g., a report results grid) and intended for filtering the resulting data.
The |configuration of default filters| describes filters for general data types, such as `string`, `integer`, `money`, `percent` etc. For instance, take a look at the configuration of a filter used to filter textual data:

.. code-block:: yaml

    query_designer:
        filters:
            string: # filter name, you can use any string here
                applicable: [{type: string}, {type: text}]
                type:       string
                query_type: [all]

First, the `applicable` attribute describes rules, and then a filter is used. In this case, the filter will be used if an entity field data type is a `string` or `text`. Each item in the `applicable` array can have the following attributes:

- `type` - field data type
- `field` - field name
- `entity` - entity name, for example ``OroUserBundle:User`` or ``Oro\Bundle\UserBundle\Entity\User``
- `identifier` - true/false, check if the field is the primary key

For instance, if you need to use a special filter for the `name` field of the `User` entity, you can use the following applicable condition: `{entity: OroUserBundle:User, field: name}`.
The `type` attribute sets the identifier of a filter UI control. To find all existing controls, run the following command:

.. code-block:: php

   php bin/console debug:container --tag=oro_filter.extension.orm_filter.filter --show-private

The value of the `type` attribute in `query_designer.yml` should be equal to the value of the `type` attribute of the `oro_filter.extension.orm_filter.filter` tag.
The `query_type` attribute sets the types of queries for which this filter will be available. The word `all` is reserved, meaning the filter will be available in all queries.

Modifying an Existing Filter
----------------------------

Suppose your bundle introduced a new data type called `ShortMoney`, and you want to use the existing `number` filter for it. In this case, you need to add the following `query_designer.yml` file into your bundle:

.. code-block:: yaml

    query_designer:
        filters:
            number:
                applicable: [{type: ShortMoney}]

This will add an additional condition to the `applicable` attribute of the existing `number` filter.

Grouping Configuration
----------------------

Currently, the configuration of the grouping columns has only one attribute - `exclude`. With its help, you can specify which fields cannot be used in the `GROUP BY` SQL clause. |By default| the following data types are not available for grouping: `array`, `object`. Here is an example of grouping configuration:

.. code-block:: yaml

    query_designer:
        grouping:
            exclude: [{type: array}, {type: object}]

Each item in the `exclude` array can have the following attributes:

- `type` - field data type
- `field` - field name
- `entity` - entity name, for example ``OroUserBundle:User`` or ``Oro\Bundle\UserBundle\Entity\User``
- `identifier` - true/false, check if the field is the primary key

Aggregating Functions Configuration
-----------------------------------

This section describes how you can configure what aggregating functions will be available in the query designer. By default, the QueryDesigner bundle does not provide configuration for any aggregating functions. The following example shows how you can add aggregating functions for the numeric data type:

.. code-block:: yaml

    query_designer:
        aggregates:
            number:
                applicable: [{type: integer}, {type: smallint}, {type: bigint}, {type: decimal}, {type: float}, {type: money}, {type: percent}]
                functions:
                    - { name: Count, expr: COUNT($column), return_type: integer }
                    - { name: Sum,   expr: SUM(CASE WHEN ($column IS NOT NULL) THEN $column ELSE 0 END) }
                    - { name: Avg,   expr: AVG(CASE WHEN ($column IS NOT NULL) THEN $column ELSE 0 END) }
                    - { name: Min,   expr: MIN($column) }
                    - { name: Max,   expr: MAX($column) }
                query_type: [report]

For all numeric data types, this example adds `COUNT`, `SUM`, `AVG`, `MIN` and `MAX` aggregation functions. These functions will be available only if the query type is `report`.
Each item in the `applicable` array can have the following attributes:

- `type` - field data type
- `field` - field name
- `entity` - entity name, for example ``OroUserBundle:User`` or ``Oro\Bundle\UserBundle\Entity\User``
- `parent_entity` - the name of parent entity, for example ``OroUserBundle:User`` or ``Oro\Bundle\UserBundle\Entity\User``
- `identifier` - true/false, check if the field is the primary key

Dump Reference Structure
------------------------

You can dumps the reference structure for Resources/config/oro/query_designer.yml by using the following command:

.. code-block:: none

   php bin/console oro:query-designer:config:dump-reference


.. include:: /include/include-links-dev.rst
   :start-after: begin