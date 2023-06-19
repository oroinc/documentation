:oro_show_local_toc: false

.. _bundle-docs-commerce-seller-dashboard-bundle:

OroSellerDashboardBundle
========================

.. note:: This bundle is only available in the Enterprise edition.

In enterprise edition, OroSellerDashboardBundle provides a Seller Dashboard type to the dashboards.
The dashboard shows a pre-configured dashboard with e-commerce statistics like Orders number and revenue, products or top selling items.

Features
--------

* Seller dashboard.
    * Orders Revenue
    * Orders Count
    * Products Statistics
    * Top Selling Items
    * Latest Orders
    * Orders Over Time

Configuration
-------------

**Important** - this configuration is available only via ``config.yml/app.yml``. It is not exposed via system configuration.

* ``oro_seller_dashboard.order_count_status_criteria`` - only orders with selected statuses will be calculated in the "Orders Count" and "Orders Revenue" widgets
* ``oro_seller_dashboard.top_selling_status_criteria`` - only orders with selected statuses will be calculated in the "Top Selling Items" widgets
* ``oro_seller_dashboard.order_overtime_status_criteria`` - only orders with selected statuses will be calculated in the "Orders Overtime" widget

Color settings

* ``oro_seller_dashboard.chart_base_font_color``
* ``oro_seller_dashboard.chart_bg_color``
* ``oro_seller_dashboard.chart_label_font_color``
* ``oro_seller_dashboard.chart_value_font_color``
* ``oro_seller_dashboard.chart_tooltip_color``
* ``oro_seller_dashboard.chart_tooltip_bg_color``

* ``oro_seller_dashboard.doughnut_chart_increase_label_color``
* ``oro_seller_dashboard.doughnut_chart_decrease_label_color``
* ``oro_seller_dashboard.doughnut_chart_palette_colors``

* ``oro_seller_dashboard.bar_chart_palette_colors``

* ``oro_seller_dashboard.scroll_chart_x_axis_line_color``
* ``oro_seller_dashboard.scroll_chart_y_axis_line_color``
* ``oro_seller_dashboard.scroll_chart_div_line_color``
* ``oro_seller_dashboard.scroll_chart_scroll_color``
* ``oro_seller_dashboard.scroll_chart_anchor_bg_color``
* ``oro_seller_dashboard.scroll_chart_palette_colors``

Implementation details
----------------------

Main Classes
------------

* ``Oro\Bundle\SellerDashboardBundle\Provider\ChartDataProviderInterface`` - Interface that represents each chart identifier, default date period and data, also contains constants that represent date periods
    * ``ChartDataProviderInterface::getChartIdentifier`` - each chart should have its own identifier, so that JS component can properly identify it and update on period switching.
    * ``ChartDataProviderInterface::getDefaultPeriod`` - returns the default period to be used for chart data. Default date period is defined in ``AbstractChartDataProvider``.
    * ``ChartDataProviderInterface::getChartData`` - each chart data provider implements this method to prepare the data in the specific format and is used to build a specific chart.

* ``Oro\Bundle\SellerDashboardBundle\Provider\AbstractChartDataProvider`` - Encapsulates commonly used logic needed by chart data providers
    *  ``AbstractChartDataProvider::getDefaultPeriod`` - returns default period to be used for chart data
    * ``AbstractChartDataProvider::getDateRanges`` - returns an array of \Date objects that represents current period start date, end date and previous period start and end dates (to be used for periods comparison, e.g. ``Order Revenue Chart``, ``Order Count Char``, etc.)
    * ``AbstractChartDataProvider::getIntervalsForPeriod`` - returns an array of formatted ``label`` and ``value`` values representing intervals to be used for a chart e.g. ``Order Revenue Chart``
    * ``AbstractChartDataProvider::applyDateRangeRestrictionToQB`` - used to modify `QueryBuilder` object and apply dates filter according to required period

Dashboard
---------

The `Seller Dashboard` is represented by a twig template, see `Oro\Bundle\SellerDashboardBundle\Resources\views\Index\default.html.twig`.

Date periods
------------

By default, the following date periods are available, see constants in ``Oro\Bundle\SellerDashboardBundle\Provider\ChartDataProviderInterface``

* ``PERIOD_DAY``
* ``PERIOD_MONTH``
* ``PERIOD_YEAR``

They are used in ``Oro\Bundle\SellerDashboardBundle\Provider\AbstractChartDataProvider``, JS component
``Oro\Bundle\SellerDashboardBundle\Resources\public\js\app\components\seller-dashboard-component.js`` to request charts data,
see ``Oro\Bundle\SellerDashboardBundle\Controller\ChartDataController.php``, etc.

As an example, the period ``Year``:
* is represented by constant `PERIOD_YEAR` with value ``year`` in ``ChartDataProviderInterface``
* in dashboard template ``OroSellerDashboardBundle:Index:default.html.twig`` in period switcher :

.. code-block:: html

    <div class="btn-group">
        ...
        <button class="btn" data-period="year">{{ 'oro.seller_dashboard.period.year'|trans }}</button>
    </div>

* in ``AbstractChartDataProvider`` is used in methods ``getIntervalsForPeriod`` and ``getDateRanges``
* in ``seller-dashboard-component.js`` is used to display currently selected period and appropriate label and to perform chart data request.

In order to add a new option for period switcher - all the above parts should be updated.

How to create your own widget
-----------------------------

**Step 1**

Create chart data provider class, it must implement ``ChartDataProviderInterface``, also it will be more easily
to extend from ``AbstractChartDataProvider`` as it already contains commonly used methods.

