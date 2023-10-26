:oro_documentation_types: Extension

.. _gtm-ga-4-integration:

Configure Google Tag Manager Integration in the Back-Office
===========================================================

.. hint:: The **Google tag** has automatically replaced the **Google Analytics: GA4 Configuration tag** since September, 2023. GA4 event tags stay the same.

Integration between your Oro application and |Google Tag Manager| enables you to add tracking tags to your OroCommerce web store pages and collect information on customer behavior, purchases, product clicks, page views, etc. All this information can subsequently be shared with Google Analytics 4 (GA4), enabling you to monitor various user interactions with products on your website. This can help you get a complete picture of on-page visitor behavior, how well your marketing strategies work, and how to target your audience better.

.. hint:: This feature requires a |Google Tag Manager extension|, which you can download from the Oro Extensions Store. Next, use the composer to :ref:`install it on your application <cookbook-extensions-composer>`.

.. hint::
    Please, be aware that you must have |Google Tag Manager1| and |Google Analytics 4| accounts already created to proceed with the integration between your Oro application and Google Tag Manager and pass data to Google Analytics 4.

On the Google Analytics Side
----------------------------

Create a Google Analytics 4 Property
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To create a GA4 property, navigate to your Google Analytics account.

1. Click |IcConfig| **Admin** on the bottom left.
2. Click **+ Create Property** under the **Property** column.
3. Provide a name for the property, select the reporting time zone and the currency. Keep in mind that Google Analytics tracks only one currency at a time. This means that if, for example, your default currency is set to **US Dollar**, but you have a multi-currency web store (available for the Enterprise edition only), a purchase of 100EUR will be tracked in the converted dollar amount of 107USD (depending on the currency rate that day).
4. Click **Next**. Select your industry category, business size, and choose your business objectives.
5. Click **Create**.

.. image:: /user/img/system/integrations/gtm/create-GA4property.png
   :alt: Illustrating the steps to be followed to create a new GA4 property

Set up a Data Stream
^^^^^^^^^^^^^^^^^^^^

Once you created a property, the next step is to add a data collection tag to start collecting data.

1. For Web, provide the URL of your website (e.g., "mywebsite.com") and a stream name. Click **Create stream**.
2. For IOS app or Android app, add the Android package name, the app name, or the App Store ID, then click **Register app**. Follow the provided instructions to finish the configuration of data streams.

.. image:: /user/img/system/integrations/gtm/add-data-stream.png
   :alt: Illustrating the steps to be performed to add a data stream

Once a data stream is set, configure tag settings for your web pages via Google Tag Manager.

.. image:: /user/img/system/integrations/gtm/data-stream-details.png
   :alt: Illustrating the data stream details page

.. _data-stream-measurement-id:

.. hint:: Keep the Measurement ID or Google tag at hand, as you will need it when configuring tags in Google Tag Manager.

            .. image:: /user/img/system/integrations/gtm/google-tags.png
               :alt: Highlighting the data stream's measurement ID and a google tag

If you have skipped the step of setting up the data stream or want to add more streams, you can do that under your **Admin** menu. Make sure you have selected the required property under the **Property** column and click **Data Streams** to select the required platform (Web, Android app, or IOS app).

.. image:: /user/img/system/integrations/gtm/add-data-stream-admin.png
   :alt: Illustrating the steps to be performed to add a data stream


On the Google Tag Manager Side
------------------------------

Create Tags via GTM
^^^^^^^^^^^^^^^^^^^

To collect information (events) from your web store, you need to create tags in your Google Tag Manager account for each event you want to track.

There are two ways to create tags:

* :ref:`By importing our preconfigured container with the tags <import-container-to-gtm>` for all collected events. Importing pre-defined tags requires minimal effort, as each tag has already been pre-configured with triggers and variables to enable you to connect to your OroCommerce website.

Or

* :ref:`By configuring tags for all required events manually <gtm4-create-tags-manually>`. Creating tags from scratch is more time-consuming but allows you to provide custom data during configuration or create tags only for specific events.

.. _import-container-to-gtm:

