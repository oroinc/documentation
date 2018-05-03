.. _configuration--guide--config-levels:

Configuration Levels
^^^^^^^^^^^^^^^^^^^^

.. contents:: :local:

Hierarchy
~~~~~~~~~

In Oro applications, you can manage all settings on multiple configuration layers:

.. image:: /admin_guide/img/landing/Levels.png
   :alt: Configuration layers

Based on the level where configuration has taken place, settings can fall back to other levels following the pattern below:

* :ref:`User settings <doc-my-user-configuration>` can fall back either to :ref:`system <doc-system-configuration>` or :ref:`organization settings <doc-organization-configuration>`.
* :ref:`Website settings <doc-website-configuration>` can fall back to the :ref:`system settings <doc-system-configuration>`.
* :ref:`Organization settings <doc-organization-configuration>` can fall back to the :ref:`system settings <doc-system-configuration>`.


.. image:: /admin_guide/img/landing/ConfigLevels.png
   :alt: A fallback pattern of the configuration levels

However:

* When **Use System** check box is enabled on the configuration page of the required option, system settings override website or organization.
* When **Use Organization** check box is enabled on the configuration page of the required option, organization settings override system.

.. _configuration--guide--config-graphics:

Graphics
~~~~~~~~

By default, all configuration settings are available globally. Whenever you see the |IcOrganizationLevel| organization, |IcWebsiteLevel| website or |IcUserLevel| user icons, this means that the setting is also available on the organization, website, or user level respectively.

.. container:: hidden

   .. image:: /admin_guide/img/landing/system_config.png
      :width: 0px

   .. image:: /admin_guide/img/landing/commerce_config.png
      :width: 0px

   .. image:: /admin_guide/img/landing/crm_config.png
      :width: 0px

   .. image:: /admin_guide/img/landing/marketing_config.png
      :width: 0px

.. User-Level Configuration Settings ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. In OroCommerce, you can configure a number of user-specific settings. In particular, you can set up localization, language, display settings, update email configuration details, provide MS Outlook integration and synchronization settings details, as well as configure customer-visible contact information in the storefront. For more information on each configuration option, follow the links below:

.. include:: /img/buttons/include_images.rst
   :start-after: begin


Layers
~~~~~~

The following reference sections detail configuration settings on the specific configuration level:

.. toctree::
   :includehidden:
   :titlesonly:
   :maxdepth: 1

   global
   org/index
   website
   user