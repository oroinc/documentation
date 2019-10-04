.. _web-api--testing:

Testing REST Api
================

Overview
--------

To be sure that your REST API resources work properly you can cover them by |functional tests|. To simplify creating the functional test for REST API resources conform |JSON.API specification| the |RestJsonApiTestCase| test case was created. The following table contains the list
of most useful methods of this class:

.. csv-table::
   :header: "Method", "Description"

   "request","Sends any REST API request."
   "cget","Sends GET request for a list of entities.",
   "get","Sends GET request for a single entity."
   "post","Sends POST request for an entity resource. If the second parameter is a file name, the file should be located in the ``requests`` directory near to PHP file contains the test."
   "patch","Sends PATCH request for a single entity. If the second parameter is a file name, the file should be located in the ``requests`` directory near to PHP file contains the test."
   "delete","Sends DELETE request for a single entity."
   "cdelete","Sends DELETE request for a list of entities."
   "getSubresource","Sends GET request for a sub-resource of a single entity."
   "getRelationship","Sends GET request for a relationship of a single entity."
   "postRelationship","Sends POST request for a relationship of a single entity."
   "patchRelationship","Sends PATCH request for a relationship of a single entity."
   "deleteRelationship","Sends DELETE request for a relationship of a single entity."
   "assertResponseContains","Asserts the response content contains the the given data. If the first parameter is a file name, the file should be located in the ``responses`` directory near to PHP file contains the test."
   "assertResponseCount","Asserts the response contains the given number of data items."
   "assertResponseNotEmpty","Asserts the response data are not empty."
   "assertResponseValidationError","Asserts the response content contains the the given validation error."
   "assertResponseValidationErrors","Asserts the response content contains the the given validation errors."
   "dumpYmlTemplate","Saves a response content to a YAML file. If the first parameter is a file name, the file will be saved in the ``responses`` directory near to PHP file contains the test."
   "getResourceId","Extracts JSON.API resource identifier from the response. For details see |JSON.API specification|."
   "getRequestData","Converts the given request to an array that can be sent to the server. The given request can be a path to a file contains the request data or an array with the request data. If the request is a file name, the file should be located in the ``requests`` directory near to PHP file contains the test."
   "getResponseErrors","Extracts the list of errors from JSON.API response. For details see |JSON.API specification|."
   "appendEntityConfig"," Appends a configuration of an entity. This method may be helpful if you create some general functionality and need to test it for different configurations without creating a test entity for each configuration. Please note that the configuration is restored after each test and you do not need to do it manually."

.. note:: See the :ref:`Actions <web-api--actions>` section for more details on each method.

Load Fixtures
-------------

You can use :ref:`Doctrine and Alice fixtures <automated-test>`:

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

Yaml template is a regular yaml. The only difference is that you can use references and faker in values All values will be processed by Alice and replaces with appropriate value. For details see |Alice documentation|.

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

.. include:: /include/include-links.rst
   :start-after: begin