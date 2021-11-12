.. _dev-doc-frameworks-integration:

Frameworks Integration
======================

This section will talk about how you can include/develop Vue or React application in the project based ORO application.

Why It's needed?
----------------

It is often necessary to implement a complex interactive interface in an ORO application. Since the ORO frontend is built on Backbone, which is a rather outdated library, it might be difficult to implement. This tutorial will explain how to integrate modern JavaScript frameworks and libraries and run them in the context of an ORO application.

In general you can always do this with a page-component, you can create a Vue/React application directly in the ``initialize`` method.

How to use Page Component you can see here :ref:`Page Component <dev-doc-frontend-page-component>`

How to create applications in Vue 3 you can see here official documentation |Vue3 Doc|
How to create a React app you can see here official documentation |React Doc|

.. toctree::
    :titlesonly:
    :maxdepth: 1

    vue-integration
    react-integration
    customize-setup-components

.. include:: /include/include-links-dev.rst
   :start-after: begin
