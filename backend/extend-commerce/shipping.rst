Create Shipping Method Integrations
===================================

This topic describes how to add a custom shipping method to your OroCommerce-based store.

It is recommended to manage shipping methods through integrations. Therefore, to create a new shipping method:

- Implement an integration for the shipping method
- Implement the shipping method itself


Usually, a shipping method has several services to provide a flexible choice of price and delivery time. As an example, we will implement the "Fast Shipping" method --- a simple method that requires just the minimum set of options to operate. It will have two services (types): "With present" and "Without present". Thus, at the end of the topic, you will have the understanding of what steps are necessary to add a workable shipment method and the basic template that you can further extend when the need arises.

Create a Bundle
---------------

First, create and enable the FastShippingBundle bundle for your shipping method as described in the :ref:`How to create a new bundle <how-to-create-new-bundle>` topic:

1. In the /src/ACME/Bundle/FastShippingBundle/ directory of your application, create class ACMEFastShippingBundle.php:

.. oro_integrity_check:: 68a42f8675c61b7e479501ed5fadc15d63fbc883

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/ACMEFastShippingBundle.php
       :language: php


.. tip:: The body of your class can be empty if you use regular case in the name of your organization (i.e. Acme or ACME in our example). ``getExtension()`` is necessary when you use uppercase, as Symfony treats uppercase letters in the organization prefix as separate words when creating aliases.

2. To enable the bundle, create Resources/config/oro/bundles.yml in the same directory, with the following content:

.. oro_integrity_check:: 033dd84c2b6d9c1b38381abf159fa75ffcfdc716

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Resources/config/oro/bundles.yml
       :language: yaml


   .. hint:: To fully enable a bundle, you need to regenerate the application cache. However, to save time, you can do it after creation of the shipping integration.

.. tip::
   All the files and subdirectories mentioned in the following sections are to be added to the /src/ACME/Bundle/FastShippingBundle/ directory of your application (referred to as **<bundle_root>**).

Create a Shipping Integration
-----------------------------

Create an Entity to Store the Shipping Method Settings
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Define an entity that to store the configuration settings of the shipping method in the database. To do this, create <bundle_root>/Entity/FastShippingSettings.php:

.. oro_integrity_check:: ac678894a070719f255b6510c18aec28fceec9d0

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Entity/FastShippingSettings.php
       :language: php


As you can see from the code above, the only necessary parameter defined for the FastShipping shipping method is the ``label`` parameter.

.. important::
   When naming DB columns, make sure that the name does not exceed 31 symbols. Pay attention to the ``acme_fast_ship_transport_label`` name in the following extract:

.. oro_integrity_check:: 2e0369cfb93bfabfbccfc9253bb0f08ab12c0e47

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Entity/FastShippingSettings.php
       :language: php
       :lines: 27-35


Create a User Interface Form for the Shipping Method Integration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

When you add an integration via the user interface of the back-office, a form that contains the integration settings appears. In this step, implement the form. To do this, create <bundle_root>/Form/Type/FastShippingTransportSettingsType.php:

.. oro_integrity_check:: a88f8e92e035034f6e05dad7c179e583373f8eed

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Form/Type/FastShippingTransportSettingsType.php
       :language: php


Add Translations for the Form Texts
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To present the information on the user interface in a user-friendly way, add translations for the shipping method settings' names. To do this, create <bundle_root>/Resources/translations/messages.en.yml:

.. oro_integrity_check:: d1f4bd7d4c66695d6f725d84c6f30a76befe9fe3

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Resources/translations/messages.en.yml
       :language: yaml
       :lines: 1-5


This defines the name of the field that contains the label.


Create the Integration Channel Type
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

When you select the type of the integration on the user interface, you will see the integration name and the icon that you define in this step.

To implement a channel type, create <bundle_root>/Integration/FastShippingChannelType.php:

.. oro_integrity_check:: 0df950479ca6c4f400fea03fc105ad301d8d9886

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Integration/FastShippingChannelType.php
       :language: php


Add an Icon for the Integration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To add an icon:

1. Save the file to the <bundle_root>/Resources/public/img directory.
2. Install assets:

   .. code-block:: none


       bin/console assets:install --symlink

To make sure that the icon is accessible for the web interface, check if it appears (as a copy or a symlink depending on the settings selected during the application installation) in the /public/bundles/acmefastshipping/img directory of your application.

Create the Integration Transport
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Transport is generally responsible for how the data is obtained from the external system. While the Fast Shipping method does not interact with external systems, you still need to define transport and implement all methods of the TransportInterface for the integration to work properly. To add transport, create <bundle_root>/Integration/FastShippingTransport.php:

.. oro_integrity_check:: 09af302aa2d069af850489e072c47b72be7ad704

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Integration/FastShippingTransport.php
       :language: php


Create a Configuration File for the Service Container
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To start using a service container for your bundle, first create the bundle configuration file <bundle_root>/Resources/config/services.yml.

Add the Channel Type and Transport to the Services Container
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
To register the channel type and transport, append the following key-values to <bundle_root>/Resources/config/services.yml:

