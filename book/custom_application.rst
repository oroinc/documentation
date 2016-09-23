.. index::
    single: Platform Application; Customization

Create Custom Oro Application
=============================

No two businesses are alike - this is part of Oro products philosophy and this is why flexibility is one of
the key principles that drives architecture of Oro products. Depends what you are planning to build, you can
create your custom application with minimum functions and start with `OroPlatform`_, or use `OroCRM`_
or `OroCommerce`_ applications as a base line. No matter what is your starting point, there are no difference
in the customization process.

Application Repository and Installation
---------------------------------------

Before you start working on a new project, it is important to have version control system in place.
The easiest way to start is to `fork application repository`_ of `OroPlatform`_, `OroCRM`_ or `OroCommerce`_ on GitHub.

Once code repository is ready, please follow :doc:`installation </book/installation>` instructions.

.. note::

    Newly created application repository should be used instead https://github.com/orocrm/crm-application.git

When you application is up and running, you can use development mode to work on customizations. In order to warmup
application cache in development mode please run:

.. code-block:: bash

        $php app/console cache:clear --env=dev

In order to access application in development mode add `app_dev.php` to base URL
(example: http://orocrm.example.com/app_dev.php)

.. _application-custom-code:

Application Custom Code
-----------------------

Oro application structure is based on `Symfony Standard Edition`_ and when you are working on a custom application
we highly recommend to follow `Symfony Best Practices`_.

In the root folder of your application there is a folder `src`. This folder should be used as a working directory
for your custom project and all custom code should be located there. In Oro (as well as in Symfony) application all
custom code is organized in bundles. `Symfony Bundle System`_ allows to organize application functionality in modules
as well as provide best practice for module structure and design.

.. note::
    Please pay attention, Oro application has few :doc:`differences </book/differences>` to Symfony Standard Edition

Typical custom application is created in a few common steps:

#) :doc:`Create a bundle </cookbook/how_to_create_new_bundle>`
#) Introduce :doc:`new entity <entities>` types that will represent your business data structure and add
   :doc:`related features </cookbook/entities/index>`
#) :doc:`Customize </cookbook/how_to_extend_existing_bundle>` existing functionality
   (:doc:`menu </cookbook/how_to_create_and_customize_application_menu>`, :doc:`workflow <workflow>`,
   :doc:`validation </cookbook/user_custom_validation_constraints>`,
   :doc:`existing entities </cookbook/entities/adding_properties>` etc.)


Application Deployment
----------------------

Oro applications are Open Source and could be deployed to on premise environments. Deployment method could be
different and depends on organization requirements and infrastructure. When you designing your deployment process
take into account recommendations about `Symfony Application Deploy`_ and pay attantion to the following items:

#) Lock all dependencies with `composer.lock`_ before taking code to production
#) Warmup application cache in production mode
#) Disable access too `app_dev.php`
#) Configure crontab and run web socket server

Oro applications are :doc:`scalable <scale_nodes>`.

.. note::
    As alternative to on premise deployment you can deploy your application to OroCloud, please `contact us`_ to
    get more details and create your application following recommendations :ref:`above <application-custom-code>`.


Learn more
----------

* :doc:`installation`
* :doc:`differences`
* :doc:`customization`
* :doc:`/cookbook/how_to_create_new_bundle`
* :doc:`/cookbook/how_to_extend_existing_bundle`
* :doc:`/cookbook/how_to_create_and_customize_application_menu`
* :doc:`/cookbook/user_custom_validation_constraints`

.. _`OroPlatform` : https://github.com/orocrm/platform-application
.. _`OroCRM` : https://github.com/orocrm/crm-application
.. _`OroCommerce` : https://github.com/orocommerce/orocommerce-application
.. _`fork application repository` : https://help.github.com/articles/fork-a-repo/
.. _`Symfony Standard Edition` : https://github.com/symfony/symfony-standard/tree/2.8
.. _`Symfony Best Practices` : http://symfony.com/doc/2.8/best_practices/index.html
.. _`Symfony Bundle System` : http://symfony.com/doc/2.8/bundles.html
.. _`Symfony Application Deploy` : http://symfony.com/doc/2.8/deployment.html
.. _`composer.lock` : https://getcomposer.org/doc/01-basic-usage.md#composer-lock-the-lock-file
.. _`contact us` : https://www.orocrm.com/contact-us