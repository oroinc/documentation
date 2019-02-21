.. index::
    pair: Customization; Themes

Customizing the Application Layout
==================================

You can customize the OroPlatform layout in different ways:

* :ref:`A simple solution is to load your own SCSS files. <book-layout-css-files>`
* :ref:`You can also provide entire themes to change the look and feel <book-layout-themes>`

.. _book-layout-css-files:

Custom SCSS Files
----------------

Creating and Embedding Custom Stylesheets
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Using your own SCSS file is pretty simple. Just save it in the, for example,
``Resources/public/css/`` directory of your bundle and add it to the ``assets.yml``
configuration file:

.. code-block:: yaml
    :linenos:

    # src/Acme/NewBundle/Resources/config/oro/assets.yml
    css:
        inputs:
            - 'bundles/acmenew/css/styles.scss'

Now, you need to clear the cache and install the new stylesheets by running the ``assets:install``
command:

.. code-block:: bash

    $ php bin/console cache:clear
    $ php bin/console assets:install --symlink
    $ php bin/console oro:assets:build

In this example, all four SCSS files from your bundle as well as all the other files from the Oro Platform
and from third-party bundles will be merged and dumped in the ``public/css/oro.css`` file.

If you want to keep your CSS code separately, you can dump all your SCSS files to another compiled file.
To do that, you have to use different assets group in your ``assets.yml``

.. code-block:: yaml
    :linenos:

    # src/Acme/NewBundle/Resources/config/oro/assets.yml
    acme_styles:
        inputs:
          - 'bundles/acmenew/css/styles.scss'
    	  - 'bundles/acmenew/css/another-styles.scss'
        output: 'css/acme.css'

Use the corresponding placeholder to put compiled CSS file to the head of your document

.. code-block:: yaml
    :linenos:

    # src/Acme/Bundle/NewBundle/Resources/config/oro/placeholders.yml
    placeholders:
        placeholders:
            head_style:
                items:
                    acme_css:
                        order: 150

        items:
            acme_css:
                template: AcmeNewBundle::acme_css.html.twig

and finally, add the template for rendering style tag

.. code-block:: html+jinja
    :linenos:

    # src/Acme/Bundle/NewBundle/Resources/views/acme_css.html.twig
    <link rel="stylesheet" media="all" href="{{ asset('css/acme.css') }}" />

.. warning::
    You can also put your code in CSS files which will be compiled together with SCSS files.
But keep in mind that the CSS loader is deprecated by ``node-sass`` npm module, and it will stop working after the module update.


Development tips
~~~~~~~~~~~~~~~~
 
The application uses a Webpack tool for assets building. It supports a quite useful feature of mapping
compiled CSS to CSS sources. So in browser's web inspector (e.g., Google Chrome), you can see
which SCSS code styling an element directly.

The assets building takes some time. So better build only the theme that is mostly required. To speed up the process, simply add a
theme name after the build command.

.. code-block:: bash

    $ php bin/console oro:assets:build admin.oro

Also, you can use the watch mode to rebuild assets automatically after some CSS (SCSS) file is changed.
Just add the ``--watch`` (or ``-w``) option to the build command.

.. code-block:: bash

    $ php bin/console oro:assets:build --watch

Refer to `Asset Commands`_ for more information.

Application Themes
------------------

A theme is a set of CSS and/or SCSS files that customize the look and feel of OroPlatform. The theme has the following properties:

==============  ========  ===========================================================
Property        Required  Description
==============  ========  ===========================================================
``name``        yes       A unique name
``label``       no        A string that is displayed in the theme management UI.
``styles``      yes       The list of CSS and SCSS files that define the theme.
``icon``        no        The theme's favicon.
``logo``        no        A logo that is shown in the theme management UI.
``screenshot``  no        A screenshot of the theme to be shown in the management UI.
==============  ========  ===========================================================

You can create themes in two different ways:

* :ref:`Add application-specific themes. <book-themes-application-themes>`
* :ref:`Create a reusable theme. <book-themes-reusable-themes>`

Alternatively, you can :ref:`customize an existing theme <book-themes-overriding>` instead of
creating a new one from scratch.

.. _book-themes-application-themes:

Application-specific Themes
~~~~~~~~~~~~~~~~~~~~~~~~~~~

Customizing the layout of your Platform application is as easy as defining your custom theme in
your application's configuration using the ``oro_theme`` option:

