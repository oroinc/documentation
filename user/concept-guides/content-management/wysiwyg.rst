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

* **Content Templates** --- A list of :ref:`content templates <user-guide--landing-pages--marketing--content-templates>` grouped by the tags assigned to them. Templates serve as pre-designed content blocks that you can drag to the canvas and modify their fonts, styles, etc. as the page requires.

    .. image:: /user/img/getting_started/wysiwyg/content-templates-block.png
       :alt: The settings of the WYSIWYG content templates menu

* **Settings** --- A group of settings that enable you to control the content outline and toggle the external markup mode. The external markup mode allows you to import a complex HTML code to the editor, preserving its formatting and styling.

    .. image:: /user/img/getting_started/wysiwyg/settings-menu.png
       :alt: The settings of the WYSIWYG settings menu



WYSIWYG Functions
-----------------

.. hint:: Keep in mind that, by default, the WYSIWYG editor enables users to insert only safe content. If a user cannot embed any content to the field, it may be because of content restrictions set in the configuration file. To change the restrictions, ask your developer's assistance to follow the :ref:`Post-Installation Configuration: Content Restrictions <dev-guide-setup-content-restrictions>` guide and override the default settings.

WYSIWYG enables you to do the following:

.. contents:: :local:

Add Formatting and Styles to Text Block
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

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
* Apply formatting and styles to the selected fragment
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

Add Formatting and Styles to a Text Fragment
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To apply special formatting (italic, bold, font faces, sizes, colors) to a particular text fragment in the text block:

1. Select the fragment and click |PaintBrush| to wrap the text into the **Text Style** block. Use the ``<span data-type="text-style"> </span>`` code if you import the text in HTML.

.. image:: /user/img/concept-guides/content-management/wrap-to-style-fragment.png
   :alt: Highlighting the Apply Styles feature

2. Click the block with the text fragment and start applying the required styles and formatting, separately from the other text in the block, through the **Style Manager** menu.

.. image:: /user/img/concept-guides/content-management/edit-wrap-to-style-fragment.png
   :alt: Applying the styles to the selected text fragment through the Apply Styles feature



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
2. Click **</>** Source Code on the top menu above the canvas to open the HTML editor.
3. Find the video block and wrap it in a <div> container.
4. Save it by clicking **Apply Changes** in the popup bottom corner.

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
2. Click **</>** Source Code on the top menu above the canvas to open the HTML editor.
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

6. Click **Apply Changes**.
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

To add multiple columns to your content:

1. Drag the Columns block under the Layouts section to the required place on your canvas.
2. From the popup, select the required column number (1,2,3, or more). Columns are fully responsive and adapted to content, formatting, and styles that you apply afterwards.
3. You can place a column inside another column to extend the quantity of columns, like in the example below:

.. image:: /user/img/concept-guides/content-management/add_columns.png
   :alt: Placing a column inside the existing one

A new setting, **Columns/Columns Item Settings**, is added along under the Style Manager menu that enables you to adjust the number of columns, the gaps between them, and the column content alignment.

.. image:: /user/img/concept-guides/content-management/column-item-settings.png
   :alt: Displaying a new Columns setting with a set of config options to adjust columns


Add Tiles
^^^^^^^^^

Tiles enable you to display the records on the page as tiles (or bricks) instead of rows.

You can add standalone tiles of any size for text boxes, images, or other multimedia.

For that:

1. Drag the Tiles block under the Layouts section to the required place on your canvas.
2. From the popup, select the required tile template (1,2,3,1x3,2x3,3x3, or more). Tiles are fully responsive and adapted to content, formatting, and styles that you apply afterwards.
3. You can place a tile inside another tile to extend the quantity of tiles, like in the example below:

.. image:: /user/img/concept-guides/content-management/add_tiles.png
   :alt: Placing a tile inside the existing one

A new setting, **Tiles Settings**, is added along under the Style Manager menu that enables you to adjust the number of tiles and the gaps between them.

.. image:: /user/img/concept-guides/content-management/tiles-settings.png
   :alt: Displaying a new Tiles setting with a set of config options to adjust tiles


Add Div Blocks
^^^^^^^^^^^^^^

To add a div block with a particular content element to your page:

1. Drag the Div block under the Layouts section to the required place on your canvas.
2. Insert the required Text, Image, or any other block inside the Div block to wrap the content element into the div container.

.. image:: /user/img/concept-guides/content-management/add-div-block.png
   :alt: Inspecting the HTML code which displays wrapping the inserted text and image blocks into the div container


.. _wysiwyg-add-tables:

Add Tables
^^^^^^^^^^

To add a table to your web page, you need to drag the table block to the canvas and place it to the required location. By default, the block inserts a 3x3 table. You can either delete the unnecessary column or add another column by cloning the required one.

