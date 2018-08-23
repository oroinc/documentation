.. _price_list_configuration:
.. _pricing-configuration:

Price Calculation Optimization
------------------------------

* :ref:`How to Configure Price List Sharding <admin-price-list-sharding>`
* :ref:`Optimize Website Indexation and Price Recalculation <admin-website-index-and-price-calc>`

Pricing Configuration
---------------------

.. start

OroCommerce groups price configuration options into the following categories:

.. contents:: :local:

Global Currency Configuration
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. include:: /admin_guide/pricing/global_currency.rst
   :start-after: begin
   :end-before: finish

Currency Configuration per Website
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. include:: /admin_guide/pricing/website_pricing.rst
   :start-after: begin
   :end-before: finish

Global Pricing Configuration
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. include:: /admin_guide/pricing/global_pricing.rst
   :start-after: begin
   :end-before: finish

Price List Configuration
~~~~~~~~~~~~~~~~~~~~~~~~

.. include:: /admin_guide/pricing/price_list_configuration_overview.rst
   :start-after: begin
   :end-before: finish

Default
^^^^^^^

See **Price Lists** option description in the :ref:`Global Pricing Configuration <sys--config--commerce--catalog--pricing>` topic.

Per Website
^^^^^^^^^^^

.. include:: /admin_guide/pricing/website_price_lists.rst
   :start-after: begin
   :end-before: finish

Per Customer Group
^^^^^^^^^^^^^^^^^^

.. include:: /admin_guide/pricing/customer_group_price_lists.rst
   :start-after: begin
   :end-before: finish

Per Customer
^^^^^^^^^^^^

.. include:: /admin_guide/pricing/customer_price_lists.rst
   :start-after: begin
   :end-before: finish


.. stop

.. include:: /img/buttons/include_images.rst
   :start-after: begin

.. toctree::
   :maxdepth: 1
   :hidden:

   common_price_list_configuration_options

   customer_group_price_lists

   customer_price_lists

   global_currency

   global_pricing

   price_list_configuration_overview

   website_price_lists

   website_pricing

   price_list_sharding

   optimize_index_and_price_calculation
