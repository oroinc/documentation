.. _user-guide-ui-components-create-pages:

Create a New Record and Edit the Record Details Pages
=====================================================

In order to create a new record of an :term:`entity` or to update details of the existing record, use the dedicated **Create <Entity name>** and **Edit <Entity name>** pages.

Create a Record
---------------

1. On the **All <entity name>** page (the page with the list of all entity records), click the  :guilabel:`Create <entity name>` button in the upper-right corner. The **Create <Entity name>** page opens. 
   
   |

   .. image:: ./img/ui_components/create_page_example.png

   |


   .. note::

    The default list of fields available on the page can be modified by an administrator. For more information,  see the description of the **Show on Form** field in the :ref:`Show on Form <user-guide-entity-management-other-common>` guide. 



2. Fill in all the required information. 
   
   Note that mandatory fields are identified with the red asterisk.

   |

   .. image:: ./img/ui_components/create_page_asterisk.png

   |



   Available fields are usually gathered into logical sections. Click the section name to scroll the page to the fields that belong to this section.

   |

   .. image:: ./img/ui_components/create_page_sections.png

   |

3. Save the new record or discard it. 
   
   To save the record, click one of the options in the save menu in the upper-right corner of the page: 
  
   - :guilabel:`Save`—Save the changes and stay on the **Create <Entity name>** page. Use this option if you want to make more changes to the record configuration.   
   
   - :guilabel:`Save and Close`—Save the changes and close the **Create <Entity name>** page. The record view page opens.
   
   - :guilabel:`Save and New`—Save the changes and open a new **Create <Entity name>** page. The blank **Create <Entity name>** page opens. Use this option if you want to immediately create another record. 
   
   To discard the changes, click the :guilabel:`Cancel` button in the upper-right corner of the page.

   |

   .. image:: ./img/ui_components/create_page_save_cancel.png

   |

Edit a Record
-------------

To change the properties of a record, use the **Create <Entity name>** page. 

1. Do one of the following:
   
   - In the grid on the **All <Entity name>** page (the page with the list of all entity records), choose the entity record you want to edit, click the ellipsis menu at the right-hand end of the corresponding row and then click the |IcEdit| **Edit** icon.

   - Open the entity view page and click the  :guilabel:`Edit` button in the upper-right corner.  
   
   |

   .. image:: ./img/ui_components/edit_page_example.png

   |

2. Modify records and save the changes as described in step 2–3 of the `Create a Record <./data-management-form#create-a-racord>`__ section.

.. note::

    Some of the fields labels cannot be changed after the record is created, subject to the system requirements. 




.. |IcDelete| image:: ./img/buttons/IcDelete.png
   :align: middle

.. |IcEdit| image:: ./img/buttons/IcEdit.png
   :align: middle

.. |IcView| image:: ./img/buttons/IcView.png
   :align: middle
   
.. |IcBulk| image:: ./img/buttons/IcBulk.png
   :align: middle