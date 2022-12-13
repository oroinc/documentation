:oro_documentation_types: OroCommerce

.. _doc--integrations--multi-shipping:

Configure Multiple Shipping Integration in the Back-Office
==========================================================

.. hint::
        This section is part of the :ref:`Shipping Configuration <admin-guide--shipping>` topic that provides a general understanding of the shipping concept in OroCommerce.

To set up the multi shipping integration in OroCommerce:

1. Make sure to enable the :ref:`Multi Shipping <user-guide--system-configuration--commerce-sales-multi-shipping>` configuration option in the system configuration under **Commerce > Sales > Multi Shipping Options**.

Then:

2. Navigate to **System > Integrations > Manage Integrations** in the main menu.
3. Click **Create Integration** and select Multi Shipping Cost as an integration type.

   .. image:: /user/img/system/integrations/multi-shipping-integration.png
      :alt: Multi shipping integration form

4. Provide the shipping method name that is shown as an option for shipping configuration in the OroCommerce back-office.
5. Set the status to **Active**.
6. Select the **Default Owner**. The field is already populated with the name of the user creating the integration. You can change this value to a different user if necessary
7. Click **Save and Close**.

.. important:: Once the integration is created, the next step is to :ref:`set up a shipping rule <sys--shipping-rules>` under **System > Shipping Rules** and add your integration to it to enable customers to select the desired shipping method at checkout.


**Related Topics**

* :ref:`Shipping Configuration Concept Guide <admin-guide--shipping>`
* :ref:`System Shipping Configuration <configuration--guide--commerce--configuration--shipping>`
* :ref:`Shipping Rules Configuration <sys--shipping-rules>`
