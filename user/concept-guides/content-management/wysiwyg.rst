:oro_documentation_types: OroCommerce

.. _getting-started-wysiwyg-editor-field:

WYSIWYG Editor
==============

The :term:`WYSIWYG <WYSIWYG (What You See Is What You Get)>` editor feature is implemented by Oro applications to help you control the content of your HTML-like web pages within your website. It is an HTML page builder that helps you create a complex and attractive content with cutting-edge default and third-party widgets, embedded videos and pictures without any coding knowledge. Preview functions enable you to optimize the page for mobile and desktop formats before you publish.

The WYSIWYG editor integrates the |GrapesJS| framework out-of-the-box. The framework provides multiple advanced capabilities for creating dynamic templates and HTML structures.

.. image:: /user/img/getting_started/wysiwyg/wysiwyg_editor_example.png
   :alt: An example of the wysiwyg editor

WYSIWYG Manager Blocks
----------------------

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

WYSIWYG Functions
-----------------

.. hint:: Keep in mind that, by default, the WYSIWYG editor enables users to insert only safe content. If a user cannot embed any content to the field, it may be because of content restrictions set in the configuration file. To change the restrictions, ask your developer's assistance to follow the :ref:`Post-Installation Configuration: Content Restrictions <dev-guide-setup-content-restrictions>` guide and override the default settings.

WYSIWYG enables you to do the following:

.. contents:: :local:

Add Formatting and Styles to Text
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To add formatting such as bold, italic, and underlining to your text, you need to drag the text block, enter the required text, and left-click the block to display the menu with additional formatting options.

.. image:: /user/img/concept-guides/content-management/format_text.png
   :alt: Display the menu with additional formatting options

Click the necessary option to (from left to right):

* Apply the heading (H1, H2, normal text, etc) by selecting the required one from the dropdown list
* Add **bold** formatting to your text
* Add *italic* formatting to your text
* Underline the text
* Add a strikethrough effect on your text (|ICstrikethrough|)
* Insert links to the text
* Create a numbered list
* Create a bulleted list
* Set your text below the standard line of type with the subscript icon
* Set your text above the standard line of type with the superscript icon
* Insert inline widgets

To apply different font faces, sizes, and colours to the whole text block, use the settings in the **Typography** section of the Style Manager Block.

.. image:: /user/img/concept-guides/content-management/typography.png
   :alt: The detail settings in the Typography section of the Style Manager Block

To set the opacity of the text block and add its background color, use the **Decorations** section of the Style Manager Block.

.. image:: /user/img/concept-guides/content-management/decorations.png
   :alt: The detail settings in the Decorations section of the Style Manager Block

Shift the Text to a New Line
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To move the text to a new line down, you can either press the **Enter** key or a combination of **Shift+Enter**. Both options shift the text to a new line without creating any gaps, paragraphs, or <div> between lines.

.. image:: /user/img/concept-guides/content-management/shifting_text.png
   :alt: Displaying the HTML code details whn shifting the text using both options

If you create a bulleted or numbered list, then press **Enter** to continue the flow or **Shift+Enter** to move a new line down without creating a new bullet or number.

.. image:: /user/img/concept-guides/content-management/shifting_numbered_list.png
   :alt: Shifting the numbered list with Enter and Enter+Shift

If H2, H3, or any other formatting is applied to the text, then you have several options to choose from:

1. If the cursor is in the middle of the text, then regardless of what you press, be it **Enter** or **Shift+Enter**, the remaining part after the cursor will be moved to a new line with the same formatting.
2. If the cursor is in the end of text, then pressing **Shift+Enter**, you move the text to a new line with the same formatting.
3. If the cursor is in the end of text, then pressing **Enter**, you create a new paragraph without any formatting applied to it.

.. image:: /user/img/concept-guides/content-management/shifting_formatted_text.png
   :alt: Shifting the formatted text using Enter and Enter+Shift



Insert Multimedia
^^^^^^^^^^^^^^^^^

To embed YouTube or Vimeo URLs to your content, you need to drag the video block to the canvas. Set the video provider (HTML5 Source, vimeo) in the **Settings** section under Style Manager and add the direct link to the **Source** field. The permissions to add videos depend on the restrictions set in the configuration file.

.. image:: /user/img/concept-guides/content-management/embed_video.png
   :alt: Setting the video provider (HTML5 Source, vimeo) in the Settings section

Insert Multimedia Preserving the Required Aspect Ratio
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

There are some cases when a video on a mobile device or a responsive page doesn't fit the layout or appears with unrelated bars. To fix it, you need to configure the settings of such multimedia, image, or map, maintaining their correct scale and size.

