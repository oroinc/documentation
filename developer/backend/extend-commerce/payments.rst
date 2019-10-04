Payment Methods
===============

This topic describes how to add a custom payment method to your OroCommerce-based store.

It is recommended to manage payment methods through integrations. Therefore, to create a new payment method:

- Implement an integration for a payment method
- Implement a payment method itself

As an example, let us implement a collect on delivery (cash on delivery, COD) payment option. This is a simple method that does not utilize external services (like credit card payment interfaces) and requires just the minimum set of options to operate. Thus, at the end of the topic, you will have the understanding of what steps are necessary to add a workable payment method and the basic template that you can further extend when the need arises.

Create a Bundle
---------------

First, create and enable the CollectOnDeliveryBundle bundle for your payment method as described in the :ref:`How to create a new bundle <how-to-create-new-bundle>` topic:

1. In the /src/ACME/Bundle/CollectOnDeliveryBundle/ directory of your application, create class ACMECollectOnDeliveryBundle.php:

.. oro_integrity_check:: 77ce5cbc1534c61de3f96d2212bae5a0331e054a

   .. literalinclude:: /developer/code_examples/commerce/payment_method/collect-on-delivery/ACMECollectOnDeliveryBundle.php
       :language: php
       :linenos:

2. To enable the bundle, create Resources/config/oro/bundles.yml in the same directory, with the following content:

.. oro_integrity_check:: a9388a277cefa62bf6bb745a93d13c1ba4b6ac89

   .. literalinclude:: /developer/code_examples/commerce/payment_method/collect-on-delivery/Resources/config/oro/bundles.yml
       :language: yaml
       :linenos:

   .. hint:: To fully enable a bundle, you need to regenerate the application cache. However, to save time, you can do it after creation of the payment integration.


.. tip::
   All the files and subdirectories mentioned in the following sections of this topic are to be added to the /src/ACME/Bundle/CollectOnDeliveryBundle/ directory of your application (referred to as **<bundle_root>**).

Create a Payment Integration
----------------------------

Create an Entity to Store the Payment Method Settings
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Define an entity to store the configuration settings of the payment method in the database. To do this, create <bundle_root>/Entity/CollectOnDeliverySettings.php:

.. oro_integrity_check:: 5b759e15f46f7218968a228e6cf572fdb794524f

   .. literalinclude:: /developer/code_examples/commerce/payment_method/collect-on-delivery/Entity/CollectOnDeliverySettings.php
       :language: php
       :linenos:

As you can see from the code above, the only two necessary parameters are defined for our collect on delivery payment method: ``labels`` and ``shortLabels``.

.. important::
   When naming DB columns, make sure that the name does not exceed 31 symbols. Pay attention to the acme_coll_on_deliv_short_label name in the following extract:

   .. oro_integrity_check:: e60794598ebf99259295cb4563e5e36017094c32

      .. literalinclude:: /developer/code_examples/commerce/payment_method/collect-on-delivery/Entity/CollectOnDeliverySettings.php
         :language: php
         :lines: 49-57
         :linenos:


Create a Repository That Returns the Payment Method Settings
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The repository returns on request the configuration settings stored by the entity that you created in the previous step. To add the repository, create <bundle_root>/Entity/Repository/CollectOnDeliverySettingsRepository.php:

.. oro_integrity_check:: b4c06eaa157f5b6915293e23e8d5bc986f8113e2

   .. literalinclude:: /developer/code_examples/commerce/payment_method/collect-on-delivery/Entity/Repository/CollectOnDeliverySettingsRepository.php
      :language: php
      :linenos:


Create a User Interface Form for the Payment Method Integration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

When you add an integration via the user interface of the back-office, a form that contains the integration settings appears. In this step, implement the form. To do this, create <bundle_root>/Form/Type/CollectOnDeliverySettingsType.php:

.. oro_integrity_check:: e07e171460cda237b2b6fddb24b745514c01c89b

   .. literalinclude:: /developer/code_examples/commerce/payment_method/collect-on-delivery/Form/Type/CollectOnDeliverySettingsType.php
      :language: php
      :linenos:


