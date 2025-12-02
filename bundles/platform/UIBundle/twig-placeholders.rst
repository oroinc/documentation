.. _bundle-docs-platform-ui-bundle-twig-placeholders:

TWIG Placeholders
=================

Introduction
------------

To make layouts more flexible, a new Twig token, **`placeholder`**, is implemented.
It allows combining multiple blocks (templates or actions) and rendering them in different locations within Twig templates.
This enables customizing layouts without modifying the Twig templates themselves.

Placeholder Declaration in YAML
-------------------------------

Placeholders can be defined in any bundle under `/SomeBundleName/Resources/oro/placeholders.yml`.

.. code-block:: yaml

    placeholders:
        items:                             # items to use in placeholders (templates or actions)
         <item_name>:                      # any unique identifier
            template: <template>           # path to custom template for renderer
         <another_item_name>:
            action: <action>               # action name (e.g. OroSearchBundle:Search:searchBar)

        placeholders:
          <placeholder_name>:
            items:
              <item_name>:
                order: 100                 # sort order in placeholder
              <another_item_name>:
                order: 200
              <one_more_item_name>: ~      # sort order will be set to 0

Any configuration defined in a bundle's `placeholders.yml` file can be overridden in the `config/config.yml` file.

.. code-block:: yaml

    oro_ui:
        placeholders:
            <placeholder_name>:
                items:
                    <item_name>:
                        remove: true   # remove item from placeholder
            <another_placeholder_name>:
                items:
                    <item_name>:
                        order: 200     # change item order in placeholder

Placeholder Item Properties
---------------------------

Each placeholder item can have the following properties:

- **template** or **action** – The path to TWIG template or controller action used to render the item.
- **applicable** – Condition to indicate whether the item should be rendered.
- **acl** – ACL resource(s). Can be a string or array of strings. Access is granted only if all ACLs permit access.
- **data** – Additional data passed to Twig template or controller.

Each property can be a constant or an expression supported by :ref:`System Aware Resolver Component <dev-components-system-aware-resolver>`. Examples exist in the current *placeholders.yml* files.

Rendering Placeholders
----------------------

To render the content of a placeholder in a Twig template:

.. code-block:: html

    {% placeholder <placeholder_name> %}

Additional options can be passed to all child items of a placeholder using `with`, for example:

.. code-block:: html

   {% placeholder <placeholder_name> with {'form' : form} %}

.. include:: /include/include-links-dev.rst
   :start-after: begin

