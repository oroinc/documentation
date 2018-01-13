Actions with Entities
======================

.. contents:: :local:
    :depth: 3

Actions
--------

.. _doc-entity-actions-create:

Create an Entity
^^^^^^^^^^^^^^^^

1. In the main menu, navigate **System>Entities>Entity Management**.
    
2. Click the :guilabel:`Create Entity` button in the upper-right corner of the page. The **New Entity** page opens.

3. Click **General Information** and specify the following:
    
   - **Name**—Type the entity name. 
   
      Mandatory.  
      The name must be at least 5 characters long, may contain only numbers and alphabetic symbols. The first symbol must be a letter.
      The name cannot be a `reserved SQL word <http://msdn.microsoft.com/en-us/library/ms189822.aspx>`_.

   .. caution::
      The Name value must be unique for every custom entity created. Failure to do so may cause partial update of the existing entity and failure of the schema update.   
   
   - **Icon**—From the list, select the icon that will denote all entity records.
   
   - **Label**—Type the label used to refer to the entity on the interface. 
  
      Mandatory
      The label must be at least 2 symbols long. 
      Labels may be duplicated. However, in this case, it will be impossible to distinguish them on the interface. Therefore, it is better to create unique labels for different entities.  

   - **Plural Label**—Type the plural form of the label. It is used in titles of the menu items and grids related to the entity. 
  
      Mandatory
      The plural label must be at least 2 symbols long. 
      
   - **Description**— Type a short but meaningful description that can help you and other users understand the purpose and specifics of the created entity in future.    

   |

   .. image:: ../img/entity_management/entity_create1.png

   |


4. Click **Communication & Collaboration** and specify the following:

   - **Share Scopes**—This subsection defines whether the records of the entity can be shared with an individual user, or the whole business unit / organization.
     
      .. caution:: 
        This section is currently unavailable for custom entities. 

   
      - **User**—Select this check box if the entity records can be shared with an individual user.
      
      - **Business Unit**—Select this check box if the entity records can be shared with the whole business unit. 
            
      - **Organization**—Select this check box if the entity records can be shared with the whole organization.     
   
   - **Activities**—Defines which activities users can add from the entity record view page. When you add an activity from the entity record page, the entity record appears as a context for this activity. For more information about the activities, see the `Activities <../../user-guide/activities/activities-overview>`__ guide.
   
      - **Emails**—Select this check box to enable sending emails from the entity record view page. 
      
      - **Calendar Events**—Select this check box to enable adding calendar events from the entity record view page. 
      
      - **Calls**—Select this check box to enable logging calls from the entity record view page.  
      
      - **Tasks**—Select this check box to enable adding tasks from the entity record view page.
   
   - **Enable Notes**—Defines whether it is possible to make notes on the entity record. Notes are made via the action button and are displayed in the **Activity** section on the entity record view page. 
     
   |

   .. image:: ../img/entity_management/entity_addnotes.png

   |



   .. image:: ../img/entity_management/entity_addnotes2.png

   |   

      - **Yes**—Select this value from the list to enable adding notes to the entity records.
      
      - **No**—Select this value from the list to restrict adding notes to the entity records.
      

   Mandatory. 
   Default value is **No**.
	

   - **Enable Comments**—Defines whether it is possible to leave comments on the entity records. Comments are displayed in the corresponding section on the entity view page. For more information on comments, see the `Add Comment <../../user-guide/activities/activities-add-comment>`__ guide.


     |

     .. image:: ../img/entity_management/entity_addcomment.png

     |

      - **Yes**—Select this value from the list to enable adding comments to the entity records.
      
      - **No**—Select this value from the list to restrict adding comments to the entity records.
      
     Mandatory. 
     Default value is **No**.

   |

   .. image:: ../img/entity_management/entity_create2.png

   |

