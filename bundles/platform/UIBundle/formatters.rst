.. _bundle-docs-platform-ui-bundle-formatters:

Formatters
==========

**Formatters** are filters that can be applied to data to control its presentation.

Implementation
--------------

To create a custom formatter, define a new service and tag it with the `oro_formatter` tag.

The tag supports the following attributes:

* **formatter** – The unique name of the formatter (required).
* **data_type** – The data type for which this formatter should be used by default.

Example:

.. code-block:: none

    acme_demo.formatter.some_formatter:
        class: Acme\Bundle\DemoBundle\Formatter\SomeFormatter
        tags:
            - { name: oro_formatter, formatter: some_formatter }

The service class must implement the interface ``Oro\Bundle\UIBundle\Formatter\FormatterInterface``.

Usage
-----

To apply a formatter, use the `oro_ui.formatter` service.
This service provides the method `format`, which applies the specified formatter to a given value:

.. code-block:: none

    ...
    use Oro\Bundle\UIBundle\Formatter\FormatterManager;

    ...
    protected FormatterManager $formatterManager
    ...

    $date = new \DateTime();
    $formattedValue = $this->formatterManager->format($date, 'datetime');

In this example, formatter `datetime` applies to the `$date` variable.

To use formatters from the twig templates, use the `oro_format` filter:

.. code-block:: none

    {{ datetimeVar|oro_format('datetime') }}

