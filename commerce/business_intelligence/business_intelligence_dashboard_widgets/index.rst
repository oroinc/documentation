.. _user-guide--business-intelligence--dashboards:
.. _user-guide--business-intelligence--widgets:
.. _user-guide-dashboards:


Dashboards and Widgets
======================

Dashboard is a default page you see after you log in. It is an adjustable view that may contain many :ref:`types of information blocks (widgets) <user-guide--business-intelligence--widgets--explore>`,
such as today's calendar, recent calls and emails, quick launchpad, etc. You can have several dashboards that serve different purposes and switch between them. 

.. image:: /user_guide/img/business_intelligence/dashboards_0.png

In this section you will learn how to easily customize existing dashboard or create a new one, as well as add and manage widgets in the Oro application.

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

     "**Label**","Name used to refer to the dashboard in the system."
     "**Clone from**","Choose an existing dashboard to be used as a base for a new one. If you want to create a dashboard from the scratch, choose the *Blank Dashboard* option."
     "**Owner**","Limits the list of users who can manage the dashboard to the users, whose roles allow managing dashboards of the owner (e.g. the owner, members of the same business unit, head of the department, etc.)"

#. To save the dashboard, click **Save and Close** on the top right.

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

.. _user-guide--business-intelligence--widgets--explore:

Explore Out-of-the-box Widgets
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Your Oro application comes with a number of out-of-the-box widgets that can simplify the day-to-day sales, marketing and communication activities. These can be broken down into three categories:

.. csv-table::
     :header: "Widgets for Sales and Marketing", "Widgets for Communication", "Universal Widgets"
     :widths: 20, 20, 20

     "
       * :ref:`Leads statistics <user-guide--business-intelligence--widgets--leads-statistics>`
       * :ref:`Opportunity statistics <user-guide--business-intelligence--widgets--opportunity-statistics>`
       * :ref:`Forecast <user-guide--business-intelligence--widgets--forecast>`
       * :ref:`Leads list <user-guide--business-intelligence--widgets--leads-list>`
       * :ref:`Opportunities list <user-guide--business-intelligence--widgets--opportunity-list>`
       * :ref:`Opportunities by status <user-guide--business-intelligence--widgets--opportunity-by-status>`
       * :ref:`Opportunities by lead source <user-guide--business-intelligence--widgets--opportunity-lead-source>`
       * :ref:`Campaign leads <user-guide--business-intelligence--widgets--campaign-leads>`
       * :ref:`Opportunity-generating campaigns <user-guide--business-intelligence--widgets--opportunity-generating-campaigns>`
       * :ref:`Average lifetime sales <user-guide--business-intelligence--widgets--average-lifetime-sales>`
       * :ref:`Purchase funnel <user-guide--business-intelligence--widgets--purchase-funnel>`
       * :ref:`Campaigns by close revenue <user-guide--business-intelligence--widgets--close-revenue>`","                                                                     
       
       * :ref:`Recent emails <user-guide--business-intelligence--widgets--recent-emails>`
       * :ref:`Recent calls <user-guide--business-intelligence--widgets--recent--calls>`","
       
       
       * :ref:`Quick launchpad <user-guide--business-intelligence--widgets--quick-launchpad>`
       * :ref:`Recently accessed contacts <user-guide--business-intelligence--widgets--recently-accessed--contacts>`
       * :ref:`Recently accessed accounts <user-guide--business-intelligence--widgets--recently-accessed-accounts>`
       * :ref:`Today's calendar <user-guide--business-intelligence--widgets--todays-calendar>`"


.. note:: Additional widgets can be added via a third-party system integrations.

.. _user-guide--business-intelligence--widgets--add:

Add Widgets to a Dashboard
^^^^^^^^^^^^^^^^^^^^^^^^^^
  
To add a widget to a dashboard:

#. Navigate to the dashboard (e.g. hover over the |IcDashboard| in the main menu and click the dashboard name).

