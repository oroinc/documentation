.. _sys--integrations--manage-integrations--ups--flat-rate:
.. _user-guide--shipping--configuration--common-details:

Manage Integrations: Shipping Method Integration
================================================

.. important:: This section is a part of the :ref:`Shipping Configuration <admin-guide--shipping>` topic that provides the general understanding of the payment concept in OroCommerce.


Create an Integration with a Shipping Service Provider
------------------------------------------------------

Out of the box, you can create an integration with the following third-party providers (click the links for detailed guidance) to offer their shipping services for the quotes and orders placed using OroCommerce.

* :ref:`Flat Rate <doc--integrations--flat-rate>`
* :ref:`UPS <doc--integrations--ups>`
* :ref:`FedEx <doc--integrations--fedex>`
* DPD


Delete a Shipping Integration
-----------------------------

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

**Related Topics**

* :ref:`Shipping Configuration Concept Guide <admin-guide--shipping>`
* :ref:`System Shipping Configuration <configuration--guide--commerce--configuration--shipping>`
* :ref:`Shipping Rules Configuration <sys--shipping-rules>`


.. include:: /user_doc/img/buttons/include_images.rst
   :start-after: begin

.. toctree::
   :hidden:
   :maxdepth: 2

   flat_rate
   ups
   fedex
