:oro_show_local_toc: false

.. _customize--datagrids-datasource-array:

Array Datasource
================

This datasource provides the ability to set data for the datagrid from thearray.

**Example**

.. code-block:: yaml
   :linenos:

    datagrids:
        DATAGRID_NAME_HERE:
            source:
                type: array

Configuration
-------------

To configure datasource, create a datagrid event listener and subscribe to the ``oro_datagrid.datagrid.build.after.DATAGRID_NAME_HERE`` event.

.. code-block:: yaml
   :linenos:

    acme_bundle.event_listener.datagrid.my_custom_listener:
        class: Acme\Bundle\AcmeBundle\EventListener\Datagrid\MyCustomListener
        tags:
            - { name: kernel.event_listener, event: oro_datagrid.datagrid.build.after.DATAGRID_NAME_HERE, method: onBuildAfter }


.. code-block:: php
   :linenos:

    <?php

    namespace Acme\Bundle\AcmeBundle\EventListener\Datagrid;

    use Oro\Bundle\DataGridBundle\Datasource\ArrayDatasource\ArrayDatasource;
    use Oro\Bundle\DataGridBundle\Event\BuildAfter;
    use Oro\Bundle\DataGridBundle\Exception\UnexpectedTypeException;

    class MyCustomListener
    {
        /**
        * @param BuildAfter $event
        */
        public function onBuildAfter(BuildAfter $event)
        {
            $datagrid = $event->getDatagrid();
            $datasource = $datagrid->getDatasource();

            if (!$datasource instanceof ArrayDatasource) {
                throw new UnexpectedTypeException($datasource, ArrayDatasource::class);
            }

            // Create datagrid source array
            $source = [
                // row 1
                [
                    'first_column' => 'Value in first row and first column',
                    'second_column' => 'Value in first row and second column'
                ],
                // row 2
                [
                    'first_column' => 'Value in second row and first column',
                    'second_column' => 'Value in second row and second column'
                ],
                // ...
            ];

            $datasource->setArraySource($source);
        }
    }

Predefined columns can be defined using the following configuration:

.. code-block:: yaml
   :linenos:

    datagrids:
        DATAGRID_NAME_HERE:
            source:
                type: array
            columns:
                first_column:
                    label: Column 1 Label
            sorters:
                columns:
                    first_column:
                        data_name: first_column


