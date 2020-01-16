.. _web-services-api--filters:

Filters
=======

You can perform the GET and DELETE methods on a subset of resource records. A subset of records can be received by applying filters to some of the resource fields.

Available filters are listed in the **Documentation** tab of the method's expanded area, in the **Filters** section.

To filter, perform the GET request and put your filters parameters in the query string.

**Ex 1. Filter in a Query String**

Retrieve all users of organization '1'.

*Request*

.. code-block:: http
    :linenos:

    GET /api/users?filter[organization]=1 HTTP/1.1


Similar to a field, a filter declares a data type and only takes specific values in the input.

Below are examples of requests and errors.

**Ex 2. Wrong Input Type**

A string value is passed as an input to a filter which can contain only integer values.

.. code-block:: http
    :linenos:

    GET /api/users?filter[id]=aaa HTTP/1.1

    { "errors": [{
      "status": "400",
      "title": "unexpected value exception",
      "detail": "Expected integer value. Given \"aaa\".",
      "source": {
        "parameter": "filter[id]"
      }
    }] }


**Ex 3. Unknown Filter**

Unknown, mistyped or unsupported filter.

.. code-block:: http
    :linenos:

    GET /api/users?filter[unknown]=aaa HTTP/1.1

    { "errors": [{
      "status": "400",
      "title": "filter constraint",
      "detail": "Filter \"filter[unknown]\" is not supported.",
      "source": {
        "parameter": "filter[unknown]"
      }
    }] }



The API enables you to use several types of filters. Filter types are briefly described in the table below.


+---------+------------------------------+-----------------------------------------------------------------------------+
| Filter  | Usage Example                | Description                                                                 |
+=========+==============================+=============================================================================+
| fields  | fields[owner]=id,name        | Used for limiting the response data only to specified fields.               |
|         |                              | Depends on the **include** filter if the filter is applied to a relation.   |
+---------+------------------------------+-----------------------------------------------------------------------------+
| filter  | filter[id]=1                 | Used for filtering the response data by specific values of a specific       |
|         | or                           | field. Can accept additional operators like ``<``, ``>``, etc.              |
|         | filter[id]=5,7               |                                                                             |
|         | or                           | A filter may be a key-value pair delimited by an operator,                  |
|         | filter[id]>8&filter[name]=a  | e.g. "filter[id]>8",                                                        |
|         | or                           | or may be specified using the syntax "key[operator_name]=value".            |
|         | filter[id][neq]=8            | The full list of supported operators is described in                        |
|         | or                           | the :ref:`Data Filter (filter) <web-services-api--filters--data>` section.  |
|         | filter[id]=5..7              |                                                                             |
|         |                              | May accept several values separated by comma. In such case,                 |
|         |                              | they will be considered connected by the logical ``OR`` operator,           |
|         |                              | e.g. id == 5 OR id == 7                                                     |
|         |                              |                                                                             |
|         |                              | May accept a data range. The syntax is "from_value..to_value".              |
|         |                              | The range is inclusive (i.e. it includes the interval boundaries,           |
|         |                              | and the same range can be obtained by executing the following               |
|         |                              | expression: field >= from_value AND field <= to_value)                      |
|         |                              |                                                                             |
|         |                              | And in case of several filters in request, all of them will be perceived as |
|         |                              | connected using a logical ``AND`` operator,                                 |
|         |                              | e.g. id > 8 AND name == 'a'                                                 |
+---------+------------------------------+-----------------------------------------------------------------------------+
| include | include=[owner,organization] | Used for inclusion into response the related resources data.                |
+---------+------------------------------+-----------------------------------------------------------------------------+
| page    | page[size]=10&page[number]=1 | Used for pagination purposes.                                               |
+---------+------------------------------+-----------------------------------------------------------------------------+
| sort    | sort=id                      | Used for data sorting. By default the ASC sorting applies.                  |
|         | or                           |                                                                             |
|         | sort=id,-name                | To perform DESC sorting specify ``-`` before field name.                    |
+---------+------------------------------+-----------------------------------------------------------------------------+
| meta    | meta=property1,property2     | Used for requesting additional meta properties for API resources.           |
+---------+------------------------------+-----------------------------------------------------------------------------+


