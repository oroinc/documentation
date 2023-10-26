.. _dev-integrations-api-based:

API-Based Integration
=====================

:ref:`Oro API <web-api>` provides an extensive range of features for developers to implement varying scenarios. The API serves as a communication channel between the front and backend and as a starting point to build integrations with third-party platforms. API-based integration is a flexible and powerful way to connect different applications, allowing them to work together and share data in a controlled and efficient manner.

When using an API for integration, the developer should evaluate which entities and fields require synchronization, define a conflict resolution strategy, and verify the ability to execute these requirements through the API.

Middleware Pattern Overview
---------------------------

When utilizing an API, a third-party system can directly push or pull data through the API. Alternatively, the system can opt for a middleware approach. Middleware is software that serves as an intermediary layer between various applications or components of a software system, facilitating communication and data exchange between them. It plays a vital role in modern software architecture, allowing for interoperability, scalability, and flexibility in distributed systems. It standardizes communication, enabling diverse software components to interact without having to comprehend each other's underlying technologies.

.. image:: /img/backend/integrations/api-based/middleware-diagram.svg
   :align: center
   :alt: Middleware data flow

Middleware simplifies the integration of disparate systems, protocols, and technologies by providing a streamlined interface for applications to communicate. This fosters inter-application communication, enabling data exchange and coordination. Middleware can also distribute workloads and scale applications horizontally to handle increased amounts of data.

Integration Example
-------------------

Let's take a look at an example of a one-way integration between a source system and OroCommerce. In this scenario, we will synchronize customer entities from the source system to OroCommerce using |Prefect|. Prefect is a workflow automation framework for Python that can be used to create a middleware to integrate two systems.

For this purpose, we will develop a basic class capable of executing POST requests to the Oro JSON API.

.. code-block:: python
   :caption: oro_api_client.py


   import simplejson
   import requests
   from authlib.integrations.requests_client import OAuth2Session, OAuth2Auth
   from requests import HTTPError


   class OroApiClient():
       DEFAULT_HEADERS = {
           'Content-Type': 'application/vnd.api+json'
       }

       def __init__(self):
           """
           Very simplified example of client credentials loading and OAuth2 Session initialization.
           """

           with open('/storage/oro_credentials.json', 'r') as f:
               credentials = simplejson.load(f)

           self.client = OAuth2Session(
               client_id=credentials.get('client_id'),
               client_secret=credentials.get('client_secret'),
               token_endpoint_auth_method='client_secret_post'
           )

       def _get_auth(self):
           """
           Fetch oAuth token to make API requests
           """
           token = self.client.fetch_token(
               'https://commerce.local/oauth2-token',
               grant_type='client_credentials'
           )

           if token.get('code') and 400 <= token.get('code') < 600:
               raise HTTPError(token.get('message'))

           return OAuth2Auth(token)

       def __del__(self):
           self.client.close()

       def post(self, resource, data):
           """
           Make POST request to Oro JSON API
           """
           response = requests.post(
               'https://commerce.local/admin/api/{}'.format(resource),
               auth=self._get_auth(),
               headers=self.DEFAULT_HEADERS,
               data=simplejson.dumps(data, ignore_nan=True)
           )
           response.raise_for_status()

           return response.json()

In the next step, we will use the OroApiClient prepared beforehand to create a workflow that extracts data from the source system and transfers it to OroCommerce.

.. code-block:: python
   :caption: sync_customers_flow.py


   import requests
   from prefect import flow, task

   from oro_api_client import OroApiClient


   @task
   def extract_data_from_remote_system():
       response = requests.get('https://source-system.ltd/api/customers')
       response.raise_for_status()

       # response body: {"name": "Customer Name"}
       return response.json()


   @task
   def transform_customer_to_oro(data):
       return {
           'data': {
               'type': 'customers',
               'attributes': {
                   'name': data.get('name')
               }
           }
       }


   @task
   def load_data_to_oro(data):
       api_client = OroApiClient()
       api_client.post('customers', data)


   @flow
   def sync_customers():
       data = extract_data_from_remote_system()
       transformed_data = transform_customer_to_oro(data)
       load_data_to_oro(transformed_data)


   if __name__ == '__main__':
       sync_customers()

To transfer data between different systems using middleware, you can choose the programming language of your choice and utilize pre-existing workflow automation frameworks to construct the integration. This example emphasizes flexibility, allowing you to accomplish your goals efficiently and effectively.

Related Articles
----------------

* :ref:`API Developer Guide <web-api>`
* :ref:`Manage OAuth Applications <oauth-applications>`
* :ref:`Custom Integrations: API <custom-integrations-oro-api>`

.. include:: /include/include-links-dev.rst
   :start-after: begin
