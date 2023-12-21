.. _orocloud-maintenance-patches:

How to Apply Patches
====================

Apply Patches During Deployment
-------------------------------

To unify the process of applying patches during application deployment, the maintenance agent is configured to do it once the code is deployed and the composer install is completed.

If you need to apply patches to the application, create a `patch` directory in the root repository location and insert in it appropriate files with the `.patch` extension

Keep in mind that if your application supports patch application on its own (for example via a specific bundle), you need to make sure there are no conflicts between these approaches and the same patch is not applied twice.  

.. note:: Use the following command to make sure that the patch is correct and can be applied before deploying it into the production:

.. code-block:: bash

   patch -p0 < patch/file.patch

Composer Patches by CWeagans
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

This plugin provides a more controlled way to apply patches compared to the method described earlier.

Before installation, add the plugin to the list of allowed plugins in `composer.json` in the `config.allow-plugins` section:

.. code-block:: bash

   {
      ...
      "config": {
         ...
         "allow-plugins": {
            "cweagans/composer-patches": true,
            ...
         }
      },
      ...
   }

Installing the plugin is a straightforward process that involves installing a composer package within the project. Installation of the plugin itself is a simple composer package installation within the project:

.. code-block:: bash

   composer require cweagans/composer-patches

After installation, the plugin can be configured via `composer.json` to apply patches during deployment.

.. code-block:: bash

   {
     ...
     "extra": {
       "composer-exit-on-patch-failure": true,
       "enable-patching": true,
       "patches": {
         "oro/platform": {
            "Patch description": "patches/oro/platform/platform_patch_to_apply.patch",
            ...
         },
         ...
      }
      ...
   }

The `patches` node defines the `patches` group by package or project name, and `oro/platform` is the example value with no logic.

The easiest and most common way to group items is to briefly describe the patch and the patch path relative to the project's file root. Every patch must reference the affected files as a relative path to the project's files root.

Once you add and configure patches, it is essential to regenerate the corresponding `packages.lock.json` file.

.. code-block:: bash

   composer patches-relock

.. note::
        If a file other than `composer.json` is used, then a corresponding `[composer_json_filename]-package.lock.json` file will be created for it. It can be helpful to use composer files that are specifically tailored to different environments, such as `composer-stage.json` or `composer-uat.json`.

To ensure that patches are applied correctly, use the following command:

.. code-block:: bash

   composer patches-repatch

Please commit all lock files to the repository when all patches function correctly.

.. note:: To get additional details, please visit the project's official website and refer to the |Composer Patches| plugin documentation.

Apply Patches to a Deployed Application
---------------------------------------

In order to unify the process of applying patches during application deployment, the maintenance agent has the functionality for applying/reverting patches.

Use the following commands to work with patches:

* **patch:list** - shows the list of applied patches to the current application deployment

.. code-block:: none

   ➤ Executing task patch:list
    +---------------------+-----------------------------------------------------------------+
    | DATE                | FILE                                                            |
    +---------------------+-----------------------------------------------------------------+
    | 2021-11-03 15:14:54 | /mnt/ocom/app/persistent_shared/patch/20211016150803/test.patch |
    +---------------------+-----------------------------------------------------------------+

.. note:: Please note that the value in the ``FILE`` column is used for the `patch:revert` and `patch:view` commands as an argument.

* **patch:view** - shows the content of the specified patch, requires the full path to the patch file as an argument.

.. code-block:: none

   [ ~]$ orocloud-cli patch:view /mnt/ocom/app/persistent_shared/patch/20211016150803/test.patch
   ➤ Executing task patch:view
   [localhost]
   Index: web/app.php
   IDEA additional info:
   Subsystem: com.intellij.openapi.diff.impl.patch.CharsetEP
   <+>UTF-8
   ===================================================================
   --- web/app.php    (date 1536073001000)
   +++ web/app.php    (date 1539170812000)
   @@ -1,5 +1,9 @@
    <?php

   +echo 'testing patches';
   +die();
   +
   +
    use Symfony\Component\ClassLoader\ApcClassLoader;
    use Symfony\Component\HttpFoundation\Request;
   ✔ Ok

* **patch:apply**  - applies a patch. Requires the full path to the patch file as an argument (/mnt/maint-data is suggested), by default the command runs in DRY-RUN mode, which means that changes will not be applied, only validated. Passing the `--force` option causes the specified patch to be physically applied against your codebase.

* **patch:revert** - reverts a patch, requires the full path to the patch file as an argument (/mnt/maint-data is suggested), by default the command runs in DRY-RUN mode, which means that changes will not be applied, only validated. Passing the `--force` option causes the specified patch to be physically reverted against your codebase.

Usage examples:

* Revert by a patch, dry-run mode (only shows what will be done):

  .. code-block:: bash

     orocloud-cli patch:revert /mnt/ocom/app/persistent_shared/patch/20211016150803/test.patch

* Revert by a patch, force mode (patch will be physically reverted against your codebase):

  .. code-block:: bash

     orocloud-cli patch:revert /mnt/ocom/app/persistent_shared/patch/20211016150803/test.patch --force

.. include:: /include/include-links-cloud.rst
   :start-after: begin