Option 1: Import a Container
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

We have prepared a .json file with a container that includes pre-configured tags to simplify your tag configuration process. You need to import this file into your Google Tag Manager account and substitute the dummy Google tag in the **GA4 var** variable with the Google tag ID of your Google Analytics 4 account.

For that:

1. |Download the .json file (GA4)1| with a pre-configured container.
#. Save and extract the archive on your computer.
#. In your Google Tag Manager account, navigate to **Admin > Import Container**.

.. image:: /user/img/system/integrations/gtm/import-container.png
   :alt: Import container in GTM

#. Click **Choose container file** to import the extracted .json file. The file contains 12 tags, 11 triggers, and 12 variables.
#. Choose the workspace and |importgtm| option.
#. Click **Confirm** to start file import.

.. image:: /user/img/system/integrations/gtm/confirm-container-import.png
   :alt: Confirm container import


The container that you have imported contains a dummy Google Tag ID for the **GA4 var** variable. You need to change the ID to be able to transfer correct data to Google Analytics 4.

To change the Google Tag ID for the imported variable:

1. In your Google Tag Manager Account, click **Variables** in the menu to the left.
2. In the **User-Defined Variables** section, click **GA4 var** to open its configuration page.

.. image:: /user/img/system/integrations/gtm/edit-GA4-var-tag.png
   :alt: Edit imported variable configuration

3. Substitute the dummy number with the corresponding :ref:`Google Tag ID <data-stream-measurement-id>` of your Google Analytics data stream that follows the **G-XXXXX** pattern.
4. Click **Save** to save variable settings.
5. Click **Submit** and then **Publish** on the top right to apply the changes.

.. _ga4-ga-tag-table:

Except for the GA4 tag, the imported container also includes several pre-configured event tags. To customize the pre-defined parameters, refer to the |Google Analytics 4 Event| developer documentation for the list of the recommended event parameters.

* :ref:`add_to_cart <gtm-ga4-add-to-cart>`
* :ref:`remove_from_cart <gtm-ga4-remove-from-cart>`
* :ref:`begin_checkout <gtm-ga4-begin-checkout>`
* :ref:`add_shipping_info <gtm-ga4-add-shipping-info>`
* :ref:`add_payment_info <gtm-ga4-add-payment-info>`
* :ref:`select_item <gtm-ga4-select-item>`
* :ref:`view_item <gtm-ga4-view-item>`
* :ref:`view_item_list <gtm-ga4-view-item-list>`
* :ref:`select_promotion <gtm-ga4-select-promotion>`
* :ref:`view_promotion <gtm-ga4-view-promotion>`
* :ref:`purchase <gtm-ga4-purchase>`
* pageView


.. _gtm4-create-tags-manually:

Option 2: Create Tags Manually
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Google Tag Manager enables you to create one of the two tags that are passed to Google Analytics 4. Those are **Google Tag** as the principal configuration tag and **Google Analytics: GA4 Event**, which enables you to track custom events.

To create **Google Tag**:

1. Navigate to the left menu of the Workspace page and click **Tags > New**.
2. Click **Tag Configuration**.
3. Select **Google Tag** from the list.
4. Enter the :ref:`Google Tag ID <data-stream-measurement-id>` of your Google Analytics data stream.
5. Optionally, add the configuration parameters that update your tag's behavior, default event parameters to be used for all events measured by your Google tag, or configure advanced settings.
6. Click **Triggering** and select the necessary events that would fire the tag when they occur.
7. Save the tag configuration and publish it.

.. image:: /user/img/system/integrations/gtm/configure-google-tag.png
   :alt: The steps to be performed to configure a Google tag


To create a **Google Analytics: GA4 Event** tag for custom events:

