.. _web-services-api--validate-operation:

Validating a Resource
=====================

When creating or updating a primary API resource, you may need to validate it without persisting.

The validation is triggered in the |JSON:API: Meta Section| section via the "validate" option set to ``true``. The validation operation is supported by POST and PATCH requests.

How to Enable
-------------

Resource that supports a validation should be marked with `enable_validation` flag in api.yml:

.. code-block:: yaml
   :caption: config/api.yml

    api:
        // ... skipped
        entities:
            Oro\Bundle\OrderBundle\Entity\Order:
                documentation_resource: '@OroOrderBundle/Resources/doc/api/order.md'
                enable_validation: true # Enables validation operation
        // ... skipped

Then such resource would also contain the corresponding note in the API Sandbox. For example:

.. image:: /img/backend/api/validate_operation_note.png
   :alt: An example of the validate operation note

Implementation Details
----------------------

Unlike the regular create or update action, the `validate` meta flag forces a database transaction rollback in the ``\Oro\Bundle\ApiBundle\Processor\CustomizeFormData\FlushDataHandler``. Keep in mind that the rollback also prevents asynchronous operations (e.g., those triggered by a message in MQ), including search reindexing, sending emails, etc. However, it cannot instantly reverse actions that have already been completed during the processing of an API request (for example, if a file is deleted in one of the API processors). Therefore, if you enable validation on an entity, you need to ensure that no irreversible operations are being carried out during the creation and update actions for that entity. If there are, it is important to either delay or make these operations asynchronous where possible.

Examples
--------

An example of a POST validate requests:

**Request**

.. code-block:: http

    POST /api/orders HTTP/1.1
    Content-Type: application/vnd.api+json
    Accept: application/vnd.api+json

**Request Body**

.. code-block:: json

    {"data": {
        "type": "orders",
        "meta": {
          "validate": true
        },
        "attributes": {
          "identifier": "FR1012401Z",
          "poNumber": "CV032342USDD",
        }
      }
    }

An example of a PATCH validate requests:

**Request**

.. code-block:: http

    PATCH /api/orders/1 HTTP/1.1
    Content-Type: application/vnd.api+json
    Accept: application/vnd.api+json

**Request Body**

.. code-block:: json

    {"data": {
        "type": "orders",
        "id": "1",
        "meta": {
          "validate": true
        },
        "attributes": {
          "customerNotes": "Please, call before delivery"
        }
      }
    }

.. include:: /include/include-links-dev.rst
   :start-after: begin
