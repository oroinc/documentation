.. _dev-guide-layouts-layout-data:

Layouts Data
============

In most cases, you need to use the same layout to show different data. For example, the same layout can be used to show different products.
To achieve this, you need a way to get and bind data to the layout elements.

Data can flow to a layout from several sources:

1. From a **Layout Context** - the shared layouts data
2. From a **Layout Data Provider** - the data that is unique for every particular page, based on the same layout

.. contents:: Table of Contents
    :local:
    :depth: 2
    :backlinks: entry

.. _dev-guide-layouts-layout-context:

Layout Context
--------------

The **layout context** is an object that holds data shared between the different components of the **layout** (such as layout updates, extensions, block types, etc.).

Keep in mind that data that you put in the layout context is configuration (or static) data. It means that two layouts built on the same context are the same, too.

As an example, let us assume that you need to build a layout for a Product Details page of the OroCommerce application.
All product pages should be similar (e.g. have the same menu placement, form fields, etc.), except for the product name and the description.
Let us also assume that you have an option that specifies that a menu should be rendered either on the top or on the left of the page.

In this case, it would be reasonable to put the menu position option in the layout context.
It would not, however, be a very good idea to put the product object in the layout context.
The reason for it is that it will not be possible to reuse the same layout for different products, and you will have to build a new layout for each product.

Sharing dynamic data, like a product object, is described in the `Layout Data Providers`_ section.

If there are several types of products, and their details pages (e.g. groceries, stationary, and toys) are supposed to differ significantly,
it would be reasonable to put the product type in the layout context.

Types of Data in the Context
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The layout context can hold any types of data, including scalars, arrays and objects. But any object you want to put in the context
must implement the `ContextItemInterface`_.

Accessing Context
^^^^^^^^^^^^^^^^^

Context can be accessed in a few ways. The most common of them are:

1. Accessing context from the `BlockInterface`_ instance. For example, when you need to get values from context when building the view.

   For example:

    .. code-block:: php
        :linenos:

        /**
         * {@inheritdoc}
         */
        public function buildView(BlockView $view, BlockInterface $block, Options $options)
        {
            $value = $block->getContext()->get('value-key');
        }

2. Accessing **context** using the `Symfony expression component`_ by providing an expression as an option for some block.

   For example:

    .. code-block:: yaml
        :linenos:

        actions:
        ...
        - '@add':
            id: blockId
            parent: parentId
            blockType: typeName
            options:
                optionName: '=context["valueKey"]'

.. _dev-guide-layouts-layout-context-configurator:

Context Configurators
^^^^^^^^^^^^^^^^^^^^^

It might be required to configure the context based on the current application state, client setting, or to define the
default values, etc. In order to prevent copypasting of the boilerplate code, **context configurators** have been introduced.

Each configurator should implement the `ContextConfiguratorInterface`_,
and be registered as a service in the DI container with the `layout.context_configurator` tag.

For debugging purposes, the `oro:layout:debug --context` command has been added. It allows to see how the context data-resolver will
be configured by the **context configurators**.

.. _dev-guide-layouts-layout-data-providers:

Layout Data Providers
---------------------

Types of Data Providers
^^^^^^^^^^^^^^^^^^^^^^^

You can provide data for layouts in two ways:

* By adding them to the `data` collection of the `layout context`_. This method can be used for page specific data, or the data retrieved from the HTTP request.
* By creating a standalone data provider. This method is useful if data is used on many pages and the data source is a database, HTTP session, external web service, etc.

Using the Layout Context as Data Provider
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

If you want to add some data to the layout context, you can use the `data` method of `layout context`_.
This method returns an instance of `ContextDataCollection`_. Use the `set` method of this collection to add data:

.. code-block:: php
    :linenos:

    $context->data()->set(
        'widget_id',
        $request->query->get('_wid')
    );

The `set` method has the following arguments:

* `$name` - A string which can be used to access the data.
* `$value` - The actual data. The data can be any type, for example an array, object or some scalar type.

