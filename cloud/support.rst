:orphan:

.. _cloud_support:

Support
=======


Support Desk
------------

OroCloud's customer support is available for Oro authorized partners and Enterprise Edition customers.

For support and assistance requests, there is a customer support desk that is available 24x7x365 for ticket submission and further ticket-related communication:

.. image:: /cloud/img/cloud/support_portal.png

.. note:: Please find the link to the Oro Inc. support desk in your Welcome to Oro Enterprise email.

Working hours of the support team are M-F 09:00-17:00 (EEST).

Oro support team continues to put in all possible efforts to provide an initial response to the tickets within:

* 24 business hours for P2-P4 issues
* 4 hours for P1 issues

Support Process
---------------

Create a Support Request
^^^^^^^^^^^^^^^^^^^^^^^^

If you are struggling to resolve an issue with the existing documentation and you would like to get technical assistance:

#. Proceed to the Oro Inc. support desk using the link in your Welcome to Oro Enterprise email.
#. Log into your existing account or register a new one.
#. Click on the category that fits your issue:

   * Technical Request
   * Bug
   * Consulting Business Request
   * New Feature or Improvement
   * Other

#. Once you select the category, the issue details will be captured in the similar form.

   Note that the available information may vary depending on the issue type.

   .. image:: /cloud/img/cloud/create_request.png

#. Provide the necessary information (your license key and company name), and describe your request in the summary and description boxes. Please attach any files that may help in issue resolution (e.g., log files, screenshots, etc.)

#. To finalize the support request, click **Create**.

Comment on Your Request
^^^^^^^^^^^^^^^^^^^^^^^

You can get back to any of your created requests using the user menu at the top right.

Click on your user picture, and select **Created by me** or **All** under the `REQUESTS` group.

.. image:: /cloud/img/cloud/list_requests.png

The list of the ticket will open.

Click on the individual ticket to expand its details. You can always add comments and attachments to the ticket and review the responses from the support team.

Share Support Requests in Your Organization
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To keep multiple people in your organization informed of support requests and their progress, you may request Oro support to create an Organization group and include the accounts that should have shared access to the tickets.

Once the group is created, and one of the grouped accounts proceeds to the ticket creation, the new field will be added to the request details where they can specify if the request should stay *private* or be *shared with the group*.

Mark the Ticket as Resolved
^^^^^^^^^^^^^^^^^^^^^^^^^^^

Once the support team has provided you with a solution, please mark the ticket as resolved by clicking the Resolved link on the top right of the ticket details.

Support Request Priorities
--------------------------

Your request may be assigned one of the following priorities:

* Priority 1 (P1) issues are those that cause the complete unavailability of the production application or the inability to use mission-critical functionality within the application. For P1, there are no workarounds. Example of P1 issues: the application is down or not available to the end users, or data loss or data corruption occurred making an essential part of the application unusable, etc.

* Priority 2 (P2) issue is a serious problem within the application where a major feature/function failure has occurred. The application is functioning but in severely reduced capacity, or the problem is causing significant impact to some of the customer’s business operations and productivity, or the application is exposed to potential loss or interruption of service.

* Priority 3 (P3) issue is a medium-to-low impact problem that involves partial or non-critical loss of functionality, or that impairs some operations but allows a customer operations to continue to function.

* Priority 4 (P4) is reserved for general use questions, cosmetic issues, and documentation-related questions. With P4, the application works without any functional limitation.

* Enhancement Request (ER) is a recommendation for future product enhancement or modification to add official support and documentation for the unsupported or undocumented feature, or features that do not exist in the application.

Support Request Statuses
------------------------

Your request may fit one of the following statuses:

* **Waiting for triage** is a status of the new ticket that just entered the queue.
* **Request acknowledged** is set when a ticket has been acknowledged by the support team and is waiting for the proper resources to be assigned.
* **In progress** is the status of a ticket where an investigation and solution is currently being worked on.
* **Waiting for customer** is a status for tickets that require some additional information form your side. This could be additional access, some specific question related to the request, or any other point where the ticket is on hold but not because of the support team.
* **Resolved** status means that the problem or question has been resolved and the reporter has confirmed it may be closed or is no longer relevant. The ticket may also enter this status if no feedback on the advised solution or answer is received for a long time after several follow-ups.
* **Reopened** is a status where a ticket has been reopened due to some additional questions or issues discovered on a request.

