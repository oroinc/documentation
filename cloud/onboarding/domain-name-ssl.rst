.. _ssl-certificate:

.. important:: You are viewing the upcoming documentation for OroCloud, scheduled for release later in 2025. For accurate and up-to-date information, please refer only to the documentation of |the latest LTS version|.

Domain Name and SSL Certificate
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. begin_include

We recommend 3 options for setting up a domain name and SSL certificate for hosted environments.

**1. Domain name in oro-cloud.com domain zone**

This is the simplest option where your site domain name follows the *<customer_site_name>.oro-cloud.com* pattern.

In this case, Oro support is fully responsible for maintaining of the domain name as well as SSL certificate and customers must only provide the *customer_site_name* (e.g., myfirmshop).

**2. Custom domain name with Oro supported SSL certificate.**

You can use your branded URL in your company's domain zone but delegate SSL certificate support to the Oro support team.
Standard OroCloud contract covers provisioning and support of SSL certificates for one domain. Any additional SSL certificates required for an additional domain name (e.g., in different country domain zones) must be contracted and billed.

The Oro Support team will provision, configure and bear full responsibility for renewal or updating. From your side, you need to add a new domain record to your DNS. The Oro support team provides you with IP pointing to your new site in OroCloud.

.. note:: This option applies only to production and stage environments.

You should also reconfigure your application so it is not redirected to the oro-cloud.com domain, as described in the :ref:`Global Routing Configuration <sys--config--sysconfig--websites--routing>` topic. To proceed with this option, please submit a support request to Oro Support Desk for further details.

**3. Domain name and SSL certificate managed by the customer.**

You can provide own certificate to use in OroCloud environment to keep control over it. In this case, the following data must be provided to OroCloud support:

* Full domain name (e.g., b2bshop.myfirm.com) for the OroCloud site.
* Signed certificate for your domain - a file with the *.crt* extension. Wildcard certificate can be used.
* The secret key for the certificate - a file with the *.key* extension.

You also need to add new domain record to your DNS. Oro support team will provision you with IP pointing to your new site in OroCloud.

To mitigate security risks during the transition of the secret key to Oro support team, please upload it to your home directory at you OroCloud production maintenance host. **Do not send it in an email or any messenger!**

You also should reconfigure your application so it is not redirected to oro-cloud.com domain, as described in the :ref:`Global Routing Configuration <sys--config--sysconfig--websites--routing>` topic.

Please keep in mind that you are fully responsible for provisioning, renewal, and support of the SSL certificate that you have provided to Oro.

.. include:: /include/include-links-cloud.rst
   :start-after: begin

.. finish_include

