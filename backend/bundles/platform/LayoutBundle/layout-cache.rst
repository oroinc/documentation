.. _layouts-layout-cache:

Layout Cache
============

Layout cache is based on layout context.

It uses the |Context::getHash| method to generate the cache key.

Layout cache uses ``OroCacheBundle``. For more information, see |BlockViewCache|.

Last Modification Date
----------------------

The layout context contains the last modification date of the files with layout updates. It is registered with the ``layout.context_configurator`` - |LastModifiedDateContextConfigurator|.

BlockView Tree
--------------

The layout cache contains the ``root`` |BlockView| with children and variables.

The BlockView tree is serialized with ``oro_layout.block_view_serializer``.

The following is the list of normalizers used in the ``oro_layout.block_view_serializer``:

* ``oro_layout.block_view_serializer.block_view_normalizer`` - |BlockViewNormalizer|
* ``oro_layout.block_view_serializer.expression_normalizer`` - |ExpressionNormalizer|
* ``oro_layout.option_value_bag_normaizer`` - |OptionValueBagNormalizer|

All normalizers are registered as a service in the DI container with the ``layout.block_view_serializer.normalizer`` tag.

Expressions / Evaluate and Evaluate Deferred
--------------------------------------------

There are two groups of expressions in the |BlockView| options:

* Context key ``expressions_evaluate`` - expressions that do not work with ``data``. It evaluates before |BlockTypeInterface::buildBlock|

* Context key ``expressions_evaluate_deferred`` - expressions that work with ``data``. It evaluates after |BlockTypeInterface::finishView|

For example:

.. code-block:: yaml
   :linenos:

    actions:
        ...
        - '@add':
            id: blockId
            parentId: parentId
            blockType: typeName
            options:
                optionName: '=context["valueKey"]'

It will be evaluated before the |BlockTypeInterface::buildBlock| and the result will be cached.


.. code-block:: yaml
   :linenos:

    actions:
        ...
        - '@add':
            id: blockId
            parentId: parentId
            blockType: typeName
            options:
                optionName: '=data["valueKey"]'

It will be evaluated after |BlockTypeInterface::finishView| and the result will not be cached.



.. include:: /include/include-links-dev.rst
   :start-after: begin