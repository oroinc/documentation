.. _bundle-docs-platform-displaying-pictures:

Displaying Pictures
===================

Unified Way to Display a Picture
--------------------------------

To control how pictures are displayed in storefront and back-office, OroAttachmentBundle provides
a TWIG template ``@OroAttachment/Twig/picture.html.twig`` used to output a <picture> tag with image sources.

The following example shows the most general way to display a picture for the file stored in the ``sample_image`` variable using the ``login_page_logo`` filter:

.. code-block:: twig

        {% include '@OroAttachment/Twig/picture.html.twig' with {
            {# File object representing an image that is needed to display #}
            file: sample_image,
            {# Filter to apply to image to get a resized version of it #}
            filter: 'login_page_logo'
        } %}

In this case, picture sources (URLs) will be generated under the hood using the ``oro_filtered_picture_sources`` TWIG function.

.. note:: By default, picture sources contain a URL to the resized image in the original image format and in WebP format. You can change this behavior using the ``oro_attachment.webp_strategy`` configuration.

If you want to have more control of what sources, <img> or <picture> attributes are used for the <picture> tag, you can specify them explicitly.

.. code-block:: twig

        {% include '@OroAttachment/Twig/picture.html.twig' with {
            {# Sources collection to be used in <picture> tag. Beware that "file" and "filter" variables are ignored if "sources" is specified. #}
            {# Each source must have "srcset" attribute containing the URL to image. #}
            {# Any other attributes allowed for <source> tag a permitted as well, for example "type". #}
            sources: oro_filtered_picture_sources(sample_image, 'login_page_logo'),
            {# HTML attributes to add to <img> tag located inside of <picture> tag. #}
            img_attrs: {
                alt: 'Sample image alt',
            },
            {# HTML attributes to add to <picture> tag. #}
            picture_attrs: {
                class: 'sample-class',
            }
        } %}


.. note:: If you cannot use the TWIG template to render a picture (e.g., in JS), use the ``oro_filtered_picture_sources`` TWIG function to get picture sources and pass them wherever you need.

.. include:: /include/include-links-dev.rst
   :start-after: begin

