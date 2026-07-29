.. _setup-dev-env-docker-symfony_windows:

Set up Environment for OroPlatform Based Application on Windows Subsystem for Linux (WSL) 2
===========================================================================================

This guide demonstrates how to set up :ref:`Docker and Symfony Server development stack <setup-dev-env-docker-symfony>` for Oro applications on Windows 10, version 1903 or higher. Please make sure you have the latest version of the Windows OS before you start.

Environment Setup
-----------------

1. Install |a supported Ubuntu LTS release| for WSL 2. Run the following command from Windows PowerShell or Windows Terminal:

   .. code-block:: powershell

      wsl --install -d Ubuntu

   To verify that the distribution is using WSL 2, run:

   .. code-block:: powershell

      wsl --list --verbose

   If the Ubuntu distribution is using WSL 1, upgrade it to WSL 2 by running:

   .. code-block:: powershell

      wsl --set-version <distribution-name> 2

   Replace ``<distribution-name>`` with the name of your installed distribution as shown by ``wsl --list --verbose``.

2. Install |Windows Terminal|. While not required, we recommend using it as it comes with the built-in WSL integration. Run Windows Terminal as an administrator. You may be prompted to reboot your PC after installation.

   .. image:: /img/backend/setup/wsl/terminal-successfull-installation.png
      :alt: An example of a successful installation of Windows Terminal

   If you encounter an error during installation, please follow the link provided in the terminal to troubleshoot the issue or refer to the |official Microsoft WSL documentation|:

   .. image:: /img/backend/setup/wsl/terminal-error.png
      :alt: An example of an error during terminal installation

   Once rebooted, create a new UNIX username and password to log into Ubuntu.

   .. image:: /img/backend/setup/wsl/logged-in-ubuntu.png
      :alt: An example of terminal messages displayed once you log into ubuntu

   To switch to Ubuntu on your Windows Powershell, click on the drop-down next to the **+** tab and select Ubuntu from the list.

   .. image:: /img/backend/setup/wsl/powershell-ubuntu-dropdown-list.png
      :alt: Ubuntu option in the PowerShell drop-down

   To avoid switching to Ubuntu manually every time, you can set up your Windows PowerShell to run Ubuntu by default on startup. For this, navigate to your Windows settings > Startup and change the **Default Profile** to *Ubuntu*, as illustrated in the screenshot below:

   .. image:: /img/backend/setup/wsl/ubuntu-on-powershell.png
      :alt: Change default terminal profile to Ubuntu

   As WSL integration does not always work well with the Windows file system, go to the Linux file system by typing in ``cd`` in the terminal:

   .. image:: /img/backend/setup/wsl/switch-to-linux-filesystem.png
      :alt: An example of switching to the Linux file system

3. Install |Docker Desktop for Windows|. After the installation is complete, open Docker Desktop and verify that **Settings > General > Use the WSL 2 based engine** is enabled. Reboot your PC if prompted during the installation.

   .. image:: /img/backend/setup/wsl/docker-installation-wsl2.png
      :alt: Docker Desktop installation

4. Enable |Docker Desktop WSL 2 backend| for the Ubuntu distribution that you installed in step 1.

   * In the **General Settings** of the Docker application, make sure that *Use the WSL 2 based engine* option is selected.
   * In **Resources > WSL Integration**, enable WSL integration for the Ubuntu distribution and restart Docker Desktop.

   .. image:: /img/backend/setup/wsl/docker-wsl2-config.png
      :alt: Configure WSL 2 on the docker side


5. Log into the Ubuntu distribution using Windows Terminal. Run all remaining commands in the Ubuntu terminal unless instructed otherwise.

6. Install PHP 8.5 and the required extensions in Ubuntu:

   .. hint::  It is recommended to run all commands one by one to make sure they exit successfully and avoid missing potential warnings. If you have unreliable connection leading to command failure, please rerun it.

   .. code-block:: none

      sudo apt install software-properties-common
      sudo add-apt-repository -y ppa:ondrej/php
      sudo apt update
      sudo apt -y install php8.5 php8.5-fpm php8.5-cli php8.5-pdo php8.5-mysqlnd php8.5-xml php8.5-soap php8.5-gd php8.5-zip php8.5-intl php8.5-mbstring php8.5-curl php8.5-bcmath php8.5-ldap php8.5-pgsql php8.5-mongodb

  You will be prompted to type in your password as you are running the commands as a sudo user.

