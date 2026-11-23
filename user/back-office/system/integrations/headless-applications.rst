:title: Headless Applications in the OroCommerce Back-Office

.. meta::
   :description: Learn how to register a headless storefront or another external application in the OroCommerce back-office and give it access to the OroCommerce API

.. _back-office--integrations--headless-applications:

Configure Headless Applications in the Back-Office
==================================================

.. important:: Headless applications are available in the Enterprise edition only.

Customers can buy from your business through two kinds of storefronts:

* **Built-in OroCommerce storefront**, which is part of the application and is customized with :ref:`themes <dev-doc-frontend-storefront>`. OroCommerce creates the pages of this storefront itself. As a result, the design and behavior of the pages depend on the OroCommerce themes and layouts.
* **Headless storefront**, which is a separate application that connects to OroCommerce through the API. For dev documentation, see :ref:`OroHeadlessApplicationBundle <bundle-docs-platform-headless-application-bundle>` and :ref:`OroHeadlessStorefrontBundle <bundle-docs-commerce-headless-storefront-bundle>`.

.. image:: /user/img/system/integrations/headless-applications/2-storefronts.png
   :alt: Visualization of the two storefronts, native OroCommerce and a headless storefront


Headless Storefront
-------------------

A headless storefront is a separate storefront that your developers build and run outside OroCommerce. The headless storefront has its own design and its own pages. It takes the commerce data, such as products, prices, shopping lists, and orders from OroCommerce through the API. It also sends new data, such as orders, back to OroCommerce through the API. The term *headless* means that the pages that customers see (the "head") are separated from OroCommerce. OroCommerce manages the data and the business logic in the background.

A headless storefront can be one of the following:

* **OroCommerce Nuxt Storefront** --- A sample headless storefront that Oro provides. It is built with Nuxt, an open-source web framework. Your developers can use it as is or as a starting point for your own storefront.
* **Client's own headless storefront** --- A storefront that your developers build for your business, for example, by customizing OroCommerce Nuxt Storefront or by building a new application.

.. _back-office--integrations--headless-applications--create:

Create a Headless Application
-----------------------------

To connect a headless storefront to OroCommerce, including OroCommerce Nuxt Storefront, create a headless application for it. The headless application gives the storefront its credentials and the settings that it needs, such as its website, URLs, and guest options.

To create a headless application:

1. Make sure your role has the permissions for the **Headless Application** entity. For more information, see :ref:`roles and permissions <user-guide-user-management-permissions-roles--acl>`.

2. Navigate to **System > Integrations > Headless Applications** in the main menu.

3. Click **Create Headless Application**.

      .. image:: /user/img/system/integrations/headless-applications/create-headless-applications.png
         :alt: The Create Headless Application page with no type selected

4. In the **General** section, provide the following information:

* **Name** --- Enter the name of the application. The name must be unique within the organization. OroCommerce also uses this name for the OAuth2 client and the contact request form of the application. If you rename the application later, OroCommerce renames them as well.

* **Type** --- Select the type of the application. OroCommerce provides the **General Storefront** type by default. This type connects a headless storefront to OroCommerce. When you select a type, the page shows the sections and fields of this type. You cannot change the type after you save the application.

* **Website** --- Select the OroCommerce website that the application belongs to. The list shows only the websites that you have permission to view. The website affects the application in the following ways:

     * OroCommerce accepts the storefront API requests and the storefront page requests of the application only on this website. It denies such requests on other websites. If you do not select a website, the application can work with all websites.
     * The settings in the **System Configuration** section change the configuration of the selected website. If you do not select a website, they change the system configuration of the organization where the headless application is created. When you select another website, the **System Configuration** section shows the values of that website.

.. image:: /user/img/system/integrations/headless-applications/nuxt-type-headless-application.png
   :alt: The Create Headless Application page with the General Storefront type selected

5. In the **OAuth2 Client** section, provide the following information:

* **Support All APIs** --- Allows the application to use all available APIs. The checkbox is selected by default. If you clear the checkbox, the **Supported APIs** field appears. Select the APIs that the application can use. For a **General Storefront** application, the list contains the storefront APIs. For more information, see the **Supported APIs** field in :ref:`Manage Customer User OAuth Applications in the Back-Office <customer-user-oauth-app>`.

* **Session Transfer Allowed** --- Allows customer users to move from the headless storefront to OroCommerce pages without signing in again. Select this checkbox if the headless storefront opens the OroCommerce checkout. When the checkout page is opened through Session Transfer, OroCommerce provides a simplified checkout page header. It shows the logo from the **Application Logo** section, the **Back to shopping** link, and the **Secure Checkout** label. The regular OroCommerce checkout does not change.

   .. image:: /user/img/system/integrations/headless-applications/headless_application_checkout.png
      :alt: The OroCommerce checkout opened from a headless storefront

* **Skip User Consent** --- Skips the consent screen that customer users see when they sign in to the application. Use this option only for applications that your company owns (first-party applications).

* **Redirect URLs** --- Click **Add URL** and enter the URL to which OroCommerce returns customer users after they sign in. At least one URL is required. A URL cannot contain commas. To add more URLs, click **Add URL** again.

* **Enable Logout** --- Allows the application to sign customer users out and redirect them to one of the post-logout URLs. When you select this checkbox, the **Post-Logout URLs** field appears.

* **Post-Logout URLs** --- Click **Add URL** and enter the URL to which OroCommerce returns customer users after they sign out. At least one URL is required when the **Enable Logout** checkbox is selected.

