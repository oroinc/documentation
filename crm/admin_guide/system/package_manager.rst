.. _admin-package-manager:

Extensions and Package Manager
==============================

Extensions
----------

Extensions are additional modules that can be added to an OroCRM instance to enable new functionalities, integrations,
capabilities, etc.

All the OroCRM extensions are available in the `OroCRM Marketplace <http://marketplace.orocrm.com/>`_

.. image:: ../img/extension/marketplace.png

Click the link with the extension name, to see its detailed description.

Below the short overview, there is always a package name, that you need to add this extension to your OroCRM instance.

Lower, you can see detailed description, release notes, reviews, as well as information about previous versions 
(if any).

.. image:: ../img/extension/extension_details.png

Add an Extension to the Package
-------------------------------

In order to add an extension, navigate **System>Package Manager**.

You will see the **Installed Packages** page.

.. image:: ../img/extension/installed_packages.png

You can see details of all the packages currently available in the system. If a newer version of the extension is 
available, the **Update** link will be available in the **LATEST VERSION** column.

In order to add a new extension: 

- Enter the package name in the Package Name field in the top left part of the page, and click the 
  :guilabel:`Install` button.
  
  |InstallPack|

- Confirm the package installation. Uncheck the *"Load demo data"* box, if you don't need demo data. Click 
  :guilabel:`Continue`.
  
When installation is over, the package will be added to the Installed Packages list. Relevant :ref:`processes <user-guide-processes>` and :ref:`entities <doc-entities>` will be added to the system and the functionality can be used.


.. |InstallPack| image:: ../img/extension/install_package.png
   :align: middle