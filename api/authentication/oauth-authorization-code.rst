.. _web-services-api--authentication--oauth-authorization-code:

Authorization Code Grant Type
=============================

Obtain the Authorization Code
-----------------------------

The client application redirects the user to the authorization server.
For storefront application, this redirect should be send to the ``https://yourapplication/oauth2-token/authorize`` URL.
If the Commerce application is installed, then for the back-office application, the redirect should be send to the
``https://yourapplication/{backend_prefix}/oauth2-token/authorize`` URL, where {backend_prefix} is the current backend prefix
(by default, it is `admin`). Otherwise, the redirect is sent to the ``https://yourapplication/oauth2-token/authorize`` URL.

The request should have the following parameters in the query string:

   * `response_type` with the `code` value
   * `client_id` with the client identifier
   * `redirect_uri` with the client redirect URI. This parameter is optional, but if it is not sent, the user will be redirected to a pre-registered redirect URI.

The user is then asked to log in to the authorization server and approve the client.

Once the user approves the client, they are redirected from the authorization server to the client’s redirect URI with the following parameters in the query string:

   * `code` with the authorization code value.

Generate Token
--------------

Once the code is obtained, a client sends a request to get the access token.
To configure the authentication via the authorization code grant type and to retrieve the access token, proceed with the following steps:

1. Provide your **Request URL**.

   The Request URL consists of your application URL and the /oauth2-token slug, e.g., ``https://yourapplication/oauth2-token``

2. Specify the content-type in headers:

   `Content-Type: application/json`

3. Send a POST request with the following body parameters to the authorization server:

   * `grant_type` with the value `authorization_code`
   * `client_id` with the client’s ID
   * `client_secret` with the client’s secret ID
   * `redirect_uri` with the same redirect URI the user was redirect back to
   * `code` with the authorization code from the query string.

4. Receive response from the authorization server with a JSON object containing the following properties:

   * `token_type` with the value `Bearer`
   * `expires_in` = 3600 seconds. Once the token is generated, it is valid for an hour and can be used multiple times within this time limit to request the necessary data. Expiration time can by configured in config.yml.
   * `access_token` a JSON web token signed with the authorization server’s private key

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
        "grant_type": "authorization_code",
        "client_id": "your client identifier",
        "client_secret": "your client secret",
        "redirect_uri": "redirect URI the user was redirect back to",
        "code": "your authorization code"
    }

Response Body

.. code-block:: json
    :linenos:

    {
        "token_type": "Bearer",
        "expires_in": 3600,
        "access_token": "your access token"
    }

The received access token can be used multiple times until it expires. A new token should be requested once
the previous token expires.

An example of an API request:

.. code-block:: http
    :linenos:

    GET /api/users HTTP/1.1
    Accept: application/vnd.api+json
    Authorization: Bearer your access token

.. note:: Access tokens for back-office and storefront API are not interchangeable. If you attempt to request data for the storefront API with a token generated for the back-office application, access will be denied.
