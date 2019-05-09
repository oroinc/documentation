.. _user-guide--payment--prerequisites--paypal-express:

Prerequisites for PayPal Express Services Integration
=====================================================

.. begin

.. contents:: :local:

Install Oro PayPal Express Integration Package
----------------------------------------------

Before you can use PayPal Express in OroCommerce, :ref:`install <cookbook-extensions-composer>` the `Oro PayPal Express Integration <https://packagist.oroinc.com/#oro/paypal-express>`_ package.

Register a Business Account with PayPal
---------------------------------------

To register a business account for your OroCommerce PayPal Express integration, follow the next steps:

#. Open `https://developer.paypal.com/ <https://developer.paypal.com/>`_ and click **Log In**.
#. On the login page that opens, click **Sign Up**.
#. On the following page, select **Business Account** and click **Continue**.
#. Select the service plan (Payment Pro, Payments Standard, or Express Checkout).

   The Get Started page opens.

   .. image:: /img/system/integrations/paypal/paypal_business_account_1.png

#. Type in your email.

   The Sign up for a Business account page opens.

   .. image:: /img/system/integrations/paypal/paypal_business_account_2.png

#. Enter the password and password confirmation.
#. Provide your business contact information.
#. Read the *PayPal User Agreement*.
#. Click **Agree and Continue**.

   On the following page, select your type of business and provide the requested additional information.

   .. image:: /img/system/integrations/paypal/paypal_business_account_3.png

#. Provide the requested personal information.

   .. image:: /img/system/integrations/paypal/paypal_business_account_4.png

#. Click **Submit**.

   The PayPal Business Account opens.

#. In *Account Setup*, confirm your email, link your bank account, and configure the credit card statement.

.. _paypal-express-test-account:

Create a Sandbox Test Account
-----------------------------

The PayPal Express sandbox test account is identical to the regular PayPal account but is hosted in the sandbox environment.

To create a sandbox test account, follow the next steps:

#. Log into the `https://developer.paypal.com/ <https://developer.paypal.com/>`_ with the credentials generated in the previous step.

#. Navigate to **Dashboard** and click **Accounts** in the **Sandbox** section.

#. Click **Create Account** to create a new sandbox account.

#. Fill in the account details (Account Type, Email Address, Password, PayPal Balance) and click **Create Account**.

#. Once the account is created, you can check its details by clicking the **Profile** link below the newly created account.

   .. image:: /img/system/integrations/paypal/paypal_sandbox_account.png

Here, you can view your profile details, sandbox API credentials, your test credit card number, the PayPal balance, and other configuration by clicking the corresponding tab.

   .. image:: /img/system/integrations/paypal/paypal_sandbox_profile_details.png

.. _paypal-express--sandbox-credentials:

Obtain Sandbox Credentials
--------------------------

Once you have created a sandbox account, you need to obtain the test credentials, such as **Client ID** and **Client Secret**, to check the integration between OroCommerce and PayPal Express in the test mode without any charges.

To receive the credentials, you need to create a corresponding REST API application:

#. Log into the `https://developer.paypal.com/ <https://developer.paypal.com/>`_ with your existing credentials.

#. Navigate to **Dashboard > My Apps & Credentials** in the main menu to the left.

#. Scroll down to the **REST API apps** section and click **Create App** to request the credentials.

   .. image:: /img/system/integrations/paypal/paypal_rest_API_credentials.png

#. Enter a name for your application and select a sandbox developer account from the list.

#. Click **Create App**.

   .. image:: /img/system/integrations/paypal/paypal_rest_API_credentials_steps.png

#. On the page that opens, select **Sandbox** to get the requested **Client ID** and **Client Secret** values.

   .. image:: /img/system/integrations/paypal/paypal_sandbox_API_credentials.png

#. Use the credentials to set up the test integration between PayPal Express and OroCommerce.


.. _paypal-express--production-credentials:

Obtain Production Credentials
-----------------------------

Once you have successfully configured the PayPal Express integration as described in the :ref:`PayPal Express <config-guide--payment--paypal-express>` guide, and the connection to the test environment is working properly, you can move to a production stage, but this time use the production credentials.

#. Log into the `https://developer.paypal.com/ <https://developer.paypal.com/>`_ with your existing credentials.

#. Navigate to **Dashboard > My Apps & Credentials** in the main menu to the left.

#. Scroll down to the **REST API apps** section and select the required application by clicking it.

#. On the page that opens, select **Live** to get the requested **Client ID** and **Client Secret** values.

   .. image:: /img/system/integrations/paypal/paypal_live_API_credentials.png

#. Use the credentials to set up the production integration between PayPal Express and OroCommerce.

.. note:: Remember NOT to select the **Sandbox Mode** check box as you are configuring the production integration.

