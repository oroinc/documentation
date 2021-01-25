.. _web-services-api--authentication--wsse:

.. index::
    single: Security; WSSE Authentication; WSSE Authorization
    single: WSSE Authentication
    single: WSSE Authorization

WSSE Authentication
===================

For authentication purposes, the **WSSE** mechanism is used — a family of open security specifications for web services,
specifically SOAP web services. The basic premise of WSSE is that a request header is checked for encrypted credentials,
verified using a timestamp and nonce, and authenticated for the requested user using a password digest.

It is implemented by the |OroWsseAuthenticationBundle| that covers most cases from the |WSSE specification| (PDF).

.. important::

    Please note that WSSE authentication is deprecated and will be removed in one of the future LTS releases.
    Use :ref:`OAuth authentication<web-services-api--authentication--oauth>` instead.


Creating an API Key
-------------------

To start using API, you must take a few preliminary steps:

    1. Ensure that the application is installed correctly.

    2. Generate an API key for a user:

        - If you want to generate an API key for yourself, navigate to the profile page of your user:

            - either click the **My User** link in **User Menu** in the upper-right corner of the current page, or

            - follow the direct link, e.g. ``http://<hostname_of_your_oro_application>/user/profile/view``.

        - If you want to generate an API key for another user:

            - open their view page

            - open the list of all users (**System > User Management > Users**)

            - find the user who needs an API key

            - click the corresponding user row or the |IcView| **View** icon in the ellipsis menu at the right end of the row.

    3.  Click the **Generate Key** button. You will see the generated key near the button, it will look like: 'dd1c18d06773cc377c9df6166c54c6e5fefa50fa'.

.. image:: /img/backend/api/user_api_key_generation.png
   :alt: API key sample of a certain user

.. important::

    Please note that an API key will be generated in the scope of the current organization and will allow you to access data
    in the scope of that particular organization only.


After the API key is generated, you will be able to execute API requests via the sandbox, Curl command, any other REST client or use the API via your own application.

This key should be used for ``PasswordDigest`` generation on the client side.


Header Generation
-----------------

The console command ``oro:wsse:generate-header`` can be used to generate an authentication header.

.. code-block:: bash
    :linenos:

    user@host: php bin/console oro:wsse:generate-header yourApiKey
    Authorization: WSSE profile="UsernameToken"
    X-WSSE: UsernameToken Username="admin", PasswordDigest="Cae37DaU9JT1pwoaG5i7bXbDBo0=", Nonce="elRZL0lVOTl2T3lXeVBmUHRCL2ZrUnJoWUNZPQ==", Created="2016-09-20T10:00:00+03:00"

It has *apiKey* as the required argument and outputs generated headers.

An example of an authentication header generation with PHP:

.. code-block:: php
    :linenos:

    $userName = 'your username';
    $userApiKey = 'your apiKey';
    $nonce = base64_encode(substr(md5(uniqid()), 0, 16));
    $created  = date('c');
    $digest   = base64_encode(sha1(base64_decode($nonce) . $created . $userApiKey, true));

    $wsseHeader = "Authorization: WSSE profile=\"UsernameToken\"\n";
    $wsseHeader.= sprintf(
        'X-WSSE: UsernameToken Username="%s", PasswordDigest="%s", Nonce="%s", Created="%s"',
        $userName,
        $digest,
        $nonce,
        $created
    );


Header and Nonce Lifetime
-------------------------

The generated header has a lifetime of 3600s, and it expires if not used during this time.
Each *nonce* might be used only once in specific time for generation of the *password digest*.
By default, the *nonce* expiration time is also set to 3600s.
This rule is aimed to improve the safety of the application and prevent *"replay"* attacks.

Therefore, the header generation algorithm should be implemented on the side of the client application, and headers should be re-generated for each request.


Example of a REST API Request
-----------------------------

Here's an example of a REST API request header with the WSSE authentication.
Please pay attention to the **Authentication** and **X-WSSE** parameters:

.. code-block:: http
    :linenos:

    GET /api/users HTTP/1.1
    Accept: application/vnd.api+json
    Authorization: WSSE profile="UsernameToken"
    X-WSSE: UsernameToken Username="admin",
            PasswordDigest="Cae37DaU9JT1pwoaG5i7bXbDBo0=",
            Created="2016-09-20T10:00:00+03:00",
            Nonce="elRZL0lVOTl2T3lXeVBmUHRCL2ZrUnJoWUNZPQ=="


.. include:: /include/include-links-dev.rst
   :start-after: begin

.. include:: /include/include-images.rst
   :start-after: begin
