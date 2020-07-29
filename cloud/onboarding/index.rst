:orphan:

:title: OroCloud 4.1 Onboarding Process

.. meta::
   :description: Instructions on the OroCloud onboarding process before the Oro application deployment

.. _cloud_onboarding:

Onboarding
==========

This topic details the onboarding process between you and our customer support team before your Oro application deployment begins.

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


.. note:: For more information on using the support portal, see the :ref:`Support <cloud_support>` section.


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

**Related Articles**


* :ref:`Domain Name and SSL Certificate for OroCloud Environment <ssl-certificate>`

* :ref:`SSH Access <public-identity-management-ssh>`

* :ref:`SMTP for OroCloud Applications <orocloud-smtp>`



.. include:: /include/include-links-cloud.rst
   :start-after: begin


.. toctree::
   :hidden:
   :maxdepth: 1

   domain-name-ssl
   ssh-access
   smtp