.. oro_integrity_check:: 275174a664fc3b0b6e4cf880ce46af384d0859e1

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Resources/config/services.yml
       :language: yaml
       :lines: 1-2,4-14


Set up Services with DependencyInjection
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To set up services, load your configuration file (services.yml) using the DependencyInjection component. For this, create <bundle_root>/DependencyInjection/FastShippingExtension.php with the following content:

.. oro_integrity_check:: 03400de1f9e19f08b99a7aaffa96f859a9c0e6dc

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/DependencyInjection/FastShippingExtension.php
       :language: php


Add Translations for the Channel Type and Transport
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
The channel type and, in general, transport labels also appear on the user interface (you will not see the transport label for Fast Shipping). Provide translations for them by appending the <bundle_root>/Resources/translations/messages.en.yml. Now, the messages.en.yml content must look as follows:

.. oro_integrity_check:: 8be79de57f97af8931f0075a940d92d3188ffecc

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Resources/translations/messages.en.yml
       :language: yaml
       :lines: 1-9


Add an Installer
^^^^^^^^^^^^^^^^

An installer ensures that upon the application installation, the database will contain the entity that you defined within your bundle.

Follow the instructions provided in the :ref:`How to generate an installer <installer_generate>` topic to apply the changes without migration and generate an installer file based on the current schema of the DB.

.. note:: If you have not performed the steps mentioned in :ref:`How to generate an installer <installer_generate>`, because you already have the installer file, then make sure to run the ``php bin/console oro:migration:load --force`` command to apply the changes from the file.

After you complete the process, you will have the <bundle_root>/Migrations/Schema/FastShippingBundleInstaller.php class with the following content:

.. oro_integrity_check:: 45e56fd393c71daa9600263856f17417f12b03f2

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Migrations/Schema/FastShippingBundleInstaller.php
       :language: php



Check That the Integration is Created Successfully
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. Clear the application cache:

   .. code-block:: none


      bin/console cache:clear

   .. note::

      If you are working in a production environment, you have to use the ``--env=prod`` parameter with the command.

2. Open the user interface and check that the changes have applied and you can add an integration of the Fast Shipping type. Note that at this point you are not yet able to add this shipping method to a shipping rule.

   .. image:: /img/backend/extend_commerce/shipping_method_create2.png
      :alt: View the Fast Shipping integration details.

Implement a Shipping Method
---------------------------

Now implement the shipping method itself using the following steps:

.. contents:: :local:

Implement the Main Method
^^^^^^^^^^^^^^^^^^^^^^^^^

To implement the main method, create the <bundle_root>/Method/FastShippingMethod.php class that implements two standard interfaces ``\Oro\Bundle\ShippingBundle\Method\ShippingMethodInterface`` and ``\Oro\Bundle\ShippingBundle\Method\ShippingMethodIconAwareInterface``:

.. oro_integrity_check:: 6ee4e3d862013768e3f427be51e25dc96dd666c7

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Method/FastShippingMethod.php
       :language: php


The methods are the following:

* ``getIdentifier`` --- Provides a unique identifier of the shipping method in the scope of the Oro application.
* ``getLabel`` --- Returns the shipping method's label that appears on the shipping rule edit page. It can also be a Symfony translated message.
* ``getIcon`` --- Returns the icon that appears on the shipping rule edit page.
* ``isEnabled`` --- Defines, whether the integration of the shipping method is enabled by default.
* ``isGrouped`` --- Defines how shipping method's types appear in the shipping method configuration on the user interface. If set to ``true``, the types appear in the table where each line contains the **Active** check box that enables users to enable individual shipping method types for a particular shipping method configuration.

* ``getSortOrder`` ---  Defines the order in which shipping methods appear on the user interface. For example, in the following screenshot, the Flat rate sort order is lower than the UPS sort order:

  .. image:: /img/backend/extend_commerce/shipping_methods_frontend.png

* ``getType`` --- Returns the selected shipping method type based on the type identifier.
* ``getTypes`` --- Returns a set of the shipping method types.
* ``getOptionsConfigurationFormType`` --- Returns the user interface form with the configuration options. The form appears on the shipping rule edit page. If the method returns ``HiddenType::class``, the form does not appear.

Add the Shipping Method Identifier Generator to the Services Container
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Append the following lines to <bundle_root>/Resources/config/services.yml:

.. oro_integrity_check:: c7255b0da9fb2b8b3fe9a9a982dcc4734fb53be6

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Resources/config/services.yml
       :language: yaml
       :lines: 16-20


Create a Factory for the Shipping Method
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This factory generates an individual configuration set for each instance of the integration of the Fast Shipping type. In our case, it also contains the method createTypes() that generates the services (types) of the fast shipping type and assigns them labels.

Create the <bundle_root>/Factory/FastShippingMethodFromChannelFactory.php class with the following content:

.. oro_integrity_check:: abeb7c686a820ca95bbf0a679e7696840e9adb7b

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Factory/FastShippingMethodFromChannelFactory.php
       :language: php


Add the Shipping Method Factory to the Services Container
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To register the shipping method factory, append the following key-values to <bundle_root>/Resources/config/services.yml under the services section:

