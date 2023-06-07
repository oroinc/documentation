.. _bundle-docs-platform-distribution-bundle:

OroDistributionBundle
=====================

|OroDistributionBundle| enables application bundles registration based on their YAML configuration files without changing the application files. It also provides CLI to manage Oro packages in the applications.

Use the Bundle
--------------

Add `Resources/config/oro/bundles.yml` file to every bundle you want to be autoregistered:

.. code-block:: yaml

    bundles:
        - { name: VendorName\Bundle\VendorBundle\VendorAnyBundle, priority: 50 }
        - { name: Acme\Bundle\DemoBundle\AcmeDemoBundle, priority: 50 }
    #   - ...


Your bundle (and "VendorAnyBundle") will now be automatically registered in AppKernel.php.

Exclusions
----------

.. code-block:: none

    bundles:
        ...

    exclusions:
        - { name: VendorName\Bundle\VendorBundle\VendorAnyBundle }

Autoload Routes
---------------

Add the `Resources/config/oro/routing.yml` file to every bundle for which you want to autoload its routes.

Add the following rule to the application's `routing.yml`:

.. code-block:: yaml

    oro_default:
        path: '%web_backend_prefix%/'
        defaults:
            _controller: Oro\Bundle\DashboardBundle\Controller\DashboardController::viewAction

    oro_auto_routing: # to load bundles
        resource: .
        type:     oro_auto

    oro_expose:       # to load exposed assets
        resource: .
        type:     oro_expose

All routes from your bundles will be imported automatically.

.. include:: /include/include-links-dev.rst
   :start-after: begin

