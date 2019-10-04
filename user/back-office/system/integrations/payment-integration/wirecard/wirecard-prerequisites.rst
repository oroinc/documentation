:oro_documentation_types: commerce

.. _doc--payment--prerequisites--wirecard:

Prerequisites for Wirecard Integration
======================================

.. begin

To start using Wirecard payment methods with the OroCommerce application, complete the following:

1. Sign up for the Wirecard service at |wirecard.com| and configure it. You will need to contact the Wirecard support team to do it.

#. From the Wirecard support team, obtain the following credentials:

   * **Customer ID**—The unique identifier of your Wirecard account.
   * **Secret**—This is a pre-shared key used to cipher payment information.
   * **Shop ID**—If you have several online shops for which you want to configure payments using the same Wirecard account, this identifier is used to distinguish between the shops. Consult the Wirecard support team about whether you need a Shop ID.

   You will use them to set up the integration between Wirecard and OroCommerce.

#. In your Oro back-office, configure an integration with Wirecard. See the :ref:`Wirecard Integration <doc--payment--configuration--payment-method-integration--wirecard>` topic for more information. You can configure several integrations with different sets of options to enable multiple Wirecard payment methods for checkout.

#. In your Oro back-office, configure a payment rule that defines conditions under which the configured payment method is available during checkout. For example, a certain method may be available for customers from France, or only when a shopping cart amount exceeds EUR1000. See the :ref:`Payment Rules <sys--payment-rules>` topic for more information.

Now you are ready to accept card payments via Wirecard.

.. _doc--payment--prerequisites--wirecard-testing:

Test Wirecard Integration
-------------------------

When you set up a Wirecard integration for the first time and would like to check how payment via Wirecard payment methods works, you can use the Wirecard :ref:`Demo Mode <doc--payment--prerequisites--wirecard-testing-demo>`.

To troubleshoot the integration issues or demonstrate the payment process, you can use your Wirecard account in :ref:`Test Mode <doc--payment--prerequisites--wirecard-testing-test>`.

.. _doc--payment--prerequisites--wirecard-testing-demo:

Demo Mode
^^^^^^^^^

In the demo mode, transactions created for the OroCommerce checkout are never sent to the financial institution for processing. All communications take place only between you OroCommerce shop and a Wirecard server.

Set up an integration using the credentials provided by Wirecard for the demo mode.

.. important:: The credit card numbers suggested by the Wirecard for the use in the demo mode does not pass the validation in OroCommerce that requires that valid card numbers must be used. To test the Wirecard credit card payments, use the :ref:`Test Mode <doc--payment--prerequisites--wirecard-testing-test>`.

For demo credentials and more information about the demo mode, see |Wirecard Demo Mode|.

.. _doc--payment--prerequisites--wirecard-testing-test:

Test Mode
^^^^^^^^^

In the test mode, the transaction information is sent to the financial institution, however, it reaches only a test server/area provided by the financial institution and actual money transfer does not take place.

Set up an integration using the credentials provided by Wirecard for the test mode. Enable the **Test mode** option to inform the system that you would like only to test the payment process.

For testing credentials and more information about the test mode, see |Wirecard Test Mode|.

.. _doc--payment--prerequisites--wirecard-testing-test-enable:

Enable the Test Mode
--------------------

To enable the test mode, complete the following:

1. Navigate to **System > Integrations > Manage Integrations**.

2. Click the Wirecard integration for which you would like to turn the test mode on.

3. On the integration edit page, provide the testing credentials if required, find the **Test Mode** check box and select it.

4. Click **Save & Close**.

.. include:: /include/include-links.rst
   :start-after: begin

