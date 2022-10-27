.. _bundle-docs-extensions-dpd:

OroDPDBundle
============

|OroDPDBundle| adds the |DPD website| shipping service |integration| to Oro applications and helps admin users to enable and configure DPD |shipping methods| for invoices, quotes, and customer orders. The bundle also adds the |operation button| for admin users to the order view pages to provide order shipping data and send the package pick-up request to the DPD service.

The DPD shipping provides functionality to:

* Implement the *DPD Classic* shipping method type.
* Use *flat-rate* or *table-rate* shipping cost calculation.
* CSV import/export for *table-rates*.
* API based parcel pick-up day/time calculation and validation.
* API based shipping address validation.
* API based PDF label retrieval for orders.

Configuration data of *Shipping Origin* is used in the DPDBundle as the parcel pick-up address. This address is used to calculate the locale specific available pick-up days and is configured under **System > Configuration > Commerce > Shipping > Shipping Origin** in the back-office.

For more information, see the :ref:`Configure DPD Shipping Integration in the Back-Office <doc--integrations--dpd>` topic in the user guide.


.. admonition:: Business Tip

   Manufacturing companies are gradually embracing digital technologies. Discover how eCommerce can help you achieve |digital transformation in manufacturing|.

.. include:: /include/include-links-dev.rst
   :start-after: begin

.. include:: /include/include-links-seo.rst
   :start-after: begin