
CLI Commands (EmailBundle)
==========================

oro:email:update-associations
-----------------------------

To update email associations, use the following command:

.. code-block:: bash

   php bin/console oro:email:update-associations

oro:email:generate-md5
----------------------

To generate and print MD5 hashes for email template contents from oro_email_template table, use the command below. These hashes can be used in email migrations.

.. code-block:: bash

   php bin/console oro:email:generate-md5

oro:cron:email-body-sync
------------------------

To synchronizes email bodies, use the following command:

.. code-block:: bash

   php bin/console oro:cron:email-body-sync

oro:debug:email:template
------------------------

To display a list of current email templates for an application or an exact template, use the following command:

.. code-block:: bash

   php bin/console oro:debug:email:template

oro:debug:email:template:compile
--------------------------------

To render an email template, use the command below. Optionally, it can send a compiled email to the recipient's email address.

.. code-block:: bash

   php bin/console oro:debug:email:template:compile

oro:debug:email:variables
-------------------------

To display email template variables, use the following command:

.. code-block:: bash

   php bin/console oro:debug:email:variables

oro:email:template:export
-------------------------

To export email templates, use the following command:

.. code-block:: bash

   php bin/console oro:email:template:export

oro:email:template:import
-------------------------

To import email templates from the directory, use the following command:

.. code-block:: bash

   php bin/console oro:email:template:import

Commands in Use (Examples)
--------------------------

The following example uses SMTP settings and sends a message to the ``admin@example.com`` email address:

.. code-block:: bash

   php bin/console oro:debug:email:template:compile order_confirmation_email --entity-id=16 --recipient=admin@example.com

The following example outputs EMAIL content to stdout:

.. code-block:: bash

   php bin/console oro:debug:email:template:compile order_confirmation_email --entity-id=16

The following command displays a list of available templates:

.. code-block:: bash

   php bin/console oro:debug:email:template

+----+-----------------------------------------+--------------------------------------------------+----------+------------+-------------+--------------+----------------+
| ID | **NAME**                                | **ENTITY CLASS**                                 | **TYPE** | **SYSTEM** | **VISIBLE** | **EDITABLE** | **PARENT**     |
+----+-----------------------------------------+--------------------------------------------------+----------+------------+-------------+--------------+----------------+
| 1  | force_reset_password                    | Oro\\Bundle\\UserBundle\\Entity\\User            | html     | Yes        | Yes         | Yes          | N/A            |
+----+-----------------------------------------+--------------------------------------------------+----------+------------+-------------+--------------+----------------+
| 2  | user_reset_password                     | Oro\\Bundle\\UserBundle\\Entity\\User            | html     | Yes        | Yes         | Yes          | N/A            |
+----+-----------------------------------------+--------------------------------------------------+----------+------------+-------------+--------------+----------------+
| 3  | user_reset_password_as_admin            | Oro\\Bundle\\UserBundle\\Entity\\User            | html     | Yes        | Yes         | Yes          | N/A            |
+----+-----------------------------------------+--------------------------------------------------+----------+------------+-------------+--------------+----------------+
| 4  | user_change_password                    | Oro\\Bundle\\UserBundle\\Entity\\User            | html     | Yes        | Yes         | Yes          | N/A            |
+----+-----------------------------------------+--------------------------------------------------+----------+------------+-------------+--------------+----------------+
| 99 | order_confirmation_email                | Oro\\Bundle\OrderBundle\\Entity\\Order           | html     | Yes        | Yes         | Yes          | N/A            |
+----+-----------------------------------------+--------------------------------------------------+----------+------------+-------------+--------------+----------------+

The following command displays information for a specific template:

.. code-block:: bash

   php bin/console oro:debug:email:template order_confirmation_email

.. code-block:: none

    @name = order_confirmation_email
    @entityName = Oro\Bundle\OrderBundle\Entity\Order
    @subject = Your order has been received.
    @isSystem = 1
    @isEditable = 1

    {%  extends 'base.html.twig' %}

    {% block content %}
    ...
    {% endblock %}

The following command displays system-wide variables:

.. code-block:: bash

   php bin/console oro:debug:email:variable

+--------------------+-----------------+----------+-----------------------------------------+
| **Name**           | **Title**       | **Type** | **Value**                               |
+--------------------+-----------------+----------+-----------------------------------------+
| system.appURL      | Application URL | string   | ``https://dev.oro.in/``                 |
+--------------------+-----------------+----------+-----------------------------------------+
| system.currentDate | Current date    | string   | May 32, 2018                            |
+--------------------+-----------------+----------+-----------------------------------------+
| system.currentTime | Current time    | string   | 12:03 PM                                |
+--------------------+-----------------+----------+-----------------------------------------+

