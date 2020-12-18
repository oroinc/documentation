Styles Assets Organization
==========================

Files structure with styles should be the following:

.. code-block:: none
   :linenos:

    MyBundle/
        Resources/
            public/
                my-theme/
                    scss/
                        components/
                            input/input.scss
                            button/button.scss
                        settings/
                            global-settings.scss
                        variables/
                            input-config/input-config.scss
                            button-config/button-config.scss
                        styles.scss

All styles should be placed in ``components`` folder with the same file name as a block name. For example: ``components/input/input.scss``:

.. code-block:: bash
   :linenos:

   .input {
       display: inline-block;
       padding: $input-padding;
       font-size: $font-size;
       font-family: $input-font-family;
       line-height: $input-line-height;
       border: $border;
       color: $input-color;
   }

Another example: ``components/button/button.scss``:

.. code-block:: bash
   :linenos:

   .button {
       display: inline-block;
       padding: $button-padding;
       font-size: $font-size;
       font-family: $button-font-family;
       line-height: $button-line-height;
       border: $border;
       color: $button-color;
   }

Global settings should contain global variables for blocks. For example: ``global-settings.scss``:

.. code-block:: css
   :linenos:

   $font-size: 12px;
   $font-family: 'Thamoma';
   $line-height: 1.1;

All block variables should be placed in ``variables`` folder. Files should contain configs for blocks that can be reconfigured in ``my-custom-theme``.
For example, ``input-config.scss``:

.. code-block:: css
   :linenos:

   $input-padding: 8px 9px !default;
   $input-font-size: $font-size !default;
   $input-font-family: $font-family !default;
   $input-line-height: $line-height !default;
   $input-color: blue !default;

Another example: ``button-config.scss``:

.. code-block:: css
   :linenos:

   $button-padding: 18px 9px !default;
   $button-font-size: $font-size !default;
   $button-font-family: $font-family !default;
   $button-line-height: $line-height !default;
   $button-color: yellow !default;

To add blocks to resulting ``styles.css`` file, include them into ``styles.scss``:

.. code-block:: bash
   :linenos:

   @import: './components/input/input';
   @import: './components/button/button';

To include configs in the resulting ``styles.css`` file, add them  to the ``assets.yml`` file located in ``MyBundle/Resources/views/layouts/my-theme/config/``:

.. code-block:: css
   :linenos:

   styles:
       inputs:
           - 'bundles/mybundle/my-theme/scss/settings/global-settings.scss'
           - 'bundles/mybundle/my-theme/scss/variables/button-config.scss'
           - 'bundles/mybundle/my-theme/scss/variables/input-config.scss'
           - 'bundles/mybundle/my-theme/scss/styles.scss'
       output: 'css/layout/my-theme/styles.css'

The resulting ``styles.css`` file is the following:

.. code-block:: css
   :linenos:

   .input {
       display: inline-block;
       padding: 8px 9px;
       font-size: 12px;
       font-family: 'Thamoma';
       line-height: 1.1;
       color: blue;
   }
   .button {
       display: inline-block;
       padding: 18px 9px;
       font-size: 12px;
       font-family: 'Thamoma';
       line-height: 1.1;
       color: yellow;
   }

Theme Customization by Theme Extending
--------------------------------------

In custom themes you can change globals and settings for a particular component by changing the value of the variable under the same name. You can also make your own configs for new or existing components in the extended theme.

We use styles from ``my-theme`` and configs from ``my-custom-theme``. For example: ``components/input/input.scss``:

.. code-block:: bash
   :linenos:

      .button {
          border: $input-border;

          &--full {
              width:  100%;
          }
      }

Another example: ``global-settings.scss``

.. code-block:: css
   :linenos:

   $font-size: 14px;
   $font-family: 'Arial';

Another example: ``input-config.scss``:

.. code-block:: css
   :linenos:

   $input-border: 1px solid red;
   $input-color: purple;


``Assets.yml`` for ``my-custom-theme`` should be the following:

.. code-block:: css
   :linenos:

   styles:
       inputs:
           - 'bundles/mybundle/my-custom-theme/scss/settings/global-settings.scss'
           - 'bundles/mybundle/my-custom-theme/scss/variables/input-config.scss'
           - 'bundles/mybundle/my-custom-theme/scss/styles.scss'
       output: 'css/layout/my-theme/styles.css'

The resulting ``styles.css`` file are the following:

.. code-block:: css
   :linenos:

   .input {
       display: inline-block;
       padding: 8px 9px;
       font-size: 14px;
       font-family: 'Arial';
       line-height: 1.1;
       color: purple;
       border: 1px solid red;
   }
   .button {
       display: inline-block;
       padding: 18px 9px;
       font-size: 14px;
       font-family: 'Arial';
       line-height: 1.1;
       color: yellow;
   }
   .button--full {
       width: 100%
   }

Before dumps, all files are collected into one for each theme. For ``my-theme`` - in file ``application/commerce/public/layout-build/my-theme/styles.css.scss``:

.. code-block:: css
   :linenos:

   @import 'my-theme/settings/global-settings';
   @import 'my-theme/variables/input-config';
   @import 'my-theme/variables/button-config';
   @import 'my-theme/styles';

For ``my-custom-theme`` - in file ``application/commerce/public/layout-build/my-custom-theme/styles.css.scss``:

.. code-block:: css
   :linenos:

   @import 'my-theme/settings/global-settings';
   @import 'my-custom-theme/settings/global-settings';
   @import 'my-theme/variables/input-config';
   @import 'my-theme/variables/button-config';
   @import 'my-custom-theme/variables/input-config';
   @import 'my-custom-theme/variables/button-config';
   @import 'my-theme/styles';
   @import 'my-custom-theme/styles';

