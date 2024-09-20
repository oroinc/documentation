.. _bundle-docs-commerce-product-bundle-view-page:

Customize Product View Page
===========================

In this example, we are looking at how to customize a product of different types and change the product page by category.

Every product view page contains the current **product_type** in the layout context. You can use it in your layout update **conditions**. When you customize any page, remember to use **Symfony Profiler** and look into the **Layout** section, where you can find the current layout **context** data and layout **tree**.

.. image:: /img/bundles/ProductBundle/static-block-on-product-view.png
   :alt: Static block On a product view example

.. hint:: See the :ref:`Debug Information <dev-doc-frontend-layouts-debugging>` section for more details.

First, create a **layout** update and a **template** to use in a **Simple Product** and a **Configurable Product**.

Import:

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/views/layouts/default/oro_product_frontend_product_view/static_block.yml

    layout:
        actions:
            - '@setBlockTheme':
                themes: '@AcmeDemo/layouts/default/oro_product_frontend_product_view/static_block.html.twig'

        - '@add':
            id: static_block_example_1
            parentId: product_view_description_container
            blockType: container
            prepend: true


Template:

.. code-block:: twig
   :caption: src/Acme/Bundle/DemoBundle/Resources/views/layouts/default/oro_product_frontend_product_view/static_block.html.twig


   {% block _static_block_example_1_widget %}
       <div class="cms-typography">
           <blockquote>
               Whatever your RV, our RV service team will keep you on the road.
               We offer a variety of services for all types of RVs.
           </blockquote>
       </div>
   {% endblock %}

Simple Product
--------------

In our case, a simple product inherits all import properties.

Create a layout update with the **conditions** to check if the current product has a **simple** product type.

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/views/layouts/default/oro_product_frontend_product_view/simple_product.yml

    layout:
        - '@setOption':
            id: product_view_description_container
            optionName: attr.class
            optionValue: 'text-capitalize'

        conditions: 'context["product_type"] == "simple"'

The simple product looks as follows:

.. image:: /img/bundles/ProductBundle/simple_product.png
   :alt: Simple Product example

Configurable Product
--------------------

Create a layout update that includes the **oro_product_view** import and has the **conditions** to check if the current product has a **configurable** product type.

Add the **product variants** block and the template.

The configurable product looks as follows:

.. image:: /img/bundles/ProductBundle/configurable_product.png
   :alt: Configurable Product example

Product Variants Block:

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/views/layouts/default/oro_product_frontend_product_view/configurable_product.yml

    layout:
        imports:
            - oro_product_view

        actions:
            - '@setBlockTheme':
                themes: '@AcmeDemo/layouts/default/oro_product_frontend_product_view/configurable_product.html.twig'

            - '@add':
                id: product_variants
                blockType: product_variants
                parentId: product_specification_container
                siblingId: product_specification
                options:
                    variants: '=data["product_variants"].getVariants(data["product"])'

        conditions: 'context["product_type"] == "configurable"'

Template:

.. code-block:: twig
   :caption: src/Acme/Bundle/DemoBundle/Resources/views/layouts/default/oro_product_frontend_product_view/configurable_product.html.twig

    {% block _product_variants_widget %}
        {% for variant in variants %}
            {% set key = variant.name|lower %}
            <div class="product-variants">
                {% set selectId = 'product-variants-'|uniqid %}
                <label for="{{ selectId }}">Select Color</label>
                {% if key == 'color' %}
                    {% for key, name in variant.elements %}
                        <span class="product-color-{{ key }}">
                            <input type="checkbox" name="{{ key }}" name="{{ name }}">
                        </span>
                    {% endfor %}
                {% else %}
                    <select id="{{ selectId }}" class="select">
                        {% for key, name in variant.elements %}
                            <option value="{{ key }}">{{ name }}</option>
                        {% endfor %}
                    </select>
                {% endif %}
            </div>
        {% endfor %}
    {% endblock %}

Block Types
^^^^^^^^^^^

For this example, create a **product_variants** block type used in the **configurable product** layout update.

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/config/block_types.yml

    services:
    ...
        acme_demo.layout.type.product_variants:
            parent: oro_layout.block_type.abstract_configurable_container
            calls:
                - [setOptionsConfig, [{variants: {required: true}}]]
                - [setName, ['product_variants']]
            tags:
                 - { name: layout.block_type, alias: product_variants }
    ...

Data Providers
^^^^^^^^^^^^^^

You also need to create a **product_variants** data provider used in the **configurable product** layout update.

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/config/services.yml

    services:
    ...
        acme_demo.layout.data_provider.product_variants:
            class: Acme\Bundle\DemoBundle\Layout\DataProvider\ProductVariantsProvider
            tags:
                - { name: layout.data_provider, alias: product_variants }
    ...

The following is an example of the data provider:

.. code-block:: php
   :caption: src/Acme/Bundle/DemoBundle/Layout/DataProvider/ProductVariantsProvider.php

    namespace Acme\Bundle\DemoBundle\Layout\DataProvider;

    use Symfony\Component\PropertyAccess\PropertyAccess;

    use Oro\Bundle\EntityExtendBundle\Entity\EnumOptionInterface;
    use Oro\Bundle\ProductBundle\Entity\Product;

    class ProductVariantsProvider
    {
        /**
         * @param Product $product
         * @return array
         */
        public function getVariants(Product $product)
        {
            $variants = [];
            $variantFields = $product->getVariantFields();
            foreach ($variantFields as $variantField) {
                $variants[strtolower($variantField)]['name'] = $variantField;
            }

            $propertyAccessor = PropertyAccess::createPropertyAccessor();

            $variantLinks = $product->getVariantLinks();
            foreach ($variantLinks as $variantLink) {
                $childProduct = $variantLink->getProduct();
                foreach ($variants as $key => $variant) {
                    /** @var EnumOptionInterface $enumValue */
                    $enumValue = $propertyAccessor->getValue($childProduct, $key);
                    $variants[$key]['elements'][$enumValue->getId()] = $enumValue->getName();
                }
            }

            return $variants;
        }
    }

