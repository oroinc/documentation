:orphan:

.. _cloud_onboarding:

Onboarding
----------

This topic details the communication steps and the information that should be shared between you and the customer support team before your Oro application deployment begins.

.. contents::
   :local:

Welcome Onboard
~~~~~~~~~~~~~~~

After you have signed an agreement with the Oro Inc. or one of Oro-authorized partners, you will get a *Welcome to Oro Enterprise* email that guides you through the following steps toward your Oro application going live.

You can refer to this email when you need the following information:

* Your license key (you may need it for support requests of any type)
* Contacts of  the financial department (for questions and inquiries related to the invoice and payment)
* Link to the Oro Inc. Support Desk (for technical questions and questions related to the deployment, application configuration, and use)
* Links to the useful resources with training and documentation.

Choose a Domain for the Application and Obtain an SSL Certificate
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

In the welcome email, you will be offered a default domain name for your OroCloud instance that is usually based on the customer name. If you would like to use a different domain, please, share that information in your reply to the welcome email or the customer support request.

.. note:: If you choose to use the domain you manage, your company’s authorized IT personnel should handle the DNS update after the application deployment or disaster recovery. Customer support team will provide you with the public IP address for DNS configuration once the deployment is complete.

Create an Account in Oro Inc. Support Desk
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Oro Inc. Support Desk is the main point of contact for any questions and issues related to your company’s OroCloud environment and application instance. To start using the customer support service, please, create an account on the Oro Inc. Support Desk.

.. note:: In your support requests, remember to provide your company’s name, the license key (if applicable), and the application version.

For more information on using the support portal, see the :ref:`Support <cloud_support>` section.

Get Access to the Oro application Enterprise Edition Source Code
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Once you purchase an Oro application license, in your `Welcome Onboard`_ email, you will get a link to the Oro application Enterprise Edition source code in GitHub.

To be able to access, clone and fork the repository, please request access for the necessary GitHub account via the Oro Inc. Support Desk by providing the GitHub usernames, first and last names, and emails of the accounts.

.. sample

You can use the source code from the repository to install Oro application in your local, staging, development and production environment, including OroCloud.

You can also fork and customize the Enterprise Edition of the Oro application source code, if necessary.
It is highly recommended to use only Long Term Support (LTS) versions for production environment. Check out the list of LTS versions and their release schedule in the relevant :ref:`Release and Support Cycle <doc--community--release>` article.


OroCloud Environment and Application Deployment
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

If you plan to deploy a custom Oro application from the forked or private repository, you will be requested to provide the custom repository address in ssh format (i.e. git@github.com:org/app.git), tag or branch that should be used for installation.

.. note:: For customized installation, please, ensure that your custom source code can run on the OroCloud. Use the guidelines provided in the `Validate The Customization Before Deployment to OroCloud`_ section. .

Support team will generate SSH keys and will share a public key with you. This key should be added as deployment key to your custom repository to authorize cloning the repository from the Oro application host in the cloud environment.

Once all the necessary information is collected and the necessary access permissions are granted, the environment of the :ref:`standard configuration <cloud_architecture>` is prepared, and the Oro application is installed using the repository, tag or branch you have specified, or with the latest LTS :ref:`released version <doc--community--release>` of the application if no customization is planned.

Once the installation is complete, the support team creates the first administrator in the Oro Application using the details collected during your onboarding.

Customer support will inform you of the successful installation and remind the VPN details and the general guidance on the available maintenance tools.

If later you happen to require a system update or customization, you may either perform it manually using the :ref:`OroCloud maintenance tools <cloud_maintenance>` and :ref:`Oro application upgrade <upgrade>` documentation or request the necessary changes using the Oro Inc. Support Desk.

Validate The Customization Before Deployment to OroCloud
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To verify that the custom Oro application meets the OroCloud requirements:

1. Ensure that:

   * `composer.json` includes `oro-redis` bundle version ~2.0, like in the following example:

     .. code-block:: none

        "require": {
           ....
           "oro/redis-config" : "~2.0"
           ....
        }

   * The `parameters.yml.dist` file contains no custom parameters. Any custom configuration should be handled in the **System > Configuration** UI.

   * There is no `parameters.yml` file in your repository.

2. Test your custom Oro application :ref:`installation <installation>` locally using the following environment:

   .. code-block:: none

      php 7.0.x or 5.6.x for versions below 1.6/2.6
      php 7.1 for versions starting 1.6/2.6
      MySQL 5.6 (for OroCRM) and PostgreSQL 9.6 (for OroCommerce)
      elasticsearch version 1.7.x (for Oro Platform 1.x) or 2.4.x (for Oro Platform 2.x)
      redis 3.*

SSH Access to the OroCloud Environment (Optional)
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

SSH access to OroCloud environment can be requested via the customer support portal. The request should include:

* First and last name(s) of the user(s), and their Organization(s)
* E-mail addresses of the user(s)
* User(s) public keys (a key should be created using the following command)

  .. code-block:: none

     ssh-keygen -t rsa -b 2048 -f /path/to/ keyfile.

See the *Before You Begin* section of the :ref:`OroCloud maintenance tools <cloud_maintenance>` topic for more information on how to generate the key.

Once the request is processed and the access is granted, you will be provided with username(s) that should be used for the connection. The users will receive emails with the VPN settings required for SSH access and a link to the OroCloud maintenance tools documentation.

**What’s Next**

* The guidance on using :ref:`OroCloud Maintenance Tools <cloud_maintenance>` for deployment and maintenance
* Technical :ref:`support <cloud_support>` service details (exclusions, priorities, SLA, etc).
