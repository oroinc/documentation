:oro_show_local_toc: false

.. _web-api--doc:

Documenting API Resources
=========================

Documentation is an essential part of API and helps developers to use your API. Therefore, it is necessary to provide detailed documentation for your API resources.

OroPlatform collects documentation for API resources from several sources:

- Documentation in a :ref:`configuration file <web-api--configuration>`.
- A |Markdown1| document. You can find detailed information further below.
- System-wide descriptions of |configurable entities and fields|.

The source with the highest priority is the configuration file. The documentation provided there overrides all other sources. However, as it is a YAML file, it is not entirely suitable for extensive multi-line texts. A more appropriate place for the documentation is a separate |Markdown1| file. To use a custom markdown file, provide a link to it in the configuration file, as illustrated below:

.. code-block:: yaml

    api:
        entities:
            Acme\Bundle\AppBundle\Entity\AcmeEntity:
                documentation_resource: '@AcmeAppBundle/Resources/doc/api/acme_entity.md'

If the documentation cannot be found in either the configuration file or the Markdown documentation file, OroPlatform tries to use system-wide descriptions of entities and fields. These descriptions are usually provided in translation files. It is the best way to document fields because the descriptions can be used in other places, not only in the API. Here is an example of a translation file that contains descriptions for entities and fields:

.. code-block:: yaml
   :caption: Acme/Bundle/AppBundle/Resources/translations/messages.en.yml

    oro:
        sales:
            #
            # Opportunity entity
            #
            opportunity:
                entity_label:         Opportunity
                entity_plural_label:  Opportunities
                entity_description:   The Opportunity represent highly probable potential or actual sales to a new or established customer
                id.label:             Id
                name:
                    label:            Opportunity name
                    description:      The name used to refer to the opportunity in the system.
                close_date:
                    label:            Expected close date
                    description:      The expected close date for open opportunity, and actual close date for the closed one
                probability:
                    label:            Probability
                    description:      The perceived probability of opportunity being successfully closed

.. note:: After changing documentation, make sure you run the ``oro:api:doc:cache:clear`` CLI command to apply the changes to the API sandbox.

Documentation File Format
-------------------------

The documentation file is a |Markdown1| document containing descriptions of one or multiple API resources. |Markdown Extra| syntax is also supported in the documentation file.

The only requirement for such a document is that it should be written in a particular format. Each resource documentation must start with '#' (h1) header that contains a Fully-Qualified Class Name (FQCN) of the resource, e.g.:

.. code-block:: none

    # Acme\Bundle\AcmeBundle\Entity\AcmeEntity

As already mentioned above, a single documentation file can contain documentation for several resources. In general, such an approach is used to document the main resource and related resources. For example, you can document resources for the User and UseStatus entities in the same file.

The next level must start with the ``##`` (h2) header. Use it to announce one of the documentation sections, e.g.:

.. code-block:: none

    # Acme\Bundle\AcmeBundle\Entity\AcmeEntity

    ## ACTIONS
    ...
    ## FIELDS
    ...
    ## FILTERS
    ...
    ## SUBRESOURCES
    ...

The section name is case-insensitive. They are used only by the documentation parser to identify the documentation part.
The following table describes the purposes of each documentation section:

+----------------+----------------------------------------------+
| Section name   | Description                                  |
+================+==============================================+
| ACTIONS        | Contains documentation of actions.           |
+----------------+----------------------------------------------+
| FIELDS         | Contains a description of fields.            |
+----------------+----------------------------------------------+
| FILTERS        | Contains a description of filters.           |
+----------------+----------------------------------------------+
| SUBRESOURCES   | Contains documentation of sub-resources.     |
+----------------+----------------------------------------------+

The third level ``###`` (h3) header depends on the section type and can be an action name, field name, filter name, or sub-resource name.

You can use the fourth level ``####`` (h4) header only for the **FIELDS** and **SUBRESOURCES** sections. The **FIELDS** section can be used when you specify a field's description in a particular action. For the **SUBRESOURCES** section, it is a sub-resource action name.

The action names in the **FIELDS** section can be combined using a comma, e.g., "create, update". It allows avoiding copying and pasting when you need the same description for several actions.

Example:

.. code-block:: none

    # Acme\Bundle\AcmeBundle\Entity\AcmeEntity

    ## ACTIONS

    ### get

    In this example, the documentation for an action is "get" action.
    It may contain any formatting, e.g., ordered or unordered lists,
     request or response examples, links, text in bold or italic, etc.

    ## FIELDS

    ### name

    The description for the "name" field.
    May contain any formatting, e.g., ordered or unordered lists,
     request or response examples, links, text in bold or italic, etc.

    #### get

    The description for the "name" field for the "get" action.
    It may contain any formatting, e.g., ordered or unordered lists,
     request or response examples, links, text in bold or italic, etc.

    #### create, update

    The description for "name" field for "create" and "update" actions.
    It may contain any formatting, e.g., ordered or unordered lists,
     request or response examples, links, text in bold or italic, etc.

    ## FILTERS

    ### name

    The description for a filter by "name" field.
    The formatting is not allowed here.

    ## SUBRESOURCES

    ### contacts

    #### get_subresource

    In this example, the documentation for a sub-resource for the "get_subresource" action for the "contacts" sub-resource.
    It may contain any formatting, e.g., ordered or unordered lists,
     request or response examples, links, text in bold or italic, etc.

Use the ``{@inheritdoc}`` placeholder to get the common documentation for an action, a field, or a filter. This placeholder works only for the **ACTIONS**, **FIELDS**, and **FILTERS** sections.

Example:

.. code-block:: none

    # Acme\Bundle\AcmeBundle\Entity\AcmeEntity

    ## ACTIONS

    ### create

    Create a new acme entity record.
    The created record is returned in the response.

    {@inheritdoc}

    ## FIELDS

    ### name

    #### create

    {@inheritdoc}

    **The required field.**

Use the ``{@inheritdoc:description}`` placeholder to get the system-wide description of a configurable entity or field. This placeholder works only for the **ACTIONS** and **FIELDS** sections. Usually, this placeholder is used when you need to replace the existing documentation entirely and add a system-wide description to the new documentation.

Use the ``{@request}`` tag to add documentation depending on the request type. The full signature of this tag is ``{@request:expression}some text{@/request}``. The expression can contain the following operators:

-  ``&`` - logical AND
-  ``|`` - logical OR
-  ``!`` - logical NOT

For example, to add a text for the |JSON:API| request type for all requests excluding REST API, use the following expression: ``json_api&!rest``.

Example:

.. code-block:: none

    # Acme\Bundle\AcmeBundle\Entity\AcmeEntity

    ## ACTIONS

    ### create

    Create a new acme entity record.
    The created record is returned in the response.

    {@inheritdoc}

    {@request:json_api}
    Example:

    ```JSON
    {
        "data": {
           "type": "entities",
           "attributes": {
              "name": "Test Entity"
           }
        }
    }
    ```
    {@/request}

    ## FIELDS

    ### name

    #### create

    {@inheritdoc}

    **The required field.**

Use the ``{@feature}`` tag to add documentation depending on a feature (see :ref:`FeatureToggleBundle <bundle-docs-platform-feature-toggle-bundle>`). The full signature of this tag is ``{@feature:expression}some text{@/feature}``. The expression can contain the following operators:

-  ``&`` - logical AND
-  ``|`` - logical OR
-  ``!`` - logical NOT

For example, to add a text when ``feature1`` is enabled and ``feature2`` is disabled, use the following expression: ``feature1&!feature2``.


.. include:: /include/include-links-dev.rst
   :start-after: begin

