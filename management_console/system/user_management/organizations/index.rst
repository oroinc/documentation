.. _user-management-organizations:
.. _user-ee-multi-org:
.. _user-ee-multi-org-system:

Organizations
=============

.. contents:: :local:
   :depth: 1

An organization represents a real enterprise, business, firm, company or another organization, to which users belong. In |oro_application| Community Edition, only one organization is available in the system, and you cannot create more.

In |oro_application| Enterprise edition, you can :ref:`create <user-management-organization-create>` as many organizations as needed with any number of child business units within the application instance. A single user can belong to several different organization.

For example, one company can run three different stores under a franchise license. In |oro_application|, each store can be an organization to isolate data managed by the unrelated business partners. Users within the organization would only see records that are relevant to their organization. However, the franchise owner could have access to all organizations to gather aggregated customer or order information. To enable that, the global organization should be created in the |oro_application|.

.. note:: In |oro_application|, you can have only one global organization. Users in the global organization, given they have the **Global** access levels in their role, can access and control all system data in all organizations within one instance of the application.

If you have access to more than one organization, you can switch between them using the selector on the top left.

.. image:: /admin_guide/img/user_management/organization_selector.png

.. note:: The global organization is shifted to the left. The organization you are currently logged into is in bold.

When creating a new record in the global organization, you first need to select the organization this record should belong to. Once the organization is selected, you can proceed to the usual record creation flow.

.. |multi_org_choice| image:: /admin_guide/img/multi_org/multi_org_choice.png

.. note:: See a short demo on `how to create organizations and business units <https://www.orocrm.com/media-library/create-organizations-and-business-units>`_, or keep reading the topics below.

   .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/_PpE536CQ9c" frameborder="0" allowfullscreen></iframe>


.. include:: /img/buttons/include_images.rst
   :start-after: begin


.. |oro_application| replace:: OroCommerce

.. toctree::

   create
   configuration_organization