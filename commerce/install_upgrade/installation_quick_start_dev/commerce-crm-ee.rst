.. _installation--orocommerce-crm-ee--readme:

.. include:: /install_upgrade/installation_quick_start_dev/common-ee-1.rst
   :start-after: begin_body
   :end-before: finish_body

Clone |oro_app_name| source code to the */usr/share/nginx/html/oroapp* folder:

.. code:: bash

   cd /usr/share/nginx/html
   git clone -b 3.0 https://github.com/oroinc/orocommerce-enterprise-application.git oroapp
   cd oroapp

..
   The *branch* value (*3.0* in this example) could be changed to any published
   `release tag <https://github.com/oroinc/orocommerce-enterprise-application/releases>`_ from 3.0 branch of
   the |oro_app_name| application (for example, 3.0, 3.0.1, etc.).

.. include:: /install_upgrade/installation_quick_start_dev/common-ee-2.rst
   :start-after: begin_body
   :end-before: finish_body

* :ref:`User Guide: Getting Started <user-guide--getting-started>`
* :ref:`User Guide: Commerce <user-guide>`
* :ref:`User Guide: Marketing <user-guide-marketing>`
* :ref:`User Guide: Business Intelligence <user-guide--business-intelligence>`
* :ref:`Storefront Guide <frontstore-guide>`
* :ref:`Developer Guide <dev-guide>`
* :ref:`Administration Guide <configuration--guide--landing--page>`

.. |oro_app_name| replace:: OroCommerce Enterprise Edition


.. _System Requirements: https://oroinc.com/b2b-ecommerce/doc/current/system-requirements
.. _Installation via UI: https://oroinc.com/b2b-ecommerce/doc/current/install-upgrade/installation/installation-via-UI


.. toctree::
   :includehidden:
   :titlesonly:
   :maxdepth: 1
   :hidden:

   service/index
