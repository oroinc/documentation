.. _book_differences:

Differences to Common Symfony Applications
==========================================

When you are familiar with building Symfony applications from scratch, you will recognize many well
known building blocks when you start your first project using OroPlatform or OroCRM. However,
there are some not so subtle differences you need to understand to efficiently develop your
application.

This article will give you a short overview about the most important things OroPlatform
differs from usual Symfony applications. Each section will link to other resources where you can
learn more about a particular feature.

The Application Kernel
----------------------

In Symfony applications, you usually register your own bundles as well as all the third-party
bundles from the ``vendor`` directory in the famous ``AppKernel`` class. This is not needed when
using OroPlatform. It ships with it own kernel that discovers bundles under the ``src`` and
the ``vendor`` directories automatically if the contain a ``bundles.yml`` configuration file in
their ``Resources/config/oro`` directory.

This file has to contain a list of bundle classes to initialize under the ``bundles`` key. usually,
this will only be one class name:

.. code-block:: yaml
   :caption: src/Acme/DemoBundle/Resources/config/oro/bundles.yml

    bundles:
        - Acme\DemoBundle\AcmeDemoBundle

Optionally, you can also specify a priority. The priority defines the order in which bundles will
be loaded. If you omit the priority, its value will implicitly be 0:

.. code-block:: yaml
   :caption: src/Acme/DemoBundle/Resources/config/oro/bundles.yml

    bundles:
        - { name: Acme\DemoBundle\AcmeDemoBundle, priority: 10 }

.. caution::

    Other than what you would probably expect, a higher priority does not mean that a bundle is
    loaded before a bundle with a lower priority. Instead, lower prioritized bundles will be loaded
    first.

.. tip::

    The default priority for all  bundles is 0.

Routing Configuration
---------------------

You can configure routes for your controller actions the same way that you are used with Symfony.
However, usually you would manually an import for your routing configuration in the main
``routing.yml`` file in your ``config`` directory like this:

.. code-block:: yaml
   :caption: config/routing.yml

    default_controller:
        resource: "@AcmeDemoBundle/Controller/DefaultController.php"
        type:     annotation

    acme_demo:
        resource: "@AcmeDemoBundle/Resources/config/routing.yml"
        prefix: /demo

With OroPlatform, you can still configure your routes the way you like. Though as long as you
create a main ``routing.yml`` file located in the bundle's ``Resources/config/oro`` directory, you
do not have to register your routing config in the application config, but it will be discovered
automatically.

Access Control Lists
--------------------

When it comes to |Access Control Lists| (ACLs), things are getting complicated. You need to deal
with the ACL provider, object identities, ACEs, the mask builder, etc. OroPlatform makes
things easier by providing an |@Acl| annotation that you can use to define an ACL and to protect
a controller in a single step:

.. code-block:: php
   :caption: src/Acme/DemoBundle/Controller/BlogController.php

    namespace Acme\DemoBundle\Controller;

    use Oro\Bundle\SecurityBundle\Annotation\Acl;

    // ...

    /**
     * @Acl(
     *     id="acme_demo.blog_post_view",
     *     type="entity",
     *     class="AcmeDemoBundle:BlogPost",
     *     permission="VIEW"
     * )
     */
    public function indexAction()
    {
        // ...
    }

Furthermore, once an ACL has been defined, you can reuse it using the |@AclAncestor| annotation:

.. code-block:: php
   :caption: src/Acme/DemoBundle/Controller/BlogController.php

    namespace Acme\DemoBundle\Controller;

    use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

    // ...

    /**
     * @AclAncestor("acme_demo.blog_post_view")
     */
    public function postAction()
    {
        // ...
    }

.. seealso::

    Read more in the :ref:`Security documentation <bundle-docs-platform-security-bundle>`.

Extension Management
--------------------

Using |Composer|, you can easily pull in third-party libraries and bundles that you need in your
application. This does not change when using OroPlatform. But additionally to the common
dependency management with Composer, you can also install a special type of package - an Oro
Extension. An extension is a package that adds new features to the Platform. To achieve this, the
|OroDistributionBundle| leverages Composer and |Packagist|. All extensions are feature on the
|Oro MarketplaceCommerce|. The cool thing is that you do not have to use the command-line to install
extensions (of course, you can do this if you want to), but that a user with admin permissions can
install them on their own in the UI.

.. seealso::

    You can also :ref:`add your own extension <dev--extend--how-to-publish-extension-on-the-marketplace>`
    to the Oro Marketplace.


.. include:: /include/include-links-dev.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin