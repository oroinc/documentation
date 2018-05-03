.. _virtual_machine_deployment:

Running a Pre-Installed Oro Application with the Oracle VM VirtualBox
---------------------------------------------------------------------

.. begin_virtual_machine_deployment

For a more flexible and secure evaluation experience, you can deploy a virtual machine with Oro application demo instance on an Oracle VM VirtualBox server.

.. note:: OS X, Windows, and Linux-based operation systems support Oracle VM VirtualBox Server.

Ensure that the server is installed in your local or corporate environment and is accessible before you do the following steps:

1. Download a virtual machine image by clicking **virtual machine** link in the `download section`_ on |the_site|. Save it to the location that is available to your VirtualBox instance.

   .. note:: In the virtual machine image, the latest released version of Oro application is deployed on the SliTaz Linux OS that secures moderate resource consumption.

2. Import the virtual machine into the VirtualBox Server:

    a) Open a VirtualBox.
    b) Click **File > Import Appliance** in the main menu.
    c) Navigate to the *.ova* file you have saved at the previous step, select it and click **Open**.
    d) Review the virtual appliance settings and modify resources to meet your server capabilities, if necessary. To do so, double-click on the item and type in the updated value. It is recommended to set at least 1024 MB in the RAM configuration.
    e) Once you are happy with the virtual appliance configuration, click **Import**.

    The VirtualBox imports the virtual machine from the image, copies virtual disk drives, and applies the provided configuration.

3. Start the virtual machine you just imported and log in as *oro* (that is a default Oro application demo username). Leave the password blank.

   .. note:: You can log in as a system administrator using the following credentials:

      * *username:* root
      * *password:* root

4. Press **Enter** twice to open the Oro Application Demo information page.
5. Follow the provided guidance to start using your local isolated Oro Application Demo.

   You can open Oro application in the browser in the virtual machine and start your evaluation right away.

   Alternatively, you can set up access to Oro application from other devices in your network.

   In order to do so, map the Oro application virtual machine IP address that is provided in the Oro Application Demo information page and the hostname you intend to use for quick access. You can either set up the mapping locally, in the *hosts* file on every device that you plan to access Oro application demo from, or configure the mapping on the local DNS server.

   To set up the Oro application hostname locally:

    a) Open the following file in the text editor with administrator permissions (use *run as administrator* option on Windows, and *sudo* on Linux and OS X):

        * *Windows:* c:\windows\system32\drivers\etc\hosts
        * *Linux:* /etc/hosts

    b) Add the virtual appliance external IP address and the suggested appliance hostname (e.g. 129.168.1.31 acme.orocommerce.com) and save the file.

   To start using the Oro application demo, type in the suggested hostname (e.g., acme.orocommerce.com) in the browser on your device.

.. finish_virtual_machine_deployment

.. _`download section`: http://www.oroinc.com/v/download

.. |the_site| replace:: `oroinc.com/b2b-ecommerce`_

.. _`oroinc.com/b2b-ecommerce`:  http://www.oroinc.com/b2b-ecommerce/
