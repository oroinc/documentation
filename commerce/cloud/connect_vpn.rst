:orphan:

.. _cloud_connect_vpn:

Connect OroCloud VPN
====================

.. contents:: :local:
   :depth: 1

This topic explains how to connect OroCloud VPN on various operating systems.

.. note:: If you are using different client software versions, ensure that you have OpenVPN version 2.4 or newer. Your OpenVPN configuration file (.ovpn) is sent to your e-mail. Save it in a secure place.

Username and password should be obtained using `ORO ID Portal <https://idp.oro.cloud/auth/realms/ORO/protocol/openid-connect/auth?client_id=account&redirect_uri=https%3A%2F%2Fidp.oro.cloud%2Fauth%2Frealms%2FORO%2Faccount%2Flogin-redirect&state=0%2F1190e13a-6dee-4aee-97a6-96df6075f673&response_type=code&scope=openid>`__

MacOS X
-------


Used client software: `Tunnelblick <https://tunnelblick.net/downloads.html>`__ 3.7.8 build 5180

1. Download the DMG file and open it as usual.
2. Run Tunnelblick installer:

   .. image:: /cloud/img/cloud/mac_tunnelbrick_dwn.jpg

   Follow the installation wizard instructions.

   Select **I have configuration files** at the last step:

   .. image:: /cloud/img/cloud/mac_tunnelbrick_wizard.jpg

3. Drag the *ovpn* configuration file and drop it on the Tunnelblick icon on panel. In the permissions popup, select **Only Me**.

   .. image:: /cloud/img/cloud/mac_tunnelbrick_install.jpg

4. Click Tunnelblick icon and click 'Connect OroCloud...':

   .. image:: /cloud/img/cloud/connect_orocloud.jpg

5. Input your username and password into the dialog that is displayed:

   .. image:: /cloud/img/cloud/mac_tunnelbrick_credentials.jpg

6. You can now connect your environment using SSH.

Ubuntu 18.04
------------

Used client software: openvpn 2.4.x, network-manager-openvpn, network-manager-openvpn-gnome

1. Install the required packages:

   .. code-block:: bash

      sudo apt install network-manager-openvpn-gnome network-manager-openvpn openvpn

   .. warning:: Ensure that you are using OpenVPN 2.4 or newer.

2. Open **Network Settings** in Gnome Control CenTer and click «+» button for VPN section:

   .. image:: /cloud/img/cloud/ubuntu_gnome.png

3. Select **Import from file** and open your *ovpn* configuration file.
4. Verify the connection settings:

   .. image:: /cloud/img/cloud/connection_settings.png

5. Disable **User key password**:

   .. image:: /cloud/img/cloud/disalble_user_key_password.png

   You may set NetworkManager to keep username and password in key storage, or input it every time.

6. Click **Done**.

   Now you can connect using NetworkManager menu.

Windows 10
----------


Used client software: OpenVPN GUI 2.4.6

1. Download and install OpenVPN GUI software. Accept installation for OpenVPN TAP driver.
2. Launch OpenVPN GUI from desktop icon.
3. Left click on tray icon and select **Import file**.

   .. image:: /cloud/img/cloud/import_file.png

4. Navigate to your ovpn configuration file and open it:

   .. image:: /cloud/img/cloud/open_vpn_file.png

5. Left click on tray icon and press 'Connect':

   .. image:: /cloud/img/cloud/connect_vpn.png

6. Input username and password in connection dialog:

   .. image:: /cloud/img/cloud/vpn_connection_dialog.png

7. Ensure you are connected to VPN:

   .. image:: /cloud/img/cloud/vpn_connected.png

8. Now you are able to connect environment using SSH.


