.. _user-guide--sales--orders--external-orders-import:

Import External Orders in JSON Format
=====================================

.. hint:: This section is part of the :ref:`Data Import <concept-guide-data-import>` concept guide topic that provides guidelines on import operations in Oro applications.

The Import External Orders feature enables you to import the bulk details of external orders created in ERP systems in .json format.

.. important:: Please consider the following when working with imported external orders:

    * This feature supports **import only**. Export of legacy order data is not available.
    * Imported orders are marked as **This order has been imported from the ERP**. Administrators cannot edit these orders after import.
    * Tax calculations, promotional discounts, and payment transactions are not available for legacy orders.
    * All order line items are imported as *free-form line items*. They will link to products only if the product SKU in the import file matches an existing product SKU.
    * Line items without matching SKUs will still be imported but may not be accurately reflected in *Previously Purchased* widgets, *Best Sellers* reports, or similar analytics.

To import external orders:

1. Enable the feature in the system configuration on the :ref:`global <system-configuration-orders-external-order-import>` or :ref:`organization <configuration--commerce--orders--external-order-import--org>` level.
2. Once enabled, navigate to **Sales > Orders** in the main menu.
3. Click **Import File** on the top right.
4. In the **Import** dialog, click **Choose File**, select the .json file you prepared, and then click **Import File**.

.. note: Ensure your .json file is saved in the Unicode (UTF-8) encoding. Otherwise, you may render the content of the file improperly.

.. image:: /user/img/sales/orders/external-orders-import.png
   :alt: The process of importing external orders

5. Click **Download Import Template** to download a sample .json file with the item format.
6. **Prepare data for import**: Create your bulk information in the .json format based on the downloaded file. Once your file is ready, click **Choose File**, select the prepared json file, and click **Import File**.
7. **Validate import results**: Click **Validate** to check your import results. If there are any *Records with errors*, fix them in the .json file before starting the import.
8. **Launch import:** After successful validation, click **Import File**.
9. Click **Cancel** to decline the import.

.. important:: Interactive status messages inform about the import progress, and once the import is complete, the changes are reflected in the list upon refresh. An email message with the import status is also delivered to your mailbox.

**Example of external orders bulk import template**

.. code-block:: json


    [
        {
            "identifier": "EXT123",
            "currency": "USD",
            "customerUser": "AmandaRCole@example.org",
            "lineItems": [
                {
                    "quantity": 1,
                    "currency": "USD",
                    "value": 10.5,
                    "productSku": "TAG1",
                    "productUnit": "item"
                }
            ],
            "shippingAddress": {
                "firstName": "John",
                "lastName": "Doe",
                "city": "Rochester",
                "street": "23400 Caldwell Road",
                "postalCode": "14608",
                "country": "US",
                "region": "US-NY"
            },
            "billingAddress": {
                "firstName": "John",
                "lastName": "Doe",
                "city": "Rochester",
                "street": "23400 Caldwell Road",
                "postalCode": "14608",
                "country": "US",
                "region": "US-NY"
            }
        }
    ]

**Related Topics**

* :ref:`Configure Global External Order Import Settings <system-configuration-orders-external-order-import>`
* :ref:`Configure External Order Import Settings per Organization <configuration--commerce--orders--external-order-import--org>`
* :ref:`Import Custom Format File Via Batch API <dev-integrations-import-export-import-with-custom-format-via-batch-api>`