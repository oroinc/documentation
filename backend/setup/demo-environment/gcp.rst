.. _demo-environment-gcp:

.. warning:: OroCommerce VM for version 5.1 is no longer available on Google Marketplace. You can now deploy an image of the latest LTS version, as illustrated below.

Google Cloud Platform
=====================

Google Cloud Platform deploys your Oro application instance in one click, with no manual software or settings configuration.

OroCommerce VM images come with demo data so you can test the application right away. This includes a preconfigured list of customers, products, submitted orders, quotes, the structured master, and web catalogs.

You can also explore the storefront using one of the pre-configured demo user roles. Sign in as a guest user, as a buyer (use *BrandaJSanborn@example.org* as both login and password), or as a manager (use *AmandaRCole@example.org* as both login and password).

Deploy the Solution
-------------------

1. Navigate to |Google Cloud Marketplace|, click **Explore the marketplace** and then search for your solution provided by Oro Inc.

   .. image:: /img/backend/setup/gcp/oro_solution.png
      :alt: A page of the Oro solution

2. Click **Launch**.

3. The Oro solution deployment page displays the default settings (e.g., name, zone, machine type, boot disk type, networking interfaces, etc.). Accept them or customize them as needed.

   .. image:: /img/backend/setup/gcp/oro_solution_settings.png
      :alt: The details page of the Oro solution settings

4. When complete, click **Deploy** on the bottom left to launch the deployment process. Once the deployment is finished, you should see the following information:

   .. image:: /img/backend/setup/gcp/deployed_oro_solution.png
      :alt: The details page of the deployed Oro solution

Access the Oro Application
--------------------------

Use the generated credentials to access your Oro application:

* **Site Address** --- a link to your Oro application storefront (only for OroCommerce).
* **Admin URL** --- a link to your Oro application back-office.
* **Admin user** --- a username used to log into the admin panel (back-office).
* **Admin password** --- a password used to log into the admin panel (back-office).

You can also access the VM instance over SSH by clicking SSH and selecting the option you need from the drop-down.

.. image:: /img/backend/setup/gcp/oro_solution_via_ssh.png
   :alt: Access the Oro application using SSH

You can delete the deployment by clicking **Delete** on the upper left, next to the solution name. This also deletes the resources it created, including VM instances, disks, and firewalls.

.. image:: /img/backend/setup/gcp/oro_solution_delete.png
   :alt: Delete the deployment



.. include:: /include/include-links-dev.rst
   :start-after: begin
