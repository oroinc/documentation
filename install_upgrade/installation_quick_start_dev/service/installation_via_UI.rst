.. _book-installation-wizard:

.. begin_installation_via_UI

Installation Via UI
~~~~~~~~~~~~~~~~~~~

.. See this quick preview of the installation wizard steps:

.. .. raw:: HTML <iframe width="560" height="315" src="https://www.youtube.com/embed/5rS-G2bcRzg" frameborder="0" allowfullscreen></iframe>

1. In web browser, open the following URL:

   ``http://<ApplicationServerHost>:<ApplicationServerPort>/install.php``

2. Click **Begin Installation** on the **Welcome to Oro Installer** screen.

.. _a-1-check-system-requirements:

3. During the *System requirements check*, the installation wizard will check the system configuration:

   .. image:: /install_upgrade/img/installation/wizard-1.png

   Ensure that system requirements are met (status indicators should be green for all items) and click **Next**.

   .. _a-2-configuration:

   The application configuration page emerges.

   .. image:: /install_upgrade/img/installation/wizard-2.png

   The default values will be filled in automatically, but they can be changed.

4. For the *Configuration*, provide the following information:

     a) For *Database connection*:

     		* provide a driver (either MySQL or PostgreSQL),
     		* enter the database server host and port,
     		* enter the database name (*Name*), user name and password for OroCRM authentication with the database server.
     		* For re-installation, specify whether OroCRM should remove the existing database table contents. Available options are *None*, *Application Tables*, *All Tables*. The default value is *None*.

     b) In *System settings*, specify the system language and the secret for OAuth 2 client authorization.
     c) In *Web settings*, provide the prefix that will be attached to the application URL to access the OroCRM configuration and administration application (backend).
     d) In *Mailer settings*, select the transport for the emails OroCRM will be sending. Available options are *PHP mail*, *SMTP*, and *sendmail*. When you select the *SNMP*, please, provide the following mail server connection details: host, port, encryption (None, SSL, TLS), user name, and password.
     e) In the *Websocket connection*, set up your web service network configuration: service bind address and port, WS backend and frontend host/post.

   Once you are happy with the information you have provided, click **Next**.

   .. _a-3-database-initialization:

5. The *Database initialization* starts automatically.

   .. image:: /install_upgrade/img/installation/wizard-3.png

   .. hint:: If something goes wrong and a failure occurs, you can check error logs in the ``app/logs/oro_install.log`` file. Fix the errors, click the **Back** button and repeat.

   Click **Next** when status turns green for every step.

   .. _a-4-administration-setup:

   The administration step appears.

   .. image:: /install_upgrade/img/installation/wizard-4.png

6. At the *Administration* step, provide the following information:

     a) Organization name
     b) Application URL (e.g. http://crm.MyCompany.com)
     c) Create the first system administrator by providing a user name, a password (with confirmation), an email, and their first and last name.
     d) If necessary, select the *Load Sample Data* check box.

        .. note:: Load Sample Data only for learning purposes, test deployments and pre-production deployments. In this mode, OroCRM is populated with sample data that help you unlock all the features so that you can quickly test the system after re-configuration or customization.

     .. _a-5-finalization:

     e) Finally, click **Install** and wait until the status for all operations turns green.

        .. image:: /install_upgrade/img/installation/wizard-5.png

        .. hint:: If something goes wrong and a failure occurs, you can check error logs in the app/logs/oro_install. Fix the errors, click **Back** and repeat the installation step.

        Once installation is complete, click **Next**.

.. _a-6-launch-the-application:

7. At the *Finish* step, click **Launch Application** to open the OroCRM Administration Login screen.

   .. image:: /install_upgrade/img/installation/wizard-6.png

   The URL will be similar to the following: *http://<hostname>:<port>/app.php/admin/user/login*. To log in, use credentials you provided for the first system administrator.

.. TODO incorporate imgs for OroCRM/OroCommerce

