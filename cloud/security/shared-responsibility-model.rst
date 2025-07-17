.. _cloud-security-shared-responsibility-model:

Understanding the Shared Responsibility Model in PCI DSS v4.0.1
===============================================================

As a service provider, Oro Inc. enables its customers to achieve PCI DSS v4.0.1 compliance by delivering secure hosting and application services through Infrastructure-as-a-Service (IaaS) platforms such as Google Cloud Platform (GCP) and Oracle Cloud Infrastructure (OCI).

To support a clear division of responsibilities, Oro Inc. formally defines its Shared Responsibility Model in the accompanying |Shared Responsibility Matrix|.

This matrix outlines which PCI DSS controls are managed by:

* **IaaS Platform** – Google Cloud Platform or Oracle Cloud Infrastructure, depending on which is used as an IaaS provider for the specific customer.

* **Oro**—Oro Inc. develops the OroCommerce application, deploys it into an Oro-managed cloud instance, and supports it throughout the service lifecycle.

* **Customer** – generally responsible for PCI DSS-compliant processes and procedures that cover the customer’s personnel and systems in the scope of the customer’s PCI DSS compliance, including those that are connected to the OroCommerce instance.

* **System Integrator** (S) – the organization responsible for the development and support of the OroCommerce customization. This role can be fulfilled by Oro, a third-party vendor, including Oro Partners, and by the Customer.

The Shared Responsibility Matrix serves as the authoritative mapping of each control to the appropriate responsible party. Understanding and applying this model ensures clarity, prevents compliance gaps, and enhances the overall security of environments deployed on OroCommerce.

Requirement 11.6.1: Change and Tamper Detection in Payment Pages
----------------------------------------------------------------

With PCI DSS v4.0.1, a new control—Requirement 11.6.1—has been introduced to mitigate modern threats targeting browser-based payment flows.
This requirement mandates that organizations:

* Detect unauthorized modifications to HTTP headers and the content of payment pages as received by the consumer's browser.
* Generate alerts when such changes are detected, enabling timely incident response.

Although Oro Inc. does not control the customer’s final payment page, we recognize our role in supporting this requirement:

* Oro Inc. provides best practice guidance and architectural recommendations to enable secure client-side integrations.
* We assist customers with tools to monitor and verify the integrity of scripts and third-party components embedded in browser-based payment forms.
* We encourage customers to implement Content Security Policy (CSP), Subresource Integrity (SRI), and real-time change detection to comply with 11.6.1.


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




