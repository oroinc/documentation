Testing REST Api
================

Table of Contents
-----------------

-  `Overview <#overview>`__
-  `Load Fixtures <#load-fixtures>`__
-  `Alice references <#alice-references>`__
-  `Yaml templates <#yaml-templates>`__
-  `Assert expectations <#assert-expectations>`__
-  `Yaml templates for request body <#yaml-templates-for-request-body>`__
-  `Process single reference <#process-single-reference>`__
-  `Dump response into Yaml template <#dump-response-into-yaml-template>`__

Overview
--------

To be sure that your REST API resources work properly you can cover them by `functional tests <https://www.orocrm.com/documentation/current/book/functional-tests>`__. To simplify creating the functional test for REST API resources conform `JSON.API specification <http://jsonapi.org/format/>`__ the `RestJsonApiTestCase <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/ApiBundle/Tests/Functional/RestJsonApiTestCase.php>`__ test case was created. The following table contains the list
of most useful methods of this class:

+----------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Method                           | Description                                                                                                                                                                                                                                                                                                               |
+==================================+===========================================================================================================================================================================================================================================================================================================================+
| request                          | Sends any REST API request.                                                                                                                                                                                                                                                                                               |
+----------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| cget                             | Sends GET request for a list of entities. See `get\_list action <./actions.rst#get_list-action>`__.                                                                                                                                                                                                                       |
+----------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| get                              | Sends GET request for a single entity. See `get action <./actions.rst#get-action>`__.                                                                                                                                                                                                                                     |
+----------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| post                             | Sends POST request for an entity resource. See `create action <./actions.rst#create-action>`__. If the second parameter is a file name, the file should be located in the ``requests`` directory near to PHP file contains the test.                                                                                      |
+----------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| patch                            | Sends PATCH request for a single entity. See `update action <./actions.rst#update-action>`__. If the second parameter is a file name, the file should be located in the ``requests`` directory near to PHP file contains the test.                                                                                        |
+----------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| delete                           | Sends DELETE request for a single entity. See `delete action <./actions.rst#delete-action>`__.                                                                                                                                                                                                                            |
+----------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| cdelete                          | Sends DELETE request for a list of entities. See `delete\_list action <./actions.rst#delete_list-action>`__.                                                                                                                                                                                                              |
+----------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| getSubresource                   | Sends GET request for a sub-resource of a single entity. See `get\_subresource action <./actions.rst#get_subresource-action>`__.                                                                                                                                                                                          |
+----------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| getRelationship                  | Sends GET request for a relationship of a single entity. See `get\_relationship action <./actions.rst#get_relationship-action>`__.                                                                                                                                                                                        |
+----------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| postRelationship                 | Sends POST request for a relationship of a single entity. See `add\_relationship action <./actions.rst#add_relationship-action>`__.                                                                                                                                                                                       |
+----------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| patchRelationship                | Sends PATCH request for a relationship of a single entity. See `update\_relationship action <./actions.rst#update_relationship-action>`__.                                                                                                                                                                                |
+----------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| deleteRelationship               | Sends DELETE request for a relationship of a single entity. See `delete\_relationship action <./actions.rst#delete_relationship-action>`__.                                                                                                                                                                               |
+----------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| assertResponseContains           | Asserts the response content contains the the given data. If the first parameter is a file name, the file should be located in the ``responses`` directory near to PHP file contains the test.                                                                                                                            |
+----------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| assertResponseCount              | Asserts the response contains the given number of data items.                                                                                                                                                                                                                                                             |
+----------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| assertResponseNotEmpty           | Asserts the response data are not empty.                                                                                                                                                                                                                                                                                  |
+----------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| assertResponseValidationError    | Asserts the response content contains the the given validation error.                                                                                                                                                                                                                                                     |
+----------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| assertResponseValidationErrors   | Asserts the response content contains the the given validation errors.                                                                                                                                                                                                                                                    |
+----------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| dumpYmlTemplate                  | Saves a response content to a YAML file. If the first parameter is a file name, the file will be saved in the ``responses`` directory near to PHP file contains the test.                                                                                                                                                 |
+----------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| getResourceId                    | Extracts JSON.API resource identifier from the response. For details see `JSON.API Specification <http://jsonapi.org/format/#document-resource-objects>`__.                                                                                                                                                               |
+----------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| getRequestData                   | Converts the given request to an array that can be sent to the server. The given request can be a path to a file contains the request data or an array with the request data. If the request is a file name, the file should be located in the ``requests`` directory near to PHP file contains the test.                 |
+----------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| getResponseErrors                | Extracts the list of errors from JSON.API response. For details see `JSON.API Specification <http://jsonapi.org/format/#errors>`__.                                                                                                                                                                                       |
+----------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| appendEntityConfig               | Appends a configuration of an entity. This method may be helpful if you create some general functionality and need to test it for different configurations without creating a test entity for each configuration. Please note that the configuration is restored after each test and you do not need to do it manually.   |
+----------------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+