You can also create `Context Configurators`_ to set the default data:

.. code-block:: php
    :linenos:

    $context->data()->setDefault(
        'widget_id',
        function () {
            if (!$this->request) {
                throw new \BadMethodCallException('The request expected.');
            }

            return $this->request->query->get('_wid');
        }
    );

The `setDefault` method has the following arguments:

* `$name` - A string which can be used to access the data.
* `$value` - The data. The data can be any type, for example an array, object or some scalar type. You can also use the callback method to get the data. The callback definition is as follows: `function (array|\ArrayAccess $options) : mixed`, where the `$options` argument represents the context variables.

Defining a Data Provider
^^^^^^^^^^^^^^^^^^^^^^^^

As example, consider a data provider that returns product details:

.. code-block:: php
    :linenos:

    namespace Acme\Bundle\ProductBundle\Layout\Extension;

    use Acme\Bundle\ProductBundle\Entity\Product;

    class ProductDataProvider
    {
        /**
         * @param Product $product
         */
        public function getCode(Product $product)
        {
            return $product->getId();
        }
    }

You can also implement the `AbstractFormProvider`_ if you use forms.

.. important:: The DataProvider provider method should begin with `get`, `has` or `is`.

Registering a Data Provider
^^^^^^^^^^^^^^^^^^^^^^^^^^^

To make the layout engine aware of your data provider, register it as a service in the DI container with the `layout.data_provider` tag:

.. code-block:: yaml
    :linenos:

    acme_product.layout.data_provider.product:
        class: Acme\Bundle\ProductBundle\Layout\DataProvider\ProductProvider
        tags:
            - { name: layout.data_provider, alias: product }

The `alias` key of the tag is required and should be unique for each data provider. This alias is used to get the data
provider from the registry.

Accessing Providers Data
^^^^^^^^^^^^^^^^^^^^^^^^

There are few ways to access data provider data. The most common ways are:

1. Accessing data from the `BlockInterface`_ instance. For example, when you need to get data when building the view.

   Example:

    .. code-block:: php
        :linenos:

        /**
         * {@inheritdoc}
         */
        public function buildView(BlockView $view, BlockInterface $block, Options $options)
        {
            /** @var Product $product */
            $product = $block->getData()->get('product');
            $productCode = $product->getCode();
        }

2. Accessing **data** using the `Symfony expression component`_ by providing the expression as an option for a block.

   Example:

    .. code-block:: yaml
        :linenos:

        actions:
            ...
            - '@add':
                id: product_code
                parent: product_details
                blockType: text
                options:
                    text: '=data["product"].getCode()'

The way how you access the data does not depend on where the data are located, in the layout context or in the
standalone data provider. But it is important to remember that **standalone data providers** have **higher priority** than
data from the **layout context**.

It means that if there are data with the same alias in both the layout context and
a standalone data provider registry, the standalone data provider will be used.

.. _`Oro Layout component`: https://github.com/oroinc/platform/tree/master/src/Oro/Component/Layout
.. _`ContextItemInterface`: https://github.com/oroinc/platform/blob/master/src/Oro/Component/Layout/ContextItemInterface.php
.. _`BlockInterface`: https://github.com/oroinc/platform/blob/master/src/Oro/Component/Layout/BlockInterface.php
.. _`ContextConfiguratorInterface`: https://github.com/oroinc/platform/blob/master/src/Oro/Component/Layout/ContextConfiguratorInterface.php
.. _`layout context`: https://github.com/oroinc/platform/blob/master/src/Oro/Component/Layout/ContextInterface.php
.. _`ContextDataCollection`: https://github.com/oroinc/platform/blob/master/src/Oro/Component/Layout/ContextDataCollection.php
.. _`AbstractFormProvider`: https://github.com/oroinc/platform/blob/master/src/Oro/Component/Layout/DataProvider/AbstractFormProvider.php
.. _`Symfony expression component`: http://symfony.com/doc/current/components/expression_language/introduction.html
