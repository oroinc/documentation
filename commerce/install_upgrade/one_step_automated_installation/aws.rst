.. _aws_simple:

Run Oro Application on the AWS Cloud Platform with an Amazon Machine Image
==========================================================================

The `Amazon Machine Image (AMI) <https://docs.aws.amazon.com/AWSEC2/latest/UserGuide/AMIs.html>`_ with |oro_app_name| is
listed on the `Amazon Web Services Marketplace <https://aws.amazon.com/marketplace>`_. With its help, you can
effortlessly and quickly set up an instance with a working |oro_app_name| application on the
`Amazon EC2 <https://aws.amazon.com/ec2/>`_ platform, as described in details further in this article.

Deploying a single EC2 instance is helpful when you need to review Oro application features or use the out-of-the-box
uncustomized application version for low and medium traffic websites.

Every AMI (Amazon Machine Image) contains an installed Oro Application along with the LEMP stack:

.. csv-table::
   :widths: 10, 30

   "**OS**","Ubuntu v. 16.04 LTS"
   "**Web server**","Nginx v.1.10"
   "**Database**","MariaDB v.10"
   "**PHP**","PHP-FPM and PHP CLI v.7.1"
   "**Other tools**","NodeJS v.4.2, Git v.2.7.4, Composer v.1.6.3"

.. note: This deployment configuration is suitable for development or testing environments and for applications with a relatively small
    amount of data. For the description of the production environment for |oro_app_name| with large data, see the
    `Scalable Oro Application setup using Amazon Web Services`_ article.

.. contents:: Table of Contents
   :local:
   :depth: 1

Prerequisities
--------------

Before you proceed, make sure you have created an AWS user `account <https://aws.amazon.com/account/>`_.

Installation Steps
------------------

1. Sign in to the `AWS Management Console <https://console.aws.amazon.com/console/home>`_.

2. Open the `EC2 Dashboard <https://console.aws.amazon.com/ec2/v2/home>`_ page (the item **Services -> EC2** in the top menu).

The EC2 Dashboard enables you to observe and controll all information related to your AWS EC2 instances.

3. Click **Launch Instance**.

   .. image:: /install_upgrade/img/aws/EC2_dashboardh.png

This redirects you to the first step of the multi-step EC2 instance launching wizard.

4. To select the source for the AMI to run on the EC2 instance, click **AWS Marketplace** in the panel to the left.

Now you have to choose the source for the Amazon Machine Image that will be run on the EC2 instance.

   .. image:: /install_upgrade/img/aws/choose_an_ami.png

5. In the **Search AWS Marketplace Products** field, type in *Oro* and press **Enter**.

   .. image:: /install_upgrade/img/aws/aws_marketplace.png

A list of AMIs with all Oro applications is displayed.

6. Select the required AMI from the list and click **Select** (e.g. OroCommerce Community Edition with Demo Data).

   .. image:: /install_upgrade/img/aws/oro_amis.png

You are redirected to the description page of the selected AMI with the information on the application, a list of
suitable EC2 instance types, and more.

7. Click **Continue**.

   .. image:: /install_upgrade/img/aws/ami_desrciption.png

You are then redirected to the next step of the installation.

   .. image:: /install_upgrade/img/aws/select_ec2_instance_type.png

8. Select the checkbox next to the **m4.large** instance type and click **Review and Launch**.

.. note:: You can choose a different type of the EC2 cloud but make sure that it meets the Oro
    application :ref:`System Requirements <system-requirements>`.

Clicking **Review and Launch**  redirects you to the final installation step. Steps 3 to 6 are skipped as they contain
the reasonable preconfigured default values. Should you need to change the default values, return to Steps 3 to 6.

   .. image:: /install_upgrade/img/aws/step_7.png

9. Click **Launch** on the bottom right.

You are prompted to select an existing public or private key pair for the secure SSH access to your instance or create
a new key pair.

   .. image:: /install_upgrade/img/aws/select_a_key_pair.png