.. _support-requests-further-app-deployment:

Support Requests for Application Deployment and Configuration
-------------------------------------------------------------

The following checklist provides the typical activities that you need to perform before going live with your OroCommerce solution. **These activities are covered by the Oro support team for our clients**. To ensure their fastest completion, please submit a request to our support team with the description of each activity required for your project.

.. csv-table::
   :header: "Task Name", "Task Description", "Information Required from a Customer", "Delivery Estimates (Working Days)"
   :widths: 30, 50, 50, 10

   "**Environment(s) deployment (UAT, STAG, PROD)**","Deployment of an OroCloud environment for production, staging, or user-acceptance testing purposes. A number of available environments and their types depend on your Oro license. Also, you can always request deployment of additional environments (beyond what is covered by your license) for an additional cost","
    * Customer country of origin
    * Type of environment: (production, staging or UAT)
    * Preferred domain in oro-cloud.com
    * Company name
    * License key
    * Application version
    * Link to a custom repository in SSH format
    * Tag or branch to deploy from
    * First and last name of admin contact
    * Email of admin contact", "2-3"
   "**Basic authentication configuration**", "Configuration of user access credentials for your OroCloud environment. **NOTE**: This configuration can be set up in the orocloud.yaml file without the Oro support team", "--","1-2"
   "**Sub-domains configuration**", "Configuration of sub-domains for your OroCloud root domain", "The list of sub-domains that should be configured","1-2"
   "**Environment(s) SSH access**", "SSH access to enable you to connect to your OroCloud environment using an SSH console. Read more at :ref:`Connect to Public Identity Management <public-identity-management-ssh>`", "
    * User's first and last name
    * Email
    * Company","1-2"
   "**SFTP set up**", "SFTP access to your OroCloud environment. Read more at :ref:`Connect to the OroCloud Environment via SFTP <sftp-access>`", "Preferable login(s)","1-2"
   "**Back-office URL configuration**", "URL configuration for accessing OroCommerce back-office on your OroCloud environment. **NOTE**: This configuration can be set up in the orocloud.yaml file without the Oro support team", "Required URL for backend","1-2"
   "**Database migration**", "Migration of your PostgreSQL database to your OroCloud environment.", "PostgreSQL Database. Be aware that the codebase must match the database structure","1-2"
   "**Installation of non-out-of-the-box (OOTB) software (MuleSoft, etc.)**", "Installation of third-party software that is not included in OroCommerce out-of-the-box", "Provide a business case of how this software is going to be used and interact with OroCommerce","Requires investigation"
   "**Email domains whitelisting (for staging environments only)**", "Whitelisting trusted domains approved for sending you emails.", "List of approved email domains","1-2"
   "**Obtaining SSL certificate/wildcard**", "Provision of an SSL certificate for your domain to keep sensitive information encrypted. As there are three options for setting up a domain name and SSL certificate for hosted environments, please review the available :ref:`in a dedicated topic <ssl-certificate>`", "Required information depends on the selected option","2-3"
   "**DNS configuration**", "Configuration of DNS server to point your domain name to your IP address. **NOTE**: This configuration can be set up in the orocloud.yaml file without the Oro support team", "--","2-3"
   "**Access to application logs**", "Granting access to application logs", "
    * User's first and last name
    * Email
    * Company","1-2"
   "**Message queue configuration**", "Сonfiguration of message queues for your OroCloud environment to ensure optimal system performance, for example by segregating messages on pricing calculation and reindexation into a separate message queue with its own consumers. Read more about how we configure message queues for local environments at :ref:`Configure Message Queue with RabbitMQ for Production <op-structure--mq--rabbitmq--configure>`", "Message queue configuration preferences","1-2"
   "**Resources configuration**", "Configuration of the application based on the estimated volume of data and media files to ensure optimal system performance", "
    * Expected data volume
    * Overall number of consumers and queues
    * The number of consumers for every queue","Requires investigation"
   "**Availability-check monitoring request**", "Granting access to continuous system health-check for your OroCloud environment", "--","1"
