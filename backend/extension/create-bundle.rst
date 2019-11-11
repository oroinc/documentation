.. index::
    single: Bundle; Create a Bundle
    single: Customization; Create a custom Bundle

.. _how-to-create-new-bundle:
.. _dev-cookbook-framework-how-to-create-new-bundle:

Create a Bundle
===============

New bundle can be created either manually, or automatically using standard Symfony console command.

Create a Bundle Manually
------------------------

First you need to specify name and namespace of your bundle. Symfony framework already has
|best practices for bundle structure and bundle name| and we recommend to follow these practices and use them.

Let us assume that we want to create the AcmeNewBundle and put it under the namespace ``Acme\Bundle\NewBundle``
in the ``/src`` directory. We need to create the corresponding directory structure and the bundle file with the following content:

.. code-block:: php
    :linenos:

    <?php
    // src/Acme/Bundle/NewBundle/AcmeNewBundle.php
    namespace Acme\Bundle\NewBundle;

    use Symfony\Component\HttpKernel\Bundle\Bundle;

    class AcmeNewBundle extends Bundle
    {
    }

Basically, it is a regular Symfony bundle. The only difference is in the way it will be enabled (see chapter `Enable a Bundle`_).


.. Create bundle automatically
.. ---------------------------
..
.. Also new bundle can be generated using `Symfony command generate:bundle`_:
..
.. .. _Symfony command generate:bundle: http://symfony.com/doc/2.4/bundles/SensioGeneratorBundle/commands/generate_bundle.html
..
.. .. code-block:: bash
..     :linenos:
..
..     user@host:/var/www/vhosts/platform-application$ php bin/console generate:bundle
..     Bundle namespace: Acme/Bundle/NewBundle
..     Bundle name [AcmeNewBundle]:
..     Target directory [/var/www/vhosts/platform-application/src]:
..     Configuration format (yml, xml, php, or annotation): yml
..     Do you want to generate the whole directory structure [no]?
..     Do you confirm generation [yes]?
..
..     Generating the bundle code: OK
..     Checking that the bundle is autoloaded: OK
..
..     Confirm automatic update of your Kernel [yes]? no
..     Enabling the bundle inside the Kernel: FAILED
..     Confirm automatic update of the Routing [yes]? no
..     Importing the bundle routing resource: FAILED
..
.. It is important that you don't need to update Kernel and routing, as OroPlatform provides its own way to do that,
.. which will be described in the `Enable bundle`_ chapter and in following articles.
..
.. .. note::
..
..     Automatic bundle generation is provided by the ``sensio/generator-bundle`` package, which is defined in the
..     ``require-dev`` section of the ``composer.json`` file in the OroPlatform repository. Therefore, in order to use
..     automatic generation, please, make sure that this package has been installed (one of the ways to do so is to execute
..     ``composer update`` at the project's root directory to get all packages from the ``require-dev`` section).
..

Enable a Bundle
---------------

Now you have all the required files to enable the new bundle. To enable the bundle:

#. Create Resources/config/oro/bundles.yml with the following content:

   .. code-block:: yaml
       :linenos:

       # src/Acme/Bundle/NewBundle/Resources/config/oro/bundles.yml
       bundles:
           - Acme\Bundle\NewBundle\AcmeNewBundle

   This file provides a list of bundles to register --- all such files will be automatically parsed to load required bundles.

#. Regenerate the application cache using the console command ``cache:clear``:

   .. code-block:: bash
       :linenos:

       user@host:/var/www/vhosts/platform-application$ php bin/console cache:clear
       Clearing the cache for the dev environment with debug true

   .. note::

       If you are working in production environment, you have to use parameter --env=prod with the command.

Now open the application user interface in development mode (use the link ``http://<oro-application-base-url>/app_dev.php/``) and click the
|Symfony profiler config icon|:

.. image:: /img/backend/extension/dashboard.png

Here you can find your new bundle in the list of active bundles:

.. image:: /img/backend/extension/profiler.png

That is all --- your bundle is registered and active!

.. _installer_generate:

Generate an Installer for a Bundle
----------------------------------

When you have implemented new entities, you want to be sure that upon installing the application, the entities are added to the database. For this, you need to create an installer. You can do it manually, however, it is more convenient to use a dump of the database as a template.

To create an installer for AcmeBundle:

1. Clear the application cache:

   .. code-block:: bash
      :linenos:

      bin/console cache:clear

2. Apply the changes that you defined in your code to the database:

   .. code-block:: bash
      :linenos:

      bin/console doctrine:schema:update

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

References
----------

* |Symfony Best Practices for Structuring Bundles|
* |Symfony Framework Events|



.. include:: /include/include-links.rst
   :start-after: begin
