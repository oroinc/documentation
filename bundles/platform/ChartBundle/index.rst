.. _bundle-docs-platform-chart-bundle:

OroChartBundle
==============

|OroChartBundle| helps display the application data in the UI in the form of charts and enables developers to configure chart settings and source data before the rendering process. The Bundle implements line charts, multiline charts, bar charts, horizontal bar charts, stacked bar charts, pie charts, and flowcharts.

Main Classes
------------

* ``Oro\Bundle\ChartBundle\Model\Data\DataInterface`` - Interface that can be passed to the chart builder as source data.

* ``Oro\Bundle\ChartBundle\Model\ChartView`` - View representation that can be used to render a chart.

* ``Oro\Bundle\ChartBundle\Model\ChartViewBuilder`` - Builder can be used to create a view instance.

* ``Oro\Bundle\ChartBundle\Model\ConfigProvider`` - Provide access to the oro_chart configuration.

Use Charts
----------

Controller example:

.. code-block:: php

	public function exampleAction(){
		// items - array in format: array(array("id" => 1, "firsName" => 'Alex', "fee" => 42), ...)
		$items = $this->getChartData();

    	$viewBuilder = $this->container->get('oro_chart.view_builder');

    	$view = $viewBuilder
    	    ->setOptions(array('name' => 'line_chart'))
    	    ->setArrayData($items)
    	    ->setDataMapping(array('label' => 'firstName', 'value' => 'fee'))
            ->getView();

		return $this->render('@Example/Example/example.html.twig', array('chartView' => $view));
	}

View example:

.. code-block:: none

   {{ chartView.render()|raw }}

Configure Charts
----------------

Configuration Example:

.. code-block:: yaml

    charts:
      line_chart:                                       # Chart key used for identify chart type (line_chart in example below)
        label: oro.chart.line_chart.label               # Chart label used for text representation of chart type

        data_schema:                                    # Describe fields in data array
          - name: label                                 # Name of field in data array
            label: oro.chart.line_chart.params.label    # Label of field to use in chart form
            required: true                              # Is this field required
            field_name: field_name                      # Predefined field name for non-abstract charts, optional
          - name: value
            label: oro.chart.line_chart.params.value
            required: true
            field_name: field_name

        settings_schema:                                # Describe field of chart settings form
          - name: connect_dots_with_line                # Field name
            label: Connect dots with line               # Label of field in form
            type: checkbox                              # Form type of field
            options: { required: false }                # Options of field form type

        default_settings:
          chartColors: ["#ACD39C", "#BE9DE2", "#6598DA", "#ECC87E", "#A4A2F6", "#6487BF", "#65BC87", "#8985C2", "#ECB574", "#84A377"]
          chartFontSize: 9
          chartFontColor: "#454545"
          chartHighlightColor: "#FF5E5E"

        data_transformer: oro_chart.data_transformer.example # Custom data transformer

        template: "@OroChart/Chart/line.html.twig"


.. admonition:: Business Tip

   The manufacturing industry is going through digital transformation. Discover how online commerce fits into the trend of |digitalization in manufacturing|.


.. include:: /include/include-links-dev.rst
   :start-after: begin

.. include:: /include/include-links-seo.rst
   :start-after: begin