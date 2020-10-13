.. _customize-datagrids-extensions-formatter:

Formatter Extension
===================

This extension does not affect datasource, it applies after the result set is fetched by the datagrid and provides changes using formatters that are described in the config.
This extension is also responsible for passing columns configuration to the view layer.

Formatters
----------

Field
^^^^^

.. code-block:: yaml
   :linenos:

    column_name:
        type: field # default value `field`, so this key could be skipped here
        frontend_type: date|datetime|decimal|integer|percent|currency|select|text|html|boolean # optional default string
        data_name: someAlias.someField # optional, key in result that should represent this field
        divisor: some number # optional if you need to divide a numeric value by a number before rendering it

Represents the default data field.

URL
^^^

.. code-block:: yaml
   :linenos:

    column_name:
        type: url
        route: some_route # required
        isAbsolute: true|false # optional
        params: [] # optional params for route generating, will be took from record
        anchor: string #optional, use it when need to add some #anchor to generated url

Represents URL field, mostly used for generating urls for actions.

Link
^^^^

.. code-block:: yaml
   :linenos:

    column_name:
        type: link
        route: some_route # required
        isAbsolute: true|false # optional
        params: [] # optional params for route generating, will be took from record
        anchor: string #optional, use it when need to add some #anchor to generated url
        frontend_type: html #needed to display prepared link (a-tag) as html

Represents a link field to display a link as html. Link text is value of records ``column_name``, values for url generation are specified via ``params``.

Twig
^^^^

.. code-block:: yaml
   :linenos:

    column_name:
        type: twig
        template: string # required, template name
        context: [] # optional, should not contain reserved keys(record, value)

Represents twig template formatted field.

Translatable
^^^^^^^^^^^^

.. code-block:: yaml
   :linenos:

    column_name:
        type: translatable
        data_name: string #optional if need to took value from another column
        domain: string #optional
        locale: string #optional

Used when field should be translated by symfony translator.

Callback
^^^^^^^^

.. code-block:: yaml
   :linenos:

    column_name:
        type: callback
        callable: "@link" # required

Used when field should be formatted using a callback, see :ref:`Reference in YAML Configuration <datagrid-references-configuration>` for more information.

Note that the whole node configuration is passed to the callback method as the ``$node`` argument.
Therefore, if you need is to pass some arguments to the callback method, you can add any parameter to the grid config, e.g.:

.. code-block:: yaml
   :linenos:

    column_name:
        type: callback
        callable: "@link.to.some.service->myCallbackMethod"
        myCallbackParam: 'Some Value'

And then use this parameter in the callback method like this:

.. code-block:: php
   :linenos:

    use Oro\Bundle\DataGridBundle\Datasource\ResultRecordInterface;

    class MyFormatterService
    {
        public function myCallbackMethod($gridName, $keyName, $node)
        {
            if (!array_key_exists('myCallbackParam', $node)) {
                return false;
            }

            $myCallbackParam = $node['myCallbackParam'];

            return function (ResultRecordInterface $record) use ($myCallbackParam) {
                $result = '';
                // Do something using $myCallbackParam

                return $result;
            };
        }
    }


Localized Number
^^^^^^^^^^^^^^^^

.. code-block:: yaml
   :linenos:

    column_name:
        type: localized_number
        method: formatCurrency        # required
        context: []                   # optional
        context_resolver: "@callable" # optional
        divisor: some number # optional if you need to divide a numeric value by a number before rendering it

Used to format numbers using ``Oro\Bundle\LocaleBundle\Formatter\NumberFormatter`` on backend.

* `method` - method from NumberFormatter that should be used for formatting
* `context` - static arguments for method that will be called, starts from 2nd arg
* `context_resolver` - callback that will resolve dynamic arguments for method that will be called, starts from 2nd arg should be compatible with following declaration: ``function (ResultRecordInterface $record, $value, NumberFormatter $formatter) {}``

Example:

We would like to format currency, but the currency code should be retrieved from the current row

.. code-block:: yaml
   :linenos:

    column_name:
        type: localized_number
        method: formatCurrency
        context_resolver: staticClass::staticFunc

.. code-block:: php
   :linenos:

    class staticClass {
        public static function staticFunc()
            {
                return function (ResultRecordInterface $record, $value, NumberFormatter $formatter) {
                    return [$record->getValue('currencyFieldInResultRow')];
                };
            }
    }

    // will call
    // NumberFormatter->formatCurrency('value of column_name field', 'value of currencyFieldInResultRow field');


.. note:: Option ``frontend_type`` can be applied to the formatter of any type, it will be used to format cell data in the frontend.

Customization
-------------

To implement your own formatter:

- Develop a class that implements ``PropertyInterface`` (also there is basic implementation in ``AbstractProperty``)
- Register your formatter as a service tagged as ``{ name: oro_datagrid.extension.formatter.property, type: YOUR_TYPE }``
