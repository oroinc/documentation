@TitleTemplate
==============


This annotation is used to configure the template that is used to render the page title when the
controller tagged with this annotation is accessed:

.. code-block:: php
    :linenos:

    // ...
    use Oro\Bundle\NavigationBundle\Annotation\TitleTemplate;

    /**
     * @TitleTemplate("The page title")
     */
    public function demoAction()
    {
        // ...
    }

You can use arbitrary placeholders here which you then have to replace later on in your template
using the ``oro_title_set()`` Twig function:

.. code-block:: html+jinja
    :linenos:

    {% oro_title_set({params : {"%username%": fullname }}) %}