Create a Configuration File for the Service Container
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To start using a service container for your bundle, first create the configuration file <bundle_root>/Resources/config/services.yml.

Set up Services with DependencyInjection
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To set up services, load your configuration file (services.yml) using the DependencyInjection component. For this, create <bundle_root>/DependencyInjection/CollectOnDeliveryExtension.php with the following content:

.. oro_integrity_check:: 3c198ccc9101e347c55f4a2b7929dc285d21eb5c

   .. literalinclude:: /developer/code_examples/commerce/payment_method/collect-on-delivery/DependencyInjection/ACMECollectOnDeliveryExtension.php
      :language: php
      :linenos:


Add Translations for the Form Texts
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To present the information on the user interface in the user-friendly way, add translations for the payment method settings' names. To do this, create <bundle_root>/Resources/translations/messages.en.yml:

.. oro_integrity_check:: 417eb36e259f5877eeefb79fca86e9636af16bd9

   .. literalinclude:: /developer/code_examples/commerce/payment_method/collect-on-delivery/Resources/translations/messages.en.yml
      :language: yaml
      :lines: 1-5
      :linenos:


Create the Integration Channel Type
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

When you select the type of the integration on the user interface, you will see the name and the icon that you define in this step. To implement a channel type, create <bundle_root>/Integration/CollectOnDeliveryChannelType.php:

.. oro_integrity_check:: 3c650bb3bb3f9119251e38199f7ae1a67e7aca61

   .. literalinclude:: /developer/code_examples/commerce/payment_method/collect-on-delivery/Integration/CollectOnDeliveryChannelType.php
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

To make sure that the icon is accessible for the web interface, check if it appears (as a copy or a symlink depending on the settings selected during the application installation) in the /public/bundles/collect_on_delivery/img directory of your application.

Create the Integration Transport
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

A transport is generally responsible for how the data is obtained from the external system. While the Collect On Delivery method does not interact with external systems, you still need to define a transport and implement all methods of the TransportInterface for the integration to work properly. To add a transport, create <bundle_root>/Integration/CollectOnDeliveryTransport.php:

.. oro_integrity_check:: 620736635a298f01a95a3bf2d9a314cc5e0f5a1c

   .. literalinclude:: /developer/code_examples/commerce/payment_method/collect-on-delivery/Integration/CollectOnDeliveryTransport.php
      :language: php
      :linenos:


Add the Channel Type and Transport to the Services Container
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To register the channel type and transport, append the following key-values to <bundle_root>/Resources/config/services.yml:

.. oro_integrity_check:: 11317973bf62fff83b9dcb022736ef0b51fe6ec2

   .. literalinclude:: /developer/code_examples/commerce/payment_method/collect-on-delivery/Resources/config/services.yml
      :language: yaml
      :lines: 1-21
      :linenos:


Add Translations for the Channel Type and Transport
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The channel type and, in general, transport labels also appear on the user interface (you will not see the the transport label for Collect On Delivery). Provide translations for them by appending the <bundle_root>/Resources/translations/messages.en.yml. Now, the messages.en.yml content must look as follows:

TODO:

.. oro_integrity_check:: 78a3b6d66b645c81a453332b7aa6cee382ca1ddd

   .. literalinclude:: /developer/code_examples/commerce/payment_method/collect-on-delivery/Resources/translations/messages.en.yml
      :language: yaml
      :linenos:


Add an Installer
^^^^^^^^^^^^^^^^

An installer ensures that upon the application installation, the database will contain the entity that you defined within your bundle.

Follow the instructions provided in the :ref:`How to generate an installer <installer_generate>` topic. After you complete it, you will have the class <bundle_root>/Migrations/Schema/CollectOnDeliveryBundleInstaller.php with the following content:

.. oro_integrity_check:: 5179cea0cc73d864dc7e3d64223431b399e1644f

   .. literalinclude:: /developer/code_examples/commerce/payment_method/collect-on-delivery/Migrations/Schema/ACMECollectOnDeliveryBundleInstaller.php
      :language: php
      :linenos:


