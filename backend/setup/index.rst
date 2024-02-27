:title: Oro Application Environment Setup Configuration and Installation

.. meta::
   :description: Core concepts of the Oro application setup and upgrading requirements for the backend developers

.. _dev-guide-setup:

Application Setup and Configuration
===================================

.. raw:: html

    <div class="showcase-section">
        <div class="showcase-section-heading">
        </div>
        <div class="showcase-section-body">
            <ul class="grid-list">
                <li>
                    <div class="icon">
                        <img src="../../_static/images/icon-demo.png" width="35px">
                    </div>
                    <div class="text-center">
                        <h2>Demo Environment </h2>
                    </div>
                        <p>Follow the steps in the topics below to set up a demo environment with the help of a service of your choice.</p>
                        <ul class="guideline__list">
                                      <li><a class="reference internal" href="demo-environment/docker/">Docker</a></li>
                                      <li><a class="reference internal" href="demo-environment/vm/">VM Virtualbox</a></li>
                                      <li><a class="reference internal" href="demo-environment/aws/">AWS Cloud Platform</a></li>
                                      <li><a class="reference internal" href="demo-environment/gcp/">Google Cloud Platform</a></li>
                                      <li><a class="reference internal" href="demo-environment/azure/">Azure Cloud Platform</a></li>
                                      <li><a class="reference internal" href="demo-environment/vagrant/">Vagrant Provision</a></li>
                                   </ul>
                </li>
                <li>
                    <div class="icon">
                        <img src="../../_static/images/web.svg" width="90px">
                    </div>
                    <div class="text-center">
                         <h2>Dev Environment</h2>
                    </div>
                        <p>Ensure you meet server and client-side recommendations and learn how to set up the environment.</p>
                        <ul class="guideline__list">
                            <li><a class="reference internal" href="system-requirements/">Recommended System Requirements</a></li>
                            <li><a class="reference internal" href="dev-environment/">Setting Up Dev Environment</a></li>
                            <li><a class="reference internal" href="get-source-files/">Retrieving Source Code</a></li>
                            <li><a class="reference internal" href="installation/">Starting Installation</a></li>
                            <li><a class="reference internal" href="installation-in-sub-folder/">Installation in Sub-Folder</a></li>
                        </ul>
                </li>
               <li>
                    <div class="icon">
                        <img src="../../_static/images/icon-cloud.png" width="35px">
                    </div>
                    <div class="text-center">
                         <h2>Cloud Environment</h2>
                    </div>
                        <p>Learn how to run Oro applications in the Google Cloud Platform infrastructure and its services.</p>
                        <ul class="guideline__list">
                            <li><a href="https://doc.oroinc.com/cloud/architecture/">Architecture</a></li>
                            <li><a href="https://doc.oroinc.com/cloud/environments/">Environment Types</a></li>
                            <li><a href="https://doc.oroinc.com/cloud/maintenance/">Maintenance</a></li>
                            <li><a href="https://doc.oroinc.com/cloud/security/">Security</a></li>
                            <li><a href="https://doc.oroinc.com/cloud/monitoring/">Monitoring</a></li>
                            <li><a href="https://doc.oroinc.com/cloud/support/">Support</a></li>
                          </ul>
                </li>
                <li>
                    <div class="icon">
                         <img src="../../_static/images/upgrade.png" width="40px">
                    </div>
                    <div class="text-center">
                        <h2>Deploy & Upgrade</h2>
                    </div>
                        <p>Configure development and production environments, install and upgrade them to a new version.</p>
                         <ul class="guideline__list">
                                      <li><a class="reference internal" href="upgrade-to-new-version/">Upgrade Application</a></li>
                                      <li><a class="reference internal" href="deploy-the-update/">Deploy Changes</a></li>
                         </ul>
                </li>
                <li>
                    <div class="icon">
                        <img src="../../_static/images/interface.svg" width="75px">
                    </div>
                    <div class="text-center">
                        <h2>Launch</h2>
                    </div>
                        <p>When development is complete, check out recommendations for all stages of the development.</p>
                        <ul class="guideline__list">
                                      <li><a class="reference internal" href="launch#launch">Plan</a></li>
                                      <li><a class="reference internal" href="launch#pre-launch">Pre-Launch</a></li>
                                      <li><a class="reference internal" href="launch#id1">Launch</a></li>
                                      <li><a class="reference internal" href="launch#go-live-checklist">Checklist</a></li>
                        </ul>
                </li>

                <li>
                    <div class="icon">
                        <img src="../../_static/images/business-and-finance.svg" width="80px">
                    </div>
                    <div class="text-center">
                         <h2>Learn More</h2>
                    </div>
                        <p>Check out other articles on working with, configuring, and installing the Oro applications:</p>
                          <ul class="guideline__list">
                                      <li><a class="reference internal" href="jenkins/">Jenkins CI</a></li>
                                      <li><a class="reference internal" href="demo-data/">Loading Demo Data</a></li>
                                      <li><a class="reference internal" href="post-install/">Post-Install Activities (optional)</a></li>
                          </ul>
                </li>
            </ul>
        </div>
        <div class="showcase-section-footer">
        </div>
    </div>

.. admonition:: Business Tip

    Explore our |B2B eCommerce platform comparison| page to comprehensively review and narrow down your options.


.. toctree::
   :titlesonly:
   :maxdepth: 1
   :hidden:


   system-requirements/index
   Development Environment <dev-environment/index>
   demo-environment/index
   Jenkins CI <jenkins>
   get-source-files
   installation
   installation-in-sub-folder
   post-install/index
   demo-data
   launch
   Upgrade <upgrade-to-new-version>
   Deploy Changes <deploy-the-update>
   reinstall


.. include:: /include/include-links-seo.rst
   :start-after: begin