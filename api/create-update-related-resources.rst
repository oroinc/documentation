.. _web-services-api--create-update-related-resources:

Creating and Updating Related Resources with Primary API Resource
=================================================================

Sometimes, it is required to create or update the related resources while creating or updating the primary API resource, especially when creating a complex API resource object via a single API request. Unfortunately, the |JSON:API specification| does not describe how to do this. The solution proposed by OroPlatform is to use the **included** section of a JSON request body as in the example below:

**Request**

.. code-block:: http
    :linenos:

    POST /api/accounts HTTP/1.1
    Content-Type: application/vnd.api+json

**Request Body**

.. code-block:: json
    :linenos:

    {"data": {
        "type": "accounts",
        "id": "1",
        "attributes": {
          "name": "Cloth World"
        },
        "relationships": {
          "organization": {
            "data": {"type": "organizations", "id": "1"}
          },
          "owner": {
            "data": {"type": "users", "id": "1"}
          },
          "contacts": {
            "data": [
              {"type": "contacts", "id": "8da4d8e7-6b25-4c5c-8075-b510f7bbb84f"},
              {"type": "contacts", "id": "707dda0d-35f5-47b9-b2ce-a3e92b9fdee7"}
            ]
          },
          "defaultContact": {
            "data": {"type": "contacts", "id": "707dda0d-35f5-47b9-b2ce-a3e92b9fdee7"}
          }
        }
      },
      "included": [
        {
          "type": "contacts",
          "id": "8da4d8e7-6b25-4c5c-8075-b510f7bbb84f",
          "attributes": {
            "firstName": "John",
            "lastName": "Doe"
          },
          "relationships": {
            "organization": {
              "data": {"type": "organizations", "id": "1"}
            },
            "owner": {
              "data": {"type": "users", "id": "1"}
            },
            "source": {
              "data": {"type": "contactsources", "id": "tv"}
            }
          }
        },
        {
          "type": "contacts",
          "id": "707dda0d-35f5-47b9-b2ce-a3e92b9fdee7",
          "attributes": {
            "firstName": "Nancy",
            "lastName": "Jones"
          },
          "relationships": {
            "organization": {
              "data": {"type": "organizations", "id": "1"}
            },
            "owner": {
              "data": {"type": "users", "id": "1"}
            }
          }
        }
      ]
    }

**Response**

.. code-block:: json
    :linenos:

    {"data": {
        "type": "accounts",
        "id": "52",
        "attributes": {
          "name": "Cloth World"
        },
        "relationships": {
          "organization": {
            "data": {"type": "organizations", "id": "1"}
          },
          "owner": {
            "data": {"type": "users", "id": "1"}
          },
          "contacts": {
            "data": [
              {"type": "contacts", "id": "79"},
              {"type": "contacts", "id": "80"}
            ]
          },
          "defaultContact": {
            "data": {"type": "contacts", "id": "80"}
          }
        }
      },
      "included": [
        {
          "type": "contacts",
          "id": "79",
          "meta": {
            "includeId": "8da4d8e7-6b25-4c5c-8075-b510f7bbb84f"
          },
          "attributes": {
            "firstName": "John",
            "lastName": "Doe"
          },
          "relationships": {
            "organization": {
              "data": {"type": "organizations", "id": "1"}
            },
            "owner": {
              "data": {"type": "users", "id": "1"}
            },
            "source": {
              "data": {"type": "contactsources", "id": "tv"}
            },
            "accounts": {
              "data": [
                {"type": "accounts", "id": "52"}
              ]
            }
          }
        },
        {
          "type": "contacts",
          "id": "80",
          "meta": {
            "includeId": "707dda0d-35f5-47b9-b2ce-a3e92b9fdee7"
          },
          "attributes": {
            "firstName": "Nancy",
            "lastName": "Jones"
          },
          "relationships": {
            "organization": {
              "data": {"type": "organizations", "id": "1"}
            },
            "owner": {
              "data": {"type": "users", "id": "1"}
            },
            "accounts": {
              "data": [
                {"type": "accounts", "id": "52"}
              ]
            }
          }
        }
      ]
    }

This request does the following:

1. Creates the account 'Cloth World'.

2. Creates two contacts, 'John Doe' and 'Nancy Jones'.

3. Assigns these contacts to the account 'Cloth World'.

4. Makes 'Nancy Jones' the default contact for 'Cloth World'.

Please pay attention to the identifiers of the contacts. For 'John Doe' it is '8da4d8e7-6b25-4c5c-8075-b510f7bbb84f'. For 'Nancy Jones' it is '707dda0d-35f5-47b9-b2ce-a3e92b9fdee7'. These identifiers are used to specify relations between resources in scope of the request. In this example, GUIDs are used, but it is possible to use any algorithm to generate such identifiers. The only requirement is that they must be unique in scope of the request. For example, the following identifiers are valid as well: 'john_doe' and 'nancy_jones'.

Also, it is possible to update several related resources via a single API request. The related resources to be updated should be marked with **update** meta property. For instance, take a look at the following request:

**Request**

.. code-block:: http
    :linenos:

    PATCH /api/accounts/52 HTTP/1.1
    Content-Type: application/vnd.api+json

**Request Body**

.. code-block:: json
    :linenos:

    {"data": {
        "type": "accounts",
        "id": "52",
        "attributes": {
          "name": "Cloth World Market"
        },
        "relationships": {
          "defaultContact": {
            "data": {"type": "contacts", "id": "79"}
          }
        }
      },
      "included": [
        {
          "meta": {
              "update": true
          },
          "type": "contacts",
          "id": "79",
          "attributes": {
            "primaryEmail": "john_doe@example.com"
          }
        }
      ]
    }

**Response**

.. code-block:: json
    :linenos:

    {"data": {
        "type": "accounts",
        "id": "52",
        "attributes": {
          "name": "Cloth World Market"
        },
        "relationships": {
          "defaultContact": {
            "data": {"type": "contacts", "id": "79"}
          }
        }
      },
      "included": [
        {
          "type": "contacts",
          "id": "79",
          "meta": {
            "includeId": "79"
          },
          "attributes": {
            "primaryEmail": "john_doe@example.com"
          }
        }
      ]
    }

This request does the following:

1. Changes the account name to 'Cloth World Market'.

2. Sets the primary email for the contact with identifier '79' and makes it the default contact.

All included resources in а request must be connected to the primary resource and this must be explicitly specified
in the request. You can specify the connection in both ways, from the primary resource to the included resource,
and vise versa. The following examples are equivalent:

.. code-block:: json
    :linenos:

    {"data": {
        "type": "accounts",
        "id": "52",
        "relationships": {
          "contact": {
            "data": {"type": "contacts", "id": "79"}
          }
        }
      },
      "included": [
        {
          "meta": {
              "update": true
          },
          "type": "contacts",
          "id": "79",
          "attributes": {
            "primaryEmail": "john_doe@example.com"
          }
        }
      ]
    }

.. code-block:: json
    :linenos:

    {"data": {
        "type": "accounts",
        "id": "52"
      },
      "included": [
        {
          "meta": {
              "update": true
          },
          "type": "contacts",
          "id": "79",
          "attributes": {
            "primaryEmail": "john_doe@example.com"
          },
          "relationships": {
            "account": {
              "data": {"type": "accounts", "id": "52"}
            }
          }
        }
      ]
    }


.. include:: /include/include-links-dev.rst
   :start-after: begin
