.. _user-guide-marketing-automation:

Marketing Automation
====================

In Oro applications, you can manage, perform, and track the results of your marketing activities, like email campaigns and website activities tracking.

You can integrate with the external services (MailChimp and dotmailer) and synchronize marketing campaign configuration and results between these services and Oro application.

In Oro application and external systems, you can launch marketing campaigns distributed via email to the custom group of contacts. The custom group is generated as a :ref:`marketing list <user-guide-marketing-lists>`.

Once the marketing efforts get their results, you can monitor the collected marketing information in the context of the customers, leads, and many more perspectives.

.. note:: Enable or disable marketing automation in Oro application via the :ref:`system configuration <marketing-system-configuration>`.

.. contents::
   :local:

Via Oro Application
-------------------

In Oro application, you can use the following marketing tools:

* **Marketing Lists** --- Group email data into a target :ref:`marketing list <user-guide-marketing-lists>`. It may be automatically generated using flexible filters and may contain any record with email information, like leads or customer users.
* **Marketing Campaign** --- Track statistics of the marketing efforts related to the same :ref:`marketing campaign <user-guide-marketing-campaigns>`.
* **Email Campaigns** --- Schedule or send an :ref:`email campaign <user-guide-email-campaigns>` that uses a marketing list as a target audience and may optionally be related to the existing marketing campaign and monitor the results.
* **Website Tracking** --- Generate a javascript :ref:`tracking code <user-guide-marketing-tracking>` that may be embedded in your or third-party websites to track users activity that brings valuable insight into your customer needs and your marketing efforts.

   .. note:: Configure tracking settings in Oro application via the :ref:`system configuration <admin-configuration-tracking>`.

Via dotmailer
-------------

Oro application supports out-of-the-box integration with dotmailer, allowing you to map the marketing lists to address books in dotmailer and keep them synchronized, use your address books to create email campaigns in dotmailer and import them to the Oro application, use the dotmailer campaign statistics to analyze the campaign efficiency.

Before using dotmailer with the Oro application, ensure that all the necessary integration steps are complete:

* Configure the :ref:`dotmailer integration <user-guide-dm-integration>`.
* Check the :ref:`mappings of the dotmailer data fields <user-guide-dotmailer-data-fields>` to the Oro application data.
* Set up the schedule for :ref:`data synchronization between dotmailer and Oro application <admin-configuration-dotmailer-integration-settings>`.
* Optionally, configure :ref:`dotmailer single sign on <user-guide-dotmailer-single-sign-on>`.

After configuring the integration and data synchronization, you can :ref:`send email campaign via dotmailer <user-guide-dotmailer-campaign>`.

Via MailChimp
-------------

Oro application supports out-of-the-box integration with MailChimp, allowing you to do the following:

* Map the marketing lists as segments in MailChimp and keep them synchronized.
* Use existing segments in MailChimp and import them to Oro application.
* Schedule importing statistics of the MailChimp campaigns into Oro Application.

To use MailChimp with Oro application, ensure that all the necessary integration steps are complete. See :ref:`MailChimp Integration <user-guide-mc-integration>` for more information.

After the integration is configured, you can :ref:`send email campaign via MailChimp <user-guide-mailchimp-campaign>`.

.. automation_finish

.. toctree::
   :hidden:

   marketing_lists
   email_campaigns
   marketing_campaigns

