Before You Begin
================

If you plan to deploy a custom version of Oro application that is hosted in a custom private repository, please, do the following:

* Share the repository URL with the OroCloud Support Team
* Authorize access to your custom repository for the ssh key you have taken from Oro Support Team

Connect to the OroCloud Environment via VPN
-------------------------------------------

You will get the OroCloud access information – server IP address,  username, and the `.ovpn` configuration file.

You can use OpenVPN to create a VPN tunnel to the OroCloud. First, `install the OpenVPN <https://openvpn.net/index.php/open-source/documentation/howto.html#install>`_ client to your Windows, Linux, or Mac OS. Once the client is installed:

1. Open the configuration file you were provided via the OpenVPN client. This will load the connection configuration.
2. Right-click the OpenVPN client in the system tray and click **Connect OroCloud**.

Once the connection is established, you can access your OroCloud environment via SSH connection to the host you were provided. Use your personalized user details to log on to the server.
