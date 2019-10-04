.. _dev-doc-frontend-css-frontend-dev-guidelines:

Oro Frontend Development Guidelines
===================================

Oro Frontend Development Guidelines describe the **Code style**, a set of conventions that describe the way to write code.

Naming Conventions
------------------

The main idea of the naming convention is to create names as informative
and clear as possible.

Selector Naming
^^^^^^^^^^^^^^^

Selector names are **lowercase** and their logical parts are divided by a dash (**-**).

**Acceptable**

::

    product-gallery-widget

**Unacceptable**

::

    productgallerywidget, productGalleryWidget, product_gallery_widget

Block Name
^^^^^^^^^^

A block is a logical self-contained functional component of the
user interface.

A block identifier should match the corresponding :ref:`layout block type identifier <dev-doc-frontend-layouts-layout>`.

Block names (a part of the block identifier) may be prefixed with a short namespace or a bundle
identifier if similar blocks are provided by multiple bundles to eliminate confusion, for instance.

**Examples:**

::

    product-info, shopping-cart, currency-switcher
    order-group-totals and quote-group-totals, or even crm-quote-group-totals and commerce-quote-group-totals

Element Name
^^^^^^^^^^^^

The namespace of an element (which is equal to the parent block ID) identifies the element as belonging to the block.

In the element identifier, the element name is delimited from the element namespace by a double
underscore (\*\*\_\_\*\*):

::

    block-name\_\_elem-name

If a block has several identical elements (e.g., menu items), all of them will have the same name (e.g. menu\_\_item).

Modifier Name
^^^^^^^^^^^^^

The namespace of a modifier (which is equal to the parent block ID or the parent element ID) identifies the modifier as belonging to the block or the element.

The modifier name is delimited by a single underscore (**\_**) from the modifier namespace:

-  for Boolean modifiers - owner-name\_mod-name
-  for key-value type modifiers - owner-name\_mod-name--mod-val

This gives the following advantages:

-  The logic of naming enables you to immediately understand what a particular class represents.
-  Decreases the possible conflict issues between classes.
-  Each element is in the namespace.
-  Components are easily transferred from project to project.

HTML Coding Standards
---------------------

Base Code Style
^^^^^^^^^^^^^^^

1. Do not add a slash at the end of single elements.
2. The attributes in use are **" "**, not **' '**.
3. No spaces or tabs after the closing tag.
4. Indent only with spaces.
5. The attachment elements are indented with 4 spaces.

Simple Names
^^^^^^^^^^^^

.. code:: HTML

    <div class="product">
        <p class="product__name">Product name</p>
        <div class="product__prices">...</div>
        <div class="product__info">...</div>
    </div>

The Order of the Attributes
^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. The required and optional attributes for the tag (e.g., name, type, src, href, etc).
2. Attributes used for UI customization (e.g., class, data-\*, etc).
3. Attributes with JSON content.

.. code:: HTML

    <input name type id
        class
        data-*
        data-entity="{{ {
            id: entity.id,
            title: entity.title
        }|json_encode }}"
        />

CSS Coding Standards
--------------------

Base Code Style
^^^^^^^^^^^^^^^

1. Built on |SASS| preprocessor.
2. Focused on web standards.

The Principles of CSS Architecture
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

* **Predictability** --- Predictability for CSS means that your rules are behaving as expected.

* **Reusable** --- CSS rules should be abstract and decoupled enough for you to build new components quickly from existing parts without having to recode patterns and problems that you have already solved.

* **Scalable** --- Scalable CSS means that it can be easily managed by a single person or a large engineering team.

* **Support** --- When new components and features need to be added, updated or rearranged on your site, doing so should not require refactoring existing CSS.

* **Responsive** --- We use CSS to resize, hide, shrink, enlarge, or move the content to make it look good on any screen.

SASS Code Standards
^^^^^^^^^^^^^^^^^^^

1.  Use the **.scss** syntax.
2.  Indentation only with spaces.
3.  Indent size: 4 spaces
4.  Continuation indent: 4 spaces
5.  The attributes in use are **' '** not **" "**.
6.  Use: **{}, :, ;**.
7.  Put a space before the opening brace **{** in rule declarations.
8.  Put the closing braces **}** of rule declarations on a new line.
9.  Each component is written in a separate file.
10. Do not write vendors' prefixes.

