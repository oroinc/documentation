
.. _cloud-security-best-practice:

Shared Security Responsibility and Best Practices
=================================================

This section coordinates the area of security responsibility between Oro Inc., the code and infrastructure provider, and the Customer, the end-user of the Oro application. This document also contains Oro Inc. security best practices for Customers to protect the data and ensure the maximum security level of the application.

Responsibility
--------------

Oro Inc
^^^^^^^

Infrastructure
~~~~~~~~~~~~~~

1. The infrastructure provided by Oro must have both secure public and private connection points.

   * Public connection means access for end-users over the Internet. Connections must use encrypted protocols (e.g., HTTPS) to exchange data, and standard web server configuration must prevent common vulnerabilities (XSS, clickjacking).
   * Private connection means access for environment users (engineers) and administrators who work on the infrastructure level. Access should be allowed only through the private network connection (VPN) using encrypted protocols.

2. The only application resource exposed to the Internet is the web server used by end-users to access the application. Direct access from the Internet to the internal application components (DBMS, search engine, MQ) should be disabled.
3. Oro Inc. must grant developers and infrastructure engineers access to the Oro management tools (orocloud-cli) and application logs.

Application
~~~~~~~~~~~

1. Oro Inc. provides a standard web application that follows global security best practices (OWASP top 10).
2. Oro applications must include standard configuration to prevent CSRF, XSS injection, and clickjacking vulnerabilities.
3. Oro Inc. provides fixes for discovered security vulnerabilities in the standard application in patch releases or code patches.
4. Standard Oro applications are responsible for encrypting sensitive information in standard components before saving it to internal storage.
5. Standard Oro applications are compliant with PCI-DSS requirements for processing customer and financial data (cardholder data) in standard components.
6. Standard Oro application does not store cardholder data, PANs, etc.
7. Application data is encrypted at rest and in transit in a standard Oro-managed application environment.

Customer/Implementation Partners
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Infrastructure
~~~~~~~~~~~~~~

1. Engineers with access to Oro infrastructure must not share access credentials with others.
2. Engineers who have access to Oro infrastructure must not expose any additional entry points (services, servers, etc.) to the Internet or install any additional software without approval from Oro Inc.
3. Engineers who have access to Oro infrastructure must immediately report all security vulnerabilities found in the application environment to Oro Inc. via the Customer Support Portal.
4. The customer/partner must immediately inform Oro Inc. in case of identity theft (e.g., credentials were lost or stolen) or a lost device affecting Oro application environment accounts.
5. The customer must notify Oro Inc. about the termination of the employee who has access to the Oro environment.
6. It is not recommended to use production data in a non-production environment to guarantee data consistency and security.
7. Notification settings of the non-production instances must be configured in such a way as to avoid sending information to real customers.

Development
~~~~~~~~~~~

1. Developers responsible for the Oro application customization must encrypt all sensitive information before storing it in any internal storage (database, session, cache, file system, search index, etc.) or passing it over to third-party applications.
2. Developers responsible for the Oro application customization must not store sensitive information or credentials directly in code.
3. Developers responsible for the Oro application customization must maintain all security best practices implemented in the standard application code.
4. Developers responsible for the Oro application customization must follow the global secure development guidelines provided by OWASP.
5. Developers responsible for the Oro application customization must not add entry points (API, services) that may expose sensitive information or harm the application integrity and availability or customers in any other way.
6. During the integration development, developers responsible for the Oro application customization must use an encrypted connection (HTTPS, SSH, etc.) to exchange data with third-party systems.
7. During the payment integration development, developers responsible for the Oro application customization must follow PCI-DSS to guarantee the security of customer data.
8. Developers should avoid storing cardholder data in any storage (DB, session, cache, search index, file system, etc.) received from any data source.
9. Developers responsible for the Oro application customization must report all found vulnerabilities in Oro applications to Oro Inc.
10. Developers responsible for the Oro application customization must not expose customers' sensitive information for public usage.
11. Developers responsible for the Oro application customization must implement and follow global and local data protection regulations (GDPR, etc.).
12. Developers responsible for the Oro application customization are not allowed to expose the code of the Enterprise modules for public usage or to other people who do not have access to it.

