.. _configuration--guide--landing--page:

Administration Guide
====================

Administration
--------------

This section groups the guidance and reference information on hardware and software configuration for Oro application components, users and role management (including the data and access level restrictions), system monitoring tools, and Oro application extensions installation.

.. raw:: html

   <div class="guideline">

      <div class="guideline__item" >
          <div style="text-align: center">
          <h3>
          <a class="reference internal" href="user-management"><span class="std std-ref"><i class="fa fa-users fa-lg" aria-hidden="true"></i><br>User Management</span></a></h3>
          </div>
          <div style="overflow: hidden;margin: 0 auto;width: 100%;height:100%;text-align: left">
          </div>
      </div>

      <div class="guideline__item" >
          <div style="text-align: center">
          <h3>
          <a class="reference internal" href="security"><span class="std std-ref"><i class="fa fa-universal-access fa-lg" aria-hidden="true"></i><br>Roles and Access Management</span></a></h3>
          </div>
          <div style="overflow: hidden;margin: 0 auto;width: 100%;height:100%;text-align: left">
          </div>
      </div>

      <div class="guideline__item" >
          <div style="text-align: center">
          <h3>
          <a class="reference internal" href="security/security-data-audit#user-guide-data-audit"><span class="std std-ref"><i class="fa fa-book fa-lg" aria-hidden="true"></i><br>Data Audit</span></a></h3>
          </div>
          <div style="overflow: hidden;margin: 0 auto;width: 100%;height:100%;text-align: left">
          </div>
      </div>

      <div class="guideline__item" >
          <div style="text-align: center">
          <h3>
          &nbsp;</h3>
          </div>
          <div style="overflow: hidden;margin: 0 auto;width: 100%;height:100%;text-align: left">
          </div>
      </div>

   </div>


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
          <a class="reference internal" href="package-manager"><span class="std std-ref"><i class="fa fa-puzzle-piece fa-lg" aria-hidden="true"></i><br>Extensions and Package Management</span></a></h3>
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

      <div class="guideline__item" >
          <div style="text-align: center">
          <h3>
          &nbsp;</h3>
          </div>
          <div style="overflow: hidden;margin: 0 auto;width: 100%;height:100%;text-align: left">
          </div>
      </div>


   </div>


Configuration
-------------

The Configuration section of Administrator Guide walks your though all post-install configuration settings of the Oro application. In particular, you will learn how to set up general system configuration options, as well as settings specific for Commerce, CRM, and marketing.

See a short video on using configuration options and orienting in the configuration guide:

.. raw:: html

   <iframe width="560" height="315" src="https://www.youtube.com/embed/BxyzaOXwo0k" frameborder="0" allowfullscreen></iframe>

Before You Begin
^^^^^^^^^^^^^^^^

Settings in Oro application can be managed on multiple configuration levels. Throughout the configuration guide, these levels are marked with the corresponding icons to help you navigate through the settings. You can find more information on levels, graphics, and detailed reference of the settings in the following topics:

* :ref:`Configuration Layers <configuration--guide--config-levels>`: global, website, organization, and user
* :ref:`Configuration Option Quick Search <user-guide--system-configuration--quick-search>`

Fundamental Configuration Settings
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Configuration Levels
~~~~~~~~~~~~~~~~~~~~

.. note:: This section provide a reference for the settings accessible via the **System > Configuration** menu and **Configuration** menu of the organization, website, and user.