.. code-block:: yaml
    :linenos:

    # config/config.yml
    oro_theme:
        themes:
            mytheme:
                styles:
                    - mytheme/css/main.css
                    - mytheme/css/ie.css
                label: My Theme
                icon: mytheme/images/favicon.ico
                logo: mytheme/images/logo.png
                screenshot: /mytheme/images/screenshot.png
        active_theme: mytheme

First, you create a theme named ``mytheme`` with the *My Theme* label that uses two CSS files ``main.css`` and ``ie.css``. Secondly, select the theme to be used by setting its name as the value of the ``active_theme`` option.

.. _book-themes-reusable-themes:

Reusable Themes
~~~~~~~~~~~~~~~

In addition to customizing your own application, you can also provide a theme that can be reused in different applications. To achieve this, simply specify the theme's options in the ``settings.yml`` file that is located in the ``Resources/public/themes/<theme-name>``
directory of your bundle:

.. code-block:: yaml
    :linenos:

    # src/Acme/DemoBundle/Resources/public/themes/acme-theme/settings.yml
    styles:
        - bundles/acmebundle/themes/acme-theme/css/main.css
        - bundles/acmebundle/themes/acme-theme/css/ie.css
    label: Acme Demo Theme
    icon: bundles/acmebundle/themes/acme-theme/images/favicon.ico
    logo: bundles/acmebundle/themes/acme-theme/images/logo.png
    screenshot: bundles/acmebundle/themes/acme-theme/images/screenshot.png

To use the theme in any application, enable it in the application configuration:

.. code-block:: yaml
    :linenos:

    # config/config.yml
    oro_theme:
        active_theme: acme-theme

.. tip::

    You can use the ``oro:theme:list`` command to get a list of all available themes. Its output looks like this:

    .. code-block:: text
        :linenos:

        List of available themes:
        acme-theme (active)
         - label: Acme Demo Theme
         - logo: bundles/acmebundle/themes/acme-theme/images/logo.png
         - icon: bundles/acmebundle/themes/acme-theme/images/favicon.ico
         - screenshot: bundles/acmebundle/themes/acme-theme/images/screenshot.png
         - styles:
             - bundles/acmebundle/themes/acme-theme/css/main.css
             - bundles/acmebundle/themes/acme-theme/css/ie.css
        demo:
         - label: Demo Theme
         - logo: bundles/oroui/themes/demo/images/favicon.ico
         - styles:
             - bundles/oroui/themes/demo/css/scss/main.scss
             - bundles/oroui/themes/demo/css/style.css
        mytheme
         - label: My Theme
         - logo: mytheme/images/logo.png
         - icon: mytheme/images/favicon.ico
         - screenshot: mytheme/images/screenshot.png
         - styles:
             - mytheme/css/main.css
             - mytheme/css/ie.css
        oro
         - label: Oro Theme
         - icon: bundles/oroui/themes/oro/images/favicon.ico
         - styles: bundles/oroui/themes/oro/css/style.css

Finally, clear the cache and dump all assets:

.. code-block:: bash

    $ php bin/console cache:clear
    $ php bin/console assets:install --symlink
    $ php bin/console oro:assets:build

.. _book-themes-overriding:

Overriding a Theme
~~~~~~~~~~~~~~~~~~

The configuration files of all available themes are merged when the service container is being
compiled. Since the merge process does override values if they are defined in more than one file,
you can make use of it when you need to customize an existing theme.

For example, imagine that you want to use the *Oro* theme from the OroUIBundle, but you want to use
a custom label and favicon for it. The definition of the *Oro* theme as defined in the bundle looks
like this:

.. code-block:: yaml
    :linenos:

    label: Oro Theme
    icon: bundles/oroui/themes/oro/images/favicon.ico
    styles:
        - bundles/oroui/themes/oro/css/style.css

So, place the ``settings.yml`` file in the ``Resources/public/themes/oro`` directory of your bundle and define the values you want to change:

.. code-block:: yaml
    :linenos:

    # src/Acme/DemoBundle/Resources/public/oro/
    label: Custom Oro Theme
    icon: images/custom_favicon.ico

.. caution::

    If you override themes from third-party bundles, you have to make sure that your bundle is
    registered after the bundle it is overriding themes from:

    .. code-block:: php
        :linenos:

        // src/AppKernel.php
        // ...

        class AppKernel extends OroKernel
        {
            public function registerBundles()
            {
                $bundles = array(
                    // ...
                    new ThirdParty\Bundle\ThirdPartyBundle(),
                    // ...
                    new Acme\DemoBundle\AcmeDemoBundle(),
                    // ...
                );

                // ...
            }

            // ...
        }

.. _`Asset Commands`: https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/AssetBundle/Resources/doc/index.md#commands
