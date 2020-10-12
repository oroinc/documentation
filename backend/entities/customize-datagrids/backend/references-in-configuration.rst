.. _datagrid-references-configuration:

References in YAML Configuration
================================

You can use a static method call, a service method call and class constant access in YAML datagrid configuration.
These references will be called by `SystemAwareResolver` while building the datagrid in datagrid manager.

References types
----------------

Service Call
------------

.. code::

   @oro_email.grid.query_builder->getChoicesQuery

Call method `getChoicesQuery` with datagrid name and YAML configuration key as arguments from `oro_email.grid.query_builder` service.

Static Method Call
------------------

.. code::

   Acme\Bundle\DemoBundle\SomeClass::testStaticCall

Class name can be defined in container's parameters, or specified directly.

Constant
--------

.. code::

   Acme\Bundle\DemoBundle\SomeClass::TEST

PHP is_callable used to determine if it is callable or should be treated as constant.

If it is not callable and no constant exists with such name in the class, the value becomes unchanged.

Service Injection
-----------------

.. code::

   some_key: @some.serviceID

