.. _installation--crm-ee--readme:

Quick Start Installation: OroCRM Enterprise Edition
===================================================

-  Clone the OroCRM Enterprise Edition repository:

   .. code:: bash

      git clone -b x.y.z https://github.com/oroinc/crm-enterprise-application.git

   where x.y.z is latest `release tag <https://github.com/oroinc/crm-enterprise-application/releases>`__.

   .. note:: To clone |main_app| version 2.6, run `git clone -b 2.6 https://github.com/oroinc/crm-enterprise-application.git`

.. include:: /install_upgrade/installation_quick_start_dev/common_process.rst
   :start-after: begin_body
   :end-before: finish_body

Loading Demo Data using CLI
~~~~~~~~~~~~~~~~~~~~~~~~~~~

To load sample data you need to run console command:

.. code:: bash

    php app/console oro:migration:data:load --fixtures-type=demo --env=prod

.. include:: /install_upgrade/installation_quick_start_dev/common.rst
   :start-after: begin_body
   :end-before: finish_body

.. |db_name| replace:: *oro_crm*

.. |main_app| replace:: OroCRM Enterprise Edition
