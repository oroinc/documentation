.. _user-guide--consents--cookie-banner:

Add a Cookie Banner to the Website
==================================

.. contents:: :local:
   :depth: 1

Cookies can be used to uniquely identify a person, which means that they represent personal data. In compliance with the General Data Protection Regulations (GDPR), it is required to let website visitors and customers know what types of cookies will be used, and allow them to choose which ones they want to agree to. Implied consents and consents given simply by visiting a website are not enough.

To comply with the GDPR policy, OroCommerce enables you to set up a **Cookie Banner** with your custom text to be displayed in the storefront of the OroCommerce website, and translate it into your preferred language.

Add a Cookie Banner
--------------------

To set up a cookie banner:

1. Download the OroCommerceCookieBannerBundle archived file.
2. Unpack the downloaded file to **{application_name}/src/Oro/Bundle**.
3. Run the following commands:

   **For dev mode**

   .. code-block:: php
      :linenos:

      rm -rf app/cache/*
      php composer.phar install --prefer-dist --no-dev
      php app/console oro:platform:update --env=prod --force
      php app/console oro:message-queue:consume --env=dev

   **For prod mode**

   .. code-block:: php
      :linenos:

      rm -rf app/cache/*
      php composer.phar install --prefer-dist --no-dev
      php app/console oro:platform:update --env=prod --force
      php app/console oro:message-queue:consume --env=prod

4. Reload the application in the browser.

Add a Translation
-----------------

To add a translation to the cookie banner to present information in the desired language:

1. Run the following command:

   .. code-block:: php
      :linenos:

      php app/console oro:translation:load --env=prod

#. In the back-office, navigate to **System > Localization > Translations**.
#. Using filters, locate following translation keys:

   * *oro_cookie_banner.text*
   * *oro_cookie_banner.button_label*

#. Add translation for the banner text and label.
#. Click **Update Cache** on the top right.
#. Once cache is updated, the translated banner will be displayed in the storefront.

**Related Topics**

* :ref:`Data Protection in the OroCommerce Storefront <frontstore-guide--profile-consents>`
* :ref:`Configure Consents <configuration--guide--commerce--configuration--consents>`
* :ref:`Declined Consents as Contact Requests <user-guide-activities-requests>`
* :ref:`Create Consents <user-guide--consents--create>`
* :ref:`View and Accept Consents in the Storefront <frontstore-guide--profile-consents>`
* :ref:`Revoke Consents <user-guide-activities-requests>`
* :ref:`Build Reports with Accepted Consents <user-guide-reports>`
