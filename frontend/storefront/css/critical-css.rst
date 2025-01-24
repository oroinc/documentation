.. _dev-doc-frontend-css-critical-css:

Critical CSS
============

To optimize page loading performance, it is essential to use **Critical CSS**, which extracts and injects the CSS necessary for rendering above-the-fold content directly into the page. This ensures that critical styles are loaded before the full CSS, resulting in faster rendering times and improved user experience.

The following sections guide you through the configuration and implementation of Critical CSS for your theme.

Configuration
-------------

You can define Critical CSS in the `assets.yml` configuration file as follows:

.. code-block:: yaml

    critical_css:
        inputs:
            - 'reset.scss'
            - 'header.scss'
            - 'footer.scss'
        output: 'css/critical.css'

The above configuration specifies the source files (`inputs`) that will be merged and compiled into the `critical.css` file (`output`).

Integration
-----------

To include the Critical CSS directly on the page, you can configure it in the `layout.yml` file:

.. code-block:: yaml

    critical_css:
        blockType: style
        options:
            content: '=data["theme"].getStylesOutputContent(context["theme"], "critical_css")'

This configuration ensures that the content of the `critical.css` file is dynamically injected into the page as an inline `<style>` block.

Example Output
--------------

The injected Critical CSS will look similar to the following:

.. code-block:: html

    <style>*{box-sizing:border-box}button,input,optgroup,select,textarea{color:inherit}</style>

.. include:: /include/include-links-dev.rst
   :start-after: begin