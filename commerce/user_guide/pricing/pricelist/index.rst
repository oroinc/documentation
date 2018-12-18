.. _user-guide--pricing--pricelist--management:

Price Lists Management
======================

.. contents:: :local:
   :depth: 2

Create a Price List
-------------------

.. include:: /user_guide/pricing/pricelist/create.rst
   :start-after: begin
   :end-before: finish

Schedule Price Adjustments
--------------------------

.. include:: /user_guide/pricing/pricelist/schedule.rst
   :start-after: begin
   :end-before: stop

.. _user-guide--pricing--import--export:

Export and Import Prices
------------------------

Export Prices From the Price List
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. include:: /getting_started/import_export/export_price_lists.rst
   :start-after: start_export_price_lists

Import Prices Into the Price List
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. include:: /getting_started/import_export/import_price_lists.rst
   :start-after: start

.. _user-guide--pricing--duplicate-price-lists:

Duplicate a Price List
----------------------

To save you time from manually re-entering prices, you can create a new price list from the existing one by duplicating it.

To duplicate the existing price list:

1. Navigate to **Sales > Price Lists** in the main menu.
2. Click once on the price list in the table to open its details page.
3. On the price list page, click **Duplicate Price List**.

   .. note:: You can duplicate existing price lists if you are granted the corresponding ACL permissions. Read more on roles and permissions in the :ref:`Understand Roles and Permissions <user-guide-user-management-permissions>` topic.

   .. image:: /user_guide/img/sales/price_lists/duplicate_price_list_button.png
      :alt: Duplicate price list button on the price list details page

   The details page of the duplicated price list is displayed:

   .. image:: /user_guide/img/sales/price_lists/duplicated_price_list_details_page.png
      :alt: The details page of the duplicated price list

4. Update the details of the new price list as required.

Manage Product Price Manually
-----------------------------

.. include:: /user_guide/pricing/pricelist/manual.rst
   :start-after: begin_one
   :end-before: finish_one

.. include:: /user_guide/pricing/pricelist/manual.rst
   :start-after: begin_two
   :end-before: finish_two

Generate Product Price Automatically
------------------------------------

.. include:: /user_guide/pricing/pricelist/auto.rst
   :start-after: begin_pricelist_management
   :end-before: end_pricelist_management

Price Rules Automation Examples
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. include:: /user_guide/pricing/pricelist/auto_examples.rst
   :start-after: begin_price_rules_auto_examples
   :end-before: finish_price_rules_auto_examples

.. _user-guide--pricing--auto--expression:

Filtering Expression Syntax
^^^^^^^^^^^^^^^^^^^^^^^^^^^

The filtering expression for the product assignment rule and the price calculation condition follow the `Symfony2 expression language <http://symfony.com/doc/current/components/expression_language/syntax.html>`_ syntax and may contain the following elements:

* Entity properties :ref:`stored as table columns <user-guide--pricing--auto--expression--storage-type>`, including:

  - **Product properties**: product.id, product.sku, product.status, product.createdAt, product.updatedAt, product.inventory_status, etc.

  - Properties of product’s children entities, like:

      + **Category properties**: product.category.id, product.category.left, product.category.right, product.category.level, product.category.root, product.category.createdAt, and product.category.updatedAt

      + Any **custom properties** added to the product entity (e.g. product.awesomeness), or to the product children entity (e.g. product.category.priority and product.price.season)

  - **Price properties**: pricelist[N].prices.currency, pricelist[N].prices.productSku, pricelist[N].prices.quantity, and pricelist[N].prices.value, where `N` is the ID of the pricelist that the product belongs to.

  - **Relations** (for example, product.owner, product.organization, product.primaryUnitPrecision, product.category, and any virtual relations created in OroCommerce for entities of product and its children.

    .. note::
       + To keep the filter behavior predictable, OroCommerce enforces the following limitation in regards to using relations in the filtering criteria: you can only use parameters residing on the “one” side of the “one-to-many” relation (including the custom ones).
       + When using relation, the id is assumed and may be omitted (e.g. “product.category == 1” expression means the same as “product.category.id == 1”).
       + Any product, price and category entity attribute is accessible by field name.

* **Operators:** +, -,  *,  / , %, ** , ==, ===, !=, !==, <, >, <=, >=, matches (string) (e.g. matches 't-shirt'; you can also use the following wildcards in the string: % --- replaces any number of symbols, _ --- any single symbol, e.g., matches ' t_shirt' returns both 't-shirt' and 't shirt') and, or, not, ~ (concatenation), in, not in, and .. (range).

* **Literals:** You can use strings (e.g. *'hello'*), numbers (e.g. *345*), arrays (e.g. *[7, 8, 9]* ), hashes (e.g. *{ property_name: 'property_value' }*), *true*, *false* and *null*.

Developer Notice
^^^^^^^^^^^^^^^^

The expression is converted into internal Nodes tree. This tree is converted into QueryBuilder which is used in Insert From Select to fill prices and assignment with one query. Virtual relations and virtual fields are managed by AbstractQueryConverter, that is also used to join all required relations and generate unique table aliases. Generated query builder is cached along with its parameters. Each rule and assignment rules have their cache by ID. When a rule or an assignment rule is changed, the cached QueryBuilder is recalculated.


Set Prices in Multiple Currencies
---------------------------------

.. include:: /user_guide/pricing/pricelist/multicurrency.rst
   :start-after: begin
   :end-before: finish

.. stop_pricelist_management

.. include:: /img/buttons/include_images.rst
   :start-after: begin

.. toctree::
   :hidden:

   create
   auto
   auto_examples
   autocomplete
   manual
   schedule
   multicurrency
   storage_type