Check That the Integration is Created Successfully
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. Clear the application cache:

   .. code-block:: bash
       :linenos:

       bin/console cache:clear

   .. note::

      If you are working in production environment, you have to use the ``--env=prod`` parameter  with the command.

2. Open the user interface and check that the changes have applied and you can add an integration of the Collect On Delivery type.


Implement a Payment Method
--------------------------

Now implement the payment method itself.


Create a Factory for the Payment Method Configuration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

A configuration factory generates an individual configuration set for each instance of the integration of the Collect On Delivery type.


To add a payment method configuration factory, in the directory <bundle_root>/PaymentMethod/Config/Factory/ create interface CollectOnDeliveryConfigFactoryInterface.php and the class CollectOnDeliveryConfigFactory.php that implements this interface:


Configuration Factory Interface
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. oro_integrity_check:: 6af16a5db340c827ecca4d5f458703e863acba84

   .. literalinclude:: /developer/code_examples/commerce/payment_method/collect-on-delivery/PaymentMethod/Config/Factory/CollectOnDeliveryConfigFactoryInterface.php
      :language: php
      :linenos:


Configuration Factory Class
~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. oro_integrity_check:: c016c86f4c54041582d8d6e8d1082d8ada205494

   .. literalinclude:: /developer/code_examples/commerce/payment_method/collect-on-delivery/PaymentMethod/Config/Factory/CollectOnDeliveryConfigFactory.php
      :language: php
      :linenos:


Create a Provider for the Payment Method Configuration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

A configuration provider accepts and integration id and returns settings based on it.


To add a payment method configuration provider, in the directory <bundle_root>/PaymentMethod/Config/Provider/ create interface CollectOnDeliveryConfigProviderInterface.php and the class CollectOnDeliveryConfigProvider.php that implements this interface:


Configuration Provider Interface
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. oro_integrity_check:: a9f32bf9aadd1f1357dcb7d52e276bce85cd3fe4

   .. literalinclude:: /developer/code_examples/commerce/payment_method/collect-on-delivery/PaymentMethod/Config/Provider/CollectOnDeliveryConfigProviderInterface.php
      :language: php
      :linenos:


Configuration Provider Class
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. oro_integrity_check:: 6d3d71f5c29f0b4bd54db2f1a15ec918a405cbe3

   .. literalinclude:: /developer/code_examples/commerce/payment_method/collect-on-delivery/PaymentMethod/Config/Provider/CollectOnDeliveryConfigProvider.php
      :language: php
      :linenos:


Implement Payment Method Configuration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

In the <bundle_root>/PaymentMethod/Config directory, create the CollectOnDeliveryConfigInterface.php interface and the CollectOnDeliveryConfig.php class that implements this interface:


Configuration Interface
~~~~~~~~~~~~~~~~~~~~~~~

.. oro_integrity_check:: a1b7ff82c732343b55b7165cca1d93a863178928

   .. literalinclude:: /developer/code_examples/commerce/payment_method/collect-on-delivery/PaymentMethod/Config/CollectOnDeliveryConfigInterface.php
      :language: php
      :linenos:


Configuration Class
~~~~~~~~~~~~~~~~~~~

.. oro_integrity_check:: bd0aa5a4970d46a36d40fcddd648251879b0659c

   .. literalinclude:: /developer/code_examples/commerce/payment_method/collect-on-delivery/PaymentMethod/Config/CollectOnDeliveryConfig.php
      :language: php
      :linenos:


Add the Payment Method Configuration Factory and Provider to the Services Container
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To register the payment method configuration factory and provider, append the following key-values to <bundle_root>/Resources/config/services.yml:

.. oro_integrity_check:: a22546d41515421337452208db88ece0fc8075d1

   .. literalinclude:: /developer/code_examples/commerce/payment_method/collect-on-delivery/Resources/config/services.yml
      :language: yaml
      :lines: 23-35
      :linenos:


Create a Factory for the Payment Method View
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Views provide the set of options for the payment method blocks that users see when they select the Collect on Delivery payment method and review the orders during the checkout.

