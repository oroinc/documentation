Templates (Twig)
================

OroPlatform-based application uses the Twig templating engine to render the content.

See the detailed documentation in:
    - |Creating and Using Templates article in a Symfony Documentation|
    - |Twig official documentation|

.. seealso::

   :ref:`Front-rendered Underscore.js Templates <frontend-architecture-js-templates>`

Find Twig Templates
-------------------

To find the Twig template file and Twig block that is used for rendering
specific block of a content, you can use |Twig Inspector|. The inspector enables
you to navigate instantly from a Browser to the Twig template that opens automatically in a PhpStorm.


Override Twig Templates
-----------------------

You can override one of the platform templates by adding a template
to the same path under ``src/Resources/``.
For example, to override the ``Grid/widget/widget.html.twig`` template
from the DataGridBundle, create a new template file located at
``src/Resources/OroDataGridBundle/views/Grid/widget/widget.html.twig``.

.. note::
   Keep in mind that templates that are referenced by twig namespaces with ``@``
   (ex. ``@Twig/Exception/exception.html.twig``) can be overridden in both
   ``src/Resources/`` and ``templates/bundles``. As most of the templates are still
   referenced by deprecated Symfony notation (ex. ``TwigBundle:Exception:exception.html.twig``), they
   can be overridden only in ``src/Resources``. To be on the safe side, it is recommended
   to override everything only in ``src/Resources``.

.. include:: /include/include-links.rst
   :start-after: begin