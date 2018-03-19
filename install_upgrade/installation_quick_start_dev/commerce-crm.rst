.. _installation--orocommerce-crm-ce--readme:

Quick Start Installation: OroCommerce Community Edition
=======================================================

-  Clone https://github.com/orocommerce/orocommerce-application.git repository with:

   .. code:: bash

      git clone -b x.y.z https://github.com/orocommerce/orocommerce-application.git

   where x.y.z is the latest `release tag <https://github.com/oroinc/orocommerce-application/releases>`__.

.. begin_general_commerce_body

.. include:: /install_upgrade/installation_quick_start_dev/common_process.rst
   :start-after: begin_body
   :end-before: finish_p1


-  On some systems it might be necessary to temporarily increase **memory_limit** setting to *1 GB* in *php.ini* configuration file for the duration of the installation process:

   .. code:: ini

      memory_limit=1024M

   .. note:: After the installation is finished the memory_limit configuration can be changed back to the recommended value (512 MB or more).

-  Install the application and create the admin user with the web installation wizard by opening install.php in the browser or running the following CLI command:

   .. code:: bash

      php app/console oro:install --env=prod

   .. note:: If the installation process times out, add the `--timeout=0` argument to the `oro:install` command.

.. include:: /install_upgrade/installation_quick_start_dev/common_process.rst
   :start-after: begin_p2
   :end-before: finish_body

.. include:: /install_upgrade/installation_quick_start_dev/common.rst
   :start-after: begin_body
   :end-before: finish_body

.. finish_general_commerce_body

.. |db_name| replace:: *b2b_crm_dev*

.. |main_app| replace:: OroCommerce Community Edition