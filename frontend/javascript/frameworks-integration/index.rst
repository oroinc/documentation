.. _dev-doc-frameworks-integration:

Framework Integration
=====================

This section discusses including and developing Vue or React applications into a project based on the Oro application.

It is often necessary to implement a complex interactive interface in the Oro application. Since the Oro frontend is built on Backbone, a somewhat outdated library, it might be challenging to implement. This tutorial explains how to integrate modern JavaScript frameworks and libraries and run them in the context of the Oro application.

You can always do this with a page component by creating a Vue/React application directly in the ``initialize`` method.

For more information on using the Page Component, see the :ref:`Page Component <dev-doc-frontend-page-component>` topic.

To learn how to create applications in Vue 3, see the |official Vue 3 documentation|.
To learn how to create a React app, see the |official React documentation|.

.. toctree::
   :titlesonly:
   :maxdepth: 1

   vue-integration
   react-integration
   customize-setup-components

.. include:: /include/include-links-dev.rst
   :start-after: begin
