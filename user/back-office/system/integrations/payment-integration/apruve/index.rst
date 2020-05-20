:oro_documentation_types: OroCommerce, Extension

.. _user-guide--payment--payment-providers-overview--apruve:

Apruve Payment Service
======================

.. important:: This section is a part of the :ref:`Payment Configuration <user-guide--payment>` topic that provides the general understanding of the payment concept in OroCommerce.

.. hint:: The feature requires extension, so visit Oro Marketplace to download the |Apruve extension| and then use the composer to :ref:`install the extension to your application <cookbook-extensions-composer>`.

Apruve is a B2B credit management service that provides a credit line for your buyers. Apruve manages business account for OroCommerce sellers starting from credit approval and financing and facilitates credit-related interactions with buyer via their account set up, invoicing, and payment.

Integration of OroCommerce with Apruve enables you to secure your company from financial risks related to delayed payments. Apruve allows you to get the payment within 24 hours of any invoice being generated. You offer terms to your customer but still get the payment for your sales within 1 day.

To set up Apruve payment service in OroCommerce:

1. Learn the :ref:`Prerequisites for Apruve Integration <user-guide--payment--prerequisites--apruve>` that will help configure the integration properly and retrieve corresponding credentials.
2. Configure :ref:`Apruve Payment Method Integration <user-guide--payment--configuration--payment-method-integration--apruve>` under **System > Integrations > Manage Integrations**.
3. Create a :ref:`payment rule <sys--payment-rules>` under **System > Payment Rules** and add your integration to it to display this method to the customers at the checkout.


**Related Topics**

* :ref:`Payment Configuration Concept Guide <user-guide--payment>`
* :ref:`Payments at Checkout (Illustration) <doc--payment--checkout>`
* :ref:`System Payment Configuration <configuration--guide--commerce--configuration--payment>`


.. toctree::
   :hidden:
   :maxdepth: 1

   apruve-prerequisites
   apruve-integration

.. include:: /include/include-links-user.rst
   :start-after: begin