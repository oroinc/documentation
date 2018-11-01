.. _dev-cookbook-create-custom-oro-application:

Create Custom Oro Application
=============================

No two businesses are alike. This motto is a part of Oro products philosophy and this is why flexibility is one of
the key principles that drive architecture in Oro. Depending on what you are planning to build, you can
create your custom application with minimum functions starting either with `OroPlatform`_, or `OroCRM`_, or 
`OroCommerce`_ application as a baseline. No matter what is your starting point, there is no difference
in the customization process.

Application Repository and Installation
---------------------------------------

Before you start working on a new project, it is important to have version control system in place.
The easiest way to start is to `fork application repository`_ of `OroPlatform`_, `OroCRM`_ or `OroCommerce`_ on GitHub.

Once code repository is ready, please follow :ref:`installation <installation>` instructions.

.. note::

    Your own newly created application repository should be used instead of the https://github.com/oroinc/platform-application.git

When your application is up and running, you can use development mode to work on customizations.

To access application in development mode, add `index_dev.php` to the base URL
(example: http://orocrm.example.com/index_dev.php).

.. _application-custom-code:

Application Custom Code
-----------------------

Oro application structure is based on `Symfony 4 Directory Structure`_ and we highly recommend to follow
`Symfony Best Practices`_ for any custom application that you build on top of OroPlatform, OroCRM, or OroCommerce.

In the root folder of your application, there is an `src` folder. Use it as a working directory
for your custom project and put your custom code there. All custom code in Oro application
is organized in bundles - modules that group application functionality (see `Symfony Bundle System`_ for best practice
of module structure and design).

.. note::
    Please note that Oro application has several :ref:`differences <dev-guide-application-web-framework-symfony>` compared to
    Symfony Standard Edition.

Application Deployment
----------------------

Oro applications are open source and may be deployed to the on-premise environments. Deployment method could be
different depending on organization requirements and infrastructure. You can design your custom deployment process,
noting the following recommendations:

#) Take into account recommendations in `Symfony Application Deployment`_ documentation
#) Lock all dependencies with `composer.lock`_ before taking the code to production
#) Warm up the application cache in production mode
#) Disable access to `index_dev.php`
#) Configure crontab and run web socket server as described in the :ref:`Installation Guide <install-for-dev>`

.. note::
    As an alternative to the on-premise deployment, when you created your application following recommendations
    :ref:`above <application-custom-code>`, you can put your application into OroCloud. Please `contact us`_ to
    get more information.

.. @todo Add link to the :ref:`OroCloud <orocloud>` section after it will be added to the OroPlatform documentation

Learn more
----------

* :doc:`/install_upgrade/installation_quick_start_dev/index`
* :doc:`/dev_guide/web_framework/index`
* :doc:`/dev_cookbook/framework/how_to_create_new_bundle`

.. _`OroPlatform`: https://github.com/oroinc/platform-application
.. _`OroCRM`: https://github.com/oroinc/crm-application
.. _`OroCommerce`: https://github.com/oroinc/orocommerce-application
.. _`fork application repository`: https://help.github.com/articles/fork-a-repo/
.. _`Symfony 4 Directory Structure`: http://fabien.potencier.org/symfony4-directory-structure.html
.. _`Symfony Best Practices`: https://symfony.com/doc/3.4/best_practices/index.html
.. _`Symfony Bundle System`: https://symfony.com/doc/3.4/bundles.html
.. _`Symfony Application Deployment`: https://symfony.com/doc/3.4/deployment.html
.. _`composer.lock`: https://getcomposer.org/doc/01-basic-usage.md#composer-lock-the-lock-file
.. _`contact us`: https://www.oroinc.com/oroplatform/contact-us
