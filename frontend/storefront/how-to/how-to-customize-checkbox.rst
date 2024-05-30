.. _how-to-customize-checkbox:



How to Customize Checkboxes
===========================

To customize checkboxes, change the following base variables:

.. code-block:: scss

    // Variables for both checkbox and radio
    $checkbox-background: get-var-color('neutral', 'white-100');
    $checkbox-size: 16px;
    $checkbox-size-var: var(--checkbox-size, #{$checkbox-size});
    $checkbox-border: 1px solid get-var-color('neutral', 'grey3');
    $checkbox-color: get-var-color('neutral', 'white-100');
    $checkbox-border-radius: 3px;

    // Variables for checkbox icon
    $checkbox-icon-size: 16px;
    $checkbox-icon-line-height: 1;
    $checkbox-icon-checked: url('data:image/svg+xml;utf8, <svg>...</svg>');
    $checkbox-icon-indeterminate: url('data:image/svg+xml;utf8, <svg>...</svg>');
    $checkbox-icon-place-self: center;
    $checkbox-icon-opacity: 0;
    $checkbox-icon-opacity-checked: 1;

    // Checked
    $checkbox-background-checked: get-var-color('primary', 'main');
    $checkbox-border-color-checked: get-var-color('primary', 'main');

    // Indeterminate
    $checkbox-background-indeterminate: get-var-color('primary', 'main');
    $checkbox-border-color-indeterminate: get-var-color('primary', 'main');

    // Hover
    $checkbox-background-hover: get-var-color('primary', 'hover');
    $checkbox-border-color-hover: get-var-color('primary', 'hover');

    // Disable
    $checkbox-border-color-disabled:get-var-color('neutral', 'grey2');
    $checkbox-background-checked-disabled: get-var-color('neutral', 'grey1');
    $checkbox-border-color-checked-disabled: get-var-color('neutral', 'grey2');
    $checkbox-color-disabled: get-var-color('text', 'disabled');

    // Variables for radio
    $checkbox-radio-border-radius: 50%;

    $checkbox-radio-icon-content: '';
    $checkbox-radio-icon-background-checked: get-var-color('primary', 'main');
    $checkbox-radio-icon-size: 12px;
    $checkbox-radio-icon-border-radius: 50%;

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
    $checkbox-background-checked: get-var-color('primary', 'main');
    $checkbox-border-color-checked: get-var-color('primary', 'main');

    // Indeterminate
    $checkbox-background-indeterminate: get-var-color('primary', 'main');
    $checkbox-border-color-indeterminate: get-var-color('primary', 'main');

    // Hover
    $checkbox-background-hover: get-var-color('primary', 'hover');
    $checkbox-border-color-hover: get-var-color('primary', 'hover');

    // Disable
    $checkbox-border-color-disabled: get-var-color('neutral', 'grey2');
    $checkbox-background-checked-disabled: get-var-color('neutral', 'grey1');
    $checkbox-border-color-checked-disabled: get-var-color('neutral', 'grey2');

To change colors dynamically, use the same approach as with the checkbox size using the css-variable.

.. code-block:: scss

    // Checked
    $checkbox-background-checked: var(--checkbox-skin-color, get-var-color('primary', 'main'));
    $checkbox-border-color-checked: var(--checkbox-skin-color, get-var-color('primary', 'main'));

You can then change the color dynamically via JavaScript by setting the value of the css-variable:

.. code-block:: html

    <input type="checkbox" style="--checkbox-skin-color: #380;">

.. image:: /user/img/storefront/how_to_customize_checkbox/checkbox_skin_color.png
