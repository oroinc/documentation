.. _dev-guide-layouts:

Layouts
=======

OroPlatform incorporates `Oro Layout component`_ and `OroLayoutBundle`_ to enable the layouts system  in derivative applications for building the front public appearance.

Unlike traditional Symfony templating, the layout system has a number of advantages for building the front UI. These include the ability to make themeable UI and allow unlimited changes and extensions of the vendor themes by third-party additions.

.. contents:: Table of Contents
    :local:
    :depth: 2
    :backlinks: entry

How It Works
------------

:ref:`A layout <dev-guide-layouts-layout>` is a structure of the website page which consists of a block of two types: containers and final blocks.

**Containers** are blocks that can contains other blocks. 

**Final blocks** can contain only HTML content but not other layout blocks.

The layout is defined and built in special configuration files called :ref:`Layout Updates <dev-guide-layouts-layout-updates>`.

The Layout Update files provide instructions on what exactly blocks are contained on a particular page (based on the route) and how these blocks are structured on the page.

Besides the blocks and their structure, the layout update files define what :ref:`data <dev-guide-layouts-layout-data>` fills the certain block and what conditions must met to show a particular block on the page.

The layout update files are grouped into :ref:`themes <dev-guide-layouts-theming>`. Oro applications can have an unlimited number of  installed themes, but only one front theme can be active at the same time. 

For detailed information on specific aspects of the layouts system, please check out the following articles:

.. toctree::
    :titlesonly:
    :maxdepth: 1

    what_is_layout
    layout_updates
    layout_data
    theming
    debugging

.. _dev-guide-layouts-getting-started:

Getting Started
---------------

We are going to use the layouts system to create a frontend test page. The steps that we have to perform are the following:

.. contents::
    :local:
    :depth: 1
    :backlinks: entry

Create a Layout Theme
^^^^^^^^^^^^^^^^^^^^^

The theme definition should be placed in theme folder and named
`theme.yml`, e.g. `DemoBundle/Resources/views/layouts/first_theme/theme.yml`

.. code-block:: yaml
    :linenos:

    #DemoBundle/Resources/views/layouts/first_theme/theme.yml
    label:  Test Theme
    icon:   bundles/demo/images/favicon.ico
    groups: [ main ]

For more details on theme definition, please see the :ref:`theme definition <dev-guide-layouts-theming-definition>` topic.

Use Layout Theme Configuration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Configuration files, such as **assets**, **images** or **requirejs**,
should be placed in the `Resources/views/layouts/{theme_name}/config` folder.

For more details on theme configuration, please see the :ref:`config definition <dev-guide-layouts-theming-configuration>`.

Set Default Theme
^^^^^^^^^^^^^^^^^

To set a default layout theme for your application, add the following
configuration to the `config/config.yml` file:

.. code-block:: yaml
    :linenos:

    oro_layout:
        active_theme: first_theme

Create Layout Update Files
^^^^^^^^^^^^^^^^^^^^^^^^^^

To build a frame of your layout theme, create a layout update file and
place it in the `Resources/views/layouts` directory, e.g.
`Resources/views/layouts/first_theme/default.yml`:

.. code-block:: yaml
    :linenos:

    layout:
        actions:
            - '@setBlockTheme':
                themes: 'DemoBundle:layouts:first_theme/default.html.twig'
            - '@addTree':
                items:
                    head:
                        blockType: head
                    theme_icon:
                        blockType: external_resource
                        options:
                            href: '=data["theme"].getIcon("first_theme")'
                            rel: shortcut icon
                    head_style:
                        blockType: container
                    head_script:
                        blockType: container
                    body:
                        blockType: body
                    header:
                        blockType: container
                    navigation_bar:
                        blockType: container
                    main_menu:
                        blockType: container
                        options:
                            attr:
                                id: main-menu
                    left_panel:
                        blockType: container
                        options:
                            attr:
                                id: left-panel
                    main_panel:
                        blockType: container
                        options:
                            attr:
                                id: main-panel
                                class: content
                    content:
                        blockType: container
                    footer:
                        blockType: container
                tree:
                    root:
                        head:
                            theme_icon: ~
                            head_style: ~
                            head_script: ~
                        body:
                            header:
                                navigation_bar: ~
                                main_menu: ~
                            left_panel: ~
                            main_panel:
                                content: ~
                            footer: ~

For more information on layout update files, please see the :ref:`layout update <dev-guide-layouts-layout-updates>` topic.

Customize Rendering of Your Theme
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

In the previous section, we added the `setBlockTheme` action. The
block theme is responsible for defining the way layout blocks are
rendered.

As an example, we are going to create a simple block theme and place it
into `Resources/views/layouts/first_theme/default.html.twig`:

