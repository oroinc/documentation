.. _activities-emails:

Emails in Oro Applications
==========================

Connecting your mailbox with OroCommerce streamlines communication, efficiently manages customer interactions, and maintains a unified view of e-commerce operations. Oro applications allow for sending and receiving emails through the system, syncing IMAP emails into the application, and using Oro connectors to simplify interactions outside of the Oro application. You can configure a system email by your organization's admin or use a personal email account. Here are the key features of email functionality in Oro:

* **Data Synchronization** --- When you set up your mailbox in Oro applications, the platform establishes a connection between your email account and the relevant data in your Oro instance. This synchronization links emails exchanged with customers, suppliers, and partners to corresponding records in the platform.

* **Contextual Linking** --- Oro links incoming and outgoing emails to specific entities such as customers, orders, leads, opportunities, etc. This contextual linking ensures that communication related to a particular customer, order, or transaction is easily accessible from within the respective record's details. You can also add notes and comments to email threads, facilitating collaboration among team members who may need to access and respond to the same emails.

* **Customer Engagement** --- Emails sent to and received from customers are associated with their respective customer profiles. This link provides a comprehensive communication history, enabling you to understand the context of interactions and offer personalized service.

* **Streamlined Communication** --- By centralizing email communication in the Oro application, your team can easily collaborate on customer inquiries, orders, and issues. This prevents information silos and improves response time. For Google Workspace and Microsoft 365 users, Oro Enterprise also offers an OroConnector add-on to eliminate the need for time-consuming switching between email applications and OroCommerce. OroConnector sync data directly into your Gmail or Outlook interface, allowing you to view, respond to, and take actions on emails while having instant access to Oro records.

* **Automation and Triggers** --- Oro's email integration enables you to set up automated triggers and notifications based on specific events. For instance, an email can be automatically sent to a customer when their order status changes or to your team when a new lead is generated.

* **Operational Efficiency** --- With emails directly linked to relevant records, your team can access all relevant information in one place. This eliminates switching between email clients and the Oro platform, saving time and improving efficiency.

System Emails
-------------

A :ref:`system mailbox <admin-configuration-email-configuration-global>` is a centralized box for emails that are not addressed to any specific person within a company—for example, a mailbox for support requests, business injuries, or order support. An organization administrator can create different system mailboxes in Oro simultaneously and control the list of Oro users who can access them, automatically convert emails into cases of leads, and set up auto-response rules with email templates. System mailbox settings are usually only accessible by a system administrator with access to **System > Configuration** section of the Oro back-office.

To learn how to set up a system mailbox, see :ref:`Configure System Mailbox Globally <admin-configuration-email-configuration-global>`.

Personal Emails
---------------

Oro supports synchronization with your email provider using IMAP, meaning you can receive and review emails directly from the Oro application. Oro also supports connection to your SMTP server, which allows you to send emails from the Oro user interface without jumping back and forth between tabs. You can set up your personal email box by navigating to your settings under **Your Name > My Configuration**. If you use Gmail or Outlook, you can also use OroConnector with your Oro Enterprise application, which allows you to sync data from the Oro application directly to your email client.

To learn how to set up a personal email via IMAP and SMTP, see :ref:`Configure Email Settings per User <my_email_configuration>`. To learn how to use OroConnector, see OroConnector user guide for :ref:`Google Workspace <oroconnector-for-google-workspace>` or :ref:`Microsoft 365 <oroconnector-for-microsoft>`.

.. image:: /user/img/activities/my-config-emails.png
   :alt: Email settings under user configuration

Sending and Receiving Emails
----------------------------

You can access emails from :ref:`My Emails <user-guide-using-emails>` section at the top of the back-office navigation bar, as well as via the dashboard and a shortcut menu.

.. image:: /user/img/activities/my-emails.png
   :alt: My emails navigation bar

Your email grid will include system emails if configured and personal emails when synced. As emails are a crucial aspect of any e-commerce platform, emails are available as an action from a view page of many records (for example, contacts, leads, orders), allowing you to create an email directly from the page of that record.

.. image:: /user/img/activities/order-page-email.png
   :alt: Sending an email from the view page of an order

To learn how to compose and use emails, see :ref:`My Emails <user-guide-using-emails>`.

Email Templates
---------------

You can create and use predefined email designs for various communication purposes with email templates. These templates ensure consistent email branding and messaging, saving time and effort. You can personalize templates with dynamic placeholders for customer details, orders, and more, delivering a professional and unified email experience.

To learn how to create and manage email templates, see :ref:`Configure Email Templates <user-guide-using-emails-create-template>`.

.. image:: /user/img/system/emails/templates/email_template_create.png
   :alt: Creating an image template

Automation and Triggers
-----------------------

Notification rules in OroCommerce are predefined conditions that trigger automatic notifications or emails based on specific events or changes within the system. These rules are designed to keep users informed in real time. For instance, when the order status changes to "closed," a notification rule can automatically email the customer about this. Whenever an automatic email notification is sent out, it has to follow a specific :ref:`notification template <user-guide-using-emails-create-template>` created beforehand that gives it style and content.
Notification rules in OroCommerce are predefined conditions that trigger automatic notifications or emails based on specific events or changes within the system. These rules are designed to keep users informed in real time. For instance, when the order status changes to "closed," a notification rule can automatically email the customer about this. Whenever an automatic email notification is sent out, it has to follow a specific :ref:`notification template <user-guide-using-emails-create-template>` created beforehand that gives it style and content.

To learn how to work with notification rules, see :ref:`Configure Email Notification Rules <user-guide-using-emails-notifications>`.

.. image:: /user/img/activities/notification-rule.png
   :alt: Notification rule edit page

Analytics and Tracking
----------------------

OroCommerce links email communications with specific :ref:`entities <entities-management>` like customers, orders, or leads. When you send or receive emails related to these entities, OroCommerce keeps track of them and maintains a history of email interactions. You can use this information to create :ref:`custom reports <user-guide-reports>` or use email-related data to segment your customer base for targeted marketing campaigns.

To learn how to create custom reports using data from emails, see :ref:`Manage System and Custom Reports <user-guide-reports>`.

**Related Topics**:

* :ref:`My Emails <user-guide-using-emails>`
* :ref:`Configure Email Settings per User <my_email_configuration>`
* :ref:`Configure System Mailbox Globally <admin-configuration-email-configuration-global>`
* :ref:`Configure Email Notification Rules <user-guide-using-emails-notifications>`
* :ref:`Manage System and Custom Reports <user-guide-reports>`
* :ref:`OroConnector for Google Workspace <oroconnector-for-google-workspace>`
* :ref:`OroConnector for Microsoft 365 <oroconnector-for-microsoft>`

.. toctree::
   :hidden:
   :maxdepth: 1

   oroconnector-google
   oroconnector-microsoft
