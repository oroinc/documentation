Shipping Configuration
======================

.. contents:: :local:
   :depth: 1

.. begin

System Configuration for Shipping
---------------------------------

You can control the following options on the system configuration level. Click on the link to get to the detailed configuration instructions.

* In the :ref:`Shipping Origin <sys--conf--commerce--shipping--shipping-origin>`, set the default shipping origin address.

* In the :ref:`Shipping Options <sys--conf--commerce--shipping--shipping-options>`, enable and disable the shipping units of length and weight and the freight class.

* In the :ref:`Shipping Tax <sys--conf--commerce--taxation--shipping-tax>`, label the taxes that apply to the shipping cost.

Integration with Shipping Providers
-----------------------------------

.. include:: /user_guide/shipping/configuration/shipping_method_integrations.rst
   :start-after: begin_shipping_method_integrations
   :end-before: stop_shipping_method_integrations

See the :ref:`Integration with Shipping Providers <sys--integrations--manage-integrations--ups--flat-rate>` topic for more information.

Shipping Rules Configuration
----------------------------

.. include:: /user_guide/shipping/configuration/shipping_rules.rst
   :start-after: begin
   :end-before: stop

See the :ref:`Shipping Rules Configuration <sys--shipping-rules>` topic for more information, including:

* :ref:`Shipping Rules Overview <doc--shipping-rules--overview>`
* :ref:`Create a Shipping Rule <doc--shipping-rules--actions--create>`
* :ref:`Enable a Shipping Rule <doc--shipping-rules--actions--enable>`

.. finish

.. include:: /user_guide/include_images.rst
   :start-after: begin

.. toctree::
   :maxdepth: 2

   shipping_method_integrations

   common_shipping_integration_details

   shipping_rules

   expression_lang