.. code-block:: twig
    :linenos:

    {% block head_widget %}
        <head{{ block('block_attributes') }}>
            <meta http-equiv="cache-control" content="max-age=0" />
            <meta http-equiv="cache-control" content="no-cache" />
            <meta http-equiv="expires" content="0" />
            <meta http-equiv="pragma" content="no-cache" />
            {{ block_widget(block) }}
        </head>
    {% endblock %}

    {% block _header_widget %}
        <header{{ block('block_attributes') }}>
            {{ block_widget(block) }}
        </header>
    {% endblock %}

    {% block _main_menu_widget %}
        <div{{ block('block_attributes') }}>
            {{ block_widget(block) }}
        </div>
    {% endblock %}

    {% block _left_panel_widget %}
        <div{{ block('block_attributes') }}>
            {{ block_widget(block) }}
        </div>
    {% endblock %}

    {% block _footer_widget %}
        <footer{{ block('block_attributes') }}>
            {{ block_widget(block) }}
        </footer>
    {% endblock %}

    {% block _main_panel_widget %}
        <div{{ block('block_attributes') }}>
            {{ block_widget(block) }}
        </div>
    {% endblock %}

The rendering of the layouts is very similar to Symfony Forms, but the
`block_` prefix is used instead of the `form_` prefix. You can find
more information on customizing form rendering in Symfony
documentation on `How to Customize Form Rendering <http://symfony.com/doc/current/cookbook/form/form_customization.html>`_.

Create a Controller
^^^^^^^^^^^^^^^^^^^

Once the layout is ready, we are going to test is. For this, we need to create a test controller:

.. code-block:: php
    :linenos:

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Oro\Bundle\LayoutBundle\Annotation\Layout;

    class UserController extends Controller
    {
        /**
         * @Route("/test", name="demo_layout_test")
         * @Layout
         */
        public function testAction()
        {
            return [];
        }
    }

The following HTML output is produced:

.. code-block:: html
    :linenos:

    <!DOCTYPE html>
    <html>
        <head>
            <title></title>
            <meta http-equiv="cache-control" content="max-age=0" />
            <meta http-equiv="cache-control" content="no-cache" />
            <meta http-equiv="expires" content="0" />
            <meta http-equiv="pragma" content="no-cache" />
            <link rel="shortcut icon" href="bundles/demo/images/favicon.ico"/>
        </head>
        <body>
            <header>
                <div id="main-menu">
                </div>
            </header>
            <div id="left-panel">
            </div>
            <div id="main-panel" class="content">
            </div>
            <footer>
            </footer>
        </body>
    </html>

We now making three simple changes to the layout of this page:

-  Setting the title
-  Adding some text in the content area
-  Adding additional CSS class to the main panel

To do this, we need to create the layout update file and place it in the
`Resources/views/layouts/first_theme/demo_layout_test` directory, for
example
`DemoBundle/Resources/views/layouts/first_theme/demo_layout_test/test.yml`:

.. code-block:: yaml
    :linenos:

    layout:
        actions:
            - '@setOption':
                id: head
                optionName: title
                optionValue: Hello World!
            - '@add':
                id: test_text
                parentId: page_content
                blockType: text
                options:
                    text: Layouts. Hello World!
            - '@appendOption':
                id: main_panel
                optionName: attr.class
                optionValue: test-css-class

As the file is placed in the :ref:`route specific folder <dev-guide-layouts-theming-route-dependent>`, the update will
apply only to the page related to the `demo_layout_test` route.

When you open the test page in a browser, the following HTML output is
produced:

.. code-block:: html
    :linenos:

    <!DOCTYPE html>
    <html>
        <head>
            <title>Hello World!</title>
            <meta http-equiv="cache-control" content="max-age=0" />
            <meta http-equiv="cache-control" content="no-cache" />
            <meta http-equiv="expires" content="0" />
            <meta http-equiv="pragma" content="no-cache" />
            <link rel="shortcut icon" href="bundles/demo/images/favicon.ico"/>
        </head>
        <body>
            <header>
                <div id="main-menu">
                </div>
            </header>
            <div id="left-panel">
            </div>
            <div id="main-panel" class="content test-css-class">
                Layouts. Hello World!
            </div>
            <footer>
            </footer>
        </body>
    </html>

Related Cookbook Articles
-------------------------

* :ref:`Advanced Layout Implementation Example <dev-cookbook-layouts-implementation-example>`
* :ref:`Returning Custom Status Code <dev-cookbook-layouts-returning-custom-status-code>`

.. _`Oro Layout component`: https://github.com/oroinc/platform/tree/master/src/Oro/Component/Layout
.. _`OroLayoutBundle`: https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/LayoutBundle

