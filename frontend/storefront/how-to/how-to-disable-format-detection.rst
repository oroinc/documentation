.. _how-to-disable-format-detection:

.. warning:: The documentation you are viewing is accurate for OroCommerce version 5.1 and below. An updated guide for version 6.0 will be available soon.

How to Disable Format Detection
===============================

To disable format-detection for whole application, add a meta tag to the head ``<meta name="format-detection" content="telephone=no">``.
To do this, add a block with ``blockType: meta`` to the layout update:

.. code-block:: yaml

    layout:
        actions:
            - '@add':
                id: format_detection
                blockType: meta
                options:
                    name: format-detection
                    content: 'telephone=no'

If there is a need to disable the format detection for a specific element, wrap the value in a tag ``<a>`` without the ``href`` attribute and disable default styles for links.
