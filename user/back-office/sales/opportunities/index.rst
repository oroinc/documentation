:oro_documentation_types: OroCRM

.. _user-guide-system-channel-entities-opportunities:

Opportunities
=============

:term:`Opportunities <Opportunity>` are highly probable potential or actual sales to a new or established customer. Request for proposal, invitation for a bidding, agreement of intentions or order for a delivery can be saved as opportunities. These are a universal sales tracking tool that can be related to virtually any customer type.

Similar to leads, opportunities can be enabled or disabled subject to company roles or needs. once enabled, they are added to Sales in the main menu.

In Oro applications, opportunities can either be created from scratch, or converted from related entities, such as leads, customers, or accounts. Various details can be provided for opportunities. For instance, they can be assigned probabilities percentage for each status (e.g. needs analysis, solution development) tailored to the requirements of your business, or given a budget amount in the currency specific to this particular opportunity. Moreover, a sales rep processing an opportunity can track the history of all deals of a particular customer from their opportunity page. This helps compare past and current opportunities, and use this data to manage ongoing projects for each customer. Opportunities can also be viewed on a Kanban board, and managed through multiple workflows.

.. In this topic, you will learn how to:

.. :ref:`Enable <user-guide-system-channel-entities-opportunities--enable>`, :ref:`create <user-guide-system-channel-entities-opportunities--create-intro>` and :ref:`manage <user-guide-system-channel-entities-opportunities--manage-intro>` opportunities
.. :ref:`Manage opportunity workflow <user-guide-system-channel-entities-opportunities--manage-flow-intro>`
.. Work with :ref:`reports for opportunities <user-guide-opportunities-reports-intro>`

.. note:: See a short demo on |how to create and work with opportunities|, or keep reading the step-by-step guidance below.

   .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/662N4sMvyvc" frameborder="0" allowfullscreen></iframe>

.. hint:: Before you work with opportunities, make sure they are enabled in the application. To learn how to do it, see the :ref:`System topic <configuration--guide--crm--configuration>`.

.. _user-guide-system-channel-entities-opportunities--enable:

.. Enable Opportunities--------------------
.. You can enable (or disable) an opportunity manually the following way:
.. Navigate to **Settings>Configuration** in the main menu.
.. Open **CRM>Sales Pipeline** in the left menu and click :guilabel:`Opportunity`.
.. In the **General Setup** section, check the **Enable Opportunity** box.
.. Enabling opportunity as a feature adds the opportunity entity to **Sales** in the main menu.
.. .. image:: /user/img/sales/opportunities/enable_opportunity.jpg
.. .. note:: Please refer to your administrator if you have insufficient permissions to enable/disable opportunities in your application.


.. BCrLOwnerClear| image:: /user/img/buttons/BCrLOwnerClear.png
   :align: middle

.. include:: /include/include-images.rst
   :start-after: begin

.. toctree::
   :maxdepth: 1
   :titlesonly:

   create
   manage
   import
   export
   flows
   multi-currency
   reports


.. include:: /include/include-links.rst
   :start-after: begin