Usage
~~~~~

1. The customer owns user accounts inside the Oro application.
2. Customers must maintain and follow their own access management procedure when handling Oro application accounts and accounts provisioned by Oro Inc. for customer employees.
3. Oro application users must not share access credentials with other persons.
4. Oro application users must not store secure information (passwords, CC numbers, PINs, etc.) in plain form or on pages and forms not designed specifically for that purpose.
5. Oro application users must not expose customers' sensitive information for public use.
6. Oro application users must report all vulnerabilities found to the application administrator so they can fix them if they are part of customization or forward them to the Oro Team if they are part of a standard application.
7. Oro customers are responsible for Information Security Awareness training for users of the Oro application.
8. Customers are responsible for validating data passed from external sources, e.g., for checking integration source files before importing them. Oro recommends using antivirus software to check data intended to be uploaded into OroCommerce.

Best Practices
--------------

Infrastructure
^^^^^^^^^^^^^^

1. Do not store secure or sensitive information in the home directory.
2. Clean up shared directories (e.g., SFTP folder) regularly to prevent exposing sensitive information.
3. Monitor application logs for hacking attempts regularly. They may look like access from unexpected IP addresses, unauthorized access responses, etc.
4. Check the list of executed commands (orocloud-cli log) for signs of hacking attempts.
5. Use data sanitization for DB intended for debugging or testing.

Development
^^^^^^^^^^^

1. Apply all the responsibilities and best practices to the customization and all external libraries or packages added to the application.
2. Use the “minimum required access” approach to develop integrations when a third-party application is to interact with the Oro application (e.g., using API).
3. If the integration uses temporary storage to save data (e.g., files on SFTP), remember to clear it up when it is no longer needed.
4. Include security checks into the code review process and check against common vulnerabilities from OWASP top 10 (SQL injection, XSS, CSRF, code injection, etc.).
5. Automate checks for potential security vulnerabilities using CI. You can use one of the following libraries:

   * |https://github.com/oroinc/phpstan-rules|
   * |https://github.com/fabpot/local-php-security-checker/|
   * |https://github.com/FriendsOfPHP/security-advisories|

6. It is recommended to cover all actions (links, buttons, etc.) with an ACL check, so the application administrator can control what exactly is available for each role, and the lowest roles (e.g., for integrations) will not have access to most of the features. Actions must be covered from two sides: from the place where the trigger (link, button) is rendered and from the place where the action is executed (controller, CLI command).
7. It is recommended that every list of entities (grid, table, etc.) be covered with an ACL check using the ACL helper. This way, users will see only entities visible to them based on the defined permissions.
8. Add the ACL configuration to every new entity visible to a user. You may also consider adding ownership to provide an extra level of flexibility.
9. If an entity has ownership, you must check permissions for this specific entity, not just a general ACL for the entity class.
10. Do not pass any sensitive information to logs, as all log records are stored in a simple form. If you have to do it, remember to mask sensitive information with asterisks or replace it with a hash.
11. Do not pass information to the client application (web browser, mobile application, etc.) if the current user is not allowed to see it.
12. Never evaluate code (use the eval function) passed from any internal or external source.
13. Remove all direct data output (print_r, echo, console.log, etc.) and other similar debug calls from the code.
14. Log every attempt of unauthorized access with the WARNING level or higher, and monitor application logs to determine where they come from. They may indicate either an application issue (some actions or data are visible to a user who should not have access to it) or hacking attempts.


Usage
^^^^^

1. If you, as an application user, have found that some secure data is not encrypted, please inform the administrator and check for similar issues across the application.
2. Plan permission for roles ahead and grant users the minimum permissions required for their work.
3. Conduct security awareness training for all employees and explain security best practices.
4. Avoid exchanging secure or sensitive information in plain form, e.g., via email or USB flash drives. If you need to do that, please encrypt the information first.
5. Perform regular data backup recovery tests using a non-production environment to check the integrity of these backups.

.. _cloud-security-best-practice-compliance:

PCI DSS 4.0 Compliance With Cloudflare Page Shield
--------------------------------------------------

