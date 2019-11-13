.. index::
    single: Platform Application; Customization

.. _custom-oro-application:
.. _dev-cookbook-create-custom-oro-application:

Custom Oro Application
======================

No two businesses are alike. This motto is a part of Oro products philosophy and this is why flexibility is one of
the key principles that drive architecture in Oro. Depending on what you are planning to build, you can
create your custom application with minimum functions starting either with |OroPlatform|, or |OroCRM|, or
|OroCommerce| application as a baseline. No matter what is your starting point, there is no difference
in the customization process.

Application Repository and Installation
---------------------------------------

Before you start working on a new project, it is important to have version control system in place.
The easiest way to start is to |fork application repository| of |OroPlatform|, |OroCRM| or |OroCommerce| on GitHub.

Once code repository is ready, please follow :ref:`installation <installation>` instructions.

.. note::

    Newly created application repository should be used instead of the |https://github.com/orocrm/crm-application.git|

When your application is up and running, you can use development mode to work on customizations. In order to warm up the 
application cache in development mode please run:

.. code-block:: bash

        $php bin/console cache:clear --env=dev

To access application in development mode, add `index_dev.php` to the base URL
(example: ``http://orocrm.example.com/index_dev.php``).

.. _application-custom-code:

Application Custom Code
-----------------------

Oro application structure is based on |Symfony Standard Edition| and we highly recommend to follow
|Symfony Best Practices| for any custom application that you build on top of OroPlatform, OroCRM, or OroCommerce.

In the root folder of your application, there is an `src` folder. Use it as a working directory
for your custom project and put your custom code there. Like in Symfony applications, all custom code in Oro application
is organized in bundles - modules that group application functionality (see |Symfony Bundle System| for best practice
of module structure and design).

.. note::
    Please note that Oro application has several :ref:`differences <book_differences>` compared to
    Symfony Standard Edition.

Typically, to create a custom application you may follow the common steps:

#) :ref:`Create a bundle <how-to-create-new-bundle>`
#) Introduce :ref:`new entity <dev-entities>` types that represent your business data structure and add
   related features
#) :ref:`Customize <architecture--customization--customize>` existing functionality
   (:ref:`menu <doc-create-and-customize-app-menu>`, :ref:`workflow <dev-doc--workflows>`,
   :ref:`existing entities <add-entity-properties>` etc.)

Application Deployment
----------------------

Oro applications are open source and may be deployed to the on-premise environments. Deployment method could be
different depending on organization requirements and infrastructure. You can design your custom deployment process,
noting the following recommendations:

#) Take into account recommendations in |Symfony Application Deployment| documentation
#) Lock all dependencies with |composer.lock| before taking the code to production
#) Warm up the application cache in production mode
#) Disable access to `index_dev.php`
#) Configure crontab and run web socket server

Oro applications are scalable.

.. note::
    As an alternative to the on-premise deployment, when you created your application following recommendations
    :ref:`above <application-custom-code>`, you can put your application into :ref:`OroCloud <orocloud>`. Please contact us to
    get more information.


.. include:: /include/include-links-dev.rst
   :start-after: begin

