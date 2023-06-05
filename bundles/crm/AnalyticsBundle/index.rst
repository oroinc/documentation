.. _bundle-docs-crm-analytics-bundle:

OroAnalyticsBundle
==================

|OroAnalyticsBundle| provides a framework for developers to enable analytical metrics in Oro applications.

The bundle implements the |RFM| metrics and enables users to configure the score for the metrics' parameters for various sales channels. It also enables users to see RFM metrics on the account and customer view pages or build custom reports based on the calculated RFM metrics data.

The bundle includes:

- interfaces necessary to create and use a metric builder
- settings of the analysis results visualization tools
- a command for recalculation of the analytical results

AnalyticsBundle is used to implement calculation and realization of |RFM| metrics. You can also implement additional metric builders.

OroAnalyticsBundle Interfaces
-----------------------------

You can implement the following interfaces defined in the bundle:

- `AnalyticsAwareInterface` must be implemented for the entity to enable processing by a metrics builder.
- `AnalyticsBuilderInterface` must be implemented for a metrics builder to enable the collection of its metrics by the Analytics builder.
- `RFMAwareInterface` must be implemented for an entity of a Channel to enable processing of its RFM metrics.
- `RFMAwareTrait` can be used for an entity of a Channel to extend it with custom fields to keep RFM scores.
- `RFMProviderInterface` must be implemented for the provider to pass the metric values to the metric builder (added to the service container with the `oro_analytics.builder.rfm` tag).

OroAnalyticsBundle Visualization Tool Settings
----------------------------------------------

The bundle also contains settings of the tools designed to visualize analytical results. Currently, the only tool implemented enables users to define a set of threshold values. All the RFM metrics within a specific interval are assigned a specific score saved in the dedicated custom fields. You can also configure the representation of the form in the UI and the available fields.

OroAnalyticsBundle Recalculation Command
----------------------------------------

Recalculation is performed with the **oro:cron:analytic:calculate** cron command.

You can use the following parameters with the command:

* **--channel=#** (optional) - specify the channel the data from which will be used to calculate the metrics
* **--ids=#** (optional) - object identifier for the metrics to collect

You can use the "Option" to specify `ids` and calculate all specified metrics with one command, for example: ``oro:cron:analytic:calculate --channel=1 --ids=1 --ids=2``. Please note that 'ids' can be defined only if `channel` is defined.

RFM Metrics Collection and Processing with Oro
----------------------------------------------

RFM is customer value assessment by Recency, Frequency, and Monetary metrics.
The metrics are configured at the Channel level and can be used to define columns, conditions, and segments' filters and create reports.

To collect RFM values of an entity, define the following settings for the entity in the ChannelBundle:

- implement `RFMAwareInterface` interface : now RFM metrics are collected for the builder
- implement `RFMAwareTrait` trait: now the entity has fields to save the scores into
- define providers for each metric of the entity to be collected and implement `RFMProviderInterface` for each provider: now you have defined the functions to collect the metrics
- add the providers to the service container with the `oro_analytics.builder.rfm` tag: now they can be used by the system

Once `RFMAwareInterface` is implemented, the  RFM Segment Configuration section should appear in the "Edit" form of the channel.
Define the intervals for the scores for each of the metrics available.

- Run the calculation command for the channel to collect all the defined RFM metrics and assign scores to the entity records.

Custom Metric Builders
----------------------

To implement additional analytical metric builders:

- Define the following settings for the entity in the channel bundle:

  - specify the custom fields of an entity that used to store the metrics data
  - implement `AnalyticsAwareInterface`: now, metrics of the entity is collected

- Add the metric builder to the AnalyticsBundle and implement `AnalyticsBuilderInterface` for it.

.. include:: /include/include-links-dev.rst
   :start-after: begin