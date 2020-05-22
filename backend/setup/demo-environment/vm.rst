.. _virtual_machine_deployment:

VM VirtualBox
=============

.. begin_virtual_machine_deployment

For a more flexible and secure evaluation experience, you can deploy a virtual machine with Oro application demo instance in Oracle VM VirtualBox.

.. note:: OS X, Windows, and Linux-based operation systems support Oracle VM VirtualBox.

Before you proceed, ensure that VM VirtualBox v.6.2.x is installed in your local or corporate environment and is accessible.

To download the virtual machine image on the |OroCommerce VM| or |OroCRM VM| website click on the **download** link.

   .. image:: /img/backend/setup/vb/download_image.png
      :alt: Download the OroCommerce virtual image


To import the virtual machine into VirtualBox:

1. Open VirtualBox.
2. Click **File > Import Appliance** in the main menu.

   .. image:: /img/backend/setup/vb/import_appliance.png
      :alt: Importing a virtual machine image via virtualbox

3. Locate the *.ova* file, select it, and click **Open**.

   .. note:: In the virtual machine image, the latest released version of Oro application is deployed on the CentOS-7 OS that secures moderate resource consumption.

4. Review the virtual appliance settings and modify resources to meet your server capabilities, if necessary. To do so, double-click on the item and type in the updated value.

5. Once you are happy with the virtual appliance configuration, click **Import**.

   The VirtualBox imports the virtual machine from the image, copies virtual disk drives, and applies the provided configuration.

6. The application opens in a VirtualBox Google Chrome browser window.

   Follow the steps on the screen to start working with the demo instance of the application.

.. finish_virtual_machine_deployment

.. include:: /include/include-links-dev.rst
   :start-after: begin

