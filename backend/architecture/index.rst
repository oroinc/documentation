:title: Oro Application Architecture Developer Guide

.. meta::
   :description: Fundamentals of the Oro applications architecture for the backend developers

.. _architecture-guide:

Application Architecture
========================

What is Oro Application
-----------------------

Oro application is a PHP web application that uses the Symfony framework. It provides the following benefits:

* **Runs on any OS**, although Linux is recommended. See :ref:`system requirements <system-requirements>` for more information.
* **Scalable** - Oro application can be easily scaled up and down to meet your company needs (message queue, indexes, search).
* **Extendable** - Oro application can be extended via the packages from the |Oro Extensions Store| designed by Oro, Oro partners, or the Oro community. Also, you can design your own packages to implement additional functionality.
* **Customizable** - The Oro application inherits most of the development techniques enabled by the Symfony framework and extends them. It helps quickly customize the Oro application for any business needs.

With these out-of-the-box benefits, developers can focus on implementing their unique business logic and build Oro-based applications in less time.

Oro Licensing
~~~~~~~~~~~~~

Community versions of Oro applications are distributed under the |OSL-3.0| license. The community edition of OroPlatform is distributed under the |MIT| license. Enterprise editions of Oro applications are distributed under a custom End User License Agreement.

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
   Bundle-less Structure <bundle-less-structure>

.. admonition:: Business Tip

    Are you in the process of selecting the |best eCommerce platform for B2B|? Evaluate nine alternatives on our B2B comparison page.


.. include:: /include/include-links-dev.rst
   :start-after: begin


.. include:: /include/include-links-seo.rst
   :start-after: begin
