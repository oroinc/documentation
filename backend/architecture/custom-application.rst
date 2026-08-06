.. index::
    single: Platform Application; Customization

.. _custom-oro-application:
.. _dev-cookbook-create-custom-oro-application:

Custom Oro Application
======================

No two businesses are alike. This motto is part of Oro's product philosophy, which is why flexibility is a
fundamental principle driving its architecture. Whatever you plan to build, you can create a custom application
with minimal functions, starting from the |OroCommerce| application as a baseline.

Application Repository and Installation
---------------------------------------

Before you start a new project, set up a version control system. The easiest way is to
|fork application repository| of |OroCommerce| on GitHub.

Once the code repository is ready, follow the :ref:`installation <installation>` instructions.

.. note::

    A newly created application repository should be used instead of the |https://github.com/oroinc/orocommerce-application.git|

Once your application is up and running, use development mode to work on customizations. To warm up the
application cache in development mode, run:

.. code-block:: none

        php bin/console cache:clear --env=dev

To access the application in development mode, add `index_dev.php` to the base URL
(example: ``http://orocommerce.example.com/index_dev.php``).

.. _application-custom-code:

Application Custom Code
-----------------------

Oro application structure is based on |Symfony Standard Edition|, and we highly recommend following
|Symfony Best Practices| for any custom application you build on top of OroCommerce.

The root folder of your application contains an `src` folder. Use it as the working directory for your
custom project, and put your custom code there.

Like in Symfony applications, all custom code in the Oro application is organized in bundles --- modules that
group application functionality (see |Symfony Bundle System| for best practices of module structure and design).

.. note::
    Please note that the Oro application has several :ref:`differences <book_differences>` compared to
    Symfony Standard Edition.

To create a custom application, follow these typical steps:

#) :ref:`Create a bundle <how-to-create-new-bundle>`.
#) Introduce :ref:`new entity <dev-entities>` types that represent your business data structure and add related features.
#) :ref:`Customize <architecture--customization--customize>` existing functionality (:ref:`menu <doc-create-and-customize-app-menu>`, :ref:`workflow <dev-doc--workflows>`, :ref:`extend entities <book-entities-extended-entities>`, etc.).

Application Deployment
----------------------

Oro applications are open source and can be deployed to on-premise environments. Deployment methods vary depending on organization requirements and infrastructure. You can design your own deployment process, but make sure you follow the recommendations below:

#) Follow the advice outlined in the |Symfony Application Deployment| documentation.
#) Lock all dependencies with |composer.lock| before taking the code to production.
#) Warm up the application cache in production mode.
#) Disable access to `index_dev.php`.
#) Configure crontab and run web socket server.

Oro applications are scalable.

.. note::
    As an alternative to on-premise deployment, you can deploy your application to |OroCloud|, provided you create it following the recommendations :ref:`above <application-custom-code>`. Get in touch with us for more information.

Related Articles
----------------

* :ref:`Bundle-less Structure <dev-backend-architecture-bundle-less-structure>`

.. include:: /include/include-links-dev.rst
   :start-after: begin
