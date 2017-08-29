.. index::
    single: Platform Application; Customization

Custom Oro Application
======================

No two businesses are alike. This motto is a part of Oro products philosophy and this is why flexibility is one of
the key principles that drive architecture in Oro. Depending on what you are planning to build, you can
create your custom application with minimum functions starting either with `OroPlatform`_, or `OroCRM`_, or 
`OroCommerce`_ application as a baseline. No matter what is your starting point, there is no difference
in the customization process.

Application Repository and Installation
---------------------------------------

Before you start working on a new project, it is important to have version control system in place.
The easiest way to start is to `fork application repository`_ of `OroPlatform`_, `OroCRM`_ or `OroCommerce`_ on GitHub.

Once code repository is ready, please follow :ref:`installation <book_installation>` instructions.

.. note::

    Newly created application repository should be used instead of the https://github.com/orocrm/crm-application.git

When your application is up and running, you can use development mode to work on customizations. In order to warm up the 
application cache in development mode please run:

.. code-block:: bash

        $php app/console cache:clear --env=dev

To access application in development mode, add `app_dev.php` to the base URL
(example: http://orocrm.example.com/app_dev.php).

.. _application-custom-code:

Application Custom Code
-----------------------

Oro application structure is based on `Symfony Standard Edition`_ and we highly recommend to follow
`Symfony Best Practices`_ for any custom application that you build on top of OroPlatform, OroCRM, or OroCommerce.

In the root folder of your application, there is an `src` folder. Use it as a working directory
for your custom project and put your custom code there. Like in Symfony applications, all custom code in Oro application
is organized in bundles - modules that group application functionality (see `Symfony Bundle System`_ for best practice
of module structure and design).

.. note::
    Please note that Oro application has several :ref:`differences <book_differences>` compared to
    Symfony Standard Edition.

Typically, to create a custom application you may follow the common steps:

#) :doc:`Create a bundle </cookbook/how_to_create_new_bundle>`
#) Introduce :doc:`new entity <entity_handling/entities>` types that represent your business data structure and add
   :doc:`related features </cookbook/entities/index>`
#) :doc:`Customize </cookbook/how_to_extend_existing_bundle>` existing functionality
   (:doc:`menu </cookbook/how_to_create_and_customize_application_menu>`, :doc:`workflow <data/workflow>`,
   :doc:`validation </cookbook/user_custom_validation_constraints>`,
   :doc:`existing entities </cookbook/entities/adding_properties>` etc.)


Application Deployment
----------------------

Oro applications are open source and may be deployed to the on-premise environments. Deployment method could be
different depending on organization requirements and infrastructure. You can design your custom deployment process,
noting the following recommendations:

#) Take into account recommendations in `Symfony Application Deployment`_ documentation
#) Lock all dependencies with `composer.lock`_ before taking the code to production
#) Warm up the application cache in production mode
#) Disable access to `app_dev.php`
#) Configure crontab and run web socket server

Oro applications are :doc:`scalable <scale_nodes>`.

.. note::
    As an alternative to the on-premise deployment, when you created your application following recommendations
    :ref:`above <application-custom-code>`, you can put your application into OroCloud. Please `contact us`_ to
    get more information.


Learn more
----------

* :doc:`getting_started_book/installation`
* :doc:`getting_started_book/differences`
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
.. _`Symfony Application Deployment` : http://symfony.com/doc/2.8/deployment.html
.. _`composer.lock` : https://getcomposer.org/doc/01-basic-usage.md#composer-lock-the-lock-file
.. _`contact us` : https://www.orocrm.com/contact-us
