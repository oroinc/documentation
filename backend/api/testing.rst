.. _web-api--testing:

Testing REST Api
================

To ensure that your REST API resources work properly, cover them with |functional tests|. To simplify creation of the functional test for REST API resources that conforms to  |JSON.API specification|, the |RestJsonApiTestCase| test case was created. The following table contains the list of the most useful methods of this class:

.. csv-table::
   :header: "Method","Description"
   :widths: 15, 30

   "request","Sends a REST API request."
   "options","Sends the OPTIONS request. See :ref:`options <options-action>`."
   "cget","Sends the GET request for a list of entities. See :ref:`get_list <get-list-action>` action."
   "get","Sends the GET request for a single entity. See :ref:`get <get-action>` action."
   "post","Sends the POST request for an entity resource. See :ref:`create <create-action>` action. If the second parameter is a file name, the file should be located in the ``requests`` directory next to the PHP file that contains the test."
   "patch","Sends the PATCH request for a single entity. See update action. If the second parameter is a file name, the file should be located in the ``requests`` directory next to the PHP file that contains the test."
   "delete","Sends the DELETE request for a single entity. See :ref:`delete <delete-action>` action."
   "cdelete","Sends the DELETE request for a list of entities. See :ref:`delete_list <delete-list-action>` action."
   "getSubresource","Sends the GET request for a sub-resource of a single entity. See :ref:`get_subresource <get-subresource-action>` action."
   "postSubresource","Sends the POST request for a sub-resource of a single entity. See :ref:`add_relationship <add-relationship-action>` action"
   "patchSubresource","Sends the PATCH request for a sub-resource of a single entity. See :ref:`update_relationship <update-action>` action."
   "deleteSubresource","Sends the DELETE request for a sub-resource of a single entity. See :ref:`delete_relationship <delete-relationship-action>` action."
   "getRelationship","Sends the GET request for a relationship of a single entity. See :ref:`get_relationship <get-relationship-action>` action."
   "postRelationship","Sends the POST request for a relationship of a single entity. See :ref:`add_relationship <add-relationship-action>` action."
   "patchRelationship","Sends the PATCH request for a relationship of a single entity. See :ref:`update_relationship <update-relationship-action>` action."
   "deleteRelationship","Sends the DELETE request for a relationship of a single entity. See :ref:`delete_relationship <delete-relationship-action>` action."
   "updateResponseContent","Replaces all values in the given expected response content with corresponding value from the actual response content when the key of an element is equal to the given key and the value of this element is equal to the given placeholder. If the first parameter is a file name, the file should be located in the ``responses`` directory next to the PHP file that contains the test."
   "assertResponseContains","Asserts that the response content contains the given data. If the first parameter is a file name, the file should be located in the ``responses`` directory next to the PHP file that contains the test."
   "assertResponseCount","Asserts that the response contains the given number of data items."
   "assertResponseNotEmpty","Asserts that the response data are not empty."
   "assertResponseNotHasAttributes","Asserts that the response content does not contain the given attributes."
   "assertResponseNotHasRelationships","Asserts that the response content does not contain the given relationships."
   "assertResponseValidationError","Asserts that the response content contains one validation error and it is the given error."
   "assertResponseContainsValidationError","Asserts that the response content contains the given validation error."
   "assertResponseValidationErrors","Asserts that the response content contains the given validation errors and only them."
   "assertResponseContainsValidationErrors","Asserts that the response content contains the given validation errors."
   "assertAllowResponseHeader","Asserts ``Allow`` response header equals to the expected value."
   "assertMethodNotAllowedResponse","Asserts response status code equals to 405 (Method Not Allowed) and ``Allow`` response header equals to the expected value."
   "dumpYmlTemplate","Saves a response content to a YAML file. If the first parameter is a file name, the file is saved into the responses directory next to the PHP file that contains the test."
   "getResourceId","Extracts the JSON:API resource identifier from the response. For details, see |JSON.API specification|."
   "getNewResourceIdFromIncludedSection","Extracts the JSON:API resource identifier from the ``included`` section of the response. For details, see :ref:`Create and Update Related Resources Together with a Primary API Resource <create-update-related-resources>`"
   "getRequestData","Converts the given request to an array that can be sent to the server. The given request can be a path to a file that contains the request data or an array with the request data. If the request is a file name, the file should be located in the ``requests`` directory next to the PHP file that contains the test."
   "loadResponseData","Loads the response content. The given response can be a path to a file that contains the response data or an array with the response data. If the response is a file name, the file should be located in the ``responses`` directory next to the PHP file that contains the test."
   "getResponseErrors","Extracts the list of errors from the JSON:API response. For details, see |JSON.API specification|."
   "getApiBaseUrl","Returns the base URL for all REST API requests, e.g. ``http://localhost/api`` . "
   "appendEntityConfig","Appends a configuration of an entity. This method is helpful when you create a general functionality and need to test it for different configurations without creating a test entity for each of them. Please note that the configuration is restored after each test and thus, you do not need to do it manually."