Updates in PCI DSS 4.0 introduce strict requirements to secure payment pages in web applications. Specifically, organizations must ensure that all JavaScript payment page scripts are authorized and monitored for changes. The goal is to maintain an up-to-date inventory of all scripts on payment pages and promptly detect any unauthorized additions or modifications. OroCloud addresses these requirements by using Cloudflare Page Shield on your OroCommerce application. Page Shield continuously monitors the scripts running on your site and alerts you to any unexpected script activity, helping fulfill PCI DSS v4.0 requirements 6.4.3 and 11.6.1.

This section explains the purpose of Page Shield in your compliance program, your responsibilities as an OroCloud client, the types of alerts you will receive, and how to respond to them.

.. .. note:: For more information, please see |PCS DSS 4.0.1 Matrix|.

.. add link when available

Cloudflare Page Shield
^^^^^^^^^^^^^^^^^^^^^^

Cloudflare Page Shield is a client-side security solution that monitors all JavaScript loaded by users’ browsers on your website. It automatically captures an inventory of all scripts running on your site and tracks any connections those scripts make. Page Shield will trigger alert notifications whenever a new script is detected, an existing script’s code changes, or a script is identified as malicious. In essence, Page Shield acts as a watchdog for your OroCommerce storefront, it continuously watches for unauthorized script content that could indicate skimming attacks or other client-side threats. By deploying Page Shield, OroCloud provides an extra layer of protection to help meet the PCI DSS 4.0 client-side security rules.

Why Page Shield is Important for PCI DSS 4.0
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

PCI DSS v4.0 Requirement 6.4.3 mandates that all scripts on payment pages be managed and authorized, including maintaining a documented inventory of scripts with a business justification for each. Additionally, Requirement 11.6.1 requires implementing a change-detection mechanism to monitor for unauthorized modifications to payment page content and alert personnel to any suspicious changes. Page Shield directly supports these requirements:

* **Script Inventory & Justification:** Page Shield maintains an active inventory of all JavaScript executing on the payment page, which can be easily exported for documentation. This inventory helps you fulfill the requirement of having a written list of all permitted payment page scripts and why each is necessary. OroCloud will assist by providing the script inventory captured by Page Shield; however, it is crucial that the client meticulously create and maintain documented business justifications for every script in use within their PCI DSS records.

* **Monitoring & Alerts for Changes:** Page Shield’s monitoring functionality continuously evaluates your payment page scripts and sends real-time alerts when it detects new scripts or changes to existing scripts. This aligns with PCI DSS 11.6.1’s requirement for the timely detection of unauthorized script changes.

Payment Pages
^^^^^^^^^^^^^

According to the PCI DSS Glossary (version 1), a payment page is defined as:

*“A web-based user interface containing one or more form elements intended to capture account data from a consumer or submit captured account data for purposes of processing and authorizing payment transactions.”*

A payment page may be rendered in one of the following formats:

* A standalone document or web instance.
* A document or component embedded in an inline frame (iframe) within a non-payment page.
* Multiple documents or components, each with one or more form elements, embedded as iframes within a non-payment page.

Payment Pages in Scope
~~~~~~~~~~~~~~~~~~~~~~

This procedure applies specifically to payment pages within the OroCommerce application that are listed below:

* pages matching the following pattern: /customer/checkout/*

.. note:: Custom applications may have additional payment pages outside the standard OroCommerce checkout flow. These must also be reviewed and maintained in the script inventory to ensure complete compliance.

Roles and Responsibilities
^^^^^^^^^^^^^^^^^^^^^^^^^^

Page Shield’s effectiveness relies on a clear separation of duties between Cloudflare, Oro, and the client:

* **Cloudflare** - delivers the Page Shield technology.
* **OroCloud** - manages Page Shield configuration, sets CSP headers, controls dashboard access, and alerts notifications preferences.
* **Client** - maintains inventory justification records, receives alerts, and manages approvals for script additions, changes, and removals.

Enabling Page Shield for the Project
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To enable Page Shield, the client must create a request through the Oro customer support portal. The request must include:

* The domain URL where Page Shield should be activated
* Email addresses of users who should receive script alert notifications
* A list of domains from which scripts are allowed to load. This list defines the allowlist used in the Content Security Policy (CSP) rules and must include all trusted first-party and third-party domains relevant to the client’s implementation.

The default allowlist covering standard OroCommerce functionality and core integrations includes:

* ``https://*.stripe.com``
* ``https://*.stripe.network``
* ``https://*.paypal.com``
* ``https://*.apruve.com``
* ``https://*.authorize.net``
* ``https://r.orocrm.com``
* ``https://www.googletagmanager.com``
* ``https://www.google-analytics.com``

Any additional domains required by your implementation must be reviewed and explicitly added to the CSP by submitting a request through the Oro customer support portal.

Oro will configure monitoring and notifications based on the submitted request. To avoid setup delays, ensure that the provided information is complete and accurate.

Requesting Allowed Domain Updates
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

If the list of approved domains changes at any time, such as when integrating new marketing platforms, analytics tools, or third-party services, the client must submit an update request through the Oro customer support portal before the updates are deployed. This request must clearly identify the new domain(s) to be added and their purpose. OroCloud will then update the Content Security Policy (CSP) configuration accordingly to maintain alignment with PCI DSS requirements.

Page Shield Alerts and Notifications
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You will receive email notifications for:

* New Script Detected
* Script Content Change
* Malicious Script Detected

These emails include basic details about the script or change. Page Shield configuration and dashboard are fully managed by the Oro team to ensure consistency, limit exposure, and reduce compliance complexity for clients.

.. note:: Alerts are not triggered when scripts are removed from the payment page. You must manually handle such events by updating the script inventory to reflect the removal. This ensures your documentation remains accurate and compliant with PCI DSS 6.4.3 requirements.

How to Respond to Page Shield Alerts
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. Review the alert details.

#. Assess if the change was expected. The most common reason for an expected script change alert is the deployment of a new release that includes code changes and new scripts. When receiving an alert, verify whether it coincides with a planned deployment or other known changes to the storefront.

#. Act immediately on malicious and unexpected alerts.

#. Update the payment page scripts inventory if the change is expected and the inventory was not updated during the release preparation.

Maintaining the Payment Page Script Inventory
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

* The initial list may be based on the Payment Page Scripts Inventory and must include all the customization changes.

  .. hint:: The Payment Page Scripts Inventory is version-specific. It is included in the release artifacts for each release in the OroCommerce repository.

* Clients must actively manage the payment page script inventory to reflect changes introduced during new version deployments and in response to Page Shield alerts. The process includes the following steps:

1. Pre-Deployment Preparation:

   * Review the planned code changes.
   * Identify any new or modified scripts expected in the deployment.
   * Update the script inventory with anticipated changes, including script names, sources, and justifications.

2. During Deployment:

   * Notify the inventory manager before the deployment.
   * Ensure no unapproved scripts are introduced.

3. Post-Deployment Verification:

   * Compare actual deployed scripts with the updated inventory.
   * Validate that all expected changes are correctly documented.
   * Request a Page Shield export from OroCloud if verification is needed.

4. Responding to Alerts:

   * Review alerts received via email for any new or changed scripts.
   * Determine if the alert corresponds to the recent deployment.
   * If a script is unexpected or malicious, escalate for investigation.
   * For valid but untracked scripts, update the inventory and add justification.

5. Ongoing Maintenance:

   * Periodically review script inventory for accuracy.
   * Remove entries for scripts no longer in use (note: Page Shield does not alert on script removals).
   * Retain versioned copies of inventory for audits.

Pay close attention to your Google Tag Manager (GTM) configuration. GTM allows you to load new scripts into your site dynamically, which may introduce scripts onto payment pages without direct code changes. Any script introduced through GTM must also be tracked and included in your script inventory with appropriate justification.

Evaluating Compliance With PCI DSS 4.0
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Cloudflare provides a mapping of how Page Shield aligns with PCI DSS 4.0 requirements. This can be used during audits or internal evaluations to justify the security control in place.

For more information, please refer to the official |Page Shield–PCI DSS mapping guide|.

Please review this reference along with this guide to better understand how monitoring, inventory maintenance, and alerting support compliance efforts. It may also be used to prepare for questions during audits or when defining internal procedures.

.. include:: /include/include-links-cloud.rst
   :start-after: begin
