.. _bundle-docs-platform-ui-bundle-items-manager:

Items Manager
=============

Components
----------

- Backbone collection for storing list of items
- `itemsManagerEditor` - [jQuery-UI widget] for binding html inputs to the item
- `itemsManagerTable` - [jQuery-UI widget] for rendering list of items

**Example**:

Define `Backbone.Model` for an item:

.. code-block:: js
   :linenos:

    var ItemModel = Backbone.Model.extend({
        defaults: {
            name : null,
            label: null,
            func: null,
            sorting: null
        }
    });


Define `Backbone.Collection` for the item list:

.. code-block:: javascript
   :linenos:

    var ItemCollection = Backbone.Collection.extend({
        model: ItemModel
    });


Define html for `itemsManagerEditor`:

.. code-block:: html
   :linenos:

    <div id="editor">
        <input name="name"></input>
        <input name="label"></input>
        <input name="func"></input>
        <input name="sorting"></input>
        <button class="add-button"></button>
        <button class="save-button"></button>
        <button class="cancel-button"></button>
    </div>


Define html for `itemsManagerTable`:

.. code-block:: html
   :linenos:

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Label</th>
                <th>Function</th>
                <th>Sorting</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="item-container">
        </tbody>
    </table>


Define template file `templates/item.html` for the item on the list:

.. code-block:: none
    :linenos:

     <tr data-cid="<%= cid %>">
         <td><%= name %></td>
         <td><%= label %></td>
         <td><%= func %></td>
         <td><%= sorting %></td>
         <td class="action-cell">
             <a href="#" data-collection-action="edit" role="button" title="_.__('Edit')">
                 <span class="fa-pencil-square-o hide-text" aria-hidden="true"></span>
             </a>
             <a href="#" data-collection-action="delete" role="button" title="_.__('Delete')"
                 data-message="Delete?">
                 <span class="fa-trash-o hide-text" aria-hidden="true"></span>
             </a>
         </td>
     </tr>

Instantiate item collection:

.. code-block:: javascript
   :linenos:

    var items = new ItemCollection([
        {
            "name": "a",
            "label": "A",
            // ...
        },
        {
            "name": "b",
            "label": "B",
            // ...
        },
        {
            "name": "c",
            "label": "C",
            // ...
        },
    ]);


Apply `itemsManagerEditor` widget on `div#editor`:

.. code-block:: js
   :linenos:

    $('div#editor').itemsManagerEditor({
        collection: items
    });


Apply `itemsManagerTable` widget to `tbody.item-container`:

.. code-block:: javascript
    :linenos:

    import itemTemplate from 'tpl-loader!templates/item.html';

    $('tbody.item-container').itemsManagerTable({
        itemTemplate: itemTemplate,
        collection: items
    });

.. seealso:: |jQuery-UI widget| and |jQuery-UI sortable|

.. include:: /include/include-links-dev.rst
   :start-after: begin
