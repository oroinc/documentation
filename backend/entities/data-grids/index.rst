.. _data-grids:

Datagrids
=========

Creating a basic datagrid to display the data of all tasks involves three steps:

#. :ref:`Configure the datagrid <cookbook-entities-grid-config>`

#. :ref:`Create a controller and template <cookbook-entities-grid-controller>`

#. :ref:`Add a link to the grid to the application menu <cookbook-entities-grid-navigation>`

.. _cookbook-entities-grid-config:

Configure the Grid
------------------

The backend datagrid is configured in the ``/config/oro/datagrids.yml`` file, while the frontend datagrid is configured in the ``/views/layouts/<theme>/config/datagrids.yml`` file within the configuration directory of your bundle, and is divided into the sections below.

Datasource
~~~~~~~~~~

The ``source`` option is used to configure a Doctrine query builder that is used to fetch the data to be displayed in the grid:

.. oro_integrity_check:: 90acb801eb0fb98455a4793aea20a3bf774771b8

   .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/datagrids.yml
       :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/datagrids.yml
       :language: yaml
       :lines: 1, 201, 211-226


Displayed Columns
~~~~~~~~~~~~~~~~~

Then, the ``columns`` option needs to be used to configure how which data will be displayed:

.. oro_integrity_check:: a91f59d77763d519625a07a4530f27bb524a0afb

   .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/datagrids.yml
       :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/datagrids.yml
       :language: yaml
       :lines: 1, 201, 227-236


Keep in mind that the frontend datagrid is configured in the ``Resources/views/layouts/<theme>/config/datagrids.yml`` file within the configuration directory of your bundle.

Column Sorters
~~~~~~~~~~~~~~

Use the ``sorters`` option to define on which columns' header the user can click to order by the data:

.. oro_integrity_check:: dfa97ef5a864c0e80e465489c52d3add58bc546d

   .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/datagrids.yml
       :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/datagrids.yml
       :language: yaml
       :lines: 1, 201, 237-248


Each key under ``sorters.columns`` refers to one displayed column. The ``data_name`` option is the term that will be used as the ``order by`` term in the Doctrine query.

Data Filters
~~~~~~~~~~~~

Data filters are UI elements that allow the user to filter the data being displayed in the data grid. List all the attributes for which a filter should be shown under the ``filters.columns`` key. To configure the filter for a certain property, two options are needed:

* The ``type`` configures the UI type of the filter. The type of filter should be chosen based on the data type of the underlying attribute.

* The ``data_name`` denotes the name of the property to filter and will be used as is to modify the datagrid's query builder.

.. oro_integrity_check:: 6664d2ac364e4362d88b8d906fad5e1f185e634d

   .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/datagrids.yml
       :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/datagrids.yml
       :language: yaml
       :lines: 1, 201, 249-265


Complete Datagrid Configuration
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

The final datagrid configuration now looks like this:

.. oro_integrity_check:: d63ee74f642febf4fc40751350b63bb3e0fc925f

   .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/datagrids.yml
       :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/datagrids.yml
       :language: yaml
       :lines: 1, 201-202, 211-265


.. _cookbook-entities-grid-controller:

Create the Controller and View
------------------------------

To make your datagrid accessible, create a controller that the user can visit, which will serve as a view that renders the configured datagrid:

.. oro_integrity_check:: e230fc189e6a665ba25993799539f48820c9438f

   .. literalinclude:: /code_examples/commerce/demo/Controller/QuestionController.php
       :caption: src/Acme/Bundle/DemoBundle/Controller/QuestionController.php
       :language: php
       :lines: 3-5, 10-11, 14, 16, 20-24, 26-31, 108


The view can be straightforward if you extend the ``@OroUI/actions/index.html.twig`` template:

.. oro_integrity_check:: 1e81fd6f4418021e185e5e3856e9d04b18ca6ebd

   .. literalinclude:: /code_examples/commerce/demo/Resources/views/Question/index.html.twig
       :caption: src/Acme/Bundle/DemoBundle/Resources/views/Question/index.html.twig
       :language: html
       :lines: 1-4


Configure the name of your datagrid and the title you wish to be displayed. The base template from the OroUIBundle handles everything else.

.. _cookbook-entities-grid-navigation:

Link to the Action
------------------

At last, you need to make the action accessible by creating a menu item:

.. oro_integrity_check:: cf810415d2951190f99f8e2d31e5bcd0cbe8948e

   .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/navigation.yml
       :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/navigation.yml
       :language: yaml
       :lines: 1-3, 34-36, 117-123, 126

.. note::

    ``application_menu`` is the name of the menu you want to hook your item into. In this case, ``application_menu`` is an existing menu that is part of OroPlatform.

Key Classes
-----------

- ``Datagrid\Manager`` - responsible for preparing the grid and its configuration.
- ``Datagrid\Builder`` - responsible for creating and configuring the datagrid object and its datasource. It contains registered datasource types and extensions, and it also performs a check for datasource availability according to ACL.
- ``Datagrid\Datagrid`` - the main grid object, has only knowledge about the datasource object and its interaction; all further modifications of the results and metadata come from the extensions. Extension\\Acceptor - is a visitable mediator, contains all applied extensions, and provokes visits at different points of the interactions.
- ``Extension\ExtensionVisitorInterface`` - visitor interface.
- ``Extension\AbstractExtension`` - basic empty implementation.
- ``Datasource\DatasourceInterface`` - link object between data and grid. Should provide results as an array of ResultRecordInterface compatible objects.
- ``Provider\SystemAwareResolver`` - resolves specific grid YAML syntax expressions. For more information, see the :ref:`references in configuration <datagrid-references-configuration>` topic.

.. _datagrids-customize-mixin:

Mixin
-----

Mixin is a datagrid that contains additional (common) information for use by other datagrids.

**Configuration Syntax**

.. oro_integrity_check:: 856263322fa542c66b58d5d52f1a4e5886e5dfdd

   .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/datagrids.yml
       :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/datagrids.yml
       :language: yaml
       :lines: 1, 433-454, 201, 204-206, 211-213, 220-223

**Related Articles**

* :ref:`Customizing Datagrid <customizing-data-grid-in-orocommerce>`
* :ref:`Datagrid Configuration Reference <reference-format-datagrids>`

.. toctree::
   :hidden:

   how-to-pass-request-parameter-to-grid
   pagination