.. raw:: html

   <div class="guideline">
      <div class="guideline__item" >
          <div style="text-align: center">
          <h3><a class="reference internal" href="config-levels/global#doc-system-configuration"><span class="std std-ref"><i class="fa fa-cogs fa-lg" aria-hidden="true"></i><br>Global Configuration</span></a></h3>
          </div>
          <div style="overflow: hidden;margin: 0 auto;width: 100%;height:100%;text-align: left">
          </div>
      </div>

      <div class="guideline__item" >
          <div style="text-align: center">
          <h3>
          <a class="reference internal" href="config-levels/website#doc-website-configuration"><span class="std std-ref"><i class="fa fa-globe fa-lg" aria-hidden="true"></i><br>Website Configuration</span></a></h3>
          </div>
          <div style="overflow: hidden;margin: 0 auto;width: 100%;height:100%;text-align: left">
          </div>
      </div>

      <div class="guideline__item" >
          <div style="text-align: center">
          <h3>
          <a class="reference internal" href="config-levels/org#doc-organization-configuration"><span class="std std-ref"><i class="fa fa-building-o fa-lg" aria-hidden="true"></i><br>Organization Configuration</span></a></h3>
          </div>
          <div style="overflow: hidden;margin: 0 auto;width: 100%;height:100%;text-align: left">
          </div>
      </div>

      <div class="guideline__item" >
          <div style="text-align: center">
          <h3>
           <a class="reference internal" href="config-levels/user#doc-my-user-configuration"><span class="std std-ref"><i class="fa fa-user-o fa-lg" aria-hidden="true"></i><br>User Configuration</span></a></p></h3>
          </div>
          <div style="overflow: hidden;margin: 0 auto;width: 100%;height:100%;text-align: left">
          </div>
      </div>
   </div>


Domain-specific Groups of Configuration Settings
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. raw:: html

   <div class="guideline">
      <div class="guideline__item" >
          <div style="text-align: center">
          <h3>
          <img src="https://www.orocommerce.com/wp-content/uploads/sites/3/documentation/orocommerce/documentation/current/commerce_config.png" alt="CommerceConfig">
          <a class="reference internal" href="landing-commerce#configuration-guide-commerce-configuration"><span class="std std-ref">Commerce Configuration</span></a></h3>
          </div>
          <div style="overflow: hidden;margin: 0 auto;width: 100%;height:100%;text-align: left">
          </div>
      </div>

      <div class="guideline__item" >
          <div style="text-align: center">
          <h3>
          <img src="https://www.orocommerce.com/wp-content/uploads/sites/3/documentation/orocommerce/documentation/current/crm_config.png" alt="CRMConfig">
          <a class="reference internal" href="landing-crm#configuration-guide-crm-configuration"><span class="std std-ref">CRM Configuration</span></a></h3>
          </div>
          <div style="overflow: hidden;margin: 0 auto;width: 100%;height:100%;text-align: left">
          </div>
      </div>

      <div class="guideline__item" >
          <div style="text-align: center">
          <h3>
          <img src="https://www.orocommerce.com/wp-content/uploads/sites/3/documentation/orocommerce/documentation/current/marketing_config.png" alt="MarketingConfig">
           <a class="reference internal" href="landing-marketing#configuration-guide-marketing-configuration"><span class="std std-ref">Marketing Configuration</span></a></p></h3>
          </div>
          <div style="overflow: hidden;margin: 0 auto;width: 100%;height:100%;text-align: left">
          </div>
      </div>

      <div class="guideline__item" >
          <div style="text-align: center">
          <h3>
            &nbsp;</h3>
            </div>
          <div style="overflow: hidden;margin: 0 auto;width: 100%;height:100%;text-align: left">
          </div>
      </div>

   </div>

Advanced Configuration Settings
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. note:: This section provide a reference for the settings accessible via the **System** menu (other than **System > Configuration**).

.. raw:: html

   <div class="guideline">
      <div class="guideline__item" >
          <div style="text-align: center">
          <h3><a class="reference internal" href="email#doc-email-configuration"><span class="std std-ref"><i class="fa fa-envelope-o" aria-hidden="true"></i><br>Emails</span></a></h3>
          </div>
          <div style="overflow: hidden;margin: 0 auto;width: 100%;height:100%;text-align: left">
          </div>
      </div>

      <div class="guideline__item" >
          <div style="text-align: center">
          <h3>
          <a class="reference internal" href="integrations#user-guide-integrations"><span class="std std-ref"><i class="fa fa-puzzle-piece" aria-hidden="true"></i><br>Integrations</span></a></h3>
          </div>
          <div style="overflow: hidden;margin: 0 auto;width: 100%;height:100%;text-align: left">
          </div>
      </div>

      <div class="guideline__item" >
          <div style="text-align: center">
          <h3>
          <a class="reference internal" href="tags_management#user-guide-system-tags-management"><span class="std std-ref"><i class="fa fa-tag" aria-hidden="true"></i><br>Tags</span></a></h3>
          </div>
          <div style="overflow: hidden;margin: 0 auto;width: 100%;height:100%;text-align: left">
          </div>
      </div>

      <div class="guideline__item" >
          <div style="text-align: center">
          <h3>
           <a class="reference internal" href="menu#doc-config-menus"><span class="std std-ref"><i class="fa fa-bars" aria-hidden="true"></i><br>Menus</span></a></p></h3>
          </div>
          <div style="overflow: hidden;margin: 0 auto;width: 100%;height:100%;text-align: left">
          </div>
      </div>
   </div>


