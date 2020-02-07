.. _demo-environment-gcp:

Google Cloud Platform
=====================

Google Cloud Platform enables you to deploy your Oro application instance in just one click without having to configure the software and settings manually.

The detailed guidance is provided further in this article.

Deploy the Solution
-------------------

1. Navigate to |Google Cloud Marketplace|, click **Explore Marketplace** and then search for your solution provided by Oro Inc.

   .. image:: /img/backend/setup/gcp/oro_solution.png
      :alt: A page of the Oro solution

2. Click **Launch on Compute Engine**.

3. The Oro solution deployment page displays the default settings (e.g., name, zone, machine type, boot disk type, networking interfaces, etc.). You can accept or customize them, if necessary.

    .. image:: /img/backend/setup/gcp/oro_solution_settings.png
       :alt: The details page of the Oro solution settings

4. You can also select the image version, with or without demo data. The application with demo data provides all the necessary information for you to test the application, such as a preconfigured list of customers, products, submitted orders, quotes, the structured master and web catalogs. You can also select a user to log into the storefront and browse the instance.

    .. image:: /img/backend/setup/gcp/oro_solution_image_version.png
       :alt: Selecting the image version

5. When complete, click **Deploy** on the bottom left to launch the deployment process.

Once the deployment is finished, you should see the following information:

    .. image:: /img/backend/setup/gcp/deployed_oro_solution.png
       :alt: The details page of the deployed Oro solution

Access the Oro Application
--------------------------

Use the generated credentials to access your Oro application:

* **Site Address** --- a link to your Oro application storefront (only for OroCommerce).
* **Admin URL** --- a link to your Oro application back-office
* **Admin user** --- a username used to log into the admin panel (back-office)
* **Admin password** - a password used to log into the admin panel (back-office)

Also, you can access the VM instance using SSH by clicking SSH and selecting the required option from the dropdown.

.. image:: /img/backend/setup/gcp/oro_solution_via_ssh.png
   :alt: Access the Oro application using SSH

You can always delete the deployment by clicking **Delete** on the upper left, next to the solution name. Resources created by this deployment, including VM instances, disks, and firewalls will be deleted as well.

.. image:: /img/backend/setup/gcp/oro_solution_delete.png
   :alt: Delete the deployment




.. include:: /include/include-links-dev.rst
   :start-after: begin
