Rich Text Form Type
===================

Rich Text editor is based on |TinyMCE|.

HTML Purifier
-------------

Rich Text editor uses |HTML Purifier| which helps to prevent XSS attacks.
List of allowed HTML tags you can find |in the app.yml file|.

The following is an example of how to allow own HTML tags:

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/app.yml

    oro_form:
        html_purifier_modes:
            default:
                allowed_html_elements:
                    div:
                        attributes:
                            - data-url
                            - data-src
                            - data-value

.. include:: /include/include-links-dev.rst
   :start-after: begin