.. oro_integrity_check:: 5003781a2531d0cdfdac202687cd64b7dc3cbddf

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Resources/config/services.yml
       :language: yaml
       :lines: 22-29


Create a Shipping Method Provider
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

For this, add the <bundle_root>/Method/FastShippingMethodProvider.php class with the following content:

.. oro_integrity_check:: ba1dc2380ebab53a05b55540a2872514a85d8ddf

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Method/FastShippingMethodProvider.php
       :language: php


Add the Shipping Method Provider to the Services Container
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Append the following lines to <bundle_root>/Resources/config/services.yml under the services section:

.. oro_integrity_check:: c742c079dbc22a6564197fd1e750fc6ed2cfe824

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Resources/config/services.yml
       :language: yaml
       :lines: 30-38


Create a Shipping Method Type
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Shipping method types define different specifics of the same shipping services. For example, for Flat Rate, the type defines whether to calculate shipping price per order or per item. The Fast Shipping will have two types: "With Present" and "Without Present".

To create a shipping method type, add the <bundle_root>/Method/FastShippingMethodType.php class with the following content:

.. oro_integrity_check:: a49655845ecd626f4f6ffaffc6670c2ea58c26b7

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Method/FastShippingMethodType.php
       :language: php


* ``getIdentifier`` --- Returns a unique identifier of a shipping method type in the scope of the shipping method.
* ``getLabel`` --- Returns the label of the shipping method type. The label appears on the shipping rule edit page in the back-office and in the storefront.
* ``getSortOrder`` ---  Defines the order in which shipping method types appear on the user interface. For example, see the UPS shipping types below. The number that defines the sort order of the UPS Ground is lower than that of the UPS 2nd Day Air (i.e. the lower the number, the higher up the list the method type appears):

  .. image:: /img/backend/extend_commerce/shipping_methods_frontend.png

* ``getOptionsConfigurationFormType`` --- Returns the user interface form with the configuration options. The form appears on the shipping rule edit page. If the method returns ``HiddenType::class``, the form does not appear.

* ``calculatePrice``-- Contains the main logic and returns the shipping price for the given ``$context``.

.. note:: If you implement a more complicated shipping method, see Oro\Bundle\ShippingBundle\Context\ShippingContextInterface for attributes that can affect a shipping price (e.g., shipping address information or line items).

Define Translation for the Shipping Method Type
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Provide translations by appending the <bundle_root>/Resources/translations/messages.en.yml. Now, the messages.en.yml content must look as follows:

.. oro_integrity_check:: 0e70cd37c74c89e268e8094e10ac90fb5038ebcd

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Resources/translations/messages.en.yml
       :language: yaml
       :lines: 1-14


Create a Shipping Method Options Form
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This form with options for a shipping method appears on the user interface of the back-office when you add the shipping method to a shipping rule. Add FastShippingMethodOptionsType.php to the <bundle_root>/Form/Type/ directory:

.. oro_integrity_check:: 231abf3ba11d6b18b05e7690180da3275b1c71f5

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Form/Type/FastShippingMethodOptionsType.php
       :language: php


Add the Shipping Method Options Form to the Services Container
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Append the following lines to <bundle_root>/Resources/config/services.yml under the services section:

.. oro_integrity_check:: 920250ee0275fbb7be5b32ce806d04b1acf5c975

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Resources/config/services.yml
       :language: yaml
       :lines: 40-45


Define Translation for the Shipping Method Form Options
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Provide translations by appending the <bundle_root>/Resources/translations/messages.en.yml. Now, the messages.en.yml content must look as follows:

.. oro_integrity_check:: 112b933ff20734ab19fada34ad8dd10c3ec767bc

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Resources/translations/messages.en.yml
       :language: yaml
       :lines: 1-16


Add a Template
^^^^^^^^^^^^^^
In the shipping rules, this template is used to display the configured settings of the Fast Shipping integration.

Create the /Resources/views/method/fastShippingMethodWithOptions.html.twig file with the following content:

.. oro_integrity_check:: 9c3be892281ba88079109ead161c909d271f36f1

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Resources/views/method/fastShippingMethodWithOptions.html.twig
       :language: html


Add a Check for When Users Disable Used Shipping Method Types
-------------------------------------------------------------

To show a notification when a user disables or removes the integration currently used in shipping rules, use the event listeners to catch the corresponding event and the event handlers.

Add Event Listeners to the System Container
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Append the following lines to <bundle_root>/Resources/config/services.yml under the parameters and services sections:

.. oro_integrity_check:: e5b4608f46abe56b90cda56780eee240ce3ffb77

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Resources/config/services.yml
       :language: yaml
       :lines: 1,3-5,47-71


Add Actions
^^^^^^^^^^^

Create actions.yml in the <bundle_root>/Resources/config/oro/ directory:

.. oro_integrity_check:: a41243b6b0aa769199c930d0b1ddf73fad1ccf48

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Resources/config/oro/actions.yml
       :language: yaml


To enable this shipping method, you need to set up a corresponding shipping rule. Follow the :ref:`Shipping Rules Configuration <sys--shipping-rules>` topic for more details.
