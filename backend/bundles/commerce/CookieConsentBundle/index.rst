.. _bundle-docs-commerce-cookie-consent-bundle:

CookieConsentBannerBundle
=========================

Cookies can be used to uniquely identify a person, which means that they represent personal data.
In compliance with the General Data Protection Regulations (GDPR), it is required to let website visitors
and customers know what types of cookies will be used, and allow them to choose which ones they want to agree to.
Implied consents and consents given simply by visiting a website are not enough.

To comply with the GDPR policy, OroCommerce enables you to set up a **Cookie Banner** with your custom text to be
displayed in the storefront of the OroCommerce website, and translate it into your preferred language.

Add a Cookie Banner
--------------------

To set up a cookie banner:

1. Add new a package as a dependency in the composer.json file:

.. code-block:: none

      "require": {
        "oro/cookie-consent": "4.2.*"
      }

2. Run the following commands:

   **For dev mode**

   .. code-block:: php
      :linenos:

      rm -rf var/cache/*
      php composer.phar install --prefer-dist --no-dev
      php bin/console oro:platform:update --env=prod --force
      php bin/console oro:message-queue:consume --env=dev

   **For prod mode**

   .. code-block:: php
      :linenos:

      rm -rf var/cache/*
      php composer.phar install --prefer-dist --no-dev
      php bin/console oro:platform:update --env=prod --force
      php bin/console oro:message-queue:consume --env=prod

4. Reload the application in the browser.

Add a Translation
-----------------

To add a translation to the cookie banner to present information in the desired language:

1. Run the following command:

   .. code-block:: php
      :linenos:

      php bin/console oro:translation:load --env=prod

#. In the back-office, navigate to **System > Localization > Translations**.
#. Using filters, locate following translation keys:

   * *oro_cookie_banner.text*
   * *oro_cookie_banner.button_label*

#. Add translation for the banner text and label.
#. Click **Update Cache** on the top right.
#. Once cache is updated, the translated banner will be displayed in the storefront.

**Related Topics**

* :ref:`Cookie Consent Banner <frontstore-guide--cookie-banner>`
* :ref:`Configure Consent Banner <configuration--guide--commerce--configuration--cookie-consents>`

.. include:: /include/include-links-dev.rst
   :start-after: begin
