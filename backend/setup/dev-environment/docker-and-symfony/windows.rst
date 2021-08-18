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

   .. code-block:: none

      sudo apt install software-properties-common
      sudo add-apt-repository -y ppa:ondrej/php
      sudo apt update
      sudo apt -y install php7.4 php7.4-fpm php7.4-cli php7.4-pdo php7.4-mysqlnd php7.4-xml php7.4-soap php7.4-gd php7.4-zip php7.4-intl php7.4-mbstring php7.4-opcache php7.4-curl php7.4-bcmath php7.4-ldap php7.4-pgsql php7.4-dev php7.4-mongodb

7. Configure PHP:

   .. code-block:: none

      echo -e "memory_limit = 2048M \nmax_input_time = 600 \nmax_execution_time = 600 \nrealpath_cache_size=4096K \nrealpath_cache_ttl=600 \nopcache.enable=1 \nopcache.enable_cli=0 \nopcache.memory_consumption=512 \nopcache.interned_strings_buffer=32 \nopcache.max_accelerated_files=32531 \nopcache.save_comments=1" | sudo tee -a  /etc/php/7.4/fpm/php.ini
      echo -e "memory_limit = 2048M" | sudo tee -a  /etc/php/7.4/cli/php.ini

8. Install Node.js 12:

   .. code-block:: none

      sudo apt -y install curl dirmngr apt-transport-https lsb-release ca-certificates
      curl -sL https://deb.nodesource.com/setup_12.x | sudo -E bash -
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
