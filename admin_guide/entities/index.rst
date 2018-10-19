Entities Management
===================

Oro applications organize information into entities, records, and properties. An **entity** is a collection of similar information. That information is usually stored in a separate table in the database. Each instance of this collection is a **record** that is stored as a row in the table. The details of each record are its **properties**. They are stored in the dedicated table columns. The parameters of properties are defined in the entity fields.

For instance, a contact is a system entity. When you create a new contact record in the application (e.g. a potential customer called Mary Smith), it becomes a contact record in OroCRM. Information about contact records is organized into a set of properties, such as the first name, the last name, a telephone number, etc. Every entity in Oro applications has its own properties, depending on what this entity is supposed to represent or display.

Some pieces of information are complex enough to have their own entity. For example, for each cart in a web store, we need to know its unique ID (number), how many items are in the cart, what their total value is, and whether a purchase has been completed. The cart entity should, therefore,  have records that contain all of these properties: ID, number of items, total value, and status. When one customer has several carts, the customer record needs to be related to many different cart records. To achieve this, we assign one of the customer properties as a **relation** to carts. This field saves the identifier of customer carts (the *cart* field). Using this identifier, the system can find the cart and bind its properties to the customer. Moreover, each cart can have several items in it, which means that the cart record needs to be related to its item records as *one to many*.

The Entity Management topic explains how you can record, process and analyze various commerce, sales, and marketing data and activities, how all of this information is represented in Oro, and how you can manage it in your application instance.

Follow the links below to learn more:

.. toctree::
   :titlesonly:
   :maxdepth: 1
   
   entities 
   entity_grid
   entity_interface
   entity_actions
   entity_fields
   entity_field_properties
   entity_field_types