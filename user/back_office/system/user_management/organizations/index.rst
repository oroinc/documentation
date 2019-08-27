.. _user-management-organizations:
.. _user-ee-multi-org:
.. _user-ee-multi-org-system:

Organizations
=============

An organization represents a real enterprise, business, firm, company or another organization, to which users belong. In the Community Edition of Oro applications, only one organization is available in the system, and you cannot create more.

In the Enterprise edition of Oro applications, you can :ref:`create <user-management-organization-create>` as many organizations as needed with any number of child business units within the application instance. A single user can belong to several different organization.

For example, one company can run three different stores under a franchise license. In the Oro application, each store can be an organization to isolate data managed by the unrelated business partners. Users within the organization would only see records that are relevant to their organization. However, the franchise owner could have access to all organizations to gather aggregated customer or order information. To enable that, the global organization should be created in the the Oro application.

.. note:: In the Oro application, you can have only one global organization. Users in the global organization, given they have the **Global** access levels in their role, can access and control all system data in all organizations within one instance of the application.

If you have access to more than one organization, you can switch between them using the selector on the top left.

.. image:: /user/img/system/user_management/organization_selector.png
   :alt: Organization switcher

.. note:: The global organization is shifted to the left. The organization you are currently logged into is in bold.

When creating a new record in the global organization, you first need to select the organization this record should belong to. Once the organization is selected, you can proceed to the usual record creation flow.

.. |multi_org_choice| image:: /user/img/system/user_management/multi_org_choice.png


.. note:: See a short demo on |how to create organizations and business units|, or keep reading the topics below.

   .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/_PpE536CQ9c" frameborder="0" allowfullscreen></iframe>


.. toctree::
   :maxdepth: 1

   create
   manage
   organization_all_products_menus
   organization_frontend_menus
   org_configuration/index

.. include:: /include/include_links.rst
   :start-after: begin
