.. _bundle-docs-platform-embedded-form-bundle:

OroEmbeddedFormBundle
=====================

|OroEmbeddedFormBundle| enables the application users to create integrated forms using UI, embed them into third-party sites with inline or iframe codes, and collect the submitted information in the Oro application database.

This bundle has the following configuration options:

.. code-block:: yaml

    oro_embedded_form:
        # The name of the hidden field that should be used to pass the session id to third party site.
        # This allows to use the embedded form even if a web browser blocks third-party cookies.
        session_id_field_name: _embedded_form_sid
        # The number of seconds the CSRF token should live for.
        csrf_token_lifetime: 3600
        # The service id that is used to cache CSRF tokens.
        # If not specified the oro_embedded_form.csrf_token_cache service
        # will be used that stores data in %kernel.cache_dir%/security/embedded_form
        csrf_token_cache_service_id: ~

A custom CSRF token cache is used only if a web browser blocks third-party cookies. For other cases, the default Symfony behavior is used (CSRF tokens are stored in the PHP session).

UI
--

The menu item that leads to the list of embedded forms is under the `System` menu. Standard UI components like grids, filters, sorters, forms are used to list, view, and update pages. The view page is combined with the *Form Preview* and *Get code* sections.

Adding a New FormType
---------------------

FormTypes used in embedded forms are registered as services and tagged with the `oro_embedded_form` tag.

**Example:**

.. code-block:: yaml

    services:
        Acme\Bundle\DemoBundle\Form\Type\SomeFormType:
            tags:
                - { name: oro_embedded_form, label: 'Embedded Form Type Label Here', type: Acme\Bundle\DemoBundle\Form\Type\SomeFormType }

The `label` option is a translatable text used in the select box when creating/updating an embedded form. If omitted, the service ID will be used instead.

The other possible option is `type`. If it is defined, it will be used as the form type (instead of the actual service defined by the `class` parameter).
These kinds of form types appear in the drop-down list on the create and update embedded form pages.

Default FormType CSS and Success Message
----------------------------------------

By default, the CSS and Success Message fields on the create new embedded form page are empty.
To add default styles or a default success message, a FormType must implement ``Oro\Bundle\EmbeddedFormBundle\Form\Type\EmbeddedFormInterface``.

Change FormType
---------------

It is possible to change the embedded form FormType on/after creation.
The related default styles and the default success message will be pulled. If the current CSS and success message are changed, a confirmation dialog will appear.

Success Message
---------------

This message will appear after a successful form submitting.
You can customize the success message on the create and update embedded form pages.
It is possible to set your text for the back link by adding it in the `{back_link}` placeholder using the following syntax ``{back_link|Back link text}``.

Get Code
--------

The *Get code* section is located on the view embedded form page. Example:

.. code-block:: html

    <div id="embedded-form-container-2b975a6c-844f-11e3-a31b-001fe24ecc11"></div>
    <script src="{{ app.request.getSchemeAndHttpHost() ~ asset('bundles/oroembeddedform/js/embed.form.js') }}"></script>
    <script>
        new ORO.EmbedForm({
            container: 'embedded-form-container-2b975a6c-844f-11e3-a31b-001fe24ecc11',
            iframe: {
                src: "http://example.com/embedded-form/submit/2b975a6c-844f-11e3-a31b-001fe24ecc11",
                width: 640,
                height: 800,
                frameBorder: 0
            }
        });
    </script>

The `iframe` object properties will be directly mapped onto creating iframe element properties, so it is possible to change the iframe sizes or add/remove the frame border.

Custom Form Layout
------------------

The layout engine from  OroLayoutBundle should be used to customize the form layout.
Embedded forms use the `embedded_form` layout theme, and layout update files should be placed in the ``src\Resources\OroEmbeddedFormBundle\layouts\embedded_default`` directory.

Layout update files can be placed in a subdirectory corresponding to a route name (e.g. `oro_embedded_form_submit`, `oro_embedded_form_success`) if it needs to be applied to a specific action only.
Please, refer to the :ref:`LayoutBundle <bundle-docs-platform-layout-bundle>` documentation for more information.

Let's consider an example when we need to move the email field before the first name field on the embedded form:

**Example**

.. code-block:: yaml

    layout:
        actions:
            - '@move':
                id:        embedded_form_email
                siblingId: embedded_form_firstName
                prepend:   true                     # place moved block before sibling

        conditions: 'context["embedded_form_type"]=="Acme\\Bundle\\DemoBundle\\Form\\Type\\SomeFormType"'

We need to specify layout update conditions since all embedded forms use the same route.
The condition should check that your custom form type is equal to the form type stored in the layout context, ensuring that your layout updates are loaded only for your embedded form type.

Note that we are using separate block types `embed_form_start`, `embed_form_end`, `embed_form_fields` and `embed_form_field` to render the form. This allows us to add content inside the form easily.

We need to specify the `form_name` option for all these block fields to bind it to our form. We can also use only one block type `embed_form` which will create three child blocks: `embed_form_start`, `embed_form_fields`, `embed_form_end`.

.. include:: /include/include-links-dev.rst
   :start-after: begin
