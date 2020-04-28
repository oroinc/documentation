Launch
======

When development is complete, and it is time to go live, a clear plan for a release procedure is essential for the whole process to go down smoothly.

As going live is not a matter of just "flipping the switch", we have compiled a go-live plan to help you avoid the typical issues you might face in the process, and introduce you to some of our best practices.

The recommendations provided below are applicable when launching the application for the first time, and updating a project that is already live.

Development
-----------

When you are at the development stage, several things need to be considered months ahead of the release

**Compile your launch plan at the initial stage of development**

Planning helps you uncover the hidden scope of work and ensure you have captured all critical items and factors in time. Think about actions that need to be done before, during, and right after the launch. At this point, a comprehensive plan that defines the deadlines, roles, and responsibilities of each team member is a must to keep the project on track. You may even find that some work can be done concurrently with the development and ultimately save time in the future.

**Use a staging environment**

We recommend using a staging environment equivalent to the production environment to test the exact steps in the deployment plan that you are going to use in the production. It includes similar hardware, configurations, architecture, services, catalog size, customer number, etc. Run as many tests as possible to ensure there are no blocking issues in the application.

.. hint::
          Remember to limit emails sent from the staging and other environments you use in the development. You do not want to send emails to the real mailboxes.

          If you use a copy of the production database, we strongly recommend replacing sensitive information with dummy placeholders to increase security and avoid data leaks.
          If your application runs on :ref:`OroCloud <orocloud>`, it will be useful to know that it has a tool that copies the production database and replaces sensitive information with meaningless text. Contact Oro Customers Support to request a copy of your production database for the staging environment.

Staging environments mirror production, which means that if errors occur in there, you get a heads-up that it would likely cause similar errors in your production environment. It's important to note however that the absence of issues in your local environment does not guarantee the same in the production.


.. hint::
    If your application runs on :ref:`OroCloud <orocloud>`, the available environments and their types depend on your Oro license. You can always request the deployment of additional environments (beyond what is covered by your license) for an additional cost. Contact your Account Manager or Sales Representative for more details about additional environments.


**Prepare content early**

There is a variety of content in your web-application that you need to have ready before the launch, in particular, when the application has a customer-facing side (storefront). You can prepare the majority of content even when your application is not yet ready.

Start writing content pages, email templates, designing ad pages and blocks, constructing the menu and catalog structure, adding product data. If you use integrations to import content, such as products or catalogs, make sure all the required information is in place, including SEO-related attributes.

Keeping the content ready enables you to check whether it fits properly when all related features are complete. It is beneficial to use real content during development and testing instead of dummy data.

**Tune search configuration**

To make sure the application search allows users to find information (e.g., products and services) effectively, think about what typical search queries could be. It helps to fine-tune the search engine (update the list of searchable fields and prioritize them, define the list of stop words, filters, sorters, etc.).

**Define user roles and responsibilities**

Think about the users of your application and their responsibilities. Define all necessary user roles that should be allowed access only to the data that is essential for their work requirements. It is applicable for back-office users as well as for the front-store (customer) users.

**Use HTTPS**

We recommend using HTTPS for your project and all connections to the third-party services implemented in your application. Secure communication increases your data protection and overall security. If third-party services do not allow it, you have enough time before the launch to implement or request the support of the HTTPS protocol for them.

**Decide on SEO strategy**

Decide what happens to the URLs that are already indexed by search engines from your old sites. If those URL patterns require redirects, make sure to discuss what your options are with the development team, and add a task to the pre-launch plan to configure redirects.

Pre-Launch
----------

When development, configuration, and testing are complete, you can consider starting to gear up for the launch. Before going live, get your production environment ready and make sure it is prepared for the traffic once you open the website to your customers.

First, create/deploy a new environment, set up a project there, and configure both as production. Alternatively, you can convert your staging environment to production. Remember that the staging is configured for development, so you need to review its configuration carefully and update it according to the production needs. The benefit of such an approach is that data entered during development becomes available on the new instance, so you do not need to spend time entering it again.

.. important::
    If you are launching an :ref:`OroCloud <orocloud>` application, please |reach out to Oro Customers Support| to :ref:`notify them about your intention to launch <support-contact-before-lauch>` at least 2 weeks in advance.

**Buy SSL certificates and configure SPF records**

Define production domains and buy necessary SSL certificates in advance, so it does not cause any delays during the launch.

Remember to configure SPF records for email anti-spam control to make sure emails from your application are not dropped to the Spam folder and ignored by users.

**Ensure the environment resource configuration is ready for the estimated load**

To avoid any downtimes and ensure optimal application performance, estimate the expected amount of requests to your application along with the volume of data and media files. Using this information, check the resource configuration of each node of the production environment and update it accordingly.

**Ensure Message Queue is configured for optimal performance**

Consider moving mission-critical and time-sensitive jobs to separate queues to avoid delays because of the large number of messages in the default queue. For example, move search re-indexation and data audit jobs to separate queues if you have a big catalog and regular updates (e.g., imports or automatic syncs), so delay between product changes or catalog updates is significantly reduced. Read more on how we configure message queues at :ref:`Configure Message Queue with RabbitMQ for Production <op-structure--mq--rabbitmq--configure>`.

**Run acceptance testing of your production instance**

Complete User Acceptance Testing (UAT) of your application. For testing, use desktops, laptops, and mobile devices. We recommend to include a test of real purchases to see the full flow from the perspective of the final customer and check that all payments are captured.

Consider performing load and stress testing. You can use different tools, such as Jmeter, Blackfire, New Relic, Google PageSpeed Insights, and others, that enable you to test the performance of your application and locate processes and areas where performance should be improved.

You should also run a security/penetration test against your application to ensure any customization you have done has not exposed your site to security vulnerabilities, and/or to achieve PCI compliance.

**Prepare a Rollback Plan**

Prepare for any scenarios, good or bad. Clearly outlined steps on how to revert changes and get the application back to a functioning state enable you to simplify and speed up the roll-back.

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

Little details can often be forgotten and overlooked when preparing for the application launch. That is why we have compiled a |go-live checklist| of all the essentials to help you coordinate the upcoming launch. Update it if necessary for your project and development processes.

Conclusion
----------

Going live is an important milestone for your team, as from this point, you are starting to get an appreciation for all the time and efforts spent on the project. Remember that the first impression of customers about your project defines its continued success. That is why your web-application must look perfect from the very first minute.

Plan the launch carefully to avoid any surprises when your project is making its baby steps on the way to success.


.. include:: /include/include-links-dev.rst
   :start-after: begin