.. code-block:: php

    namespace My\Bundle\SellerDashboardBundle\Provider;
    ...
    class MyChartDataProvider extends AbstractChartDataProvider implements ChartDataProviderInterface
    {
    ...
    }

Then, register provider in a service container with tag ``seller.chart.data.provider``:

.. code-block:: yaml

    my_bundle.provider.my_chart_data_provider:
        class: My\Bundle\SellerDashboardBundle\Provider\MyChartDataProvider
        parent: Oro_seller_dashboard.provider.abstract
        tags:
            -
                name: 'seller.chart.data.provider'
                key: 'chart-container-my-chart'

**Step 2**

Create and register the twig extension with the function that will be used in widget twig template to render the
initial state of the chart, e.g. ``Oro\Bundle\SellerDashboardBundle\Twig\OrderChartDataTwigExtension``.

.. code-block:: php


    namespace My\Bundle\SellerDashboardBundle\Twig;

    use ...
    class MyTwigExtension extends AbstractExtension implements ExtensionInterface
    {
        private MyChartDataProvider $myChartDataProvider;

        public function __construct(MyChartDataProvider $myChartDataProvider) {
            $this->myChartDataProvider = $myChartDataProvider;
        }

        public function getFunctions()
        {
            return [
                new TwigFunction(
                    'get_my_chart_data',
                    [$this->myChartDataProvider, 'getChartData']
                )
            ];
       }
    }

And register the extension in the service container, e.g.:

.. code-block:: yaml

    my_bundle.twig.my_charts_data:
        class: My\Bundle\SellerDashboardBundle\Twig\MyTwigExtension
        arguments:
            - '@my_bundle.provider.my_chart_data_provider'
        tags:
            - { name: twig.extension }

**Step 3**

Implement the method  ``ChartDataProviderInterface::getChartIdentifier`` - each chart should have its unique identifier.

.. code-block:: php

    public function getChartIdentifier(): string
    {
        return 'chart-container-my-chart';
    }


Implement the method ``ChartDataProviderInterface::getChartData`` - each chart data provider implements this method
to prepare the data in the own specific format to be used by e.g. FusionChart component.
As an example, please refer to any provider that implements ``ChartDataProviderInterface``, e.g. ``Oro\Bundle\SellerDashboardBundle\Provider\TopSellingCountChartDataProvider``

.. code-block:: php

    public function getChartData(?string $period = null): array
    {
      $period = $period ? : $this->getDefaultPeriod();

      ...

      $this->chartData[$period] = [
          'data' => $currentPeriodResult ? : [['label' => '', 'value' => 0, 'amount' => 0]],
      ];

     return $this->chartData[$period];
    }

**Step 4**

Create widget template for a new chart, see existing ones in
``Oro\Bundle\SellerDashboardBundle\Resources\views\Index\Charts`` as a reference.

.. code-block:: none

    {% block chart-container-my-chart %}
        {% import 'OroUIBundle::macros.html.twig' as UI %}

        {% set chartData = get_my_chart_data() %}
        {% set containerId = "chart-container-my-chart" %}
        {% set options = {
            "name": "horizontal_bar_chart",
            "data_schema": {
                "label": {"field_name": "label", "type": "string"},
                "value": {"field_name": "value", "type": "string"}
             }
        } %}
        {% set componentOptions = {
            view: 'Orosellerdashboard/js/app/views/bar-chart-count-view',
            autoRender: true,
            chartOptions: {
                containerId: containerId,
                dataSource: {
                    type: 'Bar2D',
                    chart: {
                        # chart configuration options
                        # see FusionChart documentation
                        # http://docs.fusioncharts.com/archive/3.13.0/chart-attributes?chart=bar2d
                    },
                    annotations: annotations|default({}),
                    data: chartData.data|default([]),
                    trendlines: []
                },
                options: options,
                isCurrencyPrepend: 0
            }
        } %}
        <div class="dashboard-widget">
            <div class="widget-header clearfix">
                <div class="title widget-title">{{'Orosellerdashboard.chart.my_chart.label'|trans}}</div>
            </div>
            <div class="widget-content dashboard-widget-content">
                <div class="chart-container"><div class="clearfix">
                    <div id="{{ containerId }}-chart" class="column-chart chart"
                    {{ UI.renderPageComponentAttributes({
                        module: 'oroui/js/app/components/view-component',
                        options: componentOptions
                    }) }}>
                    </div>
                </div></div>
            </div>
        </div>
    {% endblock chart-container-my-chart %}

How to add a new widget to the seller dashboard
-----------------------------------------------

Current implementation of the seller dashboard widgets is done in a static way, this means that in order to add a new widget,
remove existing one, change widget position, add or remove option in period switcher, etc. - it is required to modify
or override the default ``OroSellerDashboardBundle:Index:default.html.twig`` template that is used to render the seller dashboard.

As an example, to add widget into 2nd column add ``block`` into ``div id="dashboard-column-1"``:

.. code-block:: html

    <div id="dashboard-column-0" class="responsive-cell dashboard-column responsive-cell-no-blocks">
        ...
    </div>
    <div id="dashboard-column-1" class="responsive-cell dashboard-column responsive-cell-no-blocks">
        ...
        {{ block("chart-container-my-chart", 'MyBundle:Index:Charts/myChart.html.twig') }}
        ...
    </div>
    <div id="dashboard-column-2" class="responsive-cell dashboard-column responsive-cell-no-blocks">
        ...
    </div>


.. include:: /include/include-links-dev.rst
   :start-after: begin