Comments
~~~~~~~~

1. Prefer the **//** line comments to block comments.
2. Prefer comments on their own line. Avoid end-of-line comments.

**Acceptable**

.. code:: scss

    .element {
        // Use base color
        color: $color;
    }

**Unacceptable**

.. code:: scss

    .element {
        color: $color; /* Use base color */
    }

Format
~~~~~~

Add a space before the opening brace and a line break after. Add a line break
before closing brace.

**Acceptable**

.. code:: scss

    .element {
        color: $color;
    }

**Unacceptable**

.. code:: scss

    .element{color: $color;}

Selector Delimiters
~~~~~~~~~~~~~~~~~~~

Add a line break after each selector delimiter. Delimiter should not have
spaces before and after.

**Acceptable**

.. code:: scss

    .element1,
    .element2 {
         color: $color;
    }

**Unacceptable**

.. code:: scss

    .element1, .element2 {
        color: $color;
    }

Type Selectors
--------------

Unless necessary (for example with helper classes), do not use element
names in conjunction with IDs or classes. Avoiding unnecessary ancestor
selectors is useful for performance reasons.

**Acceptable**

.. code:: scss

    .element {
        ...
    }

**Unacceptable**

.. code:: scss

    div.element {
        ...
    }

    div#element {
        ...
    }

Combinator Indents
^^^^^^^^^^^^^^^^^^

Use spaces before and after combinators.

**Acceptable**

.. code:: scss

    .element1 + .element2 {
         color: $color;
    }

**Unacceptable**

.. code:: scss

    .element1+.element2 {
        color: $color;
    }

Properties Line Break
^^^^^^^^^^^^^^^^^^^^^

Use line break for each property declaration.

**Acceptable**

.. code:: scss

    .element {
         position: absolute;
         top: 0;
         left: 0;
    }

**Unacceptable**

.. code:: scss

    .element {
        position: absolute; top: 0; left: 0;
    }

Properties Colon Indents
^^^^^^^^^^^^^^^^^^^^^^^^

Use no space before property colon and a space after.

**Acceptable**

.. code:: scss

    .element {
        color: $color;
    }

**Unacceptable**

.. code:: scss

    .element1 {
        color : $color;
    }

    .element2 {
        color:$color;
    }

    .element3 {
        color :$color;
    }

End of the Selector
^^^^^^^^^^^^^^^^^^^

Each selector should be finished with a new line.

**Acceptable**

.. code:: scss

    .element1 {
        color: $color;
    }

    .element2 {
        color: $color;
    }

**Unacceptable**

.. code:: scss

    .element1 {
        color: $color;
    }
    .element2 {
        color: $color;
    }

Shorthand
^^^^^^^^^

If you use more than 2 parameters (three indents, for example), write
short:

.. code:: scss

    .element {
        margin: 10px 0 5px;
    }

If less, then:

.. code:: scss

    .element {
        margin-top: 10px;
        margin-right: 2px;
    }

Floating Values
^^^^^^^^^^^^^^^

Do not add zero for fractional numbers.

**Acceptable**

.. code:: scss

    .element {
        opacity: .5;
    }

**Unacceptable**

.. code:: scss

    .element {
        opacity: 0.5;
    }

Zero and Units
^^^^^^^^^^^^^^

Omit the units for zero value.

**Acceptable**

.. code:: scss

    .element {
        margin: 0;
    }

**Unacceptable**

.. code:: scss

    .element {
        margin: 0px;
    }

Border
^^^^^^

Use 0 instead of none to specify that a style has no border.

**Acceptable**

.. code:: scss

    .element {
        border: 0;
    }

**Unacceptable**

.. code:: scss

    .element {
       border: none;
    }

Nesting
^^^^^^^

When selectors become quite long, you may write CSS that is:

- Strongly coupled to the HTML
- Overly specific
- Not reusable

Selector Nesting
~~~~~~~~~~~~~~~~

Be careful with selector nesting. In general try to use **2 nested
levels** max.

Exceptions are **pseudo elements** and **states**.

**Acceptable**

.. code:: scss

    .block {
        &__element {
            &--modifier {
                ...
            }
        }

        &--modifier {
            ...
        }
    }

**Unacceptable**

.. code:: scss

    .block {
        ...

        .block__element {
            ...

            &.block__element--modifier {
                // STOP!
            }
        }

        &.block--modifier {}
    }

No Elements of Elements
~~~~~~~~~~~~~~~~~~~~~~~

According to BEM methodology, there are no elements of elements. It makes
the elements dependent on the block only. So, you can easily move
them across the block when providing changes to the interface.

**Acceptable**

.. code:: scss

    .block {
        ...

        .block__some-element {
            ...
        }

        .block__other-element {
            ...
        }
    }

**Unacceptable**

.. code:: scss

    .block {
        ...

        .block__some-element {
            ...

            .block__some-element__other-element {
                // STOP!
            }
        }
    }

Place of @media Rules
^^^^^^^^^^^^^^^^^^^^^

All @media rules are placed at the end of file. The block applies only to the
common styles for all devices. @media describes individual styles for
each type of device. This enables us to change or add
styles only for a specific type of device in the future.

**Acceptable**

.. code:: scss

    .block {
        width: 50%;
        padding: 10px;

        background-color: get-color('additional', 'middle');

        &__element {
            font-size: 12px;
        }
    }

    @include breakpoint('tablet') {
        .block {
            width: 100%;
        }
    }

    @include breakpoint('mobile') {
        .block {
            padding: 15px;

            &__element {
                font-size: 15px;
            }
        }
    }

**Unacceptable**

.. code:: scss

    .block {
        width: 50%;
        padding: 10px;

        background-color: get-color('additional', 'middle');

        @include breakpoint('tablet') {
            width: 100%;
        }

        @include breakpoint('mobile') {
            padding: 15px;
        }

        &__element {
            font-size: 12px;

            // STOP!
            @include breakpoint('mobile') {
                font-size: 15px;
            }
        }
    }

Work with Colors
^^^^^^^^^^^^^^^^

To work with a color, use the **get-color()** function which returns a color
from a predefined color scheme.

Example:

.. code:: scss

    .block {
        border-color: get-color('additional', 'light');
        color: get-color('primary', 'main');
    }

If you need darker, lighter or more transparent color, use the native Sass
functions: **darken()**, **lighten()**, **transparentize()**, etc.

.. code:: scss

    .block {
        background-color: transparentize(get-color('primary', 'main'), .8);
        border-color: darken(get-color('additional', 'light'), 10%);
        color: lighten(get-color('primary', 'main'), 10%);
    }

Group Properties
^^^^^^^^^^^^^^^^

Group properties are grouped in the following order:

1. variables
2. positioning
3. block model
4. typography
5. visualization
6. other (animation, opacity)
7. mixins

Each group should be followed by an empty string.
 
In CSS, each property can be treated in different groups depending on their
use: `vertical-align`, `overflow`, `clear`, `resize`,
`transform`. 

* |List of all css properties|.

**Acceptable**

.. code:: scss

    // variables
    $element-color: #000 !default;
    $element-font: 12px !default;
    $element-line-height: 1.2 !default;

.. code:: scss

    .element {
        // positioning
        position: absolute;
        top: 0;
        right: 0;
        z-index: z('fixed');

        // block model
        width: 100px;
        height: 100px;
        margin: 10px;
        padding: 10px 20px;

        // typography
        font-size: $element-font;
        line-height: $element-line-height;
        text-align: center;

        // visualization
        border: 10px solid #333;
        background: red;
        color: $element-color;

        // other
        cursor: pointer;
        opacity: .2;

        // mixins
        // grouping @includes at the end makes it easier to read the entire selector.
        @include clearfix;
    }

**Unacceptable**

.. code:: scss

    .element {
        text-align: center;
        margin: 0;
        $color: #000;
        @include clearfix;
        color: $color;
        right: 0;
        position: absolute;
    }

Use @extend Directive
^^^^^^^^^^^^^^^^^^^^^

**Use @extend only selector that is a single class**.

