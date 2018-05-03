.. _installer_generate:

How to Generate an Installer for a Bundle
=========================================

When you have implemented new entities, you want to be sure that upon installing the application, the entities are added to the database. For this, you need to create an installer. You can do it manually, however, it is more convenient to use a dump of the database as a template.

To create an installer for AcmeBundle:

1. Clear the application cache:

   .. code-block:: bash
      :linenos:

      bin/console cache:clear

2. Apply the changes that you defined in your code to the database:

   .. code-block:: bash
      :linenos:

      bin/console doctrine:schema:update --force

3. Generate an installer and save it to the AcmeBundleInstaller.php:

   .. code-block:: bash
      :linenos:

      bin/console oro:migration:dump --bundle=AcmeBundle > AcmeBundleInstaller.php


   .. hint:: The generated installer may contain a lot of excessive information as the same database table might contain options related to different bundles and entities while the generator has no option to distinguish which entity 'has added' particular options. Delete the information unrelated to your entities from the output file.

 Move AcmeBundleInstall.php to the AcmeBundle/Migrations/Schema directory.

#. Reinstall your application instance.

#. Check that the database is synced with your code:

   .. code-block:: bash
      :linenos:

      bin/console doctrine:schema:update --dump-sql

   If the database is successfully synchronized, you will see the following message:

   .. code-block:: bash
      :linenos:

      Nothing to update - your database is already in sync with the current entity metadata.