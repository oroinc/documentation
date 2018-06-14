.. _installation:

Installation Guide
==================

This section provides information on the Oro application installation, the steps and recommendations for environment preparation, guidance on the installation via CLI and :ref:`via UI <book-installation-wizard>`, and the necessary post-install actions.

The information is grouped into the following topics:

* :ref:`Manual Installation <install-for-dev>` -- Comprehensive step-by-step guides that help administrators and developers install the particular Oro application in the development, staging, or production environment. After installation, Oro application is ready for use, further development (customization), and troubleshooting. See the application-specific installation steps for every Oro application:

  * :ref:`OroPlatform <installation--platform--readme>`
  * :ref:`OroCRM Community Edition <installation--crm-ce--readme>`
  * :ref:`OroCRM Enterprise Edition <installation--crm-ee--readme>`

* :ref:`One-Click Automated Setup <one-step-install>` -- A collection of instructions on how to setup and run Oro Applications with the help of prepared machine images or provisioning tools:

   * :ref:`Run Oro Applications with a VirtualBox VM Image <virtual_machine_deployment>`
   * :ref:`Run Oro Application Using Vagrant Provision <vagrant_installation>`
   * :ref:`Run Oro Application on the AWS Cloud Platform with an Amazon Machine Image Image <aws_simple>`.

* :ref:`Upgrade <upgrade>` -- Guidance on how to upgrade the Oro application to the newer version.

* :ref:`Reinstall and troubleshooting <reinstall>` -- Information on how to reinstall Oro application to reset any customization and troubleshoot the installation issues.

.. toctree::
   :includehidden:
   :titlesonly:
   :maxdepth: 1
   :hidden:

   installation_quick_start_dev/index
   one_step_automated_installation/index
   upgrade
   reinstall