The following command displays class-based variables:

.. code-block:: bash

   php bin/console oro:debug:email:variable --entity-class="Oro\Bundle\OrderBundle\Entity\Order"

**System Variables**

+------------------------+---------------------+----------+--------------------------------+
| **Name**               | **Title**           | **Type** | **Value**                      |
+------------------------+---------------------+----------+--------------------------------+
| system.appURL          | Application URL     | string   | ``https://dev.oro.in/``        |
+------------------------+---------------------+----------+--------------------------------+
| system.currentDate     | Current date        | string   | Nov 1, 2021                    |
+------------------------+---------------------+----------+--------------------------------+
| system.currentDateTime | Current date & time | string   | Nov 1, 2021, 10:43 AM          |
+------------------------+---------------------+----------+--------------------------------+
| system.currentTime     | Current time        | string   | 10:43 AM                       |
+------------------------+---------------------+----------+--------------------------------+

**Entity Variables**

+-------------------------------------+----------------------------------------------------------+-----------+
| **Name**                            | **Title**                                                | **Type**  |
+-------------------------------------+----------------------------------------------------------+-----------+
| entity.acContactCount               | Total times contacted                                    | integer   |
+-------------------------------------+----------------------------------------------------------+-----------+
| entity.acContactCountIn             | Total number of incoming contact attempts                | integer   |
+-------------------------------------+----------------------------------------------------------+-----------+
| entity.acContactCountOut            | Total number of outgoing contact attempts                | integer   |
+-------------------------------------+----------------------------------------------------------+-----------+
| entity.acLastContactDate            | Last contact datetime                                    | datetime  |
+-------------------------------------+----------------------------------------------------------+-----------+
| entity.acLastContactDateIn          | Last incoming contact datetime                           | datetime  |
+-------------------------------------+----------------------------------------------------------+-----------+
| entity.acLastContactDateOut         | Last outgoing contact datetime                           | datetime  |
+-------------------------------------+----------------------------------------------------------+-----------+
| entity.baseSubtotalValue            | Subtotal In Base Currency                                | money     |
+-------------------------------------+----------------------------------------------------------+-----------+
| entity.baseTotalValue               | Total In Base Currency                                   | money     |
+-------------------------------------+----------------------------------------------------------+-----------+
| entity.billingAddress               | Billing Address                                          | ref-one   |
+-------------------------------------+----------------------------------------------------------+-----------+
| entity.createdAt                    | Created At                                               | datetime  |
+-------------------------------------+----------------------------------------------------------+-----------+
| entity.currency                     | Currency                                                 | string    |
+-------------------------------------+----------------------------------------------------------+-----------+
| entity.customer                     | Customer                                                 | ref-one   |
+-------------------------------------+----------------------------------------------------------+-----------+
| entity.customerNotes                | Customer Notes                                           | text      |
+-------------------------------------+----------------------------------------------------------+-----------+
| entity.customerUser                 | Customer User                                            | ref-one   |
+-------------------------------------+----------------------------------------------------------+-----------+
| entity.disablePromotions            | Disable Promotions                                       | boolean   |
+-------------------------------------+----------------------------------------------------------+-----------+
| entity.estimatedShippingCostAmount  | Estimated Shipping Cost Amount                           | money     |
+-------------------------------------+----------------------------------------------------------+-----------+
| entity.id                           | ID                                                       | integer   |
+-------------------------------------+----------------------------------------------------------+-----------+
| entity.identifier                   | Order Number                                             | string    |
+-------------------------------------+----------------------------------------------------------+-----------+
| entity.internalStatus               | Internal Status                                          | enum      |
+-------------------------------------+----------------------------------------------------------+-----------+
| entity.organization                 | Organization                                             | ref-one   |
+-------------------------------------+----------------------------------------------------------+-----------+
| entity.overriddenShippingCostAmount | Overridden Shipping Cost Amount                          | money     |
+-------------------------------------+----------------------------------------------------------+-----------+
| entity.owner                        | Owner                                                    | ref-one   |
+-------------------------------------+----------------------------------------------------------+-----------+
| entity.paymentTerm7c4f1e8e          | Payment Term                                             | manyToOne |
+-------------------------------------+----------------------------------------------------------+-----------+
| entity.poNumber                     | PO Number                                                | string    |
+-------------------------------------+----------------------------------------------------------+-----------+
| entity.shipUntil                    | Do Not Ship Later Than                                   | date      |
+-------------------------------------+----------------------------------------------------------+-----------+
| entity.shippingAddress              | Shipping Address                                         | ref-one   |
+-------------------------------------+----------------------------------------------------------+-----------+
| entity.shippingMethod               | Shipping Method                                          | string    |
+-------------------------------------+----------------------------------------------------------+-----------+
| entity.shippingMethodType           | Shipping Method Type                                     | string    |
+-------------------------------------+----------------------------------------------------------+-----------+
| entity.sourceEntityClass            | Source Entity Class                                      | string    |
+-------------------------------------+----------------------------------------------------------+-----------+
| entity.sourceEntityId               | Source Entity Id                                         | integer   |
+-------------------------------------+----------------------------------------------------------+-----------+
| entity.sourceEntityIdentifier       | Source Entity Identifier                                 | string    |
+-------------------------------------+----------------------------------------------------------+-----------+
| entity.updatedAt                    | Updated At                                               | datetime  |
+-------------------------------------+----------------------------------------------------------+-----------+
| entity.url.commerceView             | oro.email.emailtemplate.variables.url.commerceView.label | string    |
+-------------------------------------+----------------------------------------------------------+-----------+
| entity.url.create                   | Entity Create Page                                       | string    |
+-------------------------------------+----------------------------------------------------------+-----------+
| entity.url.index                    | Entity Grid Page                                         | string    |
+-------------------------------------+----------------------------------------------------------+-----------+
| entity.url.update                   | Entity Update Page                                       | string    |
+-------------------------------------+----------------------------------------------------------+-----------+
| entity.url.view                     | Entity View Page                                         | string    |
+-------------------------------------+----------------------------------------------------------+-----------+
| entity.warehouse                    | Warehouse                                                | manyToOne |
+-------------------------------------+----------------------------------------------------------+-----------+
| entity.website                      | Website                                                  | ref-one   |
+-------------------------------------+----------------------------------------------------------+-----------+

