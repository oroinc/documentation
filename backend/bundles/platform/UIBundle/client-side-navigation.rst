.. _bundle-docs-platform-ui-bundle-client-side-navigation:

Client Side Navigation
======================

Client Side Navigation allows to load page in different formats HTML or JSON in depends on request. First request form browser loads complete HTML page. All following requests are made by JavaScript and load page blocks in JSON format.

To get the page ready for the client side navigation, follow the steps below:

- Add an additional check in main layout template:

.. code-block:: none

    {% if not oro_is_hash_navigation() %}
    <!DOCTYPE html>
    <html>
    ...
    [content]
    ...
    </html>
    {% else %}
    {# Template for hash tag navigation#}
    {% include 'OroNavigationBundle:HashNav:hashNavAjax.html.twig'
        with {'script': block('head_script'), 'messages':block('messages'), 'content': block('page_container')}
    %}
    {% endif %}

where:

  `block('head_script')` -a  block with a page related javascripts;
  `block('messages')` - a block with system messages;
  `block('page_container')` - a content area block (without header/footer) that is reloaded during navigation

- To exclude links from processing with client side navigation (like windows open buttons, delete links), add an additional css class "no-hash" to the tag, e.g.

.. code-block:: none

   <a href="page-url" class="no-hash">...</a>

As part of the navigation, form submit is also processed with Ajax.
