.. _customize-datagrids-views-list:

Datagrid Views List
===================

Provides the ability to add a list of grid views. Adds filters and sorters from the grid view to the parameters' filters.

To write your own view list, create a class that extends the ``Oro\Bundle\DataGridBundle\Extension\GridViews\AbstractViewsList``
class. Here is an example:

.. oro_integrity_check:: c2d5d8e1c459be691729b14058514ca63c5abc7d

   .. literalinclude:: /code_examples/commerce/demo/Datagrid/FavoriteViewList.php
       :caption: src/Acme/Bundle/DemoBundle/Datagrid/FavoriteViewList.php
       :language: php

Add the service definition to ``services.yml``:

.. oro_integrity_check:: 8e0a2ff51bcdb302a8463f341e7c35b52cc9fd34

   .. literalinclude:: /code_examples/commerce/demo/Resources/config/services.yml
       :caption: src/Acme/Bundle/DemoBundle/Resources/config/services.yml
       :language: yaml
       :lines: 2, 106-110

You can add the view list to the datagrid in the `datagrids.yml` file for a specified datagrid under the `view-list` node.

.. oro_integrity_check:: 18b05c6eeee9ded2308428e4146501132e27b546

   .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/datagrids.yml
       :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/datagrids.yml
       :language: yaml
       :lines: 1, 456, 510

**Related Articles**

* :ref:`Datagrids <data-grids>`
* :ref:`Datagrid Configuration Reference <reference-format-datagrids>`
