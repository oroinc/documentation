.. index::
    single: Configuration

Configuration
=============

With the `OroConfigBundle`_ you can define configuration settings in different
scopes. These settings can be organized and visualized in different configuration
trees.

.. sidebar:: Scopes

    Currently, all configuration setting reside in the ``user`` scope. This
    means that all settings can be configured by the user themself. It is
    planned to add ``bundle`` and ``application`` levels in the future.

Managing Configuration Settings
-------------------------------

To define your own configuration settings in a bundle, you use the ``SettingsBuilder``
in the well-known ``Configuration`` class:

.. code-block:: php
    :linenos:

    // src/Acme/DemoBundle/DependencyInjection/Configuration.php
    namespace Acme\DemoBundle\DependencyInjection;

    use Symfony\Component\Config\Definition\Builder\TreeBuilder;
    use Symfony\Component\Config\Definition\ConfigurationInterface;

    class Configuration implements ConfigurationInterface
    {
        public function getConfigTreeBuilder()
        {
            $treeBuilder = new TreeBuilder();
            $rootNode = $treeBuilder->root('acme_demo');

            // provide your regular Symfony configuration here

            SettingsBuilder::append($root, array(
                'foo' => array(
                    'value' => true,
                    'type' => 'boolean',
                ),
                'bar' => array(
                    'value' => 10,
                ),
            ));

            return $treeBuilder;
        }
    }

The ``SettingsBuilder`` class is a helper class that adds additional nodes
to the configuration tree. It expects the root node of the tree to which the
new nodes are appended. The second argument is an array of configuration settings.
The example above adds two options: ``foo`` and ``bar``. Each option can get
a default value and a type (one of ``scalar``, ``boolean`` or ``array``). The
default type if none is specified is ``scalar``.

.. seealso::

    If you are not familiar with creating ``Configuration`` classes, read
    about `semantic configurations`_ in the official documentation.

.. sidebar:: How the ``SettingsBuilder`` Works

    Internally, the settings builder creates a new tree with ``settings``
    being the root node. For each configuration option passed to the ``append()``
    method, a new node is created and appended to the internal tree.

    Finally, the complete tree is appended to the node that was passed to ``append()``.

Creating Configuration Forms
----------------------------

To allow a user to modify their configuration settings, you have to create
a form that is presented to the user. The form configuration is done in the
``system_configuration.yml`` file of the bundle.

Fields
~~~~~~

For each option, define a field under ``fields`` key:

.. code-block:: yaml
    :linenos:

    # Acme/DemoBundle/Resources/config/system_configuration.yml
    oro_system_configuration:
        fields:
            foo:
                type: checkbox
                options:
                    label: "A label"
                priority: 10
            bar:
                type: text
                priority: 20
                tooltip: "A tooltip"

The only required field is ``type`` which can refer to any valid form type.
Other supported fields are:

================ ==============================================================
Field            Description
================ ==============================================================
``type``         The form type (required)
---------------- --------------------------------------------------------------
``options``      Additional options that are passed to the form type
---------------- --------------------------------------------------------------
``tooltip``      A tooltip containing additional information
---------------- --------------------------------------------------------------
``acl_resource`` ACL resource the user needs to be allowed to change the option
---------------- --------------------------------------------------------------
``priority``     Optional field display order
================ ==============================================================

Accessing Configuration Values
------------------------------

In Controllers
~~~~~~~~~~~~~~

To retrieve configuration values inside a controller, you have to use the
``oro_config.user`` service which is an instance of ``Oro\ConfigBundle\Config\UserConfigManager``.
Use its ``get()`` method to retrieve the value of a setting:

.. code-block:: php
    :linenos:

    // src/Acme/DemoBundle/Controller/DemoController.php
    namespace Acme\DemoBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    class DemoController extends Controller
    {
        public function demoAction()
        {
            $config = $this->get('oro_config.user');
            $foo = $config->get('acme_demo.foo');

            // ...
        }
    }

.. note::

    The actual setting name is to be prefixed by the `bundle alias`_ (here
    ``acme_demo`` for AcmeDemoBundle).

In Templates
~~~~~~~~~~~~

In a Twig template, use the ``oro_config_value()`` helper to retrieve the
value of a configuration option:

.. code-block:: html+jinja
    :linenos:

    {# setting becomes the value the user configured or true if they didn't #}
    {% set setting = oro_config_value('acme_demo.foo') %}

.. note::

    The actual setting name is to be prefixed by the `bundle alias`_ (here
    ``acme_demo`` for AcmeDemoBundle).

.. _`OroConfigBundle`: https://github.com/orocrm/platform/tree/master/src/Oro/Bundle/ConfigBundle
.. _`semantic configurations`: http://symfony.com/doc/current/cookbook/bundles/extension.html
.. _`bundle alias`: http://symfony.com/doc/current/cookbook/bundles/best_practices.html#bundle-name
