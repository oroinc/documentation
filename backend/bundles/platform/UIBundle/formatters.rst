.. _bundle-docs-platform-ui-bundle-formatters:

Formatters
==========

Formatters are the set of filters that can be assigned to data.

Implementation
--------------

To create your own formatter, create a new service and tag it with the `oro_formatter` tag.

This tag has the following attributes:

* **formatter** - The formatter name. It is mandatory attribute.
* **data_type** - The data type name for which the formatter should be used by default.

Example:
  
.. code::

      acme_demo.formatter.some_formatter:
          class: Acme\Bundle\AcmeBundle\Formatter\SomeFormatter
          tags:
            - { name: oro_formatter, formatter: some_formatter }    


The service class should implement the `Oro\Bundle\UIBundle\Formatter\FormatterInterface` interface.


Usage
-----


To apply a formatter, use the `oro_ui.formatter` service.

This manager has method `format` that applies the given formatter to the parameter:

.. code::

    ...
    use Oro\Bundle\UIBundle\Formatter\FormatterManager;

    ...
    /** @var FormatterManager **/
    protected $formatterManager
    ...

    $date = new \DateTime();
    $formattedValue = $this->formatterManager->format($date, 'datetime');



In this example, formatter `datetime` applies to the `$date` variable.


To use formatters from the twig templates, use the `oro_format` filter:

.. code::

    {{ datetimeVar|oro_format('datetime') }}