1. Navigate to the left menu of the Workspace page and click **Tags > New**.
2. Click **Tag Configuration**.
3. Select **Google Analytics > Google Analytics: GA4 Event** from the tag list.
4. For **Measurement ID**, provide the corresponding :ref:`Google Tag ID <data-stream-measurement-id>` of your Google Analytics data stream that follows the **G-XXXXX** pattern.
5. For **Event Name**, provide the name for the event (e.g., add_to_cart). See the |Google Analytics 4 Event| developer documentation for the list of recommended event parameters.
6. Under **Event Parameters**, click **Add Row**, and provide a name and a value for the parameter. Add as many parameters as required for a particular event. See the |Google Analytics 4 Event| developer documentation for the list of recommended event parameters.
7. Optionally, add the parameters to configure the **User Properties** and **Advanced Settings** fields.
8. Click **Triggering** and select the necessary events that would fire the tag when they occur.
9. Save the tag configuration and publish it.

.. image:: /user/img/system/integrations/gtm/create-GA4-event-tag.png
   :alt: The steps to be performed to create an add_to_cart GA4 event tag manually


Google Analytics 4 requires the event names and parameters to comply with their regulations. To configure the manually-added tags correctly, provide the following parameters and triggers for each tag:

.. _gtm-ga4-add-to-cart:

add_to_cart
"""""""""""

The |add_to_cart| tag signifies that a customer user has added an item to a shopping list or submitted a request for quote.

**Tag Configuration**

* **Measurement ID** --- refers to :ref:`Google Tag ID <data-stream-measurement-id>` of your Google Analytics data stream that follows the **G-XXXXX** pattern or **{{GA4 var}}**.
* **Event Name** --- add_to_cart
* **Event Parameters**

.. csv-table::
   :header: "Parameter Name","Value"
   :widths: 20, 20

   "currency","{{ecommerce.currency}}"
   "value","{{ecommerce.value}}"
   "items","{{ecommerce.items}}"


**Triggering**

* **Trigger Type** --- Custom Event
* **Event name** --- add_to_cart
* **This trigger fires on** --- All Custom Events


.. _gtm-ga4-remove-from-cart:

remove_from_cart
""""""""""""""""

The |remove_from_cart| tag signifies that a customer user has removed an item from a shopping list.

**Tag Configuration**

* **Measurement ID** --- refers to :ref:`Google Tag ID <data-stream-measurement-id>` of your Google Analytics data stream that follows the **G-XXXXX** pattern or **{{GA4 var}}**.
* **Event Name** --- remove_from_cart
* **Event Parameters**

.. csv-table::
   :header: "Parameter Name","Value"
   :widths: 20, 20

   "currency","{{ecommerce.currency}}"
   "value","{{ecommerce.value}}"
   "items","{{ecommerce.items}}"


**Triggering**

* **Trigger Type** --- Custom Event
* **Event name** --- remove_from_cart
* **This trigger fires on** --- All Custom Events


.. _gtm-ga4-begin-checkout:

begin_checkout
""""""""""""""

The |begin_checkout| tag signifies that a customer user has started a checkout process.

**Tag Configuration**

* **Measurement ID** --- refers to :ref:`Google Tag ID <data-stream-measurement-id>` of your Google Analytics data stream that follows the **G-XXXXX** pattern or **{{GA4 var}}**.
* **Event Name** --- begin_checkout
* **Event Parameters**

.. csv-table::
   :header: "Parameter Name","Value"
   :widths: 20, 20

   "currency","{{ecommerce.currency}}"
   "value","{{ecommerce.value}}"
   "items","{{ecommerce.items}}"


**Triggering**

* **Trigger Type** --- Custom Event
* **Event name** --- begin_checkout
* **This trigger fires on** --- All Custom Events


.. _gtm-ga4-add-shipping-info:

add_shipping_info
"""""""""""""""""

The |add_shipping_info| tag signifies that a customer user has selected a shipping method at checkout.

**Tag Configuration**

* **Measurement ID** --- refers to :ref:`Google Tag ID <data-stream-measurement-id>` of your Google Analytics data stream that follows the **G-XXXXX** pattern or **{{GA4 var}}**.
* **Event Name** --- add_shipping_info
* **Event Parameters**

.. csv-table::
   :header: "Parameter Name","Value"
   :widths: 20, 20

   "currency","{{ecommerce.currency}}"
   "value","{{ecommerce.value}}"
   "items","{{ecommerce.items}}"
   "shipping_tier","{{ecommerce.shipping_tier}}"


**Triggering**

* **Trigger Type** --- Custom Event
* **Event name** --- add_shipping_info
* **This trigger fires on** --- All Custom Events


.. _gtm-ga4-add-payment-info:

add_payment_info
""""""""""""""""

