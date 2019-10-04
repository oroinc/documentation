.. _installation--orocommerce-ee-de--readme:

.. |oro_app_name| replace:: OroCommerce Enterprise Edition for Germany

OroCommerce Enterprise Edition for Germany
==========================================

.. include:: /developer/backend/setup/dev-environment/local-server-setup/manual-installation/commerce-ee.rst
   :start-after: begin_body_1
   :end-before: finish_body_1

.. _installation--orocommerce-ee-de--part-3:


Step 3: |oro_app_name| Application Installation
-----------------------------------------------

Get |oro_app_name| Source Code
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Create your new |oro_app_name| project with composer in the */usr/share/nginx/html/oroapp* folder:

.. code:: bash

   cd /usr/share/nginx/html
   composer create-project oro/commerce-crm-enterprise-application-de oroapp --repository=https://satis.oroinc.com
   cd oroapp

.. include:: /developer/backend/setup/dev-environment/local-server-setup/manual-installation/commerce-ee.rst
   :start-after: begin_body_2
   :end-before: finish_body_2




