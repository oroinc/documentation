.. _how-to-display-wysiwyg-field:

How to Display a WYSIWYG Field
==============================

.. hint:: The feature is available starting from OroCommerce v5.0.6. To check which application version you are running, see the :ref:`system information <system-information>`.

A WYSIWYG field can contain complex HTML, CSS structures, and dynamic content that should be successfully rendered and
displayed in the storefront. For that reason, be aware that:

1. The WYSIWYG content cannot be rendered and displayed identically both in the storefront and in the back-office. In the back-office, it can be rendered only in a simplified preview mode.

2. The WYSIWYG fields are rendered using different approaches in the storefront and in the back-office. These approaches are described below.

.. _how-to-display-wysiwyg-field-in-backoffice:

Display a WYSIWYG Field in the Back-Office
------------------------------------------

Depending on :ref:`the way a WYSIWYG field is added <how-to-add-wysiwyg-field>` to an entity, there are two possible cases:

1. When a WYSIWYG field is an extended field added through the :ref:`entity management UI <how-to-add-wysiwyg-field-via-ui>` or
:ref:`programmatically <how-to-add-wysiwyg-field-programmatically-as-extended>` (e.g., to some of the default Oro entities),
then the system considers the ``Show on View`` entity field config options to display the WYSIWYG field on an entity view page in the back-office.

.. note::

    Keep in mind that the WYSIWYG content is rendered in a simplified preview mode in the back-office.

.. note::

    On the view pages of the default Oro entity, extended fields are rendered by the ``renderDynamicFields`` TWIG macro
    defined in ``@OroEntityConfig/macros.html.twig``

2. When a WYSIWYG field is added :ref:`programmatically and explicitly <how-to-add-wysiwyg-field-programmatically-explicitly>`,
then you should manually configure its representation on the entity view page, using TWIG macro ``renderCollapsibleWysiwygContentPreview``:

.. code-block:: none
    :caption: src/Acme/WysiwygBundle/Resources/views/BlogPostCrud/view.html.twig

    {# ... #}

    {%- import '@OroUI/macros.html.twig' as UI -%}
    # Renders extraContent WYSIWYG field content and stores to extraContent variable.
    {%- set extraContent -%}
        {{ UI.renderCollapsibleWysiwygContentPreview(entity.extraContent, entity, 'extraContent') }}
    {%- endset -%}

    # Adds rendered WYSIWYG content to the dataBlocks to display it in a separate section.
    {% set dataBlocks = dataBlocks|merge([
        {
            'title': 'acme.wysiwyg.blogpost.sections.extra_content'|trans,
            'subblocks': [
                {'data' : [extraContent]}
            ]
        }
    ]) %}

    {# ... #}

Display a WYSIWYG Field in the Storefront
-----------------------------------------

Depending on :ref:`the way a WYSIWYG field is added <how-to-add-wysiwyg-field>` to an entity, there are 3 possible cases:

1. When a WYSIWYG field is an extended field added through the :ref:`entity management UI <how-to-add-wysiwyg-field-via-ui>` or
:ref:`programmatically <how-to-add-wysiwyg-field-programmatically-as-extended>` (e.g., to some of the default Oro entities),
then the system is not responsible for displaying it in the storefront.

.. note::

    The ``Show on View`` option from the ``Frontend options`` entity field config affects only the fields created
    as a :ref:`product attribute <products--product-attributes>`.

There are 2 approaches to render and display content from the WYSIWYG field in the storefront. Select the most suitable for you
depending on your needs:

    a) Using the layout block type ``wysiwyg_content``:

    .. code-block:: yaml

        layout:
            actions:
                # ...

                - '@addTree':
                    items:
                        blog_post_content:
                            blockType: wysiwyg_content
                            options:
                                content: '=data["blog_post"].getContent()'
                                contentStyle: '=data["blog_post"].getContentStyle()'
                    tree:
                        page_content:
                            blog_post_content: ~

                # ...

    b) Using TWIG macro ``renderWysiwygContent`` defined in ``@OroCMS/macros.html.twig``:

    .. code-block:: none

        {% set attr = layout_attr_defaults(attr, {
            '~class': ' cms-typography'
        }) %}

        <div {{ block('block_attributes') }}>
            {%- import '@OroCMS/macros.html.twig' as CMS -%}
            {{ CMS.renderWysiwygContent(value, styles|default('')) }}
        </div>

.. note::

    CSS class ``cms-typography`` should be used in the HTML element that contains rendered WYSIWYG content to ensure
    proper styling.

2. When a WYSIWYG field is added to the **Product** entity as a :ref:`product attribute <products--product-attributes>` using
the product attributes UI, or :ref:`programmatically <how-to-add-wysiwyg-field-programmatically-as-extended>`,
then the system considers the ``Show on View`` option from the ``Frontend options`` entity field config to display the WYSIWYG field in the storefront.

.. note::

    To have more fine control, you can still display the WYSIWYG product attribute manually. For that, set the ``Show on View`` option from the ``Frontend options`` entity field config to ``No`` and use one of the two abovementioned approaches (``wysiwyg_content`` layout block type or ``renderWysiwygContent`` TWIG macro).

.. note::

    Consider setting ``ACL Protected`` entity field config option to ``No`` or adding the ``commerce`` option to the ``File Applications`` entity field config. Otherwise, the WYSIWYG field will not be displayed in the storefront due to lack of permissions, even if the ``Show on View`` option is enabled.

3. When a WYSIWYG field is added :ref:`programmatically and explicitly <how-to-add-wysiwyg-field-programmatically-explicitly>`,
then the system is not responsible for displaying it in the storefront. You should display it manually using one of the two abovementioned approaches (``wysiwyg_content`` layout block type or ``renderWysiwygContent`` TWIG macro).


.. include:: /include/include-links-dev.rst
   :start-after: begin
