.. _cloud-security-shared-responsibility-model:

Understanding the Shared Responsibility Model in PCI DSS v4.0.1
===============================================================

As a service provider, Oro Inc. enables its customers to achieve PCI DSS v4.0.1 compliance by delivering secure hosting and application services through Infrastructure-as-a-Service (IaaS) platforms such as Google Cloud Platform (GCP) and Oracle Cloud Infrastructure (OCI).

To support a clear division of responsibilities, Oro Inc. formally defines its Shared Responsibility Model in the accompanying Shared Responsibility Matrix.

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


For an in-depth overview of this requirement and implementation strategies, see :ref:`PCI DSS 4.0 Compliance With Cloudflare Page Shield <cloud-security-best-practice-compliance>`.




