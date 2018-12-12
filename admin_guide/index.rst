.. _user-guide-admin-tools:

Administrator Guide
===================

Administration
--------------

This section groups the guidance and reference information on hardware and software configuration for Oro application components, users and role management (including the data and access level restrictions), and system monitoring tools.

.. raw:: html

   <div class="guideline">

      <div class="guideline__item" >
          <div style="text-align: center">
          <h3>
          <a class="reference internal" href="op-structure"><span class="std std-ref"><i class="fa fa-wrench fa-lg" aria-hidden="true"></i><br>System Components Administration</span></a></h3>
          </div>
          <div style="overflow: hidden;margin: 0 auto;width: 100%;height:100%;text-align: left">
          </div>
      </div>

      <div class="guideline__item" >
          <div style="text-align: center">
          <h3>
          <a class="reference internal" href="user-management"><span class="std std-ref"><i class="fa fa-users fa-lg" aria-hidden="true"></i><br>User, Role and Access Management</span></a></h3>
          </div>
          <div style="overflow: hidden;margin: 0 auto;width: 100%;height:100%;text-align: left">
          </div>
      </div>

      <div class="guideline__item" >
          <div style="text-align: center">
          <h3>
          <a class="reference internal" href="monitoring"><span class="std std-ref"><i class="fa fa-heartbeat fa-lg" aria-hidden="true"></i><br>Monitoring and Healthcheck</span></a></h3>
          </div>
          <div style="overflow: hidden;margin: 0 auto;width: 100%;height:100%;text-align: left">
          </div>
      </div>

   </div>


Fundamental Configuration Settings
----------------------------------

The Configuration section of Administrator Guide walks your through all post-install configuration settings of the Oro application. In particular, you will learn how to set up general system configuration options, as well as settings specific for CRM and marketing.

.. See a short video on using configuration options and orienting in the configuration guide:
.. .. raw:: html

.. <iframe width="560" height="315" src="https://www.youtube.com/embed/BxyzaOXwo0k" frameborder="0" allowfullscreen></iframe>

Settings in Oro application can be managed on multiple configuration levels. Throughout the configuration guide, these levels are marked with the corresponding icons to help you navigate through the settings which are accessible via the **System > Configuration** menu and **Configuration** menu of the organization and user.

.. raw:: html

   <div class="guideline">
      <div class="guideline__item" >
          <div style="text-align: center">
            <a class="reference internal" href="config-levels">
                <h3><i class="guideline__icon fa fa-cogs fa-lg"></i><br>Configuration <br>Levels</h3>
            </a>
          </div>
          <div style="overflow: hidden;margin: 0 auto;width: 100%;height:100%;text-align: left">
               <ul class="guideline__list">
                   <li><a class="reference internal" href="config-levels/global">Global Configuration</a></li>
                   <li><a class="reference internal" href="config-levels/org">Organization Configuration</a></li>
                   <li><a class="reference internal" href="config-levels/user">User Configuration</a></li>
                </ul>
          </div>
      </div>

      <div class="guideline__item" >
          <div style="text-align: center">
            <h3><i class="guideline__icon fa fa-sitemap"></i><br>Domain-specific <br>Groups of Settings</h3>
          </div>
          <div style="overflow: hidden;margin: 0 auto;width: 100%;height:100%;text-align: left">
               <ul class="guideline__list">
                   <li><a class="reference internal" href="landing-crm#configuration-guide-crm-configuration">CRM Configuration</a></li>
                   <li><a class="reference internal" href="landing-marketing#configuration-guide-marketing-configuration">Marketing Configuration</a></li>
                </ul>
          </div>
      </div>
   </div>

Advanced Configuration Settings
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This section provides a reference for the settings accessible via the **System** menu (other than **System > Configuration**).

.. raw:: html

   <div class="guideline">
      <div class="guideline__item" >
          <div style="text-align: center">
            <h3><i class="guideline__icon fa fa-globe"></i><br>System <br>Customization</h3>
          </div>
          <div style="overflow: hidden;margin: 0 auto;width: 100%;height:100%;text-align: left">
               <ul class="guideline__list">
                   <li><a class="reference internal" href="workflows">Workflows</a></li>
                   <li><a class="reference internal" href="localization">Localization and Translations</a></li>
                   <li><a class="reference internal" href="menu">Menus Configuration</a></li>
                   <li><a class="reference internal" href="multi-currency">Multi-Currency</a></li>
                </ul>
          </div>
      </div>

      <div class="guideline__item" >
          <div style="text-align: center">
            <h3><i class="guideline__icon fa fa-gear"></i><br>Other <br>Configuration</h3>
          </div>
          <div style="overflow: hidden;margin: 0 auto;width: 100%;height:100%;text-align: left">
               <ul class="guideline__list">
                   <li><a class="reference internal" href="integrations">Integrations</a></li>
                   <li><a class="reference internal" href="entities">Entity Management</a></li>
                   <li><a class="reference internal" href="email">Email Configuration</a></li>
                   <li><a class="reference internal" href="tags-management">Tags and Taxonomies</a></li>
                </ul>
          </div>
      </div>
   </div>

.. toctree::
   :hidden:
   :maxdepth: 1

   op_structure/index
   monitoring/index
   config_levels/index
   landing_system_configuration/index
   landing_crm/index
   landing_marketing/index
   user_management/index
   localization/index
   contact_reasons/index
   email/index
   entities/index
   integrations/index
   menu/index
   workflows/index
   tags_management/index
   multi_currency/index