To add a payment method view factory, in the directory <bundle_root>/PaymentMethod/View/Factory/ create interface CollectOnDeliveryViewFactoryInterface.php and the class CollectOnDeliveryViewFactory.php that implements this interface:

Payment Method View Factory Interface
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. oro_integrity_check:: a4dd15636be5316530f8e9ba387fb34b4e7203e4

   .. literalinclude:: /developer/code_examples/commerce/payment_method/collect-on-delivery/PaymentMethod/View/Factory/CollectOnDeliveryViewFactoryInterface.php
      :language: php
      :linenos:


Payment Method View Factory Class
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. oro_integrity_check:: 3ad55614c75cb70f558c684ffdf3ddf4f230ec39

   .. literalinclude:: /developer/code_examples/commerce/payment_method/collect-on-delivery/PaymentMethod/View/Factory/CollectOnDeliveryViewFactory.php
      :language: php
      :linenos:


Create Provider for the Payment Method View
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To add a payment method view provider, create <bundle_root>/PaymentMethod/View/Provider/CollectOnDeliveryViewProvider.php:


Payment Method View Provider Class
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. oro_integrity_check:: 5b63d635d1d94540d7d7de7e13085d12540c2635

   .. literalinclude:: /developer/code_examples/commerce/payment_method/collect-on-delivery/PaymentMethod/View/Provider/CollectOnDeliveryViewProvider.php
      :language: php
      :linenos:


Implement the Payment Method View
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Finally, to implement the payment method view, create <bundle_root>/PaymentMethod/ViewCollectOnDeliveryView.php:


Payment Method View Class
~~~~~~~~~~~~~~~~~~~~~~~~~

.. oro_integrity_check:: 1efaecb8407e7b1746e6ec3cd996bc89bc88f487

   .. literalinclude:: /developer/code_examples/commerce/payment_method/collect-on-delivery/PaymentMethod/View/CollectOnDeliveryView.php
      :language: php
      :linenos:


Add the Payment Method View Factory and Provider to the Services Container
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To register the payment method view factory and provider, append the following key-values to <bundle_root>/Resources/config/services.yml:

.. oro_integrity_check:: 631d7090e2b6e51c56e5360bb39d1ec2a618da34

   .. literalinclude:: /developer/code_examples/commerce/payment_method/collect-on-delivery/Resources/config/services.yml
      :language: yaml
      :lines: 41-53
      :linenos:


Create a Factory for the Main Method
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To add a payment method factory, in the directory <bundle_root>/PaymentMethod/Factory/ create interface CollectOnDeliveryPaymentMethodFactoryInterface.php and the class CollectOnDeliveryPaymentMethodFactory.php that implements this interface:

Factory Interface
~~~~~~~~~~~~~~~~~

.. oro_integrity_check:: 7eba80dc430fb6c15dd3c0a06ad70166aafe8fb1

   .. literalinclude:: /developer/code_examples/commerce/payment_method/collect-on-delivery/PaymentMethod/Factory/CollectOnDeliveryPaymentMethodFactoryInterface.php
      :language: php
      :linenos:


Factory Class
~~~~~~~~~~~~~

.. oro_integrity_check:: b52e9d91eea0f40b9acc713511e6ee9719fe0775

   .. literalinclude:: /developer/code_examples/commerce/payment_method/collect-on-delivery/PaymentMethod/Factory/CollectOnDeliveryPaymentMethodFactory.php
      :language: php
      :linenos:


Create Provider for the Main Method
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To add a payment method provider, create <bundle_root>/PaymentMethod/Provider/CollectOnDeliveryProvider.php:


Provider Class
~~~~~~~~~~~~~~

.. oro_integrity_check:: 6d37ef6aa949694d2b37d4f00f28b44cd714a25e

   .. literalinclude:: /developer/code_examples/commerce/payment_method/collect-on-delivery/PaymentMethod/Provider/CollectOnDeliveryMethodProvider.php
      :language: php
      :linenos:


Implement the Main Method
^^^^^^^^^^^^^^^^^^^^^^^^^

Now, implement the main method. To do this, create the <bundle_root>/PaymentMethod/CollectOnDelivery.php class:


Class
~~~~~

