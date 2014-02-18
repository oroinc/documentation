How to create new bundle
========================

*Used application: OroPlatform RC2*

* `Create bundle manually`_
* `Create bundle automatically`_
* `Enable bundle`_
* `References`_


New bundle can be created either manually, or automatically using standard Symfony console command.


Create bundle manually
----------------------

First you need to specify name and namespace of your bundle. Symfony framework already has
`best practices for bundle structure and bundle name`_ and we recommend to follow these practices and use them.

.. _best practices for bundle structure and bundle name: http://symfony.com/doc/2.3/cookbook/bundles/best_practices.html#bundle-name

Let's assume that we want to create AcmeNewBundle and put it under namespace Acme\Bundle\NewBundle
in the /src directory. We need to create corresponding directory structure and bundle file
/src/Acme/Bundle/NewBundle/AcmeNewBundle.php with the following content:

.. code-block:: php

    <?php

    namespace Acme\Bundle\NewBundle;

    use Symfony\Component\HttpKernel\Bundle\Bundle;

    class AcmeNewBundle extends Bundle
    {
    }

Basically, it's a regular Symfony bundle. The only difference is in the way it will be enabled
(see chapter `Enable bundle`_).


Create bundle automatically
---------------------------

Also new bundle can be generated using `Symfony command generate:bundle`_:

.. _Symfony command generate:bundle: http://symfony.com/doc/2.3/bundles/SensioGeneratorBundle/commands/generate_bundle.html

::

    user@host:/var/www/vhosts/platform-application$ php app/console generate:bundle
    Bundle namespace: Acme/Bundle/NewBundle
    Bundle name [AcmeNewBundle]:
    Target directory [/var/www/vhosts/platform-application/src]:
    Configuration format (yml, xml, php, or annotation): yml
    Do you want to generate the whole directory structure [no]?
    Do you confirm generation [yes]?

    Generating the bundle code: OK
    Checking that the bundle is autoloaded: OK

    Confirm automatic update of your Kernel [yes]? no
    Enabling the bundle inside the Kernel: FAILED
    Confirm automatic update of the Routing [yes]? no
    Importing the bundle routing resource: FAILED

Important thing is that you shouldn't update Kernel and routing - OroPlatform provides it's own way to do that -
it will be described in the chapter `Enable bundle`_ and in future articles.


Enable bundle
-------------

Now you have all required files to enable your new bundle. To do that you have to:

1. create file with name Resources/config/oro/bundles.yml
   (full path is /var/www/vhosts/platform-application/src/Acme/Bundle/NewBundle/Resources/config/oro/bundles.yml)
   with the following content:

::

    bundles:
        - Acme\Bundle\NewBundle\AcmeNewBundle

This file provides list of bundles to register - all such files will be automatically parsed to load required bundles.


2. regenerate application cache using console command cache:clear:

::

    user@host:/var/www/vhosts/platform-application$ php app/console cache:clear
    Clearing the cache for the dev environment with debug true

**Note:** If you are working in production environment you have to add parameter --env=prod.

Now you can go to frontend in development mode (http://bap.tutorial/app_dev.php/) and click on
`Symfony profiler`_ config icon:

.. _Symfony profiler: http://symfony.com/doc/current/book/internals.html#profiler

.. image:: ./img/bundle_creation/dashboard.png

Here you can find your new bundle in the list of active bundles:

.. image:: ./img/bundle_creation/profiler.png

That's all - your bundle is registered and active!


References
----------

* `Symfony Best Practices for Structuring Bundles`_
* `Generating a New Bundle Skeleton`_
* `Symfony Internals`_

.. _Symfony Best Practices for Structuring Bundles: http://symfony.com/doc/2.3/cookbook/bundles/best_practices.html
.. _Generating a New Bundle Skeleton: http://symfony.com/doc/2.3/bundles/SensioGeneratorBundle/commands/generate_bundle.html
.. _Symfony Internals: http://symfony.com/doc/2.3/book/internals.html


