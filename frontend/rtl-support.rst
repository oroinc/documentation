.. _frontend--rtl-support:

Right to Left UI Support
========================

Oro provides support for Right to Left User Interface development.

To enable it, make sure you:

- Enabled RTL support for selected localization.
- Marked a theme as RTL ready.
- Checked if custom markup and styles with JS need additional improvements.

Enable RTL
----------

The localization entity now has a checkbox **Enable RTL Mode**, which need to be selected.

.. image:: /img/frontend/rtl-support/localization-configuration.png
   :alt: Enabled RTL support for a Localization

Configure Theme
---------------

Layout and back-office themes configuration have option ``rtl_support`` that has to be enabled.
It affects the styles build process. An additional style file is created with the `rtl` annex in naming (``*.rtl.css``).

* :ref:`Layout theming definition <dev-doc-frontend-layouts-theming-definition>`
* |Admin theme configuration|

Out-of-the-box, the ``default`` Layout theme and ``oro`` back-office theme have RTL support enabled.

But not all declared style inputs need to be processed with RTLCSS processor.
Often third-party libraries support RTL out-of-the-box and their styles already account for text direction (``[dir="rtl"]``).

The following is a white list of style inputs (`auto_rtl_inputs`) that have to be processed.

By default, all styles from Oro bundles are auto processed:

.. code-block:: yaml
   :caption: src/Acme/NewBundle/Resources/config/oro/assets.yml

    auto_rtl_inputs:
        - 'bundles/oro*/**'

This list needs to be extended with a specific |wildcard file mask| to enable auto processing for a custom style.
See :ref:`Load Style Files from the Bundle <bundle-docs-platform-asset-bundle-load-css-from-bundle>` for more information.

Develop
-------

Markup
^^^^^^

For layout development, use the ``is_rtl_mode_enabled`` value in context to pass an option to the block:

.. code-block:: yaml

    - '@setOption':
        id: root
        optionName: dir
        optionValue: '=context["is_rtl_mode_enabled"] ? "rtl" : ""'


To write templates for the back-office, use the ``oro_is_rtl_mode()`` twig function.

.. code-block:: twig

    <html {{ oro_is_rtl_mode() ? 'dir="rtl"' : ''}}>


To force the "Left-To-Right" direction of the text (e.g., for phone, email, etc), wrap the value in the ``<bdo dir="ltr"></bdo>`` tag

.. code-block:: twig

    <bdo dir="ltr">1-(800)-555-5555</bdo>


Styles
^^^^^^

Styles are written in the standard way for the LTR version. During the building process, styles of the themes that have the ``rtl_support`` option enabled are post-processed with an additional |RTLCSS| processor.

As a result, an additional ``[name].rtl.css`` file is created for each output file of the theme.

.. note:: Since it is a post-processing process, and RTL dist styles are created purely on the basis of CSS files created for LTR, there is no way to use any SCSS syntax for creating RTL. There is another approach to write distinctive styles for RTL. RTLCSS defines a special notation written within the comments (see |RTLCSS documentation| for more information).

JavaScript
^^^^^^^^^^

In case the functionality needs to be changed on the JavaScript level, use ``_.isRTL()`` mixing in the underscore:

.. code-block:: javascript

    import _ from 'underscore';

    // ...

    el.style[`margin-${_.isRTL() ? 'left' : 'right'}`] = `${offset}px`;


Build Command
-------------

Use the standard building process with :ref:`php bin/console oro:assets:build <bundle-docs-platform-asset-bundle-commands>`. Add option ``--skip-rtl`` that turns off building RTL styles for development purpose to speed up build in case RTL styles are not needed at that particular moment.

.. include:: /include/include-links-dev.rst
   :start-after: begin
