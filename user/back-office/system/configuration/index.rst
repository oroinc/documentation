:oro_documentation_types: OroCRM, OroCommerce

.. _mc-system-configuration:

Global Configuration Settings
=============================

.. note:: OroCommerce version 4.2.5 saw the addition of two new configuration levels - customer group and customer. Please see the diagram below for reference.

Settings under the **System > Configuration** menu enable you set up your Oro application specifically to your business needs. Settings located here are :ref:`system-wide (or global) <doc-system-configuration>`. Configuring these settings globally means that they are by default applied throughout all organizations, websites and users in your system. This is the base configuration level and you can customize some of its options :ref:`per organization <doc-organization-configuration>`, :ref:`website <doc-website-configuration>`, or :ref:`user <doc-my-user-configuration>` later on. Selected settings are also available on :ref:`customer group <user-guide--customer-groups--customer-settings>` and :ref:`customer <user-guide--customers--customer-settings>` levels.

Based on the level where configuration has taken place, settings can fall back to other levels following the pattern below:

* :ref:`User settings <doc-my-user-configuration>` fall back to the :ref:`organization settings <doc-organization-configuration>`.
* :ref:`Website settings <doc-website-configuration>` fall back to the :ref:`organization settings <doc-organization-configuration>`.
* :ref:`Organization settings <doc-organization-configuration>` fall back to the :ref:`system settings <configuration--guide--system--configuration>`.
* :ref:`Customer Group settings <user-guide--customer-groups--customer-settings>` fall back to the :ref:`website settings <doc-website-configuration>`.
* :ref:`Customer <user-guide--customers--customer-settings>` settings fall back to the :ref:`customer group settings <user-guide--customer-groups--customer-settings>`.

.. image:: /user/img/system/configuration/ConfigLevels.png
   :align: center
   :scale: 95%
   :alt: A fallback pattern of the configuration levels

Be aware that:

* When **Use System** check box is enabled on the configuration page of the required option, system settings override website or organization. Clearing this check box next to the required option and changing its value means that you are configuring this particular option specifically for the selected organization.

  .. image:: /user/img/system/configuration/system_checkbox.png
     :alt: Organization configuration settings

* When **Use Organization** check box is enabled on the configuration page of the required option, organization settings override system. Clearing this check box next to the required option and changing the default value means that your are introducing changes for a specific user.

  .. image:: /user/img/system/configuration/org_checkbox.png
     :alt: User configuration settings

* When **Use Website** check box is enabled on the configuration page of the required option, website settings prevail. Clearing this check box next to the required option and changing the default value means that you are introducing changes for a specific customer group.

  .. image:: /user/img/system/configuration/website-check-box.png
     :alt: Customer group configuration settings

* When **Use Customer Group** check box is enabled on the configuration page of the required option, customer group settings prevail. Clearing this check box box next to the required option and changing the default value means you are introducing changes at customer level.

  .. image:: /user/img/system/configuration/customer-group-checkbox.png
     :alt: Customer configuration settings

.. hint:: To help you find the specific configuration option faster, use :ref:`Quick Search <user-guide--system-configuration--quick-search>` located in the configuration panel on the left (on all configuration levels).

            .. image:: /user/img/system/configuration/quick_search.png
               :class: with-border
               :alt: Quick search under System Configuration


.. toctree::
   :hidden:
   :maxdepth: 5
   :titlesonly:

   System Configuration <system/index>
   CRM Configuration <crm/index>
   Commerce Configuration <commerce/index>
   Marketing Configuration <marketing/index>
   quick-search
