.. _user-guide--business-intelligence--widgets--explore:

:oro_documentation_types: OroCRM, OroCommerce

Widgets
=======

Oro applications come with a number of out-of-the-box widgets that can simplify the day-to-day sales, marketing and communication activities. These can be broken down into three categories:

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
--------------------------

To add a widget to a dashboard:

#. Click **+Add Widget** on the page of a selected dashboard.
#. Select the widget from the list and click **Add**.
#. To search for a widget, type its name in the search field.

You can add the same widgets a number of times and assign them different owners.

.. _user-guide--business-intelligence--widgets--manage:

Manage Widgets on a Dashboard
-----------------------------

You can easily create and manage widgets for various team members. For instance, as a a sales manager can create the same widgets for each sales rep within the organization to be able to see results of each sales rep’s work.

You can manage widgets using tools in their header:

.. image:: /user/img/dashboards/dashboards_6.png
   :alt: Widget tools

* |IcCollapse| Collapse or |IcExpandPlus| Expand it. If a widget has been collapsed, only its header is displayed on the dashboard.
* Move the widget by clicking on the widget's header, holding the |IcMoveArrow| button and placing the widget in the desired location on the dashboard.
* |IcDelete| Delete delete the widget from the dashboard
* Open widget settings menu |IcSettings| to configure the widget. See the `Configure Widgets`_ section for the options you can change.

The specified owner, date range and the |territory| (if available) are displayed at the bottom of the widget.

Configure Widgets
-----------------

To configure a widget, click |IcSettings| **Configure** in the widget header and adjust the required settings. Please note that configuration settings for different widgets are not the same.

* **Widget title** --- the name displayed on the dashboard.
* **Business unit** --- Select the business unit to display the statistics for.
* **Role** --- Select the role of the used for which you would like to see the statistics (e.g. a sales manager, an administrator, a leads development rep, etc.).
* **Owner** --- Select the owner for the widget to see statistics for a particular user.
* **Date range** --- The time period for which the widget details are displayed.
* **Compare with previous period** --- Select this option if you wish to compare statistics for the current and the previous periods and have it displayed in the dashboard widget.
* Other widget details (depending on widget type).

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-links.rst
   :start-after: begin

.. toctree::
   :hidden:
   :maxdepth: 1

   leads-statistics
   opportunity-statistics
   average-lifetime-sales
   campaign-leads
   campaigns-by-close-revenue
   ecommerce-statistics
   forecast
   leads-list
   opportunities-by-lead-source
   opportunities-by-status
   opportunities-list
   opportunity-generating-campaigns
   purchase-funnel
   quick-launchpad
   recent-calls
   recent-emails
   recently-accessed-accounts
   recently-accessed-contacts
   todays-calendar