5. Click **Attachments** and specify the following:

   - **Enable Attachments**—Defines whether it is possible to attach files to the entity records. Attachments are added via the action button and are displayed on the entity view page in the corresponding section. For more information on comments, see the `Add Attachment <../../user-guide/activities/activities-add-attachment>`__ guide.
     
     |

     .. image:: ../img/entity_management/entity_addattachment.png

     

     |

     .. image:: ../img/entity_management/entity_addattachment2.png

     |

  
      - **Yes**—Select this value from the list if you want to enable adding attachments to the entity records.
      
      - **No**—Select this value from the list if you want to disable adding attachments to the entity records. 
            

     Mandatory. 
     Default value is **No**.
   
   - **Max Allowed File Size, Mb**—Type the upper limit of an attachment size. Attachments whose size exceeds the specified value will not be allowed.
     
   - **Allowed Mime Types**—Enter the list of supported MIME types. If this field is left empty, the list of MIME types defined in the system configuration (see `Upload Settings <../app-look-feel/system-config#admin-configuration-uploads>`__ ) will be applied.
     
     The format of MIME types must follow these examples: application/pdf, image/\*
 

   - **Link Attachments To Context Entity**—If an entity record is mentioned as a context in an email, this email appears in the **Activity** section of the entity record view page. When the email contains a file as an attachment, it is possible to reattach the file to the entity record itself. You can define whether the user will reattach the file manually when required or the system will reattach it automatically.   

      - **Manual**—Select this value from the list if users are to reattach files from emails to the entity record manually. 
      
      - **Auto**—Select this value from the list if the system are to reattach all the attachments from emails to the entity record automatically.

     This field is available only when **Enable Attachments** is set to **Yes**.
     Mandatory. 
     Default value is **Manual**.

   |

   .. image:: ../img/entity_management/entity_create3.png


6. Click **Other** and specify the following:

   - **Ownership Type**—Records of which entity can be set as owners of the entity. For more information, see the `Ownership Type <../security/access-management-ownership-type>`__ guide.
     
 
      - **None**—Select this value form the list if the entity records must have no owner (it can be also said that the owner is the system itself).
      
      - **User**—Select this value if the entity records must have users as owners.
      
      - **Business Unit**—Select this value if the entity records must have business units as owners. 
            
      - **Organization**—Select this value if the entity records must have organizations as owners.    
      
     Mandatory. 
     Default value is **None**. 
   
   - **Auditable**—This subsection defines whether system will log what actions are performed with the entity records and who performed them, and users with the corresponding permissions will be able to check it in the **Change History** and **Data Audit** sections of the system. For more information about the data audit, see the :ref:`Data Audit <user-guide-data-audit>` guide.
   
     |

     .. image:: ../img/entity_management/entity_change history.png

     |

     .. image:: ../img/entity_management/data_audit.png
 
     |
   
      - **Yes**—Select this value from the list to enable audit of records of the entity.
      
      - **No**—Select this value from the list to disable audit of records of the entity.
      
     Mandatory. 
     Default value is **No**.

   - **Enable Tags**—Defines whether it will be possible to assign tags to entity records. For more information on data audit, see the `Tags <../../user-guide/navigation/data-management-tags>`__ guide.
   
     |

     .. image:: ../../user_guide/img/navigation/panel/search_vip_1.png

     |

      - **Yes**—Select this value from the list to enable adding tags for the entity records.
      
      - **No**—Select this value from the list to disable adding tags for the entity records.
      

     Mandatory. 
     Default value is **No**.
   

   - **Workflow Step in Grid**—Defines whether to show the column with information about the current workflow step in the grid that contains all entity records. For more information on workflows, see the `Following a Workflow <../../user-guide/records/data-management-workflows>`__ guide.
     
     |
       
     .. image:: ../img/entity_management/entity_showworkflowstep.png

     |

      - **Show**—Select this value from the list to show the column with the workflow step in the grid on the **All \<Entity Name\>** page.
      
      - **Hide**—Select this value from the list if you do not want to show the column with the workflow step in the grid.
      
     Default value is **Show**.


   |
     
   .. image:: ../img/entity_management/entity_create4.png

   |

7. Click the :guilabel:`Save and Close` button in the upper-right corner. 