The |add_payment_info| tag signifies that a customer user has selected a payment method at checkout.

**Tag Configuration**

* **Measurement ID** --- refers to :ref:`Google Tag ID <data-stream-measurement-id>` of your Google Analytics data stream that follows the **G-XXXXX** pattern or **{{GA4 var}}**.
* **Event Name** --- add_payment_info
* **Event Parameters**

.. csv-table::
   :header: "Parameter Name","Value"
   :widths: 20, 20

   "currency","{{ecommerce.currency}}"
   "value","{{ecommerce.value}}"
   "items","{{ecommerce.items}}"
   "payment_type","{{ecommerce.payment_type}}"


**Triggering**

* **Trigger Type** --- Custom Event
* **Event name** --- add_payment_info
* **This trigger fires on** --- All Custom Events


.. _gtm-ga4-select-item:

select_item
"""""""""""

The |select_item| tag signifies that a customer user has clicked a product.

**Tag Configuration**

* **Measurement ID** --- refers to :ref:`Google Tag ID <data-stream-measurement-id>` of your Google Analytics data stream that follows the **G-XXXXX** pattern or **{{GA4 var}}**.
* **Event Name** --- select_item
* **Event Parameters**

.. csv-table::
   :header: "Parameter Name","Value"
   :widths: 20, 20

   "items","{{ecommerce.items}}"
   "item_list_name","{{ecommerce.item_list_name}}"

**Triggering**

* **Trigger Type** --- Custom Event
* **Event name** --- select_item
* **This trigger fires on** --- All Custom Events


.. _gtm-ga4-view-item:

view_item
"""""""""

The |view_item| tag signifies that a customer user has reviewed a product details page.

**Tag Configuration**

* **Measurement ID** --- refers to :ref:`Google Tag ID <data-stream-measurement-id>` of your Google Analytics data stream that follows the **G-XXXXX** pattern or **{{GA4 var}}**.
* **Event Name** --- view_item
* **Event Parameters**

.. csv-table::
   :header: "Parameter Name","Value"
   :widths: 20, 20

   "currency","{{ecommerce.currency}}"
   "value","{{ecommerce.value}}"
   "items","{{ecommerce.items}}"


**Triggering**

* **Trigger Type** --- Custom Event
* **Event name** --- view_item
* **This trigger fires on** --- All Custom Events


.. _gtm-ga4-view-item-list:

view_item_list
""""""""""""""

The |view_item_list| tag signifies that a customer user has looked over a list of products in a product block (top selling, featured, new arrivals, related, upsell, similar).

**Tag Configuration**

* **Measurement ID** --- refers to :ref:`Google Tag ID <data-stream-measurement-id>` of your Google Analytics data stream that follows the **G-XXXXX** pattern or **{{GA4 var}}**.
* **Event Name** --- view_item_list
* **Event Parameters**

.. csv-table::
   :header: "Parameter Name","Value"
   :widths: 20, 20

   "currency","{{ecommerce.currency}}"
   "items","{{ecommerce.items}}"


**Triggering**

* **Trigger Type** --- Custom Event
* **Event name** --- view_item_list
* **This trigger fires on** --- All Custom Events


.. _gtm-ga4-select-promotion:

select_promotion
""""""""""""""""

The |select_promotion| tag signifies that a customer user has clicked a slider from the homepage slider :ref:`content block <user-guide--landing-pages--marketing--content-blocks>` on your main website page.

**Tag Configuration**

* **Measurement ID** --- refers to :ref:`Google Tag ID <data-stream-measurement-id>` of your Google Analytics data stream that follows the **G-XXXXX** pattern or **{{GA4 var}}**.
* **Event Name** --- select_promotion
* **Event Parameters**

.. csv-table::
   :header: "Parameter Name","Value"
   :widths: 20, 20

   "items","{{ecommerce.items}}"


**Triggering**

* **Trigger Type** --- Custom Event
* **Event name** --- select_promotion
* **This trigger fires on** --- All Custom Events


.. _gtm-ga4-view-promotion:

view_promotion
""""""""""""""

The |view_promotion| tag signifies that a customer user has reviewed a slider from the homepage slider block.

**Tag Configuration**

* **Measurement ID** --- refers to :ref:`Google Tag ID <data-stream-measurement-id>` of your Google Analytics data stream that follows the **G-XXXXX** pattern or **{{GA4 var}}**.
* **Event Name** --- view_promotion
* **Event Parameters**

.. csv-table::
   :header: "Parameter Name","Value"
   :widths: 20, 20

   "items","{{ecommerce.items}}"


**Triggering**

* **Trigger Type** --- Custom Event
* **Event name** --- view_promotion
* **This trigger fires on** --- Some Custom Events. For this trigger, add the following condition: *ecommerce.items > does not equal > undefined*.

.. _gtm-ga4-purchase:

purchase
""""""""

The |purchaseGA4| tag signifies that a customer user has submitted an order.

**Tag Configuration**

* **Measurement ID** --- refers to :ref:`Google Tag ID <data-stream-measurement-id>` of your Google Analytics data stream that follows the **G-XXXXX** pattern or **{{GA4 var}}**.
* **Event Name** --- purchase
* **Event Parameters**

.. csv-table::
   :header: "Parameter Name","Value"
   :widths: 20, 20

   "currency","{{ecommerce.currency}}"
   "value","{{ecommerce.value}}"
   "items","{{ecommerce.items}}"
   "transaction_id","{{ecommerce.transaction_id}}"
   "affiliation","{{ecommerce.affiliation}}"
   "coupon","{{ecommerce.coupon}}"
   "shipping","{{ecommerce.shipping}}"
   "tax","{{ecommerce.tax}}"
   "shipping_tier","{{ecommerce.shipping_tier}}"
   "payment_type","{{ecommerce.payment_type}}"


**Triggering**

* **Trigger Type** --- Custom Event
* **Event name** --- purchase
* **This trigger fires on** --- All Custom Events




On the Oro Side
---------------

Configure a Google Tag Manager Integration in the Back-Office
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To configure a Google Tag Manager integration:

1. Navigate to **System > Integrations > Manage Integrations** in the main menu.
2. Click **Create Integration** on the top right.
3. In the **Type** field, select **Google Tag Manager**.
4. In the **Name** field, provide the name for the integration you are creating to refer to it in the Oro application. Since you can create many Google Tag Manager integrations, make sure the name is meaningful.
5. In the **Container ID** field, provide the |Google Tag Manager Container ID|. The Container ID is located in your Google Tag Manager account on the top right of the workspace page. It is formatted as *GTM-XXXXXX*.
6. In the **Status** field, set the integration to *Active* to enable it. Should you need to disable it, select *Inactive* from the list.
7. In the **Default Owner**, select the owner of the integration.
8. Click **Save and Close**.

.. image:: /user/img/system/integrations/gtm/gtm-configuration.png
   :alt: Google tag manager integration creation form

**Next Steps**

Once the GTM integration is configured, you must connect it to the application in the system settings on the required level:

* :ref:`Enable the Google Tag Manager integration globally <system-configuration-integrations-google>`
* :ref:`Enable the Google Tag Manager integration per organization <organization-google-settings>`
* :ref:`Enable the Google Tag Manager integration per website <website-google-settings>`
* |Implement Cross-Domain Measurement|



.. admonition:: Business Tip

   Do you want to reap the benefits of the new digital commerce trend? Learn more about the |B2B online marketplace| and how it can help you expand into a new market.


.. include:: /include/include-links-seo.rst
   :start-after: begin


.. include:: /include/include-links-user.rst
   :start-after: begin

.. include:: /include/include-images.rst
   :start-after: begin