.. image:: /user/img/concept-guides/content-management/add_tables.png
   :alt: Placing three columns inside the existing one

To insert/delete the rows and columns inside the table, click the required cell and select the action from the settings bar that appears next to the cell. Keep in mind that when a user adds the table markup (cell joints, complex tables) via the **</> Source Code** icon, the setting might be affected.

.. image:: /user/img/concept-guides/content-management/table-settings.png
   :alt: Selecting the insert row before action from the cell's settings bar


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


Input or Edit HTML Code
^^^^^^^^^^^^^^^^^^^^^^^

If you are experienced at HTML coding, you can enter your own HTML code into the WYSIWYG editor via the **</> Source Code** popup dialog. There, you can also edit the existing HTML code that was already applied to the canvas based on the created content.

Click **Apply Changes** to apply the changes made to the code.

Click **Download** to create an HTML page based on the provided HTML code and export it to a ZIP file.

.. image:: /user/img/concept-guides/content-management/input_html_code.png
   :alt: Input HTML code into the WYSIWYG editor via the import popup dialog

Input an HTML Code Fragment
^^^^^^^^^^^^^^^^^^^^^^^^^^^

To insert a piece of HTML code anywhere on the web page:

1. Drag the **</> Custom Code** block to the required place of your canvas.
2. Enter the desired HTML code.
3. Click **Apply Changes**.

.. image:: /user/img/concept-guides/content-management/insert_piece_of_htm_code.png
   :alt: Inserting a piece of HTML code into the web page

If you are inserting a table, you can edit it in two ways:

* through the HTML code dialog (**</>**);
* by merging (|IcObjectGroup|) the code into your web page content to adjust it via UI. Be aware that merging the table is an irreversible action that doesn't allow you to undo the merging. Refer to the :ref:`Add a table <wysiwyg-add-tables>` section for more details on how to manage tables via UI.

.. image:: /user/img/concept-guides/content-management/edit-HTML-table.png
   :alt: Illustrating the two ways of table editing


Insert a Code Snippet
^^^^^^^^^^^^^^^^^^^^^

To insert a code snippet into your web page:

1. Drag the |IcFileCode| **Code Example** to your canvas.
2. Type the required text in the block.

The text appears formatted as code on your web page.

.. image:: /user/img/concept-guides/content-management/insert-code-snippet.png
   :alt: Illustrating the two ways of table editing


Disable the GrapeJs Style Manager
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

If you are importing a complex HTML code to the editor and want to preserve its styling, you can disable the WYSIWYG built-in style manager to prevent GrapeJs from breaking those styles.

For that, you need to enable the external markup mode to import the required HTML code as is, with its initial formatting and styling.

1. Navigate to the **Settings** menu.
2. Select the **Enable External Markup** checkbox. Keep in mind that you will not be able to apply and customize styles of your content. If you exit the external markup mode, the editor may change the source code and break the imported content markup and styles.

.. image:: /user/img/concept-guides/content-management/external-markup-button.png
   :alt: Disable WYSIWYG style manager


.. _wysiwyg-editor-add-content-template:


Add a Content Template
^^^^^^^^^^^^^^^^^^^^^^

To add a :ref:`content template <user-guide--landing-pages--marketing--content-templates>` to the canvas:

1. Open the **Content Templates** tab.
2. Expand |IcSortDesc| the tags to preview the content templates and select the appropriate one from the list. Alternatively, use the Quick Search field and start typing the template's name to speed up the search.
3. Drag the content template to the WYSIWYG canvas.
4. Start modifying the style of the elements by navigating from tab to tab of the WYSIWYG editor's manager panel.

.. image:: /user/img/marketing/content-templates/edit-content-template.png
   :alt: Illustrating the steps you need to take to start editing the selected content template


Adapt Content to Different Displays
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

WYSIWYG builder enables you to create a responsive HTML landing page adaptable to different breakpoints (screen sizes). If you are not satisfied with the content representation on a certain breakpoint, you can set the individual formatting of your content for this particular screen size, including different background colors, block dimensions, text alignment, and others. For this, select the display type and customize the settings appropriately. View the results dynamically by switching from one display to another.

The idea behind responsive content is that you have full control over different layouts of the same page. You can change images or hide content to make the page consistent for the target breakpoint. When a user lands on your website, they can see the appropriate view of the content based on their screen size.

.. note:: The changes made to a particular breakpoint are applied to all other breakpoints with a smaller resolution, while higher resolution screens remain unaffected.

.. image:: /user/img/concept-guides/content-management/adapt_content_to_display_type.png
   :alt: Selecting the display format


There are several rules on how to adapt the content.

Adapt Text
~~~~~~~~~~

You can change the text alignment, font size, letter spacing, color of the text, and its background under the **Typography** and **Decorations** style manager menu of a particular screen size.

