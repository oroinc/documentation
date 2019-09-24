:oro_documentation_types: commerce

.. _doc--integrations--fedex:

FedEx Shipping Integration
--------------------------

.. important:: This section is a part of the :ref:`Shipping Configuration <admin-guide--shipping>` topic that provides the general understanding of the payment concept in OroCommerce.

FedEx is the largest multinational delivery service company that provides a variety of shipping methods solutions, both ground and airfreight, day and overnight, to meet the customers' requirements.

This section describes the steps that are necessary to expose FedEx as a shipping method in OroCommerce orders and quotes.

.. note::
   See a short demo on |how to create a shipping integration in OroCommerce| or keep reading the step-by-step guidance below.

    .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/ileKXVTG6B8" frameborder="0" allowfullscreen></iframe>

Prerequisites for Integration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Before adding FedEx as a shipping method in OroCommerce, you need to create a FedEx business account and obtain a dedicated shipping account number and a meter number via the official FedEx website.

Create a FedEx Business Account
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To register a business account and enable a checkout shipping integration with OroCommerce, follow the next steps:

1. Navigate to the |FedEx login| page.

2. Click **Sign In** and then **Create Account**.

   .. image:: /user/img/system/integrations/FedEx/fedex_login_page.png

3. Click **Business account benefits** to check out the rewarded benefits for your business and proceed to a business account creation.

   .. image:: /user/img/system/integrations/FedEx/fedex_business_account.png

4. Click **Open a business account** to complete the registration in several steps.

5. Fill in the registration form with your personal contact information and a credit card number. Agree to the terms and conditions and check the benefits you can get at the final step.

   .. image:: /user/img/system/integrations/FedEx/fedex_account_registration.png


Obtain a Set of Testing Credentials
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Once the registration is complete, you can now obtain the necessary test keys to set up the integration between FedEx and OroCommerce and make sure the integration is working properly.

1. Navigate to the |FedEx Web Services| page.

2. Complete the four steps required by FedEx to test the integration:

   * Read the documentation.
   * Request the testing credentials and test the integration.
   * Certify the OroCommerce application with FedEx.
   * Receive new production credentials to replace your current test ones and move to production.

    .. image:: /user/img/system/integrations/FedEx/fedex_4_steps.png

3. Click **Move to development** and then **Get your test key**.

4. Confirm your contact information and accept the FedEx license to complete the registration process.

5. Receive an email with the corresponding test credentials:

   * Key
   * Password
   * Account ID
   * Meter Number

Configure a FedEx Integration in OroCommerce
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To enable the integration with FedEx in order to request the shipping cost estimation and/or request the shipping services:

1. Navigate **System > Integrations > Manage Integrations** in the main menu.

2. Click **Create Integration**.

3. On the **Create Integration** page, select *FedEx* for **Type**.

   .. image:: /user/img/system/integrations/FedEx/fedex_create_integration.png

4. Type in the *Common Integration Details*:

   * **Name** – the shipping method name that is shown as an option for shipping configuration in the OroCommerce back-office.
   * **Label** – the shipping method name/label that is shown as a shipping option for the buyer in the OroCommerce storefront during the checkout.

Click the |IcTranslations| **Translations** icon to provide spelling for different languages. Click the |IcTranslationsC| **Default Language** icon to return to the single-language view.

5. Set the **Test Mode** check box into the necessary state. Enable it if you are using the test FedEx access key and disable for the production access.

   .. note:: For security reasons, it is critically important to use the mode that matches your environment and the FedEx access key type.

   .. warning::

      Never use the FedEx access key that is dedicated for the production environment in your sandbox/test OroCommerce environment.

      Never enable **Test Mode** for the FedEx integration on your production instance of OroCommerce.

6. Provide the connection credentials which you have received from FedEx:

   * User Credential Key - is the authentication key provided by FedEx and used for accessing your FedEx account.
   * User Credential Password - is the production password provided by FedEx.
   * Shipping Account Number - is the account ID provided by FedEx.
   * Meter Number - is the meter number provided by FedEx.

7. Select the available pickup type that applies to the deliveries for the shipping methods via this integration:

   * Regular Pickup - enables you to schedule a regular delivery pickup if you deal with a large volume of shipments.
   * Request Courier - with this type selected, you can request a FedEx courier to come and pick up the shipments.
   * Drop Box - requires you to deliver the shipments to your closest FedEx drop box.
   * Business Service Center - requires you to deliver the shipments to your local FedEx business service center.
   * Station - requires you to deliver the shipments to your local FedEx station.

8. Select a unit of weight to use for the shipping price calculation: a pound or kilogram.

   .. note:: The unit of weight should match the options supported by your FedEx account.

9. Select the FedEx shipping services that are supported in the OroCommerce shipping options. Hold the CTRL key to select/deselect multiple options.

10. Click **Check FedEx Connection** to ensure FedEx API is accessible.

11. Set the status to **Active** to enable the integration.

12. The **Default Owner** field is prepopulated with the user creating the integration. You can change this value to another user if necessary.

13. Click **Save and Close**.


Next, set up a shipping rule via the :ref:`Shipping Rules Configuration <sys--shipping-rules>` page to enable this shipping method for all or some customer orders.

Once the shipping method is added to the shipping rule, provide the information that configures the shipping fee components and the method to calculate it following the :ref:`Configure a Shipping Method in a Shipping Rule <doc--shipping-rules--shipping-methods--detailed>` topic.


Obtain a Set of Production Credentials
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Once you have successfully configured the OroCommerce FedEx integration, and the connection to the test environment is working properly, you can move to a production stage and request a new set of credentials.

1. Navigate to the |FedEx Web Services| page.

2. Click the **Move to production** link and then **Get Production Key** to load another registration form page.

3. Complete the form and accept the agreement to continue.

   .. image:: /user/img/system/integrations/FedEx/fedex_production_key.png

4. Receive an email with the corresponding production keys from FedEx.

5. Follow the steps described in the aforementioned Configure a FedEx Integration in OroCommerce section to set up the production integration between FedEx and OroCommerce.

   .. important:: Make sure that the **Test Mode** check box is NOT selected as you are configuring the production integration.

.. stop_fedex_integration


**Related Topics**

* :ref:`Shipping Configuration Concept Guide <admin-guide--shipping>`
* :ref:`System Shipping Configuration <configuration--guide--commerce--configuration--shipping>`
* :ref:`Shipping Rules Configuration <sys--shipping-rules>`



.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-links.rst
   :start-after: begin