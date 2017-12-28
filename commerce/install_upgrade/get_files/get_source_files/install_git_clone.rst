Method 1: Clone the GitHub Repository
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. begin_install_git_clone

.. note:: Alternatively, you can :ref:`Download the source code archive <platform-installation-download-archive>`.

To prepare for installation:

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

         **OroCommerce** (with OroCRM):

         .. code-block:: bash

            $ git clone --recursive -b 1.3.0 https://github.com/orocommerce/orocommerce-application.git orocommerce

         **OroPlatform**:

         .. code-block:: bash

            $ git clone -b 2.3 https://github.com/oroinc/platform-application.git oroplatform
