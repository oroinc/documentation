.. index::
    single: Installation
    single: OroCRM Application; Installation
    single: Platform Application; Installation

.. _installation:

Run Installation via Wizard or CLI
==================================

This article describes how to install the Oro application (e.g. OroPlatform, OroCRM or OroCommerce).

.. contents::
   :local:
   :depth: 2

This topic will showcase the installation and configuration using |main_app_in_this_topic| as an example.

Installation Customization
--------------------------

.. include:: /install_upgrade/installation/customize_install.rst
   :start-after: begin_custom_installation_intro
   :end-before: finish_custom_installation_intro

.. _doc_installation_section_installation_process:

Installation Launch
-------------------

.. warning:: Before you begin the installation, ensure you have :ref:`prepared the installation environment <installation--prepare>` and all the :ref:`system requirements <system-requirements>` are met.

.. include:: /install_upgrade/installation/installation_steps.rst
   :start-after: begin_installation_intro
   :end-before: finish_installation_intro

See the following topics for more details on:

* :ref:`Installation via console <installation-via-console>` in a normal or :ref:`silent mode <silent-installation>`, and
* :ref:`Installation via the web installation wizard <book-installation-wizard>`.


.. warning:: Once you have completed the installation, :ref:`activate background tasks <post-install>` to ensure execution of the required scheduled operations.

Re-Installation
---------------

To reinstall |main_app_in_this_topic|:

1. Drop the database that was used for the previous installation attempt.
2. Create a new database for new |main_app_in_this_topic| installation.
3. Empty the *<installation directory>/app/cache/prod* and *<installation directory>/app/cache/session* directories.
4. Clear the Installed option in the *app/config/parameters.yml* file and update the database name, if necessary.
5. Launch the |main_app_in_this_topic| installation :ref:`Via Console: Silent Installation <silent-installation>` with the **--force** option provided.

.. _`GitHub repository`: https://github.com/orocrm/crm-application
.. _`Platform application repository URL`: https://github.com/orocrm/platform-application
.. _`session handler`: http://symfony.com/doc/current/components/http_foundation/session_configuration.html#save-handlers
.. _`translations`: http://symfony.com/doc/current/components/translation/introduction.html
.. _`CSRF tokens`: http://symfony.com/doc/current/cookbook/security/csrf_in_login_form.html
.. _`oroinc.com/orocrm`:  http://www.oroinc.com/orocrm
.. _`optimizing InnoDB Disk I/O`: http://dev.mysql.com/doc/refman/5.6/en/optimizing-innodb-diskio.html
.. _`in the official Symfony documentation`: http://symfony.com/doc/current/book/installation.html#book-installation-permissions
.. _`Configuring a Web Server`: http://symfony.com/doc/current/cookbook/configuration/web_server_configuration.html
.. _`Symfony Cookbook`: http://symfony.com/doc/current/cookbook/index.html
.. _`system requirements`: http://www.oroinc.com/doc/orocrm/current/system-requirements

.. finish_common_install

**Related Topics**

.. toctree::
   :maxdepth: 2

   installation_steps

.. include:: /install_upgrade/installation/vars.rst
   :start-after: begin_vars