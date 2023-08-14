.. _setup-dev-env-docker-symfony_mac:

Set up Environment for OroPlatform Based Application on Mac OS X
================================================================

This guide demonstrates how to set up :ref:`Docker and Symfony Server development stack <setup-dev-env-docker-symfony>` for Oro applications on Mac OS X.

Environment Setup
-----------------

1. Install Homebrew package manager to manage all the required software from CLI:

   .. code-block:: none

      /bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install.sh)"

2. Install Docker and start the Docker daemon:

   .. code-block:: none

      brew cask install docker
      open /Applications/Docker.app

3. Install PHP 8.2, Composer, Node.js 18 and Docker Compose:

   .. code-block:: none

      brew install php@8.2 composer node docker-compose
      echo 'export PATH="/usr/local/opt/php@8.2/bin:$PATH" \nexport PATH="/usr/local/opt/php@8.2/sbin:$PATH" \nexport PATH="/usr/local/opt/node@18/bin:$PATH"' >> ~/.bash_profile

4. If you going to use an Enterprise Edition of the application, install and enable the mongodb php extension:

   .. code-block:: none

      pecl install mongodb
      echo "extension=\"mongodb.so\"" >> /usr/local/etc/php/8.2/php.ini

5. Configure PHP:

   .. code-block:: none

      echo "memory_limit = 2048M \nmax_input_time = 600 \nmax_execution_time = 600 \nrealpath_cache_size=4096K \nrealpath_cache_ttl=600 \nopcache.enable=1 \nopcache.enable_cli=0 \nopcache.memory_consumption=512 \nopcache.interned_strings_buffer=32 \nopcache.max_accelerated_files=32531 \nopcache.save_comments=1" >> /usr/local/etc/php/8.2/php.ini

6. Install Symfony Server and enable TLS:

   .. code-block:: none

      curl -sS https://get.symfony.com/cli/installer | bash
      echo 'export PATH="$HOME/.symfony/bin:$PATH"' >> ~/.bash_profile
      source ~/.bash_profile
      symfony local:server:ca:install

7. Restart the terminal and web browser to get them ready.

What's Next
-----------

* :ref:`Follow the recommendations <setup-dev-env-docker-symfony-recommendations>`
* :ref:`Install the Oro Application via the Command-Line Interface <setup-dev-env-docker-symfony-install-application>`
