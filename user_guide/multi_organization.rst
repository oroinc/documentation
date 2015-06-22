.. _user-ee-multi-org:

Multiple Organizations Support
==============================

OroCRM Enterprise Edition supports :ref:`creation <user-management-organization-create>` of multiple organization within 
one OroCRM instance.
There may be any amount of organization within one OroCRM instance (the system) and one user may belong to several 
organizations.


.. _user-ee-multi-org-system:

System Organization
-------------------

When an organization is created, you can define if it is a **system organization**. 

While non-system organization represent separate organization and access and permissions to them are defined as 
described in the :ref:`Access and Permissions Management guide <user-guide-user-management-permissions>`, system 
organizations provide ability to manage (view, create, edit, delete and assign) entity records in different 
organizations within one OroCRM instance. 

Such permissions are granted to users assigned a role, for which the action is access is set to *"System"*.

.. image:: ./img/multi_org/multi_org_permission.png
  
.. caution::

    Any other permission setting but *"System"* for a role in a system organization will be treated as *"None"*.


Choosing an Organization
------------------------

If there are several organizations available to the user, this user can switch between the organizations. To switch to 
another organization, click the selector in the top left corner and choose the organization.

.. hint::

    The system organization (if any) is moved left related to the other organizations. The current organization 
    is displayed in bold. 

    |multi_org_choice|

Once a user has chosen a non-system organization, all the records created will be created within this 
organization.

Within a system organization, the user can choose to what organization a new entity record will belong:

.. image:: ./img/multi_org/multi_org_new_entity.png



.. |multi_org_choice| image:: ./img/multi_org/multi_org_choice.png
