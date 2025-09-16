.. index::
    single: Grid
    single: Customization; Grid Event Listeners
    single: Events; Grid Event Listeners

.. _how-to-pass-request-parameter-to-the-grid:

Pass Request Parameters to the Grid
===================================

Sometimes, you must pass parameters from the request to the grid.
For this, use grid event listeners or an existing listener implementation.

Grid Configuration
------------------

Suppose you have a grid configuration and a named parameter inside the `where` clause of its source query:

.. oro_integrity_check:: c8828393becf1321ce5ce80d0ffc5f53fc98f13b

   .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/datagrids.yml
       :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/datagrids.yml
       :language: yaml
       :lines: 1, 284, 289-293

The goal is to set the :holder_entity_id parameter with the value from the request.

Solution 1: Grid Parameter Binding
----------------------------------

The easiest way (sufficient for most situations) is to use the parameter binding option of the datasource to configure the mapping between the datagrid and query parameters.

You can do this by adding the ``bind_parameters`` option to your ``datagrids.yml`` using the following syntax:

.. oro_integrity_check:: f2f4c1f49ca17d7b4a4c66ad9823987e91cd3d71

   .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/datagrids.yml
       :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/datagrids.yml
       :language: yaml
       :lines: 1, 284, 289-297

The controller receives an entity "priority" and passes it to the view:

.. oro_integrity_check:: f712c583b5199027624c0b14f3ea899c62f06334

   .. literalinclude:: /code_examples/commerce/demo/Controller/PriorityController.php
       :caption: src/Acme/Bundle/DemoBundle/Controller/PriorityController.php
       :language: php
       :lines: 20-22, 33-34, 41-46, 113

In this example, the entity mapping page adds a grid with the data of the linked entity.
The view passes the "holder_entity_id" parameter with the value "entity.id" to the grid:

.. oro_integrity_check:: 5e3efaa6504563923a785a478d49c94d6b0a2534

   .. literalinclude:: /code_examples/commerce/demo/Resources/views/Priority/view.html.twig
       :caption: src/Acme/Bundle/DemoBundle/Resources/views/Priority/view.html.twig
       :language: html
       :lines: 3, 19-21, 43-53

In case if names of the parameter in the grid and the query do not match, you can pass an associative array of parameters, where the key will be the name of the query parameter, and the value will match the name of the parameter in the grid:

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/datagrids.yml

    datagrids:
        acme-demo-question-grid-by-priority:
            source:
                query:
                    where:
                        and:
                        - 'IDENTITY(e.priority) = :holder_entity_id'
                bind_parameters:
                    # Get the "priority" parameter from the datagrid
                    # and set its value to the "holder_entity_id" parameter in the datasource query
                    holder_entity_id: priority
            # ...
        # ...

.. caution::

    A datasource must implement the |BindParametersInterface| to support the ``bind_parameters`` option.

Solution 2. Create Custom Event Listener
----------------------------------------

If the first example does not work for you ( for example, datasource does not support parameters binding, or  you need to implement additional logic before binding parameters), you can create a listener for the
``oro_datagrid.datagrid.build.after`` event and set the parameter for the source query in this listener:

.. oro_integrity_check:: 371351daec49ddf419ecb5b0aaac7657e027851d

   .. literalinclude:: /code_examples/commerce/demo/EventListener/ParameterListener.php
       :caption: src/Acme/Bundle/DemoBundle/EventListener/ParameterListener.php
       :language: php
       :lines: 3-34

Register this listener in the container:

.. oro_integrity_check:: 6e6cdf9eae3399e39fe76888ecbe3bfae6b3a4aa

   .. literalinclude:: /code_examples/commerce/demo/Resources/config/services.yml
       :caption: src/Acme/Bundle/DemoBundle/Resources/config/services.yml
       :language: yaml
       :lines: 2, 90-95

.. oro_integrity_check:: 710deb97c20a27a0106005b1c0d3eaf51d57727b

   .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/datagrids.yml
       :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/datagrids.yml
       :language: yaml
       :lines: 1, 161, 166-170

The view passes the "holder_entity_id" parameter with the value "entity.id" to the grid:

.. oro_integrity_check:: 334fbddb121d48992723ba25d9fd7fc8f3b2deae

   .. literalinclude:: /code_examples/commerce/demo/Resources/views/Priority/view.html.twig
       :caption: src/Acme/Bundle/DemoBundle/Resources/views/Priority/view.html.twig
       :language: html
       :lines: 3, 19-21, 33-42

References
----------

* |Symfony Cookbook How to Register Event Listeners and Subscribers|

.. include:: /include/include-links-dev.rst
   :start-after: begin
