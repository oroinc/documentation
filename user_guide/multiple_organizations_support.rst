.. _user-ee-multi-org:

Organizations
=============

An Organization record represents a real enterprise, business, firm, company or another body using the OroCRM instance. 

In the OroCRM Community Edition there is an only organization, and the only things that can be done to it is you can 
edit the organization name and its description (*System → User Management → Organizations*). Configuration parameters of 
the organization in the Community Edition are always the same as the :ref:`system configuration <admin-configuration>`.

In the OroCRM Enterprise Edition it is possible to create several Organizations. This feature is especially useful if 
different offices or branches of the company are located in different countries and/or time-zones, as a lot of 
configuration settings can be defined separately for each organization. This way, users in different offices will see 
OroCRM in the way best suitable for their location and\or business.

Multiple organizations also enhance the access and permission management capabilities, as you can enable some users to 
see information only within their organizations, and grant others the right to see the details in every campaign. For
example, sales managers working in a specific office will only see the details of customers in their location 
(in the organization they belong to), and employees of the support desk (hot telephone line) need to have access to 
information of all the company's organizations.

There may be any amount of organizations within one OroCRM instance (the system) and one user may belong to several 
organizations.

From this article you will learn why you need a system organization, how to create and manage organizations in the 
system.


.. _user-ee-multi-org-system:

System Organization
-------------------

When an organization is created, you can set it as a **system organization**. 

A system organization enables managing (view, create, edit, delete and assign) entity records in all the company's
organizations. If you want your user to be able to access all the records of some entity, regardless of their 
organization (for example, to enable your support desk to view details of all the customers),
you need to:

- create a system organization ("System Org")

-  :ref:`create a role <user-guide-user-management-roles>` (for example "Support"). 

- set the :ref:`permissions <user-guide-user-management-role-permissions-system>` for the customer entity view to 
  "System"

- for the users that represent your support desk:

  - ref:`assign the role <user-management-users-groups-roles>` "Support", and
  - ref:`assign the organization <user-management-users-access:>` "System"
  
  
.. caution::

    Any other permission setting but *"System"* defined for a role, in a system organization, will be treated as 
    *"None"*.


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

.. image:: ./img/multi_org/multi_org_new_entity.png



.. |multi_org_choice| image:: ./img/multi_org/multi_org_choice.png


.. _user-management-organizations:

Create an Organization
----------------------

In order to create an Organization record:

1. Go to *System → User Management → Organizations*.
2. Click the :guilabel:`Create Organization` button.
3. Define the general details and the list of users for the organization created, and specify if it is a 
   :ref:`system organization <user-ee-multi-org-system>`:

The following fields **must** be defined 

.. csv-table::
  :header: "**Name**","**Description**"
  :widths: 10, 30

  "**Status**","Current status of the organization.

  *Inactive* or *Active.*
  "
  "**Name**","The name used to refer to the organization in the UI. This is  the only mandatory field."
 
You can also add a text description of the organization.
 
      |
  
.. image:: ./img/user_management/organization_general.png
 
Users
^^^^^
  Check/uncheck the **HAS ORGANIZATION** box, to assign/unassign a user to the organization.

.. note::

    Please note that the "HAS ORGANIZATION" check-box defines if the user is assigned the organization that you are
    editing/creating.


Additional
^^^^^^^^^^
In the *"Additional"* section, you can define if the organization is a system organization.


View and Manage an Organization Record
--------------------------------------

All the available organizations are displayed in the Organizations 
:ref:`grid <user-guide-ui-components-grid-action-icons>` (*System → User Management → Organizations*).

      |

.. image:: ./img/user_management/organization_action.png

|

From the grid you can:


- Get to the :ref:`Edit form <user-guide-ui-components-create-pages>` of the organization: |IcEdit|

  On the Edit form you can change the settings defined when creating the organization, such as its name, description,
  list of users, etc.
    
- Get to the :ref:`Configuration settings <admin-configuration-organization>` of the organization: |IcConfig|

- Get to the :ref:`View page <user-guide-ui-components-view-pages>` of the organization: |IcView|
 
  The :guilabel:`Configuration` action button on the View page will get you to the configuration settings of the 
  organization

  
Conclusion
----------

This way, users of the OroCRM enterprise edition can create any number of organizations and define specific 
configuration settings and permissions for each of them.

.. |IcConfig| image:: ./img/buttons/IcConfig.png
   :align: middle

.. |IcEdit| image:: ./img/buttons/IcEdit.png
   :align: middle

.. |IcView| image:: ./img/buttons/IcView.png
   :align: middle
 