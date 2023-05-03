:title: OroPlatform, System Aware Resolver, Oro Config Component

.. meta::
   :description: This resource type provides a way to resolve datagrid configs with system configs.

.. _dev-components-system-aware-resolver:

System Aware Resolver
=====================

The ``SystemAwareResolver`` class supports the following expressions:

- **%parameter%** - gets a parameter from the DI container
- **$parameter$** - gets a parameter from the context
- **AcmeClass::MY_CONST** - gets a constant
- **AcmeClass::myMethod** - calls the static method without parameters
- **AcmeClass::myMethod()** - calls the static method without parameters
- **AcmeClass::myMethod($param1$, %param2%)** - calls the static method with parameters
- **@service->myMethod** - calls service's method without parameters
- **@service->myMethod()** - calls service's method without parameters
- **@service->myMethod($param1$, %param2%)** - calls service's method with parameters
- **@service** - gets the instance of a service

You can also use parameters inside expressions, for example:

- **%acme.class_name%::myMethod()** - calls the static method without parameters
- **Hello $user_name$**

