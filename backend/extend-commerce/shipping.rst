Shipping Methods
================

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
       :linenos:

.. tip:: The body of your class can be empty if you use regular case in the name of your organization (i.e. Acme or ACME in our example). ``getExtension()`` is necessary when you use uppercase, as Symfony treats uppercase letters in the organization prefix as separate words when creating aliases.

2. To enable the bundle, create Resources/config/oro/bundles.yml in the same directory, with the following content:

.. oro_integrity_check:: 033dd84c2b6d9c1b38381abf159fa75ffcfdc716

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Resources/config/oro/bundles.yml
       :language: yaml
       :linenos:

   .. hint:: To fully enable a bundle, you need to regenerate the application cache. However, to save time, you can do it after creation of the shipping integration.

.. tip::
   All the files and subdirectories mentioned in the following sections are to be added to the /src/ACME/Bundle/FastShippingBundle/ directory of your application (referred to as **<bundle_root>**).

Create a Shipping Integration
-----------------------------

Create an Entity to Store the Shipping Method Settings
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Define an entity that to store the configuration settings of the shipping method in the database. To do this, create <bundle_root>/Entity/FastShippingSettings.php:

.. oro_integrity_check:: c84e4cf93b783674e008fa80fbaa7be64d5ee756

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Entity/FastShippingSettings.php
       :language: php
       :linenos:

As you can see from the code above, the only necessary parameter defined for the FastShipping shipping method is the ``label`` parameter.

.. important::
   When naming DB columns, make sure that the name does not exceed 31 symbols. Pay attention to the ``acme_fast_ship_transport_label`` name in the following extract:

.. oro_integrity_check:: 2e0369cfb93bfabfbccfc9253bb0f08ab12c0e47

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Entity/FastShippingSettings.php
       :language: php
       :lines: 27-35
       :linenos:

Create a User Interface Form for the Shipping Method Integration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

When you add an integration via the user interface of the back-office, a form that contains the integration settings appears. In this step, implement the form. To do this, create <bundle_root>/Form/Type/FastShippingTransportSettingsType.php:

.. oro_integrity_check:: a88f8e92e035034f6e05dad7c179e583373f8eed

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Form/Type/FastShippingTransportSettingsType.php
       :language: php
       :linenos:

Add Translations for the Form Texts
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To present the information on the user interface in a user-friendly way, add translations for the shipping method settings' names. To do this, create <bundle_root>/Resources/translations/messages.en.yml:

.. oro_integrity_check:: d1f4bd7d4c66695d6f725d84c6f30a76befe9fe3

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Resources/translations/messages.en.yml
       :language: yaml
       :lines: 1-5
       :linenos:

This defines the name of the field that contains the label.


Create the Integration Channel Type
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

When you select the type of the integration on the user interface, you will see the integration name and the icon that you define in this step.

To implement a channel type, create <bundle_root>/Integration/FastShippingChannelType.php:

.. oro_integrity_check:: 0df950479ca6c4f400fea03fc105ad301d8d9886

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Integration/FastShippingChannelType.php
       :language: php
       :linenos:

Add an Icon for the Integration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To add an icon:

1. Save the file to the <bundle_root>/Resources/public/img directory.
2. Install assets:

   .. code-block:: bash
       :linenos:

       bin/console assets:install --symlink

To make sure that the icon is accessible for the web interface, check if it appears (as a copy or a symlink depending on the settings selected during the application installation) in the /public/bundles/acmefastshipping/img directory of your application.

Create the Integration Transport
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Transport is generally responsible for how the data is obtained from the external system. While the Fast Shipping method does not interact with external systems, you still need to define transport and implement all methods of the TransportInterface for the integration to work properly. To add transport, create <bundle_root>/Integration/FastShippingTransport.php:

.. oro_integrity_check:: fc44c18a5a9cc5921a889a0a6971d541dcd76389

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Integration/FastShippingTransport.php
       :language: php
       :linenos:

Create a Configuration File for the Service Container
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To start using a service container for your bundle, first create the bundle configuration file <bundle_root>/Resources/config/services.yml.

