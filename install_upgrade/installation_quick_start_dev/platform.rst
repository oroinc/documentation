.. _installation--platform--readme:

OroPlatform Community Edition
=============================

.. include:: /install_upgrade/installation_quick_start_dev/common-ce-1.rst
   :start-after: begin_body
   :end-before: finish_body

Create your new |oro_app_name| project with composer in the */usr/share/nginx/html/oroapp* folder:

.. code:: bash

   cd /usr/share/nginx/html
   composer create-project oro/platform-application oroapp --repository=https://satis.oroinc.com
   cd oroapp

.. include:: /install_upgrade/installation_quick_start_dev/common-ce-2.rst
   :start-after: begin_body
   :end-before: finish_body

* :ref:`User Guide: Getting Started <user-guide-into>`
* :ref:`Developer Guide <dev_guide>`
* :ref:`Administration Guide <user-guide-admin-tools>`

.. |oro_app_name| replace:: OroPlatform Community Edition

.. _System Requirements: https://oroinc.com/orocrm/doc/current/system-requirements
.. _Installation via UI: https://oroinc.com/orocrm/doc/current/install-upgrade/installation/installation-via-ui
