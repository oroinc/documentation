Before You Begin
~~~~~~~~~~~~~~~~

To be able to access the maintenance agent, configure the ssh-agent in your local environment (localhost), generate a pair of ssh keys, share the public key with the Oro Support Team, and add your private key to your local ssh-agent. If you plan to deploy a custom version of Oro application that is hosted in a custom private repository, please, do the following:

* Share the repository URL with the OroCloud Support Team
* Authorize access to your custom repository for the ssh key you have shared with Oro Support Team (e.g., add the ssh key to your GitHub account that has access to the necessary repository)

Launch the Local SSH Agent
^^^^^^^^^^^^^^^^^^^^^^^^^^

Check if you have the agent already running on your local machine:

.. code-block:: none

   ps aux | grep -v grep | grep ssh-agent

If the command does not produce any output, the ssh-agent is not yet running on your system. To launch the ssh-agent, run:

.. code-block:: none

   eval "$(ssh-agent -s)"

Generate SSH Key and Add it to Your Local SSH-Agent
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Generate a pair of private and public ssh keys using the following command:

.. code-block:: none

   ssh-keygen -t rsa -b 4096 -f /path/to/keyfile

The public key will be printed as a result of command execution. Provide it to the Oro Support Team who will provision it as the authorized key for SSH access to the OroCloud infrastructure.

Add the generated private key to the local ssh-agent using the following command:

.. code-block:: none

   ssh-add -K /path/to/keyfile

To verify that your key has been added successfully, run:

.. code-block:: none

   ssh-add -l

This command shows the fingerprints for the identities added to the ssh-agent. Ensure that the key you have just added is listed.

Enable SSH Agent Forwarding on Your Local Machine
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Enable SSH agent forwarding in your ssh-agent configuration to ensure your local ssh key can be used to authenticate any commands that are executed on the OroCloud server (e.g., use the same ssh key for GitHub authentication when cloning a repository).

.. code-block:: none
   :caption: ~/.ssh/config

   Host *
      StrictHostKeyChecking no
      ForwardAgent yes

Connect to the OroCloud Environment via VPN
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

After you provide the OroCloud and Oro Support team with the ssh public key, you will get the OroCloud access information – server IP address,  username, and the `.ovpn` configuration file.

You can use OpenVPN to create a VPN tunnel to the OroCloud. First, `install the OpenVPN <https://openvpn.net/index.php/open-source/documentation/howto.html#install>`_ client to your Windows, Linux, or Mac OS. Once the client is installed:

1. Via the OpenVPN client, open the configuration file you were provided. This will load the connection configuration.
2. Right-click the OpenVPN client in the system tray and click Connect OroCloud.

Once the connection is established you can access your OroCloud environment via SSH connection to the host you were provided. Use your personalized user details to log on to the server.