.. _web-services-api--filters--fields:

Fields Filter (**fields**)
--------------------------

All objects are composed of fields. By default, all fields are returned in API response.

To request particular fields, use the **fields** filter and specify the fields you need in the response as its values.

.. important::

    We recommend you always to use the fields filter and retrieve only the fields you will use in your application.


**Example of Retrieving Only Required Fields**

Select the **username** and the **email** fields of the **users** resource.

    *Request*

    .. code-block:: http
        :linenos:

        GET api/users?fields[users]=username,email HTTP/1.1

        Content-Type: application/vnd.api+json
        Accept: application/vnd.api+json
        ...

    *Response*

    .. code-block:: json
        :linenos:

        {
          "data": [
            {
              "type": "users",
              "id": "1",
              "attributes": {
                "username": "admin",
                "email": "admin@local.com"
              }
            },
            {
              "type": "users",
              "id": "2",
              "attributes": {
                "username": "sale",
                "email": "sale@example.com"
              }
            }
          ]
        }

.. _web-services-api--filters--data:

Data Filter (**filter**)
------------------------

Depending on the type of the filter, certain operators are allowed. For example, by default for integer filter type it
is allowed to use eight operators: **=**, **!=**, **<**, **<=**, **>**, **>=**, **\***, **!\***,
for string filter type - only four: **=**, **!=**, **\***, **!\***.
The operators **~**, **!~**, **^**, **!^**, **$**, **!$** are not allowed by default and should be enabled
by a developer who creates API resources.