.. oro_integrity_check:: f5a248f93ffe0a9e85436a1fe654a1f3fbf03b31

   .. literalinclude:: /developer/code_examples/commerce/payment_method/collect-on-delivery/PaymentMethod/CollectOnDelivery.php
      :language: php
      :linenos:


.. hint::
   Pay attention to the lines:

   .. oro_integrity_check:: 8ff6435c543bf0addd06eb67587ea2b3cb898343

      .. literalinclude:: /developer/code_examples/commerce/payment_method/collect-on-delivery/PaymentMethod/CollectOnDelivery.php
         :language: php
         :lines: 60-63
         :linenos:


   This is where you define which transaction types are associated with the payment method. To keep it simple, for Collect On Delivery a single transaction is defined. Thus, it will work the following way: when a user submits an order, the "purchase" transaction takes place, and the order status becomes "purchased".

   Check |PaymentMethodInterface| for more information on other predefined transactions.

Add the Payment Method Factory and Provider to the Services Container
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To register the payment method main factory and provider, append the following key-values to <bundle_root>/Resources/config/services.yml:

.. oro_integrity_check:: 57f6aeba3481bd3e03a76be36de4d5e67d017c8c

  .. literalinclude:: /developer/code_examples/commerce/payment_method/collect-on-delivery/Resources/config/services.yml
     :language: yaml
     :lines: 50-61
     :linenos:


Define the Payment Method's Layouts for the Storefront
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Layouts provide the html template for the payment method blocks that users see when doing the checkout in the storefront. There are two different blocks: one that users see during selection of the payment method, and the other that they see when reviewing the order. You need to define templates for each of these blocks.

For this, in the directory <bundle_root>/Resources/views/layouts/default/imports/, create templates for the payment method selection checkout step:

- oro_payment_method_options/layout.html.twig
- oro_payment_method_options/layout.html

 and for the order review:

- oro_payment_method_order_submit/layout.html.twig
- oro_payment_method_order_submit/layout.html

layout.html.twig for the Payment Method Selection
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. oro_integrity_check:: a77435c168040027d77b79a52edf0a3a77004dbc

  .. literalinclude:: /developer/code_examples/commerce/payment_method/collect-on-delivery/Resources/views/layouts/default/imports/oro_payment_method_options/layout.html.twig
     :language: html
     :linenos:


Note that the custom message to appear in the block is defined. Do not forget to add translations in the messages.en.yml for any custom text that you add.

layout.html for the Payment Method Selection
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. oro_integrity_check:: 3488340424d34118e2ae37588a2ae84c957799ec

  .. literalinclude:: /developer/code_examples/commerce/payment_method/collect-on-delivery/Resources/views/layouts/default/imports/oro_payment_method_options/layout.yml
     :language: yaml
     :linenos:


layout.html.twig for the Order Review
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. oro_integrity_check:: 9fdd9199f2da1bb0d98c97c5bde4f97a72c3c9a9

  .. literalinclude:: /developer/code_examples/commerce/payment_method/collect-on-delivery/Resources/views/layouts/default/imports/oro_payment_method_order_submit/layout.html.twig
     :language: html
     :linenos:


layout.html for the Order Review
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. oro_integrity_check:: 3488340424d34118e2ae37588a2ae84c957799ec

  .. literalinclude:: /developer/code_examples/commerce/payment_method/collect-on-delivery/Resources/views/layouts/default/imports/oro_payment_method_order_submit/layout.yml
     :language: html
     :linenos:


Define a Translation for the Custom Message
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
In step, you have added a custom message to the payment method block. Define a translation for it in the messages.en.yml which now should look like the following:

.. oro_integrity_check:: 78a3b6d66b645c81a453332b7aa6cee382ca1ddd

   .. literalinclude:: /developer/code_examples/commerce/payment_method/collect-on-delivery/Resources/translations/messages.en.yml
      :language: yaml
      :linenos:


Check That Payment Method is Added
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Now, the Collect On Delivery payment method is fully implemented.

Clear the application cache, open the user interface and try to submit an order.


.. include:: /include/include-links.rst
   :start-after: begin
