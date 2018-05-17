.. _installation--crm-ee--readme:

.. include:: /install_upgrade/installation_quick_start_dev/common-ee-1.rst
   :start-after: begin_body
   :end-before: finish_body

Clone |oro_app_name| source code to */usr/share/nginx/html/oroapp* folder:

.. code:: bash

   cd /usr/share/nginx/html
   git clone -b 1.6.9 https://github.com/oroinc/crm-enterprise-application.git oroapp
   cd oroapp

The *branch* value (*2.6.9* in this example) could be changed to any published
`release tag <https://github.com/oroinc/crm-enterprise-application/releases>`_ from 2.6 branch of
the |oro_app_name| application (for example, 2.6, 2.6.8, 2.6.9, etc.).

.. include:: /install_upgrade/installation_quick_start_dev/common-ee-2.rst
   :start-after: begin_body
   :end-before: finish_body

* :ref:`User Guide: Getting Started <user-guide-into>`
* :ref:`User Guide: Sales <user-guide-sales-index>`
* :ref:`User Guide: Marketing <user-guide-marketing>`
* :ref:`User Guide: Business Intelligence <business-intelligence>`
* :ref:`Developer Guide <dev_guide>`
* :ref:`Administration Guide <user-guide-admin-tools>`

.. |oro_app_name| replace:: OroCRM Enterprise Edition

.. _System Requirements: https://oroinc.com/orocrm/doc/current/system-requirements
.. _Installation via UI: https://oroinc.com/orocrm/doc/current/install-upgrade/installation/installation-via-ui

.. toctree::
   :includehidden:
   :titlesonly:
   :maxdepth: 1
   :hidden:

   service/index
