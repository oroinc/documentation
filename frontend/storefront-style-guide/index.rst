:title: OroCommerce Storefront Design Creation and Customization Guide

.. meta::
   :description: Instructions on creating and customizing OroPlatform-based application UI using Figma

.. _frontend--storefront-design:
.. _frontend--storefront-style-guide:
.. _storefront-style-guide--quick-start:
.. _frontend--design-customization:

Storefront Design: Style Guide
==============================

OroCommerce 6.0 LTS has introduced a brand new Refreshing Teal storefront theme that gives a modern and fresh look. This theme includes a fully editable homepage with configurable content templates and widgets, an improved and retina-optimized slider, product segment widgets and more. The new theme has been designed to improve accessibility and internationalization, making navigation, search, and checkout experiences better, while also ensuring optimal performance.

We understand that every brand has its own unique corporate identity that sets it apart in the market. While OroCommerce offers options to :ref:`customize the look and feel of the new theme in the back-office <back-office-theme-configuration>`, we have compiled this style guide to assist you in customizing the current Refreshing Teal theme interface to align it with your corporate identity.

.. image:: /img/frontend/storefront-design/Storefront-Style-Guide.png
   :alt: Storefront designs

Download Figma Design Files
---------------------------

To help you create your custom Storefront theme design, we compiled two files, the |Style Guide| and |Design Mockups|. To access these files, you need a |Figma account| with a Professional, Organization, or Enterprise plan. This will allow you to connect the library file to your working design files.

This |Style Guide| contains:

* **Styles** with instructions on how to use them (colors, shadows and typography). You can change the styles to fit your company identity, publish library updates to your design work Figma file, and these styles will automatically be updated in every instance on every page that uses them.

* **Ready-to-go UI components**, from the simple ones (e.g., |Feather Icons|, buttons) to the compound ones (e.g., product cards) that are built with auto layouts and according to :ref:`the atomic approach <frontend--design--atomic-approach>`.

|Design Mockups| encompass all primary screens and page components, allowing for customizable design alterations.

.. image:: /img/frontend/storefront-design/Colors.png
   :alt: Color palette in style guide

Customize the Library
^^^^^^^^^^^^^^^^^^^^^

Once you have downloaded the |Style Guide| (Storefront Style Guide 6.0) and |Design Mockups| (Design Mockups 6.0) files, you can start customizing and use the provided Figma library:

1. Import the downloaded Figma files into your Figma project.

.. note:: Please remember that using a separate library file, which is our suggested approach, is only available if your team in Figma is on Professional, Organization or Enterprise plan.

2. In the newly imported library file (Storefront Style Guide 6.0), open the Assets tab in the left panel and click on the book icon.

3. Find your newly imported library file name and click **Publish**; click Publish again in the window with styles.

.. image:: /img/frontend/storefront-design/Customize-Library.png
   :alt: Illustration of the Figma UI with options to Publish the library file

4. When your library file is successfully published, make sure it does not contain styles or elements from any missing libraries. For this, open the Assets tab in the left panel and click on the book icon again. See if under the *Libraries available in this file* it says *Includes 1 missing library*. If it does, click the chevron right > with the *Choose library* dropdown to select your newly imported library file’s name and click **Swap Library**. The *Swap default styles in instances* option should be checked.

5. Open your newly imported work file (Design Mockups 6.0). In the Assets tab, click on the book icon. Under the *Libraries available in this file* find *Includes 1 missing library* (the source library which your Storefront Style Guide 6.0 file is an exact duplicate of), click the chevron right > with the *Choose library* dropdown to select your newly imported library file’s name and click **Swap Library**. The *Swap default styles in instances* should be checked. Swapping may take some time.

6. While still in your work file, open the Assets tab and click on the book icon again. Make sure your newly imported library is marked as **Added**, and that the file does not use elements or styles from any other libraries.

7. You can now customize the library styles and components.

For the development spec of a certain component, please use the Dev Mode.

Apply Changes
^^^^^^^^^^^^^

Once you have finished customizing the style guide and components library, please apply the changes to your work Figma file (the file with the design mockups) where this library has been added:

1. Open the Assets tab in the left panel of this file (library) and click on the book icon.
2. Find the current file (Storefront Style Guide 6.0), click **Publish changes** and then **Publish**.
3. Open your work Figma file. If this library is toggled on in your file, click **Review unpublished changes** (the book icon in the top right corner of the Figma toolbar) and then **Update all**.

.. image:: /img/frontend/storefront-design/Apply-Changes.png
   :alt: Illustration of the Figma UI with options to Update the file

For more in-depth customization of the theme design, such as changing element positions or page layouts, navigate through each page individually in your work file and make the changes there.

.. _storefront-style-guide--tips-and-tricks:

Recommended Figma Plugins
-------------------------

We have curated a list of plugins aimed at improving your workflow and productivity within the Figma platform.

* **A11y - Color Contrast Checker** — this plugin checks the color contrast ratio of all visible text in a frame, and it provides feedback on whether it meets WCAG’s AA and/or AAA level compliance. It also provides color sliders that allow users to adjust the colors and understand how the corresponding contrast ratio changes in real-time.

* **Batch Styler** — batch change color styles (hue, saturation, lightness, alpha, hex), typography styles (font family, font weight, line height, letter spacing), batch delete or rename styles.

