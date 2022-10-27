.. _customize--datagrids-datasource:

Datasources
===========

OroPlatform gives you a wide variety of ways to prepare and supply data to a datagrid by encapsulating all data access in a *datasource* object. Datagrids can be configured to retrieve data from a PHP array, Doctrine ORM, a search engine, or any other source by using datasources that implement `DatasourceInterface`.

**Supported Types**

- :ref:`ORM <customize--datagrids-datasource-orm>`
- :ref:`Array <customize--datagrids-datasource-array>`
- :ref:`Search <db-search--configuration--datagrid>`

.. _customize--datagrids-datasource-custom-types:

Custom Types
------------

To implement your own datasource type:

- Create a class that implements ``DatasourceInterface``
- Register your type as a tagged service - ``{ name: oro_datagrid.datasource, type: YOUR_CUSTOM_TYPE_NAME }``

.. code-block:: php

    namespace Acme\Bundle\DemoBundle\Datagrid\Datasource;

    use Oro\Bundle\DataGridBundle\Datagrid\DatagridInterface;
    use Oro\Bundle\DataGridBundle\Datasource\DatasourceInterface;
    use Oro\Bundle\DataGridBundle\Datasource\ResultRecord;

    class CustomDatasource implements DatasourceInterface
    {
        const TYPE = 'acme_custom';

        protected array $arraySource = [];

        /**
         * @inheritDoc
         */
        public function process(DatagridInterface $grid, array $config)
        {
            $grid->setDatasource(clone $this);
        }

        /**
         * @inheritDoc
         */
        public function getResults()
        {
            $rows = [];
            foreach ($this->arraySource as $result) {
                $rows[] = new ResultRecord($result);
            }

            return $rows;
        }

        /**
         * @return array
         */
        public function getArraySource(): array
        {
            return $this->arraySource;
        }

        /**
         * @param array $source
         * @return void
         */
        public function setArraySource(array $source): void
        {
            $this->arraySource = $source;
        }
    }


Add the service definition to ``services.yml``:

.. code-block:: yaml


    acme_bundle.datagrid.datasource.array:
        class: Acme\Bundle\DemoBundle\Datagrid\Datasource\CustomDatasource
        tags:
            - { name: oro_datagrid.datasource, type: acme_custom }


Now that you have created your custom datasource type, you can use it in any datagrid. The configuration of the datagrid tells OroPlatform to use this datasource via the `type` parameter under the `source` node:

.. code-block:: yaml


    datagrids:
        DATAGRID_NAME_HERE:
            source:
                type: acme_custom


ACL
---

You can protect a datasource with ACL by adding the ``acl_resource`` parameter under the ``source`` node in the datagrid configuration:

.. code-block:: yaml


    datagrids:
        DATAGRID_NAME_HERE:
            source:
                acl_resource: SOME_ACL_IF_NEEDED

.. toctree::
   :maxdepth: 1

   array
   orm
