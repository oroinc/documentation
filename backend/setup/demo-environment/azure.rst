.. _demo-environment-azure:

Azure Cloud Platform
====================

Azure Marketplace enables you to deploy pre-configured demo instances of the latest LTS releases of OroCRM and OroCommerce Community Editions with or without demo data.

To proceed with the installation, make sure you have registered with Azure marketplace and have a valid |Azure portal account|.

Deploy the Solution
-------------------

To deploy the solution, follow the steps below:

1. Navigate to |Azure Marketplace| and search for the required Oro application (OroCRM VM or OroCommerce VM) in the search bar.

   .. image:: /img/backend/setup/azure/search.png
      :alt: OroCRM VM or OroCommerce VM in Azure Marketplace search dropdown

2. Once you select the application type to deploy, click **GET IT NOW** under the application logo on your left.
3. In the pop-up dialog, select the software plan -- an instance with or without demo data. The application with demo data provides all the necessary information for you to test the application, such as a preconfigured list of customers, products, submitted orders, quotes, the structured master, and web catalogs.

   .. image:: /img/backend/setup/azure/software-plan.png
      :alt: Select the software plan pop-up dialog

4. Click **Continue**.

   You are redirected to Azure Portal to complete the installation.
   At this point, you are asked to log into Azure Portal if you have not already done so.

5. Once again, select the type of application to deploy.

6. Click **Create**.

   .. image:: /img/backend/setup/azure/create-vm.png
      :alt: Create a virtual machine of the selected type

7. Complete the required fields in the **Basics** tab:

    .. image:: /img/backend/setup/azure/basics-1.png
       :alt: Creating a VM - Basics tab

   * *Subscription* - Select your subscription type.
   * *Resource Group* - Create a new resource group, or select an existing one.

     A resource group is a container that holds related resources for an Azure solution. Resource group names only allow alphanumeric characters, periods, underscores, hyphens, and parentheses and cannot end in a period.

   * *Region* - Choose your region, e.g., (US) East US
   * *Virtual Machine Name* - Provide a virtual machine name.

     Virtual machines in Azure have two distinct names: a virtual machine name used as the Azure resource identifier and the guest hostname. When you create a VM in the portal, the same name is used for both the virtual machine and host names. You cannot change the virtual machine name after the VM is created. You can change the hostname when you log into the virtual machine.

   * *Username* - Provide a username for the virtual machine.
   * *Authentication type* - Choose whether to use a password or SSH public key for authentication.

     * For *password*, complete fields Username, Password, Confirm password
     * For *SSH public key*, complete fields Username and SSH public key

   * *Password* - Provide a password to the virtual machine.
   * *Confirm password* - Confirm the password to the virtual machine.
   * *Password for admin part* - Provide a password to log in to the web interface.
   * *Confirm password for admin part* - Confirm the password for the web interface.

8. Click **Virtual Machine Settings**. The fields are predefined with demo data.

   .. image:: /img/backend/setup/azure/basic-2.png
      :alt: Predefined Virtual Machine Settings

9. Click **Review+Create** to check the provided information. You should see **Running Final Validation**, followed by **Validation Passed**.

   .. image:: /img/backend/setup/azure/basics-3.png
      :alt: Review and validate

10. Click **Create** at the bottom.
11. Make sure the deployment is completed successfully.

    .. image:: /img/backend/setup/azure/deployment-complete.png
       :alt: Deployment complete notification

12. Click **Go to resource group**. DNS is already configured.

    .. image:: /img/backend/setup/azure/dns.png
       :alt: Configure DNS

21. Paste the DNS into the address bar of a new browser window, and add */admin* to the URL (e.g., `http://<DNSprefix>.cloudapp.azure.com/admin`).

    The Oro application interface should now be displayed.

    .. image:: /img/backend/setup/azure/admin-startup.png
       :alt: OroCommerce startup page

    .. important::

                   **OroCRM VM Demo Data**: If you have deployed OroCRM VM with demo data, use **admin** as login and the password to access the back-office of the application. To access the application via SSH, specify your username and password/public key, and restart services (`systemctl restart oro*`).

                   **OroCommerce VM Demo Data**: If you have deployed OroCommerce VM with demo data, use *AmandaRCole@example.org* both as your login and password to access the storefront (`http://<DNSprefix>.cloudapp.azure.com`). To access the back-office of the application (`http://<DNSprefix>.cloudapp.azure.com/admin/admin`), use *admin* as login and password. To access the application via SSH, specify your username and password or a public key, and restart services (`systemctl restart oro*`).

Configure Application URL
-------------------------

For the demo applications to work correctly, you need to configure the application URL (for OroCRM and OroCommerce), and Secure URL and URL (for OroCommerce).

1. Navigate to **System Configuration > General Setup > Application Settings** in the application back-office, and provide the *Application URL* (e.g., `http://<DNSprefix>.cloudapp.azure.com`, or a different domain).

   .. image:: /img/backend/setup/azure/change-app-url.png
      :alt: Change application URL in the configuration settings

3. (*For OroCommerce only*) Navigate to **System Configuration > Websites > Routing** in the application back-office, and provide *Secure URL* and *URL*.

   .. image:: /img/backend/setup/azure/secure-url.png
      :alt: Change secure url and url in the website routing configuration

4. Return to the Azure Portal, and click **Restart** to reboot the virtual machine.

   .. image:: /img/backend/setup/azure/restart-vm.png
      :alt: Restart VM

   Follow the restart progress in the notification bar on your top right.

5. Copy and paste the DNS into the address bar of a new browser window and press Enter.

   The storefront should now be displayed if you have deployed the OroCommerce application.

   .. note:: Due to |Azure blocking port 25|, we recommend configuring SMTP settings once you install the application if you would like to send messages from the Oro application you have deployed.







.. include:: /include/include-links-dev.rst
   :start-after: begin