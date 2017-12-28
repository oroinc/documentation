.. _configuration--guide--commerce--configuration--product-collections:

Product Collections
~~~~~~~~~~~~~~~~~~~

.. begin

You can control the frequency of the product collections indexation. By default, product collections are indexed every hour.

.. note::

   Indexing simple filters that rely only on the product attributes happens via the message queue. Indexing task is queued immediately after the product collection node is saved. After the index task is processed, the product collection (or the part of product collection) is available on the Front Store immediately.

   Indexing more complex filters (e.g. those that involve relationships with other entities) is separated from the common reindexation process and happens on a dedicated schedule via cron.

To change the default product collections indexation frequency:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Product > Product Collections** in the menu to the left.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. The following page opens.

   .. .. image:: /configuration_guide/img/configuration/inventory/limitations.png
         :class: with-border

3. To customize the Indexation Cron Schedule:

     a) Clear the **Use Default** box next to the option.
     b) Select the desired frequency from the list.

4. Click **Save**.


.. finish

.. include:: /user_guide/include_images.rst
   :start-after: begin
