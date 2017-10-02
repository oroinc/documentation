.. _user-guide-business-to-business-sales:

Business-to-business Sales
==========================

.. This topic covers information about the sales process, steps to follow it, and ways to monitor the sales results in OroCRM:

.. .. contents:: :local:
   :depth: 2

Sales Pipeline in OroCRM
------------------------

A sales pipeline is usually a series of steps taken by a salesperson from the initial contact with a potential customer, to qualifying this customer into a lead, and further converting this lead into a sales opportunity followed through different stages until closed as a sale or lost. To gather detailed information across all stages of this sales funnel, OroCRM provides convenient leads and opportunities management tools. With their help, you can forecast pipelines and ensure sales and marketing goals are on track.

.. image:: ../../img/sales_process/sales_process_diagram.png

.. note:: See a short demo on `how to work with OroCRM sales flow <https://www.orocrm.com/media-library/work-native-orocrm-sales-flow>`_, or keep reading the guidance below.

   .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/nw-lwYJumnM" frameborder="0" allowfullscreen></iframe>

Components
^^^^^^^^^^

In OroCRM, the following key sales components frame the sales process:

1. **Business Customers**

   Business customers represents a point of contact in your sales and business activities. In OroCRM, you can track activities and records associated with them. More information on business customers can be found in the :ref:`Business Customers topic <user-guide-system-channel-entities-business-customer>`.

2. **Leads**

   :ref:`Leads <user-guide-system-channel-entities-leads>` are potential sales represented in a form of contact data. Although they are usually important for the traditional sales pipeline, leads can be enabled or disabled depending on roles or your business requirements. Once enabled, leads are added to **Sales** in the main menu.

   In OroCRM, leads can be created in a few ways. For instance, every person who sends a letter to your email address can be automatically converted into a lead. You can also create a lead manually, or import them from a .CSV file. In addition, every lead can be qualified into an opportunity, or disqualified, if it is clear that the deal is not going to progress. Moreover, when the lead is converted to an opportunity, a contact is automatically created based on lead data, so contact details are still kept in the system for future reference or business intelligence needs.

3. **Opportunities**

   :ref:`Opportunities <user-guide-system-channel-entities-opportunities>` are potential deals. Similar to leads, opportunities can be enabled or disabled subject to company roles or needs. once enabled, they are added to **Sales** in the main menu.

   In OroCRM, opportunities can either be created from scratch, or converted from related entities, such as leads, customers, or accounts. Various   details can be provided for opportunities. For instance, they can be assigned probabilities percentage for each status (e.g. needs analysis,    solution development) tailored to the requirements of your business, or given a budget amount in the currency specific to this particular opportunity. Moreover, a sales rep processing an opportunity can track the history of all deals of a particular customer from their opportunity page. This helps compare past and current opportunities, and use this data to manage ongoing projects for each customer. Opportunities can also be viewed on a Kanban board, and managed through multiple :ref:`workflows <doc--workflows>`.


Workflow
^^^^^^^^

A sales process workflow leads a sales manager step-by-step through the sales process cycle from its start to completion. In your Oro application, such sales process is comprised of the following events:

.. image:: ../../img/sales_process/sales_process_wf.png

Lead Qualification
~~~~~~~~~~~~~~~~~~

A :term:`lead <Lead>` is created as soon as a potential :term:`opportuity <Opportunity>` arises.

As the probability of the deal gets clear, the lead may be disqualified (if it is likely that no deal will be made), or qualified into an opportunity (if the deal probability gets high enough).

.. note:: Disqualified leads can be renewed, if necessary.

If the potential success level is high from the very start, it is also possible to skip the step and create an opportunity.

Opportunity Development
~~~~~~~~~~~~~~~~~~~~~~~

Develop an opportunity as new information appears, for instance, when new agreements are reached or plans are approved.

Opportunity Closure
~~~~~~~~~~~~~~~~~~~

Any opportunity, developed or not, may be closed either as won or lost, subject to the deal outcome. A closed opportunity can be reopened, which will result in creation of a new opportunity.

Sales and Business Intelligence Tools
-------------------------------------

Reports
^^^^^^^

To analyze your sales cycle performance and track your goals, OroCRM provides flexible reporting tools. You can find more information on built-in and custom reports in the relevant :ref:`Reports topic <user-guide-reports>`.

Sales Widgets
^^^^^^^^^^^^^

Specifically for business sales, there are a number of :ref:`dashboard widgets <user-guide-widgets>` available that can simplify day-to-day sales process activities. These widgets give concise overview on what is happening with the sales at any point in time. More information on Sales Widgets can be found in the :ref:`Sales Widgets <doc-widgets-sales>` topic.

Workflows
^^^^^^^^^

You can use OroCRM’s workflows to define rules and guidelines on possible actions for leads and opportunities in the system. New customer-specific workflows can also be created, as described in the :ref:`Workflows topic <doc--workflows>`.

Sales Territories
^^^^^^^^^^^^^^^^^

In your Oro application, you can group customer accounts based on a defined set of criteria. This is called territory management, and it is available for leads, opportunities and all types of customers. With Sales Territories you can define territories for leads, opportunities, and any customer type, organize and balance the workload of sales teams, filter data by territory via the dashboard widget, etc. More information on sales territories can be found in the :ref:`Territories Management topic <user-guide-territories>`.

Further Reading
---------------

* :doc:`/user_guide_sales_tools/b2b_sales/business_customers`
* :doc:`/user_guide_sales_tools/b2b_sales/leads`
* :doc:`/user_guide_sales_tools/b2b_sales/opportunities/index`
* :doc:`/user_guide_sales_tools/b2b_sales/territory_management`

.. toctree::
    :hidden:
    :maxdepth: 1


    business_customers
    leads
    opportunities/index
    territory_management