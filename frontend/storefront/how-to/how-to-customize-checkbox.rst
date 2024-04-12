.. _how-to-customize-checkbox:

.. warning:: The documentation you are viewing is accurate for OroCommerce version 5.1 and below. An updated guide for version 6.0 will be available soon.

How to Сustomize Сheckboxes
===========================

To customize checkboxes, change the following base variables:

.. code-block:: scss

    // Variables for both checkbox and radio
    $checkbox-background: get-color('additional', 'ultra') !default;
    $checkbox-size: 16px !default;
    $checkbox-size-var: var(--checkbox-size, #{$checkbox-size}) !default;
    $checkbox-border: 1px solid get-color('additional', 'dark') !default;
    $checkbox-color: get-color('additional', 'ultra') !default;
    $checkbox-border-radius: 3px !default;

    // Variables for checkbox icon
    $checkbox-icon-size: 10px !default;
    $checkbox-icon-line-height: 1 !default;
    $checkbox-icon-checked: $fa-var-check !default;
    $checkbox-icon-indeterminate: $fa-var-minus !default;
    $checkbox-icon-place-self: center !default;
    $checkbox-icon-opacity: 0 !default;
    $checkbox-icon-opacity-checked: 1 !default;

    // Checked
    $checkbox-background-checked: get-color('ui', 'focus') !default;
    $checkbox-border-color-checked: $base-ui-element-border-color-focus !default;

    // Indeterminate
    $checkbox-background-indeterminate: get-color('ui', 'focus') !default;
    $checkbox-border-color-indeterminate: $base-ui-element-border-color-focus !default;

    // Hover
    $checkbox-border-color-hover: get-color('additional', 'dark') !default;

    // Focus
    $checkbox-border-color-focus: $base-ui-element-border-color-focus !default;
    $checkbox-box-shadow-focus: $base-ui-element-focus-style !default;

    // Disable
    $checkbox-border-color-disabled: get-color('additional', 'light') !default;
    $checkbox-background-checked-disabled: get-color('additional', 'base') !default;
    $checkbox-border-color-checked-disabled: get-color('additional', 'light') !default;
    $checkbox-color-disabled: get-color('additional', 'middle') !default;
    $checkbox-opacity-disabled: .55 !default;

    // Variables for radio
    $checkbox-radio-border: 1px solid get-color('additional', 'middle') !default;
    $checkbox-radio-border-radius: 50% !default;

    $checkbox-radio-icon-content: '' !default;
    $checkbox-radio-icon-background-checked: get-color('ui', 'focus') !default;
    $checkbox-radio-icon-size: 10px !default;
    $checkbox-radio-icon-border-radius: 50% !default;

    // Focus
    $checkbox-radio-border-color-focus: transparent !default;
    $checkbox-radio-border-color-checked-focus: get-color('ui', 'focus') !default;

Change Checkbox Size
-----------------------

You can update the checkbox size globally via the ``$checkbox-size`` variable. To change the size in a specific place, use css-variable ``--checkbox-size``.

.. code-block:: scss

    .custom-checkbox {
        --checkbox-size: 13px;
    }

Change Checkbox Color
------------------------

To change the base checkbox color, update the following variables:

.. code-block:: scss

    // Checked
    $checkbox-background-checked: get-color('ui', 'focus') !default;
    $checkbox-border-color-checked: $base-ui-element-border-color-focus !default;

    // Indeterminate
    $checkbox-background-indeterminate: get-color('ui', 'focus') !default;
    $checkbox-border-color-indeterminate: $base-ui-element-border-color-focus !default;

    // Hover
    $checkbox-border-color-hover: get-color('additional', 'dark') !default;

    // Focus
    $checkbox-border-color-focus: $base-ui-element-border-color-focus !default;
    $checkbox-box-shadow-focus: $base-ui-element-focus-style !default;

    // Disable
    $checkbox-border-color-disabled: get-color('additional', 'light') !default;
    $checkbox-background-checked-disabled: get-color('additional', 'base') !default;
    $checkbox-border-color-checked-disabled: get-color('additional', 'light') !default;

To change colors dynamically, use the same approach as with the checkbox size using the css-variable.

.. code-block:: scss

    // Checked
    $checkbox-background-checked: var(--checkbox-skin-color, get-color('ui', 'focus')) !default;
    $checkbox-border-color-checked: var(--checkbox-skin-color, #{$base-ui-element-border-color-focus}) !default;

You can then change the color dynamically via JavaScript by setting the value of the css-variable:

.. code-block:: html

    <input type="checkbox" style="--checkbox-skin-color: #380;">

.. image:: /user/img/storefront/how_to_customize_checkbox/checkbox_skin_color.png
