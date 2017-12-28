.. _user-guide--payment--configuration--payment-method-integration--common-details:

Common Payment Integration Details
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. begin

Basic information about the payment is shared among all payment methods and includes:

.. embedded_list

* **Name**—The payment method name that is shown as an option for payment configuration in the OroCommerce Management Console.
* **Label**—The payment method name/label that is shown as a payment option for the buyer in the OroCommerce Store Front during the checkout. It may not include the payment processor name if you want to hide it from the buyers. For example, you can enter 'Credit Card Payments' if you have a single payment method configured for processing credit cards.

  Click the |IcTranslations| **Translations** icon to provide spelling for different languages. Click the |IcTranslationsC| **Default Language** icon to return to the single-language view.

* **Short label**—The payment method name/label that is shown in the order details in the OroCommerce Management Console and Front Store after the order is submitted.

  Click the |IcTranslations| **Translations** icon to provide spelling for different languages. Click the |IcTranslationsC| **Default Language** icon to return to the single-language view.

* **Status**—Set the status to **Active** to enable the integration.
* **Default Owner**—A user who is responsible for this integration and manages it.

.. end_of_embedded_list

   .. image:: /configuration_guide/img/integrations/manage_integrations/payment_terms.png
      :class: with-border

   .. image:: /configuration_guide/img/integrations/manage_integrations/integration_translation.png
      :class: with-border

.. finish

.. include:: /user_guide/include_images.rst
   :start-after: begin