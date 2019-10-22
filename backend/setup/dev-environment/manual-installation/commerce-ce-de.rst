.. _installation--orocommerce-ce-de--readme:

OroCommerce Community Edition for Germany
=========================================

.. include:: /backend/setup/dev-environment/manual-installation/commerce-ce.rst
   :start-after: begin_body_1
   :end-before: finish_body_1

.. _installation--orocommerce-ce-de--part-3:

Step 3: |oro_app_name| Application Installation
-----------------------------------------------

Get Application Source Code
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Create your new |oro_app_name| project with composer in the */usr/share/nginx/html/oroapp* folder:

.. code:: bash

   cd /usr/share/nginx/html
   composer create-project oro/commerce-crm-application-de oroapp --repository=https://satis.oroinc.com
   cd oroapp

.. include:: /backend/setup/dev-environment/manual-installation/commerce-ce.rst
   :start-after: begin_body_2
   :end-before: finish_body_2


.. |oro_app_name| replace:: OroCommerce Community Edition for Germany
.. |recommended_OS| replace:: CentOS v7.4
