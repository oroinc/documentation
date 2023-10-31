.. _accessibility-concept-guide:

E-Commerce Accessibility
========================

Although everyone now shops online, at Oro, we understand that shoppers are different and products must be accessible to all consumers. As of OroCommerce v.5.0LTS, we made sure that we are fully compliant with WCAG 2 Level AA and ADA Level 2 and compatible with screen readers and other assistive technology.

Customers and employees with visual, hearing, or other impairments can take advantage of various assistive features, such as keyboard-optimized navigation, search autocomplete, captions, larger text fonts, and UI that adapts to magnification.

Keyboard-Optimized Navigation
-----------------------------

Not everyone can use a mouse to browse the website, so we provided a logical and intuitive keyboard navigation order. You can navigate across the storefront without a mouse by using your keyboard. To activate keyboard-assistive navigation, press the **Tab** key. You may see a **Skip to Main Content** button at the top of the screen. Use the Tab key to navigate forward and backward between elements; selected elements are easy to identify as they are outlined with a border.

.. image:: /user/img/concept-guides/accessibility/skip-to-main-content.png
   :alt: Button Skip to Main Content that appears when you click TAB for the first time and initiate assistive keyboard navigation

Watch for visual focus indicators: you can use the Tab key for elements that light up in blue and the arrow keys for elements that are highlighted in yellow. You can open menus and dropdown elements using Enter or down-arrow keys, and close menus, dropdowns, and popups with the Esc key.

.. image:: /user/img/concept-guides/accessibility/blue-tab_yellow-arrows.png
   :alt: Blue for tab element vs yellow for arrows

Screen Readers
--------------

We ensured that our text descriptions in the storefront could work with screen readers. All storefront fields have "aria" labels for describing interactive elements, so if a problem arises when submitting a form, users can address it with keyboard commands and receive explanations in a visual format. When a user successfully submits a form, they are audibly alerted.

On top of this, all non-text elements with no displayed text, such as icons or page arrows, have a definition added to them, so every screen reader can audio-describe what a particular element is for. The image below illustrates the description of the pencil icon used to update the details of the current product in a shopping list.

.. image:: /user/img/concept-guides/accessibility/element-description-screenreaders.png
   :alt: Description for a pencil icon for screenreaders

In addition to using color to signify that users have entered wrong information or have not provided enough information for a particular request, we have added meaningful labels and texts to help perceive information correctly when relying on color alone may be impossible.

.. image:: /user/img/concept-guides/accessibility/error-fields-meaningful-text.png
   :alt: Fields a visually highlighted with an error message underneath

All storefront images have alt attributes. Like with page elements, these are short descriptions that describe the contents of the image and allow screen readers to describe these images accurately.

.. image:: /user/img/concept-guides/accessibility/alt-images.png
   :alt: Images have alt attributes with descriptions of the contents of the image

Adaptive Page Magnification
---------------------------

You can use CTRL + / CTRL - to control the webpage size. We made sure that our design neatly adapts to magnification, with text, images, and menus adjusting depending on the chosen level of magnification. Below are examples of 100%, 125%, and 175% magnification.

.. image:: /user/img/concept-guides/accessibility/zoom100.png
   :alt: 100% page magnification

.. image:: /user/img/concept-guides/accessibility/zoom125.png
   :alt: 125% page magnification

.. image:: /user/img/concept-guides/accessibility/zoom175.png
   :alt: 175% magnification

Search Autocomplete
-------------------

OroCommerce storefront supports search autocomplete, or predictable search, making it easier for users to enter text by generating predictions based on the first letters they type in. Our search autocomplete feature shows up-to-date product information, such as SKU, name, price, and inventory status. A system administrator can even :ref:`configure the number of products <configuration--guide--commerce--configuration--product-search>` to display in the search result dropdown via the back-office.

.. image:: /user/img/concept-guides/accessibility/autocomplete.gif
   :alt: Illustration of predictable search in the storefront
