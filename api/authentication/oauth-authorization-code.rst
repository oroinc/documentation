.. _web-services-api--authentication--oauth-authorization-code:

Authorization Code Grant Type
=============================

The :ref:`OroOAuth2ServerBundle <bundle-docs-platform-oauth2-server-bundle>` supports confidential and public clients.

According to |RFC 6749|, confidential clients are capable of maintaining the confidentiality of their credentials
(e.g., client implemented on a secure server with restricted access to the client credentials), or capable of secure
client authentication using other means. Public clients are incapable of maintaining the confidentiality of their
credentials (e.g., clients executing on the device used by the resource owner, such as an installed native application or a web
browser-based application), and incapable of secure client authentication via any other means.

:ref:`OroOAuth2ServerBundle <bundle-docs-platform-oauth2-server-bundle>` supports |PKCE extention (RFC 7636)|
to the Authorization Code flow to prevent CSRF and authorization code injection attacks.

Obtain the Authorization Code
-----------------------------

The client application redirects the user to the authorization server.
For storefront application, this redirect should be send to the ``https://yourapplication/oauth2-token/authorize`` URL.

If the Commerce application is installed, then for the back-office application, the redirect should be send to the
``https://yourapplication/{backend_prefix}/oauth2-token/authorize`` URL, where {backend_prefix} is the current backend prefix
(by default, it is `admin`). Otherwise, the redirect is sent to the ``https://yourapplication/oauth2-token/authorize`` URL.

The request should have the following parameters in the query string:

   * `response_type` with the value ``code``
   * `client_id` with the client identifier
   * `redirect_uri` with the client redirect URI. This parameter is optional, but if it is not sent, the user will be redirected to a pre-registered redirect URI.

**Example**

.. code-block:: http


    GET /oauth2-token/authorize?response_type=code&client_id=your_client_identifier&redirect_uri=https://your_redirect_uri.com HTTP/1.1


For the public clients, request must and for confidential clients can use the `code_challenge` parameter when obtaining the authorization code
and the `code_verifier` parameter when generating a token request.

The code challenge must be generated with S256 code challenge method according to |Code challenge generation rules| and the parameter `code_challenge_method` with value 'S256' must be part of the request.

**Example**

.. code-block:: http


    GET /oauth2-token/authorize?response_type=code&client_id=your_client_identifier&redirect_uri=https://your_redirect_uri.com&code_challenge=your_code_challenge&code_challenge_method=S256 HTTP/1.1


The user is then asked to log in to the authorization server.

After a successful log in, the user will be redirected to approve the client page.

If the application was created with the `Skip User Consent` option, the approve client page will not be shown and client will be approved automatically.

Once the user approves the client, they are redirected from the authorization server to the client’s redirect URI with the following parameters in the query string:

   * `code` with the authorization code.

Generate Token
--------------

Once the code is obtained, a client sends a request to get the access token.
To configure the authentication via the authorization code grant type and to retrieve the access token, proceed with the following steps:

1. Provide your **Request URL**.

   The Request URL consists of your application URL and the /oauth2-token slug, e.g., ``https://yourapplication/oauth2-token``

2. Specify the content-type in headers:

   `Content-Type: application/json`

3. Send a POST request with the following body parameters to the authorization server:

   * `grant_type` with the value ``authorization_code``
   * `client_id` with the client’s ID
   * `client_secret` with the client’s secret ID. This parameter can be skipped for public clients
   * `redirect_uri` with the same redirect URI the user was redirect back to
   * `code` with the authorization code from the query string
   * `code_verifier` with the string that has been used when obtaining the Authorization Code. The parameter can be skipped for confidential clients if `code_challenge` was not used.

4. Receive response from the authorization server with a JSON object containing the following properties:

   * `token_type` with the value ``Bearer``
   * `expires_in` = 3600 seconds. Once the token is generated, it is valid for an hour and can be used multiple times within this time limit to request the necessary data. Expiration time can by configured in :ref:`config/config.yml <bundle-docs-platform-oauth2-server-bundle--configuration>` of your application.
   * `access_token` a JSON web token signed with the authorization server’s private key

5. Use the generated access token to make requests to the API.

**Example**

Request

.. code-block:: http


    POST /oauth2-token HTTP/1.1
    Content-Type: application/json

Request Body for confidential client

.. code-block:: json


    {
        "grant_type": "authorization_code",
        "client_id": "your client identifier",
        "client_secret": "your client secret",
        "redirect_uri": "redirect URI the user was redirect back to",
        "code": "your authorization code"
    }

Request Body for public client

.. code-block:: json


    {
        "grant_type": "authorization_code",
        "client_id": "your client identifier",
        "redirect_uri": "redirect URI the user was redirect back to",
        "code": "your authorization code",
        "code_verifier": "code verifier string that was used to generate code challenge"
    }

Response Body

.. code-block:: json


    {
        "token_type": "Bearer",
        "expires_in": 3600,
        "access_token": "your access token"
    }

The received access token can be used multiple times until it expires. A new token should be requested once
the previous token expires.

An example of an API request:

.. code-block:: http


    GET /api/users HTTP/1.1
    Accept: application/vnd.api+json
    Authorization: Bearer your access token

According to |rfc6750|, an access token can be included as a body parameter in requests.

.. note:: When sending the access token as a body parameter, the request must include a `Content-Type` header set to `application/vnd.api+json`.

Here is an example of how to send the access token as a body parameter:

.. code-block:: http


    POST /api/users HTTP/1.1
    Accept: application/vnd.api+json
    Content-Type: application/vnd.api+json

    {
        "access_token": "your_access_token",
        "data": {
          "type": "contacts",
          "attributes": {
            "firstName": "Jerry12",
            "lastName": "Coleman2"
          }
        }
    }

.. note:: Access tokens for back-office and storefront API are not interchangeable. If you attempt to request data for the storefront API with a token generated for the back-office application, access will be denied.

.. include:: /include/include-links-dev.rst
   :start-after: begin
