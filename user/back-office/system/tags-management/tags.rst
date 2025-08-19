.. _user-guide--system--tags-management-tags:

Configure Tags in the Back-Office
=================================

The following guide describes how you can configure :term:`tags <Tag>` in your Oro application. Tags are located under **System > Tags Management** in the main menu.

.. note:: See a short demo on |how to create tags| or continue reading the guidance below.

   .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/RBY6dvZc55E" frameborder="0" allowfullscreen></iframe>

Enable Tags for Entity
----------------------

Prior to starting your work with tags, ensure that tagging is enabled for the required *entity*.

To enable tags for entities:

1. Navigate to the main menu and click **System > Entities > Entity Management**.

2. Click |IcEdit| at the end of the required entity's row to open its edit form.

3. In the **Other** section, select **Yes** in the **Enable Tags** field.

   .. image:: /user/img/system/tags_management/enable_tags_4.png
      :alt: Selecting Yes in the Enable Tags field

4. Click **Save and Close**.

   .. note:: Please note that if you wish to disable tags for an entity, this will irreversibly erase all its existing tags.


Create Tags
-----------

Tags can be created in a number of ways:

From the Tag Page
^^^^^^^^^^^^^^^^^

1. Navigate to the Tag page under **System > Tags Management > Tags**.
2. Click **Create Tag** to create a new tag.

3. Define the following fields:

   * **Owner** --- Limits the list of users who can manage the tag.
   * **Name** --- Specify the name for your tag.
   * **Taxonomy** --- Select the :ref:`taxonomy <user-guide--system--tags-management--taxonomies>` to which the tag will be assigned.

4. Click **Save and Close**.

From the Grid Page
^^^^^^^^^^^^^^^^^^

1. Navigate to a grid page for an entity that supports tag creation. For example, open **Customers > Accounts** from the main menu. Tags will be available from the grid of that entity.

2. Click |Pencil-SVG| edit next to the selected entity record.

3. Start typing in the tag name. If it does not yet exist in the system, (New Tag) will appear next to it in the drop down.

   .. image:: /user/img/system/tags_management/new-tag.png

   Alternatively, select an existing tag from the list. You can add multiple tags.

   .. image:: /user/img/system/tags_management/entity_grid_inline_tag_12.png
      :alt: Select the required tags from the list

4. Click |IcCheck| to save the tag(s).


From the Details Page of an Entity
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. Navigate to a grid page for an entity that supports tag creation. For example, open **Customers > Accounts** in the main menu.

2. Click the required entity to open its details page.

2. Click |Pencil-SVG| edit in Tags.

   .. image:: /user/img/system/tags_management/entity_view_page_14.png
      :alt: Click the edit icon in the Tags field of the selected entity record

3. Specify one or more tags for the entity.

   .. image:: /user/img/system/tags_management/entity_view_page_15.png
      :alt: Specify the tags for the entity in the field that opened

4. Click |IcCheck| to save the tags.

Manage Tags From the Grid
-------------------------

Navigate to **System > Tags Management > Tags**.

Within the tags list, you can:

1. Search records by a tag: |Search-SVG|
2. Edit the selected tag: |IcEdit|
3. Delete a tag from the system:|Trash-SVG|
4. Filter tags: |IcFilter|
5. Configure grid settings for tags: |IcSettings|

.. image:: /user/img/system/tags_management/tags_grid_manage_18.png
   :alt: The actions available for the tags in the grid

View Tagged Content
-------------------

Clicking the selected tag will redirect you to a page where you can view all the records that have been assigned to your selected tag. This way you can search for any required tag within the system.

For instance, clicking **Gold** will redirect you to the page with a list of all records that have **Gold** as a tag.

.. image:: /user/img/system/tags_management/tag_link_20.png
   :alt: Point at the Gold tag

The number in brackets indicates the how many records within the group are assigned to the selected tag.

.. image:: /user/img/system/tags_management/content_view_page_21.png

Tags in Reports
---------------

It is possible to filter your reports by tags. For instance, we can create a report that will show contacts tagged as **Gold**. To do that:

1. Navigate to **Reports&Segments > Manage Custom Reports**.

2. Click **Create Report** and fill all the required information in the **General**, **Designer** and **Chart Designer** sections as described in the :ref:`Create a Custom Report <user-guide--business-intelligence--reports--use-custom-reports>` guide.

3. Within the **Filters** section, add the **Field Condition** by dragging it to the right.

4. Select **Contact > Tags**.

5. Enter  **is any of Gold**.

6. Click **Save and Close**.

.. image:: /user/img/system/tags_management/report_create_gold_22.png
   :alt: Apply the mentioned conditions in the Filters section

.. image:: /user/img/system/tags_management/report_created_gold_23.png
   :alt: Illustrate the created reports with selected tags

You can create any reports of your choice and filter them by tag in a similar manner.

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin

