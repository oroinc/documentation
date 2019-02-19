.. _reinstall:

Reinstallation of the |main_app_in_this_topic|
----------------------------------------------

To reinstall |main_app_in_this_topic|:

1. Drop the database that was used for the previous installation attempt.
2. Create a new database for new |main_app_in_this_topic| installation.
3. Empty the *<installation directory>/var/cache/prod* and *<installation directory>/var/cache/session* directories.
4. Clear the Installed option in the *config/parameters.yml* file and update the database name, if necessary.
5. Launch the |main_app_in_this_topic| installation :ref:`via console in a silent mode <silent-installation>`.

.. note:: The installation process terminates with a warning if the environment does not meet the system requirements. Fix the reported issue(s) and launch the installation again.

If any problem occurs, you can see the details in ``var/logs/oro_install.log`` file.

.. hint:: Normally, the installation process is terminated if it detects an already-existing installation. Use the "--force" option to overwrite an existing installation, e.g. during your development process.

.... hint:: After the installation finished remember to run ``php bin/console oro:api:doc:cache:clear`` to warm-up the API documentation cache. This process may take several minutes.

.. |main_app_in_this_topic| replace:: OroCRM
