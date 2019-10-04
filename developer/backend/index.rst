Backend Developer Guide
=======================

Backend Developer Guide is an essential resource for developers that provides comprehensive documentation on how to install, customize, and maintain Oro applications by making the relevant code-level changes. Navigate the guide to learn how to configure Oro applications to accomplish a broad range of tasks required for organizations to run the business and interact with customers successfully.

.. raw:: html

    <div class="guideline guideline--backend">
      <div class="guideline__item">
          <div>
            <h2>Setup</h2>
          </div>
          <div style="overflow: hidden;width: 70%;height:100%;text-align: left">
          <p>Configure dev and prod environments for Oro applications, install and upgrade them to a new version.</p>
               <ul class="guideline__list">
                   <li><a class="reference internal" href="setup/system-requirements.html">System Requirements</a></li>
                   <li><a class="reference internal" href="setup/dev-environment/index.html">Dev Environment</a></li>
                   <li><a class="reference internal" href="setup/prod-environment/index.html">Prod Environment</a></li>
                   <li><a class="reference internal" href="setup/installation/index.html">Installation</a></li>
                   <li><a class="reference internal" href="setup/upgrade-to-new-version.html">Upgrade</a></li>
                   <li><a class="reference internal" href="setup/reinstall.html">Reinstall</a></li>
                </ul>
          </div>
      </div>

      <div class="guideline__item" >
          <div>
            <h2>Entities</h2>
          </div>
          <div style="overflow: hidden;width: 70%;height:100%;text-align: left">
               <p>Create, configure and manage entities, create CRUD for particular entities, and protect them using access level permissions.</p>
               <ul class="guideline__list">
                   <li><a class="reference internal" href="entities/create-entities.html">Create Entities</a></li>
                   <li><a class="reference internal" href="entities/extend-entities/index.html">Extend Entities</a></li>
                   <li><a class="reference internal" href="entities/crud.html">CRUD Operations</a></li>
                   <li><a class="reference internal" href="entities/config-entities/index.html">Configure Entities</a></li>
                   <li><a class="reference internal" href="entities/entities-validation.html">Validate Entities</a></li>
                   <li><a class="reference internal" href="entities/acls.html">Access Permissions</a></li>
               </ul>
          </div>
      </div>

        <div class="guideline__item" >
                  <div>
                    <h2>Entity Data</h2>
                  </div>
                  <div style="overflow: hidden;width: 70%;height:100%;text-align: left">
                       <p>Configure entity-related reports, integration of business processes, workflows, data audit, search index.</p>
                       <ul class="guideline__list">
                           <li><a class="reference internal" href="entities/data-grids/index.html">Data Grids</a></li>
                           <li><a class="reference internal" href="architecture/tech-stack/search-index/index.html">Search Index</a></li>
                           <li><a class="reference internal" href="entities-data-management/data-audit.html">Data Audit</a></li>
                           <li><a class="reference internal" href="entities/data-fixtures.html">Fixtures</a></li>
                           <li><a class="reference internal" href="entities-data-management/workflows.html">Workflows</a></li>
                           <li><a class="reference internal" href="entities-data-management/operations.html">Operations (Actions)</a></li>
                       </ul>
                  </div>
              </div>
   </div>

   <h2>Guides</h2>

   <ul class="tag-cloud">
      <li><a class="" href="architecture/index.html">Architecture</a></li>
      <li><a class="tag-important" href="extension/index.html">Bundles and Extensions</a></li>
      <li><a class="" href="security/index.html">Security</a></li>
      <li><a class="" href="translations/index.html">Translation and Localization</a></li>
      <li><a class="tag-very-important" href="integrations/index.html">Integrations</a></li>
      <li><a class="" href="dashboards/index.html">Dashboards</a></li>
      <li><a class="" href="navigation/index.html">Navigation</a></li>
      <li><a class="" href="emails/index.html">Emails</a></li>
      <li><a class="tag-very-important" href="background-tasks/mq/index.html">Message Queue</a></li>
      <li><a class="tag-important" href="background-tasks/cron.html">Cron</a></li>
      <li><a class="" href="websockets/index.html">WebSocket Notifications</a></li>
      <li><a class="" href="scopes/index.html">Scopes</a></li>
      <li><a class="" href="feature-toggle/index.html">Feature Toggle</a></li>
      <li><a class="" href="logging/index.html">Logging</a></li>
      <li><a class="tag-very-important" href="configuration/index.html">Configuration Reference</a></li>
      <li><a class="" href="automated-tests/index.html">Automated Tests</a></li>
      <li><a class="" href="extend-crm/index.html">Extending OroCRM</a></li>
      <li><a class="tag-important" href="extend-commerce/index.html">Extending OroCommerce</a></li>
      <li><a class="" href="third-party-extensions/index.html#dev-akeneo-integration">Akeneo Integration</a></li>
      <li><a class="tag-very-important" href="api/index.html">Web Services API</a></li>
   </ul>


.. toctree::
   :hidden:
   :titlesonly:
   :maxdepth: 2

   setup/index
   architecture/index
   extension/index
   entities/index
   entities-data-management/index
   security/index
   translations/index
   integrations/index
   dashboards/index
   navigation/index
   emails/index
   background-tasks/index
   websockets/index
   scopes/index
   feature-toggle/index
   logging/index
   configuration/index
   extend-crm/index
   extend-commerce/index
   third-party-extensions/index
   automated-tests/index
   api/index
   bundles/index

