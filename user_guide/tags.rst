.. _user-guide-tags:

Tags
====

Tag is non-hierarchical keyword or phrase assigned to a record that can be used for 
:ref:`search <user-guide-getting-started-search>` and :ref:`filtering <user-guide-filters-management>`.

Out-of-the-box you can assign a tag to the following entities:

- :term:`Contact`
- :term:`B2B Customer`
- :term:`Case`
- :term:`Account` 
- :term:`User`

.. note::

    The list of entities, records of which can be assigned a tag can be configured in the course of the system 
    integration.

Add a Tag to a Record
---------------------

In order to add a tag to a record:

- Go to the :ref:`Create/Edit form <user-guide-ui-components-create-pages>` of a record

- Go to the *"Tags"* field.

      |
  
|Tags01|

- Click the :guilabel:`Select an existing tag or create new` button. 

- Choose the *"All Tags"* or *"My Tags"* section. 
  
  -  The *"All Tags"* section contains all the tags available in the system.
  
  -  The *"My Tags"* section contains only the tags created by the user. 

- In order to use a tag already available in the system:

  - Press the arrow-down to see all the tags available in the section.
  
  - Alternatively, start typing the tag name, to see all the tags available in the section and meeting the key entered.

     |Tags02|

- In order to add a new tag, type its name and press Enter.


Tag Grid
--------

You can see all the tags available in the system and amount of times they were assigned to a record, in the Tags 
:ref:`grid <user-guide-ui-components-grids>`.

.. image:: ./img/ui_components/tags_grid.png

|

From the grid you can:

- Get to the :ref:`Create form <user-guide-ui-components-create-pages>` of the tag:
  
  - Click the :guilabel:`Create Tag` button.
  
  - Define the tag :term:`owner <Owner>` and the tag itself.
  
- Get to the :ref:`Edit form <user-guide-ui-components-create-pages>` of the tag: |IcEdit|

- Delete the tag: |IcDelete|

- View all the records that were marked with this tag: |IcSearch|


.. |IcDelete| image:: ./img/buttons/IcDelete.png
   :align: middle

.. |IcEdit| image:: ./img/buttons/IcEdit.png
   :align: middle

.. |IcView| image:: ./img/buttons/IcView.png
   :align: middle
   
.. |IcSearch| image:: ./img/buttons/IcSearch.png
   :align: middle  
   
.. |Tags01| image:: ./img/ui_components/tags_01.png
   :align: middle
   
.. |Tags02| image:: ./img/ui_components/tags_02.png
   :align: middle