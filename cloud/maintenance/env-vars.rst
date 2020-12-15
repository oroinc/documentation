:oro_show_local_toc: false

.. _orocloud-maintenance-env-vars:

How to Add/Remove Environment Variables
=======================================

|Environment variable| can be configured for application usage, as illustrated below:

.. code-block:: none
   :linenos:

    ---
    orocloud_options:
      application:
        env_vars:
          'var1': 'value1'
          'var1': 'value2'
          'varN': 'valueN'

* **env_vars** — the hash where the key is an environment variable name, and the value is the environment variable value.

.. _cloud-environment-type-based-configuration:

How to Configure Environment Type Based Application
---------------------------------------------------

.. code-block:: none
   :linenos:

    ---
    orocloud_options:
      application:
        env_vars:
          'ORO_DEPLOYMENT_TYPE': 'local'

* **local** - deployment_type, which will be set to parameters.yml for your deployed application as

.. code-block:: none
   :linenos:

    deployment_type: local

.. note:: For more details on the environment type based application configuration, please see the |related documentation in the backend developer guide|.

.. include:: /include/include-links-cloud.rst
   :start-after: begin