1. Helper class include after variables.
2. Helper class has maximum **5** rules.
3. Helper class has abstract name and overall design style.

**Examples**:

.. code:: scss

    $default-size: 400px !default;
    $default-offset: 10px auto !default;
    $default-inner-offset: 15px !default;
    $default-background: #dadada !default;

    %dialog {
        width: $default-size;
        margin: $default-offset;
        padding: $default-inner-offset;

        background: $default-background;
    }

.. code:: scss

    .modal {
        // other modal styles

        @extend %dialog;

        &__close {
            // other button styles

            @extend %dialog__close;
        }

        &__header {
            // other header styles

            @extend %background-gradient;
        }
    }

Logical Sense
^^^^^^^^^^^^^

Use the logical number of modifiers for the element.

**Acceptable**

"Quiet classes"

.. code:: scss

    %modifier {}
    %another-modifier {}
    %yet-another-modifier {}

    .block {
        &__element {
            &--modifier {
                @extend %modifier;
                @extend %another-modifier;
                @extend %yet-another-modifier;
            }
        }
    }

.. code:: html

    <div class="block">
        <div class="
            block__element
            block__element--modifier">
        </div>
    </div>

**Unacceptable**

.. code:: html

    <div class="block">
        <div class="
            block__element
            block__element--modifier
            block__element--another-modifier
            block__element--yet-another-modifier">
        </div>
    </div>

The Main Mixins and Functions
-----------------------------

Helper to clear inner floats.

.. code:: scss

    @mixin clearfix {
        &:after {
            content: '';

            display: block;

            clear: both;
        }
    }

    // use
    .block {
        @include clearfix;
    }

Helper for the positioning of pseudo-elements.

.. code:: scss

    @mixin after {
        content: '';

        position: absolute;

        display: block;
    }

    // use
    .block {
        //...

        &:after {
            @include after;
        }
    }

Helper function for organizing z-index

.. code:: scss

    @function z($layer) {
        $layers: (
            'base': 1,
            'fixed': 50,
            'dropdown': 100,
            'popup': 150,
            'hidden': -1
        );

        $z-index: map-get($layers, $layer);
        @return $z-index;
    }

    // use
    .dialog {
        //...

        z-index: z('popup') + 1;

        &-overley {
            //...

            z-index: z('popup');
        }
    }

Helper mixin for organizing @media rules

.. code:: scss

    @mixin breakpoint($type) {
        $breakpoints: (
            'large': '(max-width: ' + #{$breakpoint-large} + ')',
            'tablet': '(max-width: ' + #{$breakpoint-tablet} + ')',
            'mobile': '(max-width: ' + #{$breakpoint-mobile} + ')'
        );

        @media #{map-get($breakpoints, $type)} {
            @content;
        }
    }
    // use

    @include breakpoint('tablet') {
        // styles for tablet version
    }

Best Practices
--------------

.. code:: scss

    $block-font-title: 'Tahoma' !default;
    $block-offset: 10px !default;

.. code:: scss

    .block {
        @include clearfix;

        &__element {
            float: left;
            width: 25%;
            padding-left: $list-offset * 2;

            font-size: 14px;

            @extend %transition;

            // compound class
            &-title {
                margin-bottom: $list-offset;

                font-family: $list-font-title;
                font-size: 22px;
                line-height: 1.1;
            }

            &--first {
                padding-left: 0;
            }

            &:hover {
                border-color: get-color('additional', 'middle');
            }
        }

        &__content {
            padding: $list-offset ($list-offset * 2);
        }

        &:hover {
            background-color: get-color('secondary', 'light');
        }

        // State written &. (the active state of the menu item, for example).
        // Usually dynamic.
        &.expand {
            ...
        }
    }

    @include breakpoint('tablet') {
        .block {
            width: 100%;

            &__content {
                padding: $list-offset * 2;

                font-size: 15px;
            }
        }
    }

    @include breakpoint('mobile') {
        .block {
            &__element {
                width: 100%;

                &-title {
                    margin-bottom: 0;

                    font-size: 25px;
                }
            }
        }
    }


.. include:: /include/include-links.rst
   :start-after: begin