+----------+---------------------+-----------------------+-------------+------------------------------------------------------------+
| Operator | Operator Name       | Description           | URL Encoded | Request Example                                            |
+==========+=====================+=======================+=============+============================================================+
| **=**    | **eq**              | Equality for fields   | %3D         | | GET /api/users?filter[id]=1 HTTP/1.1                     |
|          |                     | and *to-one*          |             | | GET /api/users?filter[id][eq]=1 HTTP/1.1                 |
|          |                     | associations          |             |                                                            |
|          |                     |                       |             |                                                            |
|          |                     | Contains any of       |             |                                                            |
|          |                     | specified element     |             |                                                            |
|          |                     | for *to-many*         |             |                                                            |
|          |                     | associations          |             |                                                            |
+----------+---------------------+-----------------------+-------------+------------------------------------------------------------+
| **!=**   | **neq**             | Inequality for        | %21%3D      | | GET /api/users?filter[id]!=2 HTTP/1.1                    |
|          |                     | fields and *to-one*   |             | | GET /api/users?filter[id][neq]=2 HTTP/1.1                |
|          |                     | associations          |             |                                                            |
|          |                     |                       |             |                                                            |
|          |                     | Not contains any of   |             |                                                            |
|          |                     | specified element     |             |                                                            |
|          |                     | for *to-many*         |             |                                                            |
|          |                     | associations          |             |                                                            |
+----------+---------------------+-----------------------+-------------+------------------------------------------------------------+
| **<**    | **lt**              | Less than             | %3C         | | GET /api/users?filter[id]<3 HTTP/1.1                     |
|          |                     |                       |             | | GET /api/users?filter[id][lt]=3 HTTP/1.1                 |
+----------+---------------------+-----------------------+-------------+------------------------------------------------------------+
| **<=**   | **lte**             | Less than or equal    | %3C%3D      | | GET /api/users?filter[id]<=4 HTTP/1.1                    |
|          |                     |                       |             | | GET /api/users?filter[id][lte]=4 HTTP/1.1                |
+----------+---------------------+-----------------------+-------------+------------------------------------------------------------+
| **>**    | **gt**              | Greater than          | %3E         | | GET /api/users?filter[id]>5 HTTP/1.1                     |
|          |                     |                       |             | | GET /api/users?filter[id][gt]=5 HTTP/1.1                 |
+----------+---------------------+-----------------------+-------------+------------------------------------------------------------+
| **>=**   | **gte**             | Greater than or equal | %3E%3D      | | GET /api/users?filter[id]>=6 HTTP/1.1                    |
|          |                     |                       |             | | GET /api/users?filter[id][gte]=6 HTTP/1.1                |
+----------+---------------------+-----------------------+-------------+------------------------------------------------------------+
| **\***   | **exists**          | Is not null for       | %2A         | | GET /api/users?filter[id]\*yes HTTP/1.1                  |
|          |                     | fields and *to-one*   |             | | GET /api/users?filter[id][exists]=yes HTTP/1.1           |
|          |                     | associations and      |             | | GET /api/users?filter[id]\*no HTTP/1.1                   |
|          |                     | is not empty for      |             | | GET /api/users?filter[id][exists]=no HTTP/1.1            |
|          |                     | *to-many* associations|             |                                                            |
|          |                     | if filter value is    |             |                                                            |
|          |                     | *true*, *1* or *yes*  |             |                                                            |
|          |                     |                       |             |                                                            |
|          |                     | Is null for           |             |                                                            |
|          |                     | fields and *to-one*   |             |                                                            |
|          |                     | associations and      |             |                                                            |
|          |                     | is empty for *to-many*|             |                                                            |
|          |                     | associations if       |             |                                                            |
|          |                     | filter value is       |             |                                                            |
|          |                     | *false*, *0* or *no*  |             |                                                            |
+----------+---------------------+-----------------------+-------------+------------------------------------------------------------+
| **!\***  | **neq_or_null**     | Inequal or is null    | %21%2A      | | GET /api/users?filter[id]!\*test HTTP/1.1                |
|          |                     | for fields and        |             | | GET /api/users?filter[id][neq_or_null]=test HTTP/1.1     |
|          |                     | *to-one* associations |             |                                                            |
|          |                     |                       |             |                                                            |
|          |                     | Inequal or empty      |             |                                                            |
|          |                     | for *to-many*         |             |                                                            |
|          |                     | associations          |             |                                                            |
+----------+---------------------+-----------------------+-------------+------------------------------------------------------------+
| **~**    | **contains**        | Contains a text       | %7E         | | GET /api/users?filter[id]~test HTTP/1.1                  |
|          |                     | for *string* fields   |             | | GET /api/users?filter[id][contains]=test HTTP/1.1        |
|          |                     |                       |             |                                                            |
|          |                     | Contains all          |             |                                                            |
|          |                     | specified elements    |             |                                                            |
|          |                     | for *to-many*         |             |                                                            |
|          |                     | associations          |             |                                                            |
+----------+---------------------+-----------------------+-------------+------------------------------------------------------------+
| **!~**   | **not_contains**    | Not contains a text   | %21%7E      | | GET /api/users?filter[id]!~test HTTP/1.1                 |
|          |                     | for *string* fields   |             | | GET /api/users?filter[id][not_contains]=test HTTP/1.1    |
|          |                     |                       |             |                                                            |
|          |                     | Not contains all      |             |                                                            |
|          |                     | specified elements    |             |                                                            |
|          |                     | for *to-many*         |             |                                                            |
|          |                     | associations          |             |                                                            |
+----------+---------------------+-----------------------+-------------+------------------------------------------------------------+
| **^**    | **starts_with**     | Starts with a text    | %5E         | | GET /api/users?filter[id]^test HTTP/1.1                  |
|          |                     |                       |             | | GET /api/users?filter[id][starts_with]=test HTTP/1.1     |
+----------+---------------------+-----------------------+-------------+------------------------------------------------------------+
| **!^**   | **not_starts_with** | Not starts with       | %21%5E      | | GET /api/users?filter[id]!^test HTTP/1.1                 |
|          |                     | a text                |             | | GET /api/users?filter[id][not_starts_with]=test HTTP/1.1 |
+----------+---------------------+-----------------------+-------------+------------------------------------------------------------+
| **$**    | **ends_with**       | Ends with a text      | %24         | | GET /api/users?filter[id]$test HTTP/1.1                  |
|          |                     |                       |             | | GET /api/users?filter[id][ends_with]=test HTTP/1.1       |
+----------+---------------------+-----------------------+-------------+------------------------------------------------------------+
| **!$**   | **not_ends_with**   | Not ends with         | %21%24      | | GET /api/users?filter[id]!$test HTTP/1.1                 |
|          |                     | a text                |             | | GET /api/users?filter[id][not_ends_with]=test HTTP/1.1   |
+----------+---------------------+-----------------------+-------------+------------------------------------------------------------+

