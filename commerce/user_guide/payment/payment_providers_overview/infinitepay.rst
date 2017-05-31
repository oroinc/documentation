.. _user-guide--payment--payment-providers-overview--infinitepay:

InfinitePay Payment Service
~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. begin

InfinitePay is a financial management company that provides guaranteed delayed payments on open account terms.

Integration of OroCommerce with InfinitePay enables you to secure your company from financial risks related to delayed payments.

You can secure payments from the buyers in more than 40 countries worldwide. Contact the InfinitePay support for the complete list of the countries in which InfinitePay supports claims.

.. note::
   See :ref:`Prerequisites for InfinitePay Integration <user-guide--payment--prerequisites--infinitepay>` topic for pre-integration steps.
   See :ref:`InfinitePay Integration <user-guide--payment--configuration--payment-method-integration--infinitepay-details>` topic for detailed integration steps.

.. Security
.. ^^^^^^^^

.. OroCommerce server never stores buyer's sensitive payment information (complete card number, expiration date, and cvv code).

.. OroCommerce uses `Authorize.Net Accept.js <https://developer.authorize.net/api/reference/features/acceptjs.html>`_ library to process buyer's sensitive information in the client web browser.

.. Transaction response from the payment gateway also does not contain sensitive information about buyer's card. It serves as an identifier of the initial authorization that is solely handled by the payment gateway.