Change Product Page by Category
-------------------------------

Every product view page contains the current **category_id** and the **category_ids** in the layout context. You can use these values to evaluate the layout **conditions**. When you customize any page, remember to use **Symfony Profiler** and look into the **Layout** section, where you can find the current layout **context** data and layout **tree**.

.. hint:: Please see the :ref:`Debug Information <dev-doc-frontend-layouts-debugging>` section for more details.

Example 1 (by category ID)
^^^^^^^^^^^^^^^^^^^^^^^^^^

As an illustration, we are adding static HTML to all products in the category Headlamps.

The condition is: **conditions: 'context["category_id"] == 4'**.

The result is:

.. image:: /img/bundles/ProductBundle/change_product_by_category_example_1.png
   :alt: Change Product Page by Category example 1

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/views/layouts/default/oro_product_frontend_product_view/headlamps.yml

    layout:
        actions:
            - '@setBlockTheme':
                themes: '@AcmeDemo/layouts/default/oro_product_frontend_product_view/headlamps.html.twig'

            - '@add':
                id: product_sale_banner
                blockType: block
                parentId: product_view_main_container
                siblingId: ~
                prepend: false

        conditions: 'context["category_id"] == 5'

Template:

.. code-block:: twig
   :caption: src/Acme/Bundle/DemoBundle/Resources/views/layouts/default/oro_product_frontend_product_view/headlamps.html.twig


    {% block _product_sale_banner_widget %}
        <div class="text-right">
            <img src="{{ asset('bundles/acme/default/images/headlamps.jpg') }}" title="The best headlamps">
        </div>
    {% endblock %}


Example 2 (by parent category ID)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

As an illustration, we are assigning a sale banner to all products in the first level category Furniture (id=12) and their children.

The condition is: **conditions: '12 in context["category_ids"]'**.

The result is:

.. image:: /img/bundles/ProductBundle/change_product_by_category_example_2.png
   :alt: Change Product Page by Category example 2

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/views/layouts/default/oro_product_frontend_product_view/furniture.yml

    layout:
        actions:
            - '@setBlockTheme':
                themes: '@AcmeDemo/layouts/default/oro_product_frontend_product_view/furniture.html.twig'

            - '@add':
                id: product_sale_banner
                blockType: block
                parentId: page_content
                siblingId: ~
                prepend: true

        conditions: '12 in context["category_ids"]'

Template:

.. code-block:: twig
   :caption: src/Acme/Bundle/DemoBundle/Resources/views/layouts/default/oro_product_frontend_product_view/furniture.html.twig

    {% block _product_sale_banner_widget %}
        <div class="text-center">
            <img src="{{ asset('bundles/acme/default/images/furniture_sale.jpg') }}" title="65% off all furniture">
        </div>
    {% endblock %}

Product Page Templates
----------------------

.. hint:: See the :ref:`Page Templates <dev-doc-frontend-layouts-theming-page-templates>` section for more details.

You can modify the visual presentation of the product view page for every product or choose a page template for all of them by default.

1. Create a **config** for the **page_templates** in the **theme** of choice.

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/views/layouts/default/config/page_templates.yml

    templates:
        -
            label: Custom page template
            description: Custom page template description
            route_name: oro_product_frontend_product_view
            key: custom
        -
            label: Parent Additional page template
            description: Additional page template description
            route_name: oro_product_frontend_product_view
            key: additional
    titles:
        oro_product_frontend_product_view: Product Page


2. Add **layout updates**:

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/views/layouts/default/oro_product_frontend_product_view/page_template/custom/layout.yml

    layout:
        actions:
            - '@remove':
                id: product_view_attribute_group_images

            - '@move':
                id: product_view_specification_container
                parentId: product_view_aside_container

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/views/layouts/default/oro_product_frontend_product_view/page_template/additional/layout.yml

    layout:
        actions:
            - '@setBlockTheme':
                themes: '@AcmeDemo/layouts/default/oro_product_frontend_product_view/page_template/additional/layout.html.twig'

            - '@add':
                id: product_view_banner
                blockType: block
                parentId: product_view_content_container

3. Add  **templates**:

.. code-block:: twig
   :caption: src/Acme/Bundle/DemoBundle/Resources/views/layouts/default/oro_product_frontend_product_view/page_template/additional/layout.html.twig

    {% block _product_view_banner_widget %}
        <div class="text-center">
            <img src="{{ asset('bundles/acme/default/images/flashlights.png') }}" title="Flashing and portable work lights">
        </div>
    {% endblock %}

Global Level
^^^^^^^^^^^^

To apply a **custom page template** to all products:

1. Navigate to **System > Configuration > Commerce > Design > Theme**.

2. In the **Page Templates** section, choose **Custom page template** in the **Product Page** select. Below is an example of what it might look like in the storefront.

.. image:: /img/bundles/ProductBundle/global_product_view_page_with_custom_page_template.png
   :alt: Global Product View Page with Custom Page Template

Entity Level
^^^^^^^^^^^^

To apply a **custom page template** to the selected products:

1. Navigate to **Products > Products**, find your product, and click **Edit**.

2. In the **Design** section, choose **Additional page template** in the **Page Template** select. Below is an example of what it might look like in the storefront.

.. image:: /img/bundles/ProductBundle/entity_product_view_page_with_custom_page_template.png
   :alt: Entity Product View Page with Custom Page Template