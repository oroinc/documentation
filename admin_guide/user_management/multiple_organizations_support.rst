.. _user-ee-multi-org:

Multiple Organizations Support
==============================

OroCRM Enterprise Edition allows the :ref:`creation <user-management-organization-create>` of multiple organizations 
within one OroCRM instance.

There may be any amount of organizations within one OroCRM instance (the system) and one user may belong to several 
organizations.


.. _user-ee-multi-org-system:

System Organization
-------------------

When an organization is created, you can set it as a **system organization**. 

While non-system organizations have separate access and permissions as 
described in the :ref:`Access and Permissions Management guide <user-guide-user-management-permissions>`, a system 
organization enables managing (view, create, edit, delete and assign) entity records in all 
organizations within one OroCRM instance. 

Such permissions are granted to users that have been assigned a role, for which the action access is set to *"System"*.

      |
  
.. image:: ../img/multi_org/multi_org_permission.png
  
.. caution::

    Any other permission setting but *"System"* defined for a role, in a system organization, will be treated as *"None"*.


Choosing an Organization
------------------------

If there are several organizations available to a user, this user can switch between the organizations. To switch to 
another organization, click the selector in the top-left corner and choose the organization.

.. hint::

    The system organization (if any) is shifted left related to the other organizations. The organization you are 
    currently logged into is displayed in bold. 

    |multi_org_choice|

Once a user has chosen a non-system organization, all the new records will be created within this 
organization.

Within a system organization, the user can choose to which organization a new record will belong:

      |

.. image:: ../img/multi_org/multi_org_new_entity.png



.. |multi_org_choice| image:: ../img/multi_org/multi_org_choice.png