OroCommerce creates an OAuth2 client with these settings for the application. The OAuth2 client also appears on the :ref:`Customer User OAuth Applications <customer-user-oauth-app>` page with a message that the headless application manages it. You cannot edit or delete the OAuth2 client on that page. To change the client, edit the headless application.

   .. image:: /user/img/system/integrations/headless-applications/customer-user-oauth-nuxt-app.png
      :alt: The message on the Customer User OAuth Applications page that says the OAuth2 client is managed by the headless application

6. In the **Application URLs** section, provide the following information:

* **Application URL** --- Enter the URL where the headless storefront is available. This field is required. If you enable the contact request form, the form accepts requests only from the domain of this URL. If the **Checkout Return URL** field is empty, the checkout uses this URL instead.

* **Checkout Return URL** --- Enter the URL to which the checkout sends the buyer back to the headless storefront. The **Back to shopping** link and the logo on the checkout pages open this URL. If you leave the field empty, the checkout uses the application URL.

* **Order View URL** --- Enter the URL of the order details page in the headless storefront. The checkout success page links to this URL. Use the ``{id}`` placeholder for the order ID, for example, ``https://storefront.example.com/orders/{id}``. The success page shows the link only to customer users who have permission to view the order. If you leave the field empty, the success page does not show the order link.

7. In the **Application Logo** section, upload the logos that the OroCommerce checkout shows to buyers who come from the headless storefront:

* **Logo** --- Upload the logo for the checkout pages. You can upload a GIF, JPEG, PNG, WebP, or SVG image of up to 1 MB. If you do not upload a logo, the checkout pages show the default logo.

* **Small Logo** --- Upload the logo for the checkout pages on screens up to 767 px wide. You can upload a GIF, JPEG, PNG, WebP, or SVG image of up to 1 MB. If you do not upload a small logo, the checkout pages show the default small logo on such screens, even if you upload a logo in the **Logo** field.

8. In the **System Configuration** section, select the guest options for the headless storefront.

These options change the system configuration of the website selected in the **Website** field. If no website is selected, they change the system configuration of the organization. The message above the options shows the website or the organization whose configuration changes. The same options are available in the system configuration, so a change here also applies to the OroCommerce storefront of the same website or organization.

   .. image:: /user/img/system/integrations/headless-applications/system-config-options.png
      :alt: The OroCommerce checkout opened from a headless storefront

* **Enable Guest Storefront API** --- Gives non-authenticated visitors access to some storefront API resources. For more information, see :ref:`Configure Global Application Settings <admin-configuration-application>`.

* **Enable Guest Shopping List** --- Allows guests to create and manage a shopping list. For more information, see :ref:`Configure Global Shopping List Settings <user-guide--system-configuration--commerce-sales-shopping-list-global>`.

* **Enable Guest Checkout** --- Allows guests to complete the checkout without registration. For more information, see :ref:`Configure Global Checkout Settings <user-guide--system-configuration--commerce-sales-checkout-global>`.

9. In the **Contact Request Form** section, select the **Enable Contact Request Form** checkbox if the headless storefront must collect contact requests:

* **Enable Contact Request Form** --- Creates a contact request form for the headless storefront. OroCommerce creates the form as an :ref:`embedded form <admin-embedded-forms>` that accepts requests only from the domain of the application URL. After you save the application, its page shows the **Contact Request Form** link and the **Contact Request Form ID** with a copy icon. Pass this ID to the developers of the headless storefront. The requests that visitors send through the form appear on the :ref:`contact requests <user-guide-activities-requests>` page.

The form appears on the :ref:`Embedded Forms <admin-embedded-forms>` page. You cannot delete the form there or change its title, form type, and allowed domains. If you clear the **Enable Contact Request Form** checkbox, OroCommerce deletes the form.

10. Click **Save and Close**.

The page of the new application opens. The **Credentials** section at the top of the page shows the **Client ID** and the **Client Secret**.

11. Copy the Client ID and the Client Secret with the copy icons next to them, and pass the credentials to the developers of the headless storefront.

.. warning:: OroCommerce shows the Client Secret only once, right after you create the application. For security reasons, you cannot view the Client Secret again. Save it in a secure place. If you lose the Client Secret, delete the application and create a new one. Then pass the new credentials to the developers.

.. image:: /user/img/system/integrations/headless-applications/new-headless-app-created.png
   :alt: The Credentials section with the Client ID and the Client Secret of a new headless application

.. _back-office--integrations--headless-applications--manage:

Manage Headless Applications
----------------------------

The **Headless Applications** page lists all headless applications of the organization. You can filter and sort the applications by name and type.

To view an application, click its row in the grid. To edit an application, click **Edit** on its page or use the action menu of its row. You can change all fields except **Type**. For the description of each field, see `Create a Headless Application`_.

To delete an application, open its page and click **Delete**.

.. caution:: Deleting a headless application also deletes its OAuth2 client and its contact request form. As a result, the headless storefront can no longer access OroCommerce, and its contact request form stops accepting requests.

Related Topics
--------------

* :ref:`OroHeadlessApplicationBundle <bundle-docs-platform-headless-application-bundle>`
* :ref:`OroHeadlessStorefrontBundle <bundle-docs-commerce-headless-storefront-bundle>`
* :ref:`Manage Customer User OAuth Applications in the Back-Office <customer-user-oauth-app>`
* :ref:`Configure Embedded Forms in the Back-Office <admin-embedded-forms>`
* :ref:`Manage Contact Requests in the Back-Office <user-guide-activities-requests>`
