.. _bundle-docs-platform-ui-bundle-client-side-navigation:

Client Side Navigation
======================

**Client Side Navigation** enables pages to be loaded in different formats (HTML or JSON) depending on the request.
The first request from the browser loads the complete HTML page, while all subsequent requests are handled by JavaScript and load page blocks in JSON format.

To prepare a page for client-side navigation, follow these steps:

- Add an additional check in the main layout template:

.. code-block:: none

    {% if not oro_is_hash_navigation() %}
    <!DOCTYPE html>
    <html>
    ...
    [content]
    ...
    </html>
    {% else %}
    {# Template for hash navigation #}
    {% include '@OroNavigation/HashNav/hashNavAjax.html.twig'
        with {'script': block('head_script'), 'messages': block('messages'), 'content': block('page_container')}
    %}
    {% endif %}

Where:

* ``block('head_script')`` – contains page-related JavaScript
* ``block('messages')`` – contains system messages
* ``block('page_container')`` – content area block (without header/footer) that is reloaded during navigation

- To exclude links from client-side navigation (for example, window-open buttons or delete links), add the CSS class ``no-hash`` to the link tag:

.. code-block:: none

   <a href="page-url" class="no-hash">...</a>

Forms are also submitted via AJAX as part of the client-side navigation process.
