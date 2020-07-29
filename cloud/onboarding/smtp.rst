.. _orocloud-smtp:

SMTP Setup
^^^^^^^^^^

.. begin_include

Any Oro application hosted on OroCloud can use an SMTP server maintained by Oro to send emails to your customers.

All Oro applications on the OroCloud are provided with a pre-configured SMTP server. But to ensure reliable delivery of emails from Oro application to their end-users, our customers have to perform a few additional steps:

1. Verify email configuration.
2. Request Oro support for assistance.
3. Configure your DNS to authorize the Oro SMTP relay as a legitimate sender.
4. Test your configuration.

Each of these steps is explained below.

Verify Email Configuration
~~~~~~~~~~~~~~~~~~~~~~~~~~

Verify that sender email addresses for notifications and campaigns are matching your domain.

.. image:: /cloud/img/cloud/smtp_config.png
   :alt: Global email configuration settings

Request Oro Support for Assistance
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To get all the information and assistance needed to complete the setup of Oro SMTP relay for your application, you need to create a support ticket at |Oro Inc. Support Desk|. You can check out the complete process in the :ref:`OroCloud documentation <cloud_support>`. When creating a support ticket, you need to provide the domain name(s) that you use as the sender domain.

In this ticket, Oro support will provide you with the information about your DNS record changes to authenticate the Oro SMTP relay as a legitimate SMTP server for your domain(s).

You can proceed to the configuration steps with this information.


Configure DNS to Authorize the Oro SMTP Relay as a Legitimate Sender
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To ensure successful email delivery, you need to make modifications to your DNS record. These modifications will authenticate the Oro SMTP relay as a legitimate SMTP server which can send emails from your organization. This is necessary because modern email recipient servers filter out emails to spam if the sender server does not belong to the sender’s domain or is unauthorized. As a part of your request fulfillment, Oro support will perform all actions with Oro SMTP relay and send you a link to the page with new data for your DNS record.

You will need administrative access to your DNS managing tool. Alternatively, you can transfer this link to the person responsible for the DNS support in your organization according to your internal procedures.

Please allow up for to 48 hrs for the change to come into effect.


Test Configuration
~~~~~~~~~~~~~~~~~~

Once you have completed configuring your SMTP server settings in Oro application and modifying your DNS record, you can start sending emails from the Oro application.

Oro recommends that you test email distribution using a small test batch of addresses before running big marketing campaigns. You must be able to verify that your emails have reached the recipients without being marked as spam. Oro support will assist if you have any issues at this step.

.. finish_include

.. include:: /include/include-links-cloud.rst
   :start-after: begin
