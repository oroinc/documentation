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

1. Make sure you use PHP >=8.2 and have Composer installed. If you do not, use the Composer
   installation process described in the |Composer installation documentation|.

2. Create your new Oro application project with Composer by running one of the commands below, depending on the base application you want to install:

   .. code-block:: none

      # OroCommerce Community Edition
      composer create-project oro/commerce-crm-application my_project_name 5.1.0
      # OroCommerce Enterprise Edition
      composer create-project oro/commerce-crm-enterprise-application my_project_name 5.1.0 --repository=https://satis.oroinc.com
      # OroCRM Community Edition
      composer create-project oro/crm-application my_project_name 5.1.0
      # OroCRM Enterprise Edition
      composer create-project oro/crm-enterprise-application my_project_name 5.1.0 --repository=https://satis.oroinc.com
      # OroPlatform Community Edition
      composer create-project oro/platform-application my_project_name 5.1.0
      # OroCommerce Community Edition for Germany
      composer create-project oro/commerce-crm-application-de oroapp my_project_name 5.1.0
      # OroCommerce Enterprise Edition for Germany
      composer create-project oro/commerce-crm-enterprise-application-de my_project_name 5.1.0 --repository=https://satis.oroinc.com
      # OroCommerce Enterprise Edition (without CRM)
      composer create-project oro/commerce-enterprise-application my_project_name 5.1.0 --repository=https://satis.oroinc.com

   * Replace the ``5.1.0`` with the version to download.

   * This command creates a new directory called `my_project_name/` that contains an empty project.

.. _platform-installation-github-clone:
.. _clone-the-github-repository:

Method 2: Use the GitHub Repository
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. Clone the Oro application GitHub repository by running one of the commands below:

   .. code-block:: none

    # OroCommerce Community Edition
    git clone -b 5.1.0 https://github.com/oroinc/orocommerce-application my_project_name
    # OroCommerce Enterprise Edition
    git clone -b 5.1.0 https://github.com/oroinc/orocommerce-enterprise-application my_project_name
    # OroCommerce Platform Application
    git clone -b 5.0.0 https://github.com/oroinc/orocommerce-platform-application my_project_name
    # OroCRM Community Edition
    git clone -b 5.1.0 https://github.com/oroinc/crm-application my_project_name
    # OroCRM Enterprise Edition
    git clone -b 5.1.0 https://github.com/oroinc/crm-enterprise-application my_project_name
    # OroPlatform Community Edition
    git clone -b 5.1.0 https://github.com/oroinc/platform-application my_project_name
    # OroCommerce Community Edition for Germany
    git clone -b 5.1.0 https://github.com/oroinc/orocommerce-application-de my_project_name
    # OroCommerce Enterprise Edition for Germany
    git clone -b 5.1.0 https://github.com/oroinc/orocommerce-enterprise-application-de my_project_name
    # OroCommerce Enterprise Edition (without CRM)
    git clone -b 5.1.0 https://github.com/oroinc/orocommerce-enterprise-nocrm-application my_project_name

   * Replace the ``5.1.0`` with the version to download.

   * ``my_project_name`` is the directory into which you need to clone the application source files.

2. Run the ``composer install`` command with ``--prefer-dist --no-dev`` parameter to install all Oro application
   dependencies:

   .. code-block:: none

       $ cd <application-root-folder>
       $ composer install --prefer-dist --no-dev

   Note that you can find the description for every environment variable in the :ref:`Infrastructure-related Oro Application Configuration <installation--parameters-yml-description>` article.

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
      :alt: Download the latest version of the source code screen from the website
      :align: center
      :scale: 50%

   Then extract the source files. For example, on a Linux-based OS run:

   .. code-block:: none

       $ cd <application-root-folder>
       $ tar -xzvf crm-application.tar.gz

2. All required dependencies are already installed in the vendor folder in the extracted archive.

   .. warning:: If necessary, update the configuration parameters in the ``.env-app.local`` file once the command execution is complete.

.. include:: /include/include-links-dev.rst
   :start-after: begin

