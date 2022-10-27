.. _bundle-docs-crm-channel-bundle:

OroChannelBundle
================

OroChannelBundle adds the Channel entity that represents the source of customer data into Oro applications and allows developers to define Channels types and specify the channel-related features in bundles YAML configuration files. It also provides UI for admin users to create and manage channels of the types defined by developers.

Entity Data Block
-----------------

This bundle brings the Channel entity into the system. A channel is a set of features that can be included in OroCRM.
A channel can come with a customer datasource, which is an integration that brings business entities into the system.
A feature is a set of entities and integration covering business direction needs.

**For example**:

A customer has a B2B business and needs a CRM to provide a complex B2B solution. To meet this
requirement, they need to have a B2B channel created to enable *leads* and *opportunities* or any other B2B feature in the scope of this channel.
Enabling this channel adds the Sales menu to the UI with Leads and Opportunities menu items.

By default, all specific to business direction features should be disabled, and will not be visible in reports, segments, menu, etc. (except for the entity configuration).

To implement the ability to enable the feature in the scope of a channel, create a 'YourBundle/Resources/config/oro/channels.yml` configuration file.

**Config example:**

.. code-block:: yaml

    channels:
        entity_data:
            -
                name: Acme\Bundle\DemoBundle\Entity\RealEntity              # Entity FQCN
                dependent:                                                  # Service entities that dependent on availability of main entity
                    - Acme\Bundle\DemoBundle\Entity\RealEntityStatus
                    - Acme\Bundle\DemoBundle\Entity\RealEntityCloseReason
                navigation_items:                                           # Navigation items that responsible for entity visibility
                    - menu.tab.real_entity_list
            -
                name: Acme\Bundle\DemoBundle\Entity\AnotherEntity
                dependent: ~
                navigation_items:
                    - menu.tab.entity_funnel_list
                    - menu.tab.some_tab.some_tab.some_value
                belongs_to:
                    integration: integration_type_name                      # If entity belongs to integration, correspondent node should be set
                    connector:   another                                    # connector name

+--------------------------+---------------------------------------------------------------------------------------------------+
| Option                   | Description                                                                                       |
+--------------------------+---------------------------------------------------------------------------------------------------+
| `name`                   | Entity name                                                                                       |
+--------------------------+---------------------------------------------------------------------------------------------------+
| `dependent`              | List of entities which will be shown/hidden too. (Related entities to the entity in field 'name') |
+--------------------------+---------------------------------------------------------------------------------------------------+
| `navigation_items`       | List of menu items which should be enabled/disabled in any menu.                                  |
+--------------------------+---------------------------------------------------------------------------------------------------+
| `belongs_to.integration` | Integration type name                                                                             |
+--------------------------+---------------------------------------------------------------------------------------------------+
| `belongs_to.connector`   | Integration connector name                                                                        |
+--------------------------+---------------------------------------------------------------------------------------------------+

The menu item should be hidden by default in the navigation configuration using parameter *display* with value *false*.

**Example:**

.. code-block:: yaml

    menu_config:
        items:
            menu_item:
                label: 'oro.some_entity.menu.tab.label'
                display: false
        tree:
            application_menu:
                children:
                    menu_item: ~

Channel Types Block
-------------------

Channel is configured by the `Channel Type` and `Entities` fields. Some types of channels that bring customers also bring the `integration` field to configure the integration.

**Config example:**

.. code-block:: yaml

    channel_types:
        customer_channel_type:
            label: Channel type name
            entities:
                - Acme\Bundle\DemoBundle\Entity\Some
                - Acme\Bundle\DemoBundle\Entity\Another
            integration_type: some_type
            customer_identity: Oro\Bundle\ChannelBundle\Entity\CustomerIdentity
            lifetime_value: field
            priority: -10

+---------------------+------------------------------------------------------------------------------------------------------------------------------+----------+
| Option              | Description                                                                                                                  | Required |
+---------------------+------------------------------------------------------------------------------------------------------------------------------+----------+
| `label`             | Label of the channel type                                                                                                    | yes      |
+---------------------+------------------------------------------------------------------------------------------------------------------------------+----------+
| `entities`          | Determines which fields will be defined in the `entities` field after channel type has been selected                         | no       |
+---------------------+------------------------------------------------------------------------------------------------------------------------------+----------+
| `integration_type`  | Determines which integration type should be created in the scope of a particular channel that is based on the current type   | no       |
+---------------------+------------------------------------------------------------------------------------------------------------------------------+----------+
| `customer_identity` | Determines entity that will be used as customer identifier for channels that are based on the current type                   | no       |
+---------------------+------------------------------------------------------------------------------------------------------------------------------+----------+
| `lifetime_value`    | Determines which fields will be used from `customer_identity` for calculating lifetime sales value                           | no       |
+---------------------+------------------------------------------------------------------------------------------------------------------------------+----------+
| `priority`          | Uses to sort channel types by priority. The default value is 0                                                               | no       |
+---------------------+------------------------------------------------------------------------------------------------------------------------------+----------+

By default, if the `customer_identity` option is not set, ``Oro\Bundle\ChannelBundle\Entity\CustomerIdentity`` is used as the *customer identity* and is included automatically.

Lifetime Sales Value
--------------------

Lifetime sales value brings a 360-degree view of the account in the channel's scope. Each channel type defines a field from the *Customer Identity* entity used to indicate the aggregated amount for a single customer.

OroChannelBundle provides a mechanism for tracking changes of lifetime sales value per customer and stores the history of those changes.
You need to configure the lifetime field for channel type to enable tracking.

To use data from history, use **Amount provider**. It is registered as a service for DIC with the `oro_channel.provider.lifetime.amount_provider` identifier.

To display **Life time** on the page, use the `oro_channel_lifetime_value` twig extension that brings  the `oro_channel_account_lifetime` twig function.

**Examples of usage:**

.. code-block:: twig

    Lifetime for {{ channel.name }}: {{ oro_channel_account_lifetime(account, channel)|oro_format_currency }}