**Example of Using Operators to Filter Data**

*Request*

.. code-block:: http
    :linenos:

    GET /api/users?filter[id]>5$page[number]=1&page[size]=2&fields[users]=username,email HTTP/1.1

    Content-Type: application/vnd.api+json
    Accept: application/vnd.api+json
    ...

*Response*

.. code-block:: json
    :linenos:

    {
      "data": [
        {
          "type": "users",
          "id": "6",
          "attributes": {
            "username": "jimmy.henderson_c4261",
            "email": "jimmy.henderson_c428e@example.com"
          }
        },
        {
          "type": "users",
          "id": "7",
          "attributes": {
            "username": "gene.cardenas_c760d",
            "email": "gene.cardenas_c7620@yahoo.com"
          }
        }
      ]
    }


.. _web-services-api--filters--inclusion:

Inclusion Filter (**include**)
------------------------------

As mentioned above, the **include** filter allows you to extend the response data with the related resources information.
It is usually used to reduce the number of requests to the server or, in other words, to retrieve all the necessary data
in a single request.

All included resources will be represented in **included** section at the end of the response body.

.. image:: /img/backend/api/api_filter_included.png
   :alt: An included section at the end of the response body

.. important::

    Please note, in case of using **fields** filter for the main resource (e.g. users), it must contain
    the field(s) used in the **include** filter.

**Example of Including Related Resources Information**

Include the **roles** relation with the **fields** filter.

*Request*

.. code-block:: http
    :linenos:

    GET api/users?fields[users]=username,email,roles&include=roles&page[number]=1&page[size]=1 HTTP/1.1

    Content-Type: application/vnd.api+json
    Accept: application/vnd.api+json
    ...

*Response*

.. code-block:: json
    :linenos:

    {
      "data": [
        {
          "type": "users",
          "id": "1",
          "attributes": {
            "username": "admin",
            "email": "admin@local.com"
          },
          "relationships": {
            "roles": {
              "data": [
                {
                  "type": "userroles",
                  "id": "3"
                }
              ]
            }
          }
        }
      ],
      "included": [
        {
          "type": "userroles",
          "id": "3",
          "attributes": {
            "extend_description": null,
            "role": "ROLE_ADMINISTRATOR",
            "label": "Administrator"
          },
          "relationships": {
            "organization": {
              "data": null
            }
          }
        }
      ]
    }


Also, it is possible to limit fields that will be retrieved from the relation. For such purposes, the **fields** filter
should be used.

**Example of Retrieving Only Required Fields of a Related Resource**

*Request*

.. code-block:: http
    :linenos:

    GET api/users?fields[userroles]=label&fields[users]=username,email,roles&include=roles&page[number]=1&page[size]=1 HTTP/1.1

    Content-Type: application/vnd.api+json
    Accept: application/vnd.api+json
    ...

*Response*

