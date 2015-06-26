.. _user-management-organizations:

Organization Records Management
===============================

An Organization record represents a real enterprise, business, firm, company or another organization, to which the 
:term:`users <User>` belong. 

.. _user-management-organization-create:

Create an Organization Record
-----------------------------

.. important::

    Creation of new organizations is only available in the Enterprise Edition. 

In order to create an Organization record:

1. Go to *System → User Management → Organizations*
2. Click the :guilabel:`Create Organization` button
3. Define the general details and the list of users for the organization created, and specify if it is a :ref:`system 
   organization <user-ee-multi-org-system>`:

The following fields **must** be defined 

.. csv-table::
  :header: "**Name**","**Description**"
  :widths: 10, 30

  "**Status**","Current status of the organization.

  *Inactive* or *Active*
  "
  "**Name**","The name used to refer to the organization in the UI. This is  the only mandatory field"
 
You can also add a text description of the organization.
 
.. image:: ./img/user_management/organization_general.png
 
Users
^^^^^
  Check/uncheck the **HAS ORGANIZATION** box, to assign/unassign a user to the organization:

.. note::

    Please note that the "HAS ORGANIZATION" check-box defines if the user is assigned the organization role that you are
    editing/creating.


Additional
^^^^^^^^^^
In the *"Additional"* section, you can define if the organization is a 
:ref:`system organization <user-ee-multi-org-system>`.


View and Manage an Organization Record
--------------------------------------

In the enterprise edition, all the organizations available are displayed in the Organizations 
:ref:`grid <user-guide-ui-components-grid-action-icons>` (*System → User Management → Organizations*).


.. image:: ./img/user_management/organization_action.png

From the grid you can:


- Get to the :ref:`Edit form <user-guide-ui-components-create-pages>` of the organization: |IcEdit|.

- Get to the :ref:`View page <user-guide-ui-components-view-pages>` of the organization: |IcView|.

- Get to the :ref:`configuration settings <admin-configuration>` of the organization: |IcConfig|

In the community edition, you can only edit the organization name and its description. To get to 
the edit page, go to *System → User Management → Organizations*.


.. |IcConfig| image:: ./img/buttons/IcConfig.png
   :align: middle

.. |IcEdit| image:: ./img/buttons/IcEdit.png
   :align: middle

.. |IcView| image:: ./img/buttons/IcView.png
   :align: middle
 