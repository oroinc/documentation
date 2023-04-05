:oro_show_local_toc: false

.. _orocloud-maintenance-env-vars:

How to Add/Remove Environment Variables
=======================================

|Environment variable| can be configured for application usage, as illustrated below:

.. code-block:: none


    ---
    orocloud_options:
      application:
        env_vars:
          COMPOSER_AUTH:  '{"http-basic":{"example.org":{"username":"username","password":"password"}}'
          COMPOSER_AUTH1: '{"gitlab-oauth":{"gitlab.example.org":"ThisTokenIsNotSoSecretChangeIt"},"gitlab-domains":["gitlab.example.org"]}'
          COMPOSER_AUTH2: '{"gitlab-oauth":{"gitlab.com":"ThisTokenIsNotSoSecretChangeIt"}}'
          COMPOSER_AUTH3: '{"gitlab-token":{"gitlab.example.org":"ThisTokenIsNotSoSecretChangeIt"},"gitlab-domains":["gitlab.example.org"]}'
          COMPOSER_AUTH4: '{"gitlab-token":{"gitlab.com":"ThisTokenIsNotSoSecretChangeIt"}}'
          COMPOSER_AUTH5: '{"github-oauth":{"github.com":"ThisTokenIsNotSoSecretChangeIt"}}'

* **env_vars** — the hash where the key is an environment variable name, and the value is the environment variable value.

.. _cloud-environment-type-based-configuration:

How to Configure Environment Type Based Application
---------------------------------------------------

.. code-block:: none


    ---
    orocloud_options:
      application:
        env_vars:
          'ORO_DEPLOYMENT_TYPE': 'local'

* **local** - deployment_type, which will be set to parameters.yml for your deployed application as

.. code-block:: none


    deployment_type: local

.. note:: For more details, please see the :ref:`related documentation in the backend developer guide <setup-environment-variables>`.

.. warning:: Environment variables are always string and are not cast automatically to integer, null, or other types. You should never pass an empty environment variable, like 'ORO_DB_HOST=' or 'ORO_DB_HOST=NULL'. Instead, it should never be available (never be set). More information about environment variables is available in the :ref:`parameters.yml description <installation--parameters-yml-description>` section.

.. include:: /include/include-links-cloud.rst
   :start-after: begin
