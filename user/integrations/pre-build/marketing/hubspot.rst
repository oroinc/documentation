.. _integrations-marketing-hubspot:

Integration with Hubspot
========================

.. hint:: Please |contact our support team| for more information on available integration options, or check out our |extensions store|.

HubSpot is a platform that combines marketing and sales tools, allowing businesses to create custom marketing campaigns, automate sales processes and effectively nurture leads. OroCommerce provides integration with HubSpot to help align sales and marketing teams in a business, as well as facilitating practical marketing activities and lead segmentation planning.

.. image:: /user/img/integrations/hubspot-lead-page.png
   :alt: Lead view page with links to HubSpot and ability to push and pull information from Hubspot

Integration Benefits
--------------------

Here are some of the benefits you can expect from integrating OroCommerce and HubSpot:

- **Enhanced Marketing:** By integrating customer data, you can create targeted and personalized marketing campaigns. This ensures that you deliver the right message to the right audience at the right time, improving conversion rates.

- **Streamlined Sales:** Access real-time lead information to help your sales and marketing team engage with potential customers more effectively.

- **Unified Customer Data:** Combine customer data from OroCommerce and HubSpot to create a 360-degree view of your customers. This will help you better understand their needs and preferences, and create more targeted marketing and sales strategies.

- **Automation:** Automate lead development, email marketing, and sales processes, reducing manual input. This will help you save time and resources, and ensure a more efficient workflow.

- **Improved Lead Segmentation:** Precisely segment leads based on behavior, interests, and demographics to ensure highly targeted marketing efforts that boost engagement and conversions.

- **Data Accuracy:** Ensure data accuracy and consistency across platforms through synchronization, reducing errors and enhancing overall data quality. This will help you make more informed decisions and avoid costly mistakes.

- **Efficient Collaboration:** Foster collaboration between marketing and sales teams by sharing real-time data and insights, ensuring more coordinated and effective strategies. This will help you achieve your business goals more efficiently and effectively.

Data Exchange
-------------

When integrating HubSpot with OroCommerce, you have the option to choose between two types of synchronization:

**Two-Way Sync:**

* Data is exchanged in both directions between OroCommerce and HubSpot.
* Whenever there are any changes, OroCommerce pushes data to HubSpot immediately.
* HubSpot pulls data from OroCommerce at regular intervals, usually once every 5 minutes. However, data can be pulled from HubSpot on demand from the view page of the selected contact.
* This synchronization ensures that both platforms have access to the latest and most accurate data.

**One-Way Sync:**

* OroCommerce only pulls information from HubSpot and does not push data back.
* This setup is suitable for scenarios where OroCommerce primarily relies on HubSpot for specific lead and contact information.

During the synchronization process, various data elements are typically exchanged between OroCommerce and HubSpot, depending on the level of integration or customization. These data elements may include:

.. csv-table::

   "Contact Information","The job title and full name of a contact."
   "Lead Details","Name of the lead or contact along with their company."
   "Industry","Industry or sector of the lead's company."
   "Company Website","Web address of the lead's company website."
   "Budget & Revenue","Information on the budget for the lead and company revenue."
   "Number of Employees","Total employee count in the lead's company."
   "Contact Details","Phone numbers and email addresses for communication."
   "Company Type","Categorization of the lead's company (e.g., private)."
   "Disqualification Reason","Specific reason for disqualifying the lead, if applicable."
   "GDPR Consent","Consent status for data use per GDPR guidelines."
   "Lead Country","The location of the lead"
   "Source","Origin channel or campaign for acquiring the lead."
   "Campaign","Details about the associated marketing campaign."
   "Status","Current stage or status within the sales/marketing funnel."
   "Workflow Step","Stage of the lead in the funnel."
   "Owner","Individual/team responsible for lead management."
   "Sync to Hubspot Master List","Indication of whether the lead needs to added to the master list on the HubSpot."
   "Date/Time","Dates/times of lead creation and last modification."
   "LinkedIn","Link to the lead's LinkedIn profile."
   "Opt-Out Status in HubSpot","Indicates if the lead has opted out of HubSpot communications."
   "Inclusion in HubSpot Workflows","Specifies participation in automated workflows."
   "Partner","Identifies any partnerships or affiliations."

Data Security
-------------

To ensure the security of OroCommerce and HubSpot integration, various measures are implemented, including:

- **HTTPS (Hypertext Transfer Protocol Secure):** All data exchanges between the two systems occur over secure HTTPS connections. HTTPS encrypts the data in transit, making it almost impossible for unauthorized parties to intercept or tamper with the information being exchanged.

- **Authentication Token:** Authentication tokens act as digital keys that verify the identity of the systems and users accessing the integration. Only authorized parties with valid authentication tokens can initiate and maintain communication, preventing unauthorized access to sensitive data.

.. include:: /include/include-links-user.rst
   :start-after: begin