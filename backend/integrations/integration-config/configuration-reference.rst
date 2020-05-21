.. _dev-integrations-integrations-config-reference:

Configuration Reference
=======================

Channel Type Definition
-----------------------

**Channel type** - a type of the application/service to connect.
**Channel** - an instance of the configured channel type with enabled connectors.

The responsibility of a **channel** is to split transport/connectors into groups by a third party application type.
To define you own channel type, create a class that implements `Oro\\Bundle\\IntegrationBundle\\Provider\\ChannelInterface` and then register it as a service with the `oro_integration.channel` tag with a unique `type` key.

**Example**

.. code-block:: yaml
   :linenos:

    acme.demo_integration.provider.prestashop.channel:
        class: Acme\DemoBundle\Integration\PrestashopChannel
        tags:
            - { name: oro_integration.channel, type: presta_shop }

The integration type can also bring an icon that will be shown in the type selector. For this purposes, the type class should implement
`Oro\\Bundle\\IntegrationBundle\\Provider\\IconAwareIntegrationInterface` and method `getIcon()` should return a valid path to the image
for Symfony assets helper.

Transport Definition
--------------------

The responsibility of **transport** is providing communication between the connector and the channel, it should perform read/write operations to the third
party systems.

To define you own transport, create a class that implements `Oro\\Bundle\\IntegrationBundle\\Provider\\TransportInterface` and register it as a service with the `oro_integration.transport` tag that contains a unique `type` key and a `channel_type` key that shows what channel type it can be used for.

**Example**

.. code-block:: yaml
   :linenos:

    acme.demo_integration.provider.db_transport:
        class: Acme\DemoBundle\Integration\PrestashopTransport
        tags:
            - { name: oro_integration.transport, type: db, channel_type: presta_shop }

Connector Definition
--------------------

**Channel connector** is responsible for bringing data in and defining compatible channel types. Examples: Magento
customers data connector, Magento catalog data connector.

To define you own connector, create a class that implements `Oro\\Bundle\\IntegrationBundle\\Provider\\ConnectorInterface` and register it as a service with the `oro_integration.connector` tag that contains a `type` key (unique for the channel) and a `channel_type` key that shows what channel type it can be used for.

**Example**

.. code-block:: yaml
   :linenos:

    acme.demo_integration.provider.prestashop_product.connector:
        class: Acme\DemoBundle\Integration\PrestashopProductConnector
        tags:
            - { name: oro_integration.connector, type: product, channel_type: presta_shop }
