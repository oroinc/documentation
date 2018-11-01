.. _user-guide--shipping--configuration:

General Shipping Configuration
==============================

.. contents:: :local:
   :depth: 2

You can control the following options on the system configuration level:

* In the **Shipping Origin**, set the default shipping origin address.

* In the **Shipping Options**, enable and disable the shipping units of length and weight and the freight class.

* In the **Shipping Tax**, label the taxes that apply to the shipping cost.

Configure Shipping Origin
-------------------------

.. include:: /admin_guide/shipping/configuration/shipping_origin.rst
   :start-after: begin

Configure Shipping Options
--------------------------

.. include:: /admin_guide/shipping/configuration/shipping_options.rst
   :start-after: begin

Configure Shipping Tax
----------------------

.. include:: /admin_guide/landing_commerce/taxation/shipping_tax.rst
   :start-after: begin

Now that you have set the system-wide shipping configuration, you can start creating a :ref:`shipping integration <sys--integrations--manage-integrations--ups--flat-rate>` with a certain provider and a :ref:`shipping rule <sys--shipping-rules>` to enable the integration for a particular website, order, or destination.

**Related Topics**

* :ref:`Shipping Configuration <admin-guide--shipping>`
* :ref:`Shipping Method Integration <sys--integrations--manage-integrations--ups--flat-rate>`
* :ref:`Shipping Rules Configuration <sys--shipping-rules>`


.. include:: /img/buttons/include_images.rst
   :start-after: begin

.. toctree::
   :maxdepth: 1
   :hidden:

   shipping_options

   shipping_origin