8. Add fields to the entity. Fields contain all the details of the entity records. For example, if it is the 'friend' entity, you can add such fields as 'first name,' 'last name,' 'phone,' etc. For how to create a field, see the `Create a Field <./entity-actions#create-a-field>`__ section.  

9. After you have added fields to the entity, update the schema. For how to do it, see the `Update Schema <./entity-actions#update-schema>`__ section. 

   .. important::
      You will be able to add entity records only after you have updated the schema. 


Review an Entity
^^^^^^^^^^^^^^^^^

1. In the main menu, navigate **System>Entities>Entity Management**.

2. In the grid on the **All Entities** page, click the required entity.

3. Review the entity settings. Please see details in the `Entity Structure on the Interface <./entity-interface>`__ guide. 
   

Create a Field
^^^^^^^^^^^^^^^

.. important::
   You can add custom fields only for custom entities and extendable system entities.  

To create a field, follow the instructions provided in the `Create a Custom Entity Field <./entity-fields#create-a-custom-entity-field>`__ section.`




Import Fields
^^^^^^^^^^^^^^^^^

To simplify creation of entity fields, you can create a .csv file that will contain all the required fields with their properties defined and import it into OroCRM. 

.. important:: 
  You can only import data saved in the .csv (comma separated values) format. 

1. In the main menu, navigate **System>Entities>Entity Management**.

2. In the grid on the **All Entities** page, click the required entity.

3. In the **Import Fields** drop-down, click :guilabel:`Download Data Template`. The .csv file with sample data will be downloaded.

4. Check that the data you want to import is formatted the same way as in the downloaded template and that the structure of the .csv file you prepared for import is also the same as the structure of the downloaded file.

5. In the **Import Fields** drop-down, click :guilabel:`Import Fields`. 

6. In the **Import Entity Fields** dialog box, click **Choose File**, select the .csv file you prepared and then click **Submit**. 

   |

   .. image:: ../img/entity_management/entity_importentityfields1.png

   |

7. Information in the dialog box reloads and the **Import validation results** section appears. Review the information in this section and if you are satisfied with the review results, click **Import**. If you wish to make any changes in the file or upload a different one, click **Back** to return to the previous step. 

   |

   .. image:: ../img/entity_management/entity_importentityfields2.png

   |

8. Update the schema to apply the changes. For how to do it, see the `Update Schema <./entity-actions#update-schema>`__ section. 
  

.. _schema update:

Update Schema
^^^^^^^^^^^^^^

Once you have defined the necessary entities and their fields, you need to update the schema—the internal structure so that the system could know how the existing fields are interconnected and where to find them.

1. Click the :guilabel:`Update Schema` button in the upper-right corner of the entity view page. 

2. In the **Schema update confirmation** dialog box, click :guilabel:`Yes, Proceed`.


.. note::
  The schema update can take some time, so please be patient.

.. caution::
  Please note that the schema update influences the overall system performance and updates the schema for all the created/updated entities.



Manage Unique Keys
^^^^^^^^^^^^^^^^^^^

You can define a set of fields by which the system will compare entity records to determine whether these records are distinct or not. 


For example, by default you can create two contacts with the same information: 

Jane Roe, born 1985-01-15, \sales@example.com

The system assigns them different IDs and treats them as different records, but they look the same on the interface and actually represent the same person.


Now imagine that before adding contacts you have defined two sets of unique keys:

- First Name+Last Name+Birthday

- First Name+Last Name+Email
  
    
You create a contact:

Jane Roe, born 1985-01-15, sales@example.com

And your colleague Roger tries to add Jane as a contact too: 

Jane Roe, sales@example.com

The system checks: 

- The first names and the last names are the same, but the birthday is different (not specified in the second case), may be these are different contacts.
 
- The first names and the last names are the same, but the email is the same too, so it must be the same contact.

As the result, the system informs Roger that this contact already exists in the system.



To manage unique keys do the following:

1. In the main menu, navigate **System>Entities>Entity Management**.

2. In the grid on the **All Entities** page, click the required entity.  
   
3. Click the :guilabel:`Manage Unique Keys` button in the upper-right corner of the page. 
   
