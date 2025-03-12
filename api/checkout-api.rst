.. _bundle-docs-commerce-checkout-bundle--checkout-api:

Storefront Checkout API Guide
=============================

This guide explains how to complete the checkout process using the Checkout API. The steps include creating a checkout record, selecting a payment and shipping methods, validating the readiness of the payment, and processing the payment. Once the payment is successful, an order resource is returned.

.. _checkout-api-example-order-response:

**Example of the order resource**:

.. code-block:: json

    {
      "data": {
        "type": "orders",
        "relationships": {
          "billingAddress": {
            "data": {
              "type": "orderaddresses",
              "id": "billing1"
            }
          },
          "shippingAddress": {
            "data": {
              "type": "orderaddresses",
              "id": "shipping1"
            }
          },
          "lineItems": {
            "data": [
              {
                "type": "orderlineitems",
                "id": "item1"
              }
            ]
          }
        }
      },
      "included": [
        {
          "type": "orderaddresses",
          "id": "billing1",
          "relationships": {
            "customerAddress": {
              "data": {
                "type": "customeraddresses",
                "id": "1"
              }
            }
          }
        },
        {
          "type": "orderaddresses",
          "id": "shipping1",
          "relationships": {
            "customerAddress": {
              "data": {
                "type": "customeraddresses",
                "id": "1"
              }
            }
          }
        },
        {
          "type": "orderlineitems",
          "id": "item1",
          "attributes": {
            "quantity": 10
          },
          "relationships": {
            "product": {
              "data": {
                "type": "products",
                "id": "1"
              }
            },
            "productUnit": {
              "data": {
                "type": "productunits",
                "id": "item"
              }
            }
          }
        }
      ]
    }

Step 1: Create a Checkout Record
--------------------------------

To initiate the checkout process, create a new checkout record by making a **POST** request to ``/api/checkouts``:

.. code-block:: http

    POST /api/checkouts HTTP/1.1

    {
      "data": {
        "type": "checkouts"
      }
    }

This request creates a new checkout record, which is returned in the response and is required for subsequent steps.

Alternatively, a checkout process can be initiated using an existing source entity:

- **POST** ``/api/orders/{id}/checkout`` to create checkout based on a specific order.
- **POST** ``/api/shoppinglists/{id}/checkout`` to create checkout based on a shopping list.

Step 2: Retrieve and Set Shipping and Payment Methods
-----------------------------------------------------

Placing an order requires specifying shipping and payment method details.

* :ref:`Shipping Configuration <user-guide--shipping>`:

  - Create one or more shipping methods by configuring :ref:`integrations with the shipping providers <sys--integrations--manage-integrations--ups--flat-rate>`.
  - Set up :ref:`shipping rules <sys--shipping-rules>` that enable shipping methods for quotes/orders created with specific destination areas and/or limit shipping availability via custom conditions.
  - Other. See the :ref:`Shipping Configuration <user-guide--shipping>` guide for more details.

* :ref:`Payment Configuration <user-guide--payment>`:

  - Create one or more payment methods by configuring :ref:`integrations with the payment providers <sys--integrations--manage-integrations--payment-methods>`.
  - Set up :ref:`payment rules <sys--payment-rules>` that enable payment methods for orders created with specific destination areas and/or limit payment availability via custom conditions.
  - Other. See the :ref:`Payment Configuration <user-guide--payment>` guide for more details.

You can retrieve information on currently available shipping and payment methods through additional checkout API subresources. To obtain accurate methods, you need to set the billing and shipping addresses.

To retrieve the available shipping methods, use:

.. code-block:: http

    GET /api/checkouts/1/availableShippingMethods HTTP/1.1

.. note::
    The shipping method information consists of two parts: shipping method and shipping method type. Shipping method types define different specifics of the same shipping method.

To retrieve the available payment methods, use:

.. code-block:: http

    GET /api/checkouts/1/availablePaymentMethods HTTP/1.1

Once you have selected the preferred shipping and payment methods, update the checkout record by making a **PATCH** request to ``/api/checkouts/{id}``.

Example:

