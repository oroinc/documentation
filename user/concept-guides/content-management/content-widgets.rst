:oro_show_local_toc: false

.. _concept-guide-content-widgets:

Content Widgets Management Concept Guide
========================================

:ref:`Content widgets <user-guide--landing-pages--marketing--content-widgets>` are predefined page components that display particular data on your website. Widgets help you design an advanced content on your web pages. Content widgets are self-updating content blocks that you can place to your website's page, providing your customers with always new and fresh information.

In OroCommerce, there are multiple built-in system content widgets with different options that you can set to customize the widget as required.

.. image:: /user/img/concept-guides/content-management/content_widgets.png
   :alt: A variety of content widgets available in the system

Each application can have a different set of widget types depending on the customization. With these types, you can create an unlimited number of widgets. Below are several default types:

* **An Image Slider** --- a content widget that enables you to add multiple image slides and configure their visual representation by setting the number of slides to be displayed, adding and formatting text, and setting alignment options.

.. image:: /user/img/concept-guides/content-management/image-slider.gif
   :alt: Illustration of the Image Slider content widget in the storefront

* **A Contact Us form** --- a standard Contact Us form that you can insert into any website page. The form is predefined by the system, so any changes or modifications to the form require developer's assistance.

.. image:: /user/img/concept-guides/content-management/contact_us_form.png
   :alt: Illustration of the Contact Us form content widget in the storefront

* **A Product Mini Block** --- a block with product information that you can insert to your WYSIWYG field. The block can include any product with or without prices as well as the Add to Shopping List button.

.. image:: /user/img/concept-guides/content-management/product_mini_block.png
   :alt: Illustration of the Product Mini Block content widget in the storefront

* **A Product Segment** --- a block with a certain product segment, either New Arrivals, Featured Products, or All Products that you can insert to your landing page or content block. This content widget enables you to add a label to be displayed above the list of the products, configure the max and min number of items to show, whether to use slider on mobile, and show the **Add to Shopping List** button in the storefront. Additionally, you can enable or disable autoplay and control its speed in milliseconds, select whether to display dots and/or arrows at the bottom of the product segment and on touchscreens, enable or disable infinite scroll.

  .. hint:: Check out the :ref:`Manage Segments in the Back-Office <user-guide--business-intelligence--filters-segments>` guide to learn how to create new segments or modify the existing ones so that they can appear in the widget.

.. image:: /user/img/concept-guides/content-management/product_segment.png
   :alt: Illustration of the Product Segment content widget in the storefront

* **Tabbed Content** - a block of content that displays information on your storefront website using tabs or an accordion format.

.. image:: /user/img/concept-guides/content-management/tabbed_content.png
   :alt: Illustration of the Tabbed Content widget in the storefront

* **Customer Dashboard DataGrid** - a block of structured, table-style content that can be added to the customer user’s :ref:`Dashboard <storefront--dashboard>` page in the My Account section. Each block displays up to five of the latest records and provides a link to a dedicated page for full details. Displayed blocks include the information about customer user's latest orders, open quotes, checkouts, requests for quotes, and shopping lists.

.. image:: /user/img/concept-guides/content-management/customer-dashboard-content-widget.png
   :alt: Illustration of the Customer Dashboard DataGrid widget in the storefront

* **Scorecard** - (available as of OroCommerce version 6.1.1) a block of key business metrics in a compact, easy-to-read format that can be added to the customer user’s :ref:`Dashboard <storefront--dashboard>` page in the My Account section. The scorecards represent the information about the total number of customer users under the current customer, the number of shopping lists, open Requests for Quote (excluding cancelled ones), and the total value of all non-cancelled orders. The scorecard is shown only if the current customer user has appropriate *View* permissions for the corresponding entity. If the customer user has *View – None* permission, the respective scorecard will not be displayed.

.. image:: /user/img/concept-guides/content-management/customer-dashboard-scorecard.png
   :alt: Illustration of the Customer Dashboard Scorecard widget in the storefront


Add a Content Widget to WYSIWYG Fields
--------------------------------------

Once you save the content widget, you can now place it to the required location in the WYSIWYG field of your landing page or content block. To add a content widget to a field, drag it from the editor's manager panel, and drop it to the desired location.

The widgets can be of two types, block and inline widgets.

**Block widgets** are added as a content widget block to a WYSIWYG field.

.. image:: /user/img/marketing/content_widgets/drag_cw.png
   :alt: Adding a block content widget to a WYSIWYG field

**Inline widgets** are added through the text block.

.. image:: /user/img/marketing/content_widgets/add_inline_content_widgets.png
   :alt: Adding an inline content widget to a WYSIWYG field


All landing pages and content blocks where content widgets were used, are displayed in the **Usages** section of each content widget.

.. image:: /user/img/marketing/content_widgets/usages.png
   :alt: Landing page linked to a content widget displayed in the Usages section



**Related Articles**

* :ref:`Manage Content Widgets in the Back-Office <content-widgets-user-guide>`
* :ref:`Manage Segments in the Back-Office <user-guide--business-intelligence--filters-segments>`