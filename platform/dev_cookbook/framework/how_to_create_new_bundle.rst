:orphan:

.. _dev-cookbook-framework-how-to-create-new-bundle:

How to Create a New Bundle
==========================

According to the :ref:`application directory structure <architecture-oro-php-application-structure>`, your custom bundle should be placed in the ``src/`` folder.

To create a new bundle, first specify a name and a namespace for it.

As an illustration, let us create an *AppBundle* and put it under the ``AppBundle`` namespace in the ``/src`` directory (
accordingly to the :ref:`application directory structure <architecture-oro-php-application-structure>`).

We need to create the corresponding directory structure and the bundle file with the following content:

.. code-block:: php
    :linenos:

    <?php
    // src/AppBundle/AppBundle.php
    namespace AppBundle;

    use Symfony\Component\HttpKernel\Bundle\Bundle;

    class AppBundle extends Bundle
    {
    }

This is basically a regular Symfony bundle. The only difference is in the way it is enabled.

Enable a Bundle
---------------

To enable the bundle:

1. Create a **Resources/config/oro/bundles.yml** file with the following content:

    .. code-block:: yaml
        :linenos:

        # src/AppBundle/Resources/config/oro/bundles.yml
        bundles:
            - AppBundle\AppBundle

    or

    .. code-block:: yaml
        :linenos:

        # src/AppBundle/Resources/config/oro/bundles.yml
        bundles:
            - { name: AppBundle\AppBundle, priority: 210 }

    This file provides a list of bundles to register. All such files will be automatically parsed to load the required bundles.

    .. note:: Bundles with lower **priority** are loaded first.

#. Regenerate the application cache using the *cache:clear* console command:

   .. code-block:: bash
       :linenos:

       user@host:/var/www/vhosts/platform-application$ php bin/console cache:clear
       Clearing the cache for the dev environment with debug true

   .. note::

       If you are working in the production environment, use the *--env=prod* parameter with the command.