Be aware that you **cannot** change the original text, font, or font style (bold, italics). You can hide the irrelevant text and show the appropriate one instead.

.. image:: /user/img/concept-guides/content-management/adapt-text-to-screen-size.png
   :alt: Illustrating different text formats and styles for the desktop and tablet breakpoints

Adapt Tiles and Columns
~~~~~~~~~~~~~~~~~~~~~~~

To adjust the number of tiles and the gaps between them per screen size, click the Tiles block on your canvas, and configure the required settings under **Tiles Settings**.

To adjust the number of columns, the gaps between them, and the column content alignment per screen size, click the Columns block on your canvas and configure the required settings under **Columns Settings**.


.. image:: /user/img/concept-guides/content-management/adapt-columns.png
   :alt: Illustrating the three-column and one-column block for the desktop and tablet breakpoints respectively

Adapt Images
~~~~~~~~~~~~

To increase or reduce the image size per breakpoint, drag the sizing handle or use the **Dimension** menu to set the required size and margins of the image.

To adjust the image positioning inside the block, use the **General** settings menu.

To set a different image per breakpoint:

1. Select a breakpoint.
2. Click the image to display its menu settings. Click |IcConfig| to open the **Picture Sources Manager** menu to view all images per breakpoint.
3. Click **Add Source**.
4. Select the picture from the list of available :ref:`DA records <digital-assets>`.
5. Select the breakpoint from **Media Query**. The field will be populated with the values default for the format. You can add as many formats as needed to display the picture properly on different screen sizes.
6. Drag the images to prioritize the ones with the lowest dimension.
7. Click **Save**.


.. image:: /user/img/concept-guides/content-management/adapt-images-per-screen-size.gif
   :alt: Small video tutorial on how to change the image per breakpoint

Hide Content
~~~~~~~~~~~~

To hide a particular fragment of content:

1. Select a breakpoint.
2. Open the **Layer Manager** menu with a list of all available blocks for your canvas.
3. Click the block to hide (text, content, quote, image, div, table, etc.), except for the tiles and columns.

   Alternatively, click the required block on your canvas to open the Style Manager menu. Make sure you select the highest parent block, otherwise the block may not be hidden fully, and may break the content view.

4. Open **General > Display** and select the **none** option to hide the block.

.. image:: /user/img/concept-guides/content-management/adapt-table-per-screen-size.png
   :alt: Illustrating a three-column table and a two-column table for the desktop and tablet breakpoints respectively

Hide Columns and Tiles
~~~~~~~~~~~~~~~~~~~~~~

To hide a particular block of columns or tiles, you need to wrap it into the div container. Columns and tiles have a complicated structure, which can break the view if you take a puzzle out of the set, so it is possible to hide only the entire block, not a single object. To prevent WYSIWYG from breaking the formatting and styles of columns and tiles, you need to add a Div block to your layout and paste the block of tiles or columns inside it.

For that:

1. Select a breakpoint.
2. Open the **Blocks** menu and drag the DIV Block from the menu to your canvas next to the block you want to hide.
3. Click the block of tiles or columns. Make sure you select the highest parent block, otherwise the block may not be hidden fully, and may break the content view.
4. Move the block of tiles or columns inside the Div block.
5. Once the tiles or columns are wrapped into the div container, you can manage them similarly to any other content block.
6. Open **General > Display** and select the **none** option to hide the block.
7. The changes are applied to all screens with a smaller resolution, while higher resolution screens remain unaffected.

.. image:: /user/img/concept-guides/content-management/hide-show-columns.gif
   :alt: A video tutorial on how to wrap the column block into the div container and hide it on the tablet breakpoint while the desktop breakpoint remains unaffected

Display Hidden Content
~~~~~~~~~~~~~~~~~~~~~~

To uncover the blocks of content, images, or columns that were hidden for a particular breakpoint:

1. Select a breakpoint.
2. Open the **Layer Manager** menu with a list of all available blocks for your canvas.
3. Click the block that you want to uncover.
4. The **none** option should have been selected for such block. It means that it is hidden for the particular breakpoint.
5. Change **none** to **block** to reveal the content for the breakpoint.
6. The changes are applied to all screens with a smaller resolution, while higher resolution screens remain unaffected.

.. image:: /user/img/concept-guides/content-management/display-hidden-content.png
   :alt: Steps that you need to perform to uncover the hidden block of content


**Related Topics**

* :ref:`WYSIWYG Developer Guide <WYSIWYG-field-dev-guide>`
* :ref:`Post-Installation Configuration: Content Restrictions <dev-guide-setup-content-restrictions>`



.. include:: /include/include-links-dev.rst
   :start-after: begin

.. include:: /include/include-images.rst
   :start-after: begin