.. raw:: html

   <div class="guideline">
      <div class="guideline__item" >
          <div style="text-align: center">
          <h3>
            <a class="reference internal" href="workflows#user-guide-system-workflow-management"><span class="std std-ref"><i class="fa fa-retweet" aria-hidden="true"></i><br>Workflow</span></a></h3>
            </div>
          <div style="overflow: hidden;margin: 0 auto;width: 100%;height:100%;text-align: left">
          </div>
      </div>

      <div class="guideline__item" >
          <div style="text-align: center">
          <h3>
          <a class="reference internal" href="websites#user-guide-system-websites"><span class="std std-ref"><i class="fa fa-globe" aria-hidden="true"></i><br>Websites</span></a></h3>
          </div>
          <div style="overflow: hidden;margin: 0 auto;width: 100%;height:100%;text-align: left">
          </div>
      </div>

      <div class="guideline__item" >
          <div style="text-align: center">
          <h3>
          <a class="reference internal" href="localization#sys-config-sysconfig-general-setup-localization"><span class="std std-ref"><i class="fa fa-flag" aria-hidden="true"></i><br>Localization</span></a></h3>
          </div>
          <div style="overflow: hidden;margin: 0 auto;width: 100%;height:100%;text-align: left">
          </div>
      </div>

      <div class="guideline__item" >
          <div style="text-align: center">
          <h3>
          <a class="reference internal" href="pricing#price-list-configuration"><span class="std std-ref"><i class="fa fa-money" aria-hidden="true"></i><br>Pricing</span></a></h3>
          </div>
          <div style="overflow: hidden;margin: 0 auto;width: 100%;height:100%;text-align: left">
          </div>
      </div>
   </div>

.. raw:: html

   <div class="guideline">

      <div class="guideline__item" >
          <div style="text-align: center">
          <h3>
          <a class="reference internal" href="payment#doc-payment-configuration"><span class="std std-ref"><i class="fa fa-credit-card" aria-hidden="true"></i><br>Payments</span></a></h3>
          </div>
          <div style="overflow: hidden;margin: 0 auto;width: 100%;height:100%;text-align: left">
          </div>
      </div>

      <div class="guideline__item" >
          <div style="text-align: center">
          <h3>
          <a class="reference internal" href="entities#entities-management"><span class="std std-ref"><i class="fa fa-list-alt" aria-hidden="true"></i><br>Entities</span></a></h3>
          </div>
          <div style="overflow: hidden;margin: 0 auto;width: 100%;height:100%;text-align: left">
          </div>
      </div>

      <div class="guideline__item" >
          <div style="text-align: center">
          <h3>
          <a class="reference internal" href="user-management#entities-management"><span class="std std-ref"><i class="fa fa-users" aria-hidden="true"></i><br>Users, Roles, and Access</span></a></h3>
          </div>
          <div style="overflow: hidden;margin: 0 auto;width: 100%;height:100%;text-align: left">
          </div>
      </div>

      <div class="guideline__item" >
          <div style="text-align: center">
          <h3>
          <a class="reference internal" href="security"><span class="std std-ref"><i class="fa fa-shield" aria-hidden="true"></i><br>Security</span></a></h3>
          </div>
          <div style="overflow: hidden;margin: 0 auto;width: 100%;height:100%;text-align: left">
          </div>
      </div>
   </div>

**For more information, see the following sections**:

.. toctree::
   :includehidden:
   :titlesonly:
   :maxdepth: 1

   op_structure/index
   monitoring/index
   config_levels/index
   landing_system_configuration/index
   landing_commerce/index
   landing_crm/index
   landing_marketing/index
   user_management/index
   localization/index
   email/index
   entities/index
   integrations/index
   menu/index
   workflows/index
   tags_management/index
   pricing/index
   payment/index
   websites/index

.. include:: /img/buttons/include_images.rst
   :start-after: begin