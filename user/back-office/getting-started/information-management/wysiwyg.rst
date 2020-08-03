:oro_documentation_types: OroCommerce

.. _getting-started-wysiwyg-editor-field:

WYSIWYG Editor
==============

.. hint:: This feature is available since OroCommerce v4.1.1. To check which application version you are running, see the :ref:`system Information <system-information>`.

The :term:`WYSIWYG <WYSIWYG (What You See Is What You Get)>` editor feature is implemented by Oro applications to help you experience the control over the content of your HTML-like web pages within your website. It is an HTML page builder that helps you create a complex and attractive content with cutting-edge default and third-party widgets, embedded videos and pictures without any coding knowledge. Preview functions enable you to optimize the page for mobile and desktop formats before you publish.

The WYSIWYG editor integrates the |GrapesJS| framework out-of-the-box. The framework provides multiple advanced capabilities for creating dynamic templates and HTML structures.

.. image:: /user/img/getting_started/wysiwyg/wysiwyg_editor_example.png
   :alt: An example of the wysiwyg editor


Add WYSIWYG to an Entity
------------------------

There are two ways to add the WYSIWYG editor to an entity, either as a field under **System > Entity > Entity Management** or as an attribute (for products only) under **Products > Product Attribute**.

To add the WYSIWYG editor as a field, follow the steps outlined in the :ref:`Create Entity Fields <doc-entity-fields-create>` topic. When creating a field, make sure to select "WYSIWYG" as the type for the entity field. Only extended entities allow adding new fields.

.. image:: /user/img/getting_started/wysiwyg/add_wysiwyg_field.png
   :alt: Add the wysiwyg field to the customer user entity


For some entities, the field has already been integrated to category and product descriptions, content blocks, landing pages, and product brands, giving you the ability to expand the simple settings with the advanced formatting features.

    .. image:: /user/img/getting_started/wysiwyg/wysiwyg_various_places.png
       :alt: View the wysiwyg field integrated to various entity


Aside from the fact that the Product entity has already incorporated the WYSIWYG editor into its long description field, you can also create an additional field that would use the WYSIWYG editor by creating a related product attribute under **Products > Product Attribute** with the WYSIWYG data type as described in the related guide on :ref:`product attribute creation <products--product-attributes>`. Then, add this attribute to the product family under the required attribute group.

.. image:: /user/img/getting_started/wysiwyg/wysiwyg_for_products.png
   :alt: The two ways of integrating wysiwyg field to the product entity
   :scale: 60%


Use WYSIWYG
-----------

The power of WYSIWYG is in its functionality that provides you with diversified tools to manage the content of the web pages within your website.

The main parts of the editor help define the interface and the structure of your templates and are responsible for different aspects of your work with WYSIWYG:

* **Canvas** --- A field with the appropriate HTML-like content to be displayed in the storefront. Within the canvas, you can move, copy, or delete the components, and format the text inside blocks.

    .. image:: /user/img/getting_started/wysiwyg/canvas.png
       :alt: An example of the WYSIWYG canvas

* **Blocks** --- A group of various blocks that you can drag and drop to your canvas shaping the desired content. A block can be either a text, a multi media file, a table or a column. You can also embed a piece of code, any default or third-party widgets, insert a link, a quote, or add a button. The basic set of blocks can cover most of your needs.

    .. image:: /user/img/getting_started/wysiwyg/blocks.png
       :alt: The settings of the WYSIWYG blocks menu

* **Style Manager** --- A group of settings that are used to customize the content blocks added to the canvas. Within the style manager, you can assign a selected CSS class to certain blocks, provided that the necessary class is specified in the file of css styles linked to the main website template. You can also set the alignment of the blocks against other content, set margins, paddings, fonts, and colors, scale and rotate the text, as well as apply other transformations to the selected content structure.

    .. image:: /user/img/getting_started/wysiwyg/style_manager.png
       :alt: The settings of the WYSIWYG style manager menu

* **Layer Manager** --- A tree of used blocks structured in the order they are allocated on the canvas. To shift the order of certain blocks, click |IcMoveArrow| next to the selected block and drag it to the required place. You can also hide selected blocks, instead of deleting them, by clicking |IcPreview| to the left of the block name.

    .. image:: /user/img/getting_started/wysiwyg/layer_manager.png
       :alt: The settings of the WYSIWYG layer manager menu


WYSIWYG enables you to:

* Adapt the content for various display formats (desktop, tablet, and mobile). You can set the individual formatting for each display type, including different background colors, blocks dimension, text alignment, and other. For this, select the display type and customize the settings appropriately. View the results dynamically by switching from one display to another.


    .. image:: /user/img/getting_started/wysiwyg/display_types.png
       :alt: Selecting the display format

* Show/hide delimiters that line off the block components, open the editor full screen, undo, redo the changes made to the canvas, or clear the canvas entirely.

    .. image:: /user/img/getting_started/wysiwyg/right_block.png
       :alt: The icons that define the mentioned options (view components, undo, redo the changes)

* View the HTML code and CSS styles applied to the canvas by clicking the **</>** icon or write your own HTML code manually in the import popup dialog.

    .. image:: /user/img/getting_started/wysiwyg/import_html_code.png
       :alt: An import popup dialog for inputting the HTML code

* Assign CSS styles to selected blocks by entering the CSS style name in the **Classes** field under Style Manager.

    .. image:: /user/img/getting_started/wysiwyg/CSS_classes.png
       :alt: An import popup dialog for inputting the HTML code

* Align the text, links, buttons, or any other content inside the block or column to center, left, or right by selecting the required position in the **Typography** section under the **Style Manager** menu.

    .. image:: /user/img/getting_started/wysiwyg/align_link_button_to_center.png
       :alt: Align the link button to center

* Align the block to center, left, or right using the **Flex** section under the **Style Manager** menu. For this, enable the flex container and set the required direction and position to display your content block.

    .. image:: /user/img/getting_started/wysiwyg/align_the_block_using_flex.png
       :alt: Align the link button to center using flex

* Insert a video by dragging the video block to the canvas. Set the video provider (HTML5 Source, vimeo) in the **Settings** section under Style Manager and add the direct link to the **Source** field.

* Insert the *Contact Us widget* into the required landing page. For this, enter ``{{widget('contact_us_form')}}`` in the text editor and click **Save** in the top right corner. Once the landing page is added as a content variant to the content node of a web catalog, the form should then become visible in the storefront.

    .. image:: /user/img/marketing/landing_pages/ContactWidget.png
       :alt: Show how the Contact Us widget is displayed in the storefront
       :scale: 60%

.. note:: To add any custom options or custom video formats to the default WYSIWYG settings, ask for the developer assistance and follow the :ref:`HTML Purifier Modes <wysiwyg-field-customization>` customization guide.


**Related Topics**

* :ref:`WYSIWYG Developer Guide <WYSIWYG-field-dev-guide>`
* :ref:`Create Entity Fields <doc-entity-fields-create>`
* :ref:`Basic Entity Field Properties <field-file-types>`



.. include:: /include/include-links-dev.rst
   :start-after: begin

.. include:: /include/include-images.rst
   :start-after: begin