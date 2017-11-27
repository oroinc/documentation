.. _user-guide--system--tags-management-tags:

Tags
====

.. contents:: :local:
    :depth: 2

Overview
--------

The following guide describes how you can configure tags in your Oro application. Tags are located under **System > Tags Management** in the main menu.

.. image:: /user_guide/img/tags/tags_menu_1.png

.. note:: See a short demo on `how to create tags <https://www.orocrm.com/media-library/tags-taxonomies>`_, or continue reading the guidance below.

   .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/RBY6dvZc55E" frameborder="0" allowfullscreen></iframe>

Enable Tags
-----------

Prior to starting your work with tags, ensure that tagging is enabled for the required *entity*.

To enable tags for entities:

1. Navigate to the main menu and click **System > Entities > Entity Management**.

   .. image:: /user_guide/img/tags/entity_management_2.png

2. Click |IcEdit| to open the edit form for the required entity.

   .. image:: /user_guide/img/tags/accounts_edit_3.png

3. In the **Other** section, select **Yes** in the **Enable Tags** field.

   .. image:: /user_guide/img/tags/enable_tags_4.png

4. Click **Save and Close** when you are done.

   .. note:: Please note that if you wish to disable tags for an entity, this will irreversibly erase all its existing tags.

Create Tags
-----------

Tags can be created in a number of ways:

1. From the Tag page under **System > Tags Management > Tags**.
2. From the general page of an entity (ensure that tagging is enabled for the required entity).
3. From the details page of an entity.

From the Tag Page
^^^^^^^^^^^^^^^^^

1. Click **Create Tag** to create a new tag.

   .. image:: /user_guide/img/tags/create_tag_9.png

2. Define the following fields:

   .. csv-table::
     :header: "Field", "Description"
     :widths: 10, 30

     "**Owner**", "Limits the list of users who can manage the tag."
     "**Name**", "Specify the name for your tag."
     "**Taxonomy**", "Select the :ref:`taxonomy <user-guide--system--tags-management--taxonomies>` to which the tag will be assigned."

.. image:: /user_guide/img/tags/create_tag_10.png

3. Click **Save and Close**.

From the General Page of an Entity
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. Navigate to **Customers > Accounts** in the main menu or select any other entity to create a tag for.

2. Within the list of an entity, select the required entity and click |IcPencil|.

   .. image:: /user_guide/img/tags/entity_grid_inline_tag_11.png

2. Specify tags for the entity. You can enter multiple tags for one entity.

   .. image:: /user_guide/img/tags/entity_grid_inline_tag_12.png

3. Click |IcCheck| to save the tags for the entity.

   .. image:: /user_guide/img/tags/entity_grid_inline_tag_13.png

From the Details Page of an Entity
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. Navigate to **Customers > Accounts** in the main menu or select any other entity to create a tag for.

2. Click the required entity to open its details page.

2. Click |IcPencil| in Tags.

   .. image:: /user_guide/img/tags/entity_view_page_14.png

3. Specify tags for the entity. You can enter multiple tags for one entity.

   .. image:: /user_guide/img/tags/entity_view_page_15.png

4. Click |IcCheck| to save the tags for the entity.

   .. image:: /user_guide/img/tags/entity_view_page_16.png

   .. image:: /user_guide/img/tags/entity_view_page_17.png

Manage Tags From the Tags List
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Navigate to **System > Tags Management > Tags**.

Within the tags list, you can:

1. Search records by a tag: |IcSearch|
2. Edit the selected tag: |IcEdit|
3. Delete a tag from the system:|IcDelete|
4. Filter tags: |IcFilter|
5. Configure grid settings for tags: |IcSettings|

   .. image:: /user_guide/img/tags/tags_grid_manage_18.png

   .. image:: /user_guide/img/tags/tags_grid_settings_19.png

View Tagged Content
-------------------

Clicking the selected tag will redirect you to a page where you can view all the records that have been assigned to your selected tag. This way you can search for any required tag within the system.

For instance, clicking **Gold** will redirect you to the page with a list of all records that have **Gold** as a tag.

The number in brackets indicates the how many records within the group are assigned to the selected tag.

.. image:: /user_guide/img/tags/tag_link_20.png

.. image:: /user_guide/img/tags/content_view_page_21.png

Tags in Reports
---------------

It is possible to filter your reports by tags. For instance, we can create a report that will show contacts tagged as **Gold**. To do that:

1. Navigate to **Reports&Segments > Manage Custom Reports**.

2. Click **Create Report** and fill all the required information in the **General**, **Designer** and **Chart Designer** sections as described in the :ref:`Create a Custom Report <user-guide--business-intelligence--reports--use-custom-reports>` guide.

2. Within the **Filters** section, add the **Field Condition** by dragging it to the right.

2. Select **Contact > Tags**.

3. Enter  **is any of Gold**.

4. Click **Save and Close**.

.. image:: /user_guide/img/tags/report_create_gold_22.png

.. image:: /user_guide/img/tags/report_created_gold_23.png

You can create any reports of your choice and filter them by tag in a similar manner.

.. include:: /user_guide/include_images.rst
   :start-after: begin

