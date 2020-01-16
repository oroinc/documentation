.. _web-services-api--response-status-codes:

Response Status Codes
=====================

In case of a successful request, a response status code will be one of the following:

    -   **200 OK**—In the response to successful GET, PATCH or DELETE.

    -   **201 Created**—In the response to POST that results in creation. When this status is received, the request body contains the description of the newly created entity in the JSON format (similar to the regular GET request).

    -   **204 No Content**—In the response to a successful request that won't return a body (like a DELETE request)

**Example of a Successful Request**

*Request*

   .. code-block:: http
       :linenos:

       GET /api/users/1 HTTP/1.1

*Response*

   .. code-block:: http
       :linenos:

       HTTP/1.1 200 OK

       Request URL: http://localhost.com/api/users/1
       Request Method: GET
       Status Code: 200 OK
       Remote Address: 127.0.0.1:80


In case of an error, a response status code indicates the type of an error that has occurred. The most common codes are the following:

    -   **400 Bad Request**—The request is malformed, such as if the body of the request contains misformatted JSON.

    -   **401 Unauthorized**—No or invalid authentication details are provided. This code can be used to trigger an authentication pop-up if the API is used from a browser.

    -   **403 Forbidden**—Authentication succeeded but authenticated user does not have access to the resource.

    -   **404 Not Found**—A non-existent resource is requested.

    -   **500 Internal Server Error**—The server encountered an unexpected condition which prevented it from fulfilling the request.

**Example of a Request Resulted in Error**

*Request*

   .. code-block:: http
       :linenos:

       GET /api/users/999 HTTP/1.1

**Response**

   .. code-block:: http
       :linenos:

       HTTP/1.1 404 Not Found

       Request URL: http://localhost.com/api/users/1
       Request Method: GET
       Status Code: 404 Not Found
       Remote Address: 127.0.0.1:80