.. code-block:: http

    PATCH /api/checkouts/1 HTTP/1.1

    {
      "data": {
        "type": "checkouts",
        "id": "1",
        "attributes": {
          "paymentMethod": "oro_paypal_express_1",
          "shippingMethod": "flat_rate_6",
          "shippingMethodType": "primary"
        }
      }
    }

Step 3: Validate Checkout Readiness
-----------------------------------

Once the details have been filled in, an order can be placed once the payment process has been completed. Before initiating payment, confirm that the checkout is fully configured and ready for processing by making a **GET** request to ``/api/checkouts/{id}/payment``.

Example:

.. code-block:: http

    GET /api/checkouts/1/payment HTTP/1.1

This step ensures all necessary details are set before proceeding with the payment.

Below is an example of a response when the checkout is ready for payment:

.. code-block:: json

    {
      "meta": {
        "message": "The checkout is ready for payment.",
        "paymentUrl": "https://host/api/checkouts/1/paymentPaymentTerm",
        "errors": []
      }
    }

Step 4: Process Payment
-----------------------

Select a payment method and proceed with the transaction accordingly. The next steps depend on the selected payment method flow.

.. note::
    In the examples below, ``https://my-application.ltd`` represents a host of the client application using the Oro API, while ``https://oro-application.ltd`` refers to the Oro application.

On successful completion of the payment process, the checkout process is completed, and an :ref:`order resource <checkout-api-example-order-response>` is returned.

Stripe Payment
^^^^^^^^^^^^^^

1. Submit Stripe payment details by making a **POST** request to ``/api/checkouts/{id}/paymentInfoStripe``. Stripe PaymentMethod ID (``pm_stripepaymentmethodid`` in the example) should be received by your application from |Stripe Payment Element| or |Stripe API - Payment Methods|.

Example:

.. code-block:: http

    POST /api/checkouts/1/paymentInfoStripe HTTP/1.1

    {
      "meta": {
        "stripePaymentMethodId": "pm_stripepaymentmethodid"
      }
    }

2. Execute the payment by making a **POST** request to ``/api/checkouts/{id}/paymentStripe``.

Example:

.. code-block:: http

    POST /api/checkouts/1/paymentStripe HTTP/1.1

    {
      "meta": {
        "successUrl": "https://my-application.ltd/checkout/payment/stripe/success",
        "failureUrl": "https://my-application.ltd/checkout/payment/stripe/failure",
        "partiallyPaidUrl": "https://my-application.ltd/checkout/payment/stripe/partiallyPaid"
      }
    }

On successful completion, the checkout process is concluded, and an :ref:`order resource <checkout-api-example-order-response>` is returned.

If the payment cannot be completed, the API will return error responses containing the information necessary to complete the payment process.

If additional steps (such as 3D Secure authentication) are required, they must be handled within the application before making a follow-up **POST** request to ``/api/checkouts/{id}/paymentStripe`` to finalize the payment. You should follow the documentation provided by the payment method service for more information on how to proceed and use the data provided.

PayPal Express Payment
^^^^^^^^^^^^^^^^^^^^^^

1. Initiate the PayPal Express payment process by making a **POST** request to ``/api/checkouts/{id}/paymentPayPalExpress``.

Example:

.. code-block:: http

    POST /api/checkouts/1/paymentPayPalExpress HTTP/1.1

    {
      "meta": {
        "successUrl": "https://my-application.ltd/checkout/payment/paypal-express/success",
        "failureUrl": "https://my-application.ltd/checkout/payment/paypal-express/failure"
      }
    }

A response will be returned with a URL in the ``purchaseRedirectUrl`` attribute that should be used to redirect the user to PayPal for payment authentication.

Below is an example of a response when initial payment request is sent:

.. code-block:: json

    {
    "errors": [
      {
        "status": "400",
        "title": "payment action constraint",
        "detail": "Payment should be completed on the merchant's page, follow the link provided in the error details.",
        "meta": {
          "data": {
            "paymentMethod": "oro_paypal_express_1",
            "paymentMethodSupportsValidation": false,
            "errorUrl": "http://oro-application.ltd/payment/callback/error/e111111c-1111-1111-1abc-11dc1d1111f1",
            "returnUrl": "http://oro-application.ltd/payment/callback/return/e111111c-1111-1111-1abc-11dc1d1111f1",
            "failureUrl": "https://my-application.ltd/checkout/payment/paypal-express/failure",
            "successUrl": "https://my-application.ltd/checkout/payment/paypal-express/success",
            "purchaseRedirectUrl": "http://paypal-express-domain.com/redirectUrl"
          }
        }
      }
    ]
  }

2. After returning from the payment system, submit a second **POST** request to ``/api/checkouts/{id}/paymentPayPalExpress`` to finalize the checkout.

On successful completion, the checkout process is concluded, and an :ref:`order resource <checkout-api-example-order-response>` is returned.

Payment Term Payment
^^^^^^^^^^^^^^^^^^^^

To complete the payment using a payment term, execute **POST** request to ``/api/checkouts/{id}/paymentPaymentTerm``:

Example:

.. code-block:: http

    POST /api/checkouts/1/paymentPaymentTerm HTTP/1.1

On successful completion, the checkout process is concluded, and an :ref:`order resource <checkout-api-example-order-response>` is returned.

Error Handling and Security Considerations
------------------------------------------

API responses include HTTP status codes and error messages to assist in troubleshooting payment failures. Securely transmit payment information and follow PCI-DSS compliance guidelines when handling sensitive payment data.

Below are examples of:

* a response when checkout is not ready for payment (Checkout Readiness validation):

.. code-block:: json

    {
      "meta": {
        "message": "The checkout is not ready for payment.",
        "paymentUrl": null,
        "errors": [
          {
            "status": "400",
            "title": "not blank constraint",
            "detail": "Shipping method is not selected.",
            "source": {
              "pointer": "/data/attributes/shippingMethod"
            }
          },
          {
            "status": "400",
            "title": "not blank constraint",
            "detail": "Payment method is not selected.",
            "source": {
              "pointer": "/data/attributes/paymentMethod"
            }
          }
        ]
      }
    }

* another response when checkout is not ready for payment:

.. code-block:: json

    {
      "errors": [
        {
          "status": "400",
          "title": "payment constraint",
          "detail": "The checkout is not ready for payment.",
          "meta": {
            "validatePaymentUrl": "https://oro-application.ltd/api/checkouts/1/payment"
          }
       }
      ]
    }

* a response when for payment is still in progress:

.. code-block:: json

    {
      "errors": [
        {
          "status": "400",
          "title": "payment status constraint",
          "detail": "Payment is being processed. Please follow the payment provider's instructions to complete it."
        }
      ]
    }

* a response when for payment failed with an error:

.. code-block:: json

    {
      "errors": [
        {
          "status": "400",
          "title": "payment constraint",
          "detail": "Payment failed, please try again or select a different payment method."
        }
      ]
    }

*  a response when additional actions are required:

.. code-block:: json

    {
      "errors": [
        {
          "status": "400",
          "title": "payment action constraint",
          "detail": "The payment requires additional actions.",
          "meta": {
            "data": {
              "paymentMethod": "stripe_payment_1",
              "paymentMethodSupportsValidation": false,
              "errorUrl": "http://oro-application.ltd/payment/callback/error/e111111c-1111-1111-1abc-11dc1d1111f1",
              "returnUrl": "http://oro-application.ltd/payment/callback/return/e111111c-1111-1111-1abc-11dc1d1111f1",
              "failureUrl": "https://my-application.ltd/checkout/payment/stripe/failure",
              "partiallyPaidUrl": "https://my-application.ltd/checkout/payment/stripe/partiallyPaid",
              "successUrl": "https://my-application.ltd/checkout/payment/stripe/success",
              "additionalData": {
                "stripePaymentMethodId": "pm_stripepaymentmethodid",
                "customerId": "cus_stripecustomerid",
                "paymentIntentId": "pi_stripepaymentintentid"
              },
              "successful": false,
              "requires_action": true,
              "payment_intent_client_secret": "pi_stripe_secret_key"
            }
          }
        }
      ]
    }

References
----------

 * |Stripe Payment Element|
 * |Stripe API - Payment Methods|
 * |OroPayPalExpressBundle|
 * :ref:`Shipping Configuration <user-guide--shipping>`
 * :ref:`Payment Configuration <user-guide--payment>`

.. include:: /include/include-links-dev.rst
   :start-after: begin