There are several options to embed some multimedia into the WYSIWYG editor, preserving the required proportions (aspect ratios).

**Option 1**

1. Drag the video, image, or map block to the canvas.
2. Click |IcImport| Import on the top menu above the canvas to open the HTML editor.
3. Find the video block and wrap it in a <div> container.
4. Save it by clicking **Import** in the popup bottom corner.

.. image:: /user/img/concept-guides/content-management/wrapping_video_in_div.png
   :alt: Illustrating the four steps mention above

5. Click the wrapped file to open its settings and configure the following:

   * position: absolute;
   * top: 0;
   * left: 0;
   * width: 100%;
   * height: 100%

6. Click the file again and then click **Select Parent** to open the settings of its parent file.

.. image:: /user/img/concept-guides/content-management/select_parent_file.png
   :alt: Clicking the Select Parent button

7. Configure the settings of the parent file as follows:

   * position: relative
   * padding-bottom: 56.52% (depending on the required scale)

8. Click **Save**.


**Option 2**

1. Drag the video, image, or map block to the canvas.
2. Click |IcImport| Import on the top menu above the canvas to open the HTML editor.
3. Find the video block and wrap it in a <div> container with the `aspect-ratio` class, as follows:

.. code-block:: html

    <div class="aspect-ratio"></div>

.. image:: /user/img/concept-guides/content-management/wrapping_video_in_div_aspect_ratio.png
   :alt: Wrapping the video block into the div container

4. Add the following code to the <style> tag:

.. code-block:: html

    .aspect-ratio{
        overflow: hidden;
    }
    .aspect-ratio:before{
        content: '';
        width: 1px;
        height: 0;
        margin-left: -1px;
        padding-bottom: calc(9 / 16 * 100%);
        float: left;
    }

5. Set the height and width parameters to your wrapped file:

   * width: 100%;
   * height: 100%;

.. image:: /user/img/concept-guides/content-management/adding_aspect_ratio_code_to_styles.png
   :alt: Adding the aspect ratio code to the style tag

6. Click **Import**.
7. Click **Save**.

Insert Images
^^^^^^^^^^^^^

To insert an image to your content, you need to drag the image block to the canvas. Once you click the icon, it will navigate you to the file manager for you to select and add the required image from your local directory or from the list of available :ref:`DA records <digital-assets>`.

.. image:: /user/img/concept-guides/content-management/embed_image.png
   :alt: The steps you need to expose to add the image to your content

Insert Clickable Images
^^^^^^^^^^^^^^^^^^^^^^^

To add a clickable image to your content, you must first insert the link block (1,2). Then, place the image block inside the link block (3,4).

.. image:: /user/img/concept-guides/content-management/insert_clickable_image_1.png
   :alt: The steps you need to expose to add the link block to your content

.. image:: /user/img/concept-guides/content-management/insert_clickable_image_2.png
   :alt: The steps you need to expose to add the image block to the link block

Click the link block again to display the **Style Manager** menu settings. In the **Settings** section, input the link for the image to direct people to the necessary website, once they click the image in the storefront.

.. image:: /user/img/concept-guides/content-management/insert_clickable_image_3.png
   :alt: Add the link to the link block in the Settings section under the Style Manager menu


Insert Files
^^^^^^^^^^^^

To insert a file to your content, you need to drag the file block to the canvas. Once you click the icon, it will navigate you to the file manager for you to select and add the required file from your local directory or from the list of available :ref:`DA records <digital-assets>`.

.. image:: /user/img/concept-guides/content-management/embed_file.png
   :alt: The steps you need to expose to add the file to your content

Add Columns
^^^^^^^^^^^

To add multiple columns to your content, you need to drag the block with the required column number (1,2,3) to the canvas. You can place a column inside another column to extend the quantity of columns, like in the example below:

.. image:: /user/img/concept-guides/content-management/add_columns.png
   :alt: Placing three columns inside the existing one

Columns are fully responsive and adapted to content, formatting, and styles that you apply afterwards.

Add Tables
^^^^^^^^^^

To add a table to your web page, you need to drag the table block to the canvas and place it to the required location. By default, the block inserts a 3x3 table. You can either delete the unnecessary column or add another column by cloning the required one.

.. image:: /user/img/concept-guides/content-management/add_tables.png
   :alt: Placing three columns inside the existing one

Insert Content Blocks
^^^^^^^^^^^^^^^^^^^^^

To add a content block to your web page, you need to drag the content block to your canvas and select the required one from the list of available content block that you have previously created and saved.

