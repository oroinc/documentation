:title: Marketing Tools in the OroCommerce Back-Office

.. meta::
   :description: Marketing campaigns, promotions, and web catalog management guides for the Oro application back-office users

.. _user-guide-marketing:
.. _user-guide-marketing-automation:

Manage Marketing Activities in the Back-Office
==============================================

In Oro applications, you can manage, perform, and track the results of your marketing activities, like email campaigns and website activities tracking.

You can integrate with the external services (Mailchimp and Dotdigital) and synchronize marketing campaign configuration and results between these services and Oro application.

In Oro application and external systems, you can launch marketing campaigns distributed via email to the custom group of contacts. The custom group is generated as :ref:`marketing list <user-guide-marketing-lists>`.

Once the marketing efforts get their results, you can monitor the collected marketing information in the context of the customers, leads, and many more perspectives

.. note:: Enable or disable marketing automation in Oro application via the :ref:`system configuration <marketing-system-configuration>`.

Via Oro Application
-------------------

In Oro application, you can use the following marketing tools:

* **Marketing Lists** --- Group email data into a target :ref:`marketing list <user-guide-marketing-lists>`. It may be automatically generated using flexible filters and may contain any record with an email information, like leads or customer users.
* **Marketing Campaign** --- Track statistics of the marketing efforts related to the same :ref:`marketing campaign <user-guide-marketing-campaigns>`.
* **Email Campaigns** --- Schedule or send an email campaign that uses a marketing list as a target audience and may optionally be related to the existing marketing campaign and monitor the results.
* **Website Tracking** --- Generate a javascript :ref:`tracking code <user-guide-marketing-tracking>` that may be embedded in your or third-party websites to track users activity that brings valuable insight into your customer needs and your marketing efforts.

.. note:: Configure tracking settings in Oro application via the :ref:`system configuration <admin-configuration-tracking>`.

Via Dotdigital
--------------

.. include:: /user/back-office/system/integrations/dotdigital/index.rst
   :start-after: begin_include
   :end-before: finish_include

Via Mailchimp
-------------

Oro application supports out of the box integration with Mailchimp, allowing you to do the following:

* Map the :ref:`Marketing Lists <user-guide-marketing-lists>` as segments in Mailchimp and keep them synchronized.
* Use existing segments in Mailchimp and import them to Oro application.
* Schedule importing statistics of the Mailchimp campaigns into Oro Application.

To use Mailchimp with Oro application, ensure that all the necessary integration steps are complete. See :ref:`Mailchimp Integration <user-guide-mc-integration>` for more information.

After the integration is configured, you can :ref:`Send Email Campaign via Mailchimp <user-guide-mailchimp-campaign>`.

.. automation_finish

.. include:: /include/include-links-user.rst
   :start-after: begin

.. toctree::
   :maxdepth: 2
   :hidden:

   Marketing Lists <marketing-lists/index>
   Email Campaigns <email-campaigns/index>
   Marketing Campaigns <marketing-campaigns/index>
   Promotions <promotions/index>
   Tracking Websites <tracking-websites/index>
   Web Catalogs <web-catalogs/index>
   Landing Pages <landing-pages/index>
   Content Templates <content-templates/index>
   Content Blocks <content-blocks/index>
   Customer Login Pages <customer-login-pages/index>
   Content Widgets <content-widgets/index>
   Digital Assets <digital-assets/index>
   Search Synonyms <synonyms/index>
   Search Terms <search-history/index>