7. Configure PHP:

   .. code-block:: none

      echo -e "memory_limit = 2048M \nmax_input_time = 600 \nmax_execution_time = 600 \nrealpath_cache_size=4096K \nrealpath_cache_ttl=600 \nopcache.enable=1 \nopcache.enable_cli=0 \nopcache.memory_consumption=512 \nopcache.interned_strings_buffer=32 \nopcache.max_accelerated_files=32531 \nopcache.save_comments=1" | sudo tee -a  /etc/php/8.5/fpm/php.ini
      echo -e "memory_limit = 2048M" | sudo tee -a  /etc/php/8.5/cli/php.ini

8. Install Node.js 24:

   .. code-block:: none

      sudo apt -y install curl dirmngr apt-transport-https lsb-release ca-certificates
      curl -sL https://deb.nodesource.com/setup_24.x | sudo -E bash -
      sudo apt -y install nodejs

9. Install PNPM 10 Using NPM:

   .. code-block:: none

        npm install -g pnpm@latest-10

   .. note:: If the installation fails because of insufficient permissions, rerun the command with ``sudo``.

10. Install Composer:

   .. code-block:: none

      php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && php composer-setup.php
      php -r "unlink('composer-setup.php');"
      sudo mv composer.phar /usr/bin/composer

11. Install Symfony Server:

    .. code-block:: none

       sudo apt -y install libnss3-tools
       wget https://get.symfony.com/cli/installer -O - | bash
       echo 'export PATH="$HOME/.symfony5/bin:$PATH"' >> ~/.bashrc
       source ~/.bashrc
       symfony server:ca:install

    You can also enable TLS, but as Symfony Server does not automate certificate installation for WSL on Windows, you have to copy the generated certificate manually from the ``/usr/local/share/ca-certificates/`` folder to the host filesystem and install it manually to your web browser:

    .. image:: /img/backend/setup/wsl/symfony-certificate-1.png
       :alt: An illustration of copying the generated certificate manually from the ``/usr/local/share/ca-certificates/`` folder to the host filesystem

    An example of importing a certificate in Chrome:

    .. image:: /img/backend/setup/wsl/chrome-certificates-2.png
       :alt: Opening certificates in Chrome settings

    .. image:: /img/backend/setup/wsl/import-certificate-3.png
       :alt: Importing certificate to Chrome


12. Configure the network. WSL 2 changes the way networking is configured compared to WSL 1. You must enable traffic proxying to permit traffic through the Windows firewall.

    Before you continue, open **PowerShell** as an administrator. Right-click **PowerShell** and select **Run as administrator**, or run the following command from a terminal to launch an elevated PowerShell window:

    .. code-block:: powershell

       Start-Process powershell -Verb RunAs

    Approve the User Account Control (UAC) prompt when prompted. The ``netsh interface portproxy`` and ``netsh advfirewall`` commands require administrator privileges.

    Run the following command in Ubuntu to obtain the IP address of the WSL 2 virtual machine:

    .. code-block:: bash

       ip addr | grep eth0

    .. image:: /img/backend/setup/wsl/ip-addr-ubuntu.png
       :alt: IP address of WSL 2 virtual machine

    Map the WSL 2 port to the internal host:

    .. code-block:: powershell

       netsh interface portproxy add v4tov4 listenport=8000 listenaddress=0.0.0.0 connectport=8000 connectaddress=172.22.33.170

    .. note:: The IP address assigned to the WSL 2 virtual machine can change after Windows or WSL restarts. If the forwarded port stops working, obtain the current IP address again and update the ``connectaddress`` value in the ``netsh interface portproxy`` command.

    Configure Windows Defender Firewall, as illustrated below:

    .. image:: /img/backend/setup/wsl/firewall-1.png
       :alt: Configure Windows Defender Firewall step 1

    .. image:: /img/backend/setup/wsl/firewall-2.png
       :alt: Configure Windows Defender Firewall step 2

    .. image:: /img/backend/setup/wsl/firewall-3.png
       :alt: Configure Windows Defender Firewall step 3

    .. image:: /img/backend/setup/wsl/firewall-4.png
       :alt: Configure Windows Defender Firewall step 4

    .. image:: /img/backend/setup/wsl/firewall-5.png
       :alt: Configure Windows Defender Firewall step 5

    .. image:: /img/backend/setup/wsl/firewall-6.png
       :alt: Configure Windows Defender Firewall step 6

13. Restart the terminal and the web browser to get them ready.

What's Next
-----------

* :ref:`Tips and Recommendations <setup-dev-env-docker-symfony-recommendations>`
* :ref:`Installation of the Oro Application via the Command-Line Interface <setup-dev-env-docker-symfony-install-application>`
* Consider using the Visual Studio Code or PhpStorm with the built-in WSL integration for development.

.. include:: /include/include-links-dev.rst
   :start-after: begin
