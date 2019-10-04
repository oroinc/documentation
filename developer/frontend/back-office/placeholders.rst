Placeholders
============

Placeholders allow to combining ordered set of blocks (templates or actions) and output them in different places of twig
templates. This way, you can customize layouts without modifying the original twig templates.

The **placeholder** defined by a unique name and ordered items (templates and actions) to render.

The **placeholder item** defined by a unique name and ``template`` or ``action`` to render.

The placeholder item can have the following optional properties:
    -  **template** or **action** - A path to the TWIG template or controller action that is used to render the item.
    -  **applicable** - A boolean condition that indicates whether the item must be rendered or not.
    -  **acl** - The ACL resource(s). Can be a string or array of strings. It can be used to restrict access to the item. If several ACL resources
       are provided, all of them must grant access for the item to receive the access.
    -  **data** - Additional data to be passed to TWIG template or controller.

Each property can be a constant or an expression.

The following expressions are supported:
    -  **%parameter%** - gets a parameter from the DI container
    -  **:math:`parameter`** - gets a parameter from the context
    -  **AcmeClass::MY_CONST** - gets a constant
    -  **AcmeClass::myMethod** - calls the static method without parameters
    -  **AcmeClass::myMethod()** - calls the static method without
       parameters
    -  **AcmeClass::myMethod(\ :math:`param1`, %param2%)** - calls the
       static method with parameters
    -  **@service->myMethod** - calls service’s method without parameters
    -  **@service->myMethod()** - calls service’s method without parameters
    -  **@service->myMethod(:math:`param1`, %param2%)** - calls service’s
       method with parameters
    -  **@service** - gets the instance of a service

Also, it is possible to use parameters inside expressions, for example:
    -  **%acme.class_name%::myMethod()** - calls the static method without
       parameters
    -  **Hello :math:`user_name`**

Render Placeholders
-------------------

To render a placeholder in a twig template, put

.. code:: html

   {% placeholder <placeholder_name> %}

Additional options can be passed to all placeholder child items using the ``with`` tag, for example,

.. code:: html

   {% placeholder <placeholder_name> with {'form' : form} %}


Placeholder Declaration in YAML
-------------------------------

Placeholders with their items (templates and actions) can be defined in a bundle in ``Resource/oro/placeholders.yml``

.. code:: yaml

   placeholders:
       items:                             # items to use in placeholders (templates or actions)
        <item_name>:                      # unique item name
           template: <template>           # path to the item template
        <another_item_name>:
           action: <action>               # controller action name (e.g., OroSearchBundle:Search:searchBar)

       placeholders:
         <placeholder_name>:
           items:
             <item_name>:
               order: 100                 # item sort order in placeholder
             <another_item_name>:
               order: 200
             <one_more_item_name>: ~      # item sort order is set to 0 when it is not defined explicitly

Override Placeholder Items
--------------------------

You can override the configuration defined in the ``placeholders.yml`` file in ``config/config.yml`` file at the application level.

.. code:: yaml


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

Also, you can override the placeholders configuration in another ``placeholders.yml`` file defined in a bundle with a higher priority.

Find more examples in |placeholders.yml files defined in OroPlatform bundles|.

.. include:: /include/include-links.rst
   :start-after: begin