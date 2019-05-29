.. _user-guide--system--tags-management-tags:

Tags
====

.. contents:: :local:
    :depth: 2

Overview
--------

The following guide describes how you can configure tags in your Oro application. Tags are located under **System > Tags Management** in the main menu.

.. note:: See a short demo on `how to create tags <https://www.oroinc.com/orocrm/media-library/tags-taxonomies>`_, or continue reading the guidance below.

   .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/RBY6dvZc55E" frameborder="0" allowfullscreen></iframe>

Enable Tags
-----------

Prior to starting your work with tags, ensure that tagging is enabled for the required *entity*.

To enable tags for entities:

1. Navigate to the main menu and click **System > Entities > Entity Management**.

2. Click |IcEdit| at the end of the required entity's row to open its edit form.

3. In the **Other** section, select **Yes** in the **Enable Tags** field.

   .. image:: /user_doc/img/system/tags_management/enable_tags_4.png
      :alt: Selecting Yes in the Enable Tags field

4. Click **Save and Close**.

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

2. Define the following fields:

   * **Owner** --- Limits the list of users who can manage the tag.
   * **Name** --- Specify the name for your tag.
   * **Taxonomy** --- Select the :ref:`taxonomy <user-guide--system--tags-management--taxonomies>` to which the tag will be assigned.

3. Click **Save and Close**.

From the General Page of an Entity
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. Navigate to **Customers > Accounts** in the main menu or select any other entity to create a tag for.

2. Within the list of an entity, select the required entity and click |IcPencil| edit.

3. Specify tags for the entity. You can enter multiple tags for one entity.

   .. image:: /user_doc/img/system/tags_management/entity_grid_inline_tag_12.png
      :alt: Select the required tags from the list

4. Click |IcCheck| to save the tags for the entity.


From the Details Page of an Entity
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. Navigate to **Customers > Accounts** in the main menu or select any other entity to create a tag for.

2. Click the required entity to open its details page.

2. Click |IcPencil| edit in Tags.

   .. image:: /user_doc/img/system/tags_management/entity_view_page_14.png
      :alt: Click the edit icon in the Tags field of the selected entity record

3. Specify tags for the entity. You can enter multiple tags for one entity.

   .. image:: /user_doc/img/system/tags_management/entity_view_page_15.png
      :alt: Specify the tags for the entity in the field that opened

4. Click |IcCheck| to save the tags for the entity.

   .. image:: /user_doc/img/system/tags_management/entity_view_page_17.png
      :alt: The tags selected for the entity are saved successfully

Manage Tags From the Grid
^^^^^^^^^^^^^^^^^^^^^^^^^

Navigate to **System > Tags Management > Tags**.

Within the tags list, you can:

1. Search records by a tag: |IcSearch|
2. Edit the selected tag: |IcEdit|
3. Delete a tag from the system:|IcDelete|
4. Filter tags: |IcFilter|
5. Configure grid settings for tags: |IcSettings|

.. image:: /user_doc/img/system/tags_management/tags_grid_manage_18.png
   :alt: The actions available for the tags in the grid


View Tagged Content
-------------------

Clicking the selected tag will redirect you to a page where you can view all the records that have been assigned to your selected tag. This way you can search for any required tag within the system.

For instance, clicking **Gold** will redirect you to the page with a list of all records that have **Gold** as a tag.

.. image:: /user_doc/img/system/tags_management/tag_link_20.png
   :alt: Point at the Gold tag

The number in brackets indicates the how many records within the group are assigned to the selected tag.

.. image:: /user_doc/img/system/tags_management/content_view_page_21.png

Tags in Reports
---------------

It is possible to filter your reports by tags. For instance, we can create a report that will show contacts tagged as **Gold**. To do that:

1. Navigate to **Reports&Segments > Manage Custom Reports**.

2. Click **Create Report** and fill all the required information in the **General**, **Designer** and **Chart Designer** sections as described in the :ref:`Create a Custom Report <user-guide--business-intelligence--reports--use-custom-reports>` guide.

3. Within the **Filters** section, add the **Field Condition** by dragging it to the right.

4. Select **Contact > Tags**.

5. Enter  **is any of Gold**.

6. Click **Save and Close**.

.. image:: /user_doc/img/system/tags_management/report_create_gold_22.png
   :alt: Apply the mentioned conditions in the Filters section

.. image:: /user_doc/img/system/tags_management/report_created_gold_23.png
   :alt: Illustrate the created reports with selected tags

You can create any reports of your choice and filter them by tag in a similar manner.

.. include:: /user_doc/img/buttons/include_images.rst
   :start-after: begin

