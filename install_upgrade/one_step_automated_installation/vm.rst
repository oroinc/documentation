.. _virtual_machine_deployment:

Using the VirtualBox VM Image
=============================

.. begin_virtual_machine_deployment

For a more flexible and secure evaluation experience, you can deploy a virtual machine with Oro application demo instance in Oracle VM VirtualBox.

.. note:: OS X, Windows and Linux-based operation systems support Oracle VM VirtualBox.

Before you proceed, ensure that VM VirtualBox v.5.2.* is installed in your local or corporate environment and is accessible.

To download the virtual image:

1. On the `OroCRM website <https://oroinc.com/orocrm/download>`__, navigate to **Resources > Downloads**.

2. Download a virtual machine image by clicking on the **virtual machine** link.

   .. image:: /install_upgrade/img/vb/download_crm_vb_image.png
      :alt: Download the virtual image

3. Save the *.ova* file.

To import the virtual machine into VirtualBox:

1. Open VirtualBox.
2. Click **File > Import Appliance** in the main menu.

   .. image:: /install_upgrade/img/vb/import_appliance.png
      :alt: Importing a virtual machine image via virtualbox

3. Locate the *.ova* file, select it and click **Open**.

   .. note:: In the virtual machine image, the latest released version of Oro application is deployed on the CentOS-7 OS that secures moderate resource consumption.

4. Review the virtual appliance settings and modify resources to meet your server capabilities, if necessary. To do so, double-click on the item and type in the updated value.

5. Once you are happy with the virtual appliance configuration, click **Import**.

   The VirtualBox imports the virtual machine from the image, copies virtual disk drives, and applies the provided configuration.

6. The application opens in a VirtualBox Google Chrome browser window.

   Follow the steps on the screen to start working with the demo instance of the application.

.. finish_virtual_machine_deployment

