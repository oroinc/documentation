.. _user-guide--business-intelligence--dashboards:

.. TODO rework legacy information. Status: 0% done

Dashboards
==========

Dashboard is a default page you see after you log in. It is an adjustable view that may contain many types of information blocks (widgets),
such as today's calendar, recent calls and emails, quick launchpad, etc. You can have several dashboards that serve different purposes and switch between them.

.. image:: /user_guide/img/business_intelligence/dashboards_0.png

In this section you will learn how to easily customize existing dashboard or create a new one.

.. contents:: :local:


Create a Dashboard
------------------

To create a dashboard:

#. Hover over the |IcDashboard| in the main menu and click **Manage Dashboards**.
  
#. Click **Create Dashboard** on the top right of the page.

   The following page appears:

   .. image:: /user_guide/img/business_intelligence/dashboards_1.png

   The following fields are mandatory and **must** be specified:

   .. csv-table::
     :header: "Field", "Description"
     :widths: 10, 30

     "**Label**","Name used to refer to the dashboard in the system"
     "**Clone from**","Choose an existing dashboard to be used as a base for a new one.
     This is convenient, if two dashboards don't differ much, or if one of them is an extended version of the other one (e.g.a dashboard sharpened for the aims of a usual sales manager and for the head of the sales department).
     If you want to create the dashboard from the scratch, choose the option *Blank Dashboard*."
     "**Owner**","Limits the list of users who can manage the dashboard to the users, whose roles allow managing dashboards of the owner (e.g. the owner, members of the same business unit, head of the department, etc.)."

#. To save the dashboard, click **Save and Close** in the top right corner.

Initially, the dashboard contains all the widgets of the dashboard it has been cloned from. Dashboards cloned from the Blank Dashboard will be empty.

.. image:: /user_guide/img/business_intelligence/dashboards_2.png

Manage Dashboard
----------------

Switch Between Dashboards
^^^^^^^^^^^^^^^^^^^^^^^^^

You can switch to a dashboard in one of the two ways:

- Hover over the |IcDashboard| in the main menu and click the dashboard name.
 
  .. image:: /user_guide/img/business_intelligence/dashboards_3.png
  
- Toggle dashboards in the header of the Dashboard page.

   .. image:: /user_guide/img/business_intelligence/dashboards_4.png

Add Widgets to a Dashboard
^^^^^^^^^^^^^^^^^^^^^^^^^^
  
To add a widget to a Dashboard:

#. Navigate to the dashboard (e.g. hover over the |IcDashboard| in the main menu and click the Dashboard name).

#. Click **+ Add Widget**.

#. The page that appears lists all the widgets available in the system which have not been added to the dashboard yet.

  .. image:: /user_guide/img/business_intelligence/dashboards_5.png
  
#. Select the widget that you would like to add and click **Add**.

.. note::

    There is a number of dashboards in OroCommerce out-of-the-box. Additional widgets can be added via the third-party system integration.

Manage Widgets on a Dashboard
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Manage widgets using the tools in their header:

.. image:: /user_guide/img/business_intelligence/dashboards_6.png

The header of each widget contains:

- The |IcCollapse| Collapse/|IcExpandPlus| Expand button --- If a widget has been collapsed, only its header will be displayed on the dashboard.

- Widget name --- Widget title displayed on the dashboard.

- The |IcMoveArrow| Move button --- Click and hold the button while moving the widget around the dashboard.

- The |IcSettings| Settings button --- Click the button to adjust the widget. You can change:

  - Widget title --- The name displayed on the dashboard.
  
  - Date range --- Time period that the widget should collect and display data for.
  
  - Other widget details (if any).

    .. image:: /user_guide/img/business_intelligence/dashboards_7.png

Add, Edit, and Delete a Dashboard
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Manage the widgets via the |IcSettings| **Tools** menu. Hover over the |IcSettings| **Tools** and use one of the following actions:

.. image:: /user_guide/img/business_intelligence/dashboards_8.png

- Click |IcEdit| to edit the dashboard.

- Click |Bplus| to create a new dashboard.

- Click |IcDelete| to delete the dashboard from the system.

.. hint::

    You can also perform these actions via the  |IcMore| **More Options** menu from the Dashboards list page (**Dashboards → Manage Dashboards** in the main menu).

    .. image:: /user_guide/img/business_intelligence/dashboards_9.png


.. include:: /user_guide/include_images.rst
   :start-after: begin