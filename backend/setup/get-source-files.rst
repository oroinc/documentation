:orphan:

.. _platform--installation--source-files:
.. _installation--get-files:

Get the Oro Application Source Code
===================================

You can obtain the application source code and the required dependencies in one of the following ways:

* :ref:`Create a project with composer <platform-installation-composer-create-project>`.

* :ref:`Clone the GitHub repository and install dependencies <platform-installation-github-clone>`.

* :ref:`Download the source code archive <platform-installation-download-archive>`.

These methods are detailed below.

.. _platform-installation-composer-create-project:

Method 1: Create a Project with Composer
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. Make sure you are using PHP  7.1.26 or higher and have Composer installed. If you do not, use the Composer
   installation process described in the |Composer installation documentation|.

2. Create your new Oro application project with Composer by running one of commands below, depending on the base application you want to install:

   .. code-block:: bash

      # OroCommerce Community Edition
      composer create-project oro/commerce-crm-application:~3.1.0 my_project_name --repository=https://satis.oroinc.com
      # OroCommerce Enterprise Edition
      composer create-project oro/commerce-crm-enterprise-application:~3.1.0 my_project_name --repository=https://satis.oroinc.com
      # OroCRM Community Edition
      composer create-project oro/commerce-crm-application:~3.1.0 my_project_name --repository=https://satis.oroinc.com
      # OroCRM Enterprise Edition
      composer create-project oro/crm-enterprise-application:~3.1.0 my_project_name --repository=https://satis.oroinc.com
      # OroPlatform Community Edition
      composer create-project oro/platform-application:~3.1.0 my_project_name --repository=https://satis.oroinc.com
      # OroCommerce Community Edition for Germany
      composer create-project oro/commerce-crm-application-de:~3.1.0 my_project_name --repository=https://satis.oroinc.com
      # OroCommerce Enterprise Edition for Germany
      composer create-project oro/commerce-crm-enterprise-application-de:~3.1.0 my_project_name --repository=https://satis.oroinc.com
      # OroCommerce Enterprise Edition (without CRM)
      composer create-project oro/commerce-enterprise-application:~3.1.0 my_project_name --repository=https://satis.oroinc.com

   This command creates a new directory called `my_project_name/` that contains an empty project of the most recent stable version.

.. _platform-installation-github-clone:
.. _clone-the-github-repository:

Method 2: Use the GitHub Repository
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. Clone the Oro application GitHub repository by running one of commands below:

   .. code-block:: bash

    # OroCommerce Community Edition
    git clone -b 3.1.20 https://github.com/oroinc/orocommerce-application my_project_name
    # OroCommerce Enterprise Edition
    git clone -b 3.1.20 https://github.com/oroinc/orocommerce-enterprise-application my_project_name
    # OroCRM Community Edition
    git clone -b 3.1.20 https://github.com/oroinc/crm-application my_project_name
    # OroCRM Enterprise Edition
    git clone -b 3.1.20 https://github.com/oroinc/crm-enterprise-application my_project_name
    # OroPlatform Community Edition
    git clone -b 3.1.20 https://github.com/oroinc/platform-application my_project_name
    # OroCommerce Community Edition for Germany
    git clone -b 3.1.20 https://github.com/oroinc/orocommerce-application-de my_project_name
    # OroCommerce Enterprise Edition for Germany
    git clone -b 3.1.20 https://github.com/oroinc/orocommerce-enterprise-application-de my_project_name
    # OroCommerce Enterprise Edition (without CRM)
    git clone -b 3.1.20 https://github.com/oroinc/orocommerce-enterprise-nocrm-application my_project_name

   * Replace the ``3.1.20`` with the version to download.

   * ``my_project_name`` is the directory to clone the application source files into.

2. Run the ``composer install`` command with ``--prefer-dist --no-dev`` parameter to install all Oro application
   dependencies:

   .. code-block:: bash

       $ cd <application-root-folder>
       $ composer install --prefer-dist --no-dev

   Note that you are prompted to enter the installation environment configuration options that are saved into the ``config/parameters.yml`` file.
   You can find the description for every parameter in the :ref:`Infrastructure-related Oro Application Configuration <installation--parameters-yml-description>` article.

.. _platform-installation-download-archive:

Method 3: Download the Source Code Archive
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. Download the latest version of the application source code from the download section on |the website|:

   * |Download OroCommerce|
   * |Download OroCRM|
   * |Download OroPlatform|

   Click the **download zip**, **download tar.gz**, or **download tar.bz2** link to download the archive.

   .. note:: You can also download the **virtual machine** to quickly :ref:`deploy the application in the virtual sandbox environment <virtual_machine_deployment>`.

   .. image:: /img/backend/setup/installation/download_orocommerce.png
      :alt: Download the latest version of source code screen from the website
      :align: center
      :scale: 50%

   Then extract the source files. For example, on a Linux based OS run:

   .. code-block:: bash

       $ cd <application-root-folder>
       $ tar -xzvf crm-application.tar.gz

2. All required dependencies are already installed in the vendor folder in the extracted archive.

   .. warning:: Unlike when cloning from the GitHub repository, you are not prompted to enter the configuration parameter values. Default values are used instead. If necessary, update the configuration parameters in the ``config/parameters.yml`` file once the command execution is complete.

.. include:: /include/include-links-dev.rst
   :start-after: begin
