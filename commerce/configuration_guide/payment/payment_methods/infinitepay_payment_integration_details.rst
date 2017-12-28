.. _user-guide--payment--configuration--payment-method-integration--infinitepay-details:

Payment Integration Details For InfinitePay Payment Methods
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. begin

InfinitePay integrations include the following additional integration information:

.. embedded_list

* **Client Reference** --- The unique identifier of your InfinitePay account.
* **Username** --- Login for your InfinitePay account that is used to authenticate OroCommerce calls to the InfinitePay API.
* **Password** --- Password that is used to authenticate OroCommerce calls to the InfinitePay API.
* **Secret (For Security Code)** --- This is a pre-shared key used to cipher payment information.
* **Auto-Capture** --- When enabled, the amount for payment is blocked on the buyer's InfinitePay account (limit) immediately after the order is submitted. See more information about the :ref:`InfinitePay guarantee actions <user-guide--payment--configuration--payment-method-integration--infinitepay-payment-actions>` (reserve, capture, and activate).
* **Auto-Activation** --- When enabled, the payment guarantee is activated upon the order submission. The successful activation means that InfinitePay approves the payment, provides a guarantee for the financial risks related to the future payment. See more information about the :ref:`InfinitePay guarantee actions <user-guide--payment--configuration--payment-method-integration--infinitepay-payment-actions>` (reserve, capture, and activate).
* **Test mode** --- an option that enables calling PayPal API in the test mode.
* **Debug Mode** --- when enabled, InfinitePay transactions include more detailed information in the response. This mode may be helpful when troubleshooting payment-related issues.
* **Invoice Due Period** --- the unified invoice due period that is applied to the invoices created in InfinitePay. It is taken into account to estimate the payment due date.
* **Shipping Duration (In Days)** --- the unified timeframe reserved for shipping. It is taken into account to estimate the payment due date.

.. **InfinitePay Integration Configuration Details**

.. .. image:: /configuration_guide/img/integrations/manage_integrations/PayPalPayflow1.png

.. end_of_embedded_list