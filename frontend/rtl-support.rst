.. _frontend--rtl-support:

Right-to-Left UI Support
========================

Oro provides support for right-to-left user interface development.

To enable it, make sure you have:

- Enabled RTL support for selected localizations.
- Marked a theme as RTL-ready.
- Checked if custom markup and styles with JS needed additional improvements.

Enable RTL
----------

To enable RTL, select the **Enable RTL Mode** checkbox when creating a new localization under **System > Localization > Localizations**.

.. image:: /img/frontend/rtl-support/rtl-support.png
   :alt: Enabled RTL support for a Localization

Configure Theme
---------------

Layout and back-office themes configuration have the ``rtl_support`` option that has to be enabled. It affects the style-building process. An additional style file is created with the `rtl` annex in the name (``*.rtl.css``).

* :ref:`Layout theming definition <dev-doc-frontend-layouts-theming-definition>`
* |Admin theme configuration|

Out-of-the-box, the ``Default`` layout theme and ``Oro`` back-office theme have RTL support enabled.

However, not all declared style inputs need to be processed with RTLCSS processor.
Often, third-party libraries support RTL out-of-the-box and their styles already account for text direction (``[dir="rtl"]``).

The following is an allowlist of style inputs (`auto_rtl_inputs`) that have to be processed.

By default, all styles from Oro bundles are auto-processed:

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/assets.yml

    auto_rtl_inputs:
        - 'bundles/oro*/**'

This list needs to be extended with a specific |wildcard file mask| to enable auto-processing for a custom style.
See :ref:`Load Style Files from the Bundle <bundle-docs-platform-asset-bundle-load-css-from-bundle>` for more information.

Left-Aligned Values in RTL and LTR
----------------------------------
Certain values, such as **ZIP codes**, **Phone number**, **PO number**, **SKU**, **Email**, etc are typically left-aligned
in both Right-to-Left and Left-to-Right environments. This alignment is primarily due to the nature of these values.
For example, phone numbers must be read in their numerical sequence, which remains unchanged regardless of the text direction.

To display LTR Values, use ``bdo`` tag

.. code-block:: html

    <bdo dir="ltr">912-786-0311</bdo>


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
