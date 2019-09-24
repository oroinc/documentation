:oro_documentation_types: commerce

.. _user-guide--payment--prerequisites--paypal:

Prerequisites for PayPal Services Integration
=============================================

.. begin

Before adding a PayPal Payflow Gateway as a payment method in OroCommerce, create a PayPal Payflow Gateway Manager Account and create a dedicated API transaction user for every instance of OroCommerce. You might need a separate instance for a sandbox, test, staging/pre-production, and production environment.

Register a Business Account with PayPal
---------------------------------------

To register a business account and enable express checkout for your OroCommerce PayPal integration, follow the next steps:

#. Open |https://developer.paypal.com/| and click **Log In**.
#. On the login page that opens, click **Sign Up**.
#. On the following page, select **Business Account** and click **Continue**.
#. Select the service plan (Payment Pro, Payments Standard, or Express Checkout).

   The Get Started page opens.

   .. image:: /user/img/system/integrations/paypal/paypal_business_account_1.png

#. Type in your email.

   The Sign up for a Business account page opens.

   .. image:: /user/img/system/integrations/paypal/paypal_business_account_2.png

#. Enter the password and password confirmation.
#. Provide your business contact information.
#. Read the *PayPal User Agreement*.
#. Click **Agree and Continue**.

   On the following page, select your type of business and provide the requested additional information.

   .. image:: /user/img/system/integrations/paypal/paypal_business_account_3.png

#. Provide the requested personal information.

   .. image:: /user/img/system/integrations/paypal/paypal_business_account_4.png

#. Click **Submit**.

   The PayPal Business Account opens.

#. In *Account Setup*, confirm your email, link your bank account, and configure the credit card statement.

Register a PayPal Payflow Gateway Account
-----------------------------------------

To create a PayPal Payflow Gateway Account:

#. Open |https://registration.paypal.com/| and click Continue.

#. Select your payment processor from the list.

#. Fill in the required fields in the Account Information section, confirm you have read the *PayPal Gateway Agreement* in the *Term and Conditions* section, and click **Continue**.

#. Follow the on-screen guidance to prepare for integration: log into the Payflow Manager and create one or more API Transaction User(s).

   .. image:: /user/img/system/integrations/paypal/paypal_sandbox_test_account.png

#. To test the Express Checkout and Bill Me Later payment methods, click Set up PayPal Developer Sandbox link and enter PayPal Sandbox Email address.

   .. note:: If you do not have a PayPal Sandbox account yet, register at |http://developer.paypal.com|.

   .. image:: /user/img/system/integrations/paypal/paypal_register_dev_account.png

#. Now you have *Payflow Gateway Account* and you can use PayPal Payments Pro and Payflow Gateway in your applications.

Configure a PayPal Manager/Merchant Account to Accept Payments
--------------------------------------------------------------

To accept payments in OroCommerce, you need to configure your PayPal Manager Account using the following steps:

* Enable secure token and silent post.
* Enable reference transactions.
* Disable fraud protection for test environments.
* Enable fraud protection for production environments.

Enable Secure Token and Silent Post
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

OroCommerce requires enabling secure token and silent post features.

To enable these features:

#. Log into the |https://manager.paypal.com/|:

   a) Enter the partner name (e.g. PayPal) and PayPal Payflow Gateway account login and password.

   #) Click **Log In**. For the first log on, PayPal prompts you to type in answers for security question. Remember it for further authentication during the following logins.

   .. image:: /user/img/system/integrations/paypal/paypal_manager_login.png

#. Navigate to the **Service Settings** and click the **Set Up** link in the *Hosted Checkout Pages* group.

#. In the *Security Options* section, set **Enable Secure Token** to **Yes**.

#. In the *Silent Post for Data Transfer* section, set **Use Silent Post** to **Yes** and enable the **Void transaction when my server fails to receive data sent by the silent post**.

Enable Reference Transactions
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

OroCommerce depends on the reference transactions. To ensure they are enabled:

#. Log into the |https://manager.paypal.com/| as described in the previous section.

#. Navigate to the **Account Administration > Manage Security > Transaction Settings** in the menu.

#. Set **Allow reference transactions** to **Yes**.

#. Click **Confirm** (twice).

.. note:: There might be a significant delay before this change comes into effect (up to several hours). During this time your reference transactions could be rejected by PayPal.

Disable Fraud Protection for Test Environments
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Disable Fraud Protection for the Test Setup to avoid your test transaction being blocked. Test transactions may look suspicions due to unusual behavior and eventual failures because of the invalid data:

#. Log into the |https://manager.paypal.com/| as described in the `Enable Secure Token and Silent Post`_ section.

#. Navigate to the **Service Settings > Fraud Protection > Edit Standard Filters** in the menu.

#. Unselect all the filters and click **Deploy**.

.. note:: There might be a significant delay before this change comes into effect (up to several hours). During this time your transactions may be caught by the fraud filter which will lead to the payment failure.

Enable Fraud Protection for Production Environments
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Enable Fraud Protection for any customer-facing environments where real purchases might happen:

#. Log into the |https://manager.paypal.com/| as described in the `Enable Secure Token and Silent Post`_ section.

#. Navigate to the **Service Settings > Fraud Protection > Edit Standard Filters** in the menu.

#. Select all the filters and click **Deploy**.

.. note:: There might be a significant delay before this change comes into effect (up to several hours). During this time the fraud filter is disabled and any transactions may impose a security risk due to the reduced protection. Limit access to the storefront and disable related payment methods until you confirm that the fraud filters are on and catch the suspicious and illegal transactions.

Configure the PayPal Manager/Merchant Account to Work with Express Checkout
---------------------------------------------------------------------------

Using Express Checkout requires the following configuration in the Manager Account.

#. Log into the |https://manager.paypal.com/| as described in the `Enable Secure Token and Silent Post`_ section.

#. Navigate to the **Service Settings > Hosted Checkout Pages > Set Up**.

   .. image:: /user/img/system/integrations/paypal/paypal_express_checkout_configuration1.png

#. In the **PayPal Express Checkout** section, set **Enable PayPal Express Checkout** and **Enable PayPal Credit** to **Yes**, enter PayPal email address for production deployments and PayPal sandbox email address for sandbox and test deployments. Use the business account email (as in Register a Business Account with PayPal).

#. Save changes.

Now you can configure Express Checkout as a payment option in OroCommerce.

Create an API Transaction User
------------------------------

To create an API Transaction User:

#. Log into the |https://manager.paypal.com/| as described in the `Enable Secure Token and Silent Post`_ section.

#. Navigate to the account administration and click on the **Add User** link.

.. image:: /user/img/system/integrations/paypal/paypal_manager_add_user.png

#. Enter the administrator password to authorize user creation.

#. Provide user personal information (contact name, phone, and email).

#. Enter user login information (user login name and password).

#. Select the user role.

#. Set status to **Active**.

#. Click **Update**.

The basic user login information is securely delivered to the provided email.

.. include:: /include/include-links.rst
   :start-after: begin

