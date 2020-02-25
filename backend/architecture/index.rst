:title: OroCommerce, OroCRM, OroPlatform Architecture Developer Guide

.. meta::
   :description: Fundamentals of the OroCommerce, OroCRM, OroPlatform applications architecture for the backend developers

.. _architecture-guide:

Application Architecture
========================

What is Oro Application
-----------------------

Oro application is a PHP web application that is using Symfony as a framework. It provides the following benefits:

* **Runs on any OS**, though Linux is recommended. See :ref:`system requirements <system-requirements>` for more info.
* **Scalable** - Oro application may be easily scaled up and down to meet your company needs (message queue, indexes, search).
* **Extendable** - Oro application may be extended via the packages from the |Oro marketplace| designed by Oro, Oro partners, or Oro community. Also, you may design your own packages to implement the missing functionality.
* **Customizable** - Oro application inherits most of the development techniques enabled by the Symfony framework and extends them. It helps easily customize Oro app for any business needs.

With these out-of-the-box benefits, developers can focus on implementing their unique business logic and build Oro-based applications in less time.

Oro Licensing
~~~~~~~~~~~~~

Community versions of OroCRM and OroCommerce are distributed under |OSL-3.0| license, community edition of OroPlatform is distributed under |MIT| license. Enterprise editions of OroCRM, OroCommerce, and OroPlatform are distributed under a custom End User License Agreement.

.. _architecture-overview:

Architecture Overview
---------------------

.. toctree::
   :includehidden:
   :maxdepth: 3

   tech-stack/index
   structure/index
   framework/index
   customization/index
   differences
   custom-application

.. include:: /include/include-links-dev.rst
   :start-after: begin