.. code-block:: json
    :linenos:

    {
      "data": [
        {
          "type": "users",
          "id": "1",
          "attributes": {
            "username": "admin",
            "email": "admin@local.com"
          },
          "relationships": {
            "roles": {
              "data": [
                {
                  "type": "userroles",
                  "id": "3"
                }
              ]
            }
          }
        }
      ],
      "included": [
        {
          "type": "userroles",
          "id": "3",
          "attributes": {
            "label": "Administrator"
          }
        }
      ]
    }


.. _web-services-api--filters--pagination:

Pagination Filter (**page**)
----------------------------

By default, the page size is limited to 10 records and the page number is 1. However, it is possible to ask the server to
change the page size or page number to get the records that will fit your needs. Pagination
parameters should be passed as the parameters of the query string.


+----------------+---------+---------------+---------------------------------------------------------------------+
| Parameter name | Type    | Default value | Description                                                         |
+================+=========+===============+=====================================================================+
| page[size]     | integer | 10            | Set a positive integer number.                                      |
|                |         |               | To disable the pagination, set it as -1. In this case               |
|                |         |               | **page[number]** will not be taken into account and can be omitted. |
+----------------+---------+---------------+---------------------------------------------------------------------+
| page[number]   | integer | 1             | The number of the page.                                             |
+----------------+---------+---------------+---------------------------------------------------------------------+


**Example of Retrieving a Particular Page of a Paged Response**

Get the 2nd page of the retrieved records for the **users** resource with 20 records per page.

*Request*

.. code-block:: http
    :linenos:

    GET /api/users?page[number]=2&page[size]=20 HTTP/1.1

    Content-Type: application/vnd.api+json
    Accept: application/vnd.api+json
    ...


.. _web-services-api--filters--sorting:

Sorting Filter (**sort**)
-------------------------

When the response to your call is a list of objects, you can also sort this list by using the sort filter with any of the
available values listed in the API reference.

**Example of Sorting by a Field Value**

Sort by **username** in descending order.

*Request*

.. code-block:: http
    :linenos:

    GET /api/users?filter[id]>5$page[number]=1&page[size]=2&fields[users]=username,email&sort=-username HTTP/1.1

    Content-Type: application/vnd.api+json
    Accept: application/vnd.api+json
    ...

*Response*

.. code-block:: json
    :linenos:

    {
      "data": [
        {
          "type": "users",
          "id": "24",
          "attributes": {
            "username": "william.morrison_247fe",
            "email": "william.morrison_2482c@msn.com"
          }
        },
        {
          "type": "users",
          "id": "31",
          "attributes": {
            "username": "victor.nixon_54050",
            "email": "victor.nixon_5406f@gmail.com"
          }
        }
      ]
    }


.. _web-services-api--filters--meta:

Meta Property Filter (**meta**)
-------------------------------

The **meta** filter allows you to request additional meta properties for the resource. Meta properties will be generated for every item and will be returned in the item's meta object in the response data.

The following table contains a list of supported meta properties that may be requested using *?meta=meta_property_name* filter:

+---------------+----------------------------------------+
| Name          | Description                            |
+===============+========================================+
| title         | A text representation of the resource. |
+---------------+----------------------------------------+

**Example of Retrieving Text Representation of the Resource**

    *Request*

    .. code-block:: http
        :linenos:

        GET api/users?meta=title HTTP/1.1

        Content-Type: application/vnd.api+json
        Accept: application/vnd.api+json
        ...

    *Response*

    .. code-block:: json
        :linenos:

        {
          "data": [
            {
              "type": "users",
              "id": "1",
              "meta": {
                "title": "John Doe",
              },
              "attributes": {
                "username": "john.doe",
              }
            },
            {
              "type": "users",
              "id": "2",
              "meta": {
                "title": "Ellen Rowell",
              },
              "attributes": {
                "username": "ellen.rowell"
              }
            }
          ]
        }


.. include:: /include/include-images.rst
   :start-after: begin
