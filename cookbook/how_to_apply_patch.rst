.. index::
single: Patch

How to apply patch
==================

The patch file name supports the following naming convention: {package}-{version_to_apply}.patch.
For example, platform-1.9.2.patch.

**1** Copy the patch file to the package directory

.. code-block:: text
/path/to/crm_folder/vendor/oro/{package}

So, "platform-1.9.2.patch" file should be copied to "/path/to/crm_folder/vendor/oro/platform".

**2** "cd" to the package folder and execute "patch" command to apply the patch.

.. code-block:: bash
$ cd /path/to/crm_folder/vendor/oro/{package}
$ patch -p1 < platform-1.9.2.patch


