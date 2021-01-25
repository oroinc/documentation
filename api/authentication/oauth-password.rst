.. _web-services-api--authentication--oauth-password:

Password Grant Type: Generate Token
===================================

To configure the authentication via the password grant type and retrieve the access token:

1. Provide your **Request URL**.

   The Request URL consists of your application URL and the /oauth2-token slug, e.g., ``https://yourapplication/oauth2-token``

2. Specify the content-type in headers:

   `Content-Type: application/json`

3. Send a POST request with the following body parameters to the authorization server:

   * `grant_type` with the value `password`
   * `client_id` with the client identifier
   * `client_secret` with the client’s secret
   * `username` with the user's username
   * `password` with the user's password

4. Receive response from the authorization server with a JSON object containing the following properties:

   * `token_type` with the value `Bearer`
   * `expires_in` = 3600 seconds. Once the token is generated, it is valid for an hour and can be used multiple times within this time limit to request the necessary data. Expiration time can by configured in config.yml
   * `access_token` a JSON web token signed with the authorization server’s private key
   * `refresh_token` a JSON web token used to request a new token when the `access_token` expires

5. Use the generated access token to make requests to the API.

**Example**

Request

.. code-block:: http
    :linenos:

    POST /oauth2-token HTTP/1.1
    Content-Type: application/json

Request Body

.. code-block:: json
    :linenos:

    {
        "grant_type": "password",
        "client_id": "your client identifier",
        "client_secret": "your client secret",
        "username": "your user username",
        "password": "your user password"
    }

Response Body

.. code-block:: json
    :linenos:

    {
        "token_type": "Bearer",
        "expires_in": 3600,
        "access_token": "your access token",
        "refresh_token" "your refresh token"
    }

The received access token can be used multiple times until it expires.

An example of an API request:

.. code-block:: http
    :linenos:

    GET /api/users HTTP/1.1
    Accept: application/vnd.api+json
    Authorization: Bearer your access token

.. note:: Access tokens for back-office and storefront API are not interchangeable. If you attempt to request data for the storefront API with a token generated for the back-office application, access will be denied.

.. note:: For the storefront API a customer user email address should be used as `username`.

.. note:: To get the access token for a customer visitor for storefront API, use ``guest`` as `username` and `password` in the request to the authorization server. A new customer visitor is created for each created access token.