Add the Channel Type and Transport to the Services Container
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
To register the channel type and transport, append the following key-values to <bundle_root>/Resources/config/services.yml:

.. oro_integrity_check:: eee4d98458e6277825ecca9b313281726e92f299

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Resources/config/services.yml
       :language: yaml
       :lines: 1-2,4-16
       :linenos:

Set up Services with DependencyInjection
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To set up services, load your configuration file (services.yml) using the DependencyInjection component. For this, create <bundle_root>/DependencyInjection/FastShippingExtension.php with the following content:

.. oro_integrity_check:: 3b5bb6b3bbc2ca99f8591adec88b40d9ba190da2

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/DependencyInjection/FastShippingExtension.php
       :language: php
       :linenos:

Add Translations for the Channel Type and Transport
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
The channel type and, in general, transport labels also appear on the user interface (you will not see the transport label for Fast Shipping). Provide translations for them by appending the <bundle_root>/Resources/translations/messages.en.yml. Now, the messages.en.yml content must look as follows:

.. oro_integrity_check:: 8be79de57f97af8931f0075a940d92d3188ffecc

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Resources/translations/messages.en.yml
       :language: yaml
       :lines: 1-9
       :linenos:

Add an Installer
^^^^^^^^^^^^^^^^

An installer ensures that upon the application installation, the database will contain the entity that you defined within your bundle.

Follow the instructions provided in the :ref:`How to generate an installer <installer_generate>` topic. After you complete it, you will have the class <bundle_root>/Migrations/Schema/FastShippingBundleInstaller.php with the following content:

.. oro_integrity_check:: d9330c1d8d52507ccd51f8838043ad649d3b5d7f

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Migrations/Schema/FastShippingBundleInstaller.php
       :language: php
       :linenos:

Check That the Integration is Created Successfully
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. Clear the application cache:

   .. code-block:: bash
      :linenos:

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

.. oro_integrity_check:: 45d59be0b6ee5ff7fb356ef715e59ed694ebf289

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Method/FastShippingMethod.php
       :language: php
       :linenos:

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

.. oro_integrity_check:: 363bf0d7a7bbf53dac5f75673128b0d6e74b8f7b

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Resources/config/services.yml
       :language: yaml
       :lines: 18-21
       :linenos:

Create a Factory for the Shipping Method
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This factory generates an individual configuration set for each instance of the integration of the Fast Shipping type. In our case, it also contains the method createTypes() that generates the services (types) of the fast shipping type and assigns them labels.

Create the <bundle_root>/Factory/FastShippingMethodFromChannelFactory.php class with the following content:

.. oro_integrity_check:: a50410908c78868e6fb6d79da9e63ab4ec24d161

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Factory/FastShippingMethodFromChannelFactory.php
       :language: php
       :linenos:

Add the Shipping Method Factory to the Services Container
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To register the shipping method factory, append the following key-values to <bundle_root>/Resources/config/services.yml under the services section:

.. oro_integrity_check:: b13ff51e4b1c431ad27cdddda8011e0ce51d2373

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Resources/config/services.yml
       :language: yaml
       :lines: 23-30
       :linenos:

Create a Shipping Method Provider
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

For this, add the <bundle_root>/Method/FastShippingMethodProvider.php class with the following content:

.. oro_integrity_check:: ba1dc2380ebab53a05b55540a2872514a85d8ddf

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Method/FastShippingMethodProvider.php
       :language: php
       :linenos:

.. TODO: Add Information about the Doctrine
.. In the shipping method provider, the Doctrine ensures that whenever methods are updated,

Add the Shipping Method Provider to the Services Container
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Append the following lines to <bundle_root>/Resources/config/services.yml under the services section:

.. oro_integrity_check:: c742c079dbc22a6564197fd1e750fc6ed2cfe824

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Resources/config/services.yml
       :language: yaml
       :lines: 32-40
       :linenos:


Create a Shipping Method Type
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Shipping method types define different specifics of the same shipping services. For example, for Flat Rate, the type defines whether to calculate shipping price per order or per item. The Fast Shipping will have two types: "With Present" and "Without Present".

To create a shipping method type, add the <bundle_root>/Method/FastShippingMethodType.php class with the following content:

.. oro_integrity_check:: 4430fe35496c8c34628533213174dadbaf981f6b

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Method/FastShippingMethodType.php
       :language: php
       :linenos:


* ``getIdentifier`` --- Returns a unique identifier of a shipping method type in the scope of the shipping method.
* ``getLabel`` --- Returns the label of the shipping method type. The label appears on the shipping rule edit page in the back-office and on the storefront.
* ``getSortOrder`` ---  Defines the order in which shipping method types appear on the user interface. For example, see the UPS shipping types below. The number that defines the sort order of the UPS Ground is lower than that of the UPS 2nd Day Air (i.e. the lower the number, the higher up the list the method type appears):

  .. image:: /img/backend/extend_commerce/shipping_methods_frontend.png

* ``getOptionsConfigurationFormType`` --- Returns the user interface form with the configuration options. The form appears on the shipping rule edit page. If the method returns ``HiddenType::class``, the form does not appear.

.. TODO Add a screenshot

* ``calculatePrice``-- Contains the main logic and returns the shipping price for the given ``$context``.

.. note:: If you implement a more complicated shipping method, see Oro\Bundle\ShippingBundle\Context\ShippingContextInterface for attributes that can affect a shipping price (e.g. shipping address information or line items).

Define Translation for the Shipping Method Type
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Provide translations by appending the <bundle_root>/Resources/translations/messages.en.yml. Now, the messages.en.yml content must look as follows:

.. oro_integrity_check:: 0e70cd37c74c89e268e8094e10ac90fb5038ebcd

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Resources/translations/messages.en.yml
       :language: yaml
       :lines: 1-14
       :linenos:


Create a Shipping Method Options Form
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This form with options for a shipping method appears on the user interface of the back-office when you add the shipping method to a shipping rule. Add FastShippingMethodOptionsType.php to the <bundle_root>/Form/Type/ directory:

.. oro_integrity_check:: 674b8ac14425cddf0db5d0122dbc0074f59be629

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Form/Type/FastShippingMethodOptionsType.php
       :language: php
       :linenos:

Add the Shipping Method Options Form to the Services Container
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Append the following lines to <bundle_root>/Resources/config/services.yml under the services section:

.. oro_integrity_check:: 920250ee0275fbb7be5b32ce806d04b1acf5c975

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Resources/config/services.yml
       :language: yaml
       :lines: 42-47
       :linenos:

Define Translation for the Shipping Method Form Options
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Provide translations by appending the <bundle_root>/Resources/translations/messages.en.yml. Now, the messages.en.yml content must look as follows:

.. oro_integrity_check:: 112b933ff20734ab19fada34ad8dd10c3ec767bc

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Resources/translations/messages.en.yml
       :language: yaml
       :lines: 1-16
       :linenos:

Add a Template
^^^^^^^^^^^^^^
In the shipping rules, this template is used to display the configured settings of the Fast Shipping integration.

Create the /Resources/views/method/fastShippingMethodWithOptions.html.twig file with the following content:

.. oro_integrity_check:: 9c3be892281ba88079109ead161c909d271f36f1

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Resources/views/method/fastShippingMethodWithOptions.html.twig
       :language: html
       :linenos:

Add a Check for When Users Disable Used Shipping Method Types
-------------------------------------------------------------

To show a notification when a user disables or removes the integration currently used in shipping rules, use the event listeners to catch the corresponding event and the event handlers.

Add Event Listeners to the System Container
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Append the following lines to <bundle_root>/Resources/config/services.yml under the parameters and services sections:

.. oro_integrity_check:: e5b4608f46abe56b90cda56780eee240ce3ffb77

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Resources/config/services.yml
       :language: yaml
       :lines: 1,3-5,49-73
       :linenos:

Add Actions
^^^^^^^^^^^

Create actions.yml in the <bundle_root>/Resources/config/oro/ directory:

.. oro_integrity_check:: a41243b6b0aa769199c930d0b1ddf73fad1ccf48

   .. literalinclude:: /code_examples/commerce/shipping_method/fast-shipping/Resources/config/oro/actions.yml
       :language: yaml
       :linenos:
