.. _datagrid-references-configuration:

References in YAML Configuration
================================

You can use a static method call, a service method call, and class constant access in the YAML datagrid configuration.
`SystemAwareResolver` resolves these references while building the datagrid in the datagrid manager.

References types
----------------

Service Call
------------

.. code-block:: none

   @oro_email.grid.query_builder->getChoicesQuery

Calls the `getChoicesQuery` method of the `oro_email.grid.query_builder` service, passing the datagrid name and YAML configuration key as arguments.

Static Method Call
------------------

.. code-block:: none

   Acme\Bundle\DemoBundle\SomeClass::testStaticCall

The class name can be defined in the container's parameters or specified directly.

Constant
--------

.. code-block:: none

   Acme\Bundle\DemoBundle\SomeClass::TEST

PHP `is_callable` determines whether the value is callable or should be treated as a constant.

The value stays unchanged if it is not callable and no constant with that name exists in the class.

Service Injection
-----------------

.. code-block:: none

   some_key: @some.serviceID