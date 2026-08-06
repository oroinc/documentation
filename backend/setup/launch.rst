Launch
======

When development is complete and it is time to go live, a clear release plan is essential for a smooth process.

Going live is not a matter of just "flipping the switch". We have compiled a go-live plan to help you avoid typical issues and share some of our best practices.

The recommendations provided below are applicable when launching the application for the first time and updating a project that is already live.

Development
-----------

At the development stage, consider several things months before the release.

**Compile your launch plan at the initial stage of development**

Planning helps you uncover the hidden scope of work and capture all necessary items in time. Think about the actions needed before, during, and right after the launch. A comprehensive plan that defines each team member's deadlines, roles, and responsibilities is a must to keep the project on track. You can do some work concurrently with development to save time later.

**Use a staging environment**

We recommend a staging environment equivalent to production, so you can test the exact deployment steps you will use in production. Match it to production in hardware, configurations, architecture, services, catalog size, customer number, etc. Run as many tests as possible to ensure there are no blocking issues in the application.

.. hint::
          Remember to limit emails sent from the staging and other environments you use in the development. You want to avoid sending emails to real mailboxes.

          If you use a copy of the production database, we strongly recommend replacing sensitive information with dummy placeholders to increase security and avoid data leaks.
          If your application runs on |OroCloud|, it will be helpful to know that it has a tool that copies the production database and replaces sensitive information with meaningless text. Contact Oro Customers Support to request a copy of your production database for the staging environment.

Because staging mirrors production, errors there warn you of errors likely to occur in production. Note, however, that the absence of issues in your local environment does not guarantee the same in production.


.. hint::

    If your application runs on |OroCloud|, the available environments and their types depend on your Oro license. You can always request the deployment of additional environments (beyond what is covered by your license) for an additional cost. Contact your Account Manager or Sales Representative for more details about additional environments.


**Prepare content early**

Your web application contains a variety of content that you need ready before launch, particularly when it has a customer-facing side (storefront). You can prepare most of this content even before the application is ready.

Start writing content pages and email templates, designing ad pages and blocks, constructing the menu and catalog structure, and adding product data. If you use integrations to import content, such as products or catalogs, ensure all the required information, including SEO-related attributes, is in place.

Keeping the content ready enables you to check whether it fits properly when all related features are complete. Using real content during development and testing is better than dummy data.

**Tune search configuration**

To help users find information (e.g., products and services) effectively, think about typical search queries. Use them to fine-tune the search engine: update and prioritize the list of searchable fields, define the list of stop words, filters, sorters, etc.

**Define user roles and responsibilities**

Think about the users of your application and their responsibilities. Define all necessary user roles, granting each role access only to the data essential for its work. This applies to back-office users as well as storefront (customer) users.

**Use HTTPS**

We recommend HTTPS for your project and for all connections to third-party services in your application. Secure communication improves data protection and overall security. If a third-party service does not support HTTPS, you have enough time before launch to implement it or request support for it.

**Decide on SEO strategy**

Decide what happens to the URLs that are already indexed by search engines from your old sites. If those URL patterns require redirects, discuss your options with the development team, and add a task to the pre-launch plan to configure redirects.

Pre-Launch
----------

When development, configuration, and testing are complete, start gearing up for the launch. Before going live, prepare your production environment and ensure it is ready for traffic once you open the website to your customers.

First, create/deploy a new environment, set up a project, and configure both as production. Alternatively, convert your staging environment to production. Because staging is configured for development, review its configuration carefully and update it for production needs. This approach makes data entered during development available on the new instance, so you do not need to enter it again.

.. important::

    If you are launching an |OroCloud| application, please |reach out to Oro Customers Support| to |notify them about your intention to launch| at least two weeks in advance.


**Buy SSL certificates and configure SPF records**

Define production domains and buy the necessary SSL certificates in advance so the launch runs smoothly.

Remember to configure SPF records for email anti-spam control to make sure emails from your application are not dropped to the Spam folder and ignored by users.

**Ensure the environment resource configuration is ready for the estimated load**

To avoid downtime and ensure optimal performance, estimate the expected number of requests to your application, along with the volume of data and media files. Use this information to check the resource configuration of each node of the production environment and update it accordingly.

**Ensure Message Queue is configured for optimal performance**

Consider moving mission-critical and time-sensitive jobs to separate queues to avoid delays because of the large number of messages in the default queue. For example, move search re-indexation and data audit jobs to separate queues if you have a big catalog and regular updates (e.g., imports or automatic syncs), so the delay between product changes or catalog updates is significantly reduced. Read more on how we configure message queues at :ref:`Configure Message Queue with RabbitMQ for Production <op-structure--mq--rabbitmq--configure>`.

**Run acceptance testing of your production instance**

Complete User Acceptance Testing (UAT) of your application. For testing, use desktops, laptops, and mobile devices. We recommend including a test of real purchases to see the entire flow from the perspective of the final customer and check that all payments are captured.

Consider performing load and stress testing. You can use different tools, such as Jmeter, Blackfire, New Relic, Google PageSpeed Insights, and others, that enable you to test the performance of your application and locate processes and areas where performance should be improved.

You should also run a security/penetration test against your application to ensure any customization you have done has not exposed your site to security vulnerabilities and/or to achieve PCI compliance.

**Prepare a Rollback Plan**

Prepare for any scenario, good or bad. Clearly outlined steps for reverting changes and restoring the application to a functioning state simplify and speed up the roll-back.

If you are updating a project that has already gone live, make sure you have taken a snapshot of the production instance before deployment.

**Prepare for scheduled downtime**

Schedule the maintenance window and configure a maintenance page.

Launch
------

When your production is set up and tested, it is finally time to go live. Remember to set a maintenance page on your former website if you are migrating to a new application, and update the DNS to point your domain name to the production IP address.

In addition, we recommend ensuring that:

* Monitoring is enabled, and the right people on your teams are set up to receive the alerts.
* Emails are successfully sent to users.
* SEO is in place after the right domain name is set up for the application. Check that all required redirects work as expected, review canonical links, make sure that the sitemap is referenced in robots.txt, and index follow is enabled.
* All integrations use production credentials.

Go-Live Checklist
-----------------

Minor details may often be overlooked when preparing for the application launch. That is why we have compiled a |go-live checklist| of all the essentials to help you coordinate the upcoming launch. Update it if necessary for your project and development processes.

.. include:: /include/include-links-dev.rst
   :start-after: begin