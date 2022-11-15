.. _setup-dev-env-docker-symfony_ubuntu:

Set up Environment for OroPlatform Based Application on Ubuntu 20.04
====================================================================

This guide demonstrates how to set up :ref:`Docker and Symfony Server development stack <setup-dev-env-docker-symfony>` for Oro applications on Ubuntu 20.04 LTS.

Environment Setup
-----------------

1. Install PHP 7.4 with all required extensions:

   .. code-block:: bash

      sudo apt -y install php php-fpm php-cli php-pdo php-mysqlnd php-xml php-soap php-gd php-zip php-intl php-mbstring php-opcache php-curl php-bcmath php-ldap php-pgsql

2. Install Node.js 14:

   .. code-block:: bash

      sudo apt -y install curl dirmngr apt-transport-https lsb-release ca-certificates
      curl -sL https://deb.nodesource.com/setup_14.x | sudo -E bash -
      sudo apt -y install nodejs

3. Install Docker and Docker Compose:

   .. code-block:: bash

      sudo apt -y install docker.io docker-compose
      sudo usermod -aG docker $(whoami)
      sudo systemctl enable --now docker

4. Install Composer v1:

   .. code-block:: bash

      php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && php composer-setup.php
      php -r "unlink('composer-setup.php');"
      sudo mv composer.phar /usr/bin/composer
      composer self-update --1

5. Install Symfony Server and enable TLS:

   .. code-block:: bash

      sudo apt -y install libnss3-tools
      wget https://get.symfony.com/cli/installer -O - | bash
      echo 'PATH="$HOME/.symfony/bin:$PATH"' >> ~/.bashrc
      source ~/.bashrc
      symfony server:ca:install

6. Restart the terminal and web browser to get them ready.


.. admonition:: Business Tip

   Digital technologies are gradually being adopted by manufacturing companies. Learn how eCommerce can help you achieve |digitalization in manufacturing|.


What's Next
-----------

* :ref:`Follow the recommendations <setup-dev-env-docker-symfony-recommendations>`
* :ref:`Install the Oro Application via the Command-Line Interface <setup-dev-env-docker-symfony-install-application>`



.. include:: /include/include-links-seo.rst
   :start-after: begin