Load Fixtures
-------------

You can use `Doctrine and Alice fixtures <https://www.orocrm.com/documentation/current/book/functional-tests#loading-data-fixtures>`__:

.. code:: php

    class InventoryLevelApiTest extends RestJsonApiTestCase
    {
        /**
         * {@inheritdoc}
         */
        protected function setUp()
        {
            parent::setUp();
            $this->loadFixtures([__DIR__ . '/DataFixtures/inventory_level.yml']);
        }

Fixture file:

.. code:: yaml

    dependencies:
      - Oro\Bundle\WarehouseBundle\Tests\Functional\DataFixtures\LoadWarehouseAndInventoryLevels

    Oro\Bundle\InventoryBundle\Entity\InventoryLevel:
      warehouse_inventory_level.warehouse.1.product_unit_precision.product-1.primary_unit:
        warehouse: '@warehouse.1'
        productUnitPrecision: '@product-1->primaryUnitPrecision'
        quantity: 10

The ``dependencies`` section can be used if a fixture depends to other Doctrine or Alice fixtures. References will be shared between Alice and Doctrine fixtures.

Alice references
----------------

In Alice fixtures as well as in yml templates the references can be used.

::

    @product-1

Use methods of properties with references:

::

    @product-2->createdAt->format("Y-m-d\TH:i:s\Z")

Yaml templates
--------------

Yaml template is a regular yaml. The only difference is that you can use references and faker in values All values will be processed by Alice and replaces with appropriate value. For details see `Alice documentation <https://github.com/nelmio/alice/blob/master/doc/relations-handling.md#references>`__.

Assert expectations
-------------------

Assert expected response by using yaml templates. Yaml template:

.. code:: yaml

    data:
        -
            type: inventorylevels
            id: '@warehouse_inventory_level.warehouse.1.product_unit_precision.product-1.liter->id'
            attributes:
                quantity: '10.0000000000'
            relationships:
                product:
                    data:
                        type: products
                        id: '@product-1->id'
                productUnitPrecision:
                    data:
                        type: productunitprecisions
                        id: '@product_unit_precision.product-1.liter->id'
                warehouse:
                    data:
                        type: warehouses
                        id: '@warehouse.1->id'

In php test:

.. code:: php

    public function testGetList()
    {
        $response = $this->cget(
            ['entity' => 'inventorylevels'],
            [
                'include' => 'product,productUnitPrecision',
                'filter' => [
                    'product.sku' => '@product-1->sku',
                ]
            ]
        );

        $this->assertResponseContains('cget_filter_by_product.yml', $response);
    }

Yaml templates for request body
-------------------------------

You can use array with references for request body:

.. code:: php

    public function testUpdateEntity()
    {
        $response = $this->patch(
            ['entity' => 'inventorylevels', 'product.sku' => '@product-1->sku'],
            [
                'data' => [
                    'type' => 'inventorylevels',
                    'id' => '<toString(@product-1->id)>',
                    'attributes' => [
                        'quantity' => '17'
                    ]
                ],
            ]
        );
    }

or you can hold yaml in ``.yml`` file:

.. code:: php

    public function testCreateCustomer()
    {
        $this->post(
            ['entity' => 'customers'],
            'create_customer.yml' // loads data from __DIR__ . '/requests/create_customer.yml'
        );
    }

Process single reference
------------------------

Sometimes you need a process a single reference e.g. for compare it with other value

.. code:: php

    self::processTemplateData('@inventory_level.product_unit_precision.product-1.liter->quantity')

The ``processTemplateData`` method can process string, array or yml file.

Dump response into Yaml template
--------------------------------

During development new tests for REST api you have ability to dump response into Yaml template

.. code:: php

    public function testGetList()
    {
        $response = $this->cget(
            ['entity' => 'products'],
            ['filter' => ['sku' => '@product-1->sku']]
        );
        // dumps response content to __DIR__ . '/responses/' . 'test_cget_entity.yml'
        $this->dumpYmlTemplate('test_cget_entity.yml', $response);
    }

Use this for the first time and check references after that - there are can be some collision with references that has same ids