10. Click **Create a new key pair**, provide its name in the field and click **Download Key Pair**.

.. warning::  Store the downloaded .pem private key file in a secure and accessible location. If you lose the file, you
    will not be able to log into your EC2 instance using SSH.

11. Click **Launch Instances**.

You are then redirected to the **Launch Status** page where you can access the usage instructions, the software
management page and other helpful resources.

   .. image:: /install_upgrade/img/aws/launch_status.png

12. Click **View Instances** on the bottom right.

You are redirected to the **Instances** page with a list of your launched EC2 instances and the information on their
state and status.

13. Click on the required instance from the list to view its description on the bottom.

Below the launched instances list shown the detailed information about the selected instance.

   .. image:: /install_upgrade/img/aws/launching_instance.png

You will require the following information to access your instance:

.. csv-table::
   :widths: 10, 30

   "**Instance ID**","(e.g., i-02197201a92cd0470)"
   "**Public DNS**","(e.g., ec2-32-213-221-145.compute-1.amazonaws.com)"
   "**IPv4 Public IP**","(e.g., 32.103.121.166)"

Note this information down for further reference.

14. The instance setup is finished.

Once the **2/2 checks passed** status is displayed, you can run the application. For more information, see the `Usage`_
section below.

Usage
-----

Access the Oro Application
^^^^^^^^^^^^^^^^^^^^^^^^^^

To access your Oro application storefront, use the http://<PublicDNS>/ or http://<PublicIP>/ URLs.

To access the admin interface (management console), use the URLs http://<PublicDNS>/admin or http://<PublicIP>/admin
with username **admin** and AWS **<Instance ID>** as a password.

.. note:: Optionally, you can setup DNS service to put your domain name to the IP address and, therefore, you OroCommerce site will
    be accessible on your domain name URL.

Access with SSH
^^^^^^^^^^^^^^^

To connect to the EC2 instance using SSH, use the key pair file that you have downloaded previously and the ubuntu
**username**.

1. Change the directory to the one where the .pem key file is stored.

    .. code:: bash

        cd <.pem file storage directory>

2. Set permissions for the .pem file to 400.

    .. code:: bash

        chmod 400 <.pem file name>

3. Log into the EC2 instance with Oro Application.

    .. code:: bash

        ssh -i /path/to/file/filenamewithkeys.pem ubuntu@<Public IP>

    or

    .. code:: bash

        ssh -i /path/to/file/filenamewithkeys.pem ubuntu@<Public DNS>

For additional information, please see the AWS guide
`Connecting to Your Linux Instance Using SSH <https://docs.aws.amazon.com/AWSEC2/latest/UserGuide/AccessingInstancesLinux.html>`_.

Manage the EC2 Instance
^^^^^^^^^^^^^^^^^^^^^^^

With the help of the EC2 management console, you can:

- Create additional instances based on the Oro application AMIs
- Connect to the running instances using a Java SSH client directly from your browser
- Pause or terminate your EC2 instance

For detailed information about EC2 instances management features please see the AWS guide
`Getting Started with Amazon EC2 <https://aws.amazon.com/ec2/getting-started/>`_.

Key Reference Points
--------------------

**Guides:**

* :ref:`User Guide: Getting Started <user-guide--getting-started>`
* :ref:`User Guide: Commerce <user-guide>`
* :ref:`User Guide: Marketing <user-guide-marketing>`
* :ref:`User Guide: Business Intelligence <user-guide--business-intelligence>`
* :ref:`Storefront Guide <frontstore-guide>`
* :ref:`Developer Guide <dev-guide>`
* :ref:`Administration Guide <configuration--guide--landing--page>`

**Support:**

* `OroCommerce Community Forum <https://oroinc.com/b2b-ecommerce/forums>`_
* `Oro Community Slack Channel <https://orocommunity.slack.com/>`_

.. |oro_app_name| replace:: OroCommerce Community Edition
