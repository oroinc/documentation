.. _user-guide-dashboards:

Dashboards
==========

.. include:: /old_version_notice.rst
   :start-after: begin_old_version_notice

Dashboard is an adjustable view that contains a number of widgets, such as today's calendar, recent calls and emails, 
quick launchpad etc. 
Within one OroCRM instance you can create several dashboards for different purposes and switch between them.

Create a Dashboard
------------------

To create a dashboard:

- Go to the Dashboards section (in the Desktop UI it is signed with the icon |IcDashboard|) and select *"Manage 
  Dashboards"*.
  
- Click the :guilabel:`Create Dashboard` button in the top right corner of the grid.

- The *"Create Dashboard"* form will emerge.

The following fields are mandatory and **must** be specified:

.. csv-table::
  :header: "Field", "Description"
  :widths: 10, 30

  "**Label**","Name used to refer to the dashboard in the system"
  "**Clone from**","Choose an existing dashboard to be used as a base for a new one. 
  
  This is convenient, if two dashboard don't differ much or if one of them is an extended version of another one (e.g.
  a dashboard sharpened for the aims of a usual sales manager and for the head of the sales department). 

  If you want to create the dashboard from the scratch, choose the option *Blank Dashboard*."
  "**Owner**","Limits the list of users that can manage the dashboard to the users,  whose 
  :ref:`roles <user-guide-user-management-permissions>` allow managing dashboards of the owner (e.g. the owner, 
  members of the same business unit, head of the department, etc.)."

To save the dashboard, click the button in the top right corner of the page. 

It has been added to the system.

Initially, the dashboard will contain all the widgets of the dashboard it has been cloned from. (Dashboards cloned 
from the Blank Dashboard will be empty).

      |

.. image:: /user_guide/img/dashboards/blank_dashboard.png


Manage Dashboard
----------------

Switch Between Dashboards
^^^^^^^^^^^^^^^^^^^^^^^^^

You can switch to a dashboard in one of the two ways:

- Use the drop-down menu under the Dashboards section
 
  |SectionDropD|

|
  
- Use the drop-down menu in the header of the Dashboard page.
 
  |HeaderDropD|

|
  
Add Widgets to a Dashboard
^^^^^^^^^^^^^^^^^^^^^^^^^^

      |
  
In order to add a widget to a Dashboard:

- Get to the Dashboard to which the Dashboard should be added

- Click the :guilabel:`+ Add Widget` button. 

- The drop-down will appear. 

  It contains all the widgets available in the system and haven't been added to the dashboard yet.

  For each widget you can see its name and brief description:

      |
  
|WidgetList|

|
  
- Choose the widget that you want to add and click the :guilabel:`Add` button.

.. note::

    There is a number of dashboards pre-implemented in OroCRM out-of-the-box. Additional widgets can be added in the 
    course of the system integration.

  
Manage Widgets on a Dashboard
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

      |

You can manage widgets, using tools in their header:

      |
 
.. image:: /user_guide/img/dashboards/header.png

|

The header of each widget (above) contains (from left to right):

- Collapse/Expand button: if a widget has been collapsed, only its header will be displayed on the dashboard.

- Widget name: widget title displayed on the dashboard.

- Move button: click the button and hold the mouse button, to move the widget around the dashboard.

- Settings button: click the button to adjust the widget. You can change:

  - Widget title: the name displayed on the dashboard.
  
  - Date range: time for which the widget details are displayed.
  
  - Other widget details if any.

      |  
  
|ManageWidget|


Dashboard Tools
^^^^^^^^^^^^^^^

      |

Instead of action icons of the grids, dashboard view has tools. 

      |

.. image:: /user_guide/img/dashboards/dashboard_tools.png

| 

- Get to the :ref:`Edit form <user-guide-ui-components-create-pages>` of the dashboard: |IcEdit| 

- Delete the dashboard from the system: |IcDelete| 

- Get to the Create form of the dashboard: |Bplus| 

.. hint::

    You can also perform these actions from the Dashboards grid (*Dashboards → Manage Dashboards*)

    |DActionIcons|



.. |IcDelete| image:: /img/buttons/IcDelete.png
   :align: middle

.. |IcEdit| image:: /img/buttons/IcEdit.png
   :align: middle

.. |IcView| image:: /img/buttons/IcView.png
   :align: middle
   
.. |Bplus| image:: /img/buttons/Bplus.png
   :align: middle
   
.. |IcBulk| image:: /img/buttons/IcBulk.png
   :align: middle
   
.. |IcDashboard| image:: /img/buttons/IcDashboard.png
   :align: middle   

.. |SectionDropD| image:: /user_guide/img/dashboards/section_dd.png
   :align: middle   
   
.. |HeaderDropD| image:: /user_guide/img/dashboards/header_dd.png
   :align: middle   
   
.. |WidgetList| image:: /user_guide/img/dashboards/widget_list.png
   :align: middle      

.. |ManageWidget| image:: /user_guide/img/dashboards/manage_widget.png
   :align: middle 
   
.. |DActionIcons| image:: /user_guide/img/dashboards/dashboard_action_icons.png
   :align: middle 
