Configuration in Different Environments
=======================================


A typical OroCloud project has at least 2 environments: “prod” and “stage”. The OroCloud application can be :ref:`configured using orocloud.yaml file <orocloud-maintenance-advanced-use>`.

Sometimes, a specific application configuration should be applied in one environment, but not in the other.
For example, assuming HTTP Basic Auth should be enabled only for the application in the stage environment. Below you can find three possible approaches to cover this case.

Environment Type Approach
-------------------------

The maintenance agent is merging three different yaml files to load it's configuration:


   .. code-block:: none

      /mnt/{ocom,ocrm}/app/orocloud.yaml
      /mnt/{ocom,ocrm}/app/www/orocloud.yaml
      /mnt/{ocom,ocrm}/app/www/orocloud_{dev,stag,uat,prod}.yaml


For example, `orocloud.yaml` file in the repository root contains common configuration for all environments:


   .. code-block:: none

      # cat orocloud.yaml
      orocloud_options:
        application:
          maintenance_page: 'relative/path/m.html'

and basic auth enabled in `dev` environment only using `orocloud_dev.yaml`:


   .. code-block:: none

      # cat orocloud_dev.yaml
      orocloud_options:
         webserver:
            locations:
               root:
               type: php
               location: '~ /index\.php(/|$)'
               auth_basic_enable: true
               auth_basic_userlist:
                  user:
                     ensure: present
                     password: pass

Git Branches Approach
---------------------

One of the solutions is to create different Git branches for different environments, taking the following steps:

1. Create a separate branch for each environment and save a unique version of the `orocloud.yaml` file in each branch.

   For example:

   .. code-block:: none


      1.2.3-prod   # Branch of release 1.2.3 for "prod" environment
      1.2.3-stage  # Branch of release 1.2.3 for "stage" environment

2. When preparing a new release, run a command with the `--reference` parameter depending on the environment.

   For example:

   .. code-block:: none


      # Run upgrade for "prod" environment
      orocloud-cli upgrade --reference=1.2.3-prod

      # Run upgrade for "stage" environment
      orocloud-cli upgrade --reference=1.2.3-stage

   This approach has some extra costs to maintain the additional branches in your repository. It is not always convenient if you prefer to use different tags for every new release.

Composer Script Approach
------------------------

You can solve this problem without adding new branches in the repository.

1. Check the hostnames of the maintenance nodes of the environments.

   For example:

   .. code-block:: none


      ocom-acme-prod1-maint1  # Maintenance node's hostname on "prod" environment
      ocom-acme-stage1-maint1 # Maintenance node's hostname on "stage" environment

2. Create configuration files in the repository root for each environment:

   .. code-block:: none


      orocloud.yaml           # Default configuration, could be same as orocloud.prod.yaml
      orocloud.prod.yaml      # Configuration for "prod" environment
      orocloud.stage.yaml     # Configuration for "stage" environment


3. Add changes to composer.json file to override the orocloud.yaml file depending on the hostname of the maintenance node during composer install:

   .. code-block:: none


     {
       ...
       "scripts": {
         ...
         "post-install-cmd": [
           ...
           "bash -c 'if [[ $(hostname -s) = *-stage[0-9]*-* ]]; then cp -f orocloud.stage.yaml orocloud.yaml; fi'",
           "bash -c 'if [[ $(hostname -s) = *-prod[0-9]*-* ]]; then cp -f orocloud.prod.yaml orocloud.yaml; fi'"
         ]
         ...
       }
       ...
     }

This approach works because every upgrade or deployment triggers the execution of composer install command on the maintenance node.

The default version of `orocloud.yaml` file is kept as a backup if the script is not executed as expected.

.. include:: /include/include-links-cloud.rst
   :start-after: begin