#. Click **+Add Widget**.

   .. image:: /user_guide/img/business_intelligence/add_widget_button_new.png

#. The page that appears lists all the widgets available in the system which have not been added to the dashboard yet.

   .. image:: /user_guide/img/business_intelligence/dashboards_5_new.png
 
#. To search for a widget, type its name in the search field.

   .. image:: /user_guide/img/business_intelligence/business_sales_channel_statistics.png
  
#. Select the widget that you would like to add and click **Add**.

   .. image:: /user_guide/img/business_intelligence/widgets_list.png

This way you can add the same widgets a number of times and assign them different owners.

.. note:: You can add the same widgets a number of times and assign them different owners.

.. _user-guide--business-intelligence--widgets--manage:

Manage Widgets on a Dashboard
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Widgets can be easily managed and filtered. A number of widgets can be created for various team members. For instance, a sales manager can create the same widgets for each sales rep within the organization to be able to see results of each sales rep’s work.

Manage widgets using the tools in their header:

.. image:: /user_guide/img/business_intelligence/dashboards_6.png

The header of each widget contains:

- The |IcCollapse| Collapse/|IcExpandPlus| Expand button --- If a widget has been collapsed, only its header will be displayed on the dashboard.

- Widget name --- Widget title displayed on the dashboard.

- The |IcMoveArrow| Move button --- Click and hold the button while moving the widget around the dashboard.

- The |IcDelete| Delete button --- delete the widget from the dashboard

- The |IcSettings| Settings button --- Click the button to adjust the widget. See the `Adjust Widget Settings`_ section for the options you can change.

The specified owner, date range and the `territory <https://oroinc.com/doc/orocrm/current/user-guide-sales-tools/b2b-sales/territory-management>`_ (if available for the entity) are displayed at the bottom of the widget:

.. image:: /user_guide/img/business_intelligence/owner_date_terr_displayed.png

Adjust Widget Settings
^^^^^^^^^^^^^^^^^^^^^^

By clicking |IcSettings| in the widget header, you can adjust the following settings:

* **Widget title** --- the name displayed on the dashboard.
* **Business unit** --- select the business unit to present statistics for.
* **Role** --- select the user’s role (e.g. a sales manager, an administrator, a leads development rep, etc.) to see statistics for.
* **Owner** --- select the owner for the widget to see statistics for a certain user.
* **Date range** --- time for which the widget details are displayed.
* **Compare with previous period** --- tick this option if you wish to compare statistics for the current and the previous periods and see it displayed in the dashboard widget.
* Other widget details (depending on widget type).

.. image:: /user_guide/img/business_intelligence/configure_widget2.png

Add, Edit, and Delete a Dashboard
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Manage the widgets via the |IcSettings| **Tools** menu. Hover over the |IcSettings| **Tools** and use one of the following actions:

.. image:: /user_guide/img/business_intelligence/dashboards_8_new.png

- Click |IcEdit| to edit the dashboard.

- Click |Bplus| to create a new dashboard.

- Click |IcDelete| to delete the dashboard from the system.

.. hint::

    You can also perform these actions via the  |IcMore| **More Options** menu from the Dashboards list page (**Dashboards > Manage Dashboards** in the main menu).

    .. image:: /user_guide/img/business_intelligence/dashboards_9.png


.. include:: /img/buttons/include_images.rst
   :start-after: begin

.. toctree::
   :hidden:
   :maxdepth: 1

   leads_statistics
   opportunity_statistics
   average_lifetime_sales
   campaign_leads
   campaigns_by_close_revenue
   forecast
   leads_list
   opportunities_by_lead_source
   opportunities_by_status
   opportunities_list
   opportunity_generating_campaigns
   purchase_funnel
   quick_launchpad
   recent_calls
   recent_emails
   recently_accessed_accounts
   recently_accessed_contacts
   todays_calendar
 
    
    