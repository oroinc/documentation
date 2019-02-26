.. _architecture-overview--tech-stack--client:

.. begin_client_side

Client Side
===========

As any **web application**, Oro application generally follows a `client - server architecture <https://en.wikipedia.org/wiki/Client%E2%80%93server_model>`_ to deliver the web content prepared by the server-side stack to the client-side and deliver response. Oro application rely on the number of embedded, integrated, and distributed technologies explained below.

A **client**, whether it is a web-browser or a third-party application connected via `the API <https://oroinc.com/b2b-ecommerce/doc/current/dev-guide/web-api>`__, makes requests to the Oro application server-side to get the application content or JSON response. Information received in response from the server-side may be used:

* By the web browser -- to render or update the web page shown to the end user.
* By the third party application -- to launch data synchronization, trigger actions in the Oro applications or other integrated systems.

Web Browser
-----------

Oro applications support the following web browsers:

* `Mozilla Firefox <https://www.mozilla.org/en-US/firefox/new/>`_ (latest version)
* `Google Chrome <https://www.google.com/chrome/>`_ (latest version)
* `Microsoft Internet Explorer <https://www.microsoft.com/en-us/download/internet-explorer.aspx>`_ (v.11 and above)
* `Microsoft Edge <https://www.microsoft.com/en-us/windows/microsoft-edge>`_ (latest version)
* `Safari <http://www.apple.com/safari/>`_ (latest version)

Out of the box, Oro Applications are mobile friendly due to the responsive and adaptive UI.

In addition to the HTTP connections, Oro applications establish websocket connections between web browsers and server side for the real-time communication (e.g. status notifications, alerts, etc.)

API Client
----------

The architecture of the third-party application that connects to the Oro application via `the API <https://oroinc.com/b2b-ecommerce/doc/current/dev-guide/web-api>`__ is not limited by the Oro application architecture. The API client may be implemented as a separate custom web application, custom mobile application, ERP system, ETL service, etc.

.. stop_client_side

**Related Topics**

* :ref:`Technology Stack: Server Side <architecture-overview--tech-stack--server>`
* :ref:`Operational Structure <admin-op-structure>`