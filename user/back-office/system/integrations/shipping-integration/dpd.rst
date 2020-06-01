:oro_documentation_types: OroCommerce, Extension

.. _doc--integrations--dpd:

DPD Shipping Integration
========================

.. important:: This section is a part of the :ref:`Shipping Configuration <admin-guide--shipping>` topic that provides a general understanding of the shipping concept in OroCommerce.

.. hint:: The feature requires extension, so visit Oro Marketplace to download the |DPD extension| and then use the composer to :ref:`install the extension to your application <cookbook-extensions-composer>`.

Dynamic Parcel Distribution, known as DPD, is one of the world’s leading parcel service providers and operates in 230 countries.

The DPD tools integrated into your shipping solutions include:

* Parcel label printing used to easy and quickly create parcel labels
* Parcel tracking used to check the order’s shipping status
* Pickup parcel-shop finder allowing to locate a customer’s most preferred pickup spots
* Postcode rules enabling to arrange parcel shipments with the regard of territory-specific holidays and other events that may affect deliveries

DPD Integration comes out-of-the-box with your OroCommerce solution.

This section describes the steps that are necessary to expose FedEx as a shipping method in OroCommerce orders and quotes.

.. note::
   See a short demo on |how to set up a shipping integration in OroCommerce| or keep reading the step-by-step guidance below.

    .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/ileKXVTG6B8" frameborder="0" allowfullscreen></iframe>

Prepare for Integration
-----------------------

Before setting up an integration with DPD, make sure you obtain the required credentials. Please visit the |DPD developer eSolutions portal|, or contact |DPD customer support| for more information.

Configure DPD integration in OroCommerce
----------------------------------------

To set up a DPD integration in OroCommerce:

1. Navigate to the **Manage Integrations** page by clicking **System > Integrations > Manage Integrations** in the main menu.
2. Click **Create Integration** and select DPD as an integration type.

   .. image:: /user/img/system/integrations/dpd/dpd-integration.png
      :alt: DPD shipping integration form
      :align: center

3. Provide the following details:

   * **Name** – the shipping method name that is shown as an option for shipping configuration in the OroCommerce back-office.
   * **Label** – the shipping method name/label that is shown as a shipping option for the buyer in the OroCommerce storefront during the checkout.
     Click the **Translations** icon to provide spelling for different languages. Click the **Default Language** icon to return to the single-language view.

   * **Test Mode** - Enable test mode if you are using test DPD credentials, and disable it for production access.
   * **Cloud User ID** - Retrieve cloud user ID from DPD.
   * **Cloud User Token** - Retrieve cloud user ID from DPD.
   * **Shipping Services** - Select DPD Classic.
   * **Unit of Weight** - A unit of weight for the shipping price calculation - *kilogram* or *pound*.
   * **Rate Policy** - Select *Flat Rate* or *Table Rate*. For *Table Rate*, upload a .csv file. For *Flat Rate*, provide a flat rate price.
   * **Label Size** - Select the size of the shipping label - PDF A4 or A6.
   * **Label Start Position** - Select the start position of the shipping label - Upper Left or Upper Right; Lower Left or Lower Right.
   * **Default Owner** - The **Default Owner** field is filled in with the name of the user creating the integration. You can change this value to a different user if necessary

4. Click **Save and Close**.

.. hint:: OroCommerce periodically downloads zip code rules from DPD and caches them. By clicking **Invalidate Cache**, OroCommerce resets cached zip code rules.

Request DPD Shipping Label
---------------------------

Details of all :ref:`orders <user-guide--sales--orders>` submitted from the OroCommerce storefront, are synced into the OroCommerce back-office, where you can update and adjust order information when necessary, capture payments and manage order shipping. Among a variety of actions available through the order view pages, you can request DPD shipping labels, retransmit shipping label requests, and download a pdf of the shipping label.

* To obtain a shipping label for the package, click **Request DPD Shipping Label** on the order view page. In the pop-up dialog, click **Submit** to send order shipping information and pick up date to DPD.

  .. image:: /user/img/system/integrations/dpd/request-label.png
     :alt: Requesting dpd shipping label on the order view page
     :align: center

* To request a new shipping label for the same package, click **Restransmit Request for DPD shipping label**. In this case, old data is wiped and substituted.

* To download the shipping label, open the **Additional Information** tab on the order view page. You will find a .pdf attachment with the label positioned in the way you specified in the integration configuration.

* To track the order, open the **Shipping Information** tab which contains a DPD shipping tracking number. Click on the number to be redirected to the DPD website.

  .. image:: /user/img/system/integrations/dpd/tracking.png
     :alt: DPD shipping Tracking number location
     :align: center

.. include:: /include/include-links-user.rst
   :start-after: begin

