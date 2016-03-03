@Config
=======

This annotation is used to configure default values for configurable entity classes.

Options
-------

``defaultValues``
~~~~~~~~~~~~~~~~~

Configures default values for particular config options on a per property basis:

.. code-block:: php
    :linenos:

    // ...
    use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;

    /**
     * @Config(
     *      defaultValues={
     *          "dataaudit"={
     *              "auditable"=true
     *          }
     *      }
     * )
     */
    class User
    {
        // ...
    }

This example sets the ``auditable`` option from the ``dataaudit`` scope to ``true`` for the
``User`` class.

``routeName``
~~~~~~~~~~~~~

The route name of view that shows the datagrid of available records:

.. code-block:: php
    :linenos:

    // ...
    use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;

    /**
     * @Config(
     *      routeName="oro_user_index"
     * )
     */
    class User
    {
        // ...
    }

``routeView``
~~~~~~~~~~~~~

The route name of a controller that shows a particular object:

.. code-block:: php
    :linenos:

    // ...
    use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;

    /**
     * @Config(
     *      routeName="oro_user_view"
     * )
     */
    class User
    {
        // ...
    }
