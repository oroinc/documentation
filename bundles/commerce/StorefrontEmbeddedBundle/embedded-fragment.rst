:title: Create an Embedded Fragment with OroStorefrontEmbeddedBundle

.. meta::
   :description: Make an OroCommerce storefront page available as an embedded fragment with a fragment definition and
                 a layout update

.. _bundle-docs-commerce-storefront-embedded-bundle--embedded-fragment:

Create an Embedded Fragment
===========================

To make a storefront page available as a fragment, define the fragment and add a layout update for the fragment
request. The examples use the ``embedded_my_page`` fragment and the ``acme_demo_frontend_my_page`` route.

Define the Fragment
-------------------

In the ``Resources/config/oro/storefront_embedded.yml`` file of your bundle, map the fragment name to the route of the
target page. The target page must be a storefront page that the layout engine renders, that is, its controller action
has the ``#[Layout]`` attribute. Only such a page returns its blocks as JSON. The name must match ``embedded_\w+``. By
default, the fragment renders the block whose ID is the fragment name. The following definition maps the
``embedded_my_page`` fragment to the ``acme_demo_frontend_my_page`` route:

.. code-block:: yaml

   oro_storefront_embedded:
       fragments:
           embedded_my_page: acme_demo_frontend_my_page

To render other blocks, use the expanded form with the ``route_name`` and ``layout_block_ids`` options. The following
definition renders two blocks:

.. code-block:: yaml

   oro_storefront_embedded:
       fragments:
           embedded_my_page:
               route_name: acme_demo_frontend_my_page
               layout_block_ids: [embedded_my_page, my_page_sidebar]

To override a fragment of another bundle, define the same fragment name in a bundle that loads later. A bundle with a
higher priority in its ``Resources/config/oro/bundles.yml`` file loads later. OroStorefrontEmbeddedBundle has priority
120. The later definition replaces the whole earlier definition. For this reason, set ``route_name`` again. The later
definition does not keep the earlier ``layout_block_ids``.

Add the Layout Update
---------------------

Add a layout update for the route of the target page, for example,
``Resources/views/layouts/default/acme_demo_frontend_my_page/embedded_blocks.yml``. If the target page belongs to
another bundle, give your bundle a higher priority than that bundle. As a result, your layout update applies after the
layout updates of that bundle.

The ``context["is_embedded_fragment"]`` condition applies the layout update only to the fragment request. Add a
container with the fragment name as its ID and move the blocks of the fragment into it:

.. code-block:: yaml

   layout:
       conditions: 'context["is_embedded_fragment"]'
       actions:
           - '@add':
               id: embedded_my_page
               parentId: page_main_content
               blockType: container

           - '@move':
               id: page_content
               parentId: embedded_my_page

To change the blocks or the route parameters for each request, see :ref:`Change the Blocks and Route Parameters
<bundle-docs-commerce-storefront-embedded-bundle--extend--blocks-route-parameters>`.

.. include:: /include/include-links-dev.rst
   :start-after: begin
