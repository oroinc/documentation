.. _integrations-marketing-google-analytics:

Integration with Google Analytics
=================================

.. hint:: Please |contact our support team| for more information on available integration options. You can also visit our |extensions store| to explore other integrations and extensions.

Google Analytics is a powerful web analytics service offered by Google to help businesses track and analyze their website traffic. The tool provides useful information on user demographics, interests, and real-time data on website activity. By utilizing this data, businesses can make informed decisions, improve their marketing strategies, and enhance the overall user experience.

OroCommerce integrates with Google Analytics through Google Tag Manager (GTM), which is a smart tool that simplifies the process of tracking key metrics of your OroCommerce web store pages. GTM allows to configure tags based on specific triggers and conditions. This flexibility is particularly beneficial for OroCommerce users, as it enables the customization of tracking events, such as product and page views, product clicks, additions to the cart, or completed purchases. All this information can subsequently be shared with Google Analytics, enabling you to monitor various user interactions with products on your website.


Integration Benefits
--------------------

By integrating with Google Tag Manager, OroCommerce gains access to extensive data from Google Analytics. This integration provides businesses with the necessary tools to understand customer journeys, improve user experiences, and customize marketing strategies.

Here are some of the benefits you can expect from integrating OroCommerce with Google Tag Manager and Google Analytics:

- **Simplified Tracking Implementation** --- The integration between Google Analytics and OroCommerce, facilitated by Google Tag Manager, streamlines the process of tracking key metrics without complex coding. Instead of manually altering site code when adding a new piece of tracking functionality, GTM allows to do it from a centralized dashboard.

- **Dynamic Tag Configuration** --- GTM enables dynamic tag configuration, enabling OroCommerce to monitor the events required for a specific business purpose, such as clicks on particular products, promotions, order submissions, or other interactions with the OroCommerce web store. To view all the tags supported by OroCommerce, refer to the :ref:`Google Tag Manager Integration <gtm-ga-4-integration--create-tags>` topic.

- **User Behavior Analysis** --- The integration enables OroCommerce to track user journeys and interactions on a detailed level. From page views and session durations to click patterns and navigation paths, businesses can gain a comprehensive understanding of how users engage with their websites.

- **Custom Reports and Dashboards** --- The integration enables customizing reports and dashboards to specific business needs. Google Analytics allows users to create custom views, ensuring that the most relevant data is easily accessible and actionable.


Exchanged Fields
----------------

The integration between OroCommerce and Google Analytics follows a one-way synchronization approach, which means that once the data is captured by GTM, it is forwarded to Google Analytics. Google Analytics then provides a comprehensive analysis of user behavior based on the metrics data received from OroCommerce. The data typically include:

.. csv-table::

   "Customer Information","User-specific information, such as a customer user, customer, and customer group ID, and localization ID."
   "User Interaction Events","Events triggered by user interactions that are relevant for tracking, such as clicks, form submissions, products purchased, transaction IDs, etc."


Security Measures
-----------------

OroCommerce, Google Tag Manager, and Google Analytics prioritize the security and protection of sensitive data during the integration process. The platforms comply with industry-standard security protocols, including:

- **Data Encryption:** All data exchanged between OroCommerce and Google Analytics is encrypted using secure communication protocols (e.g., HTTPS) to prevent unauthorized access and data interception. Google Tag Manager explicitly states that, other than data in standard HTTP request logs, which is deleted within 14 days of being received, it does not collect, retain, or share any information about visitors to customers' properties, including page URLs visited.

- **ISO 27001 Certification:** Google Tag Manager has earned ISO 27001 certification that reflects Google's commitment to maintaining a high level of security for systems, people, and data centers serving GTM.

- **Data Privacy Compliance:** Google Tag Manager adheres to the Google Ads Data Processing Terms, which are designed for businesses in the European Economic Area (EEA) or Switzerland and those subject to the territorial scope of the General Data Protection Regulation (GDPR).

By implementing these security measures, OroCommerce and Google Tag Manager integration ensures a safe and secure shipping and fulfillment process, providing merchants and customers with peace of mind during their transactions.

**Related Articles**

* :ref:`Configure Google Tag Manager Integration in the Back-Office <gtm-ga-4-integration>`

.. include:: /include/include-links-user.rst
   :start-after: begin
