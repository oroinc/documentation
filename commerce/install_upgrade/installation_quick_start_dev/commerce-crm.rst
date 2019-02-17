.. _installation--orocommerce-crm-ce--readme:

.. include:: /install_upgrade/installation_quick_start_dev/common-ce-1.rst
   :start-after: begin_body
   :end-before: finish_body

Create your new |oro_app_name| project with composer in the */usr/share/nginx/html/oroapp* folder:

.. code:: bash

   cd /usr/share/nginx/html
   composer create-project oro/commerce-crm-application oroapp --repository=https://satis.oroinc.com
   cd oroapp

.. include:: /install_upgrade/installation_quick_start_dev/common-ce-2.rst
    :start-after: begin_body
    :end-before: finish_body

* :ref:`User Guide: Getting Started <user-guide--getting-started>`
* :ref:`User Guide: Commerce <user-guide>`
* :ref:`User Guide: Marketing <user-guide-marketing>`
* :ref:`User Guide: Business Intelligence <user-guide--business-intelligence>`
* :ref:`User Guide: Storefront <frontstore-guide>`
* :ref:`Developer Guide <dev-guide>`
* :ref:`Administration Guide <configuration--guide--landing--page>`

.. |oro_app_name| replace:: OroCommerce Community Edition

.. _System Requirements: https://oroinc.com/b2b-ecommerce/doc/current/system-requirements
.. _Installation via UI: https://oroinc.com/b2b-ecommerce/doc/current/install-upgrade/installation/installation-via-UI
