.. _environment-type-based-configuration:

Environment Type Based Application Configuration
================================================

Use different default configurations based on the environment where the application is deployed:

* :ref:`Production Environment <cloud-environments-production>`
* :ref:`Development Environment <cloud-environments-development>`
* :ref:`Testing Environment <cloud-environments-testing>`
* :ref:`Staging Environment <cloud-environments-staging>`
* Local Development Machine
* etc.

Deployment type (``deployment_type``) is one of the options in **parameters.yml** file, and it is asked during ``composer install``.

      .. code-block:: text
          :linenos:

            # config/parameters.yml

            parameters:
                # ...
                deployment_type: null

To start using deployment type, change value ``deployment_type: <type>`` in *config/parameters.yml* and create a config file in *config/deployment/config_<type>.yml*.

This configuration will have the highest priority.

For example:

      .. code-block:: text
          :linenos:

                # config/parameters.yml

                parameters:
                    # ...
                    deployment_type: local

      .. code-block:: text
          :linenos:

                # config/deployment/config_local.yml

                monolog:
                    handlers:
                        # your additional monolog configuration

.. include:: /include/include-links-dev.rst
   :start-after: begin

