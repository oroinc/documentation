.. _installation--orocommerce-crm-ce--readme:

.. include:: /install_upgrade/installation_quick_start_dev/common-ce-1.rst
   :start-after: begin_body
   :end-before: finish_body

Clone |oro_app_name| source code to the */usr/share/nginx/html/oroapp* folder:

.. code:: bash

   cd /usr/share/nginx/html
   git clone -b 3.0-rc https://github.com/orocommerce/orocommerce-application.git oroapp
   cd oroapp

..
    The *branch* value (in this example *1.6*) could be changed to any published
    `release tag <https://github.com/oroinc/orocommerce-application/releases>`_ from 1.6 branch of
    the |oro_app_name| application (for example, 1.6, 1.6.1, etc.).

.. include:: /install_upgrade/installation_quick_start_dev/common-ce-2.rst
    :start-after: begin_body
    :end-before: finish_body

.. |oro_app_name| replace:: OroCommerce Community Edition

.. _System Requirements: https://oroinc.com/b2b-ecommerce/doc/current/system-requirements
.. _Installation via UI: https://oroinc.com/b2b-ecommerce/doc/current/install-upgrade/installation/installation-via-UI
