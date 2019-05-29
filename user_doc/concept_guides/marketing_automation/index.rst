.. _user-guide-marketing-automation:

.. updated on 06 July 2017

Marketing Automation
====================

In Oro applications, you can manage, perform, and track the results of your marketing activities, like email campaigns and website activities tracking.

.. contents::
   :local:

You can integrate with the external services (MailChimp and dotmailer) and synchronize marketing campaign configuration and results between these services and Oro application.

In Oro application and external systems, you can launch marketing campaigns distributed via email to the custom group of contacts. The custom group is generated as :ref:`marketing list <user-guide-marketing-lists>`.

.. .. note:: **OroCRM only:** When you Oro application is integrated with the Magento store, you can track the abandoned carts in Magento store and generate lists of contacts (customer users or leads) and follow up on their incomplete purchase (e.g. via a :ref:`dedicated email campaign <user-guide-acc>`).

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

Via dotmailer
-------------

.. include:: /user_doc/back_office/system/integrations/dotmailer/index.rst
   :start-after: begin_include
   :end-before: finish_include

Via MailChimp
-------------

Oro application supports out of the box integration with MailChimp, allowing you to do the following:

* Map the :ref:`Marketing Lists <user-guide-marketing-lists>` as segments in MailChimp and keep them synchronized.
* Use existing segments in MailChimp and import them to Oro application.
* Schedule importing statistics of the MailChimp campaigns into Oro Application.

To use MailChimp with Oro application, ensure that all the necessary integration steps are complete. See :ref:`MailChimp Integration <user-guide-mc-integration>` for more information.

After the integration is configured, you can :ref:`Send Email Campaign via MailChimp <user-guide-mailchimp-campaign>`.

.. automation_finish

