.. _setup-dev-env-docker-symfony_windows:

Set up Environment for OroPlatform Based Application on Windows Subsystem for Linux (WSL) 2
===========================================================================================

This guide demonstrates how to set up :ref:`Docker and Symfony Server development stack <setup-dev-env-docker-symfony>` for Oro applications on Windows 10, version 1903 or higher. Please make sure you have the latest version of the Windows OS before you start.

Environment Setup
-----------------

1. Install |Ubuntu 20.04 LTS from the Microsoft Store| to use with WSL 2. Alternatively, you can install it with a WSL command ``wsl --install -d Ubuntu``, followed by ``wsl --set-version Ubuntu 2``

2. Install |Windows Terminal|. It is not required to use a Windows Terminal/Powershell but we recommend using it as it comes with the built-in WSL integration. Please make sure that you run your windows terminal as an administrator. You may be prompted to reboot your PC after installation.

   .. image:: /img/backend/setup/wsl/terminal-successfull-installation.png
      :alt: An example of a successful installation of Windows Terminal

   If you encounter an error during installation, please follow the link provided in the terminal to troubleshoot the issue or refer to the |official Microsoft WSL documentation|:

   .. image:: /img/backend/setup/wsl/terminal-error.png
      :alt: An example of an error during terminal installation

   Once rebooted, create a new NIX username and password to log into Ubuntu.

   .. image:: /img/backend/setup/wsl/logged-in-ubuntu.png
      :alt: An example of terminal messages displayed once you log into ubuntu

   To switch to Ubuntu on your Windows Powershell, click on the dropdown next to the **+** tab and select Ubuntu from the list.

   .. image:: /img/backend/setup/wsl/powershell-ubuntu-dropdown-list.png
      :alt: Ubuntu option in the Powershell dropdown

   To avoid switching to Ubuntu manually every time, you can set up your Windows Powershell to run Ubuntu by default on startup. For this, navigate to your Windows settings > Startup and change the **Default Profile** to *Ubuntu*, as illustrated in the screenshot below:

   .. image:: /img/backend/setup/wsl/ubuntu-on-powershell.png
      :alt: Change default terminal profile to Ubuntu

   As WSL integration does not always work well with the Windows file system, go to the Linux file system by typing in ``cd`` in the terminal:

   .. image:: /img/backend/setup/wsl/switch-to-linux-filesystem.png
      :alt: An example of switching to the Linux file system

3. Install |Docker Desktop for Windows|. During installation, make sure that the checkbox for *Install required Windows components for WSL 2* is selected. Reboot your PC once the installation is finished.

   .. image:: /img/backend/setup/wsl/docker-installation-wsl2.png
      :alt: Checkbox for *Install required Windows components for WSL 2* is selected

4. Enable |Docker Desktop WSL 2 backend| for the Ubuntu 20.04 LTS distribution that you installed at step 1.

   * In the **General Settings** of the Docker application, make sure that *Use the WSL 2 based engine* option is selected.
   * In the **Resources > WSL Integration** settings, enable option *Ubuntu*. Apply all changes and restart Docker.

   .. image:: /img/backend/setup/wsl/docker-wsl2-config.png
      :alt: Configure WSL 2 on the docker side


5. Log into Ubuntu 20.04 LTS using Windows Terminal. All the below commands will be executed in it.

6. Install PHP 8.3 with all required extensions to Ubuntu 20.04 LTS:

   .. hint::  It is recommended to run all commands one by one to make sure they exit successfully and avoid missing potential warnings. If you have unreliable connection leading to command failure, please rerun it.

   .. code-block:: none

      sudo apt install software-properties-common
      sudo add-apt-repository -y ppa:ondrej/php
      sudo apt update
      sudo apt -y install php8.3 php8.3-fpm php8.3-cli php8.3-pdo php8.3-mysqlnd php8.3-xml php8.3-soap php8.3-gd php8.3-zip php8.3-intl php8.3-mbstring php8.3-opcache php8.3-curl php8.3-bcmath php8.3-ldap php8.3-pgsql php8.3-dev php8.3-mongodb

  You will be prompted to type in your password as you are running the commands as a sudo user.

7. Configure PHP:

   .. code-block:: none

      echo -e "memory_limit = 2048M \nmax_input_time = 600 \nmax_execution_time = 600 \nrealpath_cache_size=4096K \nrealpath_cache_ttl=600 \nopcache.enable=1 \nopcache.enable_cli=0 \nopcache.memory_consumption=512 \nopcache.interned_strings_buffer=32 \nopcache.max_accelerated_files=32531 \nopcache.save_comments=1" | sudo tee -a  /etc/php/8.3/fpm/php.ini
      echo -e "memory_limit = 2048M" | sudo tee -a  /etc/php/8.3/cli/php.ini

8. Install Node.js 20:

   .. code-block:: none

      sudo apt -y install curl dirmngr apt-transport-https lsb-release ca-certificates
      curl -sL https://deb.nodesource.com/setup_16.x | sudo -E bash -
      sudo apt -y install nodejs

9. Install Composer:

   .. code-block:: none

      php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && php composer-setup.php
      php -r "unlink('composer-setup.php');"
      sudo mv composer.phar /usr/bin/composer

10. Install Symfony Server:

    .. code-block:: none

       sudo apt -y install libnss3-tools
       wget https://get.symfony.com/cli/installer -O - | bash
       echo 'PATH="$HOME/.symfony/bin:$PATH"' >> ~/.bashrc
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


11. Configure the network. WSL 2 changes the way networking is configured compared to WSL 1. You need to enable proxy of traffic to permit the traffic through the Windows firewall.

    Run in Ubuntu ``ip addr | grep eth0`` to see the IP address of the WSL 2 virtual machine.

    .. image:: /img/backend/setup/wsl/ip-addr-ubuntu.png
       :alt: IP address of WSL 2 virtual machine

    Map WSL 2 port to the internal host ``netsh interface portproxy add v4tov4 listenport=8000 listenaddress=0.0.0.0 connectport=8000 connectaddress=172.22.33.170``.

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

12. Restart the terminal and the web browser to get them ready.

What's Next
-----------

* :ref:`Tips and Recommendations <setup-dev-env-docker-symfony-recommendations>`
* :ref:`Installation of the Oro Application via the Command-Line Interface <setup-dev-env-docker-symfony-install-application>`
* Consider using the Visual Studio Code or PhpStorm with the built-in WSL integration for development.

.. include:: /include/include-links-dev.rst
   :start-after: begin
