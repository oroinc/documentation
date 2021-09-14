.. _setup-dev-env-docker-symfony_windows:

Set up Environment for OroPlatform Based Application on Windows Subsystem for Linux (WSL) 2
===========================================================================================

This guide demonstrates how to set up :ref:`Docker and Symfony Server development stack <setup-dev-env-docker-symfony>` for Oro applications on Windows 10, version 1903 or higher.

Environment Setup
-----------------

1. Install |Ubuntu 20.04 LTS from the Microsoft Store| that will be used with WSL 2.

2. Install |Windows Terminal|. It's not required to use a Windows Terminal but we recommend using it as it comes with the built-in WSL integration.

3. Install |Docker Desktop for Windows|.

4. Enable |Docker Desktop WSL 2 backend| for the Ubuntu 20.04 LTS distribution that you installed at step 1.

5. Log into Ubuntu 20.04 LTS using Windows Terminal. All the below commands will be executed in it.

6. Install PHP 7.4 with all required extensions to Ubuntu 20.04 LTS:

   .. code-block:: bash

      sudo apt install software-properties-common
      sudo add-apt-repository -y ppa:ondrej/php
      sudo apt update
      sudo apt -y install php7.4 php7.4-fpm php7.4-cli php7.4-pdo php7.4-mysqlnd php7.4-xml php7.4-soap php7.4-gd php7.4-zip php7.4-intl php7.4-mbstring php7.4-opcache php7.4-curl php7.4-bcmath php7.4-ldap php7.4-pgsql php7.4-dev

7. If you going to use an Enterprise Edition of the application, install and enable the mongodb php extension:

   .. code-block:: bash

      sudo pecl channel-update pecl.php.net
      sudo pecl install mongodb
      sudo echo extension=mongodb.so | sudo tee -a /etc/php/7.4/fpm/php.ini
      sudo echo extension=mongodb.so | sudo tee -a /etc/php/7.4/cli/php.ini

8. Install Node.js 14:

   .. code-block:: bash

      sudo apt -y install curl dirmngr apt-transport-https lsb-release ca-certificates
      curl -sL https://deb.nodesource.com/setup_14.x | sudo -E bash -
      sudo apt -y install nodejs

9. Install Composer:

   .. code-block:: bash

      php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && php composer-setup.php
      php -r "unlink('composer-setup.php');"
      sudo mv composer.phar /usr/bin/composer

10. Install Symfony Server:

   .. code-block:: bash

      sudo apt -y install libnss3-tools
      wget https://get.symfony.com/cli/installer -O - | bash
      echo 'PATH="$HOME/.symfony/bin:$PATH"' >> ~/.bashrc
      source ~/.bashrc
      symfony server:ca:install

.. note::
     You can also enable TLS, but as Symfony Server does not automate certificate installation for WSL on Windows, you will have to copy the generated certificate manually from the ``/usr/local/share/ca-certificates/`` folder to the host filesystem and install it manually to your web browser.


11. Restart the terminal and web browser to get them ready.

What's Next
-----------

* :ref:`Follow the recommendations <setup-dev-env-docker-symfony-recommendations>`
* :ref:`Install the Oro Application via the Command-Line Interface <setup-dev-env-docker-symfony-install-application>`
* For the development you can use the Visual Studio Code or PhpStorm with the built-in WSL integration.

.. include:: /include/include-links-dev.rst
   :start-after: begin
