.. _bundle-docs-commerce-product-bundle-product-list-page:

Customize Product List Page
===========================

Every product list page contains the current **category_id** and the **category_ids** in the layout context. You can use these values to evaluate the layout **conditions**. When you customize any page, remember to use **Symfony Profiler** and look into the **Layout** section, where you can find the current layout **context** data and layout **tree**.

.. hint:: See the :ref:`Debug Information <dev-doc-frontend-layouts-debugging>` section for more details.

Static Block and Slider
-----------------------

For the first case:

1. Create the first level category (with **id = 8**) that contains a static block and slider with featured products:

.. image:: /img/bundles/ProductBundle/static_block_only.png
   :alt: Static Block only example

2. Create the layout update:

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/views/layouts/default/oro_product_frontend_product_index/static_block_only.yml

    layout:
        imports:
            -
                id: oro_product_list
                root: featured_products_container
                namespace: featured
        actions:
            - '@setBlockTheme':
                themes: '@AcmeDemo/layouts/default/oro_product_frontend_product_index/static_block.html.twig'

            - '@setOption':
                id: featured_products
                optionName: items
                optionValue: '=data["featured_products"].getProducts()'

            - '@setOption':
                id: featured_products
                optionName: label
                optionValue: oro.product.featured_products.label

            - '@setOption':
                id: featured_products
                optionName: slider_options
                optionValue:
                    slidesToShow: 4
                    arrows: true
                    responsive:
                        - { breakpoint: 1100, settings: {slidesToShow: 4, arrows: false} }
                        - { breakpoint: 993, settings: {slidesToShow: 3, arrows: false} }
                        - { breakpoint: 641, settings: {slidesToShow: 2, arrows: false} }

            - '@setOption':
                id: featured_product_line_item_form
                optionName: instance_name
                optionValue: featured_products

            - '@add':
                id: featured_products_container
                parentId: product_index_page
                blockType: container
                prepend: true

            - '@add':
                id: embedded_example_1
                parentId: product_index_page
                blockType: container
                prepend: true

        conditions: 'context["category_id"] in [8]' # affected category


3. Create a template:

.. code-block:: twig
   :caption: src/Acme/Bundle/DemoBundle/Resources/views/layouts/default/oro_product_frontend_product_index/static_block.html.twig


    {% block _embedded_example_1_widget %}
        <div class="grid cms-typography">
            <a class="grid-col-9" href="#">
                <div class="hero-promo-item__picture">
                    <img src="{{ asset('bundles/oroproduct/default/images/what_woud_wear.png') }}" alt="What would Erin wear?">
                </div>
            </a>
            <a class="grid-col-3" href="#">
                <div class="hero-promo-item__picture">
                    <img src="{{ asset('bundles/oroproduct/default/images/luma_bras_tanks.png') }}" alt="Luma Bras">
                </div>
            </a>
            <div class="grid-col-12 promo-slider">
                <div class="promo-slider__item">
                    <a href="#">
                        <img class="hero-promo-item__img" src="{{ asset('bundles/oroproduct/default/images/womens-main.jpg') }}" alt="Yoga in the beach">
                    </a>
                    <div class="promo-slider__info promo-slider__info--right">
                        <h2>New Luma Yoga Collection</h2>
                        <p>Yoga is ancient<br>Clothing shouldn’t be</p>
                        <a href="#">Shop New Yoga</a>
                    </div>
                </div>
            </div>
       </div>
    {% endblock %}


Static Block and Products
-------------------------

For the second case:

1. Create a second level category (with **id = 9**) that contains a static block and products.

.. image:: /img/bundles/ProductBundle/static_block_and_products.png
   :alt: Static Block and Products example

2. Create the layout update:

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/views/layouts/default/oro_product_frontend_product_index/static_block_and_products.yml


    layout:
        imports:
            - oro_product_grid

        actions:
            - '@setBlockTheme':
                themes:
                    - '@AcmeDemo/layouts/default/oro_product_frontend_product_index/static_block.html.twig'

            - '@add':
                id: embedded_example_2
                parentId: product_index_page
                blockType: container
                prepend: true

        conditions: 'context["category_id"] in [9]' # affected category


3. Extend static block template with our block:

.. code-block:: twig
   :caption: src/Acme/Bundle/DemoBundle/Resources/views/layouts/default/oro_product_frontend_product_index/static_block.html.twig

    {% block _embedded_example_2_widget %}
        <div class="grid cms-typography">
            <a class="grid-col-9" href="#">
                <div class="hero-promo-item__picture">
                    <img src="{{ asset('bundles/oroproduct/default/images/what_woud_wear.png') }}" alt="What would Erin wear?">
                </div>
            </a>
            <a class="grid-col-3" href="#">
                <div class="hero-promo-item__picture">
                    <img src="{{ asset('bundles/oroproduct/default/images/luma_bras_tanks.png') }}" alt="Luma Bras">
                </div>
            </a>
     </div>
    {% endblock %}

Products Only
-------------

For the third case:

1. Create a third level category (all **ids** that are **not equal 8 or 9**) that contains products only.

.. image:: /img/bundles/ProductBundle/products_only.png
   :alt: Products only example

2. Create a layout update:

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/views/layouts/default/oro_product_frontend_product_index/products_only.yml


    layout:
        imports:
            - oro_product_grid

        actions: []

        conditions: 'context["category_id"] not in [8, 9]' # are not affected categories
