.. _orocloud-maintenance-patches:

How to Apply Patches
====================

Apply Patches During Deployment
-------------------------------

To unify the process of applying patches during application deployment, the maintenance agent is configured to do it once the code is deployed and the composer install is completed.

.. code-block:: yaml

    deployment:
        after_composer_install_commands:
           - bash -c 'if [[ -d patch ]]; then ls patch | grep ".patch$" | xargs -I{} bash -c "patch -p0 < patch/{}"; fi'

If you need to apply patches to the application, create a patch directory in the root repository location and insert in it appropriate files with the ".patch". extension

Keep in mind that if your application supports patch application on its own (for example via a specific bundle), you need to make sure there are no conflicts between these approaches and the same patch is not applied twice.  

..note:: Use the following command to make sure that the patch is correct and can be applied before deploying it into the production:

.. code-block:: bash

   patch -p0 < patch/file.patch

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
