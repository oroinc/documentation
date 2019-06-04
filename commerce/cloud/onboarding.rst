:orphan:

.. _cloud_onboarding:

Onboarding
==========

This topic details the onboarding process between you and our customer support team before your Oro application deployment begins.

.. contents:: :local:
   :depth: 2

Welcome Onboard
---------------

After you have signed an agreement with Oro Inc. or one of Oro-authorized partners, you will get a *Welcome to Oro Enterprise* email that guides you through the steps toward your Oro application going live.

You can refer to this email when you need the following information:

* Your license key (you may need it for support requests of any type)
* Contacts of the financial department (for questions and inquiries related to invoice and payment)
* Link to Oro Inc. Support Desk (for technical questions and questions related to the deployment, application configuration, and use)
* Links to the other training and documentation resources

Create an Account in Oro Inc. Support Desk
------------------------------------------

Oro Inc. Support Desk is the main point of contact for any questions and issues related to your company’s OroCloud environment and application instance. To start using the customer support service, please create an account on the Oro Inc. Support Desk.

.. note:: In your support requests, remember to provide your company’s name, the license key (if applicable), and the application version.

For more information on using the support portal, see the :ref:`Support <cloud_support>` section.

.. _ssl-certificate:

Set up a Domain Name and SSL Certificate for OroCloud Environment
-----------------------------------------------------------------

We recommend 3 options for setting up a domain name and SSL certificate for hosted environments.

**1. Domain name in oro-cloud.com domain zone**

This is the simplest option where your site domain name follows the *<customer_site_name>.oro-cloud.com* pattern.

In this case, Oro support is fully responsible for maintaining of the domain name as well as SSL certificate and customers must only provide the *customer_site_name* (e.g., myfirmshop).

**2. Custom domain name with Oro supported SSL certificate.**

You can use your branded URL in the domain zone of your company but delegate support of SSL certificate to Oro support team.

You need to add a new domain record to your DNS. Oro support team provides you with IP pointing to your new site in OroCloud.

For this option, Oro needs the following information to provision SSL certificate for your new domain:

* The full DNS name of your OroCloud site.
* Country Name (2 letter code)
* State or Province Name (full name)
* Locality Name (e.g., city)
* Organization Name (e.g., company)
* Organizational Unit Name (e.g., section)
* Common Name (e.g., YOUR name)
* Email Address

Once you provide this information and have DNS name added to your DNS record, Oro support team will provision, configure and bear full responsibility for renewing or updating the SSL certificate for your OroCloud site. During provisioning of SSL certificate, we will ask you to add TXT record to your DNS to confirm domain ownership.

You should also reconfigure your application so it is not redirected to oro-cloud.com domain, as described in the :ref:`Global Routing Configuration <sys--config--sysconfig--websites--routing>` topic.

Standard OroCloud contract covers provisioning and support of SSL certificate for one domain. Any additional SSL certificates required for an additional domain name (e.g. in different country domain zones) must be contracted and billed.

**3. Domain name and SSL certificate managed by the customer.**

You can provide own certificate to use in OroCloud environment to keep control over it. In this case, the following data must be provided to OroCloud support:

* Full domain name (e.g., b2bshop.myfirm.com) for the OroCloud site.
* Signed certificate for your domain - a file with the *.crt* extension. Wildcard certificate can be used.
* The secret key for the certificate - a file with the *.key* extension.

You also need to add new domain record to your DNS. Oro support team will provision you with IP pointing to your new site in OroCloud.

To mitigate security risks during the transition of the secret key to Oro support team, please upload it to your home directory at you OroCloud production maintenance host. **Do not send it in an email or any messenger!**

You also should reconfigure your application so it is not redirected to oro-cloud.com domain, as described in the :ref:`Global Routing Configuration <sys--config--sysconfig--websites--routing>` topic.

Please keep in mind that you are fully responsible for provisioning, renewal, and support of the SSL certificate that you have provided to Oro.

Get Access to the Oro application Enterprise Edition Source Code
----------------------------------------------------------------

Once you purchase an Oro application license, your `Welcome Onboard`_ email will link to the Oro application Enterprise Edition source code in GitHub.

To be able to access, clone and fork the repository, please request access to the necessary GitHub account via the Oro Inc. Support Desk by providing GitHub usernames, first and last names, and emails of the accounts.

.. sample

You can use the source code from the repository to install Oro application in your local, staging, development and production environment, including OroCloud.

You can also fork and customize the Enterprise Edition of Oro's application source code if needed. It is highly recommended to use only Long Term Support (LTS) versions for production environments. Check out the list of LTS versions and their release schedule in the relevant :ref:`Release and Support Cycle <doc--community--release>` article.

Deploy OroCloud Environment and Application
-------------------------------------------

If you plan to deploy a custom Oro application from the forked or private repository, you will be requested to provide the custom repository address in ssh format (i.e. git@github.com:org/app.git), tag or branch that should be used for installation.