The following command displays entity-based variables:

.. code-block:: bash

   php bin/console oro:debug:email:variable --entity-class="Oro\Bundle\OrderBundle\Entity\Order" --entity-id=16

**Entity Variables**

+-------------------------------------+----------------------------------------------------------+-----------+---------------------------------------------------------------+
| Name                                | Title                                                    | Type      | Value                                                         |
+-------------------------------------+----------------------------------------------------------+-----------+---------------------------------------------------------------+
| entity.acContactCount               | Total times contacted                                    | integer   |                                                               |
+-------------------------------------+----------------------------------------------------------+-----------+---------------------------------------------------------------+
| entity.url.create                   | Entity Create Page                                       | string    | ``https://dev.oro.in/admin/order/create``                     |
+-------------------------------------+----------------------------------------------------------+-----------+---------------------------------------------------------------+
| entity.url.index                    | Entity Grid Page                                         | string    | ``https://dev.oro.in/admin/order/``                           |
+-------------------------------------+----------------------------------------------------------+-----------+---------------------------------------------------------------+
| entity.url.update                   | Entity Update Page                                       | string    | ``https://dev.oro.in/admin/order/update/16``                  |
+-------------------------------------+----------------------------------------------------------+-----------+---------------------------------------------------------------+
| entity.url.view                     | Entity View Page                                         | string    | ``https://dev.oro.in/admin/order/view/16``                    |
+-------------------------------------+----------------------------------------------------------+-----------+---------------------------------------------------------------+

The following command exports all email templates:

.. code-block:: bash

   php bin/console oro:email:template:export {PATH_TO_STORE_EXPORTED_TEMPLATES}

.. code-block:: none

   Found 99 templates for export

The following command exports a specific email template:

.. code-block:: bash

   php bin/console oro:email:template:export --template order_confirmation_email {PATH_TO_STORE_EXPORTED_TEMPLATE}

.. code-block:: none

   Found 1 templates for export

The following command imports a specific email template:

.. code-block:: bash

   php bin/console oro:email:template:import {PATH_TO_TEMPLATES}\order_confirmation_email.html.twig --force

The following command imports email templates from the specified folder:

.. code-block:: bash

   php bin/console oro:email:template:import {PATH_TO_TEMPLATES} --force

.. code-block:: none

    Found 999 templates
    "authentication_code" updated
    ...
    "order_confirmation_email" updated

