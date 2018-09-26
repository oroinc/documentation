.. _dev-cookbook-framework-how-to-create-new-bundle:

How to Create a New Bundle
==========================

To create a new bundle, you first need to specify a name and a namespace for it. Symfony framework provides
`best practices for bundle structure and bundle name`_ and we highly recommend to follow them.

.. _best practices for bundle structure and bundle name: http://symfony.com/doc/2.6/cookbook/bundles/best_practices.html#bundle-name

As an illustration, let us create *AcmeNewBundle* and put it under the ``Acme\Bundle\NewBundle`` namespace in the ``/src`` directory. We need to create the corresponding directory structure and the bundle file with the following content:

.. code-block:: php
    :linenos:

    <?php
    // src/Acme/Bundle/NewBundle/AcmeNewBundle.php
    namespace Acme\Bundle\NewBundle;

    use Symfony\Component\HttpKernel\Bundle\Bundle;

    class AcmeNewBundle extends Bundle
    {
    }

This is basically a regular Symfony bundle. The only difference is in the way it is enabled.

Enable a Bundle
---------------

To enable the bundle:

1. Create a **Resources/config/oro/bundles.yml** file with the following content:

    .. code-block:: yaml
        :linenos:

        # src/Acme/Bundle/NewBundle/Resources/config/oro/bundles.yml
        bundles:
            - Acme\Bundle\NewBundle\AcmeNewBundle

    This file provides a list of bundles to register. All such files will be automatically parsed to load the required bundles.

#. Regenerate the application cache using the *cache:clear* console command:

   .. code-block:: bash
       :linenos:

       user@host:/var/www/vhosts/platform-application$ php bin/console cache:clear
       Clearing the cache for the dev environment with debug true

   .. note::

       If you are working in the production environment, use the *--env=prod* parameter with the command.
