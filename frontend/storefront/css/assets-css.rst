.. _dev-doc-frontend-css-frontend-styles-assets:


Styles Assets Organization
==========================

Out-of-the-box, each theme contains three independent ``CSS``` files with the same structure:

* ``critical.css`` – minimal CSS needed for fast content rendering.
* ``styles.css`` – the main CSS for the entire theme.
* ``styles-print.css`` – CSS specific to the print version.
* ``stylebook.css`` – CSS specific to the Style Book pages.

Files structure with styles should be the following:

.. code-block:: none

    MyBundle/
        Resources/
            public/
                my-theme/
                    scss/
                        components/
                            input.scss
                            button.scss
                        settings/
                            global-settings.scss
                        variables/
                            input-config.scss
                            button-config.scss
                        styles.scss

All styles should be placed in ``components`` folder with the same file name as a block name. For example: ``components/input.scss``:

.. code-block:: none

   .input {
       display: inline-block;
       padding: $input-padding;
       font-size: $font-size;
       font-family: $input-font-family;
       line-height: $input-line-height;
       border: $input-border;
       color: $input-color;
   }

Another example: ``components/button.scss``:

.. code-block:: none

   .button {
       padding: $button-padding;
       font-size: $font-size;
       font-family: $button-font-family;
       line-height: $button-line-height;
       border: $border;
       color: $button-color;
   }

Global settings should contain global variables for blocks. For example: ``global-settings.scss``:

.. code-block:: css

   $font-size: $base-font-size--xs;
   $font-family: 'Thamoma';
   $line-height: 1.1;

All block variables should be placed in ``variables`` folder. Files should contain configs for blocks that can be reconfigured in ``my-custom-theme``.
For example, ``input-config.scss``:

.. code-block:: css

   $input-padding: spacing('md') spacing('sm') !default;
   $input-font-size: $font-size !default;
   $input-font-family: $font-family !default;
   $input-line-height: $line-height !default;
   $input-color: blue !default;

Another example: ``button-config.scss``:

.. code-block:: css

   $button-padding: spacing('base') spacing('base') !default;
   $button-font-size: $font-size !default;
   $button-font-family: $font-family !default;
   $button-line-height: $line-height !default;
   $button-color: yellow !default;

To include configs in the resulting ``styles.css`` file, add them  to the ``assets.yml`` file located in ``MyBundle/Resources/views/layouts/my-theme/config/``:

.. code-block:: yaml

   css:
       inputs:
           - 'bundles/mybundle/my-theme/scss/settings/global-settings.scss'
           - 'bundles/mybundle/my-theme/scss/variables/button-config.scss'
           - 'bundles/mybundle/my-theme/scss/variables/input-config.scss'
           - 'bundles/mybundle/my-theme/scss/components/input.scss'
           - 'bundles/mybundle/my-theme/scss/components/button.scss'
       output: 'css/styles.css'

The resulting ``styles.css`` file is the following:

.. code-block:: none

   .input {
       padding: spacing('md') spacing('sm');
       font-size: $base-font-size--xs;
       font-family: 'Thamoma';
       line-height: 1.1;
       color: blue;
   }
   .button {
       padding: spacing('base');
       font-size: $base-font-size--xs;
       font-family: 'Thamoma';
       line-height: 1.1;
       color: yellow;
   }

Theme Customization by Theme Extending
--------------------------------------

In custom themes you can change globals and settings for a particular component by changing the value of the variable under the same name. You can also make your own configs for new or existing components in the extended theme.

We use styles from ``my-theme`` and configs from ``my-custom-theme``. For example: ``components/button.scss``:

.. code-block:: none

    .button {
        border: $input-border;

        &--full {
            width:  100%;
        }
    }

Another example: ``global-settings.scss``

.. code-block:: css

   $font-size: 14px;
   $font-family: 'Arial';

Another example: ``input-config.scss``:

.. code-block:: css

   $input-border: 1px solid get-var-color('destructive', 'main');
   $input-color: purple;

One more example: ``button-config.scss``:

.. code-block:: css

   $button-color: yellow !default;

``assets.yml`` for ``my-custom-theme`` should be the following:

.. code-block:: css

   css:
       inputs:
           - 'bundles/mybundle/my-custom-theme/scss/settings/global-settings.scss'
           - 'bundles/mybundle/my-custom-theme/scss/variables/input-config.scss'
           - 'bundles/mybundle/my-custom-them/scss/variables/button-config.scss'
           - 'bundles/mybundle/my-custom-them/scss/components/button.scss'

       output: 'css/styles.css'

The resulting ``styles.css`` file are the following:

.. code-block:: css

   .input {
       color: purple;
       border: 1px solid #b50400;
       /* The rest of the properties will be inherited from the parent theme if it is defined */
   }
   .button {
       color: yellow;
       /* The rest of the properties will be inherited from the parent theme if it is defined */
   }
   .button--full {
       width: 100%
   }

Before dumps, all files are collected into one for each theme. For ``my-theme`` - in file ``application/commerce/public/build/my-theme/styles.css.scss``:

.. code-block:: css

   @import 'my-theme/settings/global-settings';
   @import 'my-theme/variables/input-config';
   @import 'my-theme/variables/button-config';
   @import 'my-theme/styles';

For ``my-custom-theme`` - in file ``application/commerce/public/build/my-custom-theme/styles.css.scss``:

.. code-block:: css

   @import 'my-theme/settings/global-settings';
   @import 'my-custom-theme/settings/global-settings';
   @import 'my-theme/variables/input-config';
   @import 'my-theme/variables/button-config';
   @import 'my-custom-theme/variables/input-config';
   @import 'my-custom-theme/variables/button-config';
   @import 'my-theme/styles';
   @import 'my-custom-theme/styles';

