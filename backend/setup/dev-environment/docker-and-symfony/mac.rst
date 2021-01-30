.. _setup-dev-env-docker-symfony_mac:

Setup on Mac OS X
=================

This guide demonstrates how to set up :ref:`Docker and Symfony Server development stack <setup-dev-env-docker-symfony>` for Oro applications on Mac OS X.

Environment Setup
-----------------

1. Install Homebrew package manager to manage all the required software from CLI:

   .. code-block:: bash

      /bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install.sh)"

2. Install Docker and start the Docker deamon:

   .. code-block:: bash

      brew cask install docker
      open /Applications/Docker.app

3. Install PHP 7.4, Composer, Node.js 14 and Docker Compose:

   .. code-block:: bash

      brew install php@7.4 composer node docker-compose
      echo 'export PATH="/usr/local/opt/php@7.4/bin:$PATH" \nexport PATH="/usr/local/opt/php@7.4/sbin:$PATH" \nexport PATH="/usr/local/opt/node@12/bin:$PATH"' >> ~/.bash_profile

4. If you going to use an Enterprise Edition of the application, install and enable the mongodb php extension:

   .. code-block:: bash

      pecl install mongodb
      echo "extension=\"mongodb.so\"" >> /usr/local/etc/php/7.4/php.ini

5. Configure PHP:

   .. code-block:: bash

      echo "memory_limit = 2048M \nmax_input_time = 600 \nmax_execution_time = 600 \nrealpath_cache_size=4096K \nrealpath_cache_ttl=600 \nopcache.enable=1 \nopcache.enable_cli=0 \nopcache.memory_consumption=512 \nopcache.interned_strings_buffer=32 \nopcache.max_accelerated_files=32531 \nopcache.save_comments=1" >> /usr/local/etc/php/7.4/php.ini

6. Install Symfony Server and enable TLS:

   .. code-block:: bash

      curl -sS https://get.symfony.com/cli/installer | bash
      echo 'export PATH="$HOME/.symfony/bin:$PATH"' >> ~/.bash_profile
      source ~/.bash_profile
      symfony local:server:ca:install

6. Restart the terminal and web browser to get them ready.

What's Next
-----------

* :ref:`Follow the recommendations <setup-dev-env-docker-symfony-recommendations>`
* :ref:`Install the Oro Application via the Command-Line Interface <setup-dev-env-docker-symfony-install-application>`