.. image:: /user/img/concept-guides/content-management/add_content_block.png
   :alt: A sample of the Terms and Conditions landing page

Once the landing page is added as a content variant to the content node of a web catalog, the content block should then become visible in the storefront.

Insert Content Widgets
^^^^^^^^^^^^^^^^^^^^^^

The widgets in OroCommerce come in two types, **block widgets** and **inline widgets**.

To add a block widget, you need to drag the content widget block to your canvas and select the required widget from the list of available widgets that you have previously created and saved.

.. image:: /user/img/marketing/content_widgets/drag_cw.png
   :alt: Adding a block content widget to a WYSIWYG field

To add an inline widget, you need to add the text block, left-click it, and select the inline widget from the menu.

.. image:: /user/img/marketing/content_widgets/add_inline_content_widgets.png
   :alt: Adding an inline content widget to a WYSIWYG field

Apply Advanced Styling
^^^^^^^^^^^^^^^^^^^^^^

To apply the existing CSS styles to an HTML element, you need to select the required block and enter the CSS style name in the **Classes** field under Style Manager. The style attribute with its defined properties and values is immediately assigned to the selected block. You can preview the changes directly in the WYSIWYG editor.

.. image:: /user/img/concept-guides/content-management/CSS_styles.png
   :alt: Apply CSS style attributes to a link block

Align Blocks
^^^^^^^^^^^^

There are several ways to align the block to center, left, or right. For this, you need to click the block element to display the **Style Manager** menu settings and configure its options.

In the **General** section, select the required value in the **Display** and **Position** options. This allows you to relocate the block on the web page by changing the top, right, left, and bottom values.

.. image:: /user/img/concept-guides/content-management/align_blocks_general.png
   :alt: Setting the values in the General section

In the **Dimension** section, set the following parameters:

    * width and height of the selected block
    * block margins --- the space outside the content block, i.e., the area between the content block and the page edges
    * paddings --- the space inside the content block, i.e, the area between the content block edges and the text inside

.. image:: /user/img/concept-guides/content-management/align_blocks_dimension.png
   :alt: Setting the values in the Dimension section

Align Content Inside Blocks
^^^^^^^^^^^^^^^^^^^^^^^^^^^

There are several ways to left-align, right-align, centre, or justify text, links, buttons, or any other content inside the block or column. For this, you need to click the block element to display the **Style Manager** menu settings and use one of the following options:

1. In the **Typography** section, select the required position for the text.

.. image:: /user/img/concept-guides/content-management/align_text_to_right.png
   :alt: Align the text to right

2. In the **General** section, select the **Flex** value for the **Display** option. Then, enable the flex container under the **Flex** section and align the text to the required position.

.. image:: /user/img/concept-guides/content-management/flex_section.png
   :alt: Align the text to left


Adapt Content to Different Displays
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You can set the individual formatting of your content for each display type (desktop, tablet, and mobile), including different background colors, blocks dimension, text alignment, and other. For this, select the display type and customize the settings appropriately. View the results dynamically by switching from one display to another.

.. image:: /user/img/concept-guides/content-management/adapt_content_to_display_type.png
   :alt: Selecting the display format

Input or Edit HTML Code
^^^^^^^^^^^^^^^^^^^^^^^

If you are experienced at HTML coding, you can enter your own HTML code into the WYSIWYG editor via the import popup dialog.

.. image:: /user/img/concept-guides/content-management/input_html_code.png
   :alt: Input HTML code into the WYSIWYG editor via the import popup dialog

You can also edit the existing HTML code that was already applied to the canvas based on the created content. For this, click the |IcUpload| icon on the toolbar from the right.

.. image:: /user/img/concept-guides/content-management/edit_htm_code.png
   :alt: Edit the existing HTML code via the popup dialog

Disable the GrapeJs Style Manager
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

If you are importing a complex HTML code to the editor and want to preserve its styling, you can disable the WYSIWYG built-in style manager to prevent GrapeJs from breaking those styles.


 For that, click the **</>** icon on the toolbar. You won't be able to apply and customize styles of your content. Keep in mind that if you exit the external markup mode, the editor may change the source code and break the imported content markup and styles.


.. image:: /user/img/concept-guides/content-management/external-markup-button.png
   :alt: Disable WYSIWYG style manager


**Related Topics**

* :ref:`WYSIWYG Developer Guide <WYSIWYG-field-dev-guide>`
* :ref:`Post-Installation Configuration: Content Restrictions <dev-guide-setup-content-restrictions>`



.. include:: /include/include-links-dev.rst
   :start-after: begin

.. include:: /include/include-images.rst
   :start-after: begin
