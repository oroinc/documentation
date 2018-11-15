.. _platform--installation--source-files:
.. _installation--get-files:

Get the Oro Application Source Code
===================================

You can obtain the application source code and the required dependencies in one of the following ways:

* :ref:`Clone the GitHub repository and install dependencies <platform-installation-github-clone>`.

* :ref:`Download the source code archive <platform-installation-download-archive>`.

These methods are detailed below.

.. _platform-installation-github-clone:
.. _clone-the-github-repository:

Method 1: Use the GitHub Repository
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. Clone the Oro application GitHub repository:

   a) Go to the directory where you plan to put the Oro application source files (``[$folder_location]``). For example, on a Linux server, run the following command:

      .. code-block:: bash

         $ cd [$folder_location]

   #) Obtain the Oro application source files using the *git clone* command.

      On Linux, use the following command:

      .. code-block:: bash

         $ git clone -b <version_or_branch> <repository_URL> [$oro_installation_folder]

      * Replace the <version_or_branch> with the version to download. Along with the released versions (like ``1.3`` and ``2.3``), you can use the master branch to run the latest development version of the Oro application.

      * In [$oro_installation_folder] parameter, specify the directory to clone the application source files into.

      * Replace the <repository_URL> with the GitHub URL of the repository to clone, e.g., ``https://github.com/oroinc/crm-application.git``.

      .. note::

         Adjust the sample commands below to your environment and installation plan:

         **OroCRM**:

         .. code-block:: bash

            $ git clone -b 2.3 https://github.com/oroinc/crm-application.git orocrm

         **OroCommerce** (with CRM):

         .. code-block:: bash

            $ git clone -b 1.3.0 https://github.com/orocommerce/orocommerce-application.git orocommerce

         **OroPlatform**:

         .. code-block:: bash

            $ git clone -b 2.3 https://github.com/oroinc/platform-application.git oroplatform

2. Run the ``composer install`` command with ``--prefer-dist --no-dev`` parameter to install all Oro application
dependencies:

   .. code-block:: bash

       $ cd [$oro_installation_folder]
       $ composer install --prefer-dist --no-dev

Note that you are prompted to enter the installation environment configuration and that are saved into the
*config/parameters.yml* file. A description for every parameter you can find in the
:ref:`Infrastructure-related Oro Application Configuration <installation--parameters-yml-description>` article.

.. _platform-installation-download-archive:

Method 2: Download the Source Code Archive
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. Download the latest version of the application source code from the `download section`_ on |the_site|.
Click the **zip**, **tar.gz**, or **tar.bz2** link to download the archive.

   .. note:: You can also download the **virtual machine** to quickly :ref:`deploy the application in the virtual sandbox environment <virtual_machine_deployment>`.

   .. image:: /install_upgrade/img/installation/download_orocrm.png

Then extract the source files. For example, on a Linux based OS run:

   .. code-block:: bash

       $ cd [$folder_location]
       $ tar -xzvf crm-application.tar.gz

The directory you extracted the files to, will be used in the following steps and will be referred to as [$oro_installation_folder] further in this topic.

2. All required dependencies already installed in the vendor folder in the extracted archive.

   .. warning:: Unlike when cloning from the GitHub repository, you are not prompted to enter the configuration parameter values. Default values are used instead. If necessary, update configuration parameters in the ``config/parameters.yml`` file after the command execution is complete.

.. |main_app_in_this_topic| replace:: OroCRM

.. |the_site| replace:: `oroinc.com/orocrm`_

.. _`download section`: http://oroinc.com/orocrm/download
.. _`oroinc.com/orocrm`: http://www.oroinc.com/orocrm/
