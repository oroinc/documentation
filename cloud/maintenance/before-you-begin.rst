Before You Begin
================

If you plan to deploy a custom version of Oro application that is hosted in a custom private repository, please, do the following:

* Share the repository URL with the OroCloud Support Team
* Authorize access to your custom repository for the ssh key you have taken from Oro Support Team

Connect to the OroCloud Environment via VPN
-------------------------------------------

You will get the OroCloud access information – server IP address,  username, and the `.ovpn` configuration file.

You can use OpenVPN to create a VPN tunnel to the OroCloud. First, |install the OpenVPN| client to your Windows, Linux, or Mac OS. Once the client is installed:

1. Open the configuration file you were provided via the OpenVPN client. This will load the connection configuration.
2. Right-click the OpenVPN client in the system tray and click **Connect OroCloud**.

Once the connection is established, you can access your OroCloud environment via SSH connection to the host you were provided. Use your personalized user details to log on to the server.

.. _sftp-access:

Connect to the OroCloud Environment via SFTP
--------------------------------------------

SFTP is the secure file transfer protocol which is the extension of the SSH protocol. It provides a way to transfer large amounts of data from the client to the target host anywhere on the Internet.
OroCloud provides the ability to connect to the OroCommerce instance and upload data (e.g., media) on customer request using SFTP service.

Request SFTP Access
^^^^^^^^^^^^^^^^^^^

To get SFTP access to your OroCloud instance, create a ticket in the support portal. This ticket must contain the following information:

* The exact instance definition, such as staging, production, etc.
* An email of the person who will use this SFTP account.
* A username for the account and/or your public SSH key for the SFTP account
* A list of IPs from which the connection to the SFTP is allowed

.. note:: OroCloud supports both “username+password” and SSH key authentication for SFTP.

Once access is granted, the support team will update the ticket with the IP address of the SFTP server. The password for the newly created account will be sent to the email provided in the ticket.

Connect to the SFTP Server
^^^^^^^^^^^^^^^^^^^^^^^^^^

Once you have received the SFTP server IP and password, you can connect to the OroCloud using an SFTP client of your choice.

Here are a few tips for troubleshooting of the problems when establishing connection to your SFTP server:

* Ensure that you are connecting from the allowed IP address. In other words, your IP address must be present on the list of IPs in the ticket that you created to request SFTP access. You can test connectivity using telnet command `telnet yoursftpIP:22`.
* Ensure that the username and password pair you are using is correct. The username is the same as the one provided in the ticket that you created to request SFTP access and the password is available in the email. *Do not use an email address as your user name.*
* In case you are using a key for authentication, check if your SFTP clients are configured to use the correct key.

Manage Uploaded Data
^^^^^^^^^^^^^^^^^^^^

Once you uploaded data to you SFTP directory, you may need to move it to the destination location on your website.
OroCloud maintenance agent supports the `media:upload` command for data transfer between your SFTP directory and your OroCommerce website. You can find a detailed description and usage examples :ref:`in the Media Upload <orocloud-maintenance-use-media-upload>` section of the OroCloud guide.

Developers can allow the application to read / write directly from the SFTP directory using the environment variable defined in *composer.json*:

.. code-block:: none
    :linenos:

    {
        "extra": {
            "incenteev-parameters": {
                "env-map": {
                    "sftp_root_path": "ORO_SFTP_ROOT_PATH"
                }
            }
        }
    }

To refer this directory from the composer, your *parameters.yml.dist* file should include the same empty param `sftp_root_path: ~`. It will be transformed to the correct value during composer install in the cloud. As the result, you will receive a path in parameters.yml similar to `sftp_root_path: /path/to/sftp/dir/`.

You can use it as any other parameter but remember to add a specific path to your user, i.e:

.. code-block:: none
   :linenos:

   my_service:
     class: Oro\Bundle\Acme\Service
     arguments:
       - '%sftp_root_path%/myusername/uploads'

.. include:: /include/include-links.rst
   :start-after: begin