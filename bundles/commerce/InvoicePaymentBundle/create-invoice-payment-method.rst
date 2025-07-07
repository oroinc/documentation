.. _bundle-docs-commerce-invoice-payment-bundle-create-invoice-payment-method:

Create an Invoice Payment Method
================================

To create a new invoice payment method, you should either already have an implemented payment method or implement a new one. If you want a new payment method, you can refer to the :ref:`How to Create a Payment Method <dev-extend-commerce-payment-create-payment-method>` section of the documentation.

If you already have a payment method, you can proceed with making it available for invoice payments.

Payment Method Group
--------------------

Implement the ``\Oro\Bundle\PaymentBundle\Method\PaymentMethodGroupAwareInterface`` interface in your payment method class. This interface allows to group payment methods by specific groups, e.g., ``oro_invoice_payment_storefront`` group for invoice payments. For example:

.. code-block:: php
   :caption: src/Acme/DemoBundle/Payment/Method/MyCustomPaymentMethod.php

    namespace Acme\DemoBundle\PaymentMethod;

    use Oro\Bundle\PaymentBundle\Method\PaymentMethodInterface;
    use Oro\Bundle\PaymentBundle\Method\PaymentMethodGroupAwareInterface;

    class MyCustomPaymentMethod implements PaymentMethodInterface, PaymentMethodGroupAwareInterface
    {
        #[\Override]
        public function isApplicableForGroup(string $groupName): array
        {
            return in_array($groupName, ['default', 'oro_invoice_payment_storefront']);
        }

        // Other methods...
    }

.. hint:: The ``default`` payment method group is required to make the payment method available on checkout pages.

.. note:: Please take into account that the payment method must also support the ``charge`` payment action, as it is the only action used for invoice payments.


Payment Method View
-------------------

Each payment method has the view class implemented via the ``\Oro\Bundle\PaymentBundle\Method\View\PaymentMethodViewInterface`` interface. The Twig block name provided by the ``PaymentMethodViewInterface::getBlock`` method should be declared in the ``oro_invoice_payment_method`` layout import.

If the payment method Twig block name is ``my_custom_payment_method_widget``, then the example would look like this:

.. code-block:: yaml
   :caption: Resources/views/layouts/default/oro_invoice_payment_method/my_custom_payment_method.yml

    layout:
        actions:
            - '@setBlockTheme':
                themes:
                    - 'my_custom_payment_method.html.twig'


.. code-block:: none
   :caption: Resources/views/layouts/default/oro_invoice_payment_method/my_custom_payment_method.html.twig

    {% block my_custom_payment_method_widget %}
       {% import '@OroUI/macros.html.twig' as UI %}

       {% set component = payment_method_view.options.paymentMethodComponent|default('acmedemo/js/app/components/my-custom-payment-component') %}
       {% set component_name = "invoice-payment-method--" ~ payment_method_view.identifier %}
       {% set component_options = payment_method_view.options.componentOptions|merge({
         paymentMethodIdentifier: payment_method_view.identifier
       }) %}

       <div id="{{ component_name }}" data-role="invoice-payment-method"
          class="invoice-payment-method invoice-payment-method__my_custom_payment_method"
             {{ UI.renderPageComponentAttributes({
                 'name': component_name,
                 'module': component,
                 'options': component_options
             }) }}>
         <div data-role="invoice-payment-method-form" class="invoice-payment-method-form">
             <div class="form-row">
                 {# my custom payment method form view #}
             </div>
         </div>
       </div>
    {% endblock %}

Your payment method will then appear on the invoice payment page in the storefront.


Payment Method JavaScript Component
-----------------------------------

To ensure that the payment method functions correctly on the invoice payment page, implement a JavaScript component that will handle the payment form events, such as submitting the payment form and updating the payment method data, etc. The bundle provides the ``oroinvoicepayment/js/app/components/invoice-payment-component`` component with the payment form model ``oroinvoicepayment/js/app/models/invoice-payment-model``  to simplify and unify the payment method implementation on the invoice payment page.
The payment form model is used to collect the payment method data and current state of the payment process. The payment method component should listen to the changes of the payment form model to respond appropriately during actions such as submit, pause, resume, or error handling.

Implementation example:

.. code-block:: js
   :caption: src/Acme/DemoBundle/Resources/public/js/app/components/my-custom-payment-component.js

    import BaseComponent from 'oroui/js/app/components/base/component';

    const MyCustomInvoicePaymentMethodComponent = BaseComponent.extend({
        relatedSiblingComponents: {
            invoicePaymentComponent: 'invoice-payment-component'
        },

        optionNames: BaseComponent.prototype.optionNames.concat([
            'paymentMethodIdentifier'
        ]),

        paymentMethodIdentifier: null,

        constructor: function MyCustomInvoicePaymentMethodComponent(options) {
            MyCustomInvoicePaymentMethodComponent.__super__.constructor.call(this, options);
        },

        initialize(options) {
            MyCustomInvoicePaymentMethodComponent.__super__.initialize.call(this, options);

            this.$el = options._sourceElement;
            this.invoicePaymentModel = this.invoicePaymentComponent.invoicePaymentModel;
        },

        delegateListeners() {
            this.listenTo(
                this.invoicePaymentModel,
                'change:state',
                this.onInvoicePaymentModelChangeState.bind(this)
            );
        },

        onInvoicePaymentModelChangeState() {
            if (this.invoicePaymentModel.isSubmitStarted()) {
                this.onInvoicePaymentSubmitStart();
            }
        },

        onInvoicePaymentSubmitStart() {
            if (!this.invoicePaymentModel.isSubmitStarted()) {
                return;
            }

            if (this.invoicePaymentModel.getPaymentMethodIdentifier() !== this.paymentMethodIdentifier) {
                return;
            }

            this.invoicePaymentModel.pauseSubmit();

            // Make requests to some payment gateway API if needed to acquire some payment token.

            // Add payment method data to the invoice payment model if needed.
            this.invoicePaymentModel.setPaymentMethodData({samplePaymentToken: 'sampleValue'});

            // Proceed with submitting the payment form.
            this.invoicePaymentModel.resumeSubmit();

            // Or cancel the submit if there is an error.
            // this.invoicePaymentModel.cancelSubmit('An error occurred while processing the payment.');
        },

        onInvoicePaymentSubmitFinish() {
            if (!this.invoicePaymentModel.isSubmitFinished()) {
                return;
            }

            if (this.invoicePaymentModel.getPaymentMethodIdentifier() !== this.paymentMethodIdentifier) {
                return;
            }

            const paymentMethodResult = this.invoicePaymentModel.getPaymentMethodResult();

            if (paymentMethodResult.successful) {
                // Handle successful payment
                this.invoicePaymentModel.succeedPayment();

                if (paymentMethodResult.successUrl) {
                    mediator.execute('redirectTo', {url: paymentMethodResult.successUrl}, {redirect: true});
                }
            } else {
                // Handle unsuccessful payment

                this.invoicePaymentModel.failPayment();

                if (paymentMethodResult.errorUrl) {
                    mediator.execute('redirectTo', {url: paymentMethodResult.errorUrl}, {redirect: true});
                }
            }
        }
    });

    export default MyCustomInvoicePaymentMethodComponent;
