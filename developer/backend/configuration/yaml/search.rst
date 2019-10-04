Search Index ``search.yml``
===========================

+-----------+------------------------------------------------------------+
| Filename  | ``search.yml``                                             |
+-----------+------------------------------------------------------------+
| Root Node |  search                                                    |
+-----------+------------------------------------------------------------+
| Options   | * The fully qualified class name the indexed entity        |
|           |   * `alias`_                                               |
|           |   * `fields`_                                              |
|           |                                                            |
|           |     * :ref:`name <reference-format-search-fields-name>`    |
|           |     * `relation_fields`_                                   |
|           |     * `relation_type`_                                     |
|           |     * `target_fields`_                                     |
|           |     * `target_type`_                                       |
|           |                                                            |
|           |   * `label`_                                               |
|           |   * `mode`_                                                |
|           |   * `route`_                                               |
|           |                                                            |
|           |     * :ref:`name <reference-format-search-route-name>`     |
|           |     * `parameters`_                                        |
|           |                                                            |
|           |   * `search_template`_                                     |
|           |   * `title_fields`_  (deprecated since 2.0)                |
+-----------+------------------------------------------------------------+

The ``search.yml`` file is used to configure how your entities are indexed to make them usable by
the internal search engine of OroPlatform. A fully working example can look like this:

.. code-block:: yaml
    :linenos:

    # src/Acme/DemoBundle/Resources/config/oro/search.yml
    search:
        Acme\DemoBundle\Entity\Product:
            alias: demo_product
            search_template: AcmeDemoBundle:result.html.twig
            label: Demo products
            route:
                name: acme_demo_search_product
                parameters:
                    id: id
            mode: normal
            title_fields: [name] # deprecated since 2.0
            fields:
                -
                    name: name
                    target_type: text
                -
                    name: description
                    target_type: text
                    target_fields: [description, another_index_name]  parameter.
                -
                    name: manufacturer
                    relation_type: many-to-one
                    relation_fields:
                        -
                            name: name
                            target_type: text
                            target_fields: [manufacturer, all_data]
                        -
                            name: id
                            target_type: integer
                            target_fields: [manufacturer]
                -
                    name: categories
                    relation_type: many-to-many
                    relation_fields:
                        -
                            name: name
                            target_type: text
                            target_fields: [all_data]

``alias``
---------

**type**: ``string``

An alias used in the ``from`` keyword in :ref:`advanced search <advanced-search-api>`.

.. _reference-format-search-fields:

``fields``
----------

**type**: ``sequence``

The list of fields that will be added to the search index. Each entry must be a map that can use
the following keys to configure how the property value will be indexed:

.. _reference-format-search-fields-name:

``name``
~~~~~~~~

**type**: ``string``

The name of the entity property. This option is required.

``relation_fields``
~~~~~~~~~~~~~~~~~~~

**type**: ``sequence``

When the field represents an association (i.e. a value is configured for `relation_type`_), this is
a list of fields from the target entity to index. For each entry all the options of the parent
:ref:`fields option <reference-format-search-fields>` apply.

``relation_type``
~~~~~~~~~~~~~~~~~

**type**: ``string``

When the property denotes an association with another entity, the type of association (one of
``one-to-one``, ``many-to-many``, ``one-to-many``, or ``many-to-one``) must be configured with this
option.

``target_fields``
~~~~~~~~~~~~~~~~~

**type**: ``sequence``

The ``target_fields`` option list the named indexes to which the property value will be added.

For example, a contact may have the properties ``firstName``, ``lastName``, and ``namePrefix`` and
all three properties should be searched when the user is loooking for a value in the virtual
``name`` field (when using the advanced search API). In this case, all three properties will list
the ``name`` field in ``target_fields``:

.. code-block:: yaml
    :linenos:

    search:
        Acme\ContactBunde\Entity\Contact:
            fields:
                - name: firstName
                  target_type: text
                  target_fields: [name]
                - name: lastName
                  target_type: text
                  target_fields: [name]
                - name: namePrefix
                  target_type: text
                  target_fields: [name]

If the ``target_type`` is ``text``, the data will also be stored in the ``all_data`` field
implicitly.

If the ``target_fields`` option is not given, the data is added to a virtual field whose name is
the name as the field's name (i.e. what is specified under the ``name`` key).

``target_type``
~~~~~~~~~~~~~~~

**type**: ``string``

The type of the virtual search field (possible values are ``datetime``, ``double``, ``integer``,
and ``text``). This option is required.

``label``
---------

**type**: ``string``

A human readable label to identify the entity in the search results. The configured string will be
passed to the translator.

``mode``
--------

**type**: ``string`` **default**: normal

The entity behavior for inheritance. For possible values and what they mean, have a look at the
constants of the :class:`Oro\\Bundle\\SearchBundle\\Query\\Mode` class.

.. _reference-format-search-route-name:

``route``
---------

**type**: ``map``

The route for which a URL is generated when linking from the search result to a concrete entity.
The available options are:

``name``
~~~~~~~~

**type**: ``string``

The name of the route.

``parameters``
~~~~~~~~~~~~~~

**type**: ``map``

The routing parameters, each key is the name of the routing parameter and the value is the name of
one of the configured :ref:`fields <reference-format-search-fields>`.

``search_template``
-------------------

**type**: ``string``

``title_fields``
----------------

**type**: ``sequence``

Note: Usage of this field is deprecated since 2.0. Register an EntityNameProvider instead.
The list of fields to build the title for the result set. The value used here denote to the
:ref:`configured fields <reference-format-search-fields>`.
