:oro_show_local_toc: false

@ConfigField
============

This annotation is used to configure default values for properties of configurable entity classes.

Options
-------

``defaultValues``
~~~~~~~~~~~~~~~~~

Configures default values for particular config options on a per property basis:

.. code-block:: php
    :linenos:

    // ...
    use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;

    class User
    {
        /**
         * @ConfigField(
         *      defaultValues={
         *          "dataaudit"={
         *              "auditable"=true
         *          }
         *      }
         * )
         */
        private $username;
    }

This example sets the ``auditable`` option from the ``dataaudit`` scope to ``true`` for the
``username`` property in the ``User`` class.
