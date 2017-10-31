.. _configuration--guide--landing--page:

Configuration Guide
===================

Oro Configuration Guide will walk your though all post-install configuration settings of the Oro application. In particular, you will learn how to set up general system configuration options, as well as settings specific for OroCommerce, OroCRM, and marketing.

.. raw:: html

   <div class="guideline">
      <div class="guideline__item" style="background-color: #FFFFFF">
          <div style="text-align: center">
          <h3>
          <img src="https://www.orocommerce.com/wp-content/uploads/sites/3/documentation/orocommerce/documentation/current/system_config.png" alt="SystemConfig">
            <a class="reference internal" href="system_configuration#configuration-guide-system-configuration"><span class="std std-ref">System Configuration</span></a></h3>
            </div>
          <div style="overflow: hidden;margin: 0 auto;width: 100%;height:100%;text-align: left">
          </div>
      </div>

      <div class="guideline__item" style="background-color: #FFFFFF">
          <div style="text-align: center">
          <h3>
          <img src="https://www.orocommerce.com/wp-content/uploads/sites/3/documentation/orocommerce/documentation/current/commerce_config.png" alt="CommerceConfig">
          <a class="reference internal" href="commerce#configuration-guide-commerce-configuration"><span class="std std-ref">Commerce Configuration</span></a></h3>
          </div>
          <div style="overflow: hidden;margin: 0 auto;width: 100%;height:100%;text-align: left">
          </div>
      </div>

      <div class="guideline__item" style="background-color: #FFFFFF">
          <div style="text-align: center">
          <h3>
          <img src="https://www.orocommerce.com/wp-content/uploads/sites/3/documentation/orocommerce/documentation/current/crm_config.png" alt="CRMConfig">
          <a class="reference internal" href="crm#configuration-guide-crm-configuration"><span class="std std-ref">CRM Configuration</span></a></h3>
          </div>
          <div style="overflow: hidden;margin: 0 auto;width: 100%;height:100%;text-align: left">
          </div>
      </div>

      <div class="guideline__item" style="background-color: #FFFFFF">
          <div style="text-align: center">
          <h3>
          <img src="https://www.orocommerce.com/wp-content/uploads/sites/3/documentation/orocommerce/documentation/current/marketing_config.png" alt="MarketingConfig">
           <a class="reference internal" href="marketing#configuration-guide-marketing-configuration"><span class="std std-ref">Marketing Configuration</span></a></p></h3>
          </div>
          <div style="overflow: hidden;margin: 0 auto;width: 100%;height:100%;text-align: left">
          </div>
      </div>
   </div>

Configuration Levels
--------------------

In Oro applications, you can manage all settings on multiple configuration layers:

.. image:: /configuration_guide/img/landing/Levels.png

Based on the level where configuration has taken place, settings can fall back to other levels following the pattern below:

* User settings can fall back either to system or organization settings.
* Website settings can fall back to the system settings.
* Organization settings can fall back to the system settings.

.. image:: /configuration_guide/img/landing/ConfigLevels.png

However:

* When **Use System** check box is enabled on the configuration page of the required option, system settings override website or organization.
* When **Use Organization** check box is enabled on the configuration page of the required option, organization settings override system.

Configuration Level Graphics
----------------------------

By default, all configuration settings are available globally. Whenever you see the |IcOrganizationLevel| organization, |IcWebsiteLevel| website or |IcUserLevel| user icons, this means that the setting is also available on the organization, website or user level respectively.  

.. container:: hidden

   .. image:: ./img/landing/system_config.png
      :width: 0px

   .. image:: ./img/landing/commerce_config.png
      :width: 0px

   .. image:: ./img/landing/crm_config.png
      :width: 0px

   .. image:: ./img/landing/marketing_config.png
      :width: 0px

.. toctree::
   :includehidden:
   :titlesonly:
   :maxdepth: 1

   system_configuration/index
   commerce/index
   crm/index
   marketing/index
     

.. include:: /user_guide/include_images.rst
   :start-after: begin









