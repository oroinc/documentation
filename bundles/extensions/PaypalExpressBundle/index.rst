:oro_local_toc_max_depth: 3

.. _bundle-docs-extensions-paypalexpress:

OroPayPalExpressBundle
======================

This extension provides an implementation of PayPal Express payment integration that can be used in European countries (please check the PayPal website in your country to confirm the availability of PayPal Express in your country).

Overview
--------

The bundle provides integration between OroCommerce and PayPal through |PayPal REST API|. The main difference between PayPal payment methods defined in OroPayPalBundle and OroPayPalExpressBundle is how they communicate with PayPal. While OroPayPalBundle uses |Payflow Gateway|, OroPayPalExpressBundle uses |PayPal REST API|. Both ways have their restrictions.

Under the hood, this bundle is using |PayPal PHP SDK| to communicate with |PayPal REST API|. See more in |REST API Samples| documentation on the PayPal side.

Structure
---------

The following diagram illustrates the structure of PaypalExpressBundle, with the arrows placed in the direction of dependency:

.. image:: /img/bundles/PaypalExpressBundle/structure.png
  :alt: The diagram illustrating the structure of paypalbundle
  :scale: 50%

The example Anti-Corruption Layer depends on PayPal SDK.

Installation
------------

This extension can be added to an existing installation of OroCommerce:

Use composer to add the package code:

.. code-block:: bash

   composer require oro/commerce-paypal-express

Perform the installation:

.. code-block:: bash

   php bin/console oro:platform:update --env=prod

Responsibilities and Extension Points
-------------------------------------

Anti-Corruption Layer
^^^^^^^^^^^^^^^^^^^^^

Anti-Corruption Layer is responsible for the communication with |PayPal REST API| through |PayPal PHP SDK| and the conversion of OroPayPalExpress DTO to PayPal SDK domain data objects. Keep in mind that reverse translation is not implemented.

The anti-corruption layer includes a couple of DTO objects, as well as:

* |PayPalExpressTransport|
* |PayPalClient|
* |PayPalSDKObjectTranslator|

The primary goal of this layer is to hide the actual way of communication with |PayPal REST API|. It also helps avoid backward-incompatible changes if PayPal changes its REST API in the future. It is also helpful for implementing the reverse side integration with PayPal.

PayPalExpressTransport
~~~~~~~~~~~~~~~~~~~~~~

PayPalExpressTransport is responsible for the interaction with |PayPalClient| and |PayPalSDKObjectTranslator| and hiding and wrapping PayPal SDK exceptions in the client code of OroCommerce.

PayPalClient
~~~~~~~~~~~~

PayPalClient is responsible for interacting with |PayPal REST API| through |PayPal PHP SDK|.

Any operation that calls PayPal REST API resource, as a result, should be added to the client.

PayPalSDKObjectTranslator
~~~~~~~~~~~~~~~~~~~~~~~~~

PayPalSDKObjectTranslator is responsible for converting anti-corruption layer DTO's to the |PayPal PHP SDK| domain data objects.

Payment Actions Layer
^^^^^^^^^^^^^^^^^^^^^

The payment actions layer is responsible for handling payment actions.

The layer includes:

* |PaymentActionRegistry|
* |CompletePaymentActionRegistry|
* |PaymentActionExecutor|
* |CompleteVirtualAction| in addition to supported actions and complete actions implementing |PaymentActionInterface|

PaymentActionExecutor
~~~~~~~~~~~~~~~~~~~~~

PaymentActionExecutor is responsible for executing a payment action. It uses |CompletePaymentActionRegistry| to get an appropriate payment action.

PaymentActionRegistry
~~~~~~~~~~~~~~~~~~~~~

PaymentActionRegistry is responsible for providing payment action by name. It can be used as an extension point to add custom payment action.
A possible payment action could be found in the constants of ``\Oro\Bundle\PaymentBundle\Method\PaymentMethodInterface``.
Actions that are not presented in the interface can be added, but the default workflows will not support them.

CompleteVirtualAction
~~~~~~~~~~~~~~~~~~~~~

CompleteVirtualAction is responsible for receiving a complete payment action by name from |CompletePaymentActionRegistry| and delegating the call to the actual complete payment action.

CompletePaymentActionRegistry
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

CompletePaymentActionRegistry is responsible for providing a complete payment action by name.

A complete payment action is configured in the PayPal Express method integration settings in a field labeled "Payment Action".

By default, two possible complete actions are available:

* Authorize (|AuthorizeAndCaptureAction|)
* Authorize and capture (|AuthorizeOnCompleteAction|)

To register a new complete payment action, create a new service with tag `oro_paypal_express.complete_payment_action` (class of the service must implement |PaymentActionInterface|).

After a new service is registered, it will be available in the integration settings of the PayPal Express payment method.


.. include:: /include/include-links-dev.rst
   :start-after: begin