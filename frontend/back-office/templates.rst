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
to the same path under ``templates/bundles``.
For example, to override the ``Grid/widget/widget.html.twig`` template
from the DataGridBundle, create a new template file located at
``templates/bundles/OroDataGridBundle/Grid/widget/widget.html.twig``.

.. include:: /include/include-links-dev.rst
   :start-after: begin
