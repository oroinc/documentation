.. _demo-environment-devbox:

Oro Devbox VM
=============

Google Cloud Platform enables you to deploy your Oro Devbox instance in just one click without manually configuring the software and settings.

Detailed guidance is provided further in this article.

Deploy the Solution
-------------------

1. Navigate to |Google Cloud Marketplace|, click **Explore the marketplace** and then search for the Oro Devbox solution provided by Oro Inc.

2. Click **Launch on Compute Engine**.

3. The Oro solution deployment page displays the default settings (e.g., name, zone, machine type, boot disk type, networking interfaces, etc.). You can accept or customize them if necessary.

    .. image:: /img/backend/setup/gcp/orodevbox-settings.png
       :alt: The details page of the OroDevbox solution settings

4. When complete, click **Deploy** on the bottom left to launch the deployment process.


Access the Oro Application
--------------------------

Use the generated credentials to access your Oro Devbox application:

* **Site Address** --- a link to your Oro Devbox application.
* **Developer user** --- a username used to log into the devbox application.
* **Developer password** - a password used to log into the devbox application.

Also, you can access the VM instance using SSH by clicking SSH and selecting the required option from the dropdown.

.. image:: /img/backend/setup/gcp/devbox-ssh.png
   :alt: Access the Oro application using SSH

You can delete the deployment by clicking **Delete** on the upper left, next to the solution name. Resources created by this deployment, including VM instances, disks, and firewalls will be deleted as well.

.. image:: /img/backend/setup/gcp/devbox-delete.png
   :alt: Delete the deployment


.. include:: /include/include-links-dev.rst
   :start-after: begin