.. note:: By default, HATEOAS is disabled in functional tests, although it is enabled by default in production and API Sandbox. It was done to avoid cluttering up the tests with HATEOAS links. In case you want to enable HATEOAS for your test, use HTTP_HATEOAS server parameter, e.g. ``$this->cget(['entity' => 'products']), [],      ['HTTP_HATEOAS' => true]``.

.. _api-load-fixtures:

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

The ``dependencies`` section can be used if a fixture depends on another Doctrine or Alice fixtures. References are shared between Alice and Doctrine fixtures.

.. _api-alice-references:

Alice References
----------------

You can use references in Alice fixtures:

::

    @product-1

Use methods of properties with references:

::

    @product-2->createdAt->format("Y-m-d\TH:i:s\Z")

.. _yaml-templates:

YAML Templates
--------------

A YAML template is a regular YAML file. The only difference is that you can use references and fakers in values. They will be processed by Alice and replaces with the appropriate real values. For details, see the |Alice documentation|.

.. _assert-expectations:

Assert the Expectations
-----------------------

Assert the expected response by using YAML templates.

A YAML template:

.. code:: yaml

    data:
        -
            type: inventorylevels
            id: '@warehouse_inventory_level.warehouse.1.product_unit_precision.product-1.liter->id'
            attributes:
                quantity: '10'
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

.. _yaml-templates-for-request-body:

YAML Templates for a Request Body
---------------------------------

You can use an array with references for a request body:

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

Alternatively, you can store YAML in a ``.yml`` file:

.. code:: php

    public function testCreateCustomer()
    {
        $this->post(
            ['entity' => 'customers'],
            'create_customer.yml' // loads data from __DIR__ . '/requests/create_customer.yml'
        );
    }

.. _process-single-reference:

Process Single Reference
------------------------

To process a single reference, e.g. to compare it with another value:

.. code:: php

    self::processTemplateData('@inventory_level.product_unit_precision.product-1.liter->quantity')

The ``processTemplateData`` method can process a string, an array, or a YAML file.

.. _dump-response-into-yaml-template:

Dump the Response into a YAML Template
--------------------------------------

When you develop new tests for REST API, it may be convenient to dump responses into a YAML template:

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

.. important:: Do not forget to check references after you dump a response for the first time: there can be collisions if references have the same IDs.

Base Test Cases for Unit Tests
------------------------------

To simplify |unit testing| of :ref:`API processors <web-api--processors>`, one of the following base classes can be used:

.. csv-table::
   :header: "Class","Action"

    "|GetProcessorTestCase|",":ref:`get <get-action>`"
    "|GetProcessorOrmRelatedTestCase|",":ref:`get <get-action>`"
    "|GetListProcessorTestCase|",":ref:`get_list <get-list-action>`"
    "|GetListProcessorOrmRelatedTestCase|",":ref:`get_list <get-list-action>`"
    "|CreateProcessorTestCase|",":ref:`create <create-action>`"
    "|UpdateProcessorTestCase|",":ref:`update <update-action>`"
    "|FormProcessorTestCase|",":ref:`create <create-action>`, :ref:`update <update-action>`"
    "|DeleteProcessorTestCase|",":ref:`delete <delete-action>`"
    "|DeleteListProcessorTestCase|",":ref:`delete_list <delete-list-action>`"
    "|GetSubresourceProcessorTestCase|",":ref:`get_subresource <get-subresource-action>`, :ref:`get_relationship <get-relationship-action>`"
    "|GetSubresourceProcessorOrmRelatedTestCase|",":ref:`get_subresource <get-subresource-action>`, :ref:`get_relationship <get-relationship-action>`"
    "|ChangeSubresourceProcessorTestCase|",":ref:`update_subresource <update-subresource-action>`, :ref:`add_subresource <add-subresource-action>`, :ref:`delete_subresource <delete-subresource-action>`"
    "|ChangeRelationshipProcessorTestCase|",":ref:`update_relationship <update-relationship-action>`, :ref:`add_relationship <add-relationship-action>`, :ref:`delete_relationship <delete-relationship-action>`"
    "|OptionsProcessorTestCase|",":ref:`options <options-action>`"
    "|ConfigProcessorTestCase|",":ref:`get_config <get-config-action>`"
    "|MetadataProcessorTestCase|",":ref:`get_metadata <get-metadata-action>`"

.. include:: /include/include-links-dev.rst
   :start-after: begin
