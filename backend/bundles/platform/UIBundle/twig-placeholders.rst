.. _bundle-docs-platform-ui-bundle-twig-placeholders:

TWIG Placeholders
=================

Introduction to Placeholders
----------------------------

In order to improve layouts and make them more flexible, a new twig token `placeholder` is implemented. It enables us to combine several blocks (templates or actions) and output them in different places in twig templates. This way we can customize layouts without modifying twig templates.

Placeholder Declaration in YAML
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Placeholders can be defined in any bundle under `/SomeBundleName/Resource/oro/placeholders.yml`

.. code-block:: yaml
   :linenos:

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

Any configuration defined in bundle `placeholders.yml` file can be overridden in the `config/config.yml` file.

.. code-block:: yaml
   :linenos:

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

Each placeholder item can have the following properties:

- **template** or **action** - The path to TWIG template or controller action is used to rendering the item.
- **applicable** - The condition indicates whether the item can be rendered or not.
- **acl** - The ACL resource(s). Can be a string or array of strings. Can be used to restrict access to the item. If several ACL resources are provided an access is granted only if all of them grant an access.
- **data** - An additional data to be passed to TWIG template or controller.

Each property can be a constant or some expression supported by |System Aware Resolver Component|. Examples can be found in existing *placeholders.yml* files.

Rendering Placeholders
^^^^^^^^^^^^^^^^^^^^^^

To render placeholder content in twig template we need to put

.. code-block:: html
   :linenos:

    {% placeholder <placeholder_name> %}


Additional options can be passed to all placeholder child items using `with`, e.g.

.. code-block:: html
   :linenos:

   {% placeholder <placeholder_name> with {'form' : form} %}

.. include:: /include/include-links-dev.rst
   :start-after: begin
