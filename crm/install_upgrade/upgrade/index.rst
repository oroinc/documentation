Upgrade OroCRM to the Newer Version
===================================

To upgrade OroCRM to a newer version:

1. Pull changes from the repository:

   .. code:: bash

       git pull
       git checkout <VERSION TO UPGRADE>

2. Upgrade composer dependency:

   .. code:: bash

       php composer.phar install --prefer-dist --no-dev

3. Remove old caches and assets:

   .. code:: bash

       rm -rf app/cache/*
       rm -rf web/js/*
       rm -rf web/css/*

4. Upgrade platform:

   .. code:: bash

      oro:platform:update --env=prod --force