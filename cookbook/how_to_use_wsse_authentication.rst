How to use WSSE authentication
====================

*Used application: OroPlatform RC3*

* `Overview`_
* `API key`_
* `Header generation`_
* `Header and nonce lifetime`_


Overview
--------

*OroPlatform* uses WSSE authentication mechanism to provide secured access for third party applications via REST/SOAP APIs.
It's based on `EscapeWSSEAuthenticationBundle`_ that covers most cases from WSSE `specs`_.

.. _EscapeWSSEAuthenticationBundle: https://github.com/escapestudios/EscapeWSSEAuthenticationBundle
.. _specs: http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-soap-message-security-1.0.pdf

API key
-------

*API key*  were added to platform in order to prevent usage of regular(raw) user password in third party software.
It could be generated for each user in *"user view"* page by user that have granted **EDIT** permissions.

.. image:: ./img/how_to_use_wsse_authentication/user_api_key_generation.png

This key should be used for ''PasswordDigest'' generation on a client side.

Header generation
-----------------

To generate authentication header console command could be used.

::

    user@host: php app/console oro:wsse:generate-header username
    Authorization: WSSE profile="UsernameToken"
    X-WSSE: UsernameToken Username="admin", PasswordDigest="buctlzbeVflrVCoEfTKB1mkltCI=", Nonce="ZmMzZDg4YzMzYzRmYjMxNQ==", Created="2014-03-22T15:24:49+00:00"

It have *username* required argument and outputs generated headers. It's ready to use.
Here is example of request using curl:

::

       curl -i -H "Accept: application/json" -H 'Authorization: WSSE profile="UsernameToken"' -H 'X-WSSE: UsernameToken Username="admin", PasswordDigest="buctlzbeVflrVCoEfTKB1mkltCI=", Nonce="ZmMzZDg4YzMzYzRmYjMxNQ==", Created="2014-03-22T15:24:49+00:00"' http://crmdev.lxc/app_dev.php/api/rest/latest/users
       HTTP/1.1 200 OK
       Server: nginx
       Content-Type: application/json
       Transfer-Encoding: chunked
       Connection: keep-alive
       X-Powered-By: PHP/5.4.23-1~dotdeb.0
       Set-Cookie: CRMID=kin0s55gkeg3fcuvujcv02dp97; path=/; HttpOnly
       Cache-Control: no-cache
       Date: Sat, 22 Mar 2014 15:27:10 GMT
       X-Debug-Token: b1e4b9
       
       [{"id":1,"username":"admin","email":"admin@example.com","namePrefix":null,"firstName":"John","middleName":null,"lastName":"Doe","nameSuffix":null,"birthday":null,"enabled":true,"lastLogin":"2014-03-22T14:15:19+00:00","loginCount":1,"createdAt":"2014-03-22T13:55:14+00:00","updatedAt":"2014-03-22T14:15:19+00:00","owner":{"id":1,"name":"Main"},"roles":[{"id":3,"role":"ROLE_ADMINISTRATOR","label":"Administrator"}]}]


Header and nonce lifetime
-------------------------

Header has life time when it could be used. Now it set to 300s. So this means that if generated header were not used in 300s it will be expired.
Each *nonce* might be used only once in specific time for generation of *password digest*. By default *nonce* cooldown time also set to 300s.
This rule aimed at improving safety of the application and prevent *"replay"* attacks.

Because of this header generation algorithm should be implemented on the side of client application and headers should be regenerated for each request.