* **Design System Organizer**  — bulk swap instances and styles between masters with the same name. Copy styles between files. Manage pathnames like “toolbar/nav/back” using a folder-like interface.

* **Style Organizer** — merge and link all color & text styles in the page:

  - overall usage assessment
  - group elements with the same appearance together
  - merge and link to the selected style
  - select all elements with the style
  - make all possible fixes automatically with a single click.

* **Instance Finder** — find all Instances of a Component used in your file.

* **Max Line Length** — a plugin that counts the maximum number of characters across all lines in a text box.

* **Select Layers** — select layers by name, type or any property (hidden/parent/similar, etc.).

* **Iconify** — import Material Design Icons, FontAwesome, Jam Icons, EmojiOne, Twitter Emoji and many other icons (more than 100 icon sets containing over 100,000 icons) to Figma document as vector shapes.

* **Content Reel** — browse or search content to find published collections of text strings, images, and icons.

.. _frontend--design--atomic-approach:

Atomic Design Approach
----------------------

The structure of the OroCommerce UI is based on the Atomic Design approach, which means that all functional elements consist of:

* :ref:`Atoms <principles-atoms>` - the smallest elements that cannot be separated and that serve as elementary blocks of the interface (colors, typography, buttons, icons, etc.)
* :ref:`Molecules <principles-molecules>` - groups of atoms that form relatively simple functional interface elements (pop-up, button with dropdown, navigation menu)
* :ref:`Organisms <principles-organisms>` - groups of molecules that form the relatively complex parts of the interface (header, footer, sidebar)
* :ref:`Templates <principles-templates>` - help place components in the layout and demonstrate the content structure underlying the design
* :ref:`Pages <principles-pages>` - help apply real content to templates displaying the final interface

.. image:: /img/frontend/storefront-design/Principles.jpg
   :align: center
   :alt: Principle of the atomic design approach

.. _principles-atoms:

Atoms
^^^^^

Atoms are fundamental building blocks of a user interface. They are comprised of basic HTML elements such as buttons, inputs, headers, etc. and cannot be separated without losing their functionality. Each atom has its own unique properties.

For instance, a button atom has properties such as background color, form, title color, size, and font. By modifying these properties, you can alter the overall style of the interface where the atom is utilized.

Atoms provide a foundation for all basic styles. Therefore, they can serve as a valuable reference material while designing and implementing a user interface in OroCommerce.

.. image:: /img/frontend/storefront-design/Atoms.png
   :align: center
   :alt: Illustration of the atom properties

.. _principles-molecules:

Molecules
^^^^^^^^^

Grouping atoms together forms molecules, which act as functional elements within an interface. For example, an input combined with two buttons becomes a form for editing the title of a shopping list. The input allows for the entry of a name, while the buttons provide options to accept or reject the form.

Utilizing molecules helps ensure the interface remains consistent and intuitive for users.

.. image:: /img/frontend/storefront-design/Molecules.png
   :alt: Illustration of the molecules properties

.. _principles-organisms:

Organisms
^^^^^^^^^

Organisms are relatively complex components of a user interface. They consist of groups of molecules, atoms, or even other organisms. These organisms form distinct parts of the interface.

Taking the OroCommerce Storefront as an example, the header comprises various molecules and atoms, such as:

- Login links and contact information (atoms)
- Logo (atom)
- Search field (a molecule that includes an input field atom and a search icon)
- Navigation menu (a molecule made up of menu item atoms), etc.

An organism is a self-contained, isolated interface element that can function independently.

 .. image:: /img/frontend/storefront-design/Organisms.png
    :alt: Illustration of the organism properties

.. _principles-templates:

Templates
^^^^^^^^^

Templates are objects that define the layout of a page and provide a basic structure for the content. They show how components interact with each other and how the page should behave. Templates deal with the structure and logic of the page, covering all necessary UX cases where the actual content is not important.

Building on the previous example, the "header" component can be applied to the home page template.

.. image:: /img/frontend/storefront-design/Templates.png
   :alt: Illustration of the templates

.. _principles-pages:

Pages
^^^^^

Pages are templates that demonstrate how a user interface with actual content should appear. They represent the final stage of atomic design and showcase the version of the interface that is available to end-users. This is where you can see how all the individual components come together to form an attractive and functional user interface.

.. image:: /img/frontend/storefront-design/Pages.png
   :alt: Illustration of the page templates

.. _frontend--responsive-approach:

Responsive Approach
-------------------

OroCommerce uses responsive web design, an approach that ensures web pages display correctly on various devices and screen sizes. To achieve usability and satisfaction, content, design, and performance must be consistent across all devices.

Breakpoints refer to the points at which the interface adjusts based on the display resolution. To successfully implement the theme design, designers must provide interface designs for the following horizontal resolutions:

* 360px - mobile device
* 768px - tablet
* 1280px - small desktop (optional)
* 1920px - large desktop

.. image:: /img/frontend/storefront-design/Responsive-Approach.png
   :alt: Illustration of the responsive web design approach

.. include:: /include/include-links-dev.rst
   :start-after: begin

.. include:: /include/include-links-seo.rst
   :start-after: begin

.. admonition:: Business Tip

   How can your manufacturing company prepare for |digitalization in manufacturing|? In our guide, we share business cases and best practices on succeeding in manufacturing digitization.
