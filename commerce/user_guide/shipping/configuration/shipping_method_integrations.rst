.. _sys--integrations--manage-integrations--ups--flat-rate:

.. System > Integrations > Manage Integrations. UPS, flat rate


Shipping Method Integration
~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. begin_shipping_method_integrations

You may configure integration with third-party providers to offer their shipping services for the quotes and orders placed using OroCommerce.

Out of the box, you may integrate OroCommerce with :ref:`UPS <doc--integrations--ups>`, DPD, and :ref:`Flat Rate <doc--integrations--flat-rate>` shipping.

.. * ref:`UPS Shipping Integration <doc--integrations--ups>`
.. * ref:`Flat Rate Shipping Integration <doc--integrations--flat-rate>`

.. stop_shipping_method_integrations


.. note::
    See a short demo on `how to create a shipping integration in OroCommerce <https://www.orocommerce.com/media-library/create-shipping-integrations>`_, or keep reading the step-by-step guidance below.

    .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/ileKXVTG6B8" frameborder="0" allowfullscreen></iframe>


.. contents:: :local:

.. _doc--integrations--ups:

UPS Shipping Integration
^^^^^^^^^^^^^^^^^^^^^^^^

This section describes the steps that are necessary to expose UPS as a shipping method in OroCommerce orders and quotes.

Prepare for Integration
"""""""""""""""""""""""
First, ensure you have `registered with UPS.com <https://www.ups.com/one-to-one/register>`_ and have opened a UPS Account with the necessary shipping services level.

Next:

1. Log in to the `ups.com <https://ups.com>`.
2. Navigate to the `UPS Developer Kit <https://www.ups.com/upsdeveloperkit/>`_ in the **Support > Technology Support** section.
3. `Request an access key <https://www.ups.com/upsdeveloperkit/requestaccesskey?loc=en_US>`_ (e.g. 5F235F292A54F51F).

Please, ensure that you have requested separate access keys for your test and production environments.

Configure a UPS Integration in OroCommerce
""""""""""""""""""""""""""""""""""""""""""

To enable communication with UPS in order to request the shipping cost estimate and/or request the shipping services, establish a connection with UPS API:

1. Navigate to the **Manage Integrations** page by clicking **System > Integrations > Manage Integrations** in the main menu.

2. Click **Create Integration** and select UPS as integration type:

   .. image:: /configuration_guide/img/integrations/manage_integrations/CreateUPSIntegration.png
      :class: with-border

3. Type in the *Common Integration Details*:

   .. include:: /user_guide/shipping/configuration/common_shipping_integration_details.rst
      :start-after: embedded_list
      :end-before: end_of_embedded_list

4. Set the **Test Mode** into the necessary state. Enable it if you are using the test UPS access key and disable for production access.

   .. note:: For security reasons, it is critically important to use the mode that matches your environment and the UPS access key type.

   .. warning::

      Never use the UPS access key that is dedicated for production environment in your sandbox/test OroCommerce environment.

      Never enable the Test Mode for the UPS integration on your production instance of OroCommerce.

#. Provide the UPS connection details: API user, password, and API key to connect. Click **Check UPS Connection** to ensure UPS API is accessible.

#. Provide the UPS service account details: 

   * Shipping account name
   * Shipping account number

#. Select the pickup type that shall apply to the deliveries for the shipping methods via this integration. Available options are:

   * Regular Daily Pickup
   * Customer Counter
   * One Time Pickup
   * On Call Air
   * Letter Center

#. Select unit of weight to use for the shipping price calculation.

   .. note:: The unit of weight should be in sync with the options that are supported by your UPS account.

#. Select the destination country. To support shipping globally, create a dedicated UPS integration (e.g. UPS USA, UPS UK, UPS Germany, etc) for every country you would like to cover with UPS shipping services.

   Once you select the destination, the list of shipping services appears.

#. Select the UPS shipping services that should be supported in the OroCommerce shipping options. Use *Ctrl*/*Shift* to select multiple options.

#. Set status to **Active** to enable the integration.

#. Click **Save**.

Next, set up a shipping rule that enables this shipping methods for all or some customer orders.

.. _doc--integrations--flat-rate:

Flat Rate Shipping Integration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This section describes the steps that are necessary to expose flat rate shipping as a shipping method in OroCommerce orders and quotes.

To enable flat rate shipping:

1. Navigate to the **Manage Integrations** page by clicking **System > Integrations > Manage Integrations** in the main menu.

2. Click **Create Integration** and select Flat Rate Shipping as integration type:

   .. image:: /configuration_guide/img/integrations/manage_integrations/CreateFlatRate.png
      :class: with-border

3. Type in the integration name and label (e.g. Flat Rate). Add label translations, if necessary.

#. Set status to **Active** to enable the integration.

#. Click **Save**.

Next, set up a shipping rule that defines enables this shipping methods for all or some customer orders.

Delete Shipping Integration
^^^^^^^^^^^^^^^^^^^^^^^^^^^

This section describes the steps that are necessary to delete integration with the shipping provider and disable shipping methods they offer in OroCommerce orders and quotes.

To delete an integration and related shipping methods:

1. Navigate to the **Manage Integrations** page by clicking **System > Integrations > Manage Integrations** in the main menu.

2. Hover over the |IcMore| **More Options** menu on the right side of the line with the necessary integration and click |IcDelete|.

   The confirmation box is shown.

   If any shipping rule depends on the integration that is being deleted, the affected shipping methods in those shipping rules will be disabled. The shipping rule might also be disabled if none of its shipping methods remain enabled.

3. If necessary, review the shipping rules using the link in the confirmation box.

   .. note:: The shipping rules open in a new tab in your browser.

4. Once you are ready to delete the integration, click **Delete**.

The shipping methods created due to this integration are no longer usable in OroCommerce and cannot be enabled in the shipping rule.

.. include:: /user_guide/include_images.rst
   :start-after: begin