4. On the **Unique Keys** page, click **+Add**.

5. Specify the required information:
   
   - **Name**—Mandatory. The set name on the interface. It is used just for reference. 
   
   - **Key**—Mandatory. The fields that will be included in this set. Hold the CTRL key to select several fields. 

6. If you need to add another set, repeat steps 4–5.
   
   |

   .. image:: ../img/entity_management/entity_manageuniquekeys.png

   |

7. If you need to delete a set, click the **x** icon next to the set name. 

8. Click the **Save** button in the upper-right corner of the page.      


.. _doc-entity-actions-edit:

Edit an Entity
^^^^^^^^^^^^^^

.. important::
  Which properties are editable for system entities depends on the configuration and is based reasonable and safe for the system performance and operation. 

1. In the main menu, navigate **System>Entities>Entity Management**.

2. In the grid on the **All Entities** page, choose the entity you want to edit, click the ellipsis menu at the right end of the corresponding row and then click the |IcEdit| **Edit** icon.
   
3. Make the required changes according to the description provided steps 3–6 of the `Create an Entity <../security/entity-actions#create-an-entity>`__ section.   

   .. important:: 
    You cannot change the name of the entity.

    You cannot change the ownership type of the entity.

   There are also several additional fields in the **Other** section that are available only when you edit an entity:

   - **Field Level ACL**—Select this check box to define that permissions can be set on individual fields of this entity. For more information about field level ACLs, see the `Permissions for an Entity Field (Field Level ACLs) <../security/access-management-field-level-acl>`__ guide.

   - **Show Restricted**—Select this check box if you enabled **Field Level ACL** and are going to disable editing of some fields of the entity records but still want users to review disabled fields on the interface. Fields disabled for modifying will appear dimmed on the interface. For more information about field level ACLs, see the `Permissions for an Entity Field (Field Level ACLs) <../security/access-management-field-level-acl>`__ guide.

   - **Searchable**—Defines whether records users can search for and find records of this entity via OroCRM's :ref:`search functionality <user-guide-getting-started-search>`.

     - **Yes**—Select this value from the list if users can search for and find records of this entity.
     
     - **No**—Select this value from the list if records of this entity are invisible for search.

   - **Applicable Organizations**—Select in which organizations this entity will be available. The default value is **All**. To specify a particular organization, clear the **All** check box and click the field that appears to choose the organization from the list.
     
   |

   .. image:: ../img/entity_management/entity_edit.png

   |     

4. Click the :guilabel:`Save And Close` button in the upper-right corner of the page.

5. Update the schema. For how to do it, see the `Update Schema <./entity-actions#update-schema>`__ section. 

Delete an Entity
^^^^^^^^^^^^^^^^^

.. important:: 
  You can delete only custom entities that have no records. 

1. In the main menu, navigate **System>Entities>Entity Management**.

2. In the grid on the **All Entities** page, choose the entity you want to delete, click the ellipsis menu at the right end of the corresponding role and then click the |IcDelete| **Delete** icon.

|

.. image:: ../img/entity_management/entity_delete1.png

|

3. In the **Deletion Confirmation** dialog box, click :guilabel:`Yes`.

.. note::
  Reload the page when you see the notification about item deletion. 

  If you can still see the entity in the grid on the **All Entities** page, you may need to update the schema. For how to do it, see the `Update Schema <./entity-actions#update-schema>`__ section. 



Links
------


For the overview of the entities, see the `Entities <./entities>`__ guide. 

For the description of the entity view page, see the `Entity on the Interface <./entity-interface>`__ guide. 

For the information about entity fields, see the `Entity Fields <./entity-fields>`__ guide. 



.. |IcRemove| image:: ../../img/buttons/IcRemove.png
	:align: middle

.. |IcClone| image:: ../../img/buttons/IcClone.png
	:align: middle

.. |IcDelete| image:: ../../img/buttons/IcDelete.png
	:align: middle

.. |IcEdit| image:: ../../img/buttons/IcEdit.png
	:align: middle

.. |IcView| image:: ../../img/buttons/IcView.png
	:align: middle


   
   
