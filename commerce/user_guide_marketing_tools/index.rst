.. _user-guide-marketing:

User Guide: Marketing
=====================

OroCommerce embedded marketing activities use the following basic concepts:

* :ref:`Marketing Lists <user-guide-marketing-lists>`

A Marketing list is a list of contacts segmented according to conditions which are defined for the purpose of bulk emailing or telephone outreach. In your Oro application, virtually every entity is available as a marketing list target. For instance, marketing lists can be created based on accounts (primary email of a default contact is used), or, if you are using OroCommerce, from customer users, quotes, orders, and shopping lists.

Marketing lists can be used to run Email Campaigns in OroCommerce and synchronize with Subscribers Lists in MailChimp and/or address books in dotMailer.

* :doc:`/user_guide_marketing_tools/automation/email_campaigns`

You can send an email campaign generated in your Oro application, without the involvement of external marketing automation applications. This means that once you have defined the rules for generation of a :ref:`Marketing List <user-guide-marketing-lists>` and have created an :ref:`Email Template <user-guide-email-template>`, you can easily set-up an email campaign, within which all the contacts on the list will receive personalized emails in compliance with the campaign. You can then collect statistics for such campaigns and :ref:`create reports <user-guide-reports>`.

* :doc:`/user_guide_marketing_tools/automation/marketing_campaigns`

Campaign records in OroCommerce are used to define general details of the marketing activity and monitor its flow and results. You can include any amount of Email Campaigns and :ref:`Tracking Website records <user-guide-marketing-tracking>` into one Campaign and get the full picture to evaluate the campaign efficiency.

.. include:: /user_guide_marketing_tools/automation/index.rst
   :end-before: automation_finish

Website Tracking
----------------

With Oro Tracking Websites functionality, you can learn how many users have visited your website from links within a specific marketing campaign and what these users' actions at the site were. For the detailed guide on how to create a Tracking Website record and add the generated code to the web pages you want to monitor, see the :ref:`Tracking Websites <user-guide-marketing-tracking>` topic.


.. toctree::
   :includehidden:
   :hidden:
   :titlesonly:
   :maxdepth: 2

   automation/index
   tracking/index
   integrated/index
