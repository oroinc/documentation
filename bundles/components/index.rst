:title: OroPlatform Components Documentation

.. meta::
   :description: OroPlatform Components Documentation

.. _component-docs:

Components Documentation
========================

Oro Config Component provides additional resource types to the Symfony Config Component infrastructure responsible for loading configurations from different data sources and optionally monitoring these data sources for changes.

* Resource Types provide a way to configure a bundle from other bundles.
* Resource Merge provides a way to merge configurations of some resource both from one or many bundles. Supports two strategies: replace and append.
* System Aware Resolver allows to make your configuration files more dynamic. For example, you can call service's methods, static methods, constants, context variables etc.

.. toctree::
   :maxdepth: 1
   :titlesonly:

   configuration-merger
   cumulative-resources
   system-aware-resolver
   resource-loader-factory