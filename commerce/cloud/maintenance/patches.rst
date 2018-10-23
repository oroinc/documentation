.. _orocloud-maintenance-patches:

How to Apply Patches
====================

.. contents:: :local:
   :depth: 2

Apply Patches During Deployment
-------------------------------

To unify the process of applying patches during application deployment, the maintenance agent is configured to do it once the code is deployed and the composer install is completed.

.. code-block:: none
    :linenos:

    deployment:
        after_composer_install_commands:
           - bash -c 'if [[ -d patch ]]; then ls patch | grep ".patch$" | xargs -I{} bash -c "patch -p0 < patch/{}"; fi'

If you need to apply patches to the application, create a patch directory in the root repository location and insert in it appropriate files with the ".patch". extension

Keep in mind that if your application supports patch application on its own (for example via a specific bundle), you need to make sure there are no conflicts between these approaches and the same patch is not applied twice.  

Note: Use the following command to make sure that the patch is correct and can be applied before deploying it into the production:

.. code-block:: none
   :linenos:

   patch -p0 < patch/file.patch

Apply Patches to a Deployed Application
---------------------------------------

In order to unify the process of applying patches during application deployment, the maintenance agent has the functionality for applying/reverting patches.

Use the following commands to work with patches (supports only patches created in ``PhpStorm``):

* **patch:list** - shows the list of applied patches to the current application deployment

.. code-block:: none
   :linenos:

   ➤ Executing task patch:list
   +---------------------+----------------------------------+------------+
   | DATE                | HASH (md5)                       | PATCH      |
   +---------------------+----------------------------------+------------+
   | 2018-10-16 17:18:29 | b3d1e7ea5c476f0dba0b7588a8a93b70 | test.patch |
   +---------------------+----------------------------------+------------+

.. note:: Please note that the value in the ``HASH (md5)`` column is used for the `patch:revert` and `patch:view` commands as an argument.

* **patch:view** - shows the content of the specified patch, requires the patch HASH as an argument.

.. code-block:: none
   :linenos:

   [ ~]$ orocloud-cli patch:view b3d1e7ea5c476f0dba0b7588a8a93b70
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

* **patch:revert** - reverts a patch, requires the patch HASH and|or the full path to the patch file as an argument (/mnt/maint-data is suggested), by default the command runs in DRY-RUN mode, which means that changes will not be applied, only validated. Passing the `--force` option causes the specified patch to be physically reverted against your codebase.

Usage examples:

* Revert by a patch hash, dry-run mode (only shows what will be done):

  .. code-block:: none
     :linenos:

     orocloud-cli patch:revert b3d1e7ea5c476f0dba0b7588a8a93b70

* Revert by a patch hash, force mode (patch will be physically reverted against your codebase):

  .. code-block:: none
     :linenos:

     orocloud-cli patch:revert b3d1e7ea5c476f0dba0b7588a8a93b70 --force

* Revert by a patch file, the case when patch file content is not available (the full path specified with the `-f` option)

  .. code-block:: none
     :linenos:

     orocloud-cli patch:revert b3d1e7ea5c476f0dba0b7588a8a93b70 -f ~/test.patch

* Revert by a patch, the case when patch hash is not shown in the `patch:list` (was applied with an old version of the agent or via `deployment.after_composer_install_commands`)

  .. code-block:: none
     :linenos:

     orocloud-cli patch:revert - -f ~/test.patch

