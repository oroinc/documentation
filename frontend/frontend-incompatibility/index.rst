:title: Frontend Incompatibilities in 7.0

.. meta::
   :description: Overview of known frontend incompatibilities in OroCommerce 7.0, including module migrations, native promises, scheduler usage, and validation rules, with guidance for developers on how to update their projects.

Frontend Incompatibilities in 7.0
=================================

As part of the OroCommerce v7.0 LTS release, several frontend areas introduce
breaking or incompatible changes that may affect existing customizations.
This document provides an overview of these incompatibilities, explains why they occur,
and offers migration examples to help developers update their projects smoothly.

.. admonition:: Known Incompatibilities

   - Variations in migration from **CommonJS** and **AMD** modules to modern **ES Modules (ESM)**
   - Using native promises instead of ``jQuery deferred``
   - Using |scheduler property|
   - Registering validation rules for ``jquery.validate``


.. raw:: html

   <h2>Table of Contents</h2>

.. toctree::
   :includehidden:
   :titlesonly:
   :maxdepth: 1

   migrating-modules
   promises

.. include:: /include/include-links-dev.rst
   :start-after: begin

