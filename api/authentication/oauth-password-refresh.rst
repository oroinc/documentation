.. _web-services-api--authentication--oauth-password-refresh:

Password Grant Type: Refresh Token
==================================

When the access token expires, you can retrieve the new one with the refresh token. It applies only to the OAuth applications with the Password grant type. The main advantage of using the refresh token is that you do not need to pass login and password every time you request data.

Follow the next steps to get a new token:

1. Provide your **Request URL**.

   The Request URL consists of your application URL and the /oauth2-token slug, e.g., `https://yourapplication/oauth2-token``

2. Specify the content-type in headers:

   `Content-Type: application/json`

3. Send a POST request with the following body parameters to the authorization server:

   * `grant_type` with the value `refresh_token`
   * `client_id` with the client identifier
   * `client_secret` with the client’s secret
   * `refresh_token` with the refresh token that was returned with an access token

4. Receive response from the authorization server with a JSON object containing the following properties:

   * `token_type` with the value `Bearer`
   * `expires_in` = 3600 seconds. Once the token is generated, it is valid for an hour and can be used multiple times within this time limit to request the necessary data. Expiration time can by configured in config.yml
   * `access_token` - a new access token
   * `refresh_token` - a new refresh token used to request a new token when the `access_token` expires

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
        "grant_type": "refresh_token",
        "client_id": "your client identifier",
        "client_secret": "your client secret",
        "refresh_token": "your refresh token was returned with an access token"
    }

Response Body

.. code-block:: json
    :linenos:

    {
        "token_type": "Bearer",
        "expires_in": 3600,
        "access_token": "your new access token",
        "refresh_token" "your new refresh token"
    }
