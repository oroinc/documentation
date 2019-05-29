.. _mc-system-configuration:

Configuration
=============

Settings under the **System > Configuration** menu enable you set up your Oro application specifically to your business needs. Settings located here are :ref:`system-wide (or global) <doc-system-configuration>`. Configuring these settings globally means that they are by default applied throughout all organizations, websites and users in your system. This is the base configuration level that you can customize :ref:`per organization <doc-organization-configuration>`, :ref:`website <doc-website-configuration>`, or :ref:`user <doc-my-user-configuration>` later on.

Based on the level where configuration has taken place, settings can fall back to other levels following the pattern below:

* :ref:`User settings <doc-my-user-configuration>` can fall back to the :ref:`organization settings <doc-organization-configuration>`.
* :ref:`Website settings <doc-website-configuration>` can fall back to the :ref:`organization settings <doc-organization-configuration>`.
* :ref:`Organization settings <doc-organization-configuration>` can fall back to the :ref:`system settings <configuration--guide--system--configuration>`.

.. image:: /user_doc/img/system/configuration/ConfigLevels.png
   :alt: A fallback pattern of the configuration levels

However:

* When **Use System** check box is enabled on the configuration page of the required option, system settings override website or organization. Clearing this check box next to the required option and changing its value means that you are configuring this particular option specifically for the selected organization.

  .. image:: /user_doc/img/system/configuration/system_checkbox.png

* When **Use Organization** check box is enabled on the configuration page of the required option, organization settings override system. Clearing this check box next to the required option and changing the default value means that your are introducing changes for a specific user.

  .. image:: /user_doc/img/system/configuration/org_checkbox.png

.. hint:: By default, all configuration settings are available globally. Whenever you see the |IcOrganizationLevel| organization, |IcWebsiteLevel| website or |IcUserLevel| user icons, this means that the setting is also available on the organization, website, or user level respectively.

.. hint:: To help you find the specific configuration option faster, use :ref:`Quick Search <user-guide--system-configuration--quick-search>` located in the configuration panel on the left (on all configuration levels).

            .. image:: /user_doc/img/system/configuration/quick_search.png
               :class: with-border
               :alt: Quick search under System Configuration

.. include:: /user_doc/img/buttons/include_images.rst
   :start-after: begin

.. toctree::
   :hidden:
   :maxdepth: 5
   :titlesonly:

   system/index
   crm/index
   commerce/index
   marketing/index
   quick_search