.. note:: For customized installation, please ensure that your custom source code is fully functional and does not disrupt the application installation flow.

The support team will generate SSH keys and will share a public key with you. This key should be added as a deployment key to your custom repository to authorize cloning the repository from the Oro application host in the cloud environment.

Once all the necessary information is collected and the necessary access permissions are granted, the environment of the :ref:`standard configuration <cloud_architecture>` is prepared and the Oro application is installed using the repository, tag or branch you have specified, or with the latest LTS :ref:`released version <doc--community--release>` of the application if no customization is planned.

Once the installation is complete, the support team creates the first administrator in the Oro Application using the details collected during your onboarding.

Customer support will inform you of the successful installation and remind the VPN details and the general guidance on the available maintenance tools.

If you happen to require a system update or customization at a later time, you may either perform it manually using the :ref:`OroCloud maintenance tools <cloud_maintenance>` and :ref:`Oro application upgrade <upgrade>` documentation, or you can request the necessary changes using the Oro Inc. Support Desk.

.. _public-identity-management-ssh:

Connect to Public Identity Management
-------------------------------------

You can connect to OroCloud environment using the SSH console. This can be established only via VPN connection using OpenVPN protocol.

You need to request SSH access to OroCloud environment via the customer support portal. The request should include:

* First and last name(s) of the user(s), and their Organization(s)
* E-mail addresses of the user(s)

Customer users need to have the following clients installed:

* VPN client supporting OpenVPN protocol. See the :ref:`Connect to VPN topic <cloud_connect_vpn>` for the list of suitable VPN clients.
* SSH client

Once customer request for SSH connection fulfilled users receives an email with OpenVPN configuration and key. Having this email user must perform the steps outlined in the sections below:

Reset your password and add an SSH key using Oro Identity Portal
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. Open Oro Identity Portal and click **Forgot Password**.

   .. image:: /cloud/img/cloud/login_identity_portal.png
      :alt: Login page to the public identity management

2. Enter your email in the password recovery dialog.

   .. image:: /cloud/img/cloud/recovery_dialog.png
      :alt: Password recovery dialog

3. Check your mailbox for a message from the ORO Inc IDP Portal (idp-admin@oro.cloud).

   .. image:: /cloud/img/cloud/email_instructions.png
      :alt: Login page with a pop up prompting to check an email

   The message contains the following text:

   *Someone has just requested to change the credentials for your OroCloud account. If this was you, please click on the link below to reset them.*

   *<LINK>*

   *This link will expire in 5 minutes.*

   *If you did not mean to reset your credentials, safely ignore this message. No changes will be applied.*

4. Follow the link and set your new password.

   .. image:: /cloud/img/cloud/change_password.png
      :alt: Update password flash message

5. Enter your personal SSH public key into Oro Identity Portal replacing the stub value created by the portal upon account generation.

   .. warning:: The stub SSH public key created with your account has to be replaced with the SSH key that you are going to use for SSH connection. If you do not change the key, you will not be able to log into your servers.

6. Click **Save**.

   You will receive a new email prompting you to confirm the password change.

7. Click on the link in the email to verify your new password and return to Oro Identity Portal.

Connect to the OroCloud Environment
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. Add VPN config file from the email sent by OroCloud support to your :ref:`VPN client configuration <cloud_connect_vpn>`.

2. Provide the username and the password specified in Oro Identity Portal.

   .. warning:: Do not modify the VPN config.

   .. image:: /cloud/img/cloud/vpn_authentication.png
      :alt: VPN authentication

3. Use any SSH client of your choice to connect with your OroCloud environment IP or hostname. Your SSH username can be found in Oro Identity Portal; it is the same as the username for OpenVPN.

Request Further Deployment and Configuration Services
-----------------------------------------------------

On top of deployment and configuration processes described in this topic, you may need to request our Support team to arrange implementation of other services and activities required before going live with your OroCloud solution. These activities may include:

* Configuring basic authentication for your OroCloud instance
* Configuring your back-office URL
* Migrating your database
* Installing software that does not come out-of-the-box
* Whitelisting email domains (for staging environments)
* Granting access to application logs
* Configuring Message Queue
* Configuring application resources
* Enabling availability check monitoring

Please refer to the :ref:`checklist of all OroCommerce Cloud application deployment and configuration activities <support-requests-further-app-deployment>` for task delivery estimates and information that you need to provide to the Support team to fulfil your requests. Please be aware that the checklist includes those activities that can only be completed by the Support Team, unless otherwise stated.

**What’s Next**

* :ref:`Connect OroCloud VPN <cloud_connect_vpn>`
* The guidance on using :ref:`OroCloud Maintenance Tools <cloud_maintenance>` for deployment and maintenance
* Technical :ref:`support <cloud_support>` service details (exclusions, priorities, SLA, etc).

