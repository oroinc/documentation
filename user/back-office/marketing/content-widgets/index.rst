.. _user-guide--landing-pages--marketing--content-widgets:
.. _content-widgets-user-guide:

Manage Content Widgets in the Back-Office
=========================================

.. hint:: This section is part of the :ref:`Content Management Concept Guide <concept-guide-content-management>` topic that provides a general understanding of the tools that help manage the content of your website, such as web catalog, landing page, content blocks, widgets, and WYSIWYG editor.

Content widgets are snippets of structured information that you can insert into any WYSIWYG field in your application. :ref:`WYSIWYG fields <getting-started-wysiwyg-editor-field>` are available throughout OroCommerce; for example, in category descriptions, on edit pages of products, content blocks, and landing pages.

There are four content widget types:

* An Image Slider
* A Contact Us form
* A Product Mini Block
* A Product Segment
* Tabbed Content

Each of these widget types has a different set of options.

Please keep in mind that:

+---------------------------------------------------------------------+
|You can:                                                             |
|                                                                     |
|* Edit content widgets from the grid and view page.                  |
|                                                                     |
|You cannot:                                                          |
|                                                                     |
|* Delete a widget if it is used in a content block or a landing page.|
|* Change widget type for an already existing widget.                 |
+---------------------------------------------------------------------+

.. note:: Whenever you modify a content widget, changes are applied everywhere the widget is used.

Create a Content Widget
-----------------------

To create a new content widget:

1. Navigate to **Marketing > Content Widgets** in the main menu.
2. Click **Create Content Widget** on the top right.

   .. note:: If you have more than one organization in your OroCommerce application, first select the organization to which you want to add a new content widget.

3. Depending on the widget type, form fields are different:

   * **Contact Us Form** - Enables you to add a standard Contact Us form.

    .. image:: /user/img/marketing/content_widgets/contact_us.png
       :alt: Contact us content widget form

   * **Image Slider** - Enables you to configure and add an image slider.

    .. image:: /user/img/marketing/content_widgets/image_slider_1.png
       :alt: Image slider content widget form

    |

    .. note:: You can add as many slides as necessary by clicking **Add** at the bottom of the *Slides* section.

            .. image:: /user/img/marketing/content_widgets/image_slider_2.png
               :alt: Image slider content widget form

    |

   * **Product Mini Block** - Enables you to add a block with product information with or without prices and/or the **Add to Shopping List** button.

     .. image:: /user/img/marketing/content_widgets/mini-block.png
        :alt: A product mini block form

    |

   * **Product Segment** - Enables you to add a product segment content widget, configure how many max and min items to show, whether to use slider on mobile, and show the **Add to Shopping List** button in the storefront. Only segments with type *Product* are listed in the **Segment** field dropdown. You can modify an existing :ref:`segment <user-guide--business-intelligence--filters-segments>` or create a new one under **Reports&Segments > Manage Segments**.

     .. image:: /user/img/marketing/content_widgets/product-segment.png
        :alt: A product mini block form

    |

   * **Tabbed Content** - Enables you to add content to your storefront website in a form of tabs or an accordion.

     .. image:: /user/img/marketing/content_widgets/tabs-vs-accordion.png
        :alt: Tabbed vs Accordion view of tabbed content widget

    |

     Tabbed content widget uses the :ref:`WYSIWYG editor <getting-started-wysiwyg-editor-field>` which enables you to inject other content widget(s), such as a contact us form, into your current tabbed content widget.

     .. image:: /user/img/marketing/content_widgets/injected-widget.png
        :alt: Contact us widget embedded in tabbed content widget
        :scale: 40%

4. Once you have provided all widget-specific details, click **Save and Close**.

   .. .. image:: /user/img/marketing/content_widgets/widget-view.png
         :alt: Content widget view page

   |

   .. hint:: Each content widget may have various representations in the form of layouts. Developers define layouts using the existing :ref:`layout update functionality <dev-doc-frontend-layouts-layout>`, which enables you to alternate between the pre-configured designs for each widget in the back-office.

             .. image:: /user/img/marketing/content_widgets/layout-dropdown.png
                :scale: 50%
                :align: center
                :alt: Select Layouts in the back-office

             Please be aware that layouts are theme-specific. For more information, please refer to the :ref:`CMS bundle documentation <how-to_create-content-widget-type>`.

