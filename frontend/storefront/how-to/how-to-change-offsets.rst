.. _dev-doc-frontend-storefront-css-offsets:



How to Change Offsets in Storefront
===================================

The offsets are based on predefined multipliers with a base offset of ``16px``.
To get the offset you need, use the ``spacing($size);`` function.
The default offsets for each multiplier are the following:

+--------------------------------+
| Operation             | Result |
+================================+
| `spacing('base')`     | 16px   |
+--------------------------------+
| `spacing('xs')`       | 4px    |
+--------------------------------+
| `spacing('sm')`       | 8px    |
+--------------------------------+
| `spacing('xmd')`      | 10px   |
+--------------------------------+
| `spacing('lg')`       | 24px   |
+--------------------------------+
| `spacing('xl')`       | 32px   |
+--------------------------------+
| `spacing('xxl')`      | 40px   |
+--------------------------------+
| `spacing('xxxl')`     | 48px   |
+--------------------------------+
| `spacing('huge')`     | 56px   |
+--------------------------------+
| `spacing('massive')`  | 64px   |
+--------------------------------+
| `spacing('gigantic')` | 80px   |
+--------------------------------+
| `spacing('enormous')` | 88px   |
+--------------------------------+
| `spacing('colossal')` | 96px   |
+--------------------------------+
| `spacing('immense')`  | 120px  |
+--------------------------------+

To change all offsets, simply assign any value you want to the ``$base-spacing`` variable.

.. code-block:: scss

     $base-spacing: 12px !default

To update or add a specific multiplier, merge ``$spacing-multipliers`` with your ``$custom-spacing-multipliers``.

.. code-block:: scss

    @use 'sass:map';

    $custom-spacing-multipliers: (
        xs: .1,  // update an existing rule
        vast: 3, // add a new value
    );

    $spacing-multipliers: map.merge($spacing-multipliers, $custom-spacing-multipliers);

.. note:: You have to insert this code into your own **styles.scss** file as described in
    the :ref:`CSS Files Structure <dev-doc-frontend-css-theme-